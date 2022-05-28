<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Model {

    public function Login_validate($user_id,$pass){
       $sql = $this->db->select('id,row_id,name,password,email_id')
                 ->where(['id'=>$user_id,'password'=>$pass])
                 ->get('sysmmsuser');

                 if ($sql) {
                    return $sql->result_array();
                 }else{
                     return false;
                 }
    }
}

?>