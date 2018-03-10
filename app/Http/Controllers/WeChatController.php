<?php

namespace App\Http\Controllers;

use App\Events\GetTissueEvent;
use App\Events\Scan;
use App\Events\Subscribe;
use App\Events\Unsubscribe;
use App\Events\WechatPayEvent;
use App\Models\Fan;
use Illuminate\Http\Request;
use Log;

class WeChatController extends Controller
{
    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
        $app = app('wechat.official_account');
        $app->server->push(function($message) {
            Log::info($message);
            $info = '欢迎关注纸妹子';
            switch ($message['MsgType'])
            {
                case 'event':
                    Log::info('begin');
                    if($message['Event'] == 'subscribe') {
                        event(new Subscribe($message));
                        $info = '欢迎关注纸妹子';
                    } elseif($message['Event'] == 'unsubscribe') {
                        event(new Unsubscribe($message));
                    } elseif($message['Event'] == 'SCAN') {
                        event(new Scan($message));
                        $info = '已扫描设备！';
                    }
                    Log::info('end');
                    break;
                case 'text':
                    if(strpos($message['Content'], 'zhimeizi') === 0) {
                        event(new GetTissueEvent($message));
                        $info = '收到验证码，耐心等待出纸';
                    }
                    break;
                default:
                    break;
            }
            return $info;
        });

//        Log::info('return response.');
        return $app->server->serve();
    }

    public function payNotify(Request $request)
    {
        $app = app('wechat.payment');

        $response = $app->handlePaidNotify(function ($message, $fail) {
            if($message['return_code'] === 'SUCCESS') {
                event(new WechatPayEvent($message));
            } else {
                return $fail('通信失败，请稍后再通知我');
            }
            return true;
        });

        return $response;
    }
}
