<!-- include dashboard header here..... -->
<?php include 'layout/dashboard_header.php';
include 'layout/form_validation.php' ?>
<?php 
                                if ($this->session->flashdata('success')) {
                                    echo "<div class='alert alert-success alert-dismissible fade show green' role='alert'>
                                    <h6 style='color:white;text-align:center;'>New user add successfully!</h6>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                    </div>";
                                }
                                if ($this->session->flashdata('error')) {
                                    echo "<div class='alert alert-danger alert-dismissible fade show red' role='alert'>
                                    <h6 style='color:white;text-align:center;'>New user not add!</h6>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                    </div>";
                                }
                               
                                ?>
                                 
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
            <div class="unix-login">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="login-content">
                        <div class="login-logo">
                            <!-- <a href="index.html"><span>Blood Bank Management System</span></a> -->
                        </div>
                        <div class="login-form">
                            <img src="<?php echo base_url()?>assets/images/user-icon.png" alt="">
                            
                           <?php 
                           $name = $this->session->userdata('name');
                           $user_id =$this->session->userdata('user_id');
                           $email = $this->session->userdata('email_id');
                           ?>
                                <div class="form-group">
                                    <label>User Id</label>
                                    <input type="text" class="form-control" placeholder="User id" autocomplete="off" value="<?php echo $user_id?>">
                                </div>
                                
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" placeholder="name" autocomplete="off" value="<?php echo $name?>">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" placeholder="Email" value="<?php echo $email?>">
                                </div>
                                
                                <div class="checkbox">
                                    
                                    <!-- <label class="pull-right">
										<a href="#">Forgotten Password?</a>
									</label> -->

                                </div>
                                <!-- <input type="submit" class="btn  btn-flat m-b-30 m-t-30 custom" value="Login"> -->
                              
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
<!-- include dashboard footer here..... -->
<?php include 'layout/dashboard_footer.php' ?>

