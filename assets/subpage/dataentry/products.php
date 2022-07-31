<?php error_reporting(0); 

   require_once('../../../connections/database.php');

?>
                    <!-- Start Content-->
                    <div class="container-fluid">

                      <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box"> 
                                    <h4 class="page-title">Products</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 


                         <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="text-muted font-14 mb-3">
                                            List of Products &nbsp;
                                            <button type="button" data-bs-toggle="modal" class="btn btn-success rounded-pill waves-effect waves-light add_products">
                                                <span class="btn-label"><i class="mdi mdi-new-box"></i></span>New Product
                                            </button>
                                           
                                        </p>

                                        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Image</th>
                                                <th>Category</th>
                                                <th>Product Name</th>
                                                <th>Price</th>
                                                <th>Status</th>
                                                <th style="width: auto;"></th>
                                            </tr>
                                            </thead>
    
    
                                            <tbody>
                                                                <?php 
                                                                      $sql = "SELECT table_products.ID, Category, Product, Price, Status,Image
                                                                              FROM table_products
                                                                              INNER JOIN table_category ON
                                                                              table_products.Category_ID = table_category.ID order by ID ASC";
                                                                      $result = $conn->query($sql);
                                                                      while($row = $result->fetch_assoc()) { ?>
                                                                    <tr>
                                                                        <td><?php echo  htmlentities($row["ID"]); ?></td>
                                                                        <td><img src="photos/<?php echo $row["Image"]; ?>" class="rounded-circle" alt="" height="60" width="60">
                                                                      </td>
                                                                        <td><?php echo  htmlentities($row["Category"]); ?></td>
                                                                        <td><?php echo  htmlentities($row["Product"]); ?></td>
                                                                        <td>₱<?php echo  htmlentities($row["Price"]); ?></td>
                                                                        <td><?php if($row["Status"] == 'Available'){ echo '<span class="badge bg-success">Available</span>'; } else { echo '<span class="badge bg-danger">Not Available</span>'; } ?></td>
                                                                        <td class="project-actions text-right">
                                                                          <a type="button" class="btn btn-warning btn-rounded text-white btn-sm edit_MOP" id="<?php echo $row["ID"]; ?>"><i class="fas fa-edit"></i> Edit</a>
                                                                          <button type="button" class="btn btn-danger btn-rounded text-white btn-sm" onclick="delete_product(<?php echo $row["ID"]; ?>)"><i class="fas fa-trash-alt"></i> Delete</button>
                                                                        </td>
                                                                    </tr>
                                                                       <?php
                                                                          }?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        <!-- end row -->

                </div> <!-- content -->


<!--  Modal content for the Large example -->
<div class="modal fade" id="MOP_Modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="myLargeModalLabel">New Product</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form method="post" id="submit_MOP" class="form-material" enctype="multipart/form-data">
               <div class="row">
                  <div class="col-md-12" id="first_step">
                     <div class="card card-primary">
                        <div class="card-body">
                           <div class="row">
                              <div class="mb-3 col-md-12">
                                 <label for="category" class="form-label">Select Category</label>
                                 <select class="form-select" name="category1" id="category1">
                                    <?php 
                                       $sql_cat = "SELECT * FROM table_category";
                                       $result_cat = $conn->query($sql_cat);
                                       while($row_cat = $result_cat->fetch_assoc()) { ?>
                                    <option value="<?php echo $row_cat['ID'];?>"><?php echo $row_cat['Category'];?></option>
                                    <?php } ?>
                                 </select>
                              </div>
                           </div>
                           <div class="mb-3">
                              <label for="name">Enter Product Name</label>
                              <input type="text" name="name" id="name" required class="form-control form-control-line" />  
                           </div>
                           <div class="mb-3">
                              <label for="name">Enter Price</label>
                              <div class="input-group mb-2">
                                 <div class="input-group-text">₱</div>
                                 <input  type="number" class="form-control" name="price" id="price" step="any">
                              </div>
                           </div>
                           <div class="row">
                              <div class="mb-3 col-md-12">
                                 <label for="status1" class="form-label">Select Status</label>
                                 <select class="form-select" name="status1" id="status1">
                                    <option value="Available">Available</option>
                                    <option value="Not Available">Not Available</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <!-- /.card-body -->
                     </div>
                     <!-- /.card -->
                  </div>
                  <!-- /.col (left) -->
               </div>
               <div class="modal-footer" id="footersave">  
                  <input type="hidden" name="product_id" id="product_id" value=""> 
                  <input type="submit" name="insert_MOP" id="insert_MOP" value="Save" class="btn btn-info">  
                  <button type="button" class="btn btn-white" data-bs-dismiss="modal" aria-label="Close" >Close</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- /.modal -->


