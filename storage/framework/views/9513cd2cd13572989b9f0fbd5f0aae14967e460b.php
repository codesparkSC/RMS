
<?php $__env->startSection('title'); ?>
   Sections
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
     
        <div class="col-xl-12 col-lg-12">
            <div>
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row g-4">
                            <div class="col-sm-6">
                                
                                  
                            </div>
                         


                            <div class="col-sm-6 text-end">
                                <div>
                                    <button class="btn btn-info add-btn" data-bs-toggle="modal"
                                    data-bs-target="#showModal"><i class="ri-add-fill me-1 align-bottom"></i> Add Section</button>
                                    
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
                                        <table id="section_list" class="display table table-bordered dt-responsive" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No</th>
                                                    <th>Section</th>
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
                            <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Section?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn w-sm btn-danger" id="delete-category">Yes, Delete It!</button>
                    </div>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header bg-soft-info p-3">
                <h5 class="modal-title" id="exampleModalLabel">Section</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close" id="close-modal"></button>
            </div>
            <form id="section_form" autocomplete="off">
                <div class="modal-body">
                  
                    <div class="row g-3">
                        <input type="hidden" name="res_id" id="res_id" value=<?php echo e(Auth::user()->seller_id); ?>>
                        <input type="hidden" id="section_id" name="section_id" class="form-control" />
                        <div class="col-lg-12">
                            <div>
                                <label for="section_name" class="form-label">Section Name</label>
                                <input type="text" id="section_name" name="section_name" class="form-control" placeholder="Enter Category Name" required />
                            </div>
                        </div>
                      
                    </div>
               
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" onclick="savesection()">Save</button>
           
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


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
    //     seller_list();
    // $(".seller_list").select2({})

     var section_table =$('#section_list').DataTable({
        proccessing: true,
        serverSide: true,
        searching: true,
        bFilter: true,
        ajax: {
            url: base_url+"list_section",
            type: "POST",
            data:function(d) {
            d.res_id=$('[name=res_id]').val();
        },
            },
        columns: [
            { data: "id", render: function (data, type, row, meta) {return meta.row + meta.settings._iDisplayStart + 1;}},
            { data: 'section_name' },
            { data: 'id',render:function(data,type,row){ 
                return `<div class="dropdown">
						<button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
						<i class="ri-more-fill"></i>
						</button>
						<ul class="dropdown-menu dropdown-menu-end">
						<li class="dropdown-divider"></li>
						<li><a class="dropdown-item edit-list" data-edit-id='${data}' href="#" onclick="openEditmodel(${data})"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
						<li class="dropdown-divider"></li>
						<li><a class="dropdown-item remove-list" href="#" data-id='${data}' onclick="opendeletmodel(${data})" ><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</a></li>
						</ul>
						</div>`
            } 
             },

           
        ]
    });

    // $('.seller_list').change(function () {
    //     console.log($('[name=seller_id]').val())
    //     section_table.ajax.reload();
    //   })
    
    });

    function opendeletmodel(id)
    {
        console.log(id)
        $('#removeItemModal').modal('show');
          $("#delete-category").replaceWith('<a href="#" class="btn btn-danger m-2" id="delete-table" onclick="deleteSection('+id+')">Yes, Delete it</a>');
    }

    function deleteSection(id)
      {
          $('#removeItemModal').modal('hide');
        $.ajax({
                type: "POST",
                url: base_url+"delete_section",
                data: {section_id:id},
                success: function(result) {
                    console.log("ajax data=", result)
                    if(result.success==true)
                    {
                        $('#section_list').DataTable().ajax.reload();
                    }      
                    toast_success(result.message)
                },
                error: function(error) {
                    console.log(error)
                    toast_error(error.responseJSON.message)
                 }
                });
    
      }


      function savesection()
      {
        console.log($('#section_name').val())
        if($('#section_name').val() !='')
        {
            if($('#section_id').val() =='')
            {
                url=base_url+"save_section"
            }
            else{
                url=base_url+"update_section"
            }
            $.ajax({
                type: "POST",
                url: url,
                data: $('#section_form').serialize(),
                success: function(result) {
                    console.log("ajax data=", result)
                    if(result.success==true)
                    {
                        $('#section_list').DataTable().ajax.reload();
                    }      
                    $('#showModal').modal('hide');
                    toast_success(result.message)
                },
                error: function(error) {
                    console.log(error)
                    toast_error(error.responseJSON.message)
                 }
                });
        }
        else{
            toast_error('Please Enter Section Name');
        }
      }
     
      function openEditmodel(id)
      {
        console.log(id)
        $.ajax({
                type: "POST",
                url: base_url+"get_section",
                data: {section_id:id,res_id:$('[name=res_id]').val()},
                success: function(result) {
                    console.log("ajax data=", result)
                    if(result.success==true)
                    {
                      $('#section_name').val(result.data.section_name);
                      $('#section_id').val(result.data.id);
                      $('#showModal').modal('show');
                    }      
                  
                },
                error: function(error) {
                    toast_error(error.responseJSON.message)
                 }
                });
      }


    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\rms\resources\views/section.blade.php ENDPATH**/ ?>