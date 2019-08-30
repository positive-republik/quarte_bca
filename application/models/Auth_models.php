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
    
    // Add User Model
    function addUser($input)
    {
        // Query Data Admin Ismanyan
        // $query = array( 
        //     'id'	     =>  NULL,
        //     'full_name'  =>  'Ismanyan', 
        //     'role_id'    =>  1, 
        //     'unit_kerja' =>  'lorem',
        //     'nip'	     =>  12345,
        //     'ttl'        =>  '07-04-2002',
        //     'domain'	 =>  'ismanyan.dev',
        //     'username'	 =>  'ismanyan',
        //     'password'	 =>  password_hash('ismanyan',PASSWORD_DEFAULT),
        //     'created_at' =>  NULL
        // );

        // Query Data
        $query = array( 
            'id'	     =>  NULL,
            'full_name'  =>  $input['full_name'], 
            'role_id'    =>  $input['role_id'], 
            'unit_kerja' =>  $input['unit_kerja'],
            'nip'	     =>  $input['nip'],
            'ttl'        =>  $input['ttl'],
            'domain'	 =>  $input['domain'],
            'username'	 =>  $input['username'],
            'password'	 =>  password_hash($input['password'],PASSWORD_DEFAULT),
            'created_at' =>  NULL,
        );


        // Execute
        $this->db->insert('users', $query);
    }
}