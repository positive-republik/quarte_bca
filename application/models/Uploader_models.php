<?php 

class Uploader_models extends CI_Model {
    
    // Get if uploader already upload in this month 
    function checkUploadThisMonth()
    {
        $query = $this->db->get_where('upload_history',array('user_id'=>$this->session->userdata('id_user'),'month'=>date('m')));
        if ($query->num_rows()>0) {
            return 1;
        } else {
            return 0;
        }
    }

    // Get all data history
    function getDataHistory()
    {
        return $this->db->get('upload_history')->result_array();
    }
    
    // Delete data upload if double upload
    function deleteDataUpload()
    {
        $this->db->delete('data_upload', array('user_id' => $this->session->userdata('id_user'),'month'=>date('m'))); 
        $this->db->delete('upload_history', array('user_id' => $this->session->userdata('id_user'),'month'=>date('m'))); 
    }

    // Add upload history to database
    function addUploadHistory($numRows)
    {
        if ($this->input->post('date') !== null) {
            $month = substr($this->input->post('date'), 5, 8);
            $date = $this->input->post('date');
        } else {
            $month = date('m');
            $date = null;
        }
        
        $query = array( 
                'id' =>  NULL,
                'user_id'  =>  $this->session->userdata('id_user'), 
                'month'  =>  $month,
                'date' => $date,
                'total' => $numRows
            );

        $this->db->insert('upload_history',$query);
    }

    // Add upload data to database
    function insertDataFile($produk,$kategori,$month = null)
    {
        // if ($month == null) {
        //     $month = date('m');
        // }

        if ($this->input->post('date') !== null) {
            $month = substr($this->input->post('date'), 5, 8);
            $created = $this->input->post('date');
        } else {
            $month = date('m');
            $created = null;
        }

        $query = array( 
                'id' =>  NULL,
                'month' =>  $month,
                'produk'  =>  $produk, 
                'kategori'  =>  $kategori,
                'user_id' => $this->session->userdata('id_user'),
                'created_at' => $created
            );

        $this->db->insert('data_upload',$query);

        $checkProduk = $this->db->get_where('produk',array('produk' => $produk));
        $checkKategori = $this->db->get_where('kategori',array('kategori' => $kategori));

        if ($checkProduk->num_rows() === 0) {
            $this->db->insert('produk',array('id' => NULL, 'produk' => $produk));
        } elseif ($checkKategori->num_rows() === 0) {
            $this->db->insert('kategori',array('id' => NULL, 'kategori' => $kategori, 'produk_name' => $produk));
        }
    }

    // Get all qna table
    public function getAllQna()
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('qna', 'qna.asker_id=users.id');
        return $this->db->order_by("status", "ASC")->get();
    }

    // Get all qna table for navbar
    public function getAllQnaNav()
    {
        $this->db->order_by("status", "ASC");
        $this->db->order_by("created_at", "DESC");
        return $this->db->get('qna');
    }

    // Delete request
    public function deleteReq($id)
    {
        $this->db->delete('request',array('id'=>$id));
    }

    // Delete Qna
    public function deleteQna($id)
    {
        $this->db->delete('qna',array('id'=>$id));
    }

    // Get QnA by id
    public function getDataQnAById($id)
    {
        return $this->db->get_where('qna', ['id' => $id])->row_array();
    }

    // Get all request table
    public function getAllRequest()
    {
        $this->db->order_by("req_status", "ASC");
        $this->db->order_by("created_at", "DESC");
        return $this->db->get('request');
    }

    // Get all request data in manage request page
    public function getAllReqDataManage()
    {
        return $this->db->order_by("req_status", "ASC")->get('request');
    }

    // update Answer
    public function updateAnswer($id)
    {
        $data = [
            'answer' => $this->input->post('answer'),
            'answer_link' => $this->input->post('answer_link'),
            'status' => 2,
            'answer_id' => $this->session->userdata('id_user'),
            'update_at' => date('Y-m-d'),
            'answer_name' => $this->session->userdata('name')
        ];
        return $this->db->update('qna', $data, ['id' => $id['id']]);
    }
    
    // update Answer
    public function modifAnswer($id)
    {
        $data = [
            'answer' => $this->input->post('answer'),
            'answer_link' => $this->input->post('answer_link'),
            'modified_at' => date('Y-m-d'),
            'modified_by' => $this->session->userdata('name')
        ];
        return $this->db->update('qna', $data, ['id' => $id]);
        
    }
    
    // change status request
    function editStatusRequest($input)
    {
         $data = [
            'req_status' => 2,
            'req_link' => $input['req_link'],
            'req_note' => $input['note'],
            'answer_name' => $input['user_info']['full_name'],
            'update_at' => date('Y-m-d')
        ];
        $this->db->where('requester_id', $input['requester_id']);
        $this->db->where('id', $input['id']);
        $this->db->update('request', $data);
    }

    // Edit Upload Data
    function editRemoveData($month,$id)
    {
        $this->db->delete('data_upload',array('month'=>$month,'user_id'=>$this->session->userdata('id_user')));
        $this->db->delete('upload_history', array('id' => $id, 'user_id' => $this->session->userdata('id_user')));
    }

    // Get all filing cabinet
    function getAllCabinet()
    {
        return $this->db->get('upload_reporting')->result_array();
    }

    function insertFilingCabinet($input)
    {
        $query = array( 
                'id' =>  NULL,
                'nama_file'  =>  $input['nama_file'], 
                'kategori'  =>  $input['kategori'],
                'produk'  =>  $input['produk'],
                'start'  =>  $input['start'],
                'end'  =>  $input['end'],
                'created_by'  => $input['name'] ,
                'created_at'  =>  NULL,
                'file'  =>  $input['file']
            );

        $this->db->insert('upload_reporting',$query);
    }

    function editFilingCabinet($input,$temp)
    {
         $data = [
            'nama_file' => $input['name'],
            'kategori' => $input['kategori'],
            'produk' => $input['produk'],
            'start' => $input['start'],
            'end' => $input['end'],
            'file' => $temp
        ];
        $this->db->where('id', $input['id']);
        $this->db->update('upload_reporting', $data);
    }

    function deleteFilingCabinet($id)
    {
        $this->db->delete('upload_reporting',array('id'=>$id));
    }
}