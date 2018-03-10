@extends('web.layout')

@section('header')
    <script src="/js/vconsole.min.js" ></script>
@endsection

@section('content')
    <div class="container">
        <div class="row" style="margin-top: 20px;" id="buy-btn">
            <div class="logo col-sm-6 col-sm-offset-3">
                <div class="logo col-sm-6 col-sm-offset-3" align="center">
                    @if($result == 'success')
                        <i class="fa fa-check-circle" style="font-size: 10em; color: #3fa55e;"></i>
                    @else
                        <i class="fa fa-times-circle" style="font-size: 10em; color: #a52e32;"></i>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="logo col-sm-6 col-sm-offset-3">
                @if($result == 'success')
                    <div style="text-align: center; margin-top: 20px; margin-bottom: 20px"><b>支付成功！</b></div>
                @else
                    <div style="text-align: center; margin-top: 20px; margin-bottom: 20px"><b>支付失败！</b></div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="logo col-sm-6 col-sm-offset-3">
                <a href="/web/index" class="btn btn-lg btn-info btn-block">再次领取/购买</a>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script type="text/javascript">

    </script>
@endsection