<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_insert extends CI_Model {

    public function insert_data($data,$table){
    $sql = $this->db->insert($table,$data);

    if ($sql) {
        return true;
    }else{
        return false;
    }
    }

}
?>