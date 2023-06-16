
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.signup'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="index" class="d-inline-block auth-logo">
                                    <img src="<?php echo e(URL::asset('assets/images/logo.png')); ?>" alt="" height="120">
                                </a>
                            </div>
                           
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Create New Account</h5>
                                  
                                </div>
                                <div class="p-2 mt-4">
                                    <form id="register">
                                      

                                        <div class="mb-3">
                                            <label for="username" class="form-label">Full Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control "
                                                name="name" value="<?php echo e(old('name')); ?>" id="username"
                                                placeholder="Enter Full Name" required>
                                           
                                        </div>
                                        <div class="mb-3">
                                            <label for="useremail" class="form-label">Email <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" class="form-control"
                                                name="email" value="<?php echo e(old('email')); ?>" id="useremail"
                                                placeholder="Enter email address" required>
                                          
                                        </div>
                                       
                                        <div class="mb-3">
                                            <label for="Mobile_no" class="form-label">Mobile NO. <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" class="form-control"
                                                name="mobile_no" value="<?php echo e(old('mobile_no')); ?>" id="mobile_no"
                                                placeholder="Enter Mobile NO" required>
                                          
                                        </div>

                                        <div class="mb-2">
                                            <label for="userpassword" class="form-label">Password <span
                                                    class="text-danger">*</span></label>
                                            <input type="password"
                                                class="form-control" name="password"
                                                id="userpassword" placeholder="Enter password" required>
                                            
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" name="agree_check" id="agree_check">
                                            <label class="form-check-label" for="auth-remember-check">I Agree Terms & Condition </label>
                                        </div>
                                        
                                        <div class="mt-4">
                                            <button class="btn btn-success w-100 send_otp" type="button" onclick="sendotp()">Send OTP
                            </div>

                <div class="mt-4" id="verify_div" style="display:none;">
                    <div class="mb-2">
                        <label for="otp" class="form-label">Enter OTP <span
                                class="text-danger">*</span></label>
                        <input type="number"
                            class="form-control" name="otp"
                            id="otp" placeholder="Enter OTP" >
                        
                    </div>

                            <div class="mt-4">
                                <button class="btn btn-success w-100" type="button" onclick="verifyotp()">Verify OTP
                             </div>
                </div>
                                    </form>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="mt-4 text-center">
                            <p class="mb-0">Already have an account ? <a href="<?php echo e(url('/login')); ?>"
                                    class="fw-semibold text-primary text-decoration-underline"> Signin </a> </p>
                        </div>

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy; <script>document.write(new Date().getFullYear())</script> Boleh Store Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(URL::asset('assets/libs/particles.js/particles.js.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/js/pages/particles.app.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/js/pages/form-validation.init.js')); ?>"></script>

  
    <script>
        $(document).ready(function() {    
        });  

        function sendotp(){ 
        if($('#username').val() =='' || $('#useremail').val() =='' || $('#mobile_no').val() =='' || $('#userpassword').val() =='' || $('#agree_check')[0].checked==false)
        {
            alert_error('Please Fill All Details.')
           return false;
        }
        else{
            $.ajax({
                url: base_url+"sendotp",
                type: "POST",
                data: $('#register').serialize(),
                success: function(result){
                   console.log(result.message)
                   alert_success(result.message);
                   $('.send_otp').hide();
                  $('#verify_div').show();
                  $('#otp').val(result.data.otp);
                },
                error: function(error) {
                    // there was an error
                    console.log(error.responseJSON.message);
                    alert_error(error.responseJSON.message)  
                }
            });
        }
            
        }


        function verifyotp()
        {
            if($('#otp').val() =='' || $('#useremail').val() ==''){
            alert_error('Please Enter OTP!')  
              return false;
            }
            else{
                $.ajax({
                url: base_url+"verifyotp",
                type: "POST",
                data: {email:$('#useremail').val(),otp:$('#otp').val()},
                success: function(result){
                   console.log(result.message)
                   alert_success(result.message);
                   window.location.href = "/";
                },
                error: function(error) {
                    // there was an error
                    console.log(error.responseJSON.message);
                    alert_error(error.responseJSON.message)  
                }
            });
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master-without-nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\order_now_admin\resources\views/auth/register.blade.php ENDPATH**/ ?>