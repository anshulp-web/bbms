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
                <h4 style="color:orange;margin-top:50px;">Product Master Browse</h4>
            </div>
            <div class="pm_action_div">
                <a href="<?php echo base_url('dashboard/addproduct')?>" class="btn btn-primary"><i class="ti-pencil"></i>&nbsp;&nbsp;Add New</a>
                <!-- <a href="" class="btn btn-secondary"><i class="ti-search"></i>&nbsp;&nbsp;Browse</a> -->
                <a href="" class="btn btn-info"><i class="ti-save-alt"></i>&nbsp;&nbsp;Report</a>
            </div>

            <div class="table">
                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th>Sno</th>
                            <th>Product Name</th>
                            <th>Expiry Days</th>
                            <th>Temperature</th>
                            <th>Bag Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <form action="" method="POST">
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($result_data as $value) {
                            $i++;
                        ?>
                        <tr>
                            <td><?php echo $i?></td>
                            <td><?php echo $value['prod_nm']?></td>
                            <td><?php echo $value['exp_days']?></td>
                            <td><?php echo $value['temp']?></td>
                            <td><?php echo $value['bag_type']?></td>
                            <td><a href="<?php echo base_url('dashboard/update')?>?/=<?php echo $value['row_id']?>" class="update"><i class="ti-new-window"></i></a>|<a href="<?php echo base_url('dashboard/delete')?>?/=<?php echo $value['row_id']?>" class="delete" onclick="return confirm('Are you sure you want to delete this item?');"><i class="ti-trash"></i></a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    </form>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- include dashboard footer here..... -->



</div>
<?php include 'layout/dashboard_footer.php' ?>