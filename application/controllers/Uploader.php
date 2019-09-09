<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uploader extends CI_Controller {

	// Constructor function
	function __construct()
    {
        parent::__construct();
        // Check if not login
        if (!$this->session->userdata('logged_in')) { 
			redirect(base_url('auth/login'));
			exit;
        }
        
        $this->load->model('uploader_models');
		$this->load->model('auth_models');        
    }

    // Request management page
    public function req_manage()
    {
        // Data for this page
        $data['title'] = "Request Management | Quartee";
        $data['reqDataManage'] = $this->uploader_models->getAllReqDataManage();
        
        $data['qna'] = $this->uploader_models->getAllQnaNav();
        $data['req'] = $this->uploader_models->getAllRequest();
        $data['user_info'] = $this->auth_models->getUserDetail($this->session->userdata('id_user'));
   
        // Load views
		$this->load->view('layouts/header',$data);
		$this->load->view('layouts/sidebar',$data);
        $this->load->view('layouts/navbar',$data);
        $this->load->view('uploader/req_management',$data);
		$this->load->view('layouts/footer');
		
    }

    // Qna management page
    public function qna_manage()
    {
        // Data for this page
        $data['title'] = "Qna Management | Quartee";
        $data['reqDataManage'] = $this->uploader_models->getAllReqDataManage();
        
        $data['qna'] = $this->uploader_models->getAllQnaNav();
        $data['data'] = $this->uploader_models->getAllQna();
        $data['req'] = $this->uploader_models->getAllRequest();
        $data['user_info'] = $this->auth_models->getUserDetail($this->session->userdata('id_user'));

        // Ajax
        $data['ajax'] = 'uploader';
        
        // Load views
		$this->load->view('layouts/header',$data);
		$this->load->view('layouts/sidebar',$data);
        $this->load->view('layouts/navbar',$data);
        $this->load->view('uploader/qna_management',$data);
		$this->load->view('layouts/footer');
		
    }

    // Set Data Answer
    public function setQnA($id)
    {
        $data = [
            'question' => $this->uploader_models->getDataQnAById($id)
        ];

        $this->load->view('uploader/answer_question', $data);
    }

    // Update Answer
    public function updateAnswer($id)
    {
        // Data to check on ajax
        $data['success'] = FALSE;
        $data['messages'] = [];
        
        // Get user detail by id
		$data['user_info'] = $this->auth_models->getUserDetail($this->session->userdata('id_user'));
        $data['id'] = $id;
        // Set delimiter errors
        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        // Set rules
        $this->form_validation->set_rules('answer','Answer','required');
		$this->form_validation->set_rules('answer_link','Answer Link','required');
        
        
        if ($this->form_validation->run() == TRUE) {
            // Set Data and Update Data if there's no errors
            $data['success'] = TRUE;
            $this->uploader_models->updateAnswer($data);
        } else {
            // Check Validation
            foreach ( $_POST as $key => $value )
            {
                // Add to error
                $data['messages'][$key] = form_error($key);
            }
        }
        
        echo json_encode($data);
    }

    // delete qna / request
    public function delete($type,$id)
    {
        if ($type == 'req') {
            $this->uploader_models->deleteReq($id);
            redirect(base_url('uploader/req_manage'));
        } else {
            $this->uploader_models->deleteQna($id);
            redirect(base_url('uploader/qna_manage'));
        }

    }

    // Upload System
    public function upload()
    {   
        $uploadCek = $this->uploader_models->checkUploadThisMonth();
        if ($uploadCek > 0) {
            $this->uploader_models->deleteDataUpload();
        }
        if (isset($_FILES['excel'])) {
            
            // Data File27768
            $upload_dir = 'assets/vendor/phpspreadsheet/file';
            $temp = explode(".", $_FILES["excel"]["name"]);
            $newfilename = round(microtime(true)) . '.' . end($temp);
            $target = basename($newfilename);
            move_uploaded_file($_FILES['excel']['tmp_name'], "$upload_dir/$target");
            $inputFileName = $upload_dir.'/'.$target;
            
            // create directly an object instance of the IOFactory class, and load the xlsx file
            $fxls = $inputFileName;
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fxls);
            
            // read excel data and store it into an array
            $xls_data = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
            
            // number of rows
            $nr = count($xls_data); 
            $allData = 0;
            
            // Loop data and insert into database
            for($i=2; $i<=$nr; $i++){
                if($xls_data[$i]['A'] != NULL && $xls_data[$i]['B'] != NULL){
                    $this->uploader_models->insertDataFile($xls_data[$i]['A'],$xls_data[$i]['B']);
                    $allData++;
                }
            }

            // Add upload history
            $this->uploader_models->addUploadHistory($allData);

            // hapus kembali file .xls yang di upload tadi
            unlink($inputFileName);

            redirect(base_url().'?safe=1');
        } else {
            redirect(base_url());
        }
    }
    
    // respone request
    public function responeReq()
    {   
        $input['requester_id'] = $this->input->post('requester_id');
        $input['id'] = $this->input->post('id');
        $input['note'] = $this->input->post('note');
        $input['req_link'] = $this->input->post('req_link');
        $input['user_info'] = $this->auth_models->getUserDetail($this->session->userdata('id_user'));

        $this->uploader_models->editStatusRequest($input);
        
        redirect(base_url('uploader/req_manage'));
    }

    // Edit Upload data
    public function edit()
    {
        if ($_FILES['excel'] == NULL) {
            redirect(base_url());
            exit;
        }

        $month = $this->input->post('date');
        $this->uploader_models->editRemoveData($month);
        // Data File
        $upload_dir = 'assets/vendor/phpspreadsheet/file';
        $target = basename($_FILES['excel']['name']);
        move_uploaded_file($_FILES['excel']['tmp_name'], "$upload_dir/$target");
        $inputFileName = $upload_dir.'/'.$target;

        // create directly an object instance of the IOFactory class, and load the xlsx file
        $fxls = $inputFileName;
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fxls);

        // read excel data and store it into an array
        $xls_data = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        
        // number of rows
        $nr = count($xls_data); 
    
        //Loop data and insert into database
        for($i=2; $i<=$nr; $i++){
            if($xls_data[$i]['A'] != NULL && $xls_data[$i]['B'] != NULL){
                $this->uploader_models->insertDataFile($xls_data[$i]['A'],$xls_data[$i]['B'],$month);
            }
        }

        // hapus kembali file .xls yang di upload tadi
        unlink($inputFileName);

        redirect(base_url());
    }

    public function filing_cabinet()
    {
        // Data for this page
        $data['title'] = "Filing Cabinet | Quartee";
        $data['data'] = $this->uploader_models->getAllCabinet();
        
        $data['qna'] = $this->uploader_models->getAllQnaNav();
        $data['req'] = $this->uploader_models->getAllRequest();
        $data['user_info'] = $this->auth_models->getUserDetail($this->session->userdata('id_user'));

        $this->load->model('guest_models');
        $data['produk'] = $this->guest_models->getProduk();
        $data['kategori'] = $this->guest_models->getKategori();

        // Load views
		$this->load->view('layouts/header',$data);
		$this->load->view('layouts/sidebar',$data);
        $this->load->view('layouts/navbar',$data);
        $this->load->view('uploader/filing_cabinet',$data);
		$this->load->view('layouts/footer');   
    }

    public function add_filing_cabinet()
    {
        if ($this->input->post() == null) {
            redirect(base_url());
            exit;
        }

        $upload_dir = 'assets/vendor/phpspreadsheet/file';
        $temp = explode(".", $_FILES["excel"]["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        $target = basename($newfilename);

        move_uploaded_file($_FILES['excel']['tmp_name'], "$upload_dir/$target");
        $insert['name'] = $this->input->post('full_name',true);
        $insert['nama_file'] = $this->input->post('nama_file',true);
        $insert['produk'] = $this->input->post('produk',true);
        $insert['kategori'] = $this->input->post('kategori',true);
        $insert['start'] = $this->input->post('start',true);
        $insert['end'] = $this->input->post('end',true);
        $insert['file'] = $newfilename;

        $this->uploader_models->insertFilingCabinet($insert);

        echo "<script>
                alert('Add success');
                document.location.href='".base_url('uploader/filing_cabinet')."';
            </script>";
    }

    public function edit_filling_cabinet()
    {
        $upload_dir = 'assets/vendor/phpspreadsheet/file';
        $temp = explode(".", $_FILES["excel"]["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        $target = basename($newfilename);

        move_uploaded_file($_FILES['excel']['tmp_name'], "$upload_dir/$target");
        $input['id'] = $this->input->post('id',true);
        $input['name'] = $this->input->post('file_name',true);
        $input['produk'] = $this->input->post('file_produk',true);
        $input['kategori'] = $this->input->post('file_kategori',true);
        $input['start'] = $this->input->post('start',true);
        $input['end'] = $this->input->post('end',true);
        $this->uploader_models->editFilingCabinet($input,$target);
        echo "<script>
                alert('Edit success');
                document.location.href='".base_url('uploader/filing_cabinet')."';
            </script>";
    }

    public function deleteFilingCabinet($id)
    {
        $this->uploader_models->deleteFilingCabinet($id);
        redirect(base_url('uploader/filing_cabinet'));
    }

    
    // get detail qna
    public function detailQna($id)
    {
        $this->load->model('guest_models');
        $arr = json_encode($this->guest_models->getDetailChat($id)->result_array());
        echo $arr;
    }

    // get detail qna
    public function detailReq($id)
    {
        $this->load->model('guest_models');
        $arr = json_encode($this->guest_models->getDetailReq($id)->result_array());
        echo $arr;
    }
}