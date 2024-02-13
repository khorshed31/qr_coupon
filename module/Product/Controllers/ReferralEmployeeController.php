<?php

namespace Module\Product\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Module\Product\Models\ReferralEmployee;

class ReferralEmployeeController extends Controller
{






    /*
     |--------------------------------------------------------------------------
     | INDEX METHOD
     |--------------------------------------------------------------------------
    */
    public function index()
    {

        $data['employees']   = ReferralEmployee::likeSearch('name')->with('customer')->latest()->paginate(25);

        return view('referral_employee.index', $data);
    }













    /*
     |--------------------------------------------------------------------------
     | CREATE METHOD
     |--------------------------------------------------------------------------
    */
    public function create()
    {

        return view('referral_employee.create');
    }









    /*
     |--------------------------------------------------------------------------
     | STORE METHOD
     |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        try {

            $this->storeOrUpdate($request);

        } catch (\Throwable $th) {
            //dd($th->getMessage());
            redirectIfError($th, 1);
        }

        return redirect()->route('product.referral_employees.index')->withMessage('Added successfully !');
    }












    /*
     |--------------------------------------------------------------------------
     | EDIT METHOD
     |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $data['employee'] = ReferralEmployee::query()->find($id);

        return view('referral_employee.edit', $data);
    }








    /*
     |--------------------------------------------------------------------------
     | UPDATE METHOD
     |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        try {

            $this->storeOrUpdate($request, $id);

        } catch (\Throwable $th) {
            //dd($th->getMessage());
            redirectIfError($th, 1);
        }

        return redirect()->route('product.referral_employees.index')->withMessage('Update successfully !');
    }








    /*
         |--------------------------------------------------------------------------
         | DELETE/DESTORY METHOD
         |--------------------------------------------------------------------------
        */
    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {

                $employee = ReferralEmployee::find($id);
                $employee->delete();

            });
        } catch (\Throwable $th) {
            return redirect()->back()->withError('This Employee is use another table');
        }

        return redirect()->route('product.referral_employees.index')->withMessage('Delete successfully !');
    }






    /*
     |--------------------------------------------------------------------------
     | STORE/UPDATE METHOD
     |--------------------------------------------------------------------------
    */

    public function storeOrUpdate($request, $id = null){

        ReferralEmployee::updateOrCreate(
            [
                'id'        => $id
            ],
            [
                'name'      => $request->name,
                'mobile'    => $request->mobile,
                'code'      => $request->code,
            ]);

    }






}
