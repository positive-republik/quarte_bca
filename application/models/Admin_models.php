<?php 

class admin_models extends CI_Model {

    // Fetch data user
    function getAllUser()
    {   
        return $this->db->get('users')->result_array();
    }

    // Get role name 
    function getRoleName()
    {
        $this->db->select('users.role_id, role.name_role, role.job_desc');
        $this->db->from('users');
        $this->db->join('role', 'role.id = users.role_id');
        return $this->db->get()->result_array();
    }

    // Get num rows user data
    function getNumRowsData($data,$table)
    {
        $this->db->where(array('role_id'=>$data));
        return $this->db->count_all_results($table);
    }

    // Get num rows all users
    function getALlUserCount()
    {
        return $this->db->count_all_results('users');
    }

    // Get data from id
    function getDataFromId($id)
    {
        return $this->db->get_where('users', ['id' => $id])->row_array();
    }

    // Add User into database
    function addUser($input)
    {
        // Query Data Admin Ismanyan
        // $query = array( 
        //     'id'	     =>  NULL,
        //     'full_name'  =>  'Ismanyan', 
        //     'role_id'    =>  1, 
        //     'unit_kerja' =>  'lorem',
        //     'nip'	     =>  12345,
        //     'email'        =>  '07-04-2002',
        //     'domain'	 =>  'ismanyan.dev',
        //     'username'	 =>  'ismanyan',
        //     'password'	 =>  password_hash('ismanyan',PASSWORD_DEFAULT),
        //     'created_at' =>  NULL
        // );
        $check = $this->db->where('username',$input['username']);
        $check = $this->db->or_where('full_name',$input['full_name']);
        $check = $this->db->or_where('nip',$input['nip']);
        $check = $this->db->or_where('email',$input['email']);
        $check = $this->db->or_where('domain',$input['domain']);
        $check = $this->db->get('users');
        if ($check->num_rows() > 0) {
            echo "<script>
                    alert('Data pada user ini sudah ada !');
                    document.location.href='".base_url()."';
                </script>";
            exit;
        } else {
            // Query Data
            $query = array( 
                'id'	     =>  NULL,
                'full_name'  =>  $input['full_name'], 
                'role_id'    =>  $input['role_id'], 
                'unit_kerja' =>  $input['unit_kerja'],
                'extention' =>  $input['extention'],
                'nip'	     =>  $input['nip'],
                'email'        =>  $input['email'],
                'domain'	 =>  $input['domain'],
                'username'	 =>  $input['username'],
                'password'	 =>  $input['password'],
                'created_at' =>  NULL,
            );
            // Execute
            $this->db->insert('users', $query);
        }

    }

    // Update user
    public function updateUser($id)
    {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'This is my secret key';
        $secret_iv = 'This is my secret iv';
        // hash
        $key = hash('sha256', $secret_key);
        
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $output = openssl_encrypt($_POST['password'], $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);

        $data = [
            'full_name'  =>  $_POST['full_name'], 
            'role_id'    =>  $_POST['role_id'], 
            'unit_kerja' =>  $_POST['unit_kerja'],
            'extention' =>  $_POST['extention'],
            'nip'	     =>  $_POST['nip'],
            'email'        =>  $_POST['email'],
            'domain'	 =>  $_POST['domain'],
            'username'	 =>  $_POST['username'],
            'password'	 =>  $output
        ];
        return $this->db->update('users', $data, ['id' => $id]);
    }
    
    // Delete user
    function deleteUser($id)
    {
        $this->db->delete('users', array('id' => $id)); 
    }

    // Decrypt password
    function getPass()
    {
        $pass = $this->db->select('id,password');
        return $pass = $this->db->get('users');
    }

    // Encrypt use open ssl 
    function encrypt_decrypt($action, $string) {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'This is my secret key';
        $secret_iv = 'This is my secret iv';
        // hash
        $key = hash('sha256', $secret_key);
        
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if( $action == 'decrypt' ) {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }
}