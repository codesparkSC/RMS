
<?php $__env->startSection('title'); ?>
Orders
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
                               
                                <?php if(Auth::user()->role==1): ?>
                                <div class="search-box ms-2">
                                    <h6 class="fw-semibold">Seller List</h6>
                                    <select class="seller_list" name="seller_id" id="seller_id"></select>
                                </div>
                                <?php else: ?>
                                <input type="hidden" name="seller_id" id="seller_id" value=<?php echo e(Auth::user()->seller_id); ?>>
                                <?php endif; ?>
                               
                            </div>
                           
                        </div>
                    </div>
                    

                    
                    <!-- end card header -->
                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    
                                    <div class="card-body">
                                        <table id="order_list" class="display table table-bordered dt-responsive" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No</th>
                                                    <th>Order No</th>
                                                    <th>No. of Product</th>
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
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                            colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Are you Sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Product ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn w-sm btn-danger " id="delete-product">Yes, Delete It!</button>
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
        seller_list();
    $(".seller_list").select2({
})
  var product_table =  $('#order_list').DataTable({
        proccessing: true,
        serverSide: true,
        searching: true,
        bFilter: true,
        ajax: {
            url: base_url+"list_order",
            type: "POST",
            data:function(d) {
            d.seller_id=$('[name=seller_id]').val();
        },
            },
            // rowReorder: {
            //     dataSrc: "id", // changing this to nr will not help
            //     },
        columns: [
            { data: "id", render: function (data, type, row, meta) {return meta.row + meta.settings._iDisplayStart + 1;}},
            { data: 'order_no' },
            { data: 'no_proudct' },
            { data: 'order_no',render:function(data,type,row){ 
                return `<div class="dropdown">
						<button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
						<i class="ri-more-fill"></i>
						</button>
						<ul class="dropdown-menu dropdown-menu-end">
						
						<li><a class="dropdown-item edit-list" data-edit-id='${data}' href="<?php echo e(url('/orders_details/${data}')); ?>"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
						<li class="dropdown-divider"></li>
						
						</ul>
						</div>`
            } 
             },
            //<li><a class="dropdown-item remove-list" href="#" data-id='${data}' onclick="opendeletmodel(${data})" ><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</a></li>
           
        ]
    });

    $('.seller_list').change(function () {
        console.log($('[name=seller_id]').val())
        product_table.ajax.reload();
      })
    });

    function opendeletmodel(id)
    {
        console.log(id)
        $('#removeItemModal').modal('show');
          $("#delete-product").replaceWith('<a href="#" class="btn btn-danger m-2" id="delete-product" onclick="deleteProduct('+id+')">Yes, Delete it</a>');
    }

    function deleteProduct(id)
      {
          $('#removeItemModal').modal('hide');
        $.ajax({
                type: "POST",
                url: base_url+"delete_product/",
                data: {product_id:id},
                success: function(result) {
                    console.log("ajax data=", result)
                    if(result.success==true)
                    {
                        $('#product_list').DataTable().ajax.reload();
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\order_now_admin\resources\views/orders.blade.php ENDPATH**/ ?>