<?php

namespace App\Http\Controllers\Web;

use App\Models\AD;
use App\Models\ADFan;
use App\Models\Device;
use App\Models\Fan;
use App\Models\Record;
use App\Models\Setting;
use App\Models\TissueRecord;
use App\Models\Tissue;
use App\Models\WechatOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use EasyWeChat\Factory;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $user = session('wechat.oauth_user');
        $openId = $user['default']['id'];
//        $id = Record::orderBy('id', 'desc')->first()->fan_id;
        $user = Fan::where('wechat_id', $openId)->first();
        if(!$user) {
            $type = 'error';
            $info = '找不到用户！请关注公众号之后再操作！';
            return view('web.error', compact('type', 'info'));
        };
        $dateTime = Carbon::now()->subMinutes(20)->toDateTimeString();
        $record = Record::where([
            ['fan_id', $user->id],
            ['created_at', '>', $dateTime]
        ])->orderBy('id', 'desc')->first();
        if(!$record || !$record->device_id) {
            $type = 'error';
            $info = '扫描设备以后再操作！';
            return view('web.error', compact('type', 'info'));
        };
        $device = Device::find($record->device_id);
        if($device->auth_status != 1) {
            $type = 'error';
            $info = '设备审核不通过！';
            return view('web.error', compact('type', 'info'));
        }
        if($device->tissue_num <= 0) {
            $type = 'error';
            $info = '设备无纸巾，请等待添加纸巾后再操作！';
            return view('web.error', compact('type', 'info'));
        }
        $price = Setting::where('key', 'tissue_price')->first();
        $price = $price ? round($price->value * 100) : '1';
        $wechat_order = WechatOrder::create([
            'fan_id' => $record->fan_id,
            'device_id' => $record->device_id,
            'status' => 0,
            'total_fee' => $price
        ]);
        if(!$wechat_order) {
            $type = 'error';
            $info = '订单创建失败！';
            return view('web.error', compact('type', 'info'));
        }
        $app = app('wechat.payment');
