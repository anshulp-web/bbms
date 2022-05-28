<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_user extends CI_Controller {
public function index(){
   if ($this->session->userdata('name')) {
       $this->load->view('add_user');
   }else{
       redirect('author/index');
   }
}

public function add(){
    if ($this->session->userdata('name')) {
    $this->load->model('Data_insert');
    $data = $this->input->post();
    $table = 'sysmmsuser';
    $success = $this->Data_insert->insert_data($data,$table);
    if ($success) {
       $this->session->set_flashdata('success','New user add successfully!');
       redirect('add_user/index');
    }else{
        $this->session->set_flashdata('error','New user not added!');
        redirect('add_user/index');
    }
}else{
    redirect('author/index');
}
}
}
?>