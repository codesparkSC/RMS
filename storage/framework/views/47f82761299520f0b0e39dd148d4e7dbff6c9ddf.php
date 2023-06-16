
<?php $__env->startSection('title'); ?>
<?php echo e($title); ?>  Order 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<style>
    
.carttotal{
    width: 100%;
    float: right;
    clear: both;
    padding: 5px 20px;
}
.carttotal_full{
width:100%;
float:left;
clear:both;
padding:0 0 20px 0;
}
.carttotal_row{
width:100%;
float:left;
clear:both;
padding:5px 0;
border-bottom:1px #3d3e50 solid;
}
.carttotal_row_full{
width:100%;
float:left;
clear:both;
padding:8px 0;
border-bottom:1px #d6d6d6 solid;
}
.carttotal_row_last{
width:100%;
float:left;
clear:both;
padding:5px 0;
font-size:17px;
font-weight:900;
}
.carttotal_left{
width:60%;
float:left;
text-align:left;
}
.carttotal_right{
width:40%;
float:left;
text-align:right;
}
</style>
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
                        <form id="order" > 
                        <div class="row gy-4">
                        <input type="hidden" name="seller_id" id="seller_id" value="<?php echo e(Auth::user()->seller_id); ?>">
                        <input type="hidden" name="user_id" id="user_id" value="<?php echo e(Auth::user()->id); ?>">
                            <div class="col-xxl-3 col-md-3">
                                <div>
                                    <label for="placeholderInput" class="form-label">Select Table No <span class="text-danger"> *</span></label>
                                    <select class="form-select" aria-label="Select Table No" name="table_no" id="table_no">
                                        <option value=''>Select Table No</option>
                                       
                                    </select>
                                </div>
                            </div>

                            <div class="col-xxl-7 col-md-6">
                               
                                    <!-- <div><label for="placeholderInput" class="form-label">Search (Type first 3 letter) <span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" name="search" id="search"  maxlength="3"/>

                                    <button type="button" class="btn btn-outline-primary btn-icon waves-effect waves-light"><i class="ri-24-hours-fill"></i></button>  </div>-->
                                    <!-- Input with Icon Right -->
                        <div>
                            <label for="iconrightInput" class="form-label">Search </label>
                            <div class="form-icon right">
                                <input type="email" class="form-control form-control-icon" name="search" id="search" placeholder="Enter Menu Name">
                                <i class="ri-search-eye-line fs-2" onclick="getmenu()"></i>
                            </div>
                        </div>
                               
                            </div>


                            <div class="col-xxl-2 col-md-3">
                                <div>
                                    <label for="placeholderInput" class="form-label">&nbsp; </label>
                                    <button type="button" class="form-control btn btn-primary" onclick="showOrders()">Show Order</button>
                                </div>
                            </div>


                            <div class="card product">
                                <div class="card-body">
                                    <div class="row gy-3" id="filter_menu">
                                      
                                    </div>
                                </div>
                                <!-- card body -->
                                <!-- end card footer -->
                            </div>

                        </div>
                        <!--end row-->
                        <!-- <button class="btn btn-primary text-right mt-4" type="submit">Submit</button> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->

    <div class="modal fade bs-example-modal-xl" id="tableModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content border-0">
                <div class="modal-header bg-soft-info p-3">
                    <h5 class="modal-title" id="exampleModalLabel">Table Orders</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close" id="close-modal"></button>
                </div>
                <form id="status_form" autocomplete="off">
                    <div class="modal-body">
                      
                        <div class="row g-3">
                            <input type="hidden" name="seller_id" id="seller_id" value="<?php echo e(Auth::user()->seller_id); ?>">
                            <input type="hidden" id="cart_id" name="cart_id" class="form-control" />
                            <div class="col-xl-12">
                            <div class="card">
                                <!-- <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h5 class="card-title flex-grow-1 mb-0">Order #VL2667</h5>
                                        <div class="flex-shrink-0">
                                            <a href="apps-invoices-details.html" class="btn btn-success btn-sm"><i class="ri-download-2-fill align-middle me-1"></i> Invoice</a>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <table class="table table-nowrap align-middle table-borderless mb-0">
                                            <thead class="table-light text-muted">
                                                <tr>
                                                    <th scope="col">Order Details</th>
                                                    <th scope="col">Item Price</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col" class="text-end">Total Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody id="order_row">
                                                
                                            </tbody>
                                        </table>
                                        <div class="carttotal text-right">
                                    <div class="carttotal_row ">
                                    <div class="carttotal_left">CART TOTAL</div>  <div class="carttotal_right" id="totalcart"> 0.00</div>
                                    </div>
                                    <div class="carttotal_row">
                                    <div class="carttotal_left">Fee</div>  <div class="carttotal_right" id="fee"> 0.00</div>
                                    </div>

                                    <div class="carttotal_row">
                                    <div class="carttotal_left">VAT (12%)</div>  <div class="carttotal_right" id="vat"> 0.00</div>
                                    </div>
                                    <div class="carttotal_row_last">
                                    <div class="carttotal_left">TOTAL</div> <div class="carttotal_right" id="final"> 0.00</div>
                                    </div>
          </div>

                                    </div>
                                </div>
                            </div>
                            <!--end card-->
                            
                        </div>
                           
                        </div>
                   
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" onclick="checkout()">Checkout</button>
               
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(URL::asset('/assets/libs/prismjs/prismjs.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/js/app.min.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 


    <script>
        $(document).ready(function(){
           // var table_id=$('#table_id').val();
        gettable();
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

    var ready = true;
    $("input#search").on("keyup", function( event ){
        if(this.value.length == this.getAttribute('maxlength')) {
            console.log(this.value.length)
            if ($(this).valid()) {
                getmenu();
                ready = false;  
            }
        }
    });

    function gettable()
    {
        $.ajax({
                type: "POST",
                url: base_url+"get_table",
                data: {res_id:$('#seller_id').val()},
                success: function(result) {
                    console.log("ajax data=", result)
                    if(result.success==true)
                    {
                        var list = $("#table_no");
                        list.empty().append(new Option('Select Table No',''))
                        $.each(result.data, function(index, item) {
                       // list.append(new Option(item.table_name, item.id));
                       $(list).append('<option value=' + item.id + ' data-section='+item.section_id+'>' + item.table_name + '</option>');
                        });
                    }      
                },
                error: function(error) {
                    toast_error('Something Went Wrong')
                  //  $('#error_msg').attr('data-toast-text',"Something Went Wrong").trigger('click');
                 }
                });
    }


    function getmenu()
    {
       var table_no= $('#table_no').val();
        let filter={};
       if(table_no !='')
       {
         filter.res_id=$('#seller_id').val();
         filter.section_id=$('#table_no').find(':selected').data('section');
         filter.table_id=table_no;
         filter.search=$('#search').val();
         filter.seller_id=$('#seller_id').val();

         $.ajax({
                type: "POST",
                url: base_url+"menufilter",
                data: filter,
                success: function(result) {
                    console.log("ajax data=", result)
                    var menu = $("#filter_menu");
                       
                    if((result.data).length >0)
                    { 
                        var id =product_id=quantity = price = display_add = display_btn = "0";
                        let list="";
                        $.each(result.data, function(index, value) {
                            if((value.cart).length >0)
                            {
                                    id          = value.cart[0].id;
                                    product_id  = value.id;
                                    item_id     = value.item_id;
                                    quantity    = value.cart[0].quantity;
                                    price       = value.price;
                                    display_add = "";
                                    display_btn = "display:none;";


                                if(value.cart[0].quantity == 0)
                                {
                                        id          = value.id;
                                        product_id  = value.id;
                                        item_id     = value.item_id;
                                        quantity    = 0;
                                        price       = value.price;
                                        display_add = "display:none;";
                                        display_btn = "";
                                }
                            }
                            else
                            {
                                    id          = value.id;
                                    product_id  = value.id;
                                    item_id     = value.item_id;
                                    quantity    = 0;
                                    price       = value.price;
                                    display_add = "display:none;";
                                    display_btn = "";
                            }

                            list+=`<div class="col-sm-4 border p-2"> 
                                        <div class="col-sm-auto">
                                            <div class="avater-md bg-light rounded p-1">
                                                <img src="${file_url}${value.image}" alt="" class="img-fluid d-block">
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <h5 class="fs-14 text-truncate"><a href="#" class="text-dark">${value.product_name}</a></h5>
                                            <ul class="list-inline text-muted">
                                                <li class="list-inline-item">Quantity : <span class="fw-medium">${value.quantity} ${value.quantity_type}</span></li> <li class="list-inline-item">Price : <span class="fw-medium">${value.currency}${value.price}</span></li>
                                            </ul>
                                            <button type="button" style="${display_btn}" onclick="add_to_cart(this)" product_id ="${product_id}" item_id="${item_id}" price="${price}" style="" class="btn btn-primary add_btn">ADD TO CART</button>
                                           
                                            <div class="input-step item_qnty_shop" style = "${display_add}">
                                            <button type="button" class="minus" field="quantity_${item_id}" product_id="${product_id}" item_id="${item_id}" cart_id="${id}" onclick="update_count(${item_id},'-',this)">–</button>
                                            <input type="number" class="qntyshop" name="quantity_${item_id}"  min="1" value="${quantity}" min="0" max="100">
                                            <button type="button" class="plus" field="quantity_${item_id}" product_id="${product_id}" item_id="${item_id}" cart_id="${id}" onclick="update_count(${item_id},'+',this)">+</button> </div>
                                           
                                        </div>
                                      
                    </div>`;
                        });
                      menu.append(list);
                    }
                    else{
                        menu.append('<h4 class="text-center">No Menu Found</h4>')
                    }      
                },
                error: function(error) {
                    toast_error('Something Went Wrong')
                  //  $('#error_msg').attr('data-toast-text',"Something Went Wrong").trigger('click');
                 }
                });
       }
       else{
        toast_error('Please Select Table NO first.')
       }
    }
//  <div class="input-step"><button type="button" class="minus">–</button><input type="number" class="product-quantity" value="2" min="0" max="100"><button type="button" class="plus">+</button> </div>


function add_to_cart(param)
    {
        let cart_data={};
       // var quantity    = "1";
      //  var product_id  = $(param).attr("product_id");
         cart_data.staff_id     = $('#user_id').val();
         cart_data.table_id     = $('#table_no').val();
         cart_data.product_id     = $(param).attr("product_id");
         cart_data.item_id     =  $(param).attr("item_id");
         cart_data.price     = $(param).attr("price");
         cart_data.quantity     = 1;
         console.log(cart_data)
        $('.loader').show();
        $.post(base_url+'addcart', cart_data, function(response){ 
            
            if(response.success==true)
            {
                toast_success(response.message)
            }else{
               toast_error(response.message)
            }
            $(param).hide();
            $(param).parent().find(".item_qnty_shop").removeAttr('style');
            $(param).parent().find(".item_qnty_shop").show();
            $(param).parent().children().find(".qntyshop").val(parseInt(1));
        });
        $('.loader').hide();
    }


    function update_count(cart_id,type,param)
            {
                var currentVal = parseInt($('input[name=quantity_'+cart_id+']').val());
                if(type=='+')
                {
                    if (!isNaN(currentVal)) {
                         $('input[name=quantity_'+cart_id+']').val(currentVal + 1);
                    } else {
                         $('input[name=quantity_'+cart_id+']').val(0);
                    }
                    }
                     else{
                        if (!isNaN(currentVal) && currentVal > 0) {
                         $('input[name=quantity_'+cart_id+']').val(currentVal - 1);
                        } else {
                          $('input[name=quantity_'+cart_id+']').val(0);
                        }
                     }
                     let cart_data={};          
                    cart_data.staff_id     = $('#user_id').val();
                    cart_data.table_id     = $('#table_no').val();
                    cart_data.product_id     = $(param).attr("product_id");
                    cart_data.item_id     =  $(param).attr("item_id");
                    cart_data.quantity=$('input[name=quantity_'+cart_id+']').val();
                    console.log(cart_data);
                    $('.loader').show();
                        $.post(base_url+'updatecart', cart_data, function(response){ 
                              console.log(response)
                              $('.loader').hide();
                             
                        });
            }


    function showOrders()
    {
      
        var table_no= $('#table_no').val();
        let filter={};
        if(table_no !='')
        {
            console.log(table_no)
            $('.loader').show();
        $.post(base_url+'getcart', {table_id:table_no}, function(response){ 
            console.log(response)
            let row="";
            let cart_total=fee=vat=final=0;
            $.each(response.data, function(index, value) {
                let item_price=(value.price)*(value.quantity);
                cart_total+=item_price;
                row+=`<tr><td><div class="d-flex"><div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                     <img src="${file_url}${value.image}" alt=""  class="img-fluid d-block w-100 h-100">
                 </div><div class="flex-grow-1 ms-3"> <h5 class="fs-15">${value.product_name}</h5>
                 <p class="text-muted mb-0">Type: <span class="fw-medium">${value.product_type}</span></p>
                  <p class="text-muted mb-0">Quantity Type: <span class="fw-medium">${value.item_quantity}${value.quantity_type}</span></p>
                    </div>  </div></td> <td>${value.currency}${value.price}</td> <td>${value.quantity}</td> <td class="fw-medium text-end">${value.currency}${item_price}</td> </tr>`;   
            });
             vat= ((cart_total*12)/100);
            $('#order_row').append(row);
            $('#totalcart').html(cart_total);
            $('#fee').html(0);
            $('#vat').html(vat);
             final=cart_total+vat+0;
            $('#final').html(final);
            $('#tableModal').modal('show');
            
        });
        $('.loader').hide();

           
        }
        else{
            toast_error('Please Select Table NO first.')
        }
    }

    function checkout(){
        let check={};
      check.staff_id     = $('#user_id').val();
      check.table_id     = $('#table_no').val();
      check.payment     = 1;
      check.final =$('#final').html();
      check.seller_id =$('#seller_id').val();
        $.post(base_url+'generatebill', check, function(result){ 
            if(result.success==true)
            {
                window.location.href='/orders_billed';
            }
           
            });
    }

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\rms\resources\views/addorder.blade.php ENDPATH**/ ?>