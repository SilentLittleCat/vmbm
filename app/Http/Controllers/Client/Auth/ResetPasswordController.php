<?php

namespace App\Http\Controllers\Client\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;

class ResetPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function showChangeForm()
    {
        return view('client.auth.change');
    }

    public function changePassword(Request $request)
    {
        if(!$request->has('password')) return back();
        $user = Auth::guard('client')->user();
        $user->password = bcrypt($request->input('password'));
        if($user->save()) {
            return view('client.auth.change', ['sg_status' => 'success', 'sg_info' => '操作成功']);
        } else {
            return view('client.auth.change', ['sg_status' => 'fail', 'sg_info' => '操作失败']);
        }
    }
}