<!--  Modal content for the Large example -->
<div class="modal fade" id="MOP_Modal1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog modal-full-width">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="myLargeModalLabel">Product Details </h4>
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
         <div class="modal-body" id="details_real" style="display: none;"> 

            <div class="row"  >
          <div class="col-md-4">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <form method="POST" enctype="multipart/form-data" id="formpic">

          <input type="hidden" name="product_id_fetch" id="product_id_fetch" value=""> 
                                     <img class="rounded-circle avatar-xl img-thumbnail mb-2" data-toggle="tooltip" accept=".jpg, .jpeg, .png" title="Browse image" data-widget="" style="cursor:pointer;max-height:130px;max-width:130px;height:130px;width:130px;" src="photos/<?php echo $Image;?>" class="rounded-circle" width="150" onclick="document.getElementById('profile_pic').click();" id="blah"/>
                                     <input type='file' accept="image/*" onchange="readURL(this);" name="profile_pic" id="profile_pic" style="display: none;" required="" />
                                     <div class="text-center text-danger" id="msg1"></div>
                                     <div id="confirm" style="display:none"><br>
                                        <button type="button" onclick="canURL()" class="btn btn-primary btn-sm"><i class="fas fa-window-close"></i></button>
                                        <button type="button"  id="submit" name="submit" class="btn btn-success btn-sm" 
                                           onclick="var frm = $('#formpic');
                                           var fd = new FormData();
                                           var files = $('#profile_pic')[0].files[0];
                                           fd.append('profile_pic',files);
                                           $.ajax({
                                           type: frm.attr('method'),                                          
                                           url: 'connections/upload.php',
                                           contentType: false,
                                           processData: false,
                                           data: fd,
                                           dataType: 'JSON',
                                           success: function (data) {
                                           if(data=='Files has been Save!'){
                                            $('#confirm').css('display', 'none'); 
                                             fetch_product();
                                           }
                                           else{
                                           document.getElementById('msg1').innerHTML=data;
                                           }
                                           },
                                           });
                                           "><i class="fas fa-save"></i></button>
                                     </div>

              </form>

                </div>

                                <div class="card card-body">

                            <div class="mb-1">
                              <label for="name">Product Name:</label>
                              <div class="input-group mb-2">
                                 <div class="input-group-text"><i class="fab fa-product-hunt"></i></div>
                                 <input  type="text" class="form-control" name="productname" id="productname">
                              </div>
                           </div>

                           <div class="mb-1">
                              <label for="name">Category:</label>
                              <div class="input-group mb-2">
                                 <div class="input-group-text"><i class="fas fa-list"></i></div>
                                 <input  type="text" class="form-control" name="category_details" id="category_details" readonly="">
                              </div>
                           </div>

                           <div class="mb-1">
                              <label for="name">Price:</label>
                              <div class="input-group mb-2">
                                 <div class="input-group-text">₱</i></div>
                                 <input  type="text" class="form-control" name="price_details" id="price_details">
                              </div>
                           </div>

                            <div class="row">
                              <div class="mb-3 col-md-12">
                                 <label for="status1" class="form-label">Select Status</label>
                                 <select class="form-select" name="status2_details" id="status2_details">
                                    <option value="Available">Available</option>
                                    <option value="Not Available">Not Available</option>
                                 </select>
                              </div>
                           </div>

                                    <a href="#" class="btn btn-primary save_details" name="save_details" id="save_details">Save Changes</a>
                                </div>

              

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

          <div class="col-md-4">
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card card-body">
                                    <h4 class="card-title" id="title"></h4> 
                                    <div id="sheet_ingredients"></div>
                              
                                </div>
                            </div>
                        </div>

          </div>
           <div class="col-md-4">
                         <div class="row">
                            <div class="col-sm-12">
                                <div class="card card-body">
                                    <h4 class="card-title">Inventory List</h4> 
                                     <div id="sheet_inventory"></div>
                                </div>
                            </div>
                        </div>

          </div>
          <!-- /.col (left) -->
        
        </div>
        <!-- /.row -->
         </div>
      </div>
   </div>
</div>
<!-- /.modal -->


<script type="text/javascript">
   $(document).ready(function() {

    $('#MOP_Modal1').on('hidden.bs.modal', function() {

        $("#content").load("<?php echo $route_dataentry; ?>products.php");
        $("#sheet_inventory").empty();
        $("#sheet_ingredients").empty();
    })
});

var defaultimage = "";
var ajaxLoading = false;

