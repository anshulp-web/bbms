<!-- Header included here... -->
<?php include 'layout/header.php'; 
include 'layout/form_validation.php'
?>
<style type="text/css">
   .error{
       margin: 8px;
       color:#111111;
       text-transform:capitalize;
       
   } 
</style>
<?php 
if ($this->session->flashdata('success')) {
    echo "<div class='alert alert-success alert-dismissible fade show green' role='alert'>
                                    <h6 style='color:white;text-align:center;'>Password changed successfully!</h6>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                    </div>";
}
?>
<body class="bg-primary-custom" oncontextmenu="return false;" >

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
                            <h3>Welcome</h3>
                            <form id="login_form" action="<?php echo base_url('Author/index')?>" method="POST">
                                <div class="form-group">
                                    <!-- <label>User Id</label> -->
                                    <input type="text" class="form-control" placeholder="User id" name="id" id="id" autocomplete="off">
                                </div>
                                <div>
                                    <?php echo form_error('id')?>
                                </div>
                                <div class="form-group">
                                    <!-- <label>Password</label> -->
                                    <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                                </div>
                                <div>
                                    <?php echo form_error('password')?>
                                </div>
                                <div class="checkbox">
                                    
                                    
                                </div>
                                <input type="submit" class="btn  btn-flat m-b-30 m-t-30 custom" value="Login">
                                <!-- <button type="submit" class="">Login</button> -->
                                <!-- <div class="social-login-content">
                                    <div class="social-button">
                                        <button type="button" class="btn btn-primary bg-facebook btn-flat btn-addon m-b-10"><i class="ti-facebook"></i>Sign in with facebook</button>
                                        <button type="button" class="btn btn-primary bg-twitter btn-flat btn-addon m-t-10"><i class="ti-twitter"></i>Sign in with twitter</button>
                                    </div>
                                </div>
                                <div class="register-link m-t-15 text-center">
                                    <p>Don't have account ? <a href="#"> Sign Up Here</a></p>
                                </div> -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Footer included here... -->
<?php include 'layout/footer.php' ?>