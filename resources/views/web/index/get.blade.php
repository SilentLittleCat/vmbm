@extends('web.layout')

@section('header')
<style type="text/css">

</style>
@endsection

@section('content')
    <div class="container">
        @if(!$ad->img)
        <div class="row">
            <div class="logo col-sm-6 col-sm-offset-3" align="center">
                公众号不存在！
            </div>
        </div>
        @else
            <div class="row">
                <div class="logo col-sm-6 col-sm-offset-3" align="center">
                    <img src="{{ $ad->img }}">
                </div>
            </div>
        @endif
        <div class="row">
            <div class="logo col-sm-6 col-sm-offset-3" align="center">
                <b>长按二维码</b>关注公众号<br>
                回复<b>纸妹子</b>获取<b>验证码</b><br>
                回到公众号回复<b>验证码</b><br>
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