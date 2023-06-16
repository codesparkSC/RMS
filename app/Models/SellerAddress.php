<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerAddress extends Model
{
    use HasFactory;
    protected $table = 'seller_addresses';

    public static function saveaddress($data){
        $update=SellerAddress::where('seller_id',$data['seller_id'])->update(['isdelete' => 1]);
       
        $save=new SellerAddress();
        $save->seller_id=$data['seller_id'];
        $save->address_line_1=$data['address_line_1'];
        $save->address_line_2=$data['address_line_2'] ?? '';
        $save->landmark=$data['landmark'];
        $save->country=$data['country'];
        $save->state=$data['state'];
        $save->city=$data['city'] ??'';
        $save->zipcode=$data['zipcode'];
        $save->tax=isset($data['tax']) ? $data['tax'] :0 ;
        $save->gst_no=$data['gst_no'] ??'';
        $save->vat=isset($data['vat_check']) ? $data['vat_check'] :0 ;
        $save->vat_no=$data['vat_no'] ??'';
        $save->save();

        return $save;

    }

}
