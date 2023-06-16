
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
            <h1>Please Rescan the QR code for login.</h1>
        </div>
    </div>
</div>
</div>

</body>
</html> 
