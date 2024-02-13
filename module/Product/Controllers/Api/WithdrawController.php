<?php

namespace Module\Product\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Module\Product\Models\Withdraw;
use Module\Product\Services\CustomerService;
use Module\Product\Services\TransectionService;

class WithdrawController extends Controller
{



    public function withdraw(Request $request){

        try {
            if(optional(auth()->user()->customer)->balance > 0){
                $request_withdraw = Withdraw::where('customer_id',auth()->user()->customer_id)
                    ->where('request_status',0)
                    ->latest()
                    ->first();
                if (!$request_withdraw){

                    Withdraw::create([
                        'customer_id'       => auth()->user()->customer_id,
                        'mobile'            => optional(auth()->user()->customer)->mobile,
                        'amount'            => optional(auth()->user()->customer)->balance,
                        'request_status'    => 0,
                    ]);
                }
                else{

                    return response()->json([

                        'data'      => 'You have already send request',
                        'message'   => "Error",
                        'status'    => 0,
                    ]);
                }


            }
            else{

                return response()->json([

                    'data'      => 'Your balance is 0',
                    'message'   => "Error",
                    'status'    => 0,
                ]);
            }

        }
        catch (\Throwable $th){

            return response()->json([

                'data'      => $th->getMessage(),
                'message'   => "Server Error",
                'status'    => 0,
            ]);
        }

        return response()->json([

            'data'      => 'Request Send Successfully',
            'message'   => "Success",
            'status'    => 1,
        ]);

    }

}
