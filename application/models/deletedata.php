<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deletedata extends CI_Model {

    public function delete_data($id,$table){
        $sql = $this->db->where(['row_id'=>$id])
                        ->delete($table);
        return $sql;
    }

}
?>