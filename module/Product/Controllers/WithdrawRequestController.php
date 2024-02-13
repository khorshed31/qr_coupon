<?php

namespace Module\Product\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Module\Product\Models\Withdraw;

class WithdrawRequestController extends Controller
{





    /*
     |--------------------------------------------------------------------------
     | INDEX METHOD
     |--------------------------------------------------------------------------
    */
    public function index()
    {

        $data['withdraws']   = Withdraw::searchFromRelation('customer','name')
                                ->searchByField('request_status')
                                ->with('customer')->latest()->paginate(25);

        return view('withdraw-request.index', $data);
    }







    /*
     |--------------------------------------------------------------------------
     | EDIT METHOD
     |--------------------------------------------------------------------------
    */
    public function edit($id)
    {

        $withdraw = Withdraw::find($id);
        if ($withdraw->request_status == 0){

            $withdraw->update([
                'request_status'    => 1,
            ]);
        }else{
            return redirect()->back()->withError('Already Approved');
        }

        return redirect()->back()->withMessage('Approved Success!');
    }




}
