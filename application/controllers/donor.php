<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donor extends CI_Controller {

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
		$this->load->model('Data_select');
		$data= 'trans_dt,name,age,sex,city,mob_no,blood_grp,bag_type,row_id';
		$table = 'bb_donar_trans';
		$resultlist1 = $this->Data_select->select_data($data,$table);
		$send = array(
			'resultlist1'=>$resultlist1
		);
		if ($this->session->userdata('name')) {
			$this->load->view('donor',$send);
		}else{
			redirect('author/index');
		}
	 
     }


     //adddonor view load here...
     public function adddonor(){
		$this->load->model('Max_function');
		$table = 'bb_donar_trans';
		$column = 'trans_no';
		$resultlist1 = $this->Max_function->select_max_data($column,$table);

		$send = array(
			'resultlist1'=>$resultlist1
		);
		if ($this->session->userdata('name')) {
			$this->load->view('add_donor',$send);
		}else{
			redirect('author/index');
		}
         
     }


	 //Add new donor function here....

	 public function addproduct_i(){
		$this->form_validation->set_rules('name','Input','required');
		$this->form_validation->set_rules('trans_no','Input','required');
		$this->form_validation->set_rules('age','Input','required');
		$this->form_validation->set_rules('sex','Input','required');
		$this->form_validation->set_rules('city','Input','required');
		$this->form_validation->set_rules('blood_grp','Input','required');
		$this->form_validation->set_rules('bag_type','Input','required');
		$this->form_validation->set_rules('trans_dt','Input','required');

		$this->form_validation->set_rules('age','Input','required');
		$this->form_validation->set_rules('address','Input','required');
		$this->form_validation->set_rules('mob_no','Input','required');
		$this->form_validation->set_rules('int_tub_no','Input','required');
		$this->form_validation->set_rules('user_cd','Input','required');
		$this->form_validation->set_rules('entered_by','Input','required');

		$this->form_validation->set_rules('update_dt','Input','required');
		$this->form_validation->set_rules('update_flag','Input','required');
		$this->form_validation->set_rules('prod_id','Input','required');
		$this->form_validation->set_rules('exp_days','Input','required');
		$this->form_validation->set_rules('exp_dt','Input','required');

		$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');

		 if ($this->form_validation->run()) {
			
			$data = $this->input->post();

			$this->load->model('Data_insert');
			$table = 'bb_donar_trans';
			$result = $this->Data_insert->insert_data($data,$table);

			if ($result) {
				$this->session->set_flashdata('success','Entry submitted successfully!');
				redirect('donor/add_donorr');
			}else{
				?>
				<script>
					alert('Wrong Entry!');
				</script>
				<?php
			}
		 }else{
			$this->session->set_flashdata('error','Entry submitted successfully!');
				redirect('donor/add_donorr');
				
			
		 }
		
	 }
	 //add donor url function here....

	 public function add_donorr(){
		$this->load->model('Max_function');
		$table = 'bb_donar_trans';
		$column = 'trans_no';
		$resultlist1 = $this->Max_function->select_max_data($column,$table);

		$this->load->model('All_data');
		$data= 'exp_dt';
		$table = 'bb_donar_brcd_trans';
		$resultlist2 = $this->All_data->select_all_data($data,$table);
		$send = array(
			'resultlist1'=>$resultlist1,
			'resultlist2'=>$resultlist2
		);
		if ($this->session->userdata('name')) {
			$this->load->view('add_donor',$send);
		}else{
			redirect('author/index');
		}
         
	 }


	 //Fetch single data for update
public function update(){
	$id = $_GET['/'];
	$this->load->model('Fetch_single');
	$data = 'name,age,sex,address,city,mob_no,blood_grp,bag_type,user_cd,update_dt,update_flag,int_tub_no,trans_no,trans_dt';
	$table = 'bb_donar_trans';

	if ($this->session->userdata('name')) {
		$result = $this->Fetch_single->fetch_single_data($id,$data,$table);
	}else{
		redirect('author/index');
	}
	

	if($result){

	
		$this->load->model('Max_function');
		$table = 'bb_donar_trans';
		$column = 'trans_no';
		$resultlist1 = $this->Max_function->select_max_data($column,$table);
		$send = array(
			'resultlist1'=>$resultlist1,
			'record'=>$result
		);
		if ($this->session->userdata('name')) {
			$this->load->view('add_donor',$send);
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
			
	    $this->form_validation->set_rules('name','Input','required');
		$this->form_validation->set_rules('age','Input','required');
		$this->form_validation->set_rules('sex','Input','required');
		$this->form_validation->set_rules('city','Input','required');
		$this->form_validation->set_rules('blood_grp','Input','required');
		$this->form_validation->set_rules('bag_type','Input','required');

		// $this->form_validation->set_rules('address','Input','required');
		// $this->form_validation->set_rules('mob_no','Input','required');
		// $this->form_validation->set_rules('int_tub_no','Input','required');
		// $this->form_validation->set_rules('user_cd','Input','required');
		

		// $this->form_validation->set_rules('update_dt','Input','required');
		// $this->form_validation->set_rules('update_flag','Input','required');
	

		$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
	if ($this->form_validation->run()) {
		$id = $this->input->post('hidden_ipt');
		$name = $this->input->post("name");
		$age = $this->input->post("age");
		$sex = $this->input->post("sex");
		$city = $this->input->post("city");
		$blood_grp = $this->input->post('blood_grp');
		$address = $this->input->post('address');
		$mob_no = $this->input->post('mob_no');
		$int_tub_no = $this->input->post('int_tub_no');
		$update_dt = $this->input->post('update_dt');
		$update_flag = $this->input->post('update_flag');
		$bag_type = $this->input->post("bag_type");
		$user_cd = $this->input->post('user_cd');
		$data = array(
			'name'=>$name,
			'age'=>$age,
			'sex'=>$sex,
			'city'=>$city,
			'blood_grp'=>$blood_grp,
			'mob_no'=>$mob_no,
			'int_tub_no'=>$int_tub_no,
			'bag_type'=>$bag_type,
			'address'=>$address,
			'user_cd'=>$user_cd,
			'update_dt'=>$update_dt,
			'update_flag'=>$update_flag
		 );
		$table = 'bb_donar_trans';
		
		$this->load->model('Updatedata');
		$success = $this->Updatedata->update_data($table,$data,$id);
		if ($success==true) {
			$this->session->set_flashdata('updated','Entry updated successfully!');
			redirect('donor/index');
		}else{
			$this->session->set_flashdata('updated_failed','Entry not updated!');
			redirect('donor/index');
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

//Add product update form url here..........
public function delete(){
	$id = $_GET['/'];
   $this->load->model('deletedata');
   $table='bb_donar_trans';
   $this->deletedata->delete_data($id,$table);
   $this->session->set_flashdata('deleted','Entry deleted successfully!');
   redirect('donor/index');
}

//Report

public function rpt(){
	$this->load->view('rw_chl_reg.xml');
}
}