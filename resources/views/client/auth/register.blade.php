<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <title>管理后台</title>
    <meta name="keywords" content="管理后台">
    <link href="/base/css/bootstrap.min.css" rel="stylesheet">
    <link href="/base/css/font-awesome.min.css"  rel="stylesheet">
    <link href="/base/css/animate.min.css" rel="stylesheet">
    <link href="/base/css/style.min.css"  rel="stylesheet">

    <style>
        .sg-main-container {
            margin-top: 100px;
        }
    </style>
</head>

<body class="gray-bg">

<div class="container sg-main-container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center">
                    <h3>自助共享设备客户注册</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('client/register') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('company') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label" for="name">公司名称</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="company" value="{{ old('company') }}" required>

                                @if ($errors->has('company'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('credit_code') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label" for="name">企业信用代码</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="credit_code" value="{{ old('credit_code') }}">

                                @if ($errors->has('credit_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('credit_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label" for="name">联系人</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">手机</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="手机号用于登录和联系您，请谨慎填写" required>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">密码</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">确认密码</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>注册
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 全局js -->
<script src="/base/js/jquery-2.1.1.min.js" ></script>
<script src="/base/js/bootstrap.min.js?v=3.4.0" ></script>


<!--统计代码，可删除-->

</body>

</html>