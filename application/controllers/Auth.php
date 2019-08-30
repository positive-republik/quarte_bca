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

	// add user into database
	// public function regist_auth()
	// {
	// 	// Validasi input data
    //     $this->form_validation->set_rules('name','Nama','required');
	// 	$this->form_validation->set_rules('phone','No Hp','required|numeric');
	// 	$this->form_validation->set_rules('email','Email','required');
	// 	$this->form_validation->set_rules('pass','Password','required|min_length[8]');
	// 	$this->form_validation->set_rules('passcon','Konfirmasi Password','required|matches[pass]');
        
    //     // Check Data valid
    //     if($this->form_validation->run() == false){
    //         echo "data tidak valid";
    //     }else {
    //         // Input Data
    //         $input['name'] = $this->input->post('name',true);
    //         $input['phone'] = $this->input->post('phone',true);
    //         $input['email'] = $this->input->post('email',true);
    //         $input['pass'] = $this->input->post('pass',true);
    //         $input['passcon'] = $this->input->post('passcon',true);
            
    //         $checkEmail = $this->auth_models->checkEmail($input['email']);

    //         if ($checkEmail === 0) {
    //             // Send to databse
	// 			$this->auth_models->addUser($input);
    //             $data['status'] = true;
    //         } else {
    //             $data['err'] = true;
    //         }
            
    //         // Redirect to daftar page
    //         $this->load->view('auth/daftar.php',$data);
    //     }
	// }
}
