<?php 

class auth_models extends CI_Model {

    // Login validator
    function login_validator($input)
    {   
        // Check Username
        $query = $this->db->get_where('users',array('username' => $input['username']));
        if ($query->num_rows() == 0) {
            return 404; //If username not found
            exit;
        } else {
            $password = $query->result_array()[0]['password'];
            if(password_verify($input['password'],$password))
            {
                $newdata = array(
                        'id_user' => $query->result_array()[0]['id'],
                        'logged_in' => TRUE,
                        'role' => $query->result_array()[0]['role_id']
                );
                $this->session->set_userdata($newdata);
            } else {
                return 403; //If password wrong
                exit;
            }

            return 1;
        }
    }
    
}