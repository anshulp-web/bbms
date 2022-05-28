<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fetch_single extends CI_Model {

    public function fetch_single_data($id,$data,$table){
        $sql = $this->db->select($data)
                        ->from($table)
                        ->where(['row_id'=>$id])
                        ->get();

                        if ($sql) {
                            return $sql->result_array();
                        }else{
                            return false;
                        }
    }

}
?>