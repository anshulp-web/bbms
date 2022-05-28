<!-- include dashboard header here..... -->
<?php include 'layout/dashboard_header.php';
include 'layout/form_validation.php' ?>
<?php 
                                if ($this->session->flashdata('success')) {
                                    echo "<div class='alert alert-success alert-dismissible fade show green' role='alert'>
                                    <h6 style='color:white;text-align:center;'>Password changed successfully!</h6>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                    </div>";
                                }
                                if ($this->session->flashdata('error')) {
                                    echo "<div class='alert alert-danger alert-dismissible fade show red' role='alert'>
                                    <h6 style='color:white;text-align:center;'>Password not changed!</h6>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                    </div>";
                                }
                                if ($this->session->flashdata('form_error')) {
                                    echo "<div class='alert alert-danger alert-dismissible fade show red' role='alert'>
                                    <h6 style='color:white;text-align:center;'>All field are required!</h6>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                    </div>";
                                }
                                if ($this->session->flashdata('not_match_password')) {
                                    echo "<div class='alert alert-danger alert-dismissible fade show red' role='alert'>
                                    <h6 style='color:white;text-align:center;'>Wrong old password!!</h6>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                    </div>";
                                }
                                if ($this->session->flashdata('match_error')) {
                                    echo "<div class='alert alert-danger alert-dismissible fade show red' role='alert'>
                                    <h6 style='color:white;text-align:center;'>old password and new password are same!</h6>
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
                                    <h4 style="color:orange;">Change password</h4>
                                </div>
                               
                                <div class="card-body">
                                    <div class="basic-elements">
                                    <form id="add_user" method="POST" action="<?php echo base_url('change_password/change')?>">
                                        
                                            <div class="row">
                                                <div class="col-lg-6">
                                                   
                                                     <div class="form-group">
                                                        <label>User id</label>
                                                        <?php $user_id = $this->session->userdata('user_id');
                                                        ?>
                                                        <input id="" class="form-control" type="text" placeholder="" name="id" id="id" value="<?php echo $user_id?>" readonly>
                                                    </div>
                                                    <div class="form-group" id="set_date" >
                                                        <label>Old password</label>
                                                        <input class="form-control" type="password" value="" name="old_password" id="old_password">
                                                    </div>
                                                    <div class="form-group" id="set_date" >
                                                        <label>New password</label>
                                                        <input class="form-control" type="password" value="" name="password" id="password">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pm_save_div"><button type="submit" class="btn btn-success pm_save"><i class="ti-save"></i>&nbsp;&nbsp;Change</button></div>
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

