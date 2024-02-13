<?php


namespace Module\Product\Services;


use Module\Product\Models\Transection;

class TransectionService
{


    public function transection($qrcode_id,$type,$amount){

        return Transection::create([

            'customer_id'           => auth()->user()->customer_id,
            'qr_code_id'            => $qrcode_id,
            'type'                  => $type,
            'amount'                => $amount,
        ]);
    }



}