function delete_ingredients(id) {

    swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this Data!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        },
        function() {
            $.ajax({
                url: 'connections/actions.php',
                type: 'post',
                data: {
                    'action_delete_ingredients': 1,
                    'id': id,
                },
                success: function(response) {
                    if ($.trim(response) == 'deleted') {

                        setTimeout(function() {
                            swal({
                                title: "Awesome!",
                                text: "Data has been deleted.",
                                type: "success"
                            }, function() {
                                // showCustomer();

                                $("#sheet_inventory").empty();
                                $("#sheet_ingredients").empty();
                                fetch_product();
                                fetch_inventory();
                                fetch_ingredients();
                            });
                        }, 1);


                    }
                }
            });
        });
}



function delete_product(id) {

    swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this Data!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        },
        function() {
            $.ajax({
                url: 'connections/actions.php',
                type: 'post',
                data: {
                    'action_delete_product': 1,
                    'id': id,
                },
                success: function(response) {
                    if ($.trim(response) == 'deleted') {

                        setTimeout(function() {
                            swal({
                                title: "Awesome!",
                                text: "Data has been deleted.",
                                type: "success"
                            }, function() {
                                $("#content").load("<?php echo $route_dataentry; ?>products.php");
                            });
                        }, 1);


                    }
                }
            });
        });
}


function readURL(event) {
    var selectedFile = event.files[0];
    var reader = new FileReader();

    var imgtag = document.getElementById("blah");
    imgtag.title = selectedFile.name;

    reader.onload = function(event) {
        imgtag.src = event.target.result;
        var a = document.getElementById("confirm");
        a.style.display = 'block';
    };

    reader.readAsDataURL(selectedFile);
}

function canURL(input) {
    $('#blah')
        .attr('src', "photos/" + defaultimage)
        .width(150)
        .height(150);
    var a = document.getElementById("confirm");
    var aa = document.getElementById("msg1");
    a.style.display = 'none';
    aa.style.display = 'none';
}




function set_session_product() {

    $.ajax({
        url: 'connections/actions.php',
        type: 'post',
        data: {
            'set_product_session': 1,
            'id': $('#product_id_fetch').val(),
        },
        success: function(response) {
            console.log(response)
        }
    });

}

function fetch_inventory() {

    $.ajax({
        url: 'connections/actions.php',
        type: 'post',
        data: {
            'action_fetch_inventory_from_product': 1,
            'product_id': $('#product_id_fetch').val(),
        },
        dataType: "html", //expect html to be returned     
        success: function(data) {
            // document.getElementById("sheet_inventory").html = data;
            $("#sheet_inventory").empty();
            $('#sheet_inventory').append(data);

            // $('#example3').dataTable().clear();
            $("#example3").DataTable({
                "destroy": true,
                ordering: false,
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "pageLength": 10,
                "searching": true,
                "bInfo": true,
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            });


            $("#details_real").css("display", "block");
            $("#details_place").css("display", "none");
        }
    });
    return false;
}

function fetch_ingredients() {
    $.ajax({
        url: 'connections/actions.php',
        type: 'post',
        data: {
            'action_fetch_ingredients': 1,
            'product_id': $('#product_id_fetch').val(),
        },
        dataType: "html", //expect html to be returned     
        success: function(data) {

            // document.getElementById("sheet_ingredients").html = data;
             $("#sheet_ingredients").empty();
            $('#sheet_ingredients').append(data);

            // $('#example4').dataTable().clear();
            $("#example4").DataTable({
                "destroy": true,
                ordering: false,
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "pageLength": 10,
                "searching": true,
                "bInfo": true,
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            });


        }
    });
    return false;
}

function fetch_product() {
    $.ajax({
        url: 'connections/actions.php',
        type: 'post',
        dataType: 'json',
        data: {
            'action_fetch_product_modal': 1,
            'product_id': $('#product_id_fetch').val(),
        },

        success: function(data) {
            $('#title').text('Ingredients for ' + data.Product);
            $('#productname').val(data.Product);
            $('#category_details').val(data.Category);
            $('#price_details').val(data.Price);
            $('#status2_details').val(data.Status);
            defaultimage = data.Image;
            $('#blah')
                .attr('src', "photos/" + data.Image)
                .width(150)
                .height(150);
        }
    });
    return false;
}

