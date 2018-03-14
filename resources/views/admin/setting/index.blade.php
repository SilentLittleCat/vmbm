@extends('admin.layout')

@section('header')
    <style type="text/css">
        .sg-item {
            font-size: 1.3em;
            margin-top: 15px;
            margin-bottom: 15px;
        }
        .sg-value {
            font-weight: bold;
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
                        <h5>参数设置</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link"> <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-4 col-sm-offset-8">
                                <a class="btn btn-primary pull-right" href="{{ U('Setting/edit') }}">编辑</a>
                            </div>
                        </div>
                        <div class="row sg-item">
                            <div class="col-sm-2 col-sm-offset-2 sg-label">纸巾价格</div>
                            <div class="col-sm-6 sg-value">{{ $tissue_price ? $tissue_price->value . '元' : '未设置' }}</div>
                        </div>
                        <div class="row sg-item">
                            <div class="col-sm-2 col-sm-offset-2 sg-label">缺纸下限</div>
                            <div class="col-sm-6 sg-value">{{ $lack_tissue_low_limit ? $lack_tissue_low_limit->value : '未设置' }}</div>
                        </div>
                        <div class="row sg-item">
                            <div class="col-sm-2 col-sm-offset-2 sg-label">页面图片(360 * 360)</div>
                            <div class="col-sm-6 sg-value"><img src="{{ $buy_get_logo }}" width="200px"></div>
                        </div>
                        {{--<div class="row sg-item">--}}
                            {{--<div class="col-sm-2 col-sm-offset-2 sg-label">缺纸告警信息</div>--}}
                            {{--<div class="col-sm-6 sg-value">{{ $lack_info ? $lack_info->value : '未设置' }}</div>--}}
                        {{--</div>--}}
                        {{--<div class="row sg-item">--}}
                            {{--<div class="col-sm-2 col-sm-offset-2 sg-label">零纸巾告警信息</div>--}}
                            {{--<div class="col-sm-6 sg-value">{{ $zero_info ? $zero_info->value : '未设置' }}</div>--}}
                        {{--</div>--}}
                        {{--<div class="row sg-item">--}}
                            {{--<div class="col-sm-2 col-sm-offset-2 sg-label">故障告警信息</div>--}}
                            {{--<div class="col-sm-6 sg-value">{{ $error_info ? $error_info->value : '未设置' }}</div>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script type="text/javascript">
        $(function() {

        });
    </script>
@endsection