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
		
    }

    public function upload()
    {
        if (isset($_FILES['excel'])) {
        
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
}