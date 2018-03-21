<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <title>设备客户后台</title>
    <meta name="keywords" content="设备客户后台">
    <link href="/base/css/bootstrap.min.css" rel="stylesheet">
    <link href="/base/css/font-awesome.min.css"  rel="stylesheet">
    <link href="/base/css/animate.min.css" rel="stylesheet">
    <link href="/base/css/style.min.css"  rel="stylesheet">

    <style type="text/css">
        .sg-input-item {
            margin-bottom: 10px;
        }
    </style>
</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>
                <h3>自助共享设备客户后台</h3>
            </div>
            <form class="m-t" role="form" accept-charset="UTF-8" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <div class="col-sm-12 sg-input-item">
                        <input name="phone" class="form-control" placeholder="手机号" required="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 sg-input-item">
                        <input type="password" name="password" class="form-control" placeholder="密码" required="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6 sg-input-item">
                        <input type="text" name="captcha" class="form-control" placeholder="点击图片刷新" required="">
                    </div>
                    <div class="col-sm-6 sg-input-item">
                        <img src="{{ captcha_src() }}" id="captcha-img">
                    </div>
                </div>
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
                <div class="col-sm-12 sg-input-item">
                    <button type="submit" class="btn btn-primary block full-width m-b">登 录</button>
                </div>
            </form>
        </div>
    </div>

<!-- 全局js -->
<script src="/base/js/jquery-2.1.1.min.js" ></script>
<script src="/base/js/bootstrap.min.js?v=3.4.0" ></script>
<script>
    $(function () {
        $('#captcha-img').on('click', function () {
            var randomLetter = String.fromCharCode(Math.floor(Math.random() * (122 - 97)) + 97);
            $(this).attr("src", $(this).attr("src") + randomLetter);
        });

        @if($errors->has('phone') || $errors->has('password'))
            alert('密码错误或者用户不存在！');
        @elseif($errors->has('captcha'))
            alert('验证码错误！');
        @endif
    });
</script>


<!--统计代码，可删除-->

</body>

</html>