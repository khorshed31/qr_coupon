<?php

namespace Module\Product\Models;

use App\Models\Model;

class ReferralEmployee extends Model
{

    public function customer(){

        return $this->hasMany(Customer::class,'refer_code','code');
    }

}
