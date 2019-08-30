<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	// Constructor function
	function __construct()
    {
        parent::__construct();
        // Check if not login
        if (!$this->session->userdata('logged_in'))
        { 
			redirect(base_url('auth/login'));
			exit;
        }
	}
	
	// Dashboard page
	public function index()
	{
		// Data for this page
		$data['title'] = "Home | Quartee";
		// Load views
		$this->load->view('layouts/header',$data);
		$this->load->view('layouts/sidebar');
		$this->load->view('layouts/navbar');
		$this->load->view('dashboard/admin');
		$this->load->view('layouts/footer');
	}
}
