<?php

namespace Module\Product\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Module\Product\Models\Customer;
use Module\Product\Models\QRCodeGenerateDetail;
use Module\Product\Services\CustomerService;
use Module\Product\Services\TransectionService;

class QRCodeController extends Controller
{



    public function checkQrCode(Request $request){

        $qrcode = QRCodeGenerateDetail::query()
            ->with('qr_product.product:id,name')
            ->with('qr_product.unit:id,name')
            ->where('qr_code', $request->qrcode)
            ->first();

        if ($qrcode){

            if ($qrcode->status == 0){

                $qrcode->update([
                    'status'            => 1,
                    'customer_id'       => auth()->user()->customer_id,
                    'source'            => $request->source,
                ]);
                (new TransectionService())->transection($qrcode->id,'Out', $qrcode->prize_amount);

                (new CustomerService())->balance($qrcode->prize_amount);


                return response()->json([

                    'data'      => $qrcode,
                    'message'   => "Used",
                    'status'    => 1,
                ]);

            }
            else{

                return response()->json([

                    'message'   => "Already Used",
                    'status'    => 0,
                ]);
            }




        }

        else{
            return response()->json([

                'message'   => "Please enter valid code",
                'status'    => 0,
            ]);

        }




    }


}
