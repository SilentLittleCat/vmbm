<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $table = 'devices';

    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function tissue()
    {
        return $this->hasMany('App\Models\Tissue', 'device_id');
    }

    public function getWarnInfo($id)
    {
        $device = $this->find($id);
        if(!$device) $info = '找不到设备';
        if($device->status == 2) {
            $lack_info = Setting::where('key', 'lack_info')->first();
            $info = $lack_info ? $lack_info->value : '未设置';
        } else if($device->status == 3) {
            $error_info = Setting::where('key', 'error_info')->first();
            $info = $error_info ? $error_info->value : '未设置';
        } else if($device->tissue_num == 0) {
            $zero_info = Setting::where('key', 'zero_info')->first();
            $info = $zero_info ? $zero_info->value : '未设置';
        } else {
            $info = '无';
        }
        return $info;
    }
}
