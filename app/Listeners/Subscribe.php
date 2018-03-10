<?php

namespace App\Listeners;

use App\Events\Subscribe as SubscribeEvent;
use App\Models\Device;
use App\Models\Fan;
use App\Models\Record;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class Subscribe
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
     * @param  Subscribe  $event
     * @return void
     */
    public function handle(SubscribeEvent $event)
    {
        $message = $event->message;
        $app = app('wechat.official_account');
        $openId = $message['FromUserName'];
        $user = $app->user->get($openId);
        if(isset($user['err_code'])) {
//            Log::info('粉丝关注时，找不到粉丝！');
            Log::info('when subscribe, cant find fan');
            return;
        };
        $fan = Fan::firstOrCreate(['wechat_id' => $openId], ['wechat_name' => $user['nickname'], 'status' => 1]);
        if(!$fan) {
//            Log::info('粉丝关注时，创建粉丝失败！');
            Log::info('when subscribe, create fan error');
            return;
        };
        $fan->status = 1;
        if(!$fan->saveOrFail()) {
            Log::info('when subscribe, update fan error');
            return;
        }
        $device = Device::where('ticket', $message['Ticket'])->first();
        if(!$device) {
//            Log::info('粉丝关注时，找不到设备！');
            Log::info('when subscribe, cant find device');
            return;
        }

        $record = Record::create(['fan_id' => $fan->id, 'device_id' => $device->id]);
        if(!$record) {
//            Log::info('粉丝关注时，创建记录失败！');
            Log::info('when subscribe, create record error');
            return;
        };
//        Log::info('粉丝关注成功！');
        Log::info('subscribe success！');
        return;
    }
}
