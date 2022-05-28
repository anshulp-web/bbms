<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot_password extends CI_Model {

    public function update_password($table,$data,$where){
        $sql = $this->db->update($data,$table,$where);
        return $sql;
    }

}
?>