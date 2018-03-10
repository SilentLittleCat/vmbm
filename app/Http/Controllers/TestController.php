<?php

namespace App\Http\Controllers;

use App\Models\AD;
use App\Models\Client;
use App\Models\Fan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Device;
use Log;

class TestController extends Controller
{
    public function index(Request $request)
    {
        $now = Carbon::today()->toDateTimeString();
        dd($now);

//        set_time_limit(3);
//
//        $host = "47.104.165.93";
//        $port = 66;
//        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)or die("Could not create  socket\n");
//        echo 'OK';
//        $connection = socket_connect($socket, $host, $port) or die("Could not connet server\n");
//        socket_write($socket, "imei=ABC-222&command=5") or die("Write failed\n");
//        echo 'OK';
//        $buff = socket_read($socket, 1024, PHP_BINARY_READ);
//        echo("Response was:" . $buff . "\n");
//        socket_close($socket);
//        dd(url('/'));
//        dd(time());
//        $data = Carbon::now()->toDateString();
//        dd($data);
           $app = app('wechat.official_account');
//        $openId = Fan::orderBy('id', 'desc')->first()->wechat_id;
//        $user = $app->user->get($openId);
//           dd($user);
//          $id = '演示PHP-MYSQL';
//          $item1 = urlencode($id);
//          $item2 = urldecode($item1);
//          dd($id, $item1, $item2);
//          dd($app->server->push());
//            $app->broadcasting->sendText("考研");
//          Log::info('rrrr');
//          return '考研';
        $buttons = [
            [
                "type" => "view",
                "name" => "纸妹子",
                "url"  => "http://www.zuoxianyouguo.com/web/index"
            ]
        ];
        $app->menu->delete(); // 全部
        $res = $app->menu->create($buttons);
        return $res;
//        $openId = 'oTIRp1f-L2Auc0hVQvywEh7lwU-s';
//        dd($res);
    }

    public function qrcode(Request $request)
    {
        $app = app('wechat.official_account');
        $result = $app->qrcode->forever('ABC-222');
        $url = $app->qrcode->url($result['ticket']);
//        $result = $app->qrcode->forever('abcde');
//        $ticket = Device::orderBy('id', 'desc')->first()->ticket;

        dd($result, $url);
    }

    public function error(Request $request)
    {
        $type = $request->has('type') ? $request->input('type') : 'success';
        $info = $request->has('info') ? $request->input('info') : '我是提示信息我是提示信息我是提示信息我是提示信息我是提示信息我是提示信息';
        return view('web.error', compact('type', 'info'));
    }

    public function time(Request $request)
    {
        dd(Carbon::now());
    }

    public function device(Request $request)
    {
        $device = Device::where('IMEI', 'abcde')->first();
        dd($device);
    }
}
