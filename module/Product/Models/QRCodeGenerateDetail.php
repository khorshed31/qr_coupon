<?php

namespace Module\Product\Models;

use App\Models\Model;

class QRCodeGenerateDetail extends Model
{


    public function qr_product()
    {
        return $this->belongsTo(QRCodeGenerate::class,'qr_code_generate_id','id');
    }



    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
}
