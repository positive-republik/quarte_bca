<?php 

class Uploader_models extends CI_Model {
    
    //Insert data from excel to db 
    function insertDataFile($a,$b)
    {
        $query = array( 
                'id'	     =>  NULL,
                'a'  =>  $a, 
                'b'    =>  $b
            );
        $this->db->insert('TEST',$query);
    }

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
}