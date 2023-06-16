
<?php $__env->startSection('title'); ?>
<?php echo e($title); ?>  Menu 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Menus
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
        <?php echo e($title); ?> Menu
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Menu</h4>
                    
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <form id="product" enctype="multipart/form-data"> 
                        <div class="row gy-4">
                        <input type="hidden" name="seller_id" id="seller_id" value="<?php echo e(Auth::user()->seller_id); ?>">
                        <input type="hidden" name="product_id" id="product_id" value="<?php echo e($id); ?>">
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="placeholderInput" class="form-label">Menu Name  <span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" id="product_name"  placeholder="Enter Menu Name" name="product_name" maxlength="100">
                                </div>
                            </div>
                            <input type="hidden" class="form-control"  name="currency">
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="State" class="form-label">Menu Type <span class="text-danger"> *</span></label>
                                    <select class="form-select" aria-label="Select Menu Type" name="product_type" id="product_type">
                                        <option value=''>Select Menu Type</option>
                                        <option value="1">Veg</option>
                                        <option value="2">Non Veg</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="State" class="form-label">Category <span class="text-danger"> *</span></label>
                                    <select class="form-select category" aria-label="Select Category" name="category" id="category">
                                        <option value=''>Select Category</option>
                                       
                                    </select>
                                </div>
                            </div>
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
                                    <div class="form-check form-switch form-switch-success form-switch-lg mt-4">
                                        <input class="form-check-input" type="checkbox" role="switch" id="stock" name="stock">
                                        <label class="form-check-label" for="SwitchCheck3">Out of Stock </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                            
                      
                            

                            <div class="clone">
                                <div class="row mt-2 gy-4">
                                    <div class="col-xxl-3 col-md-4">
                                        <input type="hidden" class="form-control" id="item0" name="item_id[0]" >
                                        <div>
                                            
                                            <label for="State" class="form-label">Quantity Type <span class="text-danger"> *</span></label>
                                            <select class="form-select" aria-label="Select Quantity Type" name="quantity_type[0]" id="quantity_type0" required="">
                                                <option value=''>Select Quantity Type</option>
                                                <option value="item">Item</option>
                                                <option value="ml">ML</option>
                                               
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-4">
                                        <div>
                                            <label for="iconInput" class="form-label">Quantity <span class="text-danger"> *</span></label>
                                                <input type="number" class="form-control"  placeholder="Enter Quantity" id="quantity0" name="quantity[0]" min="0" required="" >
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        <div>
                                            <label for="placeholderInput" class="form-label">Price <span class="text-danger"> *</span></label>
                                                <input type="number" class="form-control" id="price0"  placeholder="Enter price" name="price[0]" min="0"  required="">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-1">
                                        <label for="placeholderInput" class="form-label "></label>
                                        <span class="form-control border-0 text-primary fs-18 add_row"><i class="ri-add-circle-fill fs-22"> </i></span>
                                    </div>
                                </div>
                            </div>


                           
                            <div class="row mt-2 gy-4">
                          

                            <div class="col-xxl-6 col-md-12">
                                <div>
                                    <label for="exampleFormControlTextarea5" class="form-label">Menu Details <span class="text-danger"> *</span></label>
                                    <textarea class="form-control" id="product_details" name="product_details" rows="3"></textarea>
                                </div>
                            </div>

                            <h5>Menu Image </h5>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 


    <script>
        let product_details={};
             
        $(document).ready(function(){
          
            var product_id=$('#product_id').val();
            var x = 1; //Initial field counter is 1
            getcurrency();
            getcategory();
            getsection();
        getproduct(product_id);

        $("#product").validate({
            rules: {
                product_name: "required",
                category: "required",
                product_type: "required",
                product_details:'required',
                section:'required',
                image:{
                    required:{ depends:function(element){return (product_id==parseInt(0)) ? true:false; }},
            }
            },
        
            // Specify validation error messages
            messages: {
                product_name: "Please Enter Menu Name",
                category: "Please Select Category",
                product_type: "Please Select Menu Type",
                product_details: "Please Enter Menu Details",
                section: "Please Select Section",
                image: "Please Upload Menu Image",
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
                       toast_success(success.message)
                       window.location.href='/product';
                    },
                    error: function(xhr, status, error) {
                        let errors_msg="";
                            $.each( xhr.responseJSON.errors, function( key, value ) {
                                errors_msg+=`${value}\n`;
                            });
                            console.log(errors_msg)
                            toast_error(errors_msg)
                      // $('#error_msg').attr('data-toast-text',errors_msg).trigger('click');
                    }
                });
            }
        });

       


         $('.add_row').click(function(){ //Once add button is clicked
             if(x < 20){ //Check maximum number of input fields
                var fieldHTML = `<div class="row mt-2 gy-4"> <div class="col-xxl-3 col-md-4"><input type="hidden" class="form-control" id="item${x}" name="item_id[${x}]" > <div> <label for="Quantity_type${x}" class="form-label">Quantity Type <span class="text-danger"> *</span></label> <select class="form-select form_required" aria-label="Select Quantity Type" name="quantity_type[${x}]" id="quantity_type${x}" required=""> <option value=''>Select Quantity Type</option> <option value="item">Item</option> <option value="ml">ML</option> </select> </div> </div> <div class="col-xxl-3 col-md-4"> <div> <label for="Quantity${x}" class="form-label">Quantity <span class="text-danger"> *</span></label> <input type="number" class="form-control form_required" placeholder="Enter Quantity" id="quantity${x}" name="quantity[${x}]" min="0" required=""> </div> </div> <div class="col-xxl-3 col-md-3"> <div> <label for="Price${x}" class="form-label">Price <span class="text-danger"> *</span></label> <input type="number" class="form-control form_required" id="price${x}" placeholder="Enter price" name="price[${x}]" min="0" required=""> </div> </div> <div class="col-xxl-3 col-md-1"> <label for="placeholderInput" class="form-label"></label><a href="javascript:void(0);"  class="form-control border-0 text-danger fs-18"><i class="ri-close-circle-fill fs-22 remove_row"> </i></a> </div> </div>`;

                 $('.clone').append(fieldHTML); // Add field html
                 x++; //Increment field counter  
             }
         });

        $('.clone').on('click', '.remove_row', function(e){ //Once remove button is clicked
             e.preventDefault();
             console.log(e)
            // $(this).closest().closest().remove();
             $(this).parent().parent().parent().remove(); //Remove field html
             x--; //Decrement field counter
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
                        product_details=result.data;
                       $('#product_name').val(product_details.product.product_name);
                       $('#product_type').val(product_details.product.product_type);
                       $('#category').val(product_details.product.category).trigger('onkeyup');
                       $('#section').val(product_details.product.section).trigger('onkeyup');
                       if(product_details.product.stock=="1")
                        {
                            $('#stock').attr('checked','checked');
                        }
                       $('#product_details').val(product_details.product.product_details);
                       if(product_details.product.image)
                        {
                            $('#showimage').show();
                            $('.path_image').attr("src",file_url+product_details.product.image);
                        }
                        for (let i = 0; i < (product_details.item).length; i++) {
                            if(i >0)
                            {
                                $('.add_row').trigger('click');
                            }
                            $('#item'+i).val((product_details.item[i].id));
                            $('#quantity_type'+i).val((product_details.item[i].quantity_type));
                            $('#quantity'+i).val((product_details.item[i].quantity));
                            $('#price'+i).val((product_details.item[i].price));
                        }
                    }      
                },
                error: function(error) {
                    console.log(error)
                    toast_error('Something Went Wrong')
                 }
                });
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
                      //  $('.currency').text(result.data.symbol)
                    }      
                },
                error: function(error) {
                    console.log(error)
                    // alert_error('Something Wrong')  
                 }
                });
    }

    function getcategory()
    {
        var seller_id=$('#seller_id').val();
        $.ajax({
                type: "POST",
                url: base_url+"get_category",
                data: {seller_id:seller_id},
                success: function(result) {
                    console.log("ajax data=", result)
                    if(result.success==true)
                    {
                        var list = $(".category");
                        list.empty().append(new Option('Select Category',''))
                        $.each(result.data, function(index, item) {
                        list.append(new Option(item.category_name, item.id));
                        });
                    }      
                },
                error: function(error) {
                    console.log(error)
                    // alert_error('Something Wrong')  
                 }
                });
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\erp2\resources\views/product_addedit.blade.php ENDPATH**/ ?>