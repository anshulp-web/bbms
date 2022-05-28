<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_select extends CI_Model {

    public function select_data($data,$table){
    $sql = $this->db->select($data)
                    ->from($table)
                    ->order_by('row_id','DESC')
                    ->get();

    if ($sql) {
        return $sql->result_array();
    }else{
        return false;
    }
    }

}
?>