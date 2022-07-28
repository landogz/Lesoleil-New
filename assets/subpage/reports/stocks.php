<?php error_reporting(0); 

   require_once('../../../connections/database.php');

?>
                    <!-- Start Content-->
                    <div class="container-fluid">

                      <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box"> 
                                    <h4 class="page-title">Stock In History</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 


                         <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="text-muted font-14 mb-3">
                                           List of Entered Stocks   &nbsp;
                                        </p>
    
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Item Name</th>
                                                <th>Stock Added</th>
                                                <th>Date</th>
                                                <th>Added by</th>
                                            </tr>
                                            </thead>
    
    
                                            <tbody>
                                            <tr>
                                                <td>12</td>
                                                <td><img src="assets/images/users/user-1.jpg" class="rounded-circle" alt="" height="40"> San Mig Light</td>
                                                <td>2250 ml</td>
                                                <td>Feb 03, 2022 06:23:00pm</td>
                                                <td>Rolan</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        <!-- end row -->

                </div> <!-- content -->




 <!--  Modal content for the Large example -->
                                        <div class="modal fade" id="bs-example-modal-lg" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myLargeModalLabel">Inspect New Complaint</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                      <div class="card-body" id="details_place">
                                                                    <h5 class="card-title placeholder-glow">
                                                                        <span class="placeholder col-6"></span>
                                                                    </h5>
                                                                    <p class="card-text placeholder-glow">
                                                                        <span class="placeholder col-7"></span>
                                                                        <span class="placeholder col-4"></span>
                                                                        <span class="placeholder col-4"></span>
                                                                        <span class="placeholder col-6"></span>
                                                                        <span class="placeholder col-8"></span>
                                                                    </p>
                                                                </div>

                                                    <div class="modal-body"  id="details_card" style="display: none">

                                                            <div class="card-body">

                                                                <form id="show_com" method="POST" enctype="multipart/form-data">

                                                                    <div class="card">
                                                                        <div class="card-body task-detail">
                                                                            
                                                                            <div class="d-flex mb-3">
                                                                                <img class="flex-shrink-0 me-3 rounded-circle avatar-md" alt="64x64" src="assets/images/users/avatars-000317336432-0vcza7-t500x500.jpg">
                                                                                <div class="flex-grow-1">
                                                                                    <h4 class="media-heading mt-0" id="showname"></h4>
                                                                                    <span class="badge bg-danger" id="showreference"></span>
                                                                                </div>
                                                                            </div>
                                        
                                                                            <h4 name="showsubject" id="showsubject"></h4>
                                        
                                                                            <p class="text-muted" id="showmessage"></p>
                                        
                                                                            
                                        
                                                                            <div class="row task-dates mb-0 mt-2">
                                                                                <div class="col-lg-4">
                                                                                    <h5 class="font-600 m-b-5">Contact</h5>
                                                                                    <p id="showcontact"></p>
                                                                                </div>
                                        
                                                                                
                                                                                <div class="col-lg-4">
                                                                                    <h5 class="font-600 m-b-5">Email Address</h5>
                                                                                    <p id="showemail"></p>
                                                                                </div><div class="col-lg-4">
                                                                                    <h5 class="font-600 m-b-5">Date Reported</h5>
                                                                                    <p id="date_reported"></p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="clearfix"></div>
                                        

                                        
                                                                            <div class="attached-files mt-3">
                                                                                <h5>Attached File</h5>
                                                                                <ul class="list-inline files-list">
                                                                                    <li class="list-inline-item file-box">
                                                                                         <img class="img-fluid z-depth-1" src="" alt="video" id="evidence_img" style="display: none;height: 250px">
                                                                                          <video id="evidence_video"  width="400" controls style="width: 100%;height: 250px;display: none;">
                                                                                            <source  id="evidence_video" src="">
                                                                                            Your browser does not support HTML video.
                                                                                            </video>
                                                                                    </li>
                                                                                    
                                                                                </ul>
                                                                                
                                                                            </div>
                                        
                                                                        </div>
                                                                    </div>
                                                           
                                                    </div>
                                                    <div class="modal-footer"> 
                                                        <button type="button" class="btn btn-success waves-effect waves-light" onclick="approved_account()">
                                                       Approve
                                                    </button>
                                                    <button type="button" class="btn btn-danger waves-effect waves-light"  onclick="declined_account()">
                                                        Decline
                                                    </button>
                                                        <button type="button" class="btn btn-white" data-bs-dismiss="modal" aria-label="Close" >Close</button>
                                                    </div>
                                                    </form>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->






<script type="text/javascript">
    
$(document).ready(function() {
    $("#datatable").DataTable();

    var a = $("#datatable-buttons").DataTable({
        lengthChange: !1,
        buttons: ["copy", "excel", "pdf"]
    });

    $("#key-table").DataTable({
            keys: !0
        }),
        $("#responsive-datatable").DataTable(),
        $("#selection-datatable").DataTable({
            select: {
                style: "multi"
            }
        }),
        a.buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)"),
        $("#datatable_length select[name*='datatable_length']").addClass("form-select form-select-sm"),
        $("#datatable_length select[name*='datatable_length']").removeClass("custom-select custom-select-sm"),
        $(".dataTables_length label").addClass("form-label")
});


</script>

<script type="text/javascript">
  
    var val = "<?php echo $System_Name ?>";
 newPageTitle =  val +' - Stocks';
document.querySelector('title').textContent = newPageTitle;
</script>