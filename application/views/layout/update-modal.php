<div class="modal fade" id="editModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update record</h5>
      </div>
<form action="" id="editform" method="POST">
          <div class="modal-body">
          <div class="form-group row">
            <input type="hidden" id="editId" name="row_id"/>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="prod_nm"
                                            placeholder="Product Name"
                                            name="prod_nm">
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="number" class="form-control form-control-user" id="exp_days"
                                            placeholder="Expiry Days"
                                            name="exp_days">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="temp"
                                            placeholder="Tempreture"
                                            name="temp">
                                    </div>
                                </div>
                               
                                <div class="form-group row">
                                <div class="form-group">
                                                        <label>Bag Type</label>
                                                        <select class="form-control" name="bag_type" id="bag_type" required>
															<option value="Single">Single</option>
															<option value="Double">Double</option>
															<option value="Triple">Triple</option>
															<option value="Quardruple">Quardruple</option>
														</select>
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
                                                        <input type="text" class="form-control" value="<?php echo $name?>" name="entered_by" id="entered_by">
                                                    </div>
                                                    <div class="form-group" hidden>
                                                        <label>update_dt</label>
                                                        <?php $dt = date('Y-m-d');?>
                                                        <input type="text" class="form-control" value="<?php echo $dt ?>" name="update_dt" id="update_dt">
                                                    </div>
                                                    <div class="form-group" hidden>
                                                        <label>update_flag</label>
                                                        <input type="text" class="form-control" value="Y" name="update_flag" id="update_flag">
                                                    </div>
                                                </div>
          </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="close">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
</form>
    </div>
  </div>
</div>