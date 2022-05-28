<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Updatedata extends CI_Model {

    public function update_data($table,$data,$id){
        $sql = $this->db->update($table,$data,['row_id'=>$id]);
        return $sql;
    }

}
?>