<?php

namespace App\Http\Controllers\Admin;

use App\Models\AD;
use App\Models\ADClient;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ADController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('keyword') && $request->input('keyword')) {
            $keyword = $request->input('keyword');
            $list = AD::where('wechat_id', 'like', $keyword)->orWhere('wechat_name', 'like', $keyword)->orderBy('updated_at', 'desc')->paginate();
        } else {
            $list = AD::orderBy('updated_at', 'desc')->paginate();
        }
        return view('admin.ad.index', compact('list'));
    }

    public function paginate($items, $perPage = 25, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function create()
    {
        return view('admin.ad.create');
    }

    public function store(Request $request)
    {
        if($request->method() != 'POST') return back();
        $data = $request->all();
        if(!isset($data['data']['img'])) {
            return back()->withErrors(collect(['必须上传公众号二维码']));
        }
        $data['img'] = $data['data']['img'];
        unset($data['data']);
        unset($data['file']);
        $data['back_code'] = uniqid('zhimeizi-', true);
        $res = AD::create($data);
        if(! $res) return $this->showWarning('新建广告失败！');
        if(!$res->save()) return $this->showWarning('新建广告失败！');
        return $this->showMessage('新建成功！', '/admin/AD/index');
    }

    public function changeStatus(Request $request)
    {
        if($request->method() != 'POST') return back();
        if(!$request->has('id') || ($item = AD::find($request->input('id'))) == null) return $this->showWarning('找不到广告！');
        if(!$request->has('status')) return back();
        $item->status = $request->input('status');
        if(!$item->saveOrFail()) return $this->showWarning('数据库保存失败！');
        return $this->showMessage('操作成功！', '/admin/AD/index');
    }

    public function detail(Request $request)
    {
        if(!$request->has('id') || ($item = AD::find($request->input('id'))) == null) return back();
        return view('admin.ad.detail', compact('item'));
    }

    public function edit(Request $request)
    {
        if(!$request->has('id') || ($item = AD::find($request->input('id'))) == null) return back();
        return view('admin.ad.edit', compact('item'));
    }

    public function update(Request $request)
    {
        if($request->method() != 'POST') return back();
        if(!$request->has('id') || ($item = AD::find($request->input('id'))) == null) return $this->showWarning('找不到广告！');
        $arr = $request->all();
        unset($arr['_token']);
        $res = AD::where('id', $request->input('id'))->update($arr);
        if(!$res) return $this->showWarning('数据库更新失败！');
        return $this->showMessage('更新成功！', '/admin/AD/index');
    }

    public function destroy(Request $request)
    {
        if($request->method() != 'POST') return back();
        if(!$request->has('id') || ($item = AD::find($request->input('id'))) == null) return $this->showWarning('找不到广告！');
        if(!$item->delete()) return $this->showWarning('删除失败！');
        return $this->showMessage('删除成功！', '/admin/AD/index');
    }

    public function client(Request $request)
    {
        if(!$request->has('id') || ($ad = AD::find($request->input('id'))) == null) return $this->showWarning('找不到广告！');
        $list = $ad->clients;
        if(is_null($list)) {
            $clients = Client::all();
        } else {
            $ids = $list->pluck('id');
            $clients = Client::whereNotIn('id', $ids)->get();
        }
        return view('admin.ad.client', compact('list', 'ad', 'clients'));
    }

    public function addClient(Request $request)
    {
        if($request->method() != 'POST') return back();
        if(!$request->has('ad_id') || ($ad = AD::find($request->input('ad_id'))) == null) return $this->showWarning('找不到广告！');
        if(!$request->has('client_ids') || !is_array($request->input('client_ids'))) return $this->showWarning('没有选择客户！');
        $client_ids = $request->input('client_ids');
        foreach($client_ids as $client_id) {
            $res = ADClient::create([
                'ad_id' => $ad->id,
                'client_id' => $client_id
            ]);
            if(!$res) return $this->showWarning('添加失败！');
        }
        return $this->showMessage('添加成功！', url()->previous());
    }

    public function deleteClient(Request $request)
    {
        if($request->method() != 'POST') return back();
        if(!$request->has('ad_id') || ($ad = AD::find($request->input('ad_id'))) == null) return $this->showWarning('找不到广告！');
        if(!$request->has('client_id') || ($ad = AD::find($request->input('client_id'))) == null) return $this->showWarning('找不到客户！');
        $res = ADClient::where([
            'ad_id' => $request->input('ad_id'),
            'client_id' => $request->input('client_id')
        ])->delete();
        if(!$res) return $this->showWarning('删除失败！');
        return $this->showMessage('删除成功！', url()->previous());
    }
}
