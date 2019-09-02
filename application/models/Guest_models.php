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
        $this->db->where(array('requester_id' => $id,'req_status' => 2));
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
            'req_email' => $input['req_email'],
            'req_extention' => $input['req_extention'],
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

    // Export data request to excel
    public function export_data_req($id)
    {
        return $this->db->get_where('request_data',array('requester_id'=>$id));
    }

    // Get quest
    public function getQuestion()
    {
        $produk = $this->input->post('produk');
        return $this->db->get_where('qna', ['produk' => $produk])->result_array();   
    }

    // Start run report
    public function run_report($input)
    {   
        if (count($input['kategori']) < 2) {
            return $this->db->select('kategori, produk, month, count(*) as cnt')->where(array('produk' => $input['produk'], 'kategori' => $input['kategori'][0], 'created_at >' => $input['start'], 'created_at <' => $input['end']))->group_by(array("month","produk","kategori"))->having("cnt > 1", null, false)->get('data_upload')->result_array(); 
        } else {
            $this->db->select('kategori, produk, month, count(*) as cnt');
            $this->db->where('produk', $input['produk']);
            $this->db->where('kategori', $input['kategori'][0]);
            for ($i=1; $i < count($input['kategori']); $i++) { 
                $this->db->where('kategori', $input['kategori'][$i]);
            }
            $this->db->where('created_at > ', $input['start']);
            $this->db->where('created_at < ', $input['end']);
            $this->db->group_by(array("month","produk","kategori"));
            $this->db->having("cnt > 1", null, false);
            return $this->db->get('data_upload')->result_array();
        }
        
    }

    // Get data for month chart
    public function run_report_month($input)
    {
        // Create month
        $month = array('1' => 0);;
        for ($i=1; $i <= 12; $i++) { 
            array_push($month,0);
        }
        
        if (count($input['kategori']) < 2) {
            $q=$this->db->select('month, count(*) as cnt')->group_by(array("month"))->get_where("data_upload",array('produk' => $input['produk'], 'kategori' => $input['kategori'][0], 'created_at > ' => $input['start'], 'created_at < ' => $input['end']))->result_array(); 
        } else {
            $q=$this->db->select('month, count(*) as cnt');
            $this->db->where('produk', $input['produk']);
            $this->db->where('kategori', $input['kategori'][0]);
            for ($i=1; $i < count($input['kategori']); $i++) { 
                $this->db->where('kategori', $input['kategori'][$i]);
            }
            $this->db->where('created_at > ', $input['start']);
            $this->db->where('created_at < ', $input['end']);
            $this->db->group_by(array("month"));
            $q=$this->db->get('data_upload')->result_array();
        }
        
        // Set month value
        for ($i=0; $i < count($q); $i++) {
            for ($z=1; $z <= 12; $z++) {    
                if ($z == $q[$i]['month']) {
                    $month[$z] = $q[$i]['cnt'];
                }
            } 
        }
        return $month;
    }

    // Get count data for statistik perkembangan
    public function counterData($produk,$kategori) {
        return $this->db->select('kategori, produk, count(kategori) as cnt')->like('kategori',$kategori,'both')->get_where('data_upload',array('produk'=>$produk))->row_array();
    }
}