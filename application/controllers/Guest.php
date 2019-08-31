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

			 // Send to databse
            $this->guest_models->addReq($input);
            
            // success true
            echo "<script>
                    alert('Request Success');
                    document.location.href='".base_url()."';
                </script>";
        }
    }

}