$(document).ready(function() {

    $(document).on('click', '.edit_MOP', function() {
        if (!ajaxLoading) {
            ajaxLoading = true;
            var MOP_ID = $(this).attr("id");
            set_session_product();
            $('#MOP_Modal1').modal('show');
            $('#product_id_fetch').val(MOP_ID);
            fetch_product();
            fetch_inventory();
            fetch_ingredients();
            ajaxLoading = false;
        }

    });


    $(document).on('click', '.save_details', function() {
        swal({
                title: "",
                text: "Are you sure you want to update?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, update it!",
                closeOnConfirm: false,
                showLoaderOnConfirm: true
            },
            function() {

                $.ajax({
                    url: 'connections/actions.php',
                    type: 'post',
                    data: {
                        'action_update_product': 1,
                        'productname': $('#productname').val(),
                        'price': $('#price_details').val(),
                        'status': $('#status2_details').val(),
                        'id': $('#product_id_fetch').val(),
                    },
                    success: function(response) {
                        if ($.trim(response) == 'updated') {
                            setTimeout(function() {
                                swal({
                                    title: "Awesome!",
                                    text: "Data has been updated.",
                                    type: "success"
                                }, function() {
                                    fetch_product();
                                });
                            }, 1);
                        }
                    }
                });


            });
    });

    $(document).on('click', '.add_ingredients', function(e) {

        if (!ajaxLoading) {
            ajaxLoading = true;

            var MOP_ID = $(this).attr("id");

            if ($('#quanityadd' + MOP_ID).val() <= 0) {
                // toastr.error('Value must be greater than 0.');
                swal({
                    title: "Warning!",
                    text: "Value must be greater than 0.",
                    type: "error"
                });
                return;
            }

            $.ajax({
                url: 'connections/actions.php',
                type: 'post',
                data: {
                    'action_add_ingredients': 1,
                    'product_id': $('#product_id_fetch').val(),
                    'inventory_id': MOP_ID,
                    'qty': $('#quanityadd' + MOP_ID).val(),
                },

                success: function(response) {
                    if ($.trim(response) == 'added') {
                        // location.reload();
                        //  setTimeout(function() {
                        //       swal({
                        //           title: "Awesome!",
                        //           text: "Ingredients has been added.",
                        //           type: "success"
                        //       }, function() {                       
                        $("#sheet_inventory").empty();
                        $("#sheet_ingredients").empty();
                        fetch_inventory();
                        fetch_ingredients();
                        ajaxLoading = false;
                        //       });
                        //   }, 1);
                    }
                }
            });


        }
    });


    $(document).on('click', '.update_ingredients', function(e) {
        var MOP_ID = $(this).attr("id");
        if ($('#quanityupdate' + MOP_ID).val() <= 0) {
            swal({
                title: "Warning!",
                text: "Value must be greater than 0.",
                type: "error"
            });
            return;
        }

        $.ajax({
            url: 'connections/actions.php',
            type: 'post',
            data: {
                'action_update_ingredients': 1,
                'inventory_id': MOP_ID,
                'qty': $('#quanityupdate' + MOP_ID).val(),
            },
            success: function(response) {
                if ($.trim(response) == 'updated') {

                    setTimeout(function() {
                        swal({
                            title: "Awesome!",
                            text: "Ingredients has been updated.",
                            type: "success"
                        }, function() {
                            $("#sheet_ingredients").empty();
                            fetch_ingredients();
                        });
                    }, 1);
                }
            }
        });

        e.stopImmediatePropagation();
        return false;
    });



    $(document).on('click', '.add_products', function() {
        $('#insert_MOP').val("Save");
        $('#product_id').val("");
        $('#submit_MOP')[0].reset();
        $('#MOP_Modal').modal('show');
    });
    $(document).on('click', '.add_products1', function() {
        $('#MOP_Modal1').modal('show');
    });

    $('#submit_MOP').on("submit", function(event) {
        event.preventDefault();
        $.ajax({
            url: 'connections/actions.php',
            type: 'post',
            dataType: 'json',
            data: {
                'action_add_product': 1,
                'category': $('#category1').val(),
                'name': $('#name').val(),
                'price': $('#price').val(),
                'status': $('#status1').val(),
            },
            success: function(response) {

                // window.location = "products_edit.php?ID=" +  response.ID ;
                setTimeout(function() {
                    swal({
                        title: "Awesome!",
                        text: "Data has been saved.",
                        type: "success"
                    }, function() {
                        //     location.reload();
                        // window.location = "products_edit.php?ID=" +  response.ID ;
                        set_session_product();
                        $('#MOP_Modal1').modal('show');
                        // $("#content").load("<?php echo $route_dataentry; ?>products.php");
                        $('#submit_MOP')[0].reset();
                        $('#MOP_Modal').modal('hide');
                        $('#product_id_fetch').val(response.ID);
                        fetch_product();
                        fetch_inventory();
                        fetch_ingredients();

                    });
                }, 1);
            }
        });


    });


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
 newPageTitle =  val +' - Products';
document.querySelector('title').textContent = newPageTitle;
</script>