<?php

namespace Module\Product\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\FileSaver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Module\Product\Models\Customer;

class CustomerController extends Controller
{



    use FileSaver;

    private $customer;

    /*
    |--------------------------------------------------------------------------
    | STORE METHOD
    |--------------------------------------------------------------------------
    */
    public function index(){

        return response()->json([

            'data'      => Customer::authCustomer()->first(),
            'message'   => "Success",
            'status'    => 1,
        ]);
    }







    /*
    |--------------------------------------------------------------------------
    | STORE METHOD
    |--------------------------------------------------------------------------
    */
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'name'          => 'required',
            'mobile'        => 'required',
            'password'      => 'required',
        ]);
        if ($validator->fails()) {

            return response()->json([

                'data'      => $validator->errors()->first(),
                'message'   => "Validation Error",
                'status'    => 0,
            ]);
        }

        try {

            DB::transaction(function () use ($request){

                $this->customer = Customer::create([

                        'name'      => $request->name,
                        'mobile'    => $request->mobile,
                    ]);

                $this->upload_file($request->image, $this->customer, 'image', 'customers');

                User::create([
                        'name'          => $request->name,
                        'mobile'        => $request->mobile,
                        'password'      => Hash::make($request->password),
                        'customer_id'   => $this->customer->id,
                        'type'          => 'customer',
                    ]);

            });

            return response()->json([

                'data'      => $this->customer,
                'message'   => "Register Success",
                'status'    => 1,
            ]);
        }
        catch (\Throwable $th){

            return response()->json([

                'data'      => $th->getMessage(),
                'message'   => "Server Error",
                'status'    => 0,
            ]);
        }




    }









    /*
    |--------------------------------------------------------------------------
    | STORE METHOD
    |--------------------------------------------------------------------------
    */
    public function update(Request $request)
    {


        try {

            DB::transaction(function () use ($request){

                $customer = Customer::authCustomer()->first();
                $customer->update([

                    'name'      => $request->name,
                    'mobile'    => $request->mobile,

                ]);

                $this->upload_file($request->image, $customer, 'image', 'customers');

                $user = User::find(auth()->id());
                 $user->update(
                    [
                    'name'          => $request->name,
                    'mobile'        => $request->mobile,
                ]);

            });
        }
        catch (\Throwable $th){

            return response()->json([

                'data'      => $th->getMessage(),
                'message'   => "Server Error",
                'status'    => 0,
            ]);
        }

        return response()->json([

            'message'   => "Update Success",
            'status'    => 1,
        ]);


    }







    public function change_password(Request $request){

        $user = User::find(auth()->id());


        if (Hash::check($request->old_password, $user->password)){

            if ($request->new_password == $request->confirm_password){

                User::updateOrCreate(['id'    => auth()->id()], ['password' =>  Hash::make($request->new_password)]);

            }
            else{
                return response()->json([

                    'message'   => "New password & confirm password are different !",
                    'status'    => 0,
                ]);
            }
        }
        else{
            return response()->json([

                'message'   => "Old password dont Matched !",
                'status'    => 0,
            ]);

        }
        return response()->json([

            'message'   => "Password update success !",
            'status'    => 1,
        ]);

    }








}
