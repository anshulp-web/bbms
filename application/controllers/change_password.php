<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Change_password extends CI_Controller {
    
public function index(){
   if ($this->session->userdata('name')) {
       $this->load->view('change_password');
   }else{
       redirect('author/index');
   }
}

public function change(){
    if ($this->session->userdata('name')) {
        $this->form_validation->set_rules('old_password','Input','required');
        $this->form_validation->set_rules('password','Input','required');
        $this->form_validation->set_rules('id','Input','required');

        if ($this->form_validation->run()) {
           $old_password = $this->input->post('old_password');
           $password = $this->input->post('password');
            $id = $this->input->post('id');
           $this->load->model('Match_password');
           $data = 'password';
           $table = 'sysmmsuser';
           $where = ['password'=>$old_password,'id'=>$id];
           $result = $this->Match_password->check_password($data,$table,$where);
           $pass = $result['password'];
           if ($old_password === $password) {
            $this->session->set_flashdata('match_error','old password and new password are same!');
            redirect('change_password/index');
           }else{
           if ($pass === $old_password) {
              $data = array(
                  'password'=>$password
              );
              $table = 'sysmmsuser';
              $where =['password'=>$old_password,'id'=>$id];
              $this->load->model('Forgot_password');
              $success = $this->Forgot_password->update_password($data,$table,$where);
              if ($success) {
                $this->session->set_flashdata('success','Password changed successfully!');
                redirect('change_password/index');
              }else{
                $this->session->set_flashdata('error','Password not changed!');
                redirect('change_password/index');
              }
           }else{
            $this->session->set_flashdata('not_match_password','Wrong old password!');
            redirect('change_password/index');
           }
           }
        }else{
            $this->session->set_flashdata('form_error','All field are required');
            redirect('change_password/index');
        }
    }else{
        redirect('author/index');
    }
}

}
?>