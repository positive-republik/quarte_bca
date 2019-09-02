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
            $password = $query->row_array()['password'];
            if(password_verify($input['password'],$password))
            {
                $newdata = array(
                        'id_user' => $query->row_array()['id'],
                        'logged_in' => TRUE,
                        'role' => $query->row_array()['role_id']
                );
                $this->session->set_userdata($newdata);
            } else {
                return 403; //If password wrong
                exit;
            }
            // Return 1 if success
            return 1;
        }
    }
    
    // Get user detail by id
    function getUserDetail($id)
    {   
        // If not already user logout from this seasson
        if (! $this->db->get_where('users',array('id'=>$id))->result_array()[0]) {
           // Redirect to logout
            redirect(base_url('auth/logout'));
        } else {
            return $this->db->get_where('users',array('id'=>$id))->result_array()[0];
        }
        
    }
}