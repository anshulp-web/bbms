<!-- include dashboard header here..... -->
<?php include 'layout/dashboard_header.php' ?>
<?php 
                                if ($this->session->flashdata('success')) {
                                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                    <h6 style='color:white;text-align:center;'>Entry inserted successfully!</h6>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                    </div>";
                                }
                                if ($this->session->flashdata('error')) {
                                    echo "<div class='alert alert-danger alert-dismissible fade show red' role='alert'>
                                    <h6 style='color:white;text-align:center;'>All field are required!</h6>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                    </div>";
                                }
                               
                                ?>
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-title">
                                    <h4 style="color:orange;">Add Donor</h4>
                                </div>
                                <div class="card-body">
                                    <div class="basic-elements">
                                       <?php 
                                        if (isset($_GET['/'])) {
                                         $data = array('id'=>'add_product');
                                          echo form_open('donor/updated',$data);
                                        }else{
                                            $data = array('id'=>'add_product');
                                          echo form_open('donor/addproduct_i',$data);
                                        }
                                        ?>
                                        <div class="pm_action_div">
                                        <?php 
                                        
                                        if (isset($_GET['/'])) {
                                            $data = array('class'=>'btn btn-primary');
                                            echo anchor('donor/adddonor','New',$data);
                                        }else{
                                           
                                            $data = array('value'=>'New','class'=>'btn btn-primary');
                                            echo form_reset($data);
                                        }
                                        ?>
                                       <!--  <input type="reset" value="New" class="btn btn-primary"> -->
                                        <a href="<?php echo base_url('donor/index')?>" class="btn btn-secondary"><i class="ti-search"></i>&nbsp;&nbsp;Browse</a>
                                        <a href="" class="btn btn-info"><i class="ti-save-alt"></i>&nbsp;&nbsp;Report</a>
                                        </div>
                                        <?php

                                          $trans = $resultlist1['trans_no'];
                                          $trans_no = $trans + 1;
                                        
                                        ?>
                                        <?php 
                                          if (isset($_GET['/'])) {
                                           
                                            $id = $_GET['/'];
                                            $data = array('type'=>'hidden','value'=>$id,'name'=>'hidden_ipt','id'=>'hidden_ipt');
                                            echo form_input($data);
                                        
                                            foreach ($record as $value) {
                                              $name = $value['name'];
                                              $age = $value['age'];
                                              $sex = $value['sex'];
                                              $address = $value['address'];
                                              $city = $value['city'];
                                              $mob_no = $value['mob_no'];
                                              $blood_grp = $value['blood_grp'];
                                              $bag_type = $value['bag_type'];
                                              $int_tub_no = $value['int_tub_no'];
                                              $user_cd = $value['user_cd'];
                                              $tr_no = $value['trans_no'];
                                              $date = $value['trans_dt'];
                                            }
                                          }
                                          ?>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>No</label>
                                                 <?php 
                                                  if (isset($_GET['/'])) {
                                                     echo "<input type='number' class='form-control' value='$tr_no' readonly name='trans_no' id='trans_no'>";
                                                  }else{
                                                      echo "<input type='number' class='form-control' value='$trans_no' readonly name='trans_no' id='trans_no'>";
                                                  }
                                                  ?>   
                                                    </div>
                                                    
                                                     <div class="form-group">
                                                        <label>Name</label>
                                                <?php 
                                                  if (isset($_GET['/'])) {
                                                    echo "<input id='' class='form-control' type='text' name='name' autocomplete='off' value='$name' id='name' tabindex=1>";
                                                  }else{
                                                      echo '<input id="" class="form-control" type="text" name="name" autocomplete="off" id="name" tabindex=1>';
                                                  }
                                                  ?>
                                                       
                                                    </div>
                                                    <div>
                                                        <?php //echo form_error('name')?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Gender</label>
                                                <?php 
                                                  if (isset($_GET['/'])) {
                                                     echo ' <select class="form-control" name="sex" id="sex" required  tabindex=3>
                                                            <option value='.$sex.'>'.$sex.'</option>
                                                            <option value="male">Male</option>
                                                            <option value="female">Female</option>
                                                            
                                                        </select>';
                                                  }else{
                                                      echo '<select class="form-control" name="sex" id="sex" required tabindex=3>
                                                      <option value="male">Male</option>
                                                      <option value="female">Female</option>
                                                            
                                                        </select>';
                                                  }
                                                  ?>
                                                       
                                                    </div>
                                                    <div>
                                                        <?php echo form_error('sex')?>
                                                    </div>
                                                     <div class="form-group">
                                                        <label>City</label>

                                                <?php 
                                                  if (isset($_GET['/'])) {
                                                     $data = array('type'=>'text','class'=>'form-control','name'=>'city','value'=>$city,'autocomplete'=>'off','id'=>'city','tabindex'=>'5');
                                                     echo form_input($data);
                                                  }else{
                                                      echo '<input id="city" class="form-control" type="text" placeholder="" name="city" autocomplete="off" id="city" tabindex=5>';
                                                  }
                                                  ?>
                                                        
                                                    </div>
                                                    <div>
                                                        <?php //echo form_error('city')?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Blood Group</label>
                                                <?php 
                                                  if (isset($_GET['/'])) {
                                                     echo ' <select class="form-control" name="blood_grp" id="blood_grp" required tabindex=7>
                                                            <option value='.$blood_grp.'>'.$blood_grp.'</option>
                                                            <option value="A+">A+</option>
                                                            <option value="A-">A-</option>
                                                            <option value="B+">B+</option>
                                                            <option value="B-">B-</option>
                                                            <option value="O+">O+</option>
                                                            <option value="O-">O-</option>
                                                            <option value="AB+">AB+</option>
                                                            <option value="AB-">AB-</option>
                                                        </select>';
                                                  }else{
                                                      echo '<select class="form-control" name="blood_grp" id="blood_grp" required tabindex=7>
                                                      <option value="A+">A+</option>
                                                      <option value="A-">A-</option>
                                                      <option value="B+">B+</option>
                                                      <option value="B-">B-</option>
                                                      <option value="O+">O+</option>
                                                      <option value="O-">O-</option>
                                                      <option value="AB+">AB+</option>
                                                      <option value="AB-">AB-</option>
                                                        </select>';
                                                  }
                                                  ?>
                                                       
                                                    </div>
                                                    <div>
                                                        <?php echo form_error('blood_grp')?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Bag Type</label>
                                                <?php 
                                                  if (isset($_GET['/'])) {
                                                     echo '<select class="form-control" name="bag_type" id="bag_type" required tabindex=9>
                                                           
                                                     <option value='.$bag_type.'>'.$bag_type.'</option>
                                                     <option value="Single">Single</option>
                                                      <option value="Double">Double</option>
                                                      <option value="Triple">Triple</option>
                                                      <option value="Quardruple">Quardruple</option>
                                                 </select>';
                                                  }else{
                                                      echo '<select class="form-control" name="bag_type" id="bag_type" required tabindex=9>
                                                           
                                                      <option value="Single">Single</option>
                                                      <option value="Double">Double</option>
                                                      <option value="Triple">Triple</option>
                                                      <option value="Quardruple">Quardruple</option>
                                                  </select>';
                                                  }
                                                  ?>
                                                    </div>

                                                </div>
                                                <div>
                                                        <?php echo form_error('bag_type')?>
                                                    </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Date</label>
                                                <?php 
                                                $dt = date('Y-m-d');
                                                  if (isset($_GET['/'])) {
                                                     $data = array('type'=>'date','class'=>'form-control','name'=>'trans_dt','value'=>$date,'id'=>'trans_dt');
                                                     echo form_input($data);
                                                  }else{
                                                      echo "<input class='form-control' type='date' value='$dt' name='trans_dt' id='trans_dt'>";
                                                  }
                                                  ?>
                                                        
                                                    </div>
                                                    <div>
                                                        <?php //echo form_error('trans_dt')?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Age</label>
                                                <?php 
                                                  if (isset($_GET['/'])) {
                                                     $data = array('type'=>'number','class'=>'form-control','name'=>'age','value'=>$age,'autocomplete'=>'off','id'=>'age', 'tabindex'=>'2');
                                                     echo form_input($data);
                                                  }else{
                                                      echo ' <input class="form-control" type="number" value="" autocomplete="off" name="age" id="age" tabindex=2>';
                                                  }
                                                  ?>
                                                       
                                                    </div>
                                                    <div>
                                                        <?php //echo form_error('age')?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                <?php 
                                                  if (isset($_GET['/'])) {
                                                     $data = array('type'=>'text','class'=>'form-control','name'=>'address','value'=>$address,'autocomplete'=>'off','id'=>'address','tabindex'=>'4');
                                                     echo form_input($data);
                                                  }else{
                                                      echo '<input class="form-control" type="text" autocomplete="off" name="address" id="address" tabindex=4>';
                                                  }
                                                  ?>
                                                        
                                                    </div>
                                                    <div>
                                                        <?php //echo form_error('address')?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Mobile No.</label>
                                                <?php 
                                                  if (isset($_GET['/'])) {
                                                     $data = array('type'=>'number','class'=>'form-control','name'=>'mob_no','value'=>$mob_no,'autocomplete'=>'off','id'=>'mob_no','tabindex'=>'6');
                                                     echo form_input($data);
                                                  }else{
                                                      echo '<input class="form-control" type="number" autocomplete="off" name="mob_no" id="mob_no" tabindex=6>';
                                                  }
                                                  ?>
                                                        
                                                    </div>
                                                    <div>
                                                        <?php //echo form_error('mob_no')?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Integral Tube No</label>
                                                <?php 
                                                  if (isset($_GET['/'])) {
                                                     $data = array('type'=>'text','class'=>'form-control','name'=>'int_tub_no','value'=>$int_tub_no,'autocomplete'=>'off','id'=>'int_tub_no','tabindex'=>'8');
                                                     echo form_input($data);
                                                  }else{
                                                      echo '<input class="form-control" type="text" autocomplete="off" name="int_tub_no" id="int_tub_no" tabindex=8>';
                                                  }
                                                  ?>
                                                    
                                                    </div>
                                                    <div>
                                                        <?php //echo form_error('int_tube_no')?>
                                                    </div>
                                                    <div class="form-group" hidden>
                                                        <?php 
                                                        $name = $this->session->userdata('name');
                                                        ?>
                                                        <label>user_cd</label>
                                                        <input type="text" class="form-control" value="<?php echo $name?>" name="user_cd" id="user_cd">
                                                    </div>
                                                    <div class="form-group" hidden>
                                                        <?php 
                                                        $name = $this->session->userdata('name');
                                                        ?>
                                                        <label>entered_by</label>
                                                        <input type="text" class="form-control" value="<?php echo $name?>" name="entered_by">
                                                    </div>
                                                </div>
                                                <div class="form-group" hidden>
                                                        <label>update_dt</label>
                                                        <?php $dt = date('Y-m-d');?>
                                                        <input type="text" class="form-control" value="<?php echo $dt ?>" name="update_dt" id="update_dt"
                                                        >
                                                    </div>
                                                    <div class="form-group" hidden >
                                                        <label>update_flag</label>
                                                        <input type="text" class="form-control" value="Y" name="update_flag" id="update_flag">
                                                    </div>
                                                    <div class="form-group" hidden>
                                                        <label>prod_id</label>
                                                        <input type="text" class="form-control" value="0" name="prod_id" id="">
                                                    </div>
                                                    <div class="form-group" hidden>
                                                        <label>exp_days</label>
                                                        <input type="text" class="form-control" value="0" name="exp_days" id="">
                                                    </div>
                                                    <div class="form-group" hidden>
                                                        <label>exp_dt</label>
                                                        <input type="text" class="form-control" value="0000-00-00" name="exp_dt" id="">
                                                    </div>
                                            </div>
                                            <div class="pm_save_div">
                                                <?php 
                                                if (isset($_GET['/'])) {
                                            
                                                echo '<button type="submit" class="btn btn-success pm_save"><i class="ti-save"></i>&nbsp;&nbsp;Update</button>';
                                                }else{
                                                    echo '<button type="submit" class="btn btn-success pm_save"><i class="ti-save"></i>&nbsp;&nbsp;Save</button>';
                                                }
                                                ?>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
                </div>
<!-- include dashboard footer here..... -->
<?php include 'layout/dashboard_footer.php' ?>

