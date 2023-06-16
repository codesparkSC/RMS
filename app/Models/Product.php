<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductPrice;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'product_name','seller_id','currency','image','stock','product_type','category','product_details','isdelete','section'
    ];


    public static function updateProduct($data){
        
        $update=Product::find($data['product_id']);
        $update->product_name=$data['product_name'];
        $update->category=$data['category'];
        $update->section=$data['section'];
        $update->product_type	=$data['product_type'];
        $update->currency	=$data['currency'];
        $update->product_details	=$data['product_details'];
        $update->seller_id	=$data['seller_id'];
        $update->stock	=isset($data['stock']) ?? 0;
        if(isset($data['image_path']))
        {
            $update->image	=$data['image_path'];
        }
        $update->save();

        $deteitem=ProductPrice::where('product_id',$data['product_id'])->update(['isdelete'=>1]);
        foreach ($data['quantity_type'] as $key => $value) {
            if($data['item_id'][$key]!=0)
            {
                $updateitem=ProductPrice::where('id',$data['item_id'][$key])->update([
                    'quantity_type'=>$data['quantity_type'][$key],
                    'price'=>$data['price'][$key],
                    'quantity'=>$data['quantity'][$key],
                    'isdelete'=>0,
                ]);
            }
            else{
                $creatitem=ProductPrice::Create(['product_id'=>$data['product_id'],'quantity_type'=>$data['quantity_type'][$key],'price'=>$data['price'][$key],'quantity'=>$data['quantity'][$key]]);
            }
            // $items[$key]['product_id'] = $saveproduct->id;
            // $items[$key]['quantity_type'] = $data['quantity_type'][$key];
            // $items[$key]['price'] = $data['price'][$key];
            // $items[$key]['quantity'] = $data['quantity'][$key];
        }

        return $update;

    }

}
