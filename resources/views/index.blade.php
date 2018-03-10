@extends('web.layout')

@section('header')
<style type="text/css">
    .sg-main-content {
        background-color: #e7e7e7;
        padding-bottom: 30px;
    }
    .footer {
        padding: 20px;
    }
</style>
@endsection

@section('content')
<div class="sg-main-content">
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                {{--<a class="navbar-brand" href="/">纸妹子</a>--}}
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/client/register">注册</a></li>
                <li><a href="/client/login">登录</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div id="myCarousel" class="carousel slide">
            <!-- 轮播（Carousel）指标 -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <!-- 轮播（Carousel）项目 -->
            <div class="carousel-inner">
                <div class="item active" align="center">
                    <img src="/base/img/index1.jpg" alt="First slide">
                </div>
                <div class="item" align="center">
                    <img src="/base/img/index2.jpg" alt="Second slide">
                </div>
                <div class="item" align="center">
                    <img src="/base/img/index3.jpg" alt="Third slide">
                </div>
            </div>
            <!-- 轮播（Carousel）导航 -->
            <a class="carousel-control left" href="#myCarousel"
               data-slide="prev" style="background-color: transparent; background-image: none; font-size: 10em; line-height: 100%; padding: 20% 7%">&lsaquo;
            </a>
            <a class="carousel-control right" href="#myCarousel"
               data-slide="next" style="background-color: transparent; background-image: none; font-size: 10em; line-height: 100%; padding: 20% 10%">&rsaquo;
            </a>
        </div>
    </div>
</div>
<div class="footer">
    <div class="pull-right">&copy; 2014-2019 <a href="/" target="_blank">纸妹子</a>
    </div>
</div>
@endsection

@section('footer')
    <script type="text/javascript">
        $(function() {
            $('#myCarousel').carousel()
        });
    </script>
@endsection