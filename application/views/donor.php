<!-- include dashboard header here..... -->
<?php include 'layout/dashboard_header.php' ?>
<?php
if ($this->session->flashdata('updated')) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <h6 style='color:white;text-align:center;'>Entry updated successfully!</h6>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
    </button>
    </div>";
}
if ($this->session->flashdata('updated_failed')) {
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
    <h6 style='color:white;text-align:center;'>Entry not updated!</h6>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
    </button>
    </div>";
}
if ($this->session->flashdata('deleted')) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <h6 style='color:white;text-align:center;'>Entry deleted successfully!</h6>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
    </button>
    </div>";
}
?>
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="card-title">
                <h4 style="color:orange;margin-top:50px;">Donor Browse</h4>
            </div>
            <div class="pm_action_div">
                <a href="<?php echo base_url('donor/adddonor') ?>" class="btn btn-primary"><i class="ti-pencil"></i>&nbsp;&nbsp;Add New</a>
                <!-- <a href="" class="btn btn-secondary"><i class="ti-search"></i>&nbsp;&nbsp;Browse</a> -->
                <a href="<?php //echo base_url('donor/rpt') ?>" class="btn btn-info"><i class="ti-save-alt"></i>&nbsp;&nbsp;Report</a>
            </div>
            <div class="table">
                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>City</th>
                            <th>Mobile No</th>
                            <th>Blood Group</th>
                            <th>Bag Size</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($resultlist1 as $value) {
                            $i++;
                        ?>


                            <tr>

                                <td>
                                    <a href="<?php echo base_url('donor/update') ?>?/=<?php echo $value['row_id'] ?>" class="update" style="cursor:pointer;">
                                        <?php echo $i ?>
                                    </a>
                                </td>
                                <td>
                                    <a href="<?php echo base_url('donor/update') ?>?/=<?php echo $value['row_id'] ?>" class="update" style="cursor:pointer;">
                                        <?php echo $value['trans_dt'] ?>
                                    </a>
                                </td>
                                <td>
                                    <a href="<?php echo base_url('donor/update') ?>?/=<?php echo $value['row_id'] ?>" class="update" style="cursor:pointer;">
                                        <?php echo $value['name'] ?>
                                    </a>
                                </td>
                                <td>
                                    <a href="<?php echo base_url('donor/update') ?>?/=<?php echo $value['row_id'] ?>" class="update" style="cursor:pointer;">
                                        <?php echo $value['age'] ?>
                                    </a>
                                </td>
                                <td>
                                    <a href="<?php echo base_url('donor/update') ?>?/=<?php echo $value['row_id'] ?>" class="update" style="cursor:pointer;">
                                        <?php echo $value['sex'] ?>
                                    </a>
                                </td>
                                <td>
                                    <a href="<?php echo base_url('donor/update') ?>?/=<?php echo $value['row_id'] ?>" class="update" style="cursor:pointer;">
                                        <?php echo $value['city'] ?>
                                    </a>
                                </td>
                                <td>
                                    <a href="<?php echo base_url('donor/update') ?>?/=<?php echo $value['row_id'] ?>" class="update" style="cursor:pointer;">
                                        <?php echo $value['mob_no'] ?>
                                    </a>
                                </td>
                                <td>
                                    <a href="<?php echo base_url('donor/update') ?>?/=<?php echo $value['row_id'] ?>" class="update" style="cursor:pointer;">
                                        <?php echo $value['blood_grp'] ?>
                                    </a>
                                </td>

                                <td>
                                    <a href="<?php echo base_url('donor/update') ?>?/=<?php echo $value['row_id'] ?>" class="update" style="cursor:pointer;">
                                        <?php echo $value['bag_type'] ?>
                                    </a>
                                </td>  

                                <td><a href="<?php echo base_url('donor/update') ?>?/=<?php echo $value['row_id'] ?>" class="update"><i class="ti-new-window"></i></a>|<a href="<?php echo base_url('donor/delete') ?>?/=<?php echo $value['row_id'] ?>" class="delete" onclick="return confirm('Are you sure you want to delete this item?');"><i class="ti-trash"></i></a></td>
                            </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- include dashboard footer here..... -->
<?php include 'layout/dashboard_footer.php' ?>