<?php

namespace Module\Product\Models;

use App\Models\Model;

class QRCodeGenerate extends Model
{

    protected $table = 'q_r_code_generates';
    protected $guarded = [];



    public function product(){

        return $this->belongsTo(Product::class);
    }

    public function unit(){

        return $this->belongsTo(Unit::class);
    }


    public function details(){

        return $this->hasMany(QRCodeGenerateDetail::class,'qr_code_generate_id','id');
    }
}
