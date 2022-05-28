<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Max_function extends CI_Model {

    public function select_max_data($coloumn,$table){
    $sql = $this->db->select_max($coloumn)
                    ->from($table)
                    ->get();

    if ($sql) {
        return $sql->row_array();
    }else{
        return false;
    }
    }

}
?>