<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
public function index(){
   if ($this->session->userdata('name')) {
       $this->load->view('profile');
   }else{
       redirect('author/index');
   }
}
}
?>