<?php 

function checkSendKategori($bulan, $produk, $kategori)
{
    $CI =& get_isntance();

    $CI->db->where('month', $bulan);
    $CI->db->where('produk', $produk);
    $CI->db->where('kategori', $kategori);
    return $CI->db->get('produk')->row_array();

}