<?php error_reporting(0); 

   require_once('../../../connections/database.php');

?>
                    <!-- Start Content-->
                    <div class="container-fluid">

                      <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box"> 
                                    <h4 class="page-title">Dashboard</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 


                    <div class="row">

                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mt-0 mb-3">Daily Sales</h4>
    
                                        <div class="widget-box-2">
                                            <div class="widget-detail-2 text-end">
                                                <span class="badge bg-pink rounded-pill float-start mt-3">32% <i class="mdi mdi-trending-up"></i> </span>
                                                <h2 class="fw-normal mb-1"> 158 </h2>
                                                <p class="text-muted mb-3">Today</p>
                                            </div>
                                            <div class="progress progress-bar-alt-pink progress-sm">
                                                <div class="progress-bar bg-pink" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 77%;">
                                                    <span class="visually-hidden">77% Complete</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
    
                                        <h4 class="header-title mt-0 mb-3">Sales This Month</h4>
    
                                        <div class="widget-box-2">
                                            <div class="widget-detail-2 text-end">
                                                <span class="badge bg-success rounded-pill float-start mt-3">32% <i class="mdi mdi-trending-up"></i> </span>
                                                <h2 class="fw-normal mb-1"> 8451 </h2>
                                                <p class="text-muted mb-3">This Month</p>
                                            </div>
                                            <div class="progress progress-bar-alt-success progress-sm">
                                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 77%;">
                                                    <span class="visually-hidden">77% Complete</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mt-0 mb-3">Sales This Year</h4>
    
                                        <div class="widget-box-2">
                                            <div class="widget-detail-2 text-end">
                                                <span class="badge bg-primary rounded-pill float-start mt-3">32% <i class="mdi mdi-trending-up"></i> </span>
                                                <h2 class="fw-normal mb-1"> 7540 </h2>
                                                <p class="text-muted mb-3">This Year</p>
                                            </div>
                                            <div class="progress progress-bar-alt-primary progress-sm">
                                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 77%;">
                                                    <span class="visually-hidden">77% Complete</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
    
                                        <h4 class="header-title mt-0 mb-3">Sales Last Year</h4>
    
                                        <div class="widget-box-2 text-end">
                                            <div class="widget-detail-2">
                                                <span class="badge bg-warning rounded-pill float-start mt-3">32% <i class="mdi mdi-trending-up"></i> </span>
                                                <h2 class="fw-normal mb-1"> 9841 </h2>
                                                <p class="text-muted mb-3">Last Year</p>
                                            </div>
                                            <div class="progress progress-bar-alt-warning progress-sm">
                                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 77%;">
                                                    <span class="visually-hidden">77% Complete</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div><!-- end col -->

                        </div>


                        <div class="row">
                            <div class="col-xl-12 col-md-12">
                                    <div class="card-body">
    
                                        <h4 class="header-title mt-0 mb-3">Top Selling Items <span class="badge bg-info">THIS MONTH</span></h4>
                                        <div class="row">
                                          <div class="col-md-2 col-xl-2">
                                              <div class="card">
                                                  <img class="card-img-top img-fluid" src="assets/images/gallery/1.jpg" alt="Card image cap">
                                                  <div class="card-body">
                                                      <h4 class="card-title">San Mig Light</h4>
                                                      <h2 class="fw-normal text-success" data-plugin="counterup">452</h2>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-md-2 col-xl-2">
                                              <div class="card">
                                                  <img class="card-img-top img-fluid" src="assets/images/gallery/1.jpg" alt="Card image cap">
                                                  <div class="card-body">
                                                      <h4 class="card-title">San Mig Light</h4>
                                                      <h2 class="fw-normal text-success" data-plugin="counterup">452</h2>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-md-2 col-xl-2">
                                              <div class="card">
                                                  <img class="card-img-top img-fluid" src="assets/images/gallery/1.jpg" alt="Card image cap">
                                                  <div class="card-body">
                                                      <h4 class="card-title">San Mig Light</h4>
                                                      <h2 class="fw-normal text-success" data-plugin="counterup">452</h2>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-md-2 col-xl-2">
                                              <div class="card">
                                                  <img class="card-img-top img-fluid" src="assets/images/gallery/1.jpg" alt="Card image cap">
                                                  <div class="card-body">
                                                      <h4 class="card-title">San Mig Light</h4>
                                                      <h2 class="fw-normal text-success" data-plugin="counterup">452</h2>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-md-2 col-xl-2">
                                              <div class="card">
                                                  <img class="card-img-top img-fluid" src="assets/images/gallery/1.jpg" alt="Card image cap">
                                                  <div class="card-body">
                                                      <h4 class="card-title">San Mig Light</h4>
                                                      <h2 class="fw-normal text-success" data-plugin="counterup">452</h2>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-md-2 col-xl-2">
                                              <div class="card">
                                                  <img class="card-img-top img-fluid" src="assets/images/gallery/1.jpg" alt="Card image cap">
                                                  <div class="card-body">
                                                      <h4 class="card-title">San Mig Light</h4>
                                                      <h2 class="fw-normal text-success" data-plugin="counterup">452</h2>
                                                  </div>
                                              </div>
                                          </div>
                                         </div>



                                    </div>
                                
                            </div>
                        </div>



                       <div class="row">

                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
    
                                        <h4 class="header-title mt-0 mb-3">Latest Transactions</h4>
    
                                        <div class="table-responsive">
                                            <table class="table table-hover mb-0">
                                                <thead>
                                                <tr>
                                                    <th>OR #</th>
                                                    <th>Table #</th>
                                                    <th>Date</th>
                                                    <th>MOP</th>
                                                    <th>Total Amount</th>
                                                    <th>Cashier</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Adminto Admin v1</td>
                                                        <td>01/01/2017</td>
                                                        <td>26/04/2017</td>
                                                        <td><span class="badge bg-danger">Released</span></td>
                                                        <td>Coderthemes</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Adminto Frontend v1</td>
                                                        <td>01/01/2017</td>
                                                        <td>26/04/2017</td>
                                                        <td><span class="badge bg-success">Released</span></td>
                                                        <td>Adminto admin</td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>Adminto Admin v1.1</td>
                                                        <td>01/05/2017</td>
                                                        <td>10/05/2017</td>
                                                        <td><span class="badge bg-pink">Pending</span></td>
                                                        <td>Coderthemes</td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>Adminto Frontend v1.1</td>
                                                        <td>01/01/2017</td>
                                                        <td>31/05/2017</td>
                                                        <td><span class="badge bg-purple">Work in Progress</span>
                                                        </td>
                                                        <td>Adminto admin</td>
                                                    </tr>
                                                    <tr>
                                                        <td>5</td>
                                                        <td>Adminto Admin v1.3</td>
                                                        <td>01/01/2017</td>
                                                        <td>31/05/2017</td>
                                                        <td><span class="badge bg-warning">Coming soon</span></td>
                                                        <td>Coderthemes</td>
                                                    </tr>
    
    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div> 
                                </div>
                               
                            </div><!-- end col -->

                        </div>



                </div> <!-- content -->

<script type="text/javascript">
  
    var val = "<?php echo $System_Name ?>";
 newPageTitle =  val;
document.querySelector('title').textContent = newPageTitle;
</script>