<div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
        <div class="nano">
            <div class="nano-content">
                <div class="logo">
                    <a href="<?php echo base_url('dashboard/index')?>">
                        <img src="<?php echo base_url()?>assets/images/logoevolve.png" alt="" width="80px" height="80px" style="background-color:white;border-radius:100%;"/>
                        <!-- <span><?php //$name = $this->session->userdata('name'); echo $name?></span> -->
                    </a>
                </div>
                <ul>
                    <!-- <li class="label">Main</li> -->
                    <!-- <li>
                        <a class="sidebar-sub-toggle" href="">
                            <i class="ti-home"></i> Home Screen
                           
                        </a>
                        
                    </li> -->
                    <li>
                        <a class="sidebar-sub-toggle">
                            <i class="ti-bar-chart-alt"></i> Blood Bank
                            <span class="sidebar-collapse-icon ti-angle-down"></span>
                        </a>
                        <ul>
                        <li>
                        <a class="sidebar-sub-toggle">
                            <i class="ti-layout"></i>Setup
                            <span class="sidebar-collapse-icon ti-angle-down"></span>
                        </a>
                        <ul>
                            <li>
                                <a href="<?php echo base_url('dashboard/index')?>">Product</a>
                            </li>
                        </ul>
                        <li>
                        <a class="sidebar-sub-toggle">
                            <i class="ti-layout"></i> Transaction
                            <span class="sidebar-collapse-icon ti-angle-down"></span>
                        </a>
                        <ul>
                            <li>
                                <a href="<?php echo base_url('donor/index')?>">Donor</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('issue/index')?>">Issue</a>
                            </li>
                            </li>

                        </ul>
                    </li>
                    </li>
                    </ul>
                    </li>
            </div>
        </div>
    </div>
    
    <!-- /# sidebar -->
    
    <!-- Onclick function for all anchor tags -->

    <script>
        function product_clk(){
            window.location.href = "<?php echo base_url('dashboard/index')?>";
        }
    </script>