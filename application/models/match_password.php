<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Match_password extends CI_Model {

    public function check_password($data,$table,$where){
    $sql = $this->db->select($data)
                    ->from($table)
                    ->where($where)
                    ->get();

    if ($sql) {
        return $sql->row_array();
    }else{
        return false;
    }
    }

}
?>