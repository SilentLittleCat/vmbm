<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $tissue_price = Setting::where('key', 'tissue_price')->first();
        $lack_tissue_low_limit = Setting::where('key', 'lack_tissue_low_limit')->first();
        $lack_info = Setting::where('key', 'lack_info')->first();
        $zero_info = Setting::where('key', 'zero_info')->first();
        $error_info = Setting::where('key', 'error_info')->first();
        $buy_get_logo = Setting::where('key', 'buy_get_logo')->first();
        $buy_get_logo = $buy_get_logo ? $buy_get_logo->value : '/base/img/meizi.jpeg';
        return view('admin.setting.index', compact('tissue_price', 'lack_tissue_low_limit', 'lack_info', 'zero_info', 'error_info', 'buy_get_logo'));
    }

    public function edit(Request $request)
    {
        $tissue_price = Setting::where('key', 'tissue_price')->first();
        $lack_tissue_low_limit = Setting::where('key', 'lack_tissue_low_limit')->first();
        $lack_info = Setting::where('key', 'lack_info')->first();
        $zero_info = Setting::where('key', 'zero_info')->first();
        $error_info = Setting::where('key', 'error_info')->first();
        return view('admin.setting.edit', compact('tissue_price', 'lack_tissue_low_limit', 'lack_info', 'zero_info', 'error_info'));
    }

    public function update(Request $request)
    {
        if($request->method() != 'POST') return back();
        foreach($request->all() as $key => $value) {
            Setting::updateOrCreate([
                'key' => $key
            ], [
                'value' => $value
            ]);
        }
        return redirect('/admin/Setting/index');
    }
}
