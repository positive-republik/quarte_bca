<?php 

function checkQnA($id)
{
    $CI =& get_instance();
    
    // $data = $CI->db->get('qna', ['id' => $id])->row_array();
    // var_dump($data);
    // exit;

    if ( $id == 1 )
    {
        return 1;
    }
    elseif ( $id == 2 )
    {
        return 2;
    }
    else
    {
        return 3;
    }
}