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
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                            <div class="card-title">
                                    <h4 style="color:orange;">Add new user</h4>
                                </div>
                               
                                <div class="card-body">
                                    <div class="basic-elements">
                                    <form id="add_user" method="POST" action="<?php echo base_url('add_user/add')?>">
                                        
                                            <div class="row">
                                                <div class="col-lg-6">
                                                   
                                                     <div class="form-group">
                                                        <label>User id</label>
                                                        <input id="" class="form-control" type="text" placeholder="" name="id" id="id" autocomplete="off">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>name</label>
                                                        <input class="form-control" type="text" value="" name="name" id="name" autocomplete="off">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input class="form-control" type="email" value="" name="email_id" id="email_id" autocomplete="off">
                                                    </div>
                                                    <div class="form-group" id="set_date" >
                                                        <label>password</label>
                                                        <input class="form-control" type="password" value="" name="password" id="password">
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="pm_save_div"><button type="submit" class="btn btn-success pm_save"><i class="ti-save"></i>&nbsp;&nbsp;Save</button></div>
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

