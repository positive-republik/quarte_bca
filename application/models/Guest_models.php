<?php 

class guest_models extends CI_Model {
    // Get role name by id
    public function getRoleById($id)
    {
        return $this->db->get_where('role',array('id' => $id))->result_array()[0];
    }

    // getRequest Data
    public function getRequestData($id)
    {
        return $this->db->get_where('request_data',array('requester_id'=>$id));
    }
    // Fetch getAllQna
    public function getAllQna($id)
    {
        return $this->db->get_where('qna',array('asker_id' => $id));
    }

    // Fetch qna where answered limit 5
    public function getRessQna($id)
    {
        $this->db->order_by("created_at", "DESC");
        // $this->db->where(array('asker_id' => $id,'answer !=' => NULL));
        return $this->db->get('qna',5);
    }

    // Fetch qna where request limit 5
    public function getRessReq($id)
    {
        $this->db->order_by("created_at", "DESC");
        $this->db->where(array('requester_id' => $id,'req_status' => 1));
        return $this->db->get('request',5);
    }

    // fetch produk 
    public function getProduk()
    {
        return $this->db->get('produk');
    }

    // fetch Kategori 
    public function getKategori()
    {
        return $this->db->get('kategori');
    }

    // Add to request
    public function addReq($input)
    {
        $query = array( 
            'id' =>  NULL,
            'req_title'  =>  $input['reqTitle'], 
            'requester_name'  =>  $input['requester_name'],
            'requester_id' => $input['req_id'],
            'req_purpose' => $input['req_purpose'],
            'req_start' => $input['startDate'],
            'req_end' => $input['endDate'],
            'req_priority' => $input['priority'],
            'req_status' => NULL,
            'created_at' => NULL
        );

        $this->db->insert('request',$query);
    }

    // Add QnA
    public function addDataQnA()
    {
        $data = [
            'produk' => $this->input->post('produk'),
            'asker_id' => $this->input->post('id'),
            'asker_name' => $this->input->post('username'),
            'question' => $this->input->post('question'),
            'answer' => NULL,
            'answer_link' => '',
            'status' => 1
        ];
        return $this->db->insert('qna', $data);
    }

    public function readQnA($id)
    {
        $data = [
            'status' => 3
        ];
        return $this->db->update('qna', $data, ['id' => $id]);
    }

    public function export_data_req($id)
    {
        return $this->db->get_where('request_data',array('requester_id'=>$id));
    }

    public function getQuestion()
    {
        $produk = $this->input->post('produk');

        return $this->db->get_where('qna', ['produk' => $produk])->result_array();
        
    }
}