<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerBank extends Model
{
    use HasFactory;
    protected $table = 'seller_banks';

    public static function savebank($data){
        $update=SellerBank::where('seller_id',$data['seller_id'])->update(['isdelete' => 1]);
       
        $save=new SellerBank();
        $save->seller_id=$data['seller_id'];
        $save->bank_name=$data['bank_name'];
        $save->bank_account_name=$data['bank_account_name'];
        $save->bank_account_no=$data['bank_account_no'];
        $save->save();

        return $save;

    }

}
