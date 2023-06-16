
<?php $__env->startSection('css'); ?>
<style type="text/css">
  h4.checkout_title {
    border-left: 5px solid #cf26b8;
  }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
   	
<div id="pages_maincontent">
    <form name="menu" id="menu">
        <input type="hidden" id="user_id"  name="user_id" value="<?php echo e(Session::get('user_data')->id); ?>">
        <input type="hidden" id="seller_id" name="seller_id" value="<?php echo e(Session::get('user_data')->seller_id); ?>">
        <input type="hidden" id="table_id" name="table_id" value="<?php echo e(Session::get('table_no')); ?>">
        <input type="hidden" id="currency" name="currency" value="<?php echo e(Session::get('user_data')->currency); ?>">
       
   
    <h2 class="page_title">CHECKOUT</h2>
     
        
   
   <div class="page_single layout_fullwidth_padding">
   
       
                           
           <h4 class="checkout_title">ORDER DETAILS</h4>
           <div id="cart">
           
                     
           </div>
            <h4 class="checkout_title">SELECT PAYMENT</h4>
            
                   <div class="contactform">
                       <div class="checkout_select">
   
                                 <label class="label-radio item-content">
                                
                                   <input type="radio" name="payment" value="1" >
                                   <div class="item-inner">
                                     <div class="item-title">Paypal</div>
                                   </div>
                                 </label>
                                 <label class="label-radio item-content">
                                
                                   <input type="radio" name="payment" value="2">
                                   <div class="item-inner">
                                     <div class="item-title">Credit Card</div>
                                   </div>
                                 </label>
                                 <label class="label-radio item-content">
                                
                                   <input type="radio" name="payment" value="3" checked="1">
                                   <div class="item-inner">
                                     <div class="item-title">At Counter</div>
                                   </div>
                                 </label>
                       </div>
                   </div>
                   
        
              
             <h4 class="checkout_title">TOTAL</h4>      
                     <div class="carttotal_full">
                         <div class="carttotal_row_full">
                         <div class="carttotal_left">CART TOTAL</div>  <div class="totalcart"> </div>
                         </div>

                         <div class="carttotal_row_full">
                         <div class="carttotal_left">Fee</div>  <div class="fee"> </div>
                         </div>

                         <div class="carttotal_row_full">
                         <div class="carttotal_left">VAT (12%)</div>  <div class="vat"> </div>
                         </div>
                         
                         <div class="carttotal_row_last">
                          <input type="hidden" name="final" value="">
                         <div class="carttotal_left">TOTAL</div> <div class="final">
                          
                            </div>
                         </div>
                     </div> 
                     
                     <button type="button" class="btn button_full btyellow" onclick="checkout()">SEND ORDER</button> 
             

           </div>
    </div>
        
        
   </div>
 </div>

          
</div>      
</form>    

               
                  <?php $__env->startSection('script'); ?>
                  <script>
                    $(document).ready(function(){
                        cartlist();
                        getCount();
                       
                    });

    function getCount()
    {
        console.log($('#menu').serialize())
        $.post(base_url+'getcartCount', $('#menu').serialize(), function(response){ 
            $('#total_cart').html(response.data);
        });
    }
            
    function cartlist()
    {
        let cart_data={};
        cart_data.user_id     = $('#user_id').val();
        cart_data.table_id     = $('#table_id').val();
        $('.loader').show();
        $.post(base_url+'getcart', cart_data, function(result){ 
             $('.loader').hide();
             console.log(result)
             var response=result.data;
                        var html  = "";
                        var total = 0;
                        var fee   = 0;
                        var currency='';
                        if(response.length>0)
                        {
                             currency=response[0].currency;
                            response.forEach(function(resp) {
                                console.log(resp.id);
                                total   += parseInt(resp.price)*parseInt(resp.quantity);
                                fee     += 0                      //(parseInt(resp.price)*parseInt(resp.fee))/100;
                                html    += `<div class="order_item">
                       <div class="order_item_thumb"><a href="#" class="close-panel"><img src="${file_url}${resp.image}" alt="" title="" /></a></div>
                       <div class="order_item_title"><span>${resp.quantity} X</span>${resp.product_name}</div>
                       <div class="order_item_price">${resp.currency}${resp.price}</div>           
                   </div>`;
                            });
                        }
                        $('.totcount').html(response.length);
                        $('#cart').empty().append(html);
                        $('.fee').html(currency+parseFloat(fee).toFixed(2));   
                        $('.totalcart').html(currency+parseFloat(total).toFixed(2));   
                        let vat= ((total*12)/100);
                        $('.vat').html(currency+parseFloat(vat).toFixed(2));   
                        final=total+vat+fee;
                        $('.final').html(currency+parseFloat(final).toFixed(2)); 
                        $('[name=final]').val(parseFloat(final).toFixed(2));
         });
     }


     function checkout(){
      let check={};
      console.log($('#menu').serialize())
      check=$('#menu').serialize();
      $('.loader').show();
        $.post(base_url+'generatebill', check, function(result){ 
             $('.loader').hide();
            });
     }
            
                </script>
            
<?php $__env->stopSection(); ?>
 <?php $__env->stopSection(); ?>
<?php echo $__env->make('customer.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\erp2\resources\views/customer/checkout.blade.php ENDPATH**/ ?>