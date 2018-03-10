<?php

namespace App\Http\Controllers\Admin;

use App\Models\AD;
use App\Models\Device;
use App\Models\Fan;
use App\Models\Tissue;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class TissueController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('keyword') && $request->input('keyword')) {
            $keyword = $request->input('keyword');
            $list = Device::with(['client'])->orderBy('updated_at', 'desc')->get()->filter(function ($value) use($keyword) {
                if(!(strpos($value->name, $keyword) === false)) return true;
                if($value->client && !(strpos($value->client->name, $keyword) === false)) return true;
                return false;
            });
            $list = $this->paginate($list);
        } else {
            $list = Device::with(['client'])->orderBy('updated_at', 'desc')->paginate();
        }
        $items = $list->items();
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
        foreach($items as $item) {
            $item->buy_cnt = Tissue::where([
                ['device_id', '=', $item->id],
                ['status', '=', 1],
                ['created_at', '>=', $begin_date],
                ['created_at', '<=', $end_date]
            ])->get()->count();
            $item->get_cnt = Tissue::where([
                ['device_id', '=', $item->id],
                ['status', '=', 0],
                ['created_at', '>=', $begin_date],
                ['created_at', '<=', $end_date]
            ])->get()->count();
        }
        return view('admin.tissue.index', compact('list', 'fan', 'items'));
    }

    public function paginate($items, $perPage = 25, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function create()
    {
        $fans = Fan::all();
        $devices = Device::all();
        $ads = AD::all();
        return view('admin.tissue.create', compact('fans', 'devices', 'ads'));
    }

    public function store(Request $request)
    {
        if($request->method() != 'POST') return back();
        $res = Tissue::create($request->all());
        if(! $res) return $this->showWarning('新建纸巾失败！');
        return $this->showMessage('新建成功！', '/admin/Tissue/index');
    }

    public function detail(Request $request)
    {
        if(!$request->has('id') || ($item = Tissue::find($request->input('id'))) == null) return back();
        return view('admin.tissue.detail', compact('item'));
    }

    public function edit(Request $request)
    {
        $fans = Fan::all();
        $devices = Device::all();
        $ads = AD::all();
        if(!$request->has('id') || ($tissue = Tissue::find($request->input('id'))) == null) return back();
        return view('admin.tissue.edit', compact('tissue', 'fans', 'devices', 'ads'));
    }

    public function update(Request $request)
    {
        if($request->method() != 'POST') return back();
        if(!$request->has('id') || ($item = Tissue::find($request->input('id'))) == null) return $this->showWarning('找不到纸巾！');
        $arr = $request->all();
        unset($arr['_token']);
        $res = Tissue::where('id', $request->input('id'))->update($arr);
        if(!$res) return $this->showWarning('数据库更新失败！');
        return $this->showMessage('更新成功！', '/admin/Tissue/index');
    }

    public function destroy(Request $request)
    {
        if($request->method() != 'POST') return back();
        if(!$request->has('id') || ($item = Tissue::find($request->input('id'))) == null) return $this->showWarning('找不到纸巾！');
        if(!$item->delete()) return $this->showWarning('删除失败！');
        return $this->showMessage('删除成功！', '/admin/Tissue/index');
    }
}
