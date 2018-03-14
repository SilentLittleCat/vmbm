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
                        <h5>编辑设置</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link"> <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal" role="form" method="POST" action="{{ U('Setting/update') }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-offset-2 control-label">纸巾价格</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" name="tissue_price" value="{{ $tissue_price ? $tissue_price->value : '' }}" placeholder="请输入纸巾价格，单位：元" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-offset-2 control-label">缺纸下限</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="number" name="lack_tissue_low_limit" value="{{ $lack_tissue_low_limit ? $lack_tissue_low_limit->value : '' }}" placeholder="请输入缺纸下限(整数)" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-offset-2 control-label">页面图片(360 * 360)</label>
                                <div class="col-sm-6">
                                    {!!  widget('Tools.ImgUpload')->single2('/upload/qrcode','buy_get_logo','buy_get_logo', $buy_get_logo ? $buy_get_logo : "") !!}
                                </div>
                            </div>
                            {{--<div class="form-group">--}}
                                {{--<label class="col-sm-2 col-sm-offset-2 control-label">缺纸告警信息</label>--}}
                                {{--<div class="col-sm-6">--}}
                                    {{--<input class="form-control" type="text" name="lack_info" value="{{ $lack_info ? $lack_info->value : '' }}" placeholder="请输入缺纸告警信息" required>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label class="col-sm-2 col-sm-offset-2 control-label">零纸巾告警信息</label>--}}
                                {{--<div class="col-sm-6">--}}
                                    {{--<input class="form-control" type="text" name="zero_info" value="{{ $zero_info ? $zero_info->value : '' }}" placeholder="请输入零纸巾告警信息" required>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label class="col-sm-2 col-sm-offset-2 control-label">故障告警信息</label>--}}
                                {{--<div class="col-sm-6">--}}
                                    {{--<input class="form-control" type="text" name="error_info" value="{{ $error_info ? $error_info->value : '' }}" placeholder="请输入故障告警信息" required>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<div class="col-sm-6 col-sm-offset-4">--}}
                                    {{--<button class="btn btn-primary" type="submit">提交</button>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </form>
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