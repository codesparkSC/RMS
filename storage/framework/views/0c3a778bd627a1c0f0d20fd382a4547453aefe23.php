
<?php $__env->startSection('title'); ?>
  <?php echo e($title); ?> Restaurant Details
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
        Restaurant
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Basic Details
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Restaurant</h4>
                    
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <form id="seller_form" enctype="multipart/form-data"> 
                        <div class="row gy-4">
                        <input type="hidden" name="seller_id" id="seller_id" value="<?php echo e(Auth::user()->seller_id); ?>">
                        <input type="hidden" name="status" id="status" value="<?php echo e($status); ?>">
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="placeholderInput" class="form-label">Registered Name Of Restaurant <span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" id="restaurant_name"  placeholder="Enter Registered Name Of Restaurant" name="restaurant_name">
                                </div>
                            </div>
                      
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="placeholderInput" class="form-label">Nick Name Of Restaurant <span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" id="nick_name"
                                        placeholder="Enter Nick Name Of Restaurant (Which displayed on Front As Restaurant Name)" name="nick_name">
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="placeholderInput" class="form-label">Owner Name <span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" id="name"  placeholder="Enter Owner Name" name="name" value="<?php echo e(Auth::user()->name); ?>">
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="iconInput" class="form-label">Email ID <span class="text-danger"> *</span></label>
                                    <div class="form-icon">
                                        <input type="email" class="form-control form-control-icon" id="email"  placeholder="Enter Email" name="email" value="<?php echo e(Auth::user()->email); ?>">
                                        <i class="ri-mail-unread-line"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="placeholderInput" class="form-label">Mobile No <span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" id="mobile_no" placeholder="Enter Mobile No" name="mobile_no" value="<?php echo e(Auth::user()->name); ?>" maxlength="12">
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="placeholderInput" class="form-label">Support Contact No For Restaurant <span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" id="contact_no"  placeholder="Enter Support Contact No for Restaurant" name="contact_no">
                                </div>
                            </div>

                            
                            
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="Country" class="form-label">Currency <span class="text-danger"> *</span></label>
                                    <select class="currency" name="currency" id="currency" placeholder="Select Currency"  ></select>
                                </div>
                            </div>

                            
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="placeholderInput" class="form-label">Company Registration No <span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" id="company_no"  placeholder="Enter Company Registration No" name="company_no">
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="Type" class="form-label">Restaurant Type <span class="text-danger"> *</span></label>
                                    <select class="form-control" name="res_type" id="res_type" placeholder="Select Restaurant Type"  >
                                        <option>Select Restaurant Type</option>
                                        <option value="1">Prepaid</option>
                                        <option value="2">Postpaid</option>
                                    </select>
                                </div>
                            </div>

                            <h5 class="fs-14">Alternative Contact Details
                                
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="same_contact" name="same_contact" value="1" >
                                        <label class="form-check-label" for="inlineCheckbox1">Same As Above</label>
                                     
                                    </div>
                                   
                            </h5>
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="placeholderInput" class="form-label">Alternative Name  <span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" id="additional_name"  placeholder="Enter Name" name="additional_name">
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-6">
                                
                                <div>
                                    <label for="iconInput" class="form-label">Alternative Email ID <span class="text-danger"> *</span></label>
                                    <div class="form-icon">
                                        <input type="email" class="form-control form-control-icon" id="additional_email"  placeholder="Enter Email" name="additional_email">
                                        <i class="ri-mail-unread-line"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="placeholderInput" class="form-label">Alternative Mobile No <span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" id="additional_mobile_no"  placeholder="Enter Mobile No" name="additional_mobile_no" maxlength="12">
                                </div>
                            </div>
                          
                            
                            <!--end col-->
                            <h5 class="fs-14">Restaurant Address</h5>
                            <div class="col-xxl-3 col-md-12">
                                <div>
                                    <label for="placeholderInput" class="form-label">Address Line 1 <span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" id="address_line_1"   placeholder="Enter Address Line 1" name="address_line_1">
                                </div>
                            </div>
                         
                            <div class="col-xxl-3 col-md-12">
                                <div>
                                    <label for="placeholderInput" class="form-label">Address Line 2 </label>
                                    <input type="text" class="form-control" id="address_line_2"  placeholder="Enter Address Line 2" name="address_line_2">
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-12">
                                <div>
                                    <label for="placeholderInput" class="form-label">LandMark <span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" id="landmark"  placeholder="Enter Landmark" name="landmark">
                                </div>
                            </div>

                            
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="Country" class="form-label">Country <span class="text-danger"> *</span></label>
                                    <select class="country" name="country" id="country" placeholder="Select Country"  ></select>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="State" class="form-label">State <span class="text-danger"> *</span></label>
                                    <select class="state" name="state" id="state" placeholder="Select State"  ></select>
                                </div>
                            </div>


                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="City" class="form-label">City </label>
                                    <select class="city" name="city" id="city" placeholder="Select City"  ></select>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="placeholderInput" class="form-label">Zipcode <span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" id="zipcode"  placeholder="Enter Zipcode" name="zipcode">
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <div class="form-check form-switch form-switch-success form-switch-lg mt-4">
                                        <input class="form-check-input" type="checkbox" role="switch" id="tax">
                                        <input type="hidden" name="tax" value="0">
                                        <label class="form-check-label" for="SwitchCheck3">GST Registration No <span class="text-danger"> *</span></label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-6 gst_div" style="display:none;">
                                <div>
                                    <label for="placeholderInput" class="form-label">GST NO <span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" id="gst_no"   placeholder="Enter GST NO" name="gst_no">
                                </div>
                            </div>


                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <div class="form-check form-switch form-switch-success form-switch-lg mt-4">
                                        <input class="form-check-input" type="checkbox" role="switch" id="vat_check">
                                        <input type="hidden" name="vat_check" value="0">
                                        <label class="form-check-label" for="SwitchCheck3">Vat Registration No <span class="text-danger"> *</span></label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-6 vat_div" style="display:none;">
                                <div>
                                    <label for="placeholderInput" class="form-label">VAT NO <span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" id="vat_no"   placeholder="Enter VAT NO" name="vat_no">
                                </div>
                            </div>

                            <h5 class="fs-14">Payment Details</h5>
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="placeholderInput" class="form-label">Bank Name <span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" id="bank_name"  placeholder="Enter Bank Name" name="bank_name">
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="placeholderInput" class="form-label">Account holder Name <span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" id="bank_account_name" placeholder="Enter Account Holder Name" name="bank_account_name">
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="placeholderInput" class="form-label">Bank Account No <span class="text-danger"> *</span></label>
                                    <input type="number" class="form-control" id="bank_account_no"  placeholder="Enter Bank Account No" name="bank_account_no">
                                </div>
                            </div>

                            <h5>Logo </h5>
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="placeholderInput" class="form-label">Logo Upload </label>
                                    <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                                    <p class="text-warning">Note : Please upload file of Width:400px, Height:200px, File Size:500kb and Type :JPEG,PNG,JPG </p>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-6" id="showlogo" style="display:none;">
                                <img src="" class="path_logo"/>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $("#tax").change(function () {
    var tax = false;
    if ($(this).prop('checked') == true) {
        tax = true;
        $('.gst_div').show();
        $('input[name=tax]').val('1');
    } else {
        tax = false;
        $('.gst_div').hide();
        $('input[name=tax]').val('0');
    }
}
);

