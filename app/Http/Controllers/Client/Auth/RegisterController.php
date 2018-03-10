<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Admin\Controller;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Auth;

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
    protected $redirectTo = '/home';

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
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'phone' => 'required|max:255|unique:clients|digits:11',
            'password' => 'required|min:6|confirmed',
        ], [
            'name.required' => '姓名必填',
            'phone.required' => '手机号必填',
            'phone.unique' => '手机号已注册',
            'phone.digits' => '手机号为11位',
            'password.required' => '密码必填',
            'password.min' => '密码最少6位',
            'password.confirmed' => '两次填写的密码不一致',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return Client::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function showRegistrationForm()
    {
        return view('client.auth.register');
    }

    protected function guard()
    {
        return Auth::guard('client');
    }
}
