<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Blood Bank Management System -Evolve Webinfo Pvt. Ltd.</title>

    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <!-- <script src="<?php //echo base_url() ?>assets/js/lib/jquery.min.js"></script> -->
    <link rel="shortcut icon" href="http://placehold.it/64.png/000/fff">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
    <!-- Standard iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
    <!-- Standard iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">

    <!--Toastr-->
    <link href="<?php echo base_url() ?>assets/css/lib/toastr/toastr.min.css" rel="stylesheet">
    <!-- Sweet Alert -->
    <link href="<?php echo base_url() ?>assets/css/lib/sweetalert/sweetalert.css" rel="stylesheet">
    <!-- Range Slider -->
    <link href="<?php echo base_url() ?>assets/css/lib/rangSlider/ion.rangeSlider.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/lib/rangSlider/ion.rangeSlider.skinFlat.css" rel="stylesheet">
    <!-- Bar Rating -->
    <link href="<?php echo base_url() ?>assets/css/lib/barRating/barRating.css" rel="stylesheet">
    <!-- Nestable -->
    <link href="<?php echo base_url() ?>assets/css/lib/nestable/nestable.css" rel="stylesheet">
    <!-- JsGrid -->
    <link href="<?php echo base_url() ?>assets/css/lib/jsgrid/jsgrid-theme.min.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/css/lib/jsgrid/jsgrid.min.css" type="text/css" rel="stylesheet" />
    <!-- Datatable -->
    <link href="<?php echo base_url() ?>assets/css/lib/data-table/dataTables.bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/css/lib/data-table/buttons.bootstrap.min.css" rel="stylesheet" />
    <!-- Calender 2 -->
    <link href="<?php echo base_url() ?>assets/css/lib/calendar2/pignose.calendar.min.css" rel="stylesheet">
    <!-- Weather Icon -->
    <link href="<?php echo base_url() ?>assets/css/lib/weather-icons.css" rel="stylesheet" />
    <!-- Owl Carousel -->
    <link href="<?php echo base_url() ?>assets/css/lib/owl.carousel.min.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/css/lib/owl.theme.default.min.css" rel="stylesheet" />
    <!-- Select2 -->
    <link href="<?php echo base_url() ?>assets/css/lib/select2/select2.min.css" rel="stylesheet">
    <!-- Chartist -->
    <link href="<?php echo base_url() ?>assets/css/lib/chartist/chartist.min.css" rel="stylesheet">
    <!-- Calender -->
    <link href="<?php echo base_url() ?>assets/css/lib/calendar/fullcalendar.css" rel="stylesheet" />

    <!-- Common -->
    <link href="<?php echo base_url() ?>assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/lib/helper.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet">
    <script src="<?php echo base_url() ?>assets/js/scripts.js"></script>

    <!-- Datatables cdn links -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="<?php echo base_url() ?>assets/js/lib/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    
  
<script>
    $(document).ready( function () {
        $('#table_id').DataTable();
} );


</script>
</head>

<body>
<?php include 'sidebar.php' ?>
<div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="float-left">
                        <div class="hamburger sidebar-toggle">
                            <span class="line"></span>
                            <span class="line"></span>
                            <span class="line"></span>
                        
                        </div>
                    </div>
                    <div class="company_nm">
                        <h6 >
                               <?php $c_nm = $this->session->userdata('company_nm');
                                echo $c_nm;?>
                         </h6>
                                </div>
                    <div class="float-right">
                        <div class="dropdown dib">
                            <!--  notification div space-->
                        </div>
                        <div class="dropdown dib">
                            <!-- message box div space -->
                        </div>
                        <div class="dropdown dib">
                            <div class="header-icon" data-toggle="dropdown">
                           
                                <span class="user-avatar"> <i class="ti-user"></i>&nbsp;&nbsp;<?php $user_name = $this->session->userdata('name');
                                echo $user_name;?>
                                
                                    <i class="ti-angle-down f-s-10"></i>
                                </span>
                                <div class="drop-down dropdown-profile dropdown-menu dropdown-menu-right">
                                    <!-- <div class="dropdown-content-heading">
                                        <span class="text-left">Upgrade Now</span>
                                        <p class="trial-day">30 Days Trail</p>
                                    </div> -->
                                    <div class="dropdown-content-body">
                                        <ul>
                                            <li>
                                                <a href="#" onclick="profile_clk()">
                                                    <i class="ti-user"></i>
                                                    <span>Profile</span>
                                                </a>
                                            </li>
                                            <li hidden>
                                                <a href="#" onclick="gt_pass_clk()">
                                                <i class="ti-lock"></i>
                                                    <span>Get Password</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" onclick="change_clk()">
                                                <i class="ti-lock"></i>
                                                    <span>Change Password</span>
                                                </a>
                                            </li>
                                            <!-- <li>
                                                <a href="#">
                                                    <i class="ti-settings"></i>
                                                    <span>View Backup</span>
                                                </a>
                                            </li> -->

                                            <li>
                                                <a href="<?php echo base_url('add_user/index')?>" onclick="adduser_clk()">
                                                   <i class="ti-user"></i>
                                                    <span>Add User</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="" onclick="log_clk()" target="_blank">
                                                    <i class="ti-power-off"></i>
                                                    Logout
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- This is for anchor tag onclick -->
    <script>
        function log_clk(){
            window.location.href = "<?php echo base_url('logout/index')?>";
        }
        function adduser_clk(){
            window.location.href = "<?php echo base_url('add_user/index')?>";
        }
        function change_clk(){
            window.location.href = "<?php echo base_url('Change_password/index')?>";
        }
        function profile_clk(){
            window.location.href = "<?php echo base_url('profile/index')?>";
        }
        function gt_pass_clk(){
            window.location.href = "<?php echo base_url('get_usr_pass/index')?>";
        }
        </script>


<!-- update modal -->



