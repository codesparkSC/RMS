<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, minimal-ui">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<link rel="apple-touch-icon" href="images/apple-touch-icon.png" />
<link rel="apple-touch-startup-image" href="images/apple-touch-startup-image-640x920.png">
<title>Shop</title>
<link rel="stylesheet" href="{{asset('customer/css/swiper.css')}}">
<link rel="stylesheet" href="{{asset('customer/css/style.css')}}">
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,900" rel="stylesheet"> 

<style type="text/css">
	img.logo {
    	width: 45px;
	}
	.navbarpages.navbarpagesbg {
    	background-color: #54284e;
	}
	.navbar_right span {
    	background-color: #fe6a00;
    }

	ul.shop_items li a#addtocart {
	    width: 50%;
	    float: right;
	    color: #ffffff;
	    background-color: #930097;
	    display: inline-block;
	    padding: 10px 0;
	    text-align: center;
	    font-size: 12px;
	    font-weight: 600;
	    border-radius: 9px;
	    max-width: 100px;
	}
	input#search {
	    width: 95%;
	    padding: 5px;
	    margin: 10px 0px 10px 3px;
	}

	.shop_pagination a, input.qntyminus, input.qntyplus, input.qntyminusshop, input.qntyplusshop {
	    border: 1px solid #7d2f83;
	    color: #7d2f83;
	    padding: 0px 0 2px;
	}
	#pages_maincontent img {
	    display: block;
	    max-height: 100px;
	    max-width: 100%;
	    width: 145px;
	    border-radius: 15px;
	}

	a.open-popup.shopfav {
	    font-size: 12px;
	    font-weight: 900;
	    padding: 5px 0 10px 0;
	}
	
	.shop_item_price {
	    display: inline-block;
	    float: right;
	    width: 25%;
	    position: absolute;
	    top: 0;
	    right: 0;
	    text-align: right;
	}
	.item_qnty_shop {
	    width: 100px;
	    float: right;
	    margin-top: 20px;
	}
	ul.shop_items li a#addtocart {
	    width: 50%;
	    float: right;
	    color: #ffffff;
	    background-color: #930097;
	    display: inline-block;
	    padding: 10px 0;
	    text-align: center;
	    font-size: 12px;
	    font-weight: 600;
	    border-radius: 9px;
	    max-width: 100px;
	    margin-top: 20px;
	}
	input.qntyshop {
	    width: 35px;
	    float: right;
	    text-align: center;
	}
	input.qntyplusshop {
    	float: right;
	}
	input.qntyminusshop {
    	float: left;
	}


	.pack_details {
		width: 115px;
	    display: block;
	    float: left;
	    margin-top: 20px;
	    font-size: 14px;
	    font-weight: 500;
	}

	.shop_item_details h4 {
	    width: 80%;
	}
	
	.load_more button {
	    background-color: #0394e8;
	    border: none;
	    padding: 10px;
	    color: #ffffff;
	    background-color: #930097;
	    border-radius: 30px;
	}

	/* Styles for wrapping the search box */


</style>
@yield('css')
</head> 
<body id="mobile_wrap">

    @yield('sidebar')
    <div class="views">
        <div class="view view-main">
            <div class="pages">
              <div data-page="cart" class="page no-toolbar no-navbar">
                <div class="page-content">
                    <div class="navbarpages navbarpagesbg">
                        <div class="navbar_left">
                            <div class="logo_text">
                                <a href="{{url('/menu')}}">
                                    <img class="logo" src="assets/images/logo.png" />
                                </a>
                            </div>
                        </div>
                        <div class="navbar_right navbar_right_menu">
                        <a href="#" data-panel="left" class="open-panel">
                            <img src="{{asset('customer/images/icons/white/menu.png')}}" alt="" title="" /></a>
                        </div>			
                        <div class="navbar_right">
                            <a href="#" data-panel="right" class="open-panel">
                                <img src="{{asset('customer/images/icons/white/user.png')}}" alt="" title="" />
                            </a>
                        </div>
                        <div class="navbar_right">
                            <a href="cart" data-view=".view-main">
                                <img src="{{asset('customer/images/icons/white/cart.png')}}" alt="" title="" />
                                <span id="total_cart">0</span>
                            </a>
                        </div>			
                    </div>
                    @yield('content')
                </div>
              </div>
            </div>
        </div>
    </div>
    
    <script src="{{asset('customer/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('customer/js/jquery.validate.min.js')}}" ></script>
    <script src="{{asset('customer/js/swiper.min.js')}}"></script>
    <script src="{{asset('/assets/js/comman.js')}}"></script>
    @yield('script')
</body>
</html>
