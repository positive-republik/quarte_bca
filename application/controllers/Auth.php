<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	// Contructor Function
	function __construct(){
		parent::__construct();
        $this->load->library('form_validation');
		$this->load->model('auth_models');
    }
	
	// Default index page
	public function index()
	{
		redirect(base_url('auth/login'));
		exit;
	}

	// Login page
	public function login()
	{
		// Check if Already login
        if ($this->session->userdata('logged_in')) { 
			redirect(base_url());
			exit;
		}

		// Data for this page
		$data['title'] = "Login | Quartee";
		// Validasi input data
        $this->form_validation->set_rules('username','Username','required');
        $this->form_validation->set_rules('password','Password','required');

		// Proses pengecekan data
        if($this->form_validation->run() == false){
            // Load views
			$this->load->view('auth/header',$data);
			$this->load->view('auth/login');
			$this->load->view('auth/footer');
        }else {
            // Input Data
            $input['username'] = $this->input->post('username',true);
            $input['password'] = $this->input->post('password',true);
			
            // Send to databse
			$check = $this->auth_models->login_validator($input);
			
			if ($check === 1) {
				redirect(base_url());
				exit;
			} else {
				// Load views
				$data['err'] = $check;
				$this->load->view('auth/header',$data);
				$this->load->view('auth/login',$data);
				$this->load->view('auth/footer');
			}
        }
        
	}

	public function logout()
    {
        // Remove session
		$this->session->unset_userdata('id_user');
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('role');
		
        // Redirect to login page
        redirect(base_url('auth/login'));
    }

	
}
