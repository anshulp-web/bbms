<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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

     public function index(){
		 if ($this->session->userdata('name')) {
			
			$this->load->model('Comp_nm');
			$comp = $this->Comp_nm->company_data();
			$company_nm = $comp[0]['comp_nm'];
		    $this->session->set_userdata('company_nm',$company_nm);

			$this->load->model('Data_select');
			$data = '*';
			$table = 'bb_product_mst';

			$resultlist = $this->Data_select->select_data($data,$table);
            //  print_r($resultlist);	
			if ($this->session->userdata('name')) {
				$this->load->view('dashboard',['result_data'=>$resultlist]);
			}else{
				redirect('author/index');
			}
			
		 }else{
			 $this->load->view('login');
		 }
        
     }
    

//Fetch single data for update
public function update(){
	    $id = $_GET['/'];
		$this->load->model('Fetch_single');
		$data = 'prod_nm,exp_days,temp,bag_type,user_cd,update_dt,update_flag';
		$table = 'bb_product_mst';
		if ($this->session->userdata('name')) {
			$result = $this->Fetch_single->fetch_single_data($id,$data,$table);
		}else{
			redirect('author/index');
		}
		
	
		if($result){
			if ($this->session->userdata('name')) {
				$this->load->view('product',['record'=>$result]);
			}else{
				redirect('author/index');
			}
         
		}else{
			echo "something went wrong";
		}
}
//Update Data here....

public function updated(){
	if ($this->session->userdata('name')) {
		
	// $this->load->view('product');
	$this->form_validation->set_rules('prod_nm', 'Input', 'required'); 
	$this->form_validation->set_rules('exp_days', 'Input', 'required');
	$this->form_validation->set_rules('temp', 'Input', 'required');
	$this->form_validation->set_rules('bag_type','Input','required');
	$this->form_validation->set_rules('user_cd','Input','required');
	$this->form_validation->set_rules('update_dt','Input','required');
	$this->form_validation->set_rules('update_flag','Input','required');
	$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>'); 
	if ($this->form_validation->run()) {
		$id = $this->input->post('hidden_ipt');
		$prod_nm = $this->input->post("prod_nm");
		$exp_days = $this->input->post("exp_days");
		$temp = $this->input->post("temp");
		$bag_type = $this->input->post("bag_type");
		$user_cd = $this->input->post('user_cd');
		$update_dt = $this->input->post('update_dt');
		$update_flag = $this->input->post('update_flag');

		// $this->load->model('Match_password');
		// $data = 'prod_nm';
		// $table = 'bb_product_mst';
		// $where = ['prod_nm'=>$prod_nm];
		// $result = $this->Match_password->check_password($data,$table,$where);
		// $prod = $result['prod_nm'];

		$data = array(
		   'prod_nm'=>$prod_nm,
		   'exp_days'=>$exp_days,
		   'temp'=>$temp,
		   'bag_type'=>$bag_type,
		   'user_cd'=>$user_cd,
		   'update_dt'=>$update_dt,
		   'update_flag'=>$update_flag
		);
		$table = 'bb_product_mst';
		
		$this->load->model('Updatedata');
		$success = $this->Updatedata->update_data($table,$data,$id);
		if ($success==true) {
			$this->session->set_flashdata('updated','Entry updated successfully!');
			redirect('dashboard/index');
		}else{
			$this->session->set_flashdata('updated_failed','Entry not updated!');
			redirect('dashboard/index');
		}
	
	}else{
		?>
		<script>
			alert("All field are required");
		</script>
		<?php
	} 
   }else{
	   redirect('author/index');
   }
}
	 //product.php view load here...

	 public function addproduct(){
		if ($this->session->userdata('name')) {
			$this->load->view('product');
		}else{
			redirect('author/index');
		}
		
	 }



	 //Add product form insertion here...

	 public function addproduct_i(){
		$this->form_validation->set_rules('prod_nm','Input','required');
		$this->form_validation->set_rules('temp','Input','required');
		$this->form_validation->set_rules('exp_days','Input','required');
		$this->form_validation->set_rules('bag_type','Input','required');
		$this->form_validation->set_rules('user_cd','Input','required');
		$this->form_validation->set_rules('entered_by','Input','required');
		$this->form_validation->set_rules('update_dt','Input','required');
		$this->form_validation->set_rules('update_flag','Input','required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');

		 if ($this->form_validation->run()) {
			
			$prod_nm = $this->input->post("prod_nm");
			$bag_type = $this->input->post("bag_type");
			$this->load->model('Match_password');
			$data = 'prod_nm';
			$table = 'bb_product_mst';
			$where = ['prod_nm'=>$prod_nm];
			$result = $this->Match_password->check_password($data,$table,$where);
			$prod = $result['prod_nm'];
		        $bag = $result['bag_type'];
		   if ($prod = $prod_nm ) {
			$this->session->set_flashdata('duplicate','This product name aleready exist!');
			redirect('dashboard/addproduct');
		   }else{
			$data = $this->input->post();
			$this->load->model('Data_insert');
			$table = 'bb_product_mst';
			$result = $this->Data_insert->insert_data($data,$table);
			
			if ($result) {
				$this->session->set_flashdata('success','Entry submitted successfully!');
				redirect('dashboard/addproduct');
			}else{
				?>
				<script>
					alert('Wrong Entry!');
				</script>
				<?php
			}
		}
		 }else{
			$this->load->view('product');
		 }
		
	 }
    
	 //Add product update form url here..........
	 public function delete(){
	 	$id = $_GET['/'];
		$this->load->model('deletedata');
		$table='bb_product_mst';
		$this->deletedata->delete_data($id,$table);
		$this->session->set_flashdata('deleted','Entry deleted successfully!');
		redirect('dashboard/index');
	 }
	
}
?>