@extends('admin.layout')

@section('header')
<style type="text/css">
    .sg-centered {
        text-align: center;
    }
</style>
@endsection

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                @if(isset($errors) && !$errors->isEmpty())
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert"
                                aria-hidden="true">
                            &times;
                        </button>
                        @foreach($errors->keys() as $key)
                            {{ $errors->first($key) }}
                        @endforeach
                    </div>
                @endif

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>设备纸巾销售领取统计</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link"> <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <form method="GET" action="" accept-charset="UTF-8">
                                <div class="col-sm-3">
                                    <input type="text" value="{{ Request::get('keyword') }}" placeholder="请输入设备名/客户名进行搜索" name="keyword"class="input-sm form-control">
                                </div>
                                <div class="col-sm-2">
                                    <select class="form-control" name="date">
                                        <option value="today">当天</option>
                                        <option value="three_day">最近三天</option>
                                        <option value="seven_day">最近七天</option>
                                        <option value="this_month">本月</option>
                                        <option value="last_month">上月</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control datepicker" value="{{ Request::get('begin_date') }}" placeholder="开始日期" name="begin_date"class="input-sm form-control">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control datepicker" value="{{ Request::get('end_date') }}" placeholder="结束日期" name="end_date"class="input-sm form-control">
                                </div>
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-primary">搜索</button>
                                </div>
                            </form>
                            {{--<div class="col-sm-3 pull-right">--}}
                                {{--<a href="{{ U('Tissue/create')}}" class="btn btn-sm btn-primary pull-right">添加</a>--}}
                            {{--</div>--}}
                        </div>
                        {{--表格开始--}}
                        <table class="table table-striped table-bordered table-hover dataTable" id="sg-table">
                            <thead>
                            <tr>
                                <th>客户</th>
                                <th>设备（IMEI）</th>
                                <th>销售纸巾数</th>
                                <th>领取纸巾数</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($list) == 0)
                                <tr>
                                    <td colspan="4" class="sg-centered">暂无纸巾购买/领取信息！</td>
                                </tr>
                            @else
                                @foreach($items as $item)
                                    <tr>
                                        <td>{{ $item->client->name }}</td>
                                        <td>{{ $item->IMEI }}</td>
                                        <td>{{ $item->buy_cnt }}</td>
                                        <td>{{ $item->get_cnt }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="dataTables_info" id="DataTables_Table_0_info"
                                     role="alert" aria-live="polite" aria-relevant="all">每页{{ $list->count() }}条，共{{ $list->lastPage() }}页，总{{ $list->total() }}条。</div>
                            </div>
                            <div class="col-sm-6">
                                <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                                    {!! $list->setPath('')->appends(Request::all())->render() !!}
                                </div>
                            </div>
                        </div>
                        {{--表格结束--}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="my-modal" tabindex="-1" role="dialog" aria-labelledby="my-modal-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="my-modal-label"></h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
                        取消
                    </button>
                    <button type="button" class="btn btn-success" id="my-modal-confirm-btn">
                        确认
                    </button>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" action="" id="sg-form">
        {{ csrf_field() }}
    </form>
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