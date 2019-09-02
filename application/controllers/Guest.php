<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guest extends CI_Controller {

	// Constructor function
	function __construct()
    {
        parent::__construct();
        // Check if not login
        if (!$this->session->userdata('logged_in')) { 
			redirect(base_url('auth/login'));
			exit;
        }
        
        $this->load->model('guest_models');
		$this->load->model('auth_models');		
    }

    // Request Page
    public function request()
    {
		// Data for this page
        $data['title'] = "Request | Quartee";
        $data['qna'] = $this->guest_models->getRessQna($this->session->userdata('id_user'));
        $data['req'] = $this->guest_models->getRessReq($this->session->userdata('id_user'));
        $data['req_data'] = $this->guest_models->getRequestData($this->session->userdata('id_user'));

		// Get user detail by id
		$data['user_info'] = $this->auth_models->getUserDetail($this->session->userdata('id_user'));
		
		// Load views
		$this->load->view('layouts/header',$data);
		$this->load->view('layouts/sidebar',$data);
        $this->load->view('layouts/navbar',$data);
		$this->load->view('guest/request');
		$this->load->view('layouts/footer');
    }

    // Export request data to excel
    public function export_excel_request($id)
    {
		$data['export_data'] = $this->guest_models->export_data_req($id);
        $this->load->view('guest/exportReqExcel',$data);
    }

    // Qna Page
    public function qna()
    {
		// Data for this page
		$data['title'] = "Qna | Quartee";
        $data['qna'] = $this->guest_models->getRessQna($this->session->userdata('id_user'));
        $data['req'] = $this->guest_models->getRessReq($this->session->userdata('id_user'));
        $data['produk'] = $this->guest_models->getProduk();

		// Get user detail by id
        $data['user_info'] = $this->auth_models->getUserDetail($this->session->userdata('id_user'));

        $this->form_validation->set_rules('produk', 'Produk', 'required');
        
        if ($this->form_validation->run()) {
            // Get data question
            $data['quest'] = $this->guest_models->getQuestion();
        } 
        
		// Load views
        $this->load->view('layouts/header',$data);
        $this->load->view('layouts/sidebar',$data);
        $this->load->view('layouts/navbar',$data);
        $this->load->view('guest/qna',$data);
        $this->load->view('layouts/footer');
    }

    // Add request data 
    public function addReqData()
    {
		// Validasi input data
        $this->form_validation->set_rules('reqTitle','Judul Permintaan','required');
        $this->form_validation->set_rules('req_purpose','Tujuan Permintaan','required');
        $this->form_validation->set_rules('startDate','Bulan Awal','required');
        $this->form_validation->set_rules('endDate','Bulan Akhir','required');
        $this->form_validation->set_rules('priority','Priority','required');
        $this->form_validation->set_rules('requester_name','Requester Name','required');
        $this->form_validation->set_rules('req_id','Requester Id','required');
        $this->form_validation->set_rules('req_email','Requester Email','required');
        $this->form_validation->set_rules('req_extention','Requester Extention','required');

        // Proses pengecekan data
        if($this->form_validation->run() == false){
           echo "<script>
                    alert('Request failed');
                    document.location.href='".base_url()."';
                </script>";
        } else {
            // Input Data Filter
            $input['reqTitle'] = $this->input->post('reqTitle',true);
            $input['req_purpose'] = $this->input->post('req_purpose',true);
            $input['startDate'] = $this->input->post('startDate',true);
            $input['endDate'] = $this->input->post('endDate',true);
            $input['priority'] = $this->input->post('priority',true);
            $input['requester_name'] = $this->input->post('requester_name',true);
            $input['req_id'] = $this->input->post('req_id',true);
            $input['req_email'] = $this->input->post('req_email',true);
            $input['req_extention'] = $this->input->post('req_extention',true);

			 // Send to databse
            $this->guest_models->addReq($input);
            
            // success true
            echo "<script>
                    alert('Request Success');
                    document.location.href='".base_url()."';
                </script>";
        }
    }
    // Add Data Qna
    public function addQnA()
    {
        $this->form_validation->set_rules('produk', 'Produk', 'required');
        $this->form_validation->set_rules('question', 'Question', 'required');
        $this->form_validation->set_rules('id', '', '');
        $this->form_validation->set_rules('username', '', '');

        if ($this->form_validation->run() == FALSE) {

            redirect(base_url('guest/qna'));

        } else {
            $this->guest_models->addDataQnA();
            redirect(base_url());
        }
    }
    
    // Read QnA for update status to 3
    public function read($id)
    {
        $this->guest_models->readQnA($id);
        redirect(base_url());
    }

    // Run Report
    public function report()
    {
        if ($this->input->post() == NULL) {
            redirect(base_url());
            exit;
        }

        // Input
        $input['produk'] = $this->input->post('produk',true);
        $input['start'] = $this->input->post('start',true);
        $input['end'] = $this->input->post('end',true);
        $data['produk'] = $input['produk'];
        $data['start'] = $input['start'];
        $data['end'] = $input['end'];
        
        // loop al input kategori
        for ($i=0; $i < count($this->input->post('kategori')); $i++) { 
            $input['kategori'][$i] = $this->input->post('kategori')[$i];
        }
        
        // Data for this page
        $data['title'] = "Qna | Quartee";
        $data['data'] = $this->guest_models->run_report($input);
        $data['qna'] = $this->guest_models->getRessQna($this->session->userdata('id_user'));
        $data['req'] = $this->guest_models->getRessReq($this->session->userdata('id_user'));
        $data['chartReq'] = true;
        $data['chartVal'] = $this->guest_models->run_report_month($input);
        $data['GetGrowthPercent'] = $this->GetGrowthPercent($data['chartVal']);
        $data['counterDataReq'] = $this->guest_models->counterData($input['produk'],'REQ/',$input['start'],$input['end']);
        $data['counterDataInf'] = $this->guest_models->counterData($input['produk'],'INF/',$input['start'],$input['end']);
        $data['counterDataCompl'] = $this->guest_models->counterData($input['produk'],'COMPL/',$input['start'],$input['end']);
        $data['counterDataSaran'] = $this->guest_models->counterData($input['produk'],'SARAN/',$input['start'],$input['end']);
        $data['topReq'] = $this->guest_models->top10($input);

        // Get user detail by id
        $data['user_info'] = $this->auth_models->getUserDetail($this->session->userdata('id_user'));

        // Load views
        $this->load->view('layouts/header',$data);
        $this->load->view('layouts/sidebar',$data);
        $this->load->view('layouts/navbar',$data);
        $this->load->view('guest/report',$data);
        $this->load->view('layouts/footer',$data);
    }

    // EXport Excel report
    public function excelreport()
    {
        // Input
        $input['produk'] = $this->input->post('produk',true);
        $input['start'] = $this->input->post('start',true);
        $input['end'] = $this->input->post('end',true);
        $data['produk'] = $input['produk'];
        
        // loop al input kategori
        for ($i=0; $i < count($this->input->post('kategori')); $i++) { 
            $input['kategori'][$i] = $this->input->post('kategori')[$i];
        }

        $data['data'] = $this->guest_models->run_report($input);

        $this->load->view('guest/export_run_report',$data);
    }

    // Get GetGrowthPercent
    public function GetGrowthPercent($param)
    {
        foreach ($param as $key) {
            if ($key !== 0) {
                $start_data = $key;
                break;
            } 
            else {
                $start_data = 0;
            }
        }

        for ($i=11; $i > 0; $i--) { 
            if ($param[$i] !== 0) {
                $end_data = $param[$i];
                break;
            }
            else {
                $end_data = 0;
            }
        }
        if ($start_data == NULL && $end_data == NULL || $start_data == 0 && $end_data == 0) {
            return $resultStatistik = 0;
        } else {
            $resultStatistik = ($end_data / $start_data) - 2;
            return $resultStatistik = round($resultStatistik,1);
        }
    }
}