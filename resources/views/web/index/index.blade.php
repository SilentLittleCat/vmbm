@extends('web.layout')

@section('header')
    <script src="/js/vconsole.min.js" ></script>
@endsection

@section('content')
    <div class="container">
        <div class="row" style="margin-top: 20px">
            <div class="logo col-sm-6 col-sm-offset-3" align="center">
                <img src="{{ $buy_get_logo }}" style="width: 200px;">
            </div>
        </div>
        <div class="row" style="margin-bottom: 20px; margin-top: 20px">
            <div class="logo col-sm-6 col-sm-offset-3">
                <a href="/web/Index/get" class="btn btn-lg btn-success btn-block">领取</a>
            </div>
        </div>
        <div class="row">
            <div class="logo col-sm-6 col-sm-offset-3" id="buy-btn">
                <a class="btn btn-lg btn-danger btn-block">购买</a>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script type="text/javascript">
        $(function() {
            $('#buy-btn').on('click', '.btn-danger', function() {
                WeixinJSBridge.invoke('getBrandWCPayRequest', {!! $json !!}, function(res) {
                    if(res.err_msg == "get_brand_wcpay_request:ok" ) {
                        window.location = '/web/Index/payResult?status=success';
                    } else {
                        window.location = '/web/Index/payResult?status=fail';
                    }
                });
            });
        });
    </script>
@endsection