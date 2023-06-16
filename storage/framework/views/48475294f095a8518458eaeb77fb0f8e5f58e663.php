
<?php $__env->startSection('title'); ?>
<?php echo e($title); ?>  Order 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Orders
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
        <?php echo e($title); ?> Order
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Order</h4>
                    
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <form id="table_no" > 
                        <div class="row gy-4">
                        <input type="hidden" name="seller_id" id="seller_id" value="<?php echo e(Auth::user()->seller_id); ?>">
                        <input type="hidden" name="table_id" id="table_id" value="<?php echo e($id); ?>">
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="placeholderInput" class="form-label">Select Section <span class="text-danger"> *</span></label>
                                    <select class="form-select" aria-label="Select Section" name="section" id="section">
                                        <option value=''>Select Section</option>
                                       
                                    </select>
                                </div>
                            </div>

                             <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="placeholderInput" class="form-label">Table Name  <span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" id="table_name"  placeholder="Enter Table Name" name="table_name" maxlength="100">
                                </div>
                            </div>

                           
                        </div>
                        <!--end row-->
                        <button class="btn btn-primary text-right mt-4" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->

  
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(URL::asset('/assets/libs/prismjs/prismjs.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/js/app.min.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 


    <script>
        $(document).ready(function(){
            var table_id=$('#table_id').val();
            // getcurrency();
            getsection();
        gettable(table_id);
        $("#table_no").validate({
            rules: {
                table_name: "required",
            },
        
            // Specify validation error messages
            messages: {
                table_name: "Please Enter Table Name",
            },

            submitHandler: function(form) {
                // var form=new FormData($('#table_no')[0]);
                // console.log(form)
                var url=base_url+"save_table";
                var method='POST'
                if(table_id!="0")
                {
                    url=base_url+"update_table";
                    method="POST";
                }
                
                $.ajax({
                    type: method,
                    url: url,
                    data: $('#table_no').serialize(),
                  
                    // crossDomain:true,
                    success: function(success) {
                        console.log("ajax data=", success)
                       // alert_success(success.message);
                       toast_success(success.message)
                        window.location.href='/tables';
                    },
                    error: function(xhr, status, error) {
                        let errors_msg="";
                            $.each( xhr.responseJSON.errors, function( key, value ) {
                                errors_msg+=`${value}\n`;
                            });
                            console.log(errors_msg)
                            toast_error(errors_msg)
                    }
                });
            }
        });
    });


    function gettable(table_id)
    {
       
        if(table_id !=0){
        $.ajax({
                type: "POST",
                url: base_url+"get_table/",
                data: {table_id:table_id},
                success: function(result) {
                    console.log("ajax data=", result)
                    if(result.success==true)
                    {
                       $('#table_name').val(result.data.table_name);
                       $('#section').val(result.data.section_id);
                    }      
                },
                error: function(error) {
                    toast_error('Something Went Wrong')
                  //  $('#error_msg').attr('data-toast-text',"Something Went Wrong").trigger('click');
                 }
                });
            }
    }

    function getsection()
    {
        var seller_id=$('#seller_id').val();
        $.ajax({
                type: "POST",
                url: base_url+"get_section",
                data: {res_id:seller_id},
                success: function(result) {
                    console.log("ajax data=", result)
                    if(result.success==true)
                    {
                        var list = $("#section");
                        list.empty().append(new Option('Select Section',''))
                        $.each(result.data, function(index, item) {
                        list.append(new Option(item.section_name, item.id));
                        });
                    }      
                },
                error: function(error) {
                    console.log(error)
                    // alert_error('Something Wrong')  
                 }
                });
    }


    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\erp2\resources\views/addorder.blade.php ENDPATH**/ ?>