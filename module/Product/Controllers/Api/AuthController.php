<?php

namespace Module\Product\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{



    /*
         |--------------------------------------------------------------------------
         | LOGIN
         |--------------------------------------------------------------------------
        */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'mobile'        =>  'required',
        ]);

        if ($validator->fails()) {

            return response()->json([

                'data'      => $validator->errors()->first(),
                'message'   => "Validation Error",
                'status'    => 0,
            ]);
        }



        // check phone
        $user = User::where('mobile', $request->mobile)->with('customer.latestWithdraw')
            ->where('type', 'customer')->first();

        // check user is exist or not
        if (!$user) {
            return response()->json([

                'data'      => "Mobile Number Not Found",
                'message'   => "Error",
                'status'    => 0,
            ]);
        }else{

            Auth::login($user);
            // create bearer token for authentication
            $data['token'] = $user->createToken('myapptoken')->plainTextToken;
            $data['user'] = auth()->user();


            return response()->json([

                'data'      => $data,
                'message'   => "Success",
                'status'    => 1,
            ]);

        }

    }



    public function checkCustomer(Request $request){

        $user = User::where('mobile', $request->mobile)->with('customer')->where('type', 'customer')->first();

        if ($user){

            return response()->json([

                'message'   => "Success",
                'status'    => 1,
            ]);
        }

        else {

            return response()->json([

                'data'      => 'No Customer Found',
                'message'   => "Error",
                'status'    => 0,
            ]);
        }
    }


}
