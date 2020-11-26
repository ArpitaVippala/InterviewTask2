<?php

namespace App\Http\Controllers\Auth;

use App\UsersModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator($data)
    {
        return Validator::make($data, [
            'uname' => ['required', 'string', 'alpha', 'max:255'],
            'emailId' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'pwd' => ['string', 'min:8'],
            'mobile'=>['required', 'numeric', 'digits:10'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $req)
    {
        // print_r($req->all());die();
        $res = $this->validator($req->all());
        // dd($res->errors());
        if($res->fails()){
            // return redirect()->back()->with('errors', $res->errors());
            return Redirect::back()->withErrors($res);
        }
        else{       
            UsersModel::create([
                'username' => $req->uname,
                'emailId' => $req->emailId,
                'pwd' => $req->pwd,
                'mobile'=>$req->mobile,
                'role'=>$req->role,
                'created_at'=>date('Y-m-d H:i:s')
            ]);
            return redirect()->route('Login');
        }
    }
}
