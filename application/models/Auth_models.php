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
            $encrypt_method = "AES-256-CBC";
            $secret_key = 'This is my secret key';
            $secret_iv = 'This is my secret iv';
            // hash
            $key = hash('sha256', $secret_key);
            
            // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
            $iv = substr(hash('sha256', $secret_iv), 0, 16);
            
            $password = $query->row_array()['password'];
            $output = openssl_encrypt($input['password'], $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
            
            if( $output == $password )
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