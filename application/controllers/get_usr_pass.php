<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_usr_pass extends CI_Controller {
    
public function index(){
   if ($this->session->userdata('name')) {
       $this->load->view('get_usr_pass');
   }else{
       redirect('author/index');
   }
}

public function get_pass(){
      $this->form_validation->set_rules('id','Input','required');
      if ($this->form_validation->run()) {
              $user_id = $this->input->post('id');

              $this->load->model('match_password');
              $data = 'password,id';
              $table ='sysmmsuser';
              $where =  ['id'=>$user_id];
             $result = $this->match_password->check_password($data,$table,$where);
             $user_password = $result['password'];
             $id = $result['id'];

             if ($id === $user_id) {
                
                $this->session->set_flashdata('user_password',$user_password);
                redirect('get_usr_pass/index');
             }else{
                $this->session->set_flashdata('not_match_password','Wrong user id!');
                redirect('get_usr_pass/index');  
             }

      }else{
              $this->session->set_flashdata('form_error','All field are required!');
              redirect('get_usr_pass/index');
      }
}

}
?>