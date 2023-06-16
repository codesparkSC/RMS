
<?php $__env->startSection('title'); ?>
<?php echo e($title); ?>  Users 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Users
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
        <?php echo e($title); ?> User
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Users</h4>
                    
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <form id="users" > 
                        <div class="row gy-4">
                        <input type="hidden" name="seller_id" id="seller_id" value="<?php echo e(Auth::user()->seller_id); ?>">
                        <input type="hidden" name="user_id" id="user_id" value="<?php echo e($id); ?>">

                        
                        <div class="col-xxl-3 col-md-6">
                            <div>
                                <label for="placeholderInput" class="form-label">User Name  <span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" id="name"  placeholder="Enter User Name" name="name">
                            </div>
                        </div>

                        <div class="col-xxl-3 col-md-6">
                            <div>
                                <label for="placeholderInput" class="form-label">Email ID  <span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" id="email"  placeholder="Enter User Email" name="email">
                            </div>
                        </div>

                        <div class="col-xxl-3 col-md-6">
                            <div>
                                <label for="placeholderInput" class="form-label">Mobile No  <span class="text-danger"> *</span></label>
                                <input type="number" class="form-control" id="mobile_no" min=0  placeholder="Enter Mobile No" name="mobile_no">
                            </div>
                        </div>

                        <div class="col-xxl-3 col-md-6">
                            <div>
                                <label for="placeholderInput" class="form-label">Password  <span class="text-danger"> *</span></label>
                                <div class="position-relative auth-pass-inputgroup mb-3">
                                <input type="password" class="form-control" id="password" min=0  placeholder="Enter Password" name="password"> <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted toggle-password" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                </div>
                            </div>
                        </div>


                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="placeholderInput" class="form-label">Select Role <span class="text-danger"> *</span></label>
                                    <select class="form-select" aria-label="Select Role" name="role" id="role">
                                        <option value=''>Select Role</option>
                                       
                                    </select>
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
        $(document).on('click', '.toggle-password', function() {

$(this).toggleClass("fa-eye fa-eye-slash");

var input = $("#password");
input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
});

        $(document).ready(function(){
            var user_id=$('#user_id').val();
            getroles();
        getuser(user_id);
        $("#users").validate({
            rules: {
                name: "required",
                email: "required",
                mobile_no: "required",
                password: "required",
                role: "required",
            },
        
            // Specify validation error messages
            messages: {
                name: "Please Enter Name",
                email: "Please Enter Email",
                mobile_no: "Please Enter Mobile No",
                password: "Please Enter Password",
                role: "Please Select Role"
            },

            submitHandler: function(form) {
                // var form=new FormData($('#table_no')[0]);
                // console.log(form)
                var url=base_url+"save_user";
                var method='POST'
                if(user_id!="0")
                {
                    url=base_url+"update_user";
                    method="POST";
                }
                
                $.ajax({
                    type: method,
                    url: url,
                    data: $('#users').serialize(),
                  
                    // crossDomain:true,
                    success: function(success) {
                        console.log("ajax data=", success)
                       // alert_success(success.message);
                       toast_success(success.message)
                        window.location.href='/users';
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


    function getuser(user_id)
    {
       
        if(user_id !=0){
            var seller_id=$('#seller_id').val();
        $.ajax({
                type: "POST",
                url: base_url+"get_user",
                data: {user_id:user_id,seller_id:seller_id},
                success: function(result) {
                    console.log("ajax data=", result)
                    if(result.success==true)
                    {
                       $('#name').val(result.data.name);
                       $('#email').val(result.data.email);
                       $('#mobile_no').val(result.data.mobile_no);
                       $('#password').val(result.data.normal_password);
                       $('#role').val(result.data.role);
                    }      
                },
                error: function(error) {
                    toast_error('Something Went Wrong')
                  //  $('#error_msg').attr('data-toast-text',"Something Went Wrong").trigger('click');
                 }
                });
            }
    }

    function getroles()
    {
        
        $.ajax({
                type: "POST",
                url: base_url+"getroles",
                data: {},
                success: function(result) {
                    console.log("ajax data=", result)
                    if(result.success==true)
                    {
                        var list = $("#role");
                        list.empty().append(new Option('Select Role',''))
                        $.each(result.data, function(index, item) {
                        list.append(new Option(item.role_name, item.id));
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\erp2\resources\views/user_addedit.blade.php ENDPATH**/ ?>