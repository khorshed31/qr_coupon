<?php

namespace Module\Product\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\FileSaver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{


    use FileSaver;

    private $service;


    /*
     |--------------------------------------------------------------------------
     | CONSTRUCTOR
     |--------------------------------------------------------------------------
    */
    public function __construct()
    {
    }












    /*
     |--------------------------------------------------------------------------
     | INDEX METHOD
     |--------------------------------------------------------------------------
    */
    public function index()
    {
        $data['users'] = User::latest()->searchByField('name')->where('type','user')->paginate(25);
        return view('users.index', $data);
    }













    /*
     |--------------------------------------------------------------------------
     | CREATE METHOD
     |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('users.create');
    }













    /*
     |--------------------------------------------------------------------------
     | STORE METHOD
     |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        try {
            $user = $this->storeOrUpdate($request);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput($request->all())->withError($th->getMessage());
        }

        return redirect()->route('product.users.index')->withMessage('User added success !');
    }













    /*
     |--------------------------------------------------------------------------
     | SHOW METHOD
     |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        # code...
    }













    /*
     |--------------------------------------------------------------------------
     | EDIT METHOD
     |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $data['user'] = User::find($id);
        return view('users.edit', $data);
    }













    /*
     |--------------------------------------------------------------------------
     | UPDATE METHOD
     |--------------------------------------------------------------------------
    */
    public function update($id, Request $request)
    {
        try {
            $this->storeOrUpdate($request, $id);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput($request->all())->withError($th->getMessage());
        }

        return redirect()->route('product.users.index')->withMessage('User update success !');
    }












    /*
     |--------------------------------------------------------------------------
     | DELETE/DESTORY METHOD
     |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        try {
            $user = User::find($id);

            $user->delete();
            if (file_exists($user->image)) {
                unlink($user->image);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withError($th->getMessage());
        }

        return redirect()->route('product.users.index')->withMessage('User Delete success !');
    }






    /*
     |--------------------------------------------------------------------------
     | STORE/UPDATE METHOD
     |--------------------------------------------------------------------------
    */
    private function storeOrUpdate($request, $id = null)
    {

        $data = $request->validate([
            'name'          => 'required',
            'mobile'        => 'required',
            'email'         => 'required',
        ]);

        $data['password']    = Hash::make($request->password);
        $data['type']        = 'user';

        $user = User::updateOrCreate([
            'id'    => $id
        ], $data);

        $this->upload_file($request->image, $user, 'image', 'users');
    }







    /*
     |--------------------------------------------------------------------------
     | VALIDATE METHOD
     |--------------------------------------------------------------------------
    */
    private function validated($request, $id = null)
    {
        $request->validate([
            'name'          => 'required',
            'mobile'        => 'required',
            'pin'           => 'required|digits:4',
            'designation'   => 'nullable',
        ]);
    }








}
