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
use App\Models\Section;
use App\Models\Roles;
use App\Models\OrderStatus;
use App\Models\DeliveryStatus;
use Illuminate\Support\Str;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Cart;

class ApiController extends Controller
{
    public function sendotp(Request $request)
    {
        $data=$request->all();
      $rules = array(
        'name' => 'required',
        'email' => 'required',
        'mobile_no' => 'required',
        'password' => 'required',
        'agree_check'=>'required',
   );
    $validator = Validator::make($request->all(), $rules);
      
      if ($validator->fails()) {
        return Response::json(array(
            'success' => false,
            'errors' => $validator->errors(),
            'message'=>'Please Fill All Details.'

        ), 400); 
      }
      else{
         $check_email=Seller::where('email_id',$data['email'])->first();
          if($check_email && $check_email->status==1)
          {
            return Response::json(array(
                'success' => false,
                'data' => $check_email,
                'message'=>'This Email ID is Already Used and Verified.'
            ), 400); 
          }
          else{
            $otp='123456';                //random_int(100000, 999999);
            $seller=Seller::updateOrCreate(['email_id'=>$data['email']],['name'=>$data['name'],'company_name'=>$data['name'],'mobile_no'=>$data['mobile_no'],'password'=>$data['password'],'otp'=>$otp,'agree_check'=>$data['agree_check']]);
            
            // $subject="OTP - ".$otp." For Restaurant Managment System Login";            
            // $html=view('Emails.otp',compact('otp'))->render();  
            // $to= $data['email'];
            // $headers = "MIME-Version: 1.0" . "\r\n";
            // $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // $headers .= 'From: <order@boleh.store>' . "\r\n";
            // mail($to,$subject,$html,$headers);

            //$emaildata = array('otp'=>$otp);
           //  $user = array('to_email'=>$data['email'],'to_name'=>$data['name']);
          
            
          //   Mail::send('Emails.otp', $emaildata, function($message) use ($user) {
          //     $message->to($user['to_email'],$user['to_name'])->subject('Boleh Store Login');
          //     $message->from('xyz@gmail.com','Virat Gandhi');
          //  });

            return Response::json(array(
                'success' => true,
                'data' => $seller,
                'message'=>'OTP is send to given Email ID'
            ), 200); 
          }

        
      }
    }


    public function verifyotp(Request $request)
    {
        $data=$request->all();
      $rules = array(
        'email' => 'required',
        'otp' => 'required',
   );
   $messages = [
    'required' => 'The :attribute field is required.',
  ];
    $validator = Validator::make($request->all(), $rules,$messages);
      
      if ($validator->fails()) {
        return Response::json(array(
            'success' => false,
            'errors' => $validator->errors(),
            'message'=>'Please Fill All Details.'

        ), 400); 
      }
      else{
         $check_otp=Seller::where('email_id',$data['email'])->where('otp',$data['otp'])->first();
          if($check_otp)
          {
            Seller::where('id', $check_otp->id)->update(['status' => 1]);
            User::create(['name' => $check_otp->name,'email' => $check_otp->email_id,'mobile_no' => $check_otp->mobile_no,'password' => Hash::make($check_otp->password),'normal_password'=>$check_otp->password,'seller_id'=>$check_otp->id,'email_verified_at'=>now()]);
            return Response::json(array(
                'success' => true,
                'data' => $check_otp,
                'message'=>'Your Account is Verified and Now You can login.'
            ), 200); 

          }
          else{
            return Response::json(array(
                'success' => false,
                'data' => $check_otp,
                'message'=>'Sorry OTP not match.'
            ), 400); 
          }

        
      }
    }

    public function get_seller_details(Request $request)
    {
      $data=$request->all();
      $seller['company']=Seller::where('id',$data['seller_id'])->first();
      $seller['address']=SellerAddress::where('seller_id',$data['seller_id'])->where('isdelete',0)->first();
      $seller['bank']=SellerBank::where('seller_id',$data['seller_id'])->where('isdelete',0)->first();
        return Response::json(array(
          'success' => true,
          'data' => $seller,
          'message'=>'Restaurant Details'
         ), 200); 
    }


