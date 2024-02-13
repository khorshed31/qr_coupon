<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email'     => 'required',
            'password'  => 'required',
        ]);
    }

    public function signin(Request $request)
    {


        $userInfo = User::where('email', $request->email)->where('type','!=','customer')->first();

        if(!$userInfo){
            return back()->withMessage('We do not recognize your email address');
        }else{

            //check password
            if(Hash::check($request->password, $userInfo->password)){

                $code = rand(0000,9999);
                $userInfo->update([
                    'code'      =>  $code
                ]);

                \Mail::to($userInfo->email)->send(new \App\Mail\LoginMail($userInfo));

                return view('auth.email-varify-code',compact('userInfo'));

            }else{
                return back()->withMessage('Incorrect password');
            }
        }
    }



    public function verify(Request $request)
    {

        $userInfo = User::where('id',$request->id)->where('code', $request->code)->where('type','!=','customer')->first();
//        dd($userInfo);
        if(!$userInfo){

            return 'Invalid Code';
        }else{

            Auth::login($userInfo);

            return redirect()->route('home');
        }
    }


}
