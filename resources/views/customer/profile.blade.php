@extends('customer.app')
@section('css')
<style type="text/css">
  h4.checkout_title {
    border-left: 5px solid #cf26b8;
  }
</style>
@endsection
@section('content')
   	
<div id="pages_maincontent">
    <form name="menu" id="menu">
        <input type="hidden" id="user_id"  name="user_id" value="{{Session::get('user_data')->id}}">
        <input type="hidden" id="seller_id" name="seller_id" value="{{Session::get('user_data')->seller_id}}">
       
   
    <h2 class="page_title">CHECKOUT</h2>
     
        
   
   <div class="page_single layout_fullwidth_padding">
   
     <h4 class="checkout_title">YOUR DETAILS</h4>	
           <div class="contactform">
         
           <label>Name:</label>
           <input type="text" name="name" id="name" value="" class="form_input required" />

           <label>Email ID:</label>
           <input type="email" name="email" id="email" value="" class="form_input required" readonly />

           <label>Mobile No:</label>
           <input type="text" name="mobile_no" id="mobile_no" value="" class="form_input required" />

           <label>Address:</label>
           <textarea name="address" id="address" class="form_textarea textarea required" rows="" cols=""></textarea>
        
          
           </div>
           <button type="submit" class="btn button_full btyellow">SEND ORDER</button> 
             

           </div>
    </div>
        
        
   </div>
 </div>

          
</div>      
</form>    

               
                  @section('script')
           
                  <script>
                    $(document).ready(function(){
                     getuser();
                     $("#menu").validate({
            rules: {
                name: "required",
                email: "required",
                mobile_no: "required",
                address: "required",
            },
        
            // Specify validation error messages
            messages: {
                name: "Please Enter Name",
                email: "Please Enter Email ID",
                mobile_no: "Please Enter Mobile No",
                address: "Please Enter Address",
            },

            submitHandler: function(form) {
                var url=base_url+"update_customer";
                var method='POST'
                $.ajax({
                    type: method,
                    url: url,
                    data: $('#menu').serialize(),
                  
                    // crossDomain:true,
                    success: function(success) {
                        console.log("ajax data=", success)
                       // alert_success(success.message);
                       window.location.href='/menu';
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

                     function getuser()
                     {
                        $.post(base_url+'getprofile', $('#menu').serialize(), function(response){ 
                           console.log(response)
                           if(response.data)
                           {
                             $('#name').val(response.data.name);
                             $('#email').val(response.data.email);
                             $('#mobile_no').val(response.data.mobile_no);
                             $('#address').val(response.data.address);
                            
                           }
                        });
                     }
                </script>
            
@endsection
 @endsection