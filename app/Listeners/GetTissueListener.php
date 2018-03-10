<?php

namespace App\Listeners;

use App\Events\GetTissueEvent;
use App\Models\AD;
use App\Models\Device;
use App\Models\Fan;
use App\Models\Record;
use App\Models\Setting;
use App\Models\Tissue;
use App\Models\TissueRecord;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class GetTissueListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  GetTissueEvent  $event
     * @return void
     */
    public function handle(GetTissueEvent $event)
    {
        $message = $event->message;
        $openId = $message['FromUserName'];
        $fan = Fan::where('wechat_id', $openId)->first();
        if(!$fan) {
            Log::info('when get tissue, can find fan!');
            return;
        };
        $fan->num = $fan->num + 1;
        if(!$fan->save()) {
            Log::info('when get tissue, update fan error!');
            return;
        }
        $ad = AD::where('back_code', $message['Content'])->first();
        if(!$ad) {
            Log::info('when get tissue, can find ad!');
            return;
        }
        $ad->num = $ad->num + 1;
        $ad->day_num = $ad->day_num + 1;
        if(!$ad->save()) {
            Log::info('when get tissue, can update ad!');
            return;
        }
        $record = TissueRecord::where([
            'fan_id' => $fan->id,
            'ad_id' => $ad->id,
            'type' => 0,
            'status' => 0
        ])->first();
        if(!$record) {
            Log::info('when get tissue, not focus gongzhonghao or has get tissue!');
            return;
        }
        $record->status = 1;
        if(!$record->save()) {
//            Log::info('领取纸巾时，记录更新失败！');
            Log::info('when get tissue, update record error!');
            return;
        }
        $scan_record = Record::where('fan_id', $fan->id)->orderBy('id', 'desc')->first();
        if(!$scan_record) {
//            Log::info('领取纸巾时，找不到扫描记录！');
            Log::info('when get tissue, cant find scan record!');
            return;
        }
        $res = Tissue::create([
            'fan_id' => $fan->id,
            'device_id' => $scan_record->device_id,
            'ad_id' => $ad->id,
            'status' => 0,
            'num' => 1,
            'money' => 0,
            'info' => '关注了广告后领取纸巾'
        ]);
        if(!$res) {
            // Log::info('领取纸巾时，创建领取记录失败！');
            Log::info('when get tissue, create get record error');
            return;
        }
        $device = Device::find($scan_record->device_id);
        if(!$device) {
            Log::info('when get tissue, cant find device');
            return;
        }
        $num = $device->tissue_num - 1;
        $device->tissue_num = $num;
        $device->out = 'yes';
        $item = Setting::where('key', 'lack_tissue_low_limit')->first();
        if($item && $num <= $item->value) {
            $device->status = 2;
        } elseif(!$item && $num <= 10) {
            $device->status = 2;
        }

        if(!$device->save()) {
            Log::info('when get tissue, cant update device');
            return;
        }
    }
}
