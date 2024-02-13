<?php

namespace Module\Product\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\FileSaver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Module\Product\Imports\CustomerUploadCSV;
use Module\Product\Models\Customer;
use Module\Product\Models\ReferralEmployee;
use Module\Product\Services\CustomerService;

class CustomerController extends Controller
{






    use FileSaver;

    private $service;


    /*
     |--------------------------------------------------------------------------
     | CONSTRUCTOR
     |--------------------------------------------------------------------------
    */
    public function __construct(CustomerService $customerService)
    {
        $this->service = $customerService;
    }



    /*
     |--------------------------------------------------------------------------
     | INDEX METHOD
     |--------------------------------------------------------------------------
    */
    public function index()
    {

        $data['customers'] = Customer::query()->latest()
            ->with('refer_employee')
            ->searchByField('name')->paginate(25);

        return view('customers.index',$data);
    }










    /*
     |--------------------------------------------------------------------------
     | CREATE METHOD
     |--------------------------------------------------------------------------
    */
    public function create()
    {

        $data['employees'] = ReferralEmployee::query()->get();
        return view('customers.create', $data);
    }







    /*
     |--------------------------------------------------------------------------
     | EDIT METHOD
     |--------------------------------------------------------------------------
    */
    public function edit($id)
    {

        $data['customer'] = Customer::find($id);
        $data['employees'] = ReferralEmployee::query()->get();

        return view('customers.edit', $data);
    }






    /*
     |--------------------------------------------------------------------------
     | STORE METHOD
     |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {

        try {
            if ($request->store_type == 'upload') {

                if(!$request->csv_file){
                    return redirect()->back()->withError('Please upload csv file!');
                }

                Excel::import(new CustomerUploadCSV(), $request->file('csv_file'));

            } else {

                $this->service->storeOrUpdate($request);
            }
        } catch (\Throwable $th) {
            redirectIfError($th, 1);
        }
        return redirect()->route('product.customers.index')->withMessage('Customer added successfully !');
    }






    /*
     |--------------------------------------------------------------------------
     | UPDATE METHOD
     |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {

        try {
            $this->service->storeOrUpdate($request, $id);
        } catch (\Throwable $th) {
            redirectIfError($th, 1);
        }
        return redirect()->route('product.customers.index')->withMessage('Customer update successfully !');
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

                $customer = Customer::find($id);
                $user = User::where('customer_id',$customer->id)->first();
                //dd($customer);
                if (file_exists($customer->image)) {
                    unlink($customer->image);
                }
                $user->delete();
                $customer->delete();
            });
        } catch (\Throwable $th) {
            return redirect()->back()->withError($th->getMessage());
        }

        return redirect()->route('product.customers.index')->withMessage('Customer delete successfully !');
    }




}
