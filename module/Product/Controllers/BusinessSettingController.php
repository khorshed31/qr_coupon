<?php

namespace Module\Product\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\FileSaver;
use Illuminate\Http\Request;
use Module\Product\Models\BusinessSetting;

class BusinessSettingController extends Controller
{


    use FileSaver;


    /*
     |--------------------------------------------------------------------------
     | CREATE METHOD
     |--------------------------------------------------------------------------
    */
    public function create()
    {

        return view('business-setting.create');
    }











    /*
         |--------------------------------------------------------------------------
         | UPDATE METHOD
         |--------------------------------------------------------------------------
        */
    public function store(Request $request)
    {
        try {

            $user = BusinessSetting::updateOrCreate([
                'user_id'    => 1,
            ], [
                'user_id'       => 1,
                'name'          => $request->name,
                'mobile'        => $request->mobile,
                'email'         => $request->email,
                'code'          => $request->code,
                'address'       => $request->address,
            ]);

            $this->upload_file($request->image, $user, 'logo', 'Logo');
            $this->upload_file($request->icon, $user, 'icon', 'Icon');

        } catch (\Throwable $th) {
            //dd($th->getMessage());
            redirectIfError($th, 1);
        }

        return redirect()->back()->withMessage('Setting update successfully !');
    }
}