    public function save_seller_details(Request $request)
    {
      $data=$request->all();
      $rules = array(
        'seller_id' => 'required',
     );

      if ($request->hasFile('logo')){
        $rules['logo']='required|image|mimes:jpeg,png,jpg|dimensions:max_width=400,max_height=200|max:500';
      }
    $messages = [
      'required' => 'The :attribute field is required.',
      'logo.dimensions' => 'The Dimension of logo Should be Height 200 and width 400',
      'logo.max'=>'File Size be less then 500kb'
    ];
    $validator = Validator::make($request->all(), $rules,$messages);
      
      if ($validator->fails()) {
        return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray()
  
      ), 400); 
      }
      else{
        if ($request->hasFile('logo')){
          $file = $request->file('logo');
         $extension = $file->getClientOriginalExtension(); // you can also use file name
         $fileName = $data['seller_id'].'_'.time().'.'.$extension;
         $path = public_path().'/restaurant_logos';
         $uplaod = $file->move($path,$fileName);
         $data['image_path']=URL::to('/').'/restaurant_logos/'.$fileName;
        // Storage::disk('public/seller_logos')->put($fileName, $request->file('image'));
         }
        $saveaddress=SellerAddress::saveaddress($data);
        $savebank=SellerBank::savebank($data);
        $updateseller= Seller::updateseller($data);
        return Response::json(array(
          'success' => true,
          'data' => $data,
          'message'=>'Restaurant Details Saved Successfully.'
         ), 200); 
        }
    }


    
    public function list_product(Request $request)
    {
      $data=$request->all();
      $list=Product::select('products.id','product_name','image','stock','product_details','categories.category_name','sections.section_name',DB::raw('replace(replace(product_type, 1, "Veg"),0,"Non-veg")as product_type'))
      ->leftJoin('categories', 'categories.id', '=', 'products.category')
      ->leftJoin('sections', 'sections.id', '=', 'products.section')
      ->where('products.isdelete',0);
       if(isset($data['seller_id']))
       {
         $list=$list->where('seller_id',$data['seller_id']);
       }
      if($request->search['value'])
      {
        $list=$list->where('product_name','like', '%' . $request->search['value'] . '%');
        $list=$list->orwhere('category_name','like', '%' . $request->search['value'] . '%');
      }
      $count=$list->count();
      $final_list=$list->skip($data['start'])->take($data['length'])->get();
     
      return response()->json(['recordsTotal' => $count,'recordsFiltered' =>$count ,'data'=>$final_list]);
    }

    public function save_product(Request $request)
    {
      $data=$request->all();
      $rules = array(
        'image' => 'required|image|mimes:jpeg,png,jpg|dimensions:max_width=400,max_height=200|max:500',
        'seller_id' => 'required',
        'product_name'=>'required',
        'quantity'=>'required',
        'price'=>'required',
        'quantity_type'=>'required',
        'category'=>'required',
        'section'=>'required',
        'product_type'=>'required',
        'product_details'=>'required',
     );
    $messages = [
      'required' => 'The :attribute field is required.',
      'image.dimensions' => 'The Dimension of image Should be Height 200 and width 400',
      'image.mimes' => 'Image should be JPEG,PNG,JPG',
      'image.max' => 'Maximum 500Kb file size is allowed',
    ];
    $validator = Validator::make($request->all(),$rules,$messages);
      
      if ($validator->fails()) {
        return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray(),
          'message'=>"Please File Size in not Valid"
  
      ), 422); 
      }
      else{
        if ($request->hasFile('image')){
          $file = $request->file('image');
         $extension = $file->getClientOriginalExtension(); // you can also use file name
         $fileName = Str::slug($data['product_name']).'_'.time().'.'.$extension;
         $path = public_path().'/products';
         $uplaod = $file->move($path,$fileName);
         $data['image_path']='/products/'.$fileName;
        // Storage::disk('public/seller_logos')->put($fileName, $request->file('image'));
         }
        $saveproduct=Product::Create(['product_name'=>$data['product_name'],'currency'=>$data['currency'],'category'=>$data['category'],'section'=>$data['section'],'product_type'=>$data['product_type'],'product_details'=>$data['product_details'],'seller_id'=>$data['seller_id'],'image'=>$data['image_path'],'stock'=>isset($data['stock']) ?? 0]);
        
        foreach ($data['quantity_type'] as $key => $value) {
          $items[$key]['product_id'] = $saveproduct->id;
          $items[$key]['quantity_type'] = $data['quantity_type'][$key];
          $items[$key]['price'] = $data['price'][$key];
          $items[$key]['quantity'] = $data['quantity'][$key];
      }
     $pro_items= ProductPrice::insert($items);
        return Response::json(array(
          'success' => true,
          'data' => $items,
          'message'=>'Product Details Saved Successfully.'
         ), 200); 
        }
    }

    public function get_product(Request $request)
    {
      $data=$request->all();
     $product['product']=Product::where('id',$data['product_id'])->first();
     $product['item']=ProductPrice::where('product_id',$data['product_id'])->where('isdelete',0)->get();
        return Response::json(array(
          'success' => true,
          'data' => $product,
          'message'=>'Product Details.'
         ), 200); 
    }

    public function delete_product(Request $request)
    {
      $data=$request->all();
     $product=Product::where('id',$data['product_id'])->update(['isdelete' => 1]);
     $product=ProductPrice::where('product_id',$data['product_id'])->update(['isdelete' => 1]);
        return Response::json(array(
          'success' => true,
          'data' => $product,
          'message'=>'Product Deleted Successfully.'
         ), 200); 
    }


    public function update_product(Request $request)
    {
      $data=$request->all();
      $rules = array(
        'seller_id' => 'required',
        'product_name'=>'required',
        'quantity'=>'required',
        'price'=>'required',
        'quantity_type'=>'required',
        'category'=>'required',
        'section'=>'required',
        'product_type'=>'required',
        'product_details'=>'required',
        'product_id'=>'required'
     );
     if ($request->hasFile('image')){
      $rules['image']='required|image|mimes:jpeg,png,jpg|dimensions:max_width=400,max_height=200|max:500';
    }

    $messages = [
      'required' => 'The :attribute field is required.',
      'image.dimensions' => 'The Dimension of Image Should be Height 200 and width 400',
      'image.mimes' => 'Image should be JPEG,PNG,JPG',
      'image.max' => 'Maximum 500Kb file size is allowed',
    ];
    $validator = Validator::make($request->all(),$rules,$messages);
      
      if ($validator->fails()) {
      //   return response()->json([
      //     'error' => $validator->errors()->all()
      // ],400);
        return Response::json(array(
          'success' => false,
          'errors' => $validator->errors()->all(),
          'message'=>"Please File Size in not Valid"
      ), 400); 
      
      }
      else{
        if ($request->hasFile('image')){
          $file = $request->file('image');
         $extension = $file->getClientOriginalExtension(); // you can also use file name
         $fileName = Str::slug($data['product_name']).'_'.time().'.'.$extension;
         $path = public_path().'/products';
         $uplaod = $file->move($path,$fileName);
         $data['image_path']='/products/'.$fileName;
        // Storage::disk('public/seller_logos')->put($fileName, $request->file('image'));
         }
        $updateproduct=Product::updateProduct($data);
        return Response::json(array(
          'success' => true,
          'data' => $data,
          'message'=>'Product Details Updated Successfully.'
         ), 200); 
        }
    }

    public function list_table(Request $request)
    {
      $data=$request->all();
      $list=Tables::select('res_tables.*','sections.section_name')->where('res_tables.isdelete',0)->leftJoin('sections', 'sections.id', '=', 'res_tables.section_id');
       if(isset($data['seller_id']))
       {
         $list=$list->where('res_tables.res_id',$data['seller_id']);
       }
      if($request->search['value'])
      {
        $list=$list->where('table_name','like', '%' . $request->search['value'] . '%');
      }
      $count=$list->count();
      $final_list=$list->skip($data['start'])->take($data['length'])->get();
     
      return response()->json(['recordsTotal' => $count,'recordsFiltered' =>$count ,'data'=>$final_list]);
    }

    public function save_table(Request $request)
    {
      $data=$request->all();
      $rules = array(
        'table_name'=>'required',
        'section'=>'required',
        'seller_id'=>'required',
     );
    $messages = [
      'required' => 'The :attribute field is required.',
    ];
    $validator = Validator::make($request->all(),$rules,$messages);
      
      if ($validator->fails()) {
        return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray(),
          'message'=>"Please Fill All Details"
      ), 422); 
      }
      else{
        $rest_no=$data['seller_id'];   
        $table_no=$data['table_name']; 
        $url=URL::to('/').'/customerlogin/'.$rest_no.'/'.$table_no;
        $qrcode = base64_encode(QrCode::format('svg')->size(500)->errorCorrection('H')->generate($url));
        $pdf = PDF::loadView('qrcode', compact('qrcode','table_no'));
       // $pdf->download('pdfview.pdf');
        $content = $pdf->download()->getOriginalContent();
        $file_path='qrcodes/'.$rest_no.'-'.$table_no.'.pdf';
        file_put_contents($file_path, $content);
        $saveproduct=Tables::Create(['table_name'=>$data['table_name'],'section_id'=>$data['section'],'url'=> $url,'res_id'=>$data['seller_id'],'qr_code'=>$file_path]);

        return Response::json(array(
          'success' => true,
          'data' => $data,
          'message'=>'Table Details Saved Successfully.'
         ), 200); 
        }
    }

    public function get_table(Request $request)
    {
      $data=$request->all();
      if(isset($data['table_id']) && $data['table_id'] !='')
      {
        $tables=Tables::where('id',$data['table_id'])->first();
      }else{
        $tables=Tables::where('res_id',$data['res_id'])->where('isdelete',0)->get();
      }

    //  $tables=Tables::where('id',$data['table_id'])->first();
        return Response::json(array(
          'success' => true,
          'data' => $tables,
          'message'=>'Tables Details.'
         ), 200); 
    }

    public function delete_table(Request $request)
    {
      $data=$request->all();
     $tables=Tables::where('id',$data['table_id'])->update(['isdelete' => 1]);
        return Response::json(array(
          'success' => true,
          'data' => $tables,
          'message'=>'Table No Deleted Successfully.'
         ), 200); 
    }


    public function update_table(Request $request)
    {
      $data=$request->all();
      $rules = array(
        'table_id'=>'required',
        'table_name'=>'required',
        'section'=>'required',
        'seller_id'=>'required',
     );
    $messages = [
      'required' => 'The :attribute field is required.',
    ];
    $validator = Validator::make($request->all(),$rules,$messages);
      
      if ($validator->fails()) {
      //   return response()->json([
      //     'error' => $validator->errors()->all()
      // ],400);
        return Response::json(array(
          'success' => false,
          'errors' => $validator->errors()->all(),
          'message'=>"Please Fill All Details"
      ), 400); 
      
      }
      else{
      
       // $saveproduct=Tables::updateTableNo($data);
        $rest_no=$data['seller_id'];   
        $table_no=$data['table_name']; 
        $url=URL::to('/').'/customerlogin/'.$rest_no.'/'.$table_no;
        $qrcode = base64_encode(QrCode::format('svg')->size(500)->errorCorrection('H')->generate($url));
        $pdf = PDF::loadView('qrcode', compact('qrcode','table_no'));
       // $pdf->download('pdfview.pdf');
        $content = $pdf->download()->getOriginalContent();
        $file_path='qrcodes/'.$rest_no.'-'.$table_no.'.pdf';
        file_put_contents($file_path, $content);
        $saveproduct=Tables::where('id',$data['table_id'])->update(['table_name'=>$data['table_name'],'section_id'=>$data['section'],'url'=> $url,'res_id'=>$data['seller_id'],'qr_code'=>$file_path]);

        return Response::json(array(
          'success' => true,
          'data' => $data,
          'message'=>'Tables Details Updated Successfully.'
         ), 200); 
        }
    }


    public function list_order(Request $request)
    {
      $data=$request->all();
      $list=OrderItem::select('order_item.*',DB::raw('count(order_item.id)as no_proudct'))
      ->leftJoin('products', 'order_item.product_id', '=', 'products.id');
      
      if(isset($data['seller_id']))
       {
         $list=$list->where('products.seller_id',$data['seller_id']);
       }

      if($request->search['value'])
      {
        $list=$list->where('products.product_name','like', '%' . $request->search['value'] . '%');
      }
      $list=$list->groupBy('order_item.order_no');
      $count=$list->count();
      $final_list=$list->skip($data['start'])->take($data['length'])->get();
     
      return response()->json(['recordsTotal' => $count,'recordsFiltered' =>$count ,'data'=>$final_list]);
    }

    public function order_details(Request $request)
    {
      $data=$request->all();
       
      $order=Order::select('orders.*',DB::raw('replace(replace(replace(payment_method, 1, "At Counter"),2,"Credit Card"),3,"Paypal")as payment_type'))->where('id',$data['order_id'])->first();
      $order_details['orders']=$order;
      $order_details['staff']=User::where('id',$order->staff_id)->first();
      $order_details['customer']=Customer::where('id',$order->user_id)->first();
      $order_details['product']=OrderItem::select('order_item.*','product_name','image','products.currency')
                                    ->leftJoin('products', 'order_item.product_id', '=', 'products.id')
                                    ->where('products.seller_id',$data['seller_id'])
                                    ->where('order_item.order_no',$data['order_id'])
                                    ->get();
      return Response::json(array(
        'success' => true,
        'data' => $order_details,
        'message'=>'Order Details.'
       ), 200); 
      
    }

    public function order_item_status(Request $request)
    {
      $data=$request->all();
       
      $order=OrderItem::where('id',$data['item_id'])->update(['status' => $data['status']]);
 
      return Response::json(array( 'success' => true,'data' => $data,'message'=>'Order Item Status Updated.'), 200); 
    }

    public function seller_list(Request $request)
    {
      $data=$request->all();
       
      $list=Seller::select('id','name','company_name','email_id')->where('status',1)->where('form_status',1)->get();
 
      return Response::json(array( 'success' => true,'data' => $list,'message'=>'Restaurant List.'), 200); 
    }

    public function country_list(Request $request)
    {
      $data=$request->all();
       
      $list=DB::table('country_master')->where('isdelete',0)->get();
 
      return Response::json(array( 'success' => true,'data' => $list,'message'=>'Country List.'), 200); 
    }

    public function state_list(Request $request)
    {
      $data=$request->all();
       
      $list=DB::table('state_master')->where('country_id',$data['country_id'])->where('isdelete',0)->get();
 
      return Response::json(array( 'success' => true,'data' => $list,'message'=>'State List.'), 200); 
    }

    public function city_list(Request $request)
    {
      $data=$request->all();
       
      $list=DB::table('city_master')->where('state_id',$data['state_id'])->where('isdelete',0)->get();
 
      return Response::json(array( 'success' => true,'data' => $list,'message'=>'City List.'), 200); 
    }

    
    public function currency_list(Request $request)
    {
      $data=$request->all();
       
      $list=Currency::get();
 
      return Response::json(array( 'success' => true,'data' => $list,'message'=>'Currency List.'), 200); 
    }

    public function list_seller(Request $request)
    {
      $data=$request->all();
      $list=Seller::select('id','name','company_name','status','email_id','mobile_no','profile_status')->where('status',1);//DB::raw('IF(status = 1, "Active", "Inactive")as current_status'),
   
      if($request->search['value'])
      {
        $list=$list->where('name','like', '%' . $request->search['value'] . '%');
      }
      $count=$list->count();
      $final_list=$list->skip($data['start'])->take($data['length'])->get();
     
      return response()->json(['recordsTotal' => $count,'recordsFiltered' =>$count ,'data'=>$final_list]);
    }

    public function delete_seller(Request $request)
    {
      $data=$request->all();
     $seller=Seller::where('id',$data['seller_id'])->update(['status' => 0]);
        return Response::json(array(
          'success' => true,
          'data' => $seller,
          'message'=>'Restaurant Deleted Successfully.'
         ), 200); 
    }

    public function approve_order(Request $request)
    {
      $data=$request->all();
      $rules = array(
        'seller_id'=>'required',
        'order_id'=>'required',
     );
    $messages = [
      'required' => 'The :attribute field is required.',
     // 'logo.dimensions' => 'The Dimension of logo Should be Height 200 and width 400',
    ];
    $validator = Validator::make($request->all(), $rules,$messages);
      
      if ($validator->fails()) {
        return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray(),
          'message'=>"Please Fill All Details"
      ), 400); 
      }
      else{
        $order=Order::where('id',$data['order_id'])->update(['seller_status' => 1]);
 
       // $approve_email=$this->approve_order_email($data['order_id']);
        return Response::json(array( 'success' => true,'data' => $data,'message'=>'Order Approved Successfully.'), 200); 
      }
    }

    public function reject_order(Request $request)
    {
      $data=$request->all();
      $rules = array(
        'seller_id'=>'required',
        'order_id'=>'required',
        'reason'=>'required',
     );
    $messages = [
      'required' => 'The :attribute field is required.',
     // 'logo.dimensions' => 'The Dimension of logo Should be Height 200 and width 400',
    ];
    $validator = Validator::make($request->all(), $rules,$messages);
      
      if ($validator->fails()) {
        return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray(),
          'message'=>"Please Fill All Details"
      ), 400); 
      }
      else{
        $order=Order::where('id',$data['order_id'])->update(['seller_status' => 2,'reason'=>$data['reason']]);
        $reject_email=$this->reject_order_email($data['order_id']);
        return Response::json(array( 'success' => true,'data' => $data,'message'=>'Order Rejected Successfully.'), 200); 
      }
    }


    public function update_seller_status(Request $request)
    {
      $data=$request->all();
       $update_status=Seller::where('id',$data)->update(['profile_status'=>$data['status']]);
       return Response::json(array( 'success' => true,'data' => $update_status,'message'=>'Restaurant Status Updated Successfully.'), 200); 
    }


    public function approve_order_email($id){
     
       $data['order']=Order::find($id);
      $data['order_list']=OrderItem::select('order_item.*','product_name','products.price','image','products.seller_id')
                                    ->leftJoin('products', 'order_item.product_id', '=', 'products.id')
                                    ->where('order_item.order_no',$data['order']->id)
                                    ->get();
      $data['seller']=SellerBank::select('seller_banks.*','sellers.currency_id','currency_master.symbol')
      ->leftJoin('sellers', 'sellers.id', '=', 'seller_banks.seller_id')
      ->leftJoin('currency_master', 'currency_master.id', '=', 'sellers.currency_id')
      ->where('seller_id',$data['order_list'][0]->seller_id)->where('isdelete',0)->first();
                 
      $subject="Order Confirm";            
      $html=view('Emails.approve_order',compact('data'))->render();  
	    $to= $data['order']->user_id;
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: <order@boleh.store>' . "\r\n";
		mail($to,$subject,$html,$headers);
      return $html;
    }

    public function reject_order_email($id){
     
      $data['order']=Order::find($id);
      $data['order_list']=OrderItem::select('order_item.*','product_name','products.price','image')
                                    ->leftJoin('products', 'order_item.product_id', '=', 'products.id')
                                    ->where('order_item.order_no',$data['order']->id)
                                    ->get();
                                   
      $subject="Order Rejected";            
      $html=view('Emails.reject_order',compact('data'))->render();  
      $to= $data['order']->user_id;
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
      $headers .= 'From: <order@boleh.store>' . "\r\n";
      mail($to,$subject,$html,$headers);
      return $html;
    }

    public function list_users(Request $request)
    {
      $data=$request->all();
      $list=User::select('users.id','name','email','mobile_no','status','res_roles.role_name')
      ->leftJoin('res_roles', 'users.role', '=', 'res_roles.id')
      ->where('seller_id',$data['res_id']);
      if($request->search['value'])
      {
        $list=$list->where('name','like', '%' . $request->search['value'] . '%');
      }
      $count=$list->count();
      $final_list=$list->skip($data['start'])->take($data['length'])->get();
     
      return response()->json(['recordsTotal' => $count,'recordsFiltered' =>$count ,'data'=>$final_list]);
    }

    
    public function save_user(Request $request)
    {
      $data=$request->all();
      $rules = array(
        'name'=>'required',
        'email'=>'required',
        'mobile_no'=>'required',
        'password'=>'required',
        'role'=>'required',
        'seller_id'=>'required',
     );
    $messages = [
      'required' => 'The :attribute field is required.',
    ];
    $validator = Validator::make($request->all(),$rules,$messages);
      
      if ($validator->fails()) {
        return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray(),
          'message'=>"Please Fill All Details"
      ), 422); 
      }
      else{
       
        $saveproduct=User::Create(['name'=>$data['name'],'email'=>$data['email'],'mobile_no'=>$data['mobile_no'],'role'=>$data['role'],'seller_id'=>$data['seller_id'],'password'=>Hash::make($data['password']),'normal_password'=>$data['password']]);
        return Response::json(array(
          'success' => true,
          'data' => $data,
          'message'=>'User Details Saved Successfully.'
         ), 200); 
        }
    }

    public function update_user(Request $request)
    {
      $data=$request->all();
      $rules = array(
        'name'=>'required',
        'email'=>'required',
        'mobile_no'=>'required',
        'password'=>'required',
        'role'=>'required',
        'seller_id'=>'required',
        'user_id'=>'required',
     );
    $messages = [
      'required' => 'The :attribute field is required.',
    ];
    $validator = Validator::make($request->all(),$rules,$messages);
      
      if ($validator->fails()) {
        return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray(),
          'message'=>"Please Fill All Details"
      ), 422); 
      }
      else{
       
        $saveproduct=User::where('id',$data['user_id'])->update(['name'=>$data['name'],'email'=>$data['email'],'mobile_no'=>$data['mobile_no'],'role'=>$data['role'],'seller_id'=>$data['seller_id'],'password'=>Hash::make($data['password']),'normal_password'=>$data['password']]);
        return Response::json(array(
          'success' => true,
          'data' => $data,
          'message'=>'User Details Updated Successfully.'
         ), 200); 
        }
    }

    public function get_user(Request $request)
    {
      $data=$request->all();
      if(isset($data['user_id']) && $data['user_id'] !='')
      {
        $user=User::where('id',$data['user_id'])->where('seller_id',$data['seller_id'])->first();
      }else{
        $user=User::where('seller_id',$data['seller_id'])->get();
      }
    
        return Response::json(array(
          'success' => true,
          'data' => $user,
          'message'=>'User Details.'
         ), 200); 
    }


    public function getroles(Request $request)
    {
      $data=$request->all();
      
      $list=Roles::where('id','!=','1')->get();
 
      return Response::json(array( 'success' => true,'data' => $list,'message'=>'Roles List.'), 200); 
    }

    public function get_currency(Request $request)
    {
      $data=$request->all();
      
      $list=Seller::select('currency_master.id','currency_master.symbol')->leftJoin('currency_master', 'currency_master.id', '=', 'sellers.currency_id')->where('sellers.id',$data['seller_id'])->first();
 
      return Response::json(array( 'success' => true,'data' => $list,'message'=>'Restaurant Currency.'), 200); 
    }

    public function dashboard_count(Request $request)
    {
      $data=$request->all();
      
      $order=Order::select('id','total_payment','seller_status');
      $list['products']=Product::select('id');
      $list['sellers']=Seller::select('id')->where('form_status',1);
      if(isset($data['seller_id']))
      {
        $order=$order->where('seller_id',$data['seller_id']);
        $list['products']=$list['products']->where('seller_id',$data['seller_id']);
        $list['sellers']=$list['sellers']->where('id',$data['seller_id']);
      }
      $list['orders']=$order->count('id');
      $list['earn']=$order->where('seller_status',1)->sum('total_payment');
      $list['products']=$list['products']->count();
      $list['sellers']=$list['sellers']->count();
      //$list=Seller::select('currency_master.id','currency_master.symbol')->leftJoin('currency_master', 'currency_master.id', '=', 'sellers.currency_id')->where('sellers.id',$data['seller_id'])->first();
 
      return Response::json(array( 'success' => true,'data' => $list,'message'=>'Dashboard Details.'), 200); 
    }

    public function top_seller(Request $request)
    {
       $list=Seller::where('profile_status',0)->limit(5)->get();
       return Response::json(array( 'success' => true,'data' => $list,'message'=>'Dashboard Details.'), 200); 
    }


    
    public function list_category(Request $request)
    {
      $data=$request->all();
      $list=Category::where('isdelete',0);
       if(isset($data['seller_id']))
       {
         $list=$list->where('res_id',$data['seller_id']);
       }
      if($request->search['value'])
      {
        $list=$list->where('category_name','like', '%' . $request->search['value'] . '%');
      }
      $count=$list->count();
      $final_list=$list->skip($data['start'])->take($data['length'])->get();
     
      return response()->json(['recordsTotal' => $count,'recordsFiltered' =>$count ,'data'=>$final_list]);
    }

    public function save_category(Request $request)
    {
      $data=$request->all();
      $rules = array(
        'category_name'=>'required',
        'seller_id'=>'required',
     );
    $messages = [
      'required' => 'The :attribute field is required.',
    ];
    $validator = Validator::make($request->all(),$rules,$messages);
      
      if ($validator->fails()) {
        return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray(),
          'message'=>"Please Fill All Details"
      ), 422); 
      }
      else{
       
        $saveproduct=Category::Create(['category_name'=>$data['category_name'],'res_id'=>$data['seller_id']]);
        return Response::json(array(
          'success' => true,
          'data' => $data,
          'message'=>'Category Details Saved Successfully.'
         ), 200); 
        }
    }

    public function get_category(Request $request)
    {
      $data=$request->all();
      if(isset($data['category_id']) && $data['category_id'] !='')
      {
        $category=Category::where('id',$data['category_id'])->where('res_id',$data['seller_id'])->first();
      }else{
        $category=Category::where('res_id',$data['seller_id'])->get();
      }
    
        return Response::json(array(
          'success' => true,
          'data' => $category,
          'message'=>'Category Details.'
         ), 200); 
    }

    public function delete_category(Request $request)
    {
      $data=$request->all();
     $category=Category::where('id',$data['category_id'])->update(['isdelete' => 1]);
        return Response::json(array(
          'success' => true,
          'data' => $category,
          'message'=>'Category Deleted Successfully.'
         ), 200); 
    }


    public function update_category(Request $request)
    {
      $data=$request->all();
      $rules = array(
        'category_id'=>'required',
        'category_name'=>'required',
        'seller_id'=>'required',
     );
    $messages = [
      'required' => 'The :attribute field is required.',
    ];
    $validator = Validator::make($request->all(),$rules,$messages);
      
      if ($validator->fails()) {
      //   return response()->json([
      //     'error' => $validator->errors()->all()
      // ],400);
        return Response::json(array(
          'success' => false,
          'errors' => $validator->errors()->all(),
          'message'=>"Please Fill All Details"
      ), 400); 
      
      }
      else{
        $saveproduct=Category::where('id',$data['category_id'])->update(['category_name'=>$data['category_name'],'res_id'=>$data['seller_id']]);

        return Response::json(array(
          'success' => true,
          'data' => $data,
          'message'=>'Category Details Updated Successfully.'
         ), 200); 
        }
    }


    public function menu(Request $request)
    {
      $data=$request->all();
      $table=Tables::where('id',$data['table_id'])->first();
      $list=ProductPrice::select('product_price.quantity','product_price.quantity_type','product_price.price','product_price.id as item_id','products.*','categories.category_name')
      ->leftJoin('products', 'products.id', '=', 'product_price.product_id')
      ->leftJoin('categories', 'categories.id', '=', 'products.category')
      ->where('product_price.isdelete',0)->where('seller_id',$data['seller_id'])->where('section',$table->section_id);
       if(isset($data['type']))
       {
         $list=$list->where('product_type',$data['type']);
       }
       if(isset($data['category']))
      {
        $list=$list->where('category_name',$data['category']);
      }
      if(isset($data['search']))
      {
        $list=$list->where('category_name','like', '%' . $data['search'] . '%')
                  ->orWhere('product_name','like', '%' . $data['search'] . '%');
      }
      $list=$list->get();

      foreach($list as $k=>$v)
      {
        $list[$k]['cart']=Cart::where('user_id',$data['user_id'])->where('item_id',$v->item_id)->where('table_id',$data['table_id'])->get();
      }
     
    // return $list;
    return Response::json(array(
                'success' => true,
                'data' => $list,
                'message'=>'Menu List'
            ), 200); 
    }


    
    public function menufilter(Request $request)
    {
      $data=$request->all();
      $table=Tables::where('id',$data['table_id'])->first();
      $list=ProductPrice::select('product_price.quantity','product_price.quantity_type','product_price.price','product_price.id as item_id','products.*','categories.category_name')
      ->leftJoin('products', 'products.id', '=', 'product_price.product_id')
      ->leftJoin('categories', 'categories.id', '=', 'products.category')
      ->where('product_price.isdelete',0)->where('seller_id',$data['seller_id'])->where('section',$table->section_id);
       if(isset($data['type']))
       {
         $list=$list->where('product_type',$data['type']);
       }
       if(isset($data['category']))
      {
        $list=$list->where('category_name',$data['category']);
      }
      if(isset($data['search']))
      {
        $list=$list->where('category_name','like', '%' . $data['search'] . '%')
                  ->orWhere('product_name','like', '%' . $data['search'] . '%');
      }
      $list=$list->get();

      foreach($list as $k=>$v)
      {
        $list[$k]['cart']=Cart::where('item_id',$v->item_id)->where('table_id',$data['table_id'])->get();
      }

    // return $list;
    return Response::json(array(
                'success' => true,
                'data' => $list,
                'message'=>'Menu List'
            ), 200); 
    }


    public function addcart(Request $request)
    {
      $data=$request->all();
      $rules = array(
        'product_id'=>'required',
        //'user_id'=>'required',
        'table_id'=>'required',
        'item_id'=>'required',
        'price'=>'required',
        'quantity'=>'required',
     );
    $messages = [
      'required' => 'The :attribute field is required.',
    ];
    $validator = Validator::make($request->all(),$rules,$messages);
      
      if ($validator->fails()) {
        return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray(),
          'message'=>"Please Fill All Details"
      ), 422); 
      }
      else{
       
        $saveproduct=Cart::Create(['user_id'=>$data['user_id'] ?? NULL,'table_id'=>$data['table_id'],'product_id'=>$data['product_id'],'item_id'=>$data['item_id'],'price'=>$data['price'],'quantity'=>$data['quantity'],'staff_id'=>$data['staff_id']?? NULL]);
        return Response::json(array(
          'success' => true,
          'data' => $data,
          'message'=>'Order is Added Successfully.'
         ), 200); 
        }
    }

    public function getcart(Request $request)
    {
       $data=$request->all();
       $list=Cart::select('cart.quantity','product_price.quantity_type','product_price.quantity as item_quantity','product_price.id as item_id','cart.price','products.product_name','products.currency','products.image','products.id as product_id','cart.id',DB::raw('replace(replace(product_type, 1, "Veg"),0,"Non-veg")as product_type'))
       ->leftJoin('product_price', 'product_price.id', '=', 'cart.item_id')
       ->leftJoin('products', 'products.id', '=', 'product_price.product_id')
       ->where('table_id',$data['table_id']);
       if(isset($data['user_id']))
       {
        $list=$list->where('user_id',$data['user_id']);
       }
      
       $list=$list->get();
       return Response::json(array(
        'success' => true,
        'data' => $list,
        'message'=>'Cart List'
    ), 200); 
    }

    public function getcartCount(Request $request)
    {
       $data=$request->all();
       $list=Cart::where('user_id',$data['user_id'])->where('table_id',$data['table_id'])->count();
       return Response::json(array(
        'success' => true,
        'data' => $list,
        'message'=>'Cart Count'
    ), 200); 
    }


    
    public function updatecart(Request $request)
    {
      $data=$request->all();
      $rules = array(
        'product_id'=>'required',
       // 'user_id'=>'required',
        'table_id'=>'required',
        'item_id'=>'required',
       // 'price'=>'required',
        'quantity'=>'required',
     );
    $messages = [
      'required' => 'The :attribute field is required.',
    ];
    $validator = Validator::make($request->all(),$rules,$messages);
      
      if ($validator->fails()) {
        return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray(),
          'message'=>"Please Fill All Details"
      ), 422); 
      }
      else{
       
        $saveproduct=Cart::where('table_id',$data['table_id'])->where('item_id',$data['item_id']);
        if(isset($data['user_id']))
        {
          $saveproduct=$saveproduct->where('user_id',$data['user_id']);
        }
        if(isset($data['staff_id']))
        {
          $saveproduct=$saveproduct->where('staff_id',$data['staff_id']);
        }
        
        $saveproduct=$saveproduct->update(['quantity'=>$data['quantity']]);
        return Response::json(array(
          'success' => true,
          'data' => $data,
          'message'=>'Order Updated Successfully.'
         ), 200); 
        }
    }

    public function deletecart(Request $request)
    {
      $data=$request->all();
      $rules = array(
        // 'product_id'=>'required',
        // 'user_id'=>'required',
        // 'table_id'=>'required',
        // 'item_id'=>'required',
        'cart_id'=>'required'
     );
    $messages = [
      'required' => 'The :attribute field is required.',
    ];
    $validator = Validator::make($request->all(),$rules,$messages);
      
      if ($validator->fails()) {
        return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray(),
          'message'=>"Please Fill All Details"
      ), 422); 
      }
      else{
       
       // $saveproduct=Cart::where('table_id',$data['table_id'])->where('item_id',$data['item_id'])->where('user_id',$data['user_id'])->delete();
       $saveproduct=Cart::where('id',$data['cart_id'])->delete();
        return Response::json(array(
          'success' => true,
          'data' => $data,
          'message'=>'Order Deleted Successfully.'
         ), 200); 
        }
    }


    public function list_currentorder(Request $request)
    {
      $data=$request->all();
      $list=Cart::select('cart.*','products.product_name','product_price.quantity_type','res_tables.table_name','categories.category_name','product_price.quantity as weight','order_status.name as status')
      ->leftJoin('product_price', 'product_price.id', '=', 'cart.item_id')
      ->leftJoin('products', 'products.id', '=', 'cart.product_id')
      ->leftJoin('categories', 'categories.id', '=', 'products.category')
      ->leftJoin('res_tables', 'res_tables.id', '=', 'cart.table_id')
      ->leftJoin('order_status', 'order_status.id', '=', 'cart.order_status')
      ->where('products.seller_id',$data['seller_id']);
       
      if($request->search['value'])
      {
        $list=$list->where('category_name','like', '%' . $request->search['value'] . '%')
        ->orWhere('product_name','like', '%' . $request->search['value'] . '%')
        ->orWhere('table_name','like', '%' . $request->search['value'] . '%');
      }
      $count=$list->count();
      $final_list=$list->skip($data['start'])->take($data['length'])->get();
     
      return response()->json(['recordsTotal' => $count,'recordsFiltered' =>$count ,'data'=>$final_list]);
    }


    public function customer_register(Request $request)
    {
      $data=$request->all();
      $rules = array(
        'name'=>'required',
        'email'=>'required',
        'mobile_no'=>'required',
        'password'=>'required',
        'res_id'=>'required',
     );
    $messages = [
      'required' => 'The :attribute field is required.',
    ];
    $validator = Validator::make($request->all(),$rules,$messages);
      
      if ($validator->fails()) {
        return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray(),
          'message'=>"Please Fill All Details"
      ), 422); 
      }
      else{
       
        $saveproduct=Customer::Create(['name'=>$data['name'],'email'=>$data['email'],'mobile_no'=>$data['mobile_no'],'password'=>md5($data['password']),'seller_id'=>$data['res_id']]);
        return Response::json(array(
          'success' => true,
          'data' => $data,
          'message'=>'Customer Added Successfully.'
         ), 200); 
        }
    }

    public function customer_login(Request $request)
    {
      $data=$request->all();
      $rules = array(
        'email'=>'required',
        'password'=>'required',
     );
    $messages = [
      'required' => 'The :attribute field is required.',
    ];
    $validator = Validator::make($request->all(),$rules,$messages);
      
      if ($validator->fails()) {
        return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray(),
          'message'=>"Please Fill All Details"
      ), 422); 
      }
      else{
       
        $checklogin=Customer::where('email',$data['email'])->where('password',md5($data['password']))->where('isdelete',0)->first();
        return Response::json(array(
          'success' => true,
          'data' => $checklogin,
          'message'=>'Customer Login Details.'
         ), 200); 
        }
    }

    public function list_customer(Request $request)
    {
      $data=$request->all();
      $list=Customer::select('id','name','email','mobile_no','isdelete')->where('seller_id',$data['seller_id']);
      if($request->search['value'])
      {
        $list=$list->where('name','like', '%' . $request->search['value'] . '%');
      }
      $count=$list->count();
      $final_list=$list->skip($data['start'])->take($data['length'])->get();
     
      return response()->json(['recordsTotal' => $count,'recordsFiltered' =>$count ,'data'=>$final_list]);
    }

    
    public function list_section(Request $request)
    {
      $data=$request->all();
      $list=Section::where('isdelete',0);
       if(isset($data['res_id']))
       {
         $list=$list->where('res_id',$data['res_id']);
       }
      if($request->search['value'])
      {
        $list=$list->where('section_name','like', '%' . $request->search['value'] . '%');
      }
      $count=$list->count();
      $final_list=$list->skip($data['start'])->take($data['length'])->get();
     
      return response()->json(['recordsTotal' => $count,'recordsFiltered' =>$count ,'data'=>$final_list]);
    }

    public function save_section(Request $request)
    {
      $data=$request->all();
      $rules = array(
        'section_name'=>'required',
        'res_id'=>'required',
     );
    $messages = [
      'required' => 'The :attribute field is required.',
    ];
    $validator = Validator::make($request->all(),$rules,$messages);
      
      if ($validator->fails()) {
        return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray(),
          'message'=>"Please Fill All Details"
      ), 422); 
      }
      else{
       
        $saveproduct=Section::Create(['section_name'=>$data['section_name'],'res_id'=>$data['res_id']]);
        return Response::json(array(
          'success' => true,
          'data' => $data,
          'message'=>'Section Details Saved Successfully.'
         ), 200); 
        }
    }

    public function get_section(Request $request)
    {
      $data=$request->all();
      if(isset($data['section_id']) && $data['section_id'] !='')
      {
        $section=Section::where('id',$data['section_id'])->where('res_id',$data['res_id'])->first();
      }else{
        $section=Section::where('res_id',$data['res_id'])->get();
      }
    
        return Response::json(array(
          'success' => true,
          'data' => $section,
          'message'=>'Section Details.'
         ), 200); 
    }

    public function delete_section(Request $request)
    {
      $data=$request->all();
     $section=Section::where('id',$data['section_id'])->update(['isdelete' => 1]);
        return Response::json(array(
          'success' => true,
          'data' => $section,
          'message'=>'Section Deleted Successfully.'
         ), 200); 
    }


    public function update_section(Request $request)
    {
      $data=$request->all();
      $rules = array(
        'section_id'=>'required',
        'section_name'=>'required',
        'res_id'=>'required',
     );
    $messages = [
      'required' => 'The :attribute field is required.',
    ];
    $validator = Validator::make($request->all(),$rules,$messages);
      
      if ($validator->fails()) {
      //   return response()->json([
      //     'error' => $validator->errors()->all()
      // ],400);
        return Response::json(array(
          'success' => false,
          'errors' => $validator->errors()->all(),
          'message'=>"Please Fill All Details"
      ), 400); 
      
      }
      else{
        $saveproduct=Section::where('id',$data['section_id'])->update(['section_name'=>$data['section_name'],'res_id'=>$data['res_id']]);

        return Response::json(array(
          'success' => true,
          'data' => $data,
          'message'=>'Section Details Updated Successfully.'
         ), 200); 
        }
    }

    public function get_orderstatus(Request $request)
    {
      $data=$request->all();
      if(isset($data['status_id']) && $data['status_id'] !='')
      {
        $status=OrderStatus::where('id',$data['status_id'])->first();
      }else{
        $status=OrderStatus::get();
      }
    
        return Response::json(array(
          'success' => true,
          'data' => $status,
          'message'=>'Status Details.'
         ), 200); 
    }

    public function update_orderstatus(Request $request)
    {
      $data=$request->all();
      $rules = array(
        'cart_id'=>'required',
        'seller_id'=>'required',
        'order_status'=>'required',
       // 'staff_id'=>'required',
     );
    $messages = [
      'required' => 'The :attribute field is required.',
    ];
    $validator = Validator::make($request->all(),$rules,$messages);
      
      if ($validator->fails()) {
        return Response::json(array(
          'success' => false,
          'errors' => $validator->errors()->all(),
          'message'=>"Please Fill All Details"
      ), 400); 
      
      }
      else{
        $saveproduct=Cart::where('id',$data['cart_id'])->update(['order_status'=>$data['order_status']]);

        return Response::json(array(
          'success' => true,
          'data' => $data,
          'message'=>'Order Details Updated Successfully.'
         ), 200); 
        }
    }

    //Customers API

    public function customerotp(Request $request)
    {
        $data=$request->all();
      $rules = array(
        'res_id'=>'required',
        'email' => 'required',
   );
    $validator = Validator::make($request->all(), $rules);
      
      if ($validator->fails()) {
        return Response::json(array(
            'success' => false,
            'errors' => $validator->errors(),
            'message'=>'Please Fill All Details.'

        ), 400); 
      }
      else{
         
            $otp='123456';    //random_int(100000, 999999);
            $customer=Customer::updateOrCreate(['email'=>$data['email'],'seller_id'=>$data['res_id']],['otp'=>$otp]);
            
            // $subject="OTP - ".$otp." For Restaurant Managment System Login";            
            // $html=view('Emails.otp',compact('otp'))->render();  
            // $to= $data['email'];
            // $headers = "MIME-Version: 1.0" . "\r\n";
            // $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // $headers .= 'From: <order@boleh.store>' . "\r\n";
            // mail($to,$subject,$html,$headers);

            //$emaildata = array('otp'=>$otp);
           //  $user = array('to_email'=>$data['email'],'to_name'=>$data['name']);
          
            
          //   Mail::send('Emails.otp', $emaildata, function($message) use ($user) {
          //     $message->to($user['to_email'],$user['to_name'])->subject('Boleh Store Login');
          //     $message->from('xyz@gmail.com','Virat Gandhi');
          //  });

            return Response::json(array(
                'success' => true,
                'data' => $customer,
                'message'=>'OTP is send to given Email ID'
            ), 200); 
          }
    }

    public function generatebill(Request $request)
    {
      $data=$request->all();
      $rules = array(
      //  'user_id'=>'required',
        'table_id' => 'required',
      );
    $validator = Validator::make($request->all(), $rules);
      
      if ($validator->fails()) {
        return Response::json(array(
            'success' => false,
            'errors' => $validator->errors(),
            'message'=>'Please Fill All Details.'

        ), 400); 
      }
      else{
         $cart=Cart::where('table_id',$data['table_id']);
         if(isset($data['user_id']))
         {
          $cart= $cart->where('user_id',$data['user_id']);
         }
         $cart= $cart->get();
          
         $order=Order::create(['user_id'=>$data['user_id'] ?? "",'table_id'=>$data['table_id'],'payment_method'=>$data['payment'],'total_payment'=>$data['final'],'seller_id'=>$data['seller_id'],'staff_id'=>$data['staff_id']]);

         $item=[];
         foreach ($cart as $k=>$v){ 
             $item[$k]['order_no']= $order->id;
             $item[$k]['product_id']=$v->product_id;
             $item[$k]['item_id']=$v->item_id;
             $item[$k]['table_id']=$v->table_id;
             $item[$k]['quantity']=$v->quantity;
             $item[$k]['price']=$v->price;
             $item[$k]['order_status']=$v->order_status;
          }
          $ordeitem=OrderItem::insert($item);
          $cart=Cart::where('table_id',$data['table_id'])->delete();
            return Response::json(array(
                'success' => true,
                'data' => $order,
                'message'=>'Bill Generated Successfully.'
            ), 200); 
          }
    }

    public function list_billorder(Request $request)
    {
      $data=$request->all();
      $list=Order::select('orders.*','res_tables.table_name',DB::raw('replace(replace(replace(payment_method, 1, "At Counter"),2,"Credit Card"),3,"Paypal")as payment_type'),DB::raw('replace(replace(replace(seller_status, 0, "Pending"),1,"Approve"),2,"Reject")as payment_status'))
      ->leftJoin('res_tables', 'res_tables.id', '=', 'orders.table_id')
      ->where('orders.seller_id',$data['seller_id']);
       
      if($request->search['value'])
      {
        // $list=$list->where('category_name','like', '%' . $request->search['value'] . '%')
        // ->orWhere('product_name','like', '%' . $request->search['value'] . '%')
        // ->orWhere('table_name','like', '%' . $request->search['value'] . '%');
      }
      $count=$list->count();
      $final_list=$list->skip($data['start'])->take($data['length'])->get();
     
      return response()->json(['recordsTotal' => $count,'recordsFiltered' =>$count ,'data'=>$final_list]);
    }


    public function getprofile(Request $request)
    {
      $data=$request->all();
      $rules = array(
        'user_id'=>'required',
        'seller_id'=>'required',
       // 'staff_id'=>'required',
     );
    $messages = [
      'required' => 'The :attribute field is required.',
    ];
    $validator = Validator::make($request->all(),$rules,$messages);
      
      if ($validator->fails()) {
        return Response::json(array(
          'success' => false,
          'errors' => $validator->errors()->all(),
          'message'=>"Please Fill All Details"
      ), 400); 
      
      }
      else{
        $customer=Customer::where('id',$data['user_id'])->where('seller_id',$data['seller_id'])->first();

        return Response::json(array(
          'success' => true,
          'data' => $customer,
          'message'=>'Customer Details.'
         ), 200); 
        }
    }
    
    public function update_customer(Request $request)
    {
      $data=$request->all();
      $rules = array(
        'user_id'=>'required',
        'seller_id'=>'required',
        'name'=>'required',
        'email'=>'required',
        'mobile_no'=>'required',
        'address'=>'required',
     );
    $messages = [
      'required' => 'The :attribute field is required.',
    ];
    $validator = Validator::make($request->all(),$rules,$messages);
      
      if ($validator->fails()) {
        return Response::json(array(
          'success' => false,
          'errors' => $validator->errors()->all(),
          'message'=>"Please Fill All Details"
      ), 400); 
      
      }
      else{
        $customer=Customer::where('id',$data['user_id'])->where('seller_id',$data['seller_id'])->update([
          'name'=>$data['name'],'email'=>$data['email'],'mobile_no'=>$data['mobile_no'],'address'=>$data['address'],
        ]);

        return Response::json(array(
          'success' => true,
          'data' => $customer,
          'message'=>'Customer Details Updated Successfully.'
         ), 200); 
        }
    }

}
