<?php
/**
 *  
 *  @author  Mike <m@9026.com>
 *  @version    1.0
 *  @date 2015年10月12日
 *
 */
namespace App\Http\Controllers\Client\Base;

use App\Http\Controllers\Admin\Controller;
use App\Models\AD;
use App\Models\Client;
use App\Models\Device;
use App\Models\Fan;
use App\Models\Tissue;
use App\Services\Base\Tree;
use App\Services\Base\BaseArea;
use App\Services\Admin\Menus;
use App\Services\Admin\Acl;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class IndexController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    function index() {
        return view('client.base.index.index');
    }
    function welcome(Request $request) {
        $devices = Device::where('client_id', Auth::guard('client')->user()->id)->get();
        $off_device_cnt = $devices->where('status', 0)->count();
        $online_device_cnt = $devices->where('status', 1)->count();
        $lack_device_cnt = $devices->where('status', 2)->count();
        $zero_device_cnt = $devices->where('tissue_num', 0)->count();
        $error_device_cnt = $devices->where('status', 3)->count();
        $devices_cnt = $devices->count();
        $ids = $devices->pluck('id');

        if(($request->has('begin_date') && $request->input('begin_date')) || ($request->has('end_date') && $request->input('end_date'))) {
            if(!$request->has('begin_date') || $request->input('begin_date') == null) {
                $begin_date = Carbon::createFromDate(2000, 1, 1)->toDateTimeString();
            } else {
                $begin_date = $request->input('begin_date');
                $begin_date = explode('-', $begin_date);
                $begin_date = Carbon::createFromDate($begin_date[0], $begin_date[1], $begin_date[2])->toDateTimeString();
            }
            if(!$request->has('end_date') || $request->input('end_date') == null) {
                $end_date = Carbon::tomorrow()->toDateTimeString();
            } else {
                $end_date = $request->input('end_date');
                $end_date = explode('-', $end_date);
                $end_date = Carbon::createFromDate($end_date[0], $end_date[1], $end_date[2])->toDateTimeString();
            }
        } else if($request->has('date') && $request->input('date')) {
            if($request->input('date') == 'three_day') {
                $begin_date = Carbon::now()->subDays(2)->toDateTimeString();
                $end_date = Carbon::tomorrow()->toDateTimeString();
            } else if($request->input('date') == 'seven_day') {
                $begin_date = Carbon::now()->subDays(6)->toDateTimeString();
                $end_date = Carbon::tomorrow()->toDateTimeString();
            } else if($request->input('date') == 'this_month') {
                $now = Carbon::now();
                $begin_date = Carbon::createFromDate($now->year, $now->month, 1)->toDateTimeString();
                $end_date = Carbon::tomorrow()->toDateTimeString();
            } else if($request->input('date') == 'last_month') {
                $last_month = Carbon::now()->subMonth();
                $begin_date = Carbon::createFromDate($last_month->year, $last_month->month, 1)->toDateTimeString();
                $now = Carbon::now();
                $begin_date = Carbon::createFromDate($now->year, $now->month, 1)->toDateTimeString();
            } else {
                $begin_date = Carbon::today()->toDateTimeString();
                $end_date = Carbon::tomorrow()->toDateTimeString();
            }
        } else {
            $begin_date = Carbon::today()->toDateTimeString();
            $end_date = Carbon::tomorrow()->toDateTimeString();
        }
        $tissues = Tissue::where([
            ['created_at', '>=', $begin_date],
            ['created_at', '<=', $end_date]
        ])->get()->filter(function ($value) use($ids) {
            if($ids->contains($value->id)) return true;
            return false;
        });
        $get_cnt = $tissues->where('status', 0)->count();
        $buy_cnt = $tissues->where('status', 1)->count();
        return view('client.base.index.welcome', compact('devices_cnt', 'off_device_cnt', 'online_device_cnt', 'lack_device_cnt', 'zero_device_cnt', 'error_device_cnt', 'get_cnt', 'buy_cnt'));
    }
    
    function createAreaDate(){
        //Base-index-createareadate.do
        header("Content-type:text/html;charset=utf-8");
        $areaObj = new BaseArea();
        $data = $areaObj->getLevel();

        $treeObj = new Tree();
        $treeObj -> init($data);
        $info = $treeObj -> getTree();
        $output = array();
        
        foreach($info AS $key => $val){
            if($val['id'] == '100000') continue;
            $val['level'] = $val['level'] - 1;
            unset($val['grade'], $val['spacer']);
            $output[]= $val;
        }
        
        $str = json_encode($output);
        
        $area_path = public_path() . '/base/js/areadata.js';
        file_put_contents($area_path, $str);
        
        echo $str;exit;
    }
}