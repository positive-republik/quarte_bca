<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	// Constructor function
	function __construct()
    {
        parent::__construct();
        // Check if not login
        if (!$this->session->userdata('logged_in')) { 
			redirect(base_url('auth/login'));
			exit;
		}

	}
	
	// Dashboard 
	public function index()
	{
		// Data for this page
		$data['title'] = "Home | Quartee";

		// Get user detail by id
		$this->load->model('auth_models');
		$data['user_info'] = $this->auth_models->getUserDetail($this->session->userdata('id_user'));

		// Load views
		$this->load->view('layouts/header',$data);
		$this->load->view('layouts/sidebar');
		$this->load->view('layouts/navbar',$data);
		
		// Select view by role
		if ($this->session->userdata('role') == 1) {
			$this->admin($data['user_info']);
		} elseif($this->session->userdata('role') == 2) {
			$this->uploader($data['user_info']);
		}
		
		$this->load->view('layouts/footer');
	}

	// Admin Data
	public function admin($user_info)
	{
		// load 
		$this->load->model('admin_models');
		
		//Data this page 
		$data['user_info'] = $user_info;
		$data['users'] = $this->admin_models->getAllUser();
		$data['role_info'] = $this->admin_models->getRoleName();
		
		// Counting
		$data['count_all_users'] = $this->admin_models->getALlUserCount();
		$data['count_uploader'] = $this->admin_models->getNumRowsData(2,'users');
		$data['count_guest'] = $this->admin_models->getNumRowsData(3,'users');
		$this->load->view('dashboard/admin',$data); //ADMIN VIEWS
	}
	
	public function uploader($user_info)
	{
		$this->load->model('uploader_models');
		$data['user_info'] = $user_info;
		$data['all_upload'] = $this->uploader_models->getDataHistory();
		$this->load->view('dashboard/uploader',$data);
	}
}
