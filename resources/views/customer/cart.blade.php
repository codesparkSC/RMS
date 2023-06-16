@extends('customer.app')
@section('css')
<style type="text/css">
    h2.page_title span {
        background-color: #ffffff;
    }

    .item_price {
        background-color: #ffffff;
    }

    .item_title {
        font-weight: 600;
    }

    #pages_maincontent img {
        width: 115px;
    }

    .trash{
        width: 20px !important;
    }

    a.item_delete {
        width: 25px;
        float: right;
        text-align: right;
        padding: 0% 0 0 0;
    }
    
    .item_price {
        width: 50px;
    }

    .btyellow {
        background-color: #54284e;
        color: #ffffff;
        padding: 10px;
    }

    .carttotal {
        width: 100%;
    }
    img.logo {
        width: 45px;
    }

</style>
@endsection
@section('content')
   	
    <div id="pages_maincontent">
    <div class="loader"></div>
        <h2 class="page_title">Order CART <span class="totcount"></span></h2>
        <form name="menu" id="menu">
        <input type="hidden" id="user_id"  name="user_id" value="{{Session::get('user_data')->id}}">
        <input type="hidden" id="seller_id" name="seller_id" value="{{Session::get('user_data')->seller_id}}">
        <input type="hidden" id="table_id" name="table_id" value="{{Session::get('table_no')}}">
        <input type="hidden" id="currency" name="currency" value="{{Session::get('user_data')->currency}}">
        </form>
       <div class="page_single layout_fullwidth_padding">	
  
     <div class="cartcontainer">     
        <div id="cart">
  </div>       
        
          <div class="carttotal">
              <div class="carttotal_row">
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
        
          <a href="{{url('checkout')}}" class="button_full btyellow">PROCEED TO CHECKOUT</a>           
          

               
                  @section('script')
                  <script>
                    $(document).ready(function(){
                        cartlist();
                        getCount();
                       
                    });
            
                    function cartlist()
                    {
                        let cart_data={};
                        cart_data.user_id     = $('#user_id').val();
                        cart_data.table_id     = $('#table_id').val();
                        $('.loader').show();
                        $.post(base_url+'getcart', cart_data, function(result){ 
                        $('.loader').hide();
                        var response=result.data;
                        var html  = "";
                        var total = 0;
                        var fee   = 0;
                       
                        if(response.length>0)
                        {
                            response.forEach(function(resp) {
                                console.log(resp.id);
                                total   += parseInt(resp.price)*parseInt(resp.quantity);
                                fee     += 0                      //(parseInt(resp.price)*parseInt(resp.fee))/100;
                                html    += ` <div class="cart_item" id="cartitem${resp.id}">
                                <div class="item_title">${resp.product_name}</div>
                                <div class="item_price">${resp.currency}${resp.price}</div>
                                <div class="item_thumb"><a href="s#" class="close-panel"><img src="${file_url}${resp.image}" alt="" title="" /></a></div>
                                <div class="item_qnty">
                                <form id="myform" method="POST" action="#">
                                <label>Qty</label>
                                 <input type="button" value="-" class="qntyminus" field="quantity_${resp.id}" product_id="${resp.product_id}" item_id="${resp.item_id}" cart_id="${resp.id}" onclick="update_count(${resp.id},'-',this)"/>
                                <input type="text" name="quantity_${resp.id}" value="${resp.quantity}" min="1" class="qnty" />
                                 <input type="button" value="+" class="qntyplus" field="quantity_${resp.id}" product_id="${resp.product_id}" item_id="${resp.item_id}" cart_id="${resp.id}" onclick="update_count(${resp.id},'+',this)"/>
                                </form>
                                </div>
                                <a href="#" class="item_delete" id="cartitem${resp.id}" onclick="deleteitem(${resp.id})"><img src="{{asset('customer/images/icons/black/trash.png')}}" alt="" title="" class="trash"/></a>     
                                </div>`;
                            });
                        }
                        else
                        {
                            
                          //  location.href = "/customer_dashboard/1";
                        }
            
                        $('.totcount').html(response.length);
                        $('#cart').empty().append(html);
                        $('#fee').html("RM "+parseFloat(fee).toFixed(2));   
                        $('#totalcart').html("RM "+parseFloat(total).toFixed(2));   
                        let vat= ((total*12)/100);
                        console.log(vat)
                        $('#vat').html("RM "+parseFloat(vat).toFixed(2));   
                        final=total+vat+fee;
                        $('#final').html("RM "+parseFloat(final).toFixed(2)); 
                        });
                       
                    }
            
                    function deleteitem(id)
                    {
                        console.log(id);
                        $('.loader').show();
                        $.post(base_url+'deletecart', {cart_id:id}, function(response){ 
                              console.log(response)
                              $('.loader').hide();
                              cartlist();
                              getCount();
                        });
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
                    cart_data.user_id     = $('#user_id').val();
                    cart_data.table_id     = $('#table_id').val();
                    cart_data.product_id     = $(param).attr("product_id");
                    cart_data.item_id     =  $(param).attr("item_id");
                    cart_data.quantity=$('input[name=quantity_'+cart_id+']').val();
                    console.log(cart_data);
                    $('.loader').show();
                        $.post(base_url+'updatecart', cart_data, function(response){ 
                              console.log(response)
                              $('.loader').hide();
                              cartlist();
                              getCount();
                        });
            }

    function getCount()
    {
        $.post(base_url+'getcartCount', $('#menu').serialize(), function(response){ 
            $('#total_cart').html(response.data);
        });
    }
            
            
                </script>
            
@endsection
 @endsection