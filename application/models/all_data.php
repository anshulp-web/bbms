<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class All_data extends CI_Model {

    public function select_all_data($data,$table){
    $sql = $this->db->select($data)
                    ->from($table)
                    ->get();

    if ($sql) {
        return $sql->result_array();
    }else{
        return false;
    }
    }

}
?>