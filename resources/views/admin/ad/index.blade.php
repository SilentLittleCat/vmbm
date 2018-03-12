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
                        <h5>广告列表</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link"> <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <form method="GET" action="" accept-charset="UTF-8">

                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="text" value="{{ Request::get('keyword') }}" placeholder="请输入公众号ID/名进行搜索" name="keyword"class="input-sm form-control">
                                        <span class="input-group-btn">
									<button type="submit" class="btn btn-sm btn-primary">搜索</button>
								</span>
                                    </div>
                                </div>
                            </form>
                            <div class="col-sm-3 pull-right">
                                <a href="{{ U('AD/create')}}" class="btn btn-sm btn-primary pull-right">添加</a>
                            </div>
                        </div>
                        {{--表格开始--}}
                        <table class="table table-striped table-bordered table-hover dataTable" id="sg-table">
                            <thead>
                            <tr>
                                <th>广告ID</th>
                                <th>公众号名</th>
                                <th>商家名称</th>
                                <th>商家电话</th>
                                <th>充值金额</th>
                                <th>吸粉数上限</th>
                                <th>已吸粉数</th>
                                <th>日吸粉数上限</th>
                                <th>开始日期</th>
                                <th>截止日期</th>
                                {{--<th>状态</th>--}}
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($list) == 0)
                                <tr>
                                    <td colspan="11" class="sg-centered">暂无广告！</td>
                                </tr>
                            @else
                                @foreach($list as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->wechat_name }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->tel }}</td>
                                        <td>{{ $item->money }}</td>
                                        <td>{{ $item->limit }}</td>
                                        <td>{{ $item->num }}</td>
                                        <td>{{ $item->day_limit }}</td>
                                        <td>{{ $item->begin_date }}</td>
                                        <td>{{ $item->end_date }}</td>
                                        {{--<td>--}}
                                            {{--@if($item->status == 0)--}}
                                                {{--<span class="label label-danger">下架</span>--}}
                                            {{--@else--}}
                                                {{--<span class="label label-success">上架</span>--}}
                                            {{--@endif--}}
                                        {{--</td>--}}
                                        <td>
                                            <div class="btn-group">
                                                {{--<div class="btn btn-sm btn-default btn-client" data-id="{{ $item->id }}">投放客户</div>--}}
                                                <div class="btn btn-sm btn-success btn-up" data-id="{{ $item->id }}">上架</div>
                                                <div class="btn btn-sm btn-warning btn-down" data-id="{{ $item->id }}">下架</div>
                                                <div class="btn btn-sm btn-info btn-detail" data-id="{{ $item->id }}">详情</div>
                                                <div class="btn btn-sm btn-primary btn-edit" data-id="{{ $item->id }}">编辑</div>
                                                <div class="btn btn-sm btn-danger btn-delete" data-id="{{ $item->id }}">删除</div>
                                            </div>
                                        </td>
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

    <div class="modal fade" id="up-modal" tabindex="-1" role="dialog" aria-labelledby="up-modal-label" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" class="form-horizontal" role="form" id="up-clients-form">
                {{ csrf_field() }}

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="up-modal-label">可投放的客户</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="col-sm-10" id="up-clients-checkbox"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
                            取消
                        </button>
                        <button type="submit" class="btn btn-success">
                            确认
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="down-modal" tabindex="-1" role="dialog" aria-labelledby="down-modal-label" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" class="form-horizontal" role="form" id="down-clients-form">
                {{ csrf_field() }}

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="down-modal-label">选择下架的客户</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="col-sm-10" id="down-clients-checkbox"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
                            取消
                        </button>
                        <button type="submit" class="btn btn-success">
                            确认
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <form method="POST" action="" id="sg-form">
        {{ csrf_field() }}
    </form>
@endsection

@section('footer')
    <script type="text/javascript">
        $(function() {
            $('#sg-table').on('click', '.btn-up', function () {
                var id = $(this).attr('data-id');
                $.ajax({
                    type: 'get',
                    url: '/admin/AD/getUpClients?id=' + $(this).attr('data-id'),
                    dataType: 'json',
                    success: function (data) {
                        var info = '';
                        if(data.status == 'success') {
                            for(var i = 0; i < data.clients.length; ++i) {
                                info += '<div class="checkbox"><label><input name="client_ids[]" type="checkbox" value="' + data.clients[i]['id'] + '">' + data.clients[i]['name'] + '</label></div>'
                            }
                            if(data.clients.length == 0) {
                                info = '暂时无可上架的客户';
                            }
                            $('#up-clients-checkbox').empty();
                            $('#up-clients-checkbox').html(info);
                            var url = '/admin/AD/addClients?ad_id=' + id;
                            $('#up-clients-form').attr('action', url);
                            $('#up-modal').modal('show');
                        }
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }).on('click', '.btn-down', function () {
                var id = $(this).attr('data-id');
                $.ajax({
                    type: 'get',
                    url: '/admin/AD/getDownClients?id=' + $(this).attr('data-id'),
                    dataType: 'json',
                    success: function (data) {
                        var info = '';
                        if(data.status == 'success') {
                            for(var i = 0; i < data.clients.length; ++i) {
                                info += '<div class="checkbox"><label><input name="client_ids[]" type="checkbox" value="' + data.clients[i]['id'] + '">' + data.clients[i]['name'] + '</label></div>'
                            }
                            if(data.clients.length == 0) {
                                info = '暂时无可下架的客户';
                            }
                            $('#down-clients-checkbox').empty();
                            $('#down-clients-checkbox').html(info);
                            var url = '/admin/AD/deleteClients?ad_id=' + id;
                            $('#down-clients-form').attr('action', url);
                            $('#down-modal').modal('show');
                        }
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }).on('click', '.btn-delete', function () {
                var url = "{{ U('AD/destroy') }}" + '?id=' + $(this).attr('data-id');
                $('#sg-form').attr('action', url);
                $('#my-modal-label').text('确认删除？');
                $('#my-modal').modal('show');
            }).on('click', '.btn-detail', function () {
                var url = "{{ U('AD/detail') }}" + '?id=' + $(this).attr('data-id');
                window.location = url;
            }).on('click', '.btn-edit', function () {
                var url = "{{ U('AD/edit') }}" + '?id=' + $(this).attr('data-id');
                window.location = url;
            }).on('click', '.btn-client', function () {
                var url = "{{ U('AD/client') }}" + '?id=' + $(this).attr('data-id');
                window.location = url;
            });

            $('#my-modal-confirm-btn').on('click', function () {
                $('#sg-form').submit();
            });
        });
    </script>
@endsection