@extends('admin.layout')

@section('header')
    <style type="text/css">

    </style>
@endsection

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-sm-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-success pull-right">在线</span>
                            <h5>设备</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">{{ $off_device_cnt . '/' . $devices_cnt }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-default pull-right">离线</span>
                            <h5>设备</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">{{ $off_device_cnt . '/' . $devices_cnt }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-danger pull-right">缺纸</span>
                            <h5>设备</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">{{ $lack_device_cnt . '/' . $devices_cnt }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-danger pull-right">零纸巾</span>
                            <h5>设备</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">{{ $zero_device_cnt . '/' . $devices_cnt }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-danger pull-right">故障</span>
                            <h5>设备</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">{{ $error_device_cnt . '/' . $devices_cnt }}</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-bottom: 30px;">
                <form class="">
                    <div class="col-sm-2">
                        <select class="form-control" name="date">
                            <option value="today" {{ Request::get('date') == 'today' ? 'selected' : '' }}>当天</option>
                            <option value="three_day" {{ Request::get('date') == 'three_day' ? 'selected' : '' }}>最近三天</option>
                            <option value="seven_day" {{ Request::get('date') == 'seven_day' ? 'selected' : '' }}>最近七天</option>
                            <option value="this_month" {{ Request::get('date') == 'this_month' ? 'selected' : '' }}>本月</option>
                            <option value="last_month" {{ Request::get('date') == 'last_month' ? 'selected' : '' }}>上月</option>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control datepicker" value="{{ Request::get('begin_date') }}" placeholder="开始日期" name="begin_date"class="input-sm form-control">
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control datepicker" value="{{ Request::get('end_date') }}" placeholder="结束日期" name="end_date"class="input-sm form-control">
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-primary">搜索</button>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-danger pull-right">购买</span>
                            <h5>纸巾</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">{{ $buy_cnt }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-info pull-right">领取</span>
                            <h5>纸巾</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">{{ $get_cnt }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script type="text/javascript">
        $(function() {
            $('.datepicker').datepicker({
                language: 'zh-CN',
                format: "yyyy-mm-dd",
            });
        });
    </script>
@endsection