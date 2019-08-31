<?php 

class Uploader_models extends CI_Model {
    
    // Get all data history
    function getDataHistory()
    {
        return $this->db->get('upload_history')->result_array();
    }
    
    // Add upload history to database
    function addUploadHistory($numRows)
    {
        $query = array( 
                'id' =>  NULL,
                'user_id'  =>  $this->session->userdata('id_user'), 
                'month'  =>  date('m'),
                'date' => NULL,
                'total' => $numRows
            );

        $this->db->insert('upload_history',$query);
    }

    // Add upload data to database
    function insertDataFile($produk,$kategori)
    {
        $query = array( 
                'id' =>  NULL,
                'produk'  =>  $produk, 
                'kategori'  =>  $kategori
            );

        $this->db->insert('data_upload',$query);

        $checkProduk = $this->db->get_where('produk',array('produk' => $produk));
        $checkKategori = $this->db->get_where('kategori',array('kategori' => $kategori));

        if ($checkProduk->num_rows() === 0) {
            $this->db->insert('produk',array('id' => NULL, 'produk' => $produk));
        } elseif ($checkKategori->num_rows() === 0) {
            $this->db->insert('kategori',array('id' => NULL, 'kategori' => $kategori));
        }
    }

    // Get all qna table
    public function getAllQna()
    {
        return $this->db->get_where('qna',array('status' => NULL));
    }

    // Get all request table
    public function getAllRequest()
    {
        return $this->db->get_where('request',array('req_status' => NULL));
    }
}