<?php

namespace Module\Product\Models;

use App\Models\Model;

class Withdraw extends Model
{


    public function customer(){

        return $this->belongsTo(Customer::class);
    }
}
