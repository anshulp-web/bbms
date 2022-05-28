<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comp_nm extends CI_Model {

   
    public function company_data(){
        $sql = $this->db->select('*')
                        ->from('gnmscomp')
                        ->get();
        if ($sql) {
            return $sql->result_array();
        }else{
            return false;
        }
        }

}
?>