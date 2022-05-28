<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Issue extends CI_Controller {

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
		$data= 'trans_dt,name,age,sex,city,mob_no,blood_grp,row_id';
		$table = 'bb_issuer_trans';
		$resultlist = $this->Data_select->select_data($data,$table);
		$send = array(
			'resultlist'=>$resultlist
		);
		if ($this->session->userdata('name')) {
			$this->load->view('issue',$send);
		}else{
			redirect('author/index');
		}
   
	
}



//add_issue.php view load here....

public function addissue(){
	$this->load->model('Max_function');
		$table = 'bb_issuer_trans';
		$column = 'trans_no';
		$resultlist1 = $this->Max_function->select_max_data($column,$table);

		$this->load->model('data_select');
		$table = 'bb_product_mst';
		$data = 'prod_nm,row_id';
		$resultlist2 =	$this->data_select->select_data($data,$table);

		$this->load->model('data_select');
		$table = 'bb_donar_brcd_trans';
		$data = 'prod_brcd';
		$resultlist3 =	$this->data_select->select_data($data,$table);
		
		$this->load->model('data_select');
		$table = 'bb_issuer_trans';
		$data = 'prod_brcd';
		$resultlist4 =	$this->data_select->select_data($data,$table);
		


		$count = (count($resultlist4));
		$rl = array_replace_recursive($resultlist3,$resultlist4);
		$array = array_unique($rl, SORT_REGULAR);
		$resultlist5 = array_slice($array,$count);
		
		
		
		$send = array(
			'resultlist1'=>$resultlist1,
			'resultlist2'=>$resultlist2,
			'resultlist3'=>$resultlist3,
			'resultlist5'=>$resultlist5
		);
		if ($this->session->userdata('name')) {
			$this->load->view('add_issue',$send);
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
	$this->form_validation->set_rules('trans_dt','Input','required');

	$this->form_validation->set_rules('father_nm','Input','required');
	$this->form_validation->set_rules('address','Input','required');
	$this->form_validation->set_rules('mob_no','Input','required');
	$this->form_validation->set_rules('prod_id','Input','required');
	$this->form_validation->set_rules('user_cd','Input','required');
	$this->form_validation->set_rules('entered_by','Input','required');

	$this->form_validation->set_rules('update_dt','Input','required');
	$this->form_validation->set_rules('update_flag','Input','required');
	$this->form_validation->set_rules('hospital_nm','Input','required');
	

	$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');

	 if ($this->form_validation->run()) {
		
		$data = $this->input->post();

		$this->load->model('Data_insert');
		$table = 'bb_issuer_trans';
		$result = $this->Data_insert->insert_data($data,$table);

		if ($result) {
			$this->session->set_flashdata('success','Entry submitted successfully!');
			redirect('issue/add_issuee');
		}else{
			?>
			<script>
				alert('Wrong Entry!');
			</script>
			<?php
		}
	 }else{
		$this->session->set_flashdata('error','Entry submitted successfully!');
			redirect('issue/add_issuee');
			
		
	 }
	
 }
 //add donor url function here....

 public function add_issuee(){
	
	$this->load->model('Max_function');
	$table = 'bb_issuer_trans';
	$column = 'trans_no';
	$resultlist1 = $this->Max_function->select_max_data($column,$table);

	$this->load->model('data_select');
	$table = 'bb_product_mst';
	$data = 'prod_nm,row_id';
	$resultlist2 =	$this->data_select->select_data($data,$table);

	$this->load->model('data_select');
	$table = 'bb_donar_brcd_trans';
	$data = 'prod_brcd';
	$resultlist3 =	$this->data_select->select_data($data,$table);

	
	        $this->load->model('data_select');
		$table = 'bb_issuer_trans';
		$data = 'prod_brcd';
		$resultlist4 =	$this->data_select->select_data($data,$table);
		


		$count = (count($resultlist4));
		$rl = array_replace_recursive($resultlist3,$resultlist4);
		$array = array_unique($rl, SORT_REGULAR);
		$resultlist5 = array_slice($array,$count);

		$send = array(
			'resultlist1'=>$resultlist1,
			'resultlist2'=>$resultlist2,
			'resultlist3'=>$resultlist3,
			'resultlist5'=>$resultlist5
		);
	if ($this->session->userdata('name')) {
		$this->load->view('add_issue',$send);
	}else{
		redirect('author/index');
	}
 }


  //Fetch single data for update
public function update(){
	$id = $_GET['/'];
	$this->load->model('Fetch_single');
	$data = 'name,age,sex,address,city,mob_no,blood_grp,hospital_nm,user_cd,update_dt,update_flag,prod_id,prod_brcd,trans_no,trans_dt,father_nm';
	$table = 'bb_issuer_trans';

	if ($this->session->userdata('name')) {
		$result = $this->Fetch_single->fetch_single_data($id,$data,$table);
	}else{
		redirect('author/index');
	}
	

	if($result){

	
	$this->load->model('Max_function');
	$table = 'bb_issuer_trans';
	$column = 'trans_no';
	$resultlist1 = $this->Max_function->select_max_data($column,$table);

	$this->load->model('data_select');
	$table = 'bb_product_mst';
	$data = 'prod_nm,row_id';
	$resultlist2 =	$this->data_select->select_data($data,$table);

	$this->load->model('data_select');
	$table = 'bb_donar_brcd_trans';
	$data = 'prod_brcd';
	$resultlist3 =	$this->data_select->select_data($data,$table);

	$this->load->model('match_password');
	$table = 'bb_product_mst';
	$data = 'prod_nm';
	$pd_id = $result[0]['prod_id'];
	$where = ['row_id'=>$pd_id];
	$resultlist4 =	$this->match_password->check_password($data,$table,$where);

	$count = (count($resultlist4));
	$rl = array_replace_recursive($resultlist3, $resultlist4);
	$array = array_unique($rl, SORT_REGULAR);
	$resultlist5 = array_slice($array, $count);
	
		$send = array(
			'resultlist1'=>$resultlist1,
			'record'=>$result,
			'resultlist2'=>$resultlist2,
			'resultlist3'=>$resultlist3,
			'resultlist4'=>$resultlist4,
			'resultlist5'=>$resultlist5
		);
		if ($this->session->userdata('name')) {
			$this->load->view('add_issue',$send);
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
		$this->form_validation->set_rules('prod_brcd','Input','required');

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
		$hospital_nm = $this->input->post('hospital_nm');
		$update_dt = $this->input->post('update_dt');
		$update_flag = $this->input->post('update_flag');
		$prod_id = $this->input->post("prod_id");
		$user_cd = $this->input->post('user_cd');
		$prod_brcd = $this->input->post('prod_brcd');
		$father_nm = $this->input->post('father_nm');
		$data = array(
			'name'=>$name,
			'age'=>$age,
			'sex'=>$sex,
			'city'=>$city,
			'blood_grp'=>$blood_grp,
			'mob_no'=>$mob_no,
			'hospital_nm'=>$hospital_nm,
			'prod_id'=>$prod_id,
			'address'=>$address,
			'prod_brcd'=>$prod_brcd,
			'father_nm'=>$father_nm,
			'user_cd'=>$user_cd,
			'update_dt'=>$update_dt,
			'update_flag'=>$update_flag
		 );
		$table = 'bb_issuer_trans';
		$this->load->model('Updatedata');
		$success = $this->Updatedata->update_data($table,$data,$id);
		if ($success==true) {
			$this->session->set_flashdata('updated','Entry updated successfully!');
			redirect('issue/index');
		}else{
			$this->session->set_flashdata('updated_failed','Entry not updated!');
			redirect('issue/index');
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
   $table='bb_issuer_trans';
   $this->deletedata->delete_data($id,$table);
   $this->session->set_flashdata('deleted','Entry deleted successfully!');
   redirect('issue/index');
}
}