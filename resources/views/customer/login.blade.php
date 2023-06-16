
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Restaurant</title>

<link rel = "stylesheet"  href = "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<style type="text/css">
	body,html {
	    background-image: url('/customer/images/background.webp');
	    height: 100%;
	}

	#profile-img {
	    height:180px;
	}
	.h-80 {
	    height: 80% !important;
	}
	.btn-primary {
	    color: #fff;
	    background-color: #930097 !important;
	    border-color: #900096 !important;
	}

</style>

</head>
<body>

<div class="container h-80">
<div class="row align-items-center h-100">
    <div class="col-8 mx-auto">
        <div class="text-center">
            <img id="profile-img" class="rounded-circle profile-img-card" src="{{asset('/assets/images/logo.png')}}" />
            <p id="profile-name" class="profile-name-card"></p>
            <form  class="form-signin" action="{{url('/checkCustomerlogin')}}" method="POST">
                @csrf
				<div class="text-danger">
                    <input type="hidden" name="res_id" id="res_id" value="{{$data['res']->id}}">
					<input type="hidden" name="table_no" id="table_no" value="{{$data['table']->id}}">
			<?php
				if(isset($message))
				{
					echo $message;
				} 
				?>
				</div>
            
                <input type="email" name="email" id="email" class="form-control form-group" placeholder="Enter Your Email" required autofocus>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="button" id="sendmail">Send OTP</button>

				<div id="otp" class="">
				<input type="number" name="otp" id="otp1" class="form-control form-group" placeholder="Enter Your OTP" required autofocus>

				<button class="btn btn-lg btn-primary btn-block btn-signin"  id="checkotp" type="button">Submit</button>
				</div>
            </form>
        </div>
    </div>
</div>
</div>

</body>

<!-- <script src = "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" ></script> -->
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<script src="{{asset('customer/js/jquery-3.6.2.min.js')}}"></script>
<script src="{{asset('assets/js/comman.js')}}"></script>
<script>
	$(document).ready(function(){
			$("#otp").hide();
			$("#sendmail").click(function(){
				var email=$('#email').val();
				console.log(email);
				$.post(base_url+'customerotp', {email:email,res_id:$('#res_id').val()}, function(response){ 
					$("#sendmail").hide();
					$("#otp").show();
				});

				// $("#sendmail").hide();
				// $("#otp").show();
	  		});

	  		$("#checkotp").click(function(){
				if($('#email').val()=='')
				{
					alert("Please Enter Valid Email ID");
				}
				else if($('#otp1').val()=='')
				{
					alert("Please Enter Valid OTP");
				}
				// else if($('#otp1').val()!='123456')
				// {
				// 	alert("Please Enter Valid OTP");
				// }
				else
				{
					$('.form-signin').submit();
					
				}
	  		});
	});
	</script>

</html> 
