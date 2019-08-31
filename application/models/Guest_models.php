<?php 

class guest_models extends CI_Model {
    // Get role name by id
    public function getRoleById($id)
    {
        return $this->db->get_where('role',array('id' => $id))->result_array()[0];
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
        $this->db->where(array('asker_id' => $id,'answer !=' => NULL));
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
}