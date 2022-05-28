<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Author extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/userguide3/general/urls.html
     */

    public function __construct()
    {
        parent::__construct();
        $this->load->model('login');
    }
    public function index()
    {
        $this->form_validation->set_rules('id', 'Input', 'required');
        $this->form_validation->set_rules('password', 'Input', 'required');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

        if ($this->form_validation->run()) {
            $id = $this->input->post('id');
            $pass = $this->input->post('password');

            $check = $this->login->Login_validate($id, $pass);
            if ($check) {
                $row_id = $check[0]['row_id'];
                $name = $check[0]['name'];
                $user_id = $check[0]['id'];
                $email = $check[0]['email_id'];
                $this->session->set_userdata('row_id', $row_id);
                $this->session->set_userdata('name', $name);
                $this->session->set_userdata('user_id', $user_id);
                $this->session->set_userdata('email_id', $email);
                redirect('dashboard/index');
            } else {
?>
                <script>
                    alert('Please Enter valid user id or password');
                </script>
<?php
            }
        } else {
            echo 'login failed';
        }
        //login view load here...

        $this->load->view('login');
    }
}
