<?php error_reporting(0); 

        require_once('../../../connections/database.php');

        $sql_pros = "SELECT * FROM table_settings";
        $results_pros = mysqli_query($conn, $sql_pros);
                while($row_cat = mysqli_fetch_array($results_pros))
                    {
                        // $Store_Name = $row_cat['Store_Name'];
                        $Address = $row_cat['Address'];
                        $TIN = $row_cat['TIN'];
                        $Zip = $row_cat['Zip'];
                        $Email = $row_cat['Email'];
                        $Website = $row_cat['Website'];
                        $System_Name = $row_cat['System_Name'];
                        $POS = $row_cat['POS'];
                        $Service_Charge = $row_cat['Service_Charge'];
                        $senior = $row_cat['Senior_discount'];
                        $pwd = $row_cat['PWD_discount'];
                    }

?>

                    <!-- Start Content-->
                    <div class="container-fluid">
                          
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box"> 
                                    <h4 class="page-title">System Settings</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                   <div class="card-body">   
                                                        <div class="input-group mb-2">
                                                            <div class="input-group-text"><i class="mdi mdi-store-24-hour"></i></div>
                                                            <input type="text" class="form-control" name="storename" id="storename" value="<?php echo $Store_Name; ?>">
                                                        </div>

                                                         <div class="input-group mb-2">
                                                            <div class="input-group-text"><i class="fas fa-map-marker-alt"></i></div>
                                                            <input type="text" class="form-control" name="address" id="address" value="<?php echo $Address; ?>">
                                                        </div>
                                                        <div class="input-group mb-2">
                                                            <div class="input-group-text"><i class="fas fa-id-card"></i></div>
                                                            <input type="text" class="form-control" name="tin" id="tin" value="<?php echo $TIN; ?>">
                                                        </div>
                                                        <div class="input-group mb-2">
                                                            <div class="input-group-text"><i class="fas fa-map-marked-alt"></i></div>
                                                            <input type="text" class="form-control" name="zip" id="zip" value="<?php echo $Zip; ?>">
                                                        </div>
                                                        <div class="input-group mb-2">
                                                            <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                                                            <input type="text" class="form-control" name="email" id="email" value="<?php echo $Email; ?>">
                                                        </div>


                                                      </div>
                                                      <!-- /.card-body -->
                                            </div>

                                            <div class="col-md-6">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">System Name</label>
                                                            <input type="text" class="form-control" name="systemname" id="systemname" value="<?php echo $System_Name; ?>">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">POS Number</label>
                                                            <input type="text" class="form-control"  name="pos" id="pos" value="<?php echo $POS; ?>">
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Service Change</label>                                                    
                                                            <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                                                <input type="number" class="form-control" name="charge" id="charge" value="<?php echo $Service_Charge; ?>">
                                                                <span class="input-group-addon bootstrap-touchspin-postfix input-group-append">
                                                                    <span class="input-group-text">%</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Senior Discount</label>                                                    
                                                            <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                                                <input type="number" class="form-control" name="senior" id="senior" value="<?php echo $senior; ?>">
                                                                <span class="input-group-addon bootstrap-touchspin-postfix input-group-append">
                                                                    <span class="input-group-text">%</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">PWD Discount</label>                                                    
                                                            <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                                                <input type="number" class="form-control"  name="pwd" id="pwd" value="<?php echo $pwd; ?>">
                                                                <span class="input-group-addon bootstrap-touchspin-postfix input-group-append">
                                                                    <span class="input-group-text">%</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Website</label>
                                                            <input type="text" class="form-control" name="Website" id="Website" value="<?php echo $Website; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
        
        
                                        </div> <!-- end row-->
                                    </div>


                                                  <div class="card-footer">
                                                      <button type="button" class="btn btn-success save" name="save" id="save">Save</button>
                                                    </div>

                                                    
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                        </div>
                    
                    </div> <!-- container -->


<script type="text/javascript">
  
    var val = "<?php echo $System_Name ?>";
 newPageTitle =  val +' - Settings';
document.querySelector('title').textContent = newPageTitle;
</script>