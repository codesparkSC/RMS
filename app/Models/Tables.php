<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tables extends Model
{
    use HasFactory;
    protected $table = 'res_tables';
    protected $fillable = [
        'res_id','table_name','section_id','url','qr_code','isdelete'
    ];


}
