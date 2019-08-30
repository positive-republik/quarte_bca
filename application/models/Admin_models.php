<?php 

class admin_models extends CI_Model {

    // Fetch data user
    function getAllUser()
    {   
        return $this->db->get('users')->result_array();
    }
    
}