@extends('web.layout')

@section('header')
    <script src="/js/vconsole.min.js" ></script>
    <script type="text/javascript">
        function buyTissue() {
            WeixinJSBridge.invoke('getBrandWCPayRequest', {!! $json !!}, function(res) {
                var vConsole = new VConsole();
                console.log(res);
                if(res.err_msg == "get_brand_wcpay_request:ok" ) {
                    window.location = '/web/Index/payResult?status=success';
                } else {
                    window.location = '/web/Index/payResult?status=fail';
                }
            });
        }
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="logo col-sm-6 col-sm-offset-3" align="center">
                <img src="/base/img/meizi.jpeg">
            </div>
        </div>
        <div class="row" style="margin-bottom: 20px">
            <div class="logo col-sm-6 col-sm-offset-3">
                <a href="/web/Index/get" class="btn btn-lg btn-success btn-block">领取</a>
            </div>
        </div>
        <div class="row">
            <div class="logo col-sm-6 col-sm-offset-3" id="buy-btn">
                <a class="btn btn-lg btn-danger btn-block" onclick="buyTissue();">购买</a>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script type="text/javascript">
        $(function() {
            {{--function buyTissue() {--}}
                {{--WeixinJSBridge.invoke('getBrandWCPayRequest', {!! $json !!}, function(res) {--}}
                    {{--var vConsole = new VConsole();--}}
                    {{--console.log(res);--}}
                    {{--if(res.err_msg == "get_brand_wcpay_request:ok" ) {--}}
                        {{--window.location = '/web/Index/payResult?status=success';--}}
                    {{--} else {--}}
                        {{--window.location = '/web/Index/payResult?status=fail';--}}
                    {{--}--}}
                {{--});--}}
            {{--}--}}
        });
    </script>
@endsection