//        $id = Record::orderBy('id', 'desc')->first()->fan_id;
//        $user = Fan::where('id', $id)->first();
//        $openId = $user->wechat_id;
        $result = $app->order->unify([
            'body' => '纸妹子纸巾购买',
            'out_trade_no' => sprintf("%011d", $wechat_order->id),
            'total_fee' => $price,
            'notify_url' => 'http://zuoxianyouguo.com/wechat/pay-notify', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            'trade_type' => 'JSAPI',
            'openid' => $openId,
        ]);
        if ($result['return_code'] == 'SUCCESS' && $result['result_code'] == 'SUCCESS'){
            $prepayId = $result['prepay_id'];
            $config = [
                // 前面的appid什么的也得保留哦
                'app_id'             => $result['appid'],
                'mch_id'             => $result['mch_id'],
                'key'                => env('WECHAT_PAYMENT_KEY', 'key-for-signature'),
                'notify_url'         => 'http://zuoxianyouguo.com/wechat/pay-notify',     // 你也可以在下单时单独设置来想覆盖它
                // 'device_info'     => '013467007045764',
                // 'sub_app_id'      => '',
                // 'sub_merchant_id' => '',
                // ...
            ];

            $payment = Factory::payment($config);
            $jssdk = $payment->jssdk;
            $json = $jssdk->bridgeConfig($prepayId);
        } else {
            $type = 'error';
            $info = '网页出错！';
            return view('web.error', compact('type', 'info'));
        }
        $buy_get_logo = Setting::where('key', 'buy_get_logo')->first();
        $buy_get_logo = $buy_get_logo ? $buy_get_logo->value : '/base/img/meizi.jpeg';
        return view('web.index.index', compact('json', 'buy_get_logo'));
    }

    public function get(Request $request)
    {
//        $ad = AD::first();
//        if(!$ad) return '领取失败！';
        $app = app('wechat.official_account');
        $user = session('wechat.oauth_user');
        $openId = $user['default']['id'];
//        $id = Record::orderBy('id', 'desc')->first()->fan_id;
        $user = Fan::where('wechat_id', $openId)->first();
        if(!$user) {
            $type = 'error';
            $info = '找不到用户！请关注公众号之后再操作！';
            return view('web.error', compact('type', 'info'));
        };

        $dateTime = Carbon::now()->subMinutes(20)->toDateTimeString();
        $record = Record::where([
            ['fan_id', $user->id],
            ['created_at', '>', $dateTime]
        ])->orderBy('id', 'desc')->first();
        if(!$record || !$record->device_id) {
            $type = 'error';
            $info = '扫描设备以后再操作！';
            return view('web.error', compact('type', 'info'));
        };
        $device = Device::find($record->device_id);
        if(!$device || !$device->client) {
            $type = 'error';
            $info = '找不到设备或设备暂不能领取！';
            return view('web.error', compact('type', 'info'));
        };
        $ads = $device->client->ads;
        if($ads->count() == 0) {
            $type = 'error';
            $info = '设备暂不能领取！';
            return view('web.error', compact('type', 'info'));
        };

        $ad = $ads->filter(function ($item) use($user) {
//            if($item->status == 0) return false;
            if($item->num > $item->limit) return false;
            if($item->day_num > $item->day_limit) return false;
            $now = Carbon::now()->toDateString();
            if($item->begin_date > $now || $item->end_date < $now) return false;
            $res = TissueRecord::where([
                'ad_id' => $item->id,
                'fan_id' => $user->id,
                'status' => 1
            ])->first();
            if($res) return false;
            return true;
        })->sortBy('day_num')->first();

        if(!$ad) {
            $type = 'error';
            $info = '暂不符合领取条件！';
            return view('web.error', compact('type', 'info'));
        };

        $res = TissueRecord::create([
            'ad_id' => $ad->id,
            'fan_id' => $user->id,
            'type' => 0,
            'status' => 0
        ]);
        if(!$res) {
            $type = 'error';
            $info = '领取失败！';
            return view('web.error', compact('type', 'info'));
        };
        return view('web.index.get', compact('ad', 'user'));
    }

    public function getAuth(Request $request)
    {
        $user = session('wechat.oauth_user');
        $openId = $user['default']['id'];
//        $id = Record::orderBy('id', 'desc')->first()->fan_id;
        $fan = Fan::where('wechat_id', $openId)->first();
        if(!$fan) return view('web.error', ['type' => 'error', 'info' => '找不到用户！']);
        $fan->num = $fan->num + 1;
        if(!$fan->save()) return view('web.error', ['type' => 'error', 'info' => '服务器错误！']);
        if(!$request->has('back_code')) return view('web.error', ['type' => 'error', 'info' => '领取失败！']);
        $ad = AD::where('back_code', $request->input('back_code'))->first();
        if(!$ad) return view('web.error', ['type' => 'error', 'info' => '领取失败！']);
        $ad->num = $ad->num + 1;
        $ad->day_num = $ad->day_num + 1;
        if(!$ad->save()) return view('web.error', ['type' => 'error', 'info' => '服务器错误！']);
        $record = TissueRecord::where([
            'fan_id' => $fan->id,
            'ad_id' => $ad->id,
            'type' => 0,
            'status' => 0
        ])->first();
        if(!$record) return view('web.error', ['type' => 'error', 'info' => '可能未扫码或者已经领取过！']);
        $record->status = 1;
        if(!$record->save()) return view('web.error', ['type' => 'error', 'info' => '服务器错误！']);
        $scan_record = Record::where('fan_id', $fan->id)->orderBy('id', 'desc')->first();
        if(!$scan_record) return view('web.error', ['type' => 'error', 'info' => '可能未扫码！']);
        $res = Tissue::create([
            'fan_id' => $fan->id,
            'device_id' => $scan_record->device_id,
            'ad_id' => $ad->id,
            'status' => 0,
            'num' => 1,
            'money' => 0,
            'info' => '关注了广告后领取纸巾'
        ]);
        ADFan::create([
            'fan_id' => $fan->id,
            'ad_id' => $ad->id
        ]);
        if(!$res) return view('web.error', ['type' => 'error', 'info' => '服务器错误！']);
        $device = Device::find($scan_record->device_id);
        if(!$device) return view('web.error', ['type' => 'error', 'info' => '服务器错误！']);
        $num = $device->tissue_num - 1;
        $device->tissue_num = $num;
        $device->out = 'yes';
        $item = Setting::where('key', 'lack_tissue_low_limit')->first();
        if($item && $num <= $item->value) {
            $device->status = 2;
        } elseif(!$item && $num <= 10) {
            $device->status = 2;
        }

        if(!$device->save()) return view('web.error', ['type' => 'error', 'info' => '服务器错误！']);
        return view('web.error', ['type' => 'success', 'info' => '领取成功，等待出纸！']);
    }

    public function buy(Request $request)
    {
        $app = app('wechat.payment');
        $user = session('wechat.oauth_user');
//        Log::info($user);
        $openId = $user['default']['id'];
//        $id = Record::orderBy('id', 'desc')->first()->fan_id;
//        $user = Fan::where('id', $id)->first();
//        $openId = $user->wechat_id;
        $result = $app->order->unify([
            'body' => '纸妹子纸巾购买',
            'out_trade_no' => time(),
            'total_fee' => 1,
            'notify_url' => 'http://zuoxianyouguo.com/wechat/pay-notify', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            'trade_type' => 'JSAPI',
            'openid' => $openId,
        ]);
        if ($result['return_code'] == 'SUCCESS' && $result['result_code'] == 'SUCCESS'){
            $prepayId = $result['prepay_id'];
            $config = [
                // 前面的appid什么的也得保留哦
                'app_id'             => $result['appid'],
                'mch_id'             => $result['mch_id'],
                'key'                => env('WECHAT_PAYMENT_KEY', 'key-for-signature'),
                'notify_url'         => 'http://zuoxianyouguo.com/wechat/pay-notify',     // 你也可以在下单时单独设置来想覆盖它
                // 'device_info'     => '013467007045764',
                // 'sub_app_id'      => '',
                // 'sub_merchant_id' => '',
                // ...
            ];

            $payment = Factory::payment($config);
            $jssdk = $payment->jssdk;
            $json = $jssdk->bridgeConfig($prepayId);
        } else {
            return '支付失败';
        }
        return view('web.index.buy', compact('json'));
    }

    public function payResult(Request $request)
    {
        if($request->has('status') && $request->input('status') == 'success') {
            $result = 'success';
        } else {
            $result = 'fail';
        }
        return view('web.index.payResult', compact('result'));
    }
}
