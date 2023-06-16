
<?php $__env->startSection('content'); ?>
   
                 <div id="pages_maincontent">
                    <form name="menu" id="menu">
                        
                    <input type="text" name="search" id="search" class="form-control form-group search" onkeyup="productlist()" placeholder="Search Product"> 
                	<div class="page_single layout_fullwidth_padding">
                        
                        <input type="hidden" id="user_id"  name="user_id" value="<?php echo e(Session::get('user_data')->id); ?>">
                        <input type="hidden" id="seller_id" name="seller_id" value="<?php echo e(Session::get('user_data')->seller_id); ?>">
                        <input type="hidden" id="table_id" name="table_id" value="<?php echo e(Session::get('table_no')); ?>">
                      
                        <div class="loader"></div>
                        <ul class="shop_items" id="product_list">
                        </ul>
                        <div class="load_more">
                        <button type="button" class="btn btn-primary" onclick="productlist()"> Load More</button>
                        </div>
                    </div>
                </form>
                  </div>
               
                  <?php $__env->startSection('script'); ?>
<script>
 var skip=0;

$(document).ready(function(){
  //$('.loader').show();
        productlist();
        getCount();
 });


 function productlist()
 {
//   var search=$("#search").val();
//   var seller=$("#seller_id").val();
  $('.loader').show();
      $.post(base_url+'menu', $('#menu').serialize()+ "&skip="+skip, function(response){  
        let lihtml="";
        var id = quantity = price = display_add = display_btn = "0";
        $.each(response.data, function (key,value) {
           lihtml+=`<li>
          <div class="shop_thumb"><a href="#"><img src="${file_url}${value.image}" alt="" title="" /></a></div>
          <div class="shop_item_details">
          <h4><a href="#">${value.product_name}</a></h4>
          <h6 class="pack_details">${value.quantity_type} Of ${value.quantity}</h6>`;
           if((value.cart).length >0)
           {
                id          = value.cart[0].id;
                item_id     = value.item_id;
                quantity    = value.cart[0].quantity;
                price       = value.price;
                display_add = "";
                display_btn = "display:none;";


               if(value.cart[0].quantity == 0)
               {
                    id          = value.id;
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
                item_id     = value.item_id;
                quantity    = 0;
                price       = value.price;
                display_add = "display:none;";
                display_btn = "";
          }
           
         console.log(quantity)
            lihtml+=` <div class="item_qnty_shop" style = "${display_add}">
                <form id="myform" method="POST" action="#" id="${id}">
                    <input type="button" value="-" class="qntyminusshop" product_id="${id}" item_id="${item_id}" price="${price}" onclick="update_cart(this)"/>
                    <input type="button" value="+" class="qntyplusshop"  product_id="${id}" item_id="${item_id}" price="${price}" onclick="update_cart(this)"/>
                    <input type="text" name="quantity" value="${quantity}" min="0" class="qntyshop" />
                </form>
            </div>`;
        lihtml+=`<a href="#" id="addtocart" onclick="add_to_cart(this)" product_id ="${id}" item_id="${item_id}" price="${price}" style="${display_btn}" class="add_btn">ADD TO CART</a>`;
        lihtml+=` <div class="open-popup shopfav shop_item_price">${value.currency} ${value.price}</div>
          </div>
          </li> `;
   
         });
         if(search!='')
         {
          $('#product_list').empty();
         }
         $('#product_list').append(lihtml);
         $('#skip').val()
         skip=skip+20;
         $('.loader').hide();
         console.log("skip"+skip)
    });

 }


    function add_to_cart(param)
    {
        let cart_data={};
       // var quantity    = "1";
      //  var product_id  = $(param).attr("product_id");
         cart_data.user_id     = $('#user_id').val();
         cart_data.table_id     = $('#table_id').val();
         cart_data.product_id     = $(param).attr("product_id");
         cart_data.item_id     =  $(param).attr("item_id");
         cart_data.price     = $(param).attr("price");
         cart_data.quantity     = 1;
         console.log(cart_data)
        $('.loader').show();
        $.post(base_url+'addcart', cart_data, function(response){ 
            
            if(response.success==true)
            {
                //toast_success(response.message)
            }else{
              //  toast_error(response.message)
            }
           getCount();
            $(param).hide();
            $(param).parent().find(".item_qnty_shop").removeAttr('style');
            $(param).parent().find(".item_qnty_shop").show();
            $(param).parent().children().find(".qntyshop").val(parseInt(1));
        });
        $('.loader').hide();
    }


    
    function update_cart(param)
    {
        let cart_data={};
        $('.loader').show();
         var quantity    = parseInt($(param).parent().children('.qntyshop').val());
        // var product_id  = $(param).attr("product_id");
        // var user_id     = $('#user_id').val();
       
        if($(param).hasClass("qntyplusshop"))
        {
            if (!isNaN(quantity)) {
                $(param).parent().children('.qntyshop').val(quantity + 1);
                $(param).parent().parent().show();
                $(param).parent().parent().parent().find('.add_btn').hide();
            } else {
                $(param).parent().children('.qntyshop').val(0);
                $(param).parent().parent().hide();
                $(param).parent().parent().siblings().find(".add_btn").show();
            }
        }
        else
        {
            if (!isNaN(quantity) && quantity > 0) {
                $(param).parent().children('.qntyshop').val(quantity - 1);
                console.log();//.find(".add_btn").removeAttr('style');
            } else {
                $(param).parent().children('.qntyshop').val(0);
                $(param).parent().parent().hide();
                $(param).parent().parent().parent().find('.add_btn').removeAttr('style');
                $(param).parent().parent().parent().find('.add_btn').show();
            }
        }


        var quantity    = parseInt($(param).parent().children('.qntyshop').val());
        if(quantity=='0')
        {
            $(param).parent().children('.qntyshop').val(0);
            $(param).parent().parent().hide();
            $(param).parent().parent().parent().find('.add_btn').removeAttr('style');
            $(param).parent().parent().parent().find('.add_btn').show();
        }

        cart_data.user_id     = $('#user_id').val();
         cart_data.table_id     = $('#table_id').val();
         cart_data.product_id     = $(param).attr("product_id");
         cart_data.item_id     =  $(param).attr("item_id");
         cart_data.price     = $(param).attr("price");
         cart_data.quantity=quantity;
         //{cart_id:product_id,product_id:product_id,quantity:quantity,user_id:user_id}
        $.post(base_url+'updatecart', cart_data, function(response){ 
            if(response.success==true)
            {
                toast_success(response.message)
            }else{
                toast_error(response.message)
            }
            // $('#total_cart').html(response.total.total);
          //  $('input[name=quantity_'+response.data[0].id+']').val(response.data[0].quantity);
        });

        $('.loader').hide();
    }


    function getCount()
    {
        $.post(base_url+'getcartCount', $('#menu').serialize(), function(response){ 
            $('#total_cart').html(response.data);
        });
    }

    </script>
<?php $__env->stopSection(); ?>
 <?php $__env->stopSection(); ?>
<?php echo $__env->make('customer.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\erp2\resources\views/customer/menu.blade.php ENDPATH**/ ?>