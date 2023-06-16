<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Input, Redirect,Response,Hash,Storage,DB,Mail,URL,Session; 
use App\Models\Seller;
use App\Models\User;
use App\Models\Tables;
use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\Order;
use App\Models\Currency;
use App\Models\OrderItem;
use App\Models\Category;
use App\Models\SellerAddress;
use App\Models\SellerBank;
use App\Models\Customer;
use Illuminate\Support\Str;
use PDF;

class CustomerController extends Controller
{
    
    public function customerlogin($resid,$tableid)
    {
        $data['res']=Seller::where('id',$resid)->first();
        $data['table']=Tables::where('table_name',$tableid)->where('res_id',$resid)->first();
        $msg='';
        if($data['res']->profile_status==1)
         {
            $msg='Sorry ! Currently This Restaurant is Closed';
         }
        if($data['table']->isdelete!=0)
        {
            $msg='Sorry ! Currently This Table Booking is Closed';
        }
        return view('customer.login')->with('msg',$msg)->with('data',$data);
    }

    public function checkCustomerlogin(Request $request){

        $data=$request->all();
        $check=Customer::where('email',$data['email'])->where('seller_id',$data['res_id'])->where('otp',$data['otp'])->first();

        if($check->email!='')
        {
            Session::put('user_data', $check);
            Session::put('table_no', $data['table_no']);
            return Redirect('/menu');
        }
        else{
            return Redirect::back()->withErrors(['msg' => 'Sorry ! OTP is not Matched']);
        }

    }

    public function menu()
    {
       $user= Session::get('user_data');
       if($user){
        return view('customer.menu');
       }
       else{
        return view('customer.msg');
       }
      
    }

    public function cart()
    {
       $user= Session::get('user_data');
       if($user){
        return view('customer.cart');
        }
        else{
        return view('customer.msg');
        }
    }

    public function checkout()
    {
       $user= Session::get('user_data');
       if($user){
        return view('customer.checkout');
        }
        else{
        return view('customer.msg');
        }
    }



}
