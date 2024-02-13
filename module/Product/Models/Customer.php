<?php

namespace Module\Product\Models;

use App\Models\Model;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;


class Customer extends Model
{


//    public static function boot()
//    {
//        parent::boot();
//
//        if (!App::runningInConsole()) {
//            /**
//             * Auto create created_by field when create anything through model
//             */
//            static::created(function ($model) {
//dd($model);
//                User::updateOrCreate(['customer_id'  => $model->id],[
//                    'name'          => $model->name,
//                    'mobile'        => $model->mobile,
//                    'email'         => $model->email,
//                    'customer_id'   => $model->id,
//                    'type'          => 'customer',
//                    'password'      => Hash::make(12345678),
//                ]);
//            });
//        }
//    }

    public function scopeAuthCustomer($query){

        $query->whereHas('user',function ($q){
            $q->where('id',auth()->id());
        });
    }

    public function user(){

        return $this->hasOne(User::class,'customer_id','id');
    }


    public function refer_employee(){

        return $this->belongsTo(ReferralEmployee::class,'refer_code','code');
    }



    public function withdraw_customer(){

        return $this->hasMany(Withdraw::class,'customer_id','id');
    }


    public function latestWithdraw(){

        return $this->hasOne(Withdraw::class,'customer_id','id')->orderBy('id', 'DESC')->where('request_status', 0);
    }

}
