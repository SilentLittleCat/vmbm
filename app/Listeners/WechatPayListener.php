<?php

namespace App\Listeners;

use App\Events\WechatPayEvent;
use App\Models\Fan;
use App\Models\Tissue;
use App\Models\Setting;
use App\Models\Device;
use App\Models\WechatOrder;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log;

class WechatPayListener
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
     * @param  WechatPayEvent  $event
     * @return void
     */
    public function handle(WechatPayEvent $event)
    {
        $message = $event->message;
        $wechat_order = WechatOrder::find($message['out_trade_no']);
        if(!$wechat_order) {
            Log::info('when handle pay, cant find order');
            return;
        }
        $status = ($message['result_code'] === 'SUCCESS') ? 1 : 2;
        $wechat_order->status = $status;
        if(!$wechat_order) {
            Log::info('when handle pay, update order error');
            return;
        }
        $fan = Fan::find($wechat_order->fan_id);
        if(!$fan) {
            Log::info('when handle pay, can find fan');
            return;
        }
        $fan->num = $fan->num + 1;
        $fan->buy_num = $fan->buy_num + 1;
        if(!$fan->save()) {
            Log::info('when handle pay, can update fan');
            return;
        }
        $tissue = Tissue::create([
            'fan_id' => $wechat_order->fan_id,
            'device_id' => $wechat_order->device_id,
            'status' => 1,
            'num' => 1,
            'money' => $message['total_fee']
        ]);
        if(!$tissue) {
            Log::info('when handle pay, create tissue error');
            return;
        }
        $device = Device::find($wechat_order->device_id);
        if(!$device) {
            Log::info('when handle pay, cant find device');
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
            Log::info('when handle pay, cant update device');
            return;
        }
    }
}
