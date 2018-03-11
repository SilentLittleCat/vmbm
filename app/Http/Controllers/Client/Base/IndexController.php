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
use Dingo\Api\Auth\Auth;

class IndexController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    function index() {
        return view('client.base.index.index');
    }
    function welcome() {
        $devices = Device::where('client_id', Auth::guard('client')->user()->id)->get();
        $off_device_cnt = $devices->where('status', 0)->count();
        $online_device_cnt = $devices->where('status', 1)->count();
        $lack_device_cnt = $devices->where('status', 2)->count();
        $zero_device_cnt = $devices->where('tissue_num', 0)->count();
        $error_device_cnt = $devices->where('status', 3)->count();
        $devices_cnt = $devices->count();
        $clients_cnt = Client::all()->count();
        $fans_cnt = Fan::all()->count();
        $ads = AD::all();
        $ad_get_cnt = Tissue::where('status', 0)->get()->count();
        $ad_up_cnt = $ads->where('status', 1)->count();
        $ad_down_cnt = $ads->where('status', 0)->count();
        $ads_cnt = $ads->count();
        $tissues = Tissue::all();
        $tissue_get_cnt = $ad_get_cnt;
        $tissues_cnt = $tissues->count();
        $tissue_buy_cnt = $tissues_cnt - $tissue_get_cnt;
        return view('client.base.index.welcome', compact('devices_cnt', 'off_device_cnt', 'online_device_cnt', 'lack_device_cnt', 'zero_device_cnt', 'error_device_cnt', 'clients_cnt', 'fans_cnt', 'ads_cnt', 'ad_get_cnt', 'ad_up_cnt', 'ad_down_cnt', 'tissues_cnt', 'tissue_get_cnt', 'tissue_buy_cnt'));
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