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
        //     'ttl'        =>  '07-04-2002',
        //     'domain'	 =>  'ismanyan.dev',
        //     'username'	 =>  'ismanyan',
        //     'password'	 =>  password_hash('ismanyan',PASSWORD_DEFAULT),
        //     'created_at' =>  NULL
        // );
        
        $check = $this->db->get_where('users',array('username' => $input['username']));
        if ($check->num_rows() > 0) {
            echo "<script>
                    alert('Username already exists');
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

    // Update user
    public function updateUser($id)
    {
        $data = [
            'full_name'  =>  $_POST['full_name'], 
            'role_id'    =>  $_POST['role_id'], 
            'unit_kerja' =>  $_POST['unit_kerja'],
            'extention' =>  $_POST['extention'],
            'nip'	     =>  $_POST['nip'],
            'ttl'        =>  $_POST['ttl'],
            'domain'	 =>  $_POST['domain'],
            'username'	 =>  $_POST['username'],
            'password'	 =>  password_hash($_POST['password'],PASSWORD_DEFAULT)
        ];
        return $this->db->update('users', $data, ['id' => $id]);
    }
    
    // Delete user
    function deleteUser($id)
    {
        $this->db->delete('users', array('id' => $id)); 
    }
}