$("#vat_check").change(function () {
    var tax = false;
    if ($(this).prop('checked') == true) {
        tax = true;
        $('.vat_div').show();
        $('input[name=vat_check]').val('1');
    } else {
        tax = false;
        $('.vat_div').hide();
        $('input[name=vat_check]').val('0');
    }
}
);



        $(document).ready(function(){
            
            jQuery.validator.addMethod("alphanumeric", function(value, element) {
    return this.optional(element) || /^[\w.]+$/i.test(value);
}, "Letters, numbers, and underscores only please");

            $(".country,.state,.city,.currency").select2({
                placeholder: "Please select "
            })
            country_list();
            currency_list();
            getseller();
        var status=$('#status').val();
        console.log(status)
        $("#seller_form").validate({
            rules: {
                 restaurant_name: "required",
                nick_name: "required",
                name: "required",
                email: "required",
                mobile_no: "required",
                contact_no: "required",
                currency: "required",
                company_no: "required",
                res_type: "required",
                additional_name: "required",
                additional_email: "required",
                additional_mobile_no: "required",
                address_line_1: "required",
               // address_line_2: "required",
                  //  city: "required",
                landmark: "required",
                country: "required",
                state: "required",
                zipcode: "required",
                bank_name: "required",
                bank_account_name: "required",
                bank_account_no: "required",
                gst_no:{
                    required:{ depends:function(element){return (($('#tax').prop('checked'))==true) ? true:false;}},
                    alphanumeric: { depends:function(element){return (($('#tax').prop('checked'))==true) ? true:false;}}
            },
                vat_no:{required:{depends:function(element){return (($('#vat_check').prop('checked'))==true) ? true:false; }},
                alphanumeric: { depends:function(element){return (($('#vat_check').prop('checked'))==true) ? true:false;}}
            },
                logo: {required:{
                    depends:function(element){
                    return (status==parseInt(0)) ? true:false;
                }}
            },
            },
            // Specify validation error messages
            messages: {
                restaurant_name: "Please Enter Shop Name",
                nick_name: "Please Enter Nick Name",
                name: "Please Enter Name",
                email: "Please Enter Email ID",
                mobile_no: "Please Enter Mobile NO",
                contact_no: "Please Enter Contact No",
                currency: "Please Select Currency",
                company_no: "Please Enter Company Registration No ",
                res_type:"Please Select Restaurant Type",
                additional_name: "Please Enter Additional Contact Name",
                additional_email: "Please Enter Additional Contact Email",
                additional_mobile_no: "Please Enter Additional Contact Mobile No",
                address_line_1: "Please Enter Address line 1",
              //  address_line_2: "Please Enter Address line 2",
                landmark: "Please Enter Landmark",
                country: "Please Select Country",
                state: "Please Select State",
              //  city: "Please Select City",
                zipcode: "Please Enter ZipCode",
                gst_no:"Please Enter Valid GST NO",
                vat_no:"Please Enter Valid VAT NO",
                bank_name: "Please Enter Bank Name",
                bank_account_name: "Please Enter Account Holder Name",
                bank_account_no: "Please Enter Account No",
                logo: "Please Upload Logo",
            },

            submitHandler: function(form) {
                var form=new FormData($('#seller_form')[0]);
                console.log(form)
                var url=base_url+"save_seller_details";
                var method='POST';
                var msg="Data has been stored";
                // if(surveyId!=="")
                // {
                //     url=applink+"/survey/"+surveyId;
                //     method="PUT";
                //     msg="Data has been Updated";
                //     country='disable';
                // }
                
                $.ajax({
                    type: method,
                    url: url,
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData:false,
                    data: form,
                  
                    // crossDomain:true,
                    success: function(success) {
                        console.log("ajax data=", success)
                        toast_success(success.message)   
                      
                       window.location.href='/';
                    },
                    error: function(error) {
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

  let seller_details='';
    function getseller()
    {
        var id=$('#seller_id').val();
        $.ajax({
                type: "POST",
                url: base_url+"get_seller_details/",
                data: {seller_id:id},
                  
                    // crossDomain:true,
                success: function(result) {
                    console.log("ajax data=", result)
                    seller_details=result.data;
                    if(result.success==true)
                    {
                        var data=result.data;
                        $('#name').val(data.company.name);
                        $('#email').val(data.company.email_id);
                        $('#mobile_no').val(data.company.mobile_no); 
                        $('#restaurant_name').val((data.company.company_name)??''); 
                        $('#nick_name').val((data.company.nick_name)??''); 
                        $('#contact_no').val((data.company.contact_no)??''); 
                        $('#company_no').val((data.company.company_no)??''); 
                        $('#res_type').val((data.company.res_type)??''); 
                        $('#additional_name').val((data.company.additional_name)??''); 
                        $('#additional_email').val((data.company.additional_email)??''); 
                        $('#additional_mobile_no').val((data.company.additional_mobile_no)??''); 
                     
                        if(data.company.same_details==1)
                        {
                            $('#same_contact').attr('checked','checked');
                        }

                        if(data.company.logo)
                        {
                            $('#showlogo').show();
                            $('.path_logo').attr("src",data.company.logo);
                        }

                         if(data.address !=null && data.address.seller_id==id)
                         {
                            $('#address_line_1').val((data.address.address_line_1)??''); 
                            $('#address_line_2').val((data.address.address_line_2)??''); 
                            $('#landmark').val((data.address.landmark)??''); 
                            $('#country').val((data.address.country)??'').trigger('change'); 
                            // $('#state').val((data.address.state)??''); 
                            // $('#city').val((data.address.city)??''); 
                            $('#zipcode').val((data.address.zipcode)??''); 
                            $('#tax').val((data.address.tax)??''); 
                            if(data.address.tax==1)
                            {
                             $('#tax').attr('checked','checked').trigger('change');
                            }
                            $('#gst_no').val((data.address.gst_no)??''); 

                            if(data.address.vat==1)
                            {
                             $('#vat_check').attr('checked','checked').trigger('change');
                            }
                            $('#vat_no').val((data.address.vat_no)??''); 

                         }

                         if(data.bank.seller_id==id)
                         {
                            $('#bank_name').val((data.bank.bank_name)??''); 
                            $('#bank_account_name').val((data.bank.bank_account_name)??''); 
                            $('#bank_account_no').val((data.bank.bank_account_no)??''); 
                         }
                         console.log("currency :"+data.company.currency_id)
                        $('#currency').val(data.company.currency_id).trigger('change'); 
                         
                    }
                        
                },

                error: function(error) {
                    $('#loader1').hide();
                    console.log(error)
                    toast_error('Something Went Wrong')
                   // $('#error_msg').attr('data-toast-text','Something Went Wrong').trigger('click');
                   // alert_error('Something Wrong') 
                 }
                });
    }

    function same_details()
    {
        if ($(this).prop('checked') == true) {
            console.log('same true')
      } else {
        console.log('same false')
      }
      
    }

    $("#same_contact").change(function () {
    var same = false;
    if ($(this).prop('checked') == true) {
        same = true;
        $('#additional_name').val($('#name').val());
        $('#additional_email').val($('#email').val());
        $('#additional_mobile_no').val($('#mobile_no').val());
     
    } else {
        same = false;
        $('#additional_name').val('');
        $('#additional_email').val('');
        $('#additional_mobile_no').val('');
    }
    console.log("Same "+same)
}
);


    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\erp2\resources\views/seller_form.blade.php ENDPATH**/ ?>