<?php 

class Uploader_models extends CI_Model {
    
    // Get all data history
    function getDataHistory()
    {
        return $this->db->get('upload_history')->result_array();
    }
    
    // Add upload history to database
    function addUploadHistory($numRows)
    {
        $query = array( 
                'id' =>  NULL,
                'user_id'  =>  $this->session->userdata('id_user'), 
                'month'  =>  date('m'),
                'date' => NULL,
                'total' => $numRows
            );

        $this->db->insert('upload_history',$query);
    }

    // Add upload data to database
    function insertDataFile($produk,$kategori)
    {
        $query = array( 
                'id' =>  NULL,
                'produk'  =>  $produk, 
                'kategori'  =>  $kategori
            );

        $this->db->insert('data_upload',$query);
    }

    // Get all qna table
    public function getAllQna()
    {
        return $this->db->get_where('qna',array('status' => NULL));
    }

    // Get all request table
    public function getAllRequest()
    {
        return $this->db->get_where('request',array('req_status' => NULL));
    }
}