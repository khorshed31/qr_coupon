<?php


namespace Module\Product\Services;


use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Module\Product\Models\Customer;

class CustomerService
{


    public function balance($amount){

        $customer = Customer::authCustomer()->first();
        return $customer->increment('balance', $amount);
    }

    public function balanceDecrement($amount){

        $customer = Customer::authCustomer()->first();
        return $customer->decrement('balance', $amount);
    }


    public function storeOrUpdate($request, $id = null){


        DB::transaction(function () use ($request, $id){

            $customer = Customer::updateOrCreate(
                [
                    'id' => $id
                ],
                [

                'name'              => $request->name,
                'mobile'            => $request->mobile,
                'refer_code'        => $request->refer_code,
                'garage_name'       => $request->garage_name,
                'address'           => $request->garage_address,
            ]);


            User::updateOrCreate(['customer_id' => $customer->id],[

                'name'          => $request->name,
                'mobile'        => $request->mobile,
                'email'         => $request->email,
                'password'      => Hash::make(12345678),
                'type'          => 'customer',
                'customer_id'   => $customer->id,
            ]);


        });

    }
}
