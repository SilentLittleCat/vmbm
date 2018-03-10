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
        return view('admin.setting.index', compact('tissue_price', 'lack_tissue_low_limit'));
    }

    public function edit(Request $request)
    {
        $tissue_price = Setting::where('key', 'tissue_price')->first();
        $lack_tissue_low_limit = Setting::where('key', 'lack_tissue_low_limit')->first();
        return view('admin.setting.edit', compact('tissue_price', 'lack_tissue_low_limit'));
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
