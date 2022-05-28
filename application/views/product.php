<!-- include dashboard header here..... -->
<?php include 'layout/dashboard_header.php';
include 'layout/form_validation.php' ?>
<?php 
                                if ($this->session->flashdata('success')) {
                                    echo "<div class='alert alert-success alert-dismissible fade show green' role='alert'>
                                    <h6 style='color:white;text-align:center;'>Entry inserted successfully!</h6>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                    </div>";
                                }
                                if ($this->session->flashdata('duplicate')) {
                                    echo "<div class='alert alert-danger alert-dismissible fade show red' role='alert'>
                                    <h6 style='color:white;text-align:center;'>This product name aleready exist!</h6>
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
                        <div class="col-lg-8">
                            <div class="card">
                            <div class="card-title">
                                    <h4 style="color:orange;">Product Master</h4>
                                </div>
                               
                                <div class="card-body">
                                    <div class="basic-elements">
                                        <?php 
                                        if (isset($_GET['/'])) {
                                         $data = array('id'=>'add_product');
                                          echo form_open('dashboard/updated',$data);
                                        }else{
                                            $data = array('id'=>'add_product');
                                          echo form_open('dashboard/addproduct_i',$data);
                                        }
                                        ?>
                                        <div class="pm_action_div">
                                        <?php 
                                        
                                        if (isset($_GET['/'])) {
                                            $data = array('class'=>'btn btn-primary');
                                            echo anchor('dashboard/addproduct','New',$data);
                                        }else{
                                           
                                            $data = array('value'=>'New','class'=>'btn btn-primary');
                                            echo form_reset($data);
                                        }
                                        ?>
                                        <!-- <input type="reset" value="New" class="btn btn-primary"> -->
                                        <a href="<?php echo base_url('dashboard/index')?>" class="btn btn-secondary"><i class="ti-search"></i>&nbsp;&nbsp;Browse</a>
                                        <a href="" class="btn btn-info"><i class="ti-save-alt"></i>&nbsp;&nbsp;Report</a>
                                        </div>
                                        <?php 
                                          if (isset($_GET['/'])) {
                                            $id = $_GET['/'];
                                            $data = array('type'=>'hidden','value'=>$id,'name'=>'hidden_ipt','id'=>'hidden_ipt');
                                            echo form_input($data);
                                           
                                            foreach ($record as $value) {
                                               $prod = $value['prod_nm'];
                                               $temp = $value['temp'];
                                               $exp_days = $value['exp_days'];
                                               $bag_type = $value['bag_type'];
                                            }
                                          }
                                          ?>
                                          
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Product Name</label>
                                                  <?php 
                                                  if (isset($_GET['/'])) {
                                                     $data = array('type'=>'text','class'=>'form-control','name'=>'prod_nm','value'=>$prod,'autocomplete'=>'off','tabindex'=>'1');
                                                     echo form_input($data);
                                                  }else{
                                                      echo ' <input class="form-control" type="text" placeholder="" name="prod_nm" autocomplete="off" id="prod_nm" value="" tabindex=1>';
                                                  }
                                                  ?>
                                                    </div>
                                                    <div>
                                                        <?php echo form_error('prod_nm')?>
                                                    </div>
                                                     <div class="form-group">
                                                        <label>Temperature</label>
                                                <?php 
                                                  if (isset($_GET['/'])) {
                                                     $data = array('type'=>'text','class'=>'form-control','name'=>'temp','value'=>$temp,'autocomplete'=>'off','id'=>'temp','tabindex'=>'3');
                                                     echo form_input($data);
                                                  }else{
                                                      echo '<input class="form-control" type="text" placeholder="" name="temp" autocomplete="off" id="temp" value="" tabindex=3> ';
                                                  }
                                                  ?>
                                                      
                                                    </div>
                                                    <div>
                                                        <?php echo form_error('temp')?>
                                                    </div>
                                                </div>
                                                
                                               
                                                <div class="col-lg-4">
                                                
                                                    <div class="form-group">
                                                        
                                                        <label>Expiry Days</label>
                                                        
                                                <?php 
                                                  if (isset($_GET['/'])) {
                                                     $data = array('type'=>'number','class'=>'form-control','name'=>'exp_days','value'=>$exp_days,'autocomplete'=>'off','id'=>'exp_days','tabindex'=>'2');
                                                     echo form_input($data);
                                                  }else{
                                                      echo '<input class="form-control" type="number" value="" name="exp_days" autocomplete="off" id="exp_days" tabindex=2>';
                                                  }
                                                  ?>
                                                        
                                                    </div>
                                                    
                                                    <div>
                                                        <?php echo form_error('exp_days')?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Bag Type</label>
                                                <?php 
                                                  if (isset($_GET['/'])) {
                                                     echo '<select class="form-control" name="bag_type" id="bag_type" required tabindex=4>
                                                           
                                                     <option value='.$bag_type.'>'.$bag_type.'</option>
                                                     <option value="Single">Single</option>
                                                      <option value="Double">Double</option>
                                                      <option value="Triple">Triple</option>
                                                      <option value="Quardruple">Quardruple</option>
                                                 </select>';
                                                  }else{
                                                      echo '<select class="form-control" name="bag_type" id="bag_type" required tabindex=4>
                                                           
                                                      <option value="Single">Single</option>
                                                      <option value="Double">Double</option>
                                                      <option value="Triple">Triple</option>
                                                      <option value="Quardruple">Quardruple</option>
                                                  </select>';
                                                  }
                                                  ?>
                                                        
                                                    </div>
                                                  
                                                    <div>
                                                        <?php echo form_error('bag_type')?>
                                                    </div>
                                                    <div class="form-group" hidden>
                                                        <?php 
                                                        $name = $this->session->userdata('name');
                                                        ?>
                                                        <label>user_cd</label>
                                                        <input type="text" class="form-control" value="<?php echo $name?>" name="user_cd" id="user_cd">
                                                    </div>
                                                    <div>
                                                        <?php echo form_error('user_cd')?>
                                                    </div>
                                                    <div class="form-group" hidden>
                                                        <?php 
                                                        $name = $this->session->userdata('name');
                                                        ?>
                                                        <label>entered_by</label>
                                                        <input type="text" class="form-control" value="<?php echo $name?>" name="entered_by">
                                                    </div>
                                                    <div class="form-group" hidden>
                                                        <label>update_dt</label>
                                                        <?php $dt = date('Y-m-d');?>
                                                        <input type="text" class="form-control" value="<?php echo $dt ?>" name="update_dt" id="update_dt"
                                                        >
                                                    </div>
                                                    <div class="form-group" hidden>
                                                        <label>update_flag</label>
                                                        <input type="text" class="form-control" value="Y" name="update_flag" id="update_flag">
                                                    </div>
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

