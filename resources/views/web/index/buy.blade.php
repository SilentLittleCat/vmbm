@extends('web.layout')

@section('header')
    <script src="/js/vconsole.min.js" ></script>
@endsection

@section('content')
    <div class="container">
        <div class="row" style="margin-top: 20px;" id="buy-btn">
            <div class="logo col-sm-6 col-sm-offset-3">
                <button class="btn btn-lg btn-danger btn-block">购买</button>
            </div>
        </div>
        <div id="sg-hint-info"></div>
    </div>
@endsection

@section('footer')
    <script type="text/javascript">
        $(function() {
            $('#buy-btn').on('click', function() {
                WeixinJSBridge.invoke('getBrandWCPayRequest', {!! $json !!}, function(res) {
                    var vConsole = new VConsole();
                    console.log(res);
                    if(res.err_msg == "get_brand_wcpay_request:ok" ) {
                        // 使用以上方式判断前端返回,微信团队郑重提示：
                        // res.err_msg将在用户支付成功后返回
                        // ok，但并不保证它绝对可靠。
                    }
                });
            });
        });
    </script>
@endsection