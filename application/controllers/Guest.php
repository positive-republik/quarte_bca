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
        $this->form_validation->set_rules('priority','Priority','required');
        $this->form_validation->set_rules('priority','Priority','required');
    }

}