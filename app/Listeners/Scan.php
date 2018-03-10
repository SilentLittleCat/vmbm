<?php

namespace App\Listeners;

use App\Events\Scan as ScanEvent;
use App\Models\Device;
use App\Models\Fan;
use App\Models\Record;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use EasyWeChat\Kernel\Messages\Text;

class Scan
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
     * @param  Scan  $event
     * @return void
     */
    public function handle(ScanEvent $event)
    {
        $app = app('wechat.official_account');

        $message = $event->message;
        $openId = $message['FromUserName'];
        $user = $app->user->get($openId);
        if(isset($user['err_code'])) {
//            Log::info('粉丝关注时，找不到粉丝！');
            Log::info('when scan, cant find fan');

            return;
        };
        $fan = Fan::firstOrCreate(['wechat_id' => $openId], ['wechat_name' => $user['nickname'], 'status' => 1]);
        if(!$fan) {
//            Log::info('粉丝关注时，创建粉丝失败！');
            Log::info('when scan, create fan error');
            $message = new Text('用户创建失败！');
            $result = $app->customer_service->message($message)->to($openId)->send();
            return;
        };
        $fan->status = 1;
        if(!$fan->saveOrFail()) {
            Log::info('when scan, update fan error');
            return;
        }

        $device = Device::where('ticket', $message['Ticket'])->first();
        if(!$device) {
            Log::info('when scan, cant find device!');
//            Log::info('粉丝扫码时，找不到设备！');
            $message = new Text('您扫描的设备不存在或者未注册！');
            $result = $app->customer_service->message($message)->to($openId)->send();
            return;
        }

        $record = Record::create(['fan_id' => $fan->id, 'device_id' => $device->id]);
        if(!$record) {
            Log::info('when scan, create record error!');
//            Log::info('粉丝扫码时，创建记录失败！');
            return;
        };
        Log::info('scan success');
//        Log::info('粉丝扫码成功！');
        return;
    }
}
