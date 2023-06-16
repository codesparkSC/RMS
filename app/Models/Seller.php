<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;
use App\Models\Currency;
class Seller extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'company_name',
        'email_id',
        'password',
        'mobile_no',
        'otp',
        'agree_check',
    ];

    public static function updateseller($data){
        
        $update=Seller::find($data['seller_id']);

        $update->company_name=$data['restaurant_name'];
        $update->name=$data['name'];
        $update->nick_name=$data['nick_name'];
        $update->contact_no	=$data['contact_no'];
        $update->additional_name	=$data['additional_name'];
        $update->additional_email	=$data['additional_email'];
        $update->additional_mobile_no	=$data['additional_mobile_no'];
        $update->same_details	=isset($data['same_contact']) ? $data['same_contact'] :0;
        if(isset($data['image_path']))
        {
            $update->logo	=$data['image_path'];
            $updateuser=User::where('seller_id',$data['seller_id'])->update(['avatar'=>$data['image_path']]);
        }
        $update->form_status=1;
        $update->currency_id=$data['currency'];
        $update->company_no=$data['company_no'];
        $update->res_type=$data['res_type'];
        $update->save();
   
        // $currency=Currency::where('id',$data['currency'])->first();
        //  $update_product=Product::where('seller_id',$data['seller_id'])->update(['currency'=>$currency->symbol]);

        return $update;

    }

}
