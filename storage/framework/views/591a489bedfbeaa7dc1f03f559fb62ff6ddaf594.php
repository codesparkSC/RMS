
<?php $__env->startSection('title'); ?>
<?php echo e($title); ?>  Product 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Products
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
        <?php echo e($title); ?> Product
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Product</h4>
                    
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <form id="product" enctype="multipart/form-data"> 
                        <div class="row gy-4">
                        <input type="hidden" name="seller_id" id="seller_id" value="<?php echo e(Auth::user()->seller_id); ?>">
                        <input type="hidden" name="product_id" id="product_id" value="<?php echo e($id); ?>">
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="placeholderInput" class="form-label">Product Name  <span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" id="product_name"  placeholder="Enter Product Name" name="product_name" maxlength="100">
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="placeholderInput" class="form-label">Price(Without Tax) <span class="text-danger"> *</span></label>
                                    <div class="input-group has-validation mb-3">
                                        <span class="input-group-text" id="currency"></span>
                                        <input type="hidden" class="form-control"  name="currency">
                                        <input type="number" class="form-control" id="price"  placeholder="Enter price" name="price" min="0" aria-label="Price" aria-describedby="product-price-addon" required="">
                                       
                                    </div>
                                    
                                </div>
                            </div>
                      
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="placeholderInput" class="form-label">Product Weight <span class="text-danger"> *</span></label>
                                    <input type="number" class="form-control" id="quantity" placeholder="Enter Product Weight" name="quantity" min="0">
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="Country" class="form-label">Weight Scale <span class="text-danger"> *</span></label>
                                    <select class="form-select" aria-label="Select Weight Scale" name="unit" id="unit">
                                        <option value=''>Select Weight Scale</option>
                                        
                                        <option value="gm">gm</option>
                                        <option value="kg">kg</option>
                                        <option value="ltr">ltr</option>
                                        
                                    </select>
                                </div>
                            </div>
                          
                            
                           
                            

                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="State" class="form-label">Product Package <span class="text-danger"> *</span></label>
                                    <select class="form-select" aria-label="Select Product Package" name="packging" id="packging">
                                        <option value=''>Select Product Package</option>
                                        <option value="Pack">Pack</option>
                                        <option value="Bottle">Bottle</option>
                                        <option value="Box">Box</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="State" class="form-label">Discount Type <span class="text-danger"> *</span></label>
                                    <select class="form-select" aria-label="Select Discount Type" name="discount_type" id="discount_type">
                                        <option value=''>Select Discount Type</option>
                                        <option value="Flat">Flat</option>
                                        <option value="Percentage">Percentage</option>
                                        <option value="No_Discount" selected>No Discount</option>
                                       
                                    </select>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="iconInput" class="form-label">Discount <span class="text-danger"> *</span></label>
                                        <input type="number" class="form-control"  placeholder="Enter Discount" id="discount" name="discount" min="0" onkeyup="finalamount()">
                                        <input type="hidden" id="final_price" value="0">
                                </div>
                            </div>

                           

                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <div class="form-check form-switch form-switch-success form-switch-lg mt-4">
                                        <input class="form-check-input" type="checkbox" role="switch" id="stock" name="stock">
                                        <label class="form-check-label" for="SwitchCheck3">Out of Stock Marking </label>
                                    </div>
                                </div>
                            </div>


                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="exampleFormControlTextarea5" class="form-label">Product Details <span class="text-danger"> *</span></label>
                                    <textarea class="form-control" id="product_details" name="product_details" rows="3"></textarea>
                                </div>
                            </div>

                            <h5>Product Image </h5>
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="placeholderInput" class="form-label">Image <span class="text-danger"> *</span></label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                    <p class="text-warning">Note : Please upload file of Width:300px, Height:200px, File Size:500kb and Type :JPEG,PNG,JPG </p>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-6" id="showimage" style="display:none;">
                                <img src="" class="path_image product_image" />
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
            var product_id=$('#product_id').val();
            getcurrency();
        getproduct(product_id);
        $("#product").validate({
            rules: {
                product_name: "required",
                quantity: "required",
                price: "required",
                unit: "required",
                packging: "required",
                discount_type: "required",
                discount: {
                    required:true,
                    min:0,
                    max:function () { return parseInt($("#final_price").val())  } ,
                },
                product_details:'required',
                image:{
                    required:{ depends:function(element){return (product_id==parseInt(0)) ? true:false; }},
                   // filesize:{ depends:function(element){return (product_id==parseInt(0)) ? 500:102400; }},
            }
            },
        
            // Specify validation error messages
            messages: {
                product_name: "Please Enter Product Name",
                quantity: "Please Enter Valid Product Weight",
                price: "Please Enter Valid Price",
                unit: "Please Select Unit Type",
                packging: "Please Select Packging Type",
                discount_type: "Please Select Discount Type",
                discount: {
                 required:"Please Enter Discount",
                 min:"Discount should be not less then 0",
                 max:"Discount Price should not be greater then Price"
                },
                product_details: "Please Enter Product Details",
                image: "Please Upload Product Image",
            },

            submitHandler: function(form) {
                var form=new FormData($('#product')[0]);
                console.log(form)
                var url=base_url+"save_product";
                var method='POST'
                if(product_id!="0")
                {
                    url=base_url+"update_product";
                    method="POST";
                }
                
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
                       // alert_success(success.message);
                       $('#success_msg').attr('data-toast-text',success.message).trigger('click');
                        window.location.href='/product';
                    },
                    error: function(xhr, status, error) {
                        let errors_msg="";
                            $.each( xhr.responseJSON.errors, function( key, value ) {
                                errors_msg+=`${value}\n`;
                            });
                            console.log(errors_msg)
                       $('#error_msg').attr('data-toast-text',errors_msg).trigger('click');
                    }
                });
            }
        });
    });


    function getproduct(product_id)
    {
       
        if(product_id !=0){
        $.ajax({
                type: "POST",
                url: base_url+"get_product/",
                data: {product_id:product_id},
                success: function(result) {
                    console.log("ajax data=", result)
                    if(result.success==true)
                    {
                       $('#product_name').val(result.data.product_name);
                       console.log(result.data.price)
                       $('#price').val(result.data.price);
                       $('#quantity').val(result.data.quantity);
                       $('#unit').val(result.data.unit);
                       $('#packging').val(result.data.packging);
                       $('#discount_type').val(result.data.discount_type);
                       $('#discount').val(result.data.discount).trigger('onkeyup');
                       if(result.data.stock=="1")
                        {
                            $('#stock').attr('checked','checked');
                        }
                       $('#product_details').val(result.data.product_details);
                       if(result.data.image)
                        {
                            $('#showimage').show();
                            $('.path_image').attr("src",file_url+result.data.image);
                        }
                    }      
                },
                error: function(error) {
                    console.log(error)
                    alert_error('Something Wrong')  
                 }
                });
            }
    }


    function finalamount()
    {
        var discount_type=$('#discount_type').val();
        if(discount_type=='')
        {
            $('#error_msg').attr('data-toast-text','Please Select Discount Type').trigger('click');
        }else{
            var discount=$('#discount').val();
            var price=$('#price').val();

            if(discount_type=="Flat")
            {
             $("#final_price").val(price);
            }else if(discount_type=="Percentage")
            {
                $('#discount').attr('max',100);
                $("#final_price").val(100);
            }
            else if(discount_type=="NO_Discount")
            {
                $('#discount').val(0);
            }
           
        }
    }

    function getcurrency()
    {
        var seller_id=$('#seller_id').val();
        $.ajax({
                type: "POST",
                url: base_url+"get_currency/",
                data: {seller_id:seller_id},
                success: function(result) {
                    console.log("ajax data=", result)
                    if(result.success==true)
                    {
                        $('[name=currency]').val(result.data.symbol)
                        $('#currency').text(result.data.symbol)
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\order_now_admin\resources\views/product_addedit.blade.php ENDPATH**/ ?>