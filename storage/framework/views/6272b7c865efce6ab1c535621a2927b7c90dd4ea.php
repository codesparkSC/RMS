
<?php $__env->startSection('title'); ?>
    Sellers
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<!--datatable css-->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    
    <div class="row">
        
        <!-- end col -->

        <div class="col-xl-12 col-lg-12">
            <div>
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row g-4">
                            <div class="col-sm-6">
                                 
                            </div>
                         


                            <div class="col-sm-6 text-end">
                                <div>
                                    <a href="<?php echo e(url('/add_product')); ?>" class="btn btn-success" ><i
                                            class="ri-add-line align-bottom me-1"></i> Add Seller</a>
                                </div>
                            </div>
                           
                        </div>
                    </div>

                    
                    <!-- end card header -->
                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    
                                    <div class="card-body">
                                        <table id="seller_list" class="display table table-bordered dt-responsive" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No</th>
                                                    <th>Name</th>
                                                    <th>Registered Name</th>
                                                    <th>Email</th>
                                                    <th>Mobile No</th>
                                                    <th>Status</th>
                                                   
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                        </div>

                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->


    <!-- removeItemModal -->
    <div id="removeItemModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Are you Sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you Sure You want to <b id="profile_status"></b> this Seller ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn w-sm btn-danger " id="delete-seller">Yes, Do It!</button>
                    </div>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



<script src="<?php echo e(URL::asset('assets/js/pages/datatables.init.js')); ?>"></script>

<script src="<?php echo e(URL::asset('/assets/js/app.min.js')); ?>"></script>
<script>
    $(document).ready(function(){
      

     var product_table =$('#seller_list').DataTable({
        proccessing: true,
        serverSide: true,
        searching: true,
        bFilter: true,
        ajax: {
            url: base_url+"list_seller",
            type: "POST",
            data:function(d) {
           
        },
            },
        columns: [
            { data: "id", render: function (data, type, row, meta) {return meta.row + meta.settings._iDisplayStart + 1;}},
            { data: 'name' },
            { data: 'company_name' },
            { data: 'email_id' },
            { data: 'mobile_no' },
            { data: 'profile_status',render: function (data, type, row, meta) {return (data==1) ? '<span class="badge bg-danger">Inactive</span>' :'<span class="badge bg-success">Active</span>'} },
            { data: 'id',render:function(data,type,row){ 
                return `<div class="dropdown">
						<button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
						<i class="ri-more-fill"></i>
						</button>
						<ul class="dropdown-menu dropdown-menu-end">
						
						<li><a class="dropdown-item edit-list" onclick="openstatusmodel('${row.id}','${row.profile_status}')"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Change Status</a></li>
						<li class="dropdown-divider"></li>
						
						</ul>
						</div>`
            } 
             },

           //<li><a class="dropdown-item remove-list" href="#" data-id='${data}' onclick="opendeletmodel(${data})" ><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</a></li>
        ]
    });
});

    // $('.seller_list').change(function () {
    //     console.log($('[name=seller_id]').val())
    //     product_table.ajax.reload();
    //   })
    
    // });

    function openstatusmodel(id,status)
    {
        console.log(status)
        var change_status=status==1 ? 'Active' :'Inactive';
        var profile_status=(parseInt(status)==1) ? 0:1;
        console.log('profile: '+profile_status)
        $('#removeItemModal').modal('show');
        $('#profile_status').text(change_status);
          $("#delete-seller").replaceWith(`<a href="#" class="btn btn-danger m-2"  onclick="update_seller('${id}','${profile_status}')">Yes, Do it</a>`);
    }

    function deleteProduct(id)
      {
          $('#removeItemModal').modal('hide');
        $.ajax({
                type: "POST",
                url: base_url+"delete_seller",
                data: {seller_id:id},
                success: function(result) {
                    console.log("ajax data=", result)
                    if(result.success==true)
                    {
                        $('#seller_list').DataTable().ajax.reload();
                    }      
                    $('#success_msg').attr('data-toast-text',result.message).trigger('click');
                },
                error: function(error) {
                    console.log(error)
                    $('#error_msg').attr('data-toast-text',error.responseJSON.message).trigger('click');
                 }
                });
    
      }


      function update_seller(id,status)
      {
        console.log(id + status)
        $('#removeItemModal').modal('hide');
        $.ajax({
                type: "POST",
                url: base_url+"update_seller_status",
                data: {id:id,status:status},
                success: function(result) {
                    console.log("ajax data=", result)
                    if(result.success==true)
                    {
                        $('#seller_list').DataTable().ajax.reload();
                    }      
                    $('#success_msg').attr('data-toast-text',result.message).trigger('click');
                },
                error: function(error) {
                    console.log(error)
                    $('#error_msg').attr('data-toast-text',error.responseJSON.message).trigger('click');
                 }
                });
      }

     


    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\order_now_admin\resources\views/sellers.blade.php ENDPATH**/ ?>