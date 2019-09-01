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
        
        $data['qna'] = $this->uploader_models->getAllQna();
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
        
        $data['qna'] = $this->uploader_models->getAllQna();
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

        // Set delimiter errors
        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        // Set rules
        $this->form_validation->set_rules('answer','Answer','required');
		$this->form_validation->set_rules('answer_link','Answer Link','required');
        
        
        if ($this->form_validation->run() == TRUE) {
            // Set Data and Update Data if there's no errors
            $data['success'] = TRUE;
            $this->uploader_models->updateAnswer($id);
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

    // Upload System
    public function upload()
    {
        if (isset($_FILES['excel'])) {
        
            // Data File27768
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
         if (isset($_FILES['excel'])) {
            $requester_id = $this->input->post('requester_id');
            
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
            $allData = 0;
            
            //Loop data and insert into database$requester_id
            for($i=2; $i<=$nr; $i++){
                $this->uploader_models->insertReqData($xls_data[$i]['A'],$xls_data[$i]['B'],$requester_id);
            }
            // Get req id

            $this->uploader_models->editStatusRequest($requester_id,2);

            // hapus kembali file .xls yang di upload tadi
            unlink($inputFileName);

            redirect(base_url('uploader/req_manage'));
        } else {
            redirect(base_url());
        }
    }
}