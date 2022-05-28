<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Duplicate extends CI_Model {

    public function check_duplicate($prod_nm,$bag_type){
       $sql = $this->db->select('prod_nm,bag_type')
                 ->where(['prod_nm'=>$prod_nm,'bag_type'=>$bag_type])
                 ->get('bb_product_mst');

                 if ($sql) {
                    return $sql->result_array();
                 }else{
                     return false;
                 }
    }
}

?>