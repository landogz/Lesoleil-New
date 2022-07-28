<?php error_reporting(0); 

   require_once('../../../connections/database.php');

   $getmonth = date("m");
   $sql_pros = "SELECT SUM(Total_Amount_Due) AS `Today`
                FROM table_transaction 
                WHERE DATE(DateTime_Out) = CURDATE()";
        $results_pros = mysqli_query($conn, $sql_pros);

       if (mysqli_num_rows($results_pros) > 0) {
        while($row_cat = mysqli_fetch_array($results_pros))
                    {
                        $total_day = $row_cat['Today'];
                    }
                  }else{
                      $total_day =0;
                  }

$sql_pros = "SELECT SUM(Total_Amount_Due) AS `Month`
            FROM table_transaction
            WHERE MONTH(DateTime_Out) = MONTH(CURRENT_DATE())
            AND YEAR(DateTime_Out) = YEAR(CURRENT_DATE())";
          $results_pros = mysqli_query($conn, $sql_pros);
  
         if (mysqli_num_rows($results_pros) > 0) {
          while($row_cat = mysqli_fetch_array($results_pros))
                      {
                          $total_month = $row_cat['Month'];
                      }
                    }else{
                        $total_month =0;
                    }

$sql_pros = "SELECT SUM(Total_Amount_Due) AS `Year`
            FROM table_transaction
            WHERE YEAR(DateTime_Out) = YEAR(CURRENT_DATE())";
                  $results_pros = mysqli_query($conn, $sql_pros);
          
                 if (mysqli_num_rows($results_pros) > 0) {
                  while($row_cat = mysqli_fetch_array($results_pros))
                              {
                                  $total_year = $row_cat['Year'];
                              }
                            }else{
                                $total_year =0;
                            }

$sql_pros = "SELECT SUM(Total_Amount_Due) AS `last_year` FROM table_transaction
WHERE YEAR(DateTime_Out) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR))";
                  $results_pros = mysqli_query($conn, $sql_pros);
          
                 if (mysqli_num_rows($results_pros) > 0) {
                  while($row_cat = mysqli_fetch_array($results_pros))
                              {
                                  $total_last_year = $row_cat['last_year'];
                              }
                            }else{
                                $total_last_year =0;
                            }
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
                                                <span class="badge bg-pink rounded-pill float-start mt-3"><i class="mdi mdi-trending-up"></i> </span>
                                                <h2 class="fw-normal mb-1">₱ <?php echo number($total_day); ?> </h2>
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
    
                                        <h4 class="header-title mt-0 mb-3">Sales This Month </h4>
    
                                        <div class="widget-box-2">
                                            <div class="widget-detail-2 text-end">
                                                <span class="badge bg-success rounded-pill float-start mt-3"><i class="mdi mdi-trending-up"></i> </span>
                                                <h2 class="fw-normal mb-1"> ₱ <?php echo number($total_month); ?> </h2>
                                                <p class="text-muted mb-3">Month of <?php echo date('F');?></p>
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
                                                <span class="badge bg-primary rounded-pill float-start mt-3"><i class="mdi mdi-trending-up"></i> </span>
                                                <h2 class="fw-normal mb-1"> ₱ <?php echo number($total_year); ?>  </h2>
                                                <p class="text-muted mb-3">Year <?php echo date('Y');?></p>
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
                                                <span class="badge bg-warning rounded-pill float-start mt-3"><i class="mdi mdi-trending-up"></i> </span>
                                                <h2 class="fw-normal mb-1"> ₱ <?php echo number($total_last_year); ?>  </h2>
                                                <p class="text-muted mb-3">Year <?php echo date("Y",strtotime("-1 year")); ?></p>
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