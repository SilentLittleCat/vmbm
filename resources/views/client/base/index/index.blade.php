<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">

    <title>设备客户后台</title>

    <!--[if lt IE 8]>
    <script>
        alert('H+已不支持IE6-8，请使用谷歌、火狐等浏览器\n或360、QQ等国产浏览器的极速模式浏览本页面！');
    </script>
    <![endif]-->

    <link href="/base/css/bootstrap.min.css?v=3.4.0" rel="stylesheet">
    <link href="/base/css/font-awesome.min.css?v=4.3.0" rel="stylesheet">
    <link href="/base/css/animate.min.css" rel="stylesheet">
    <link href="/base/css/style.min.css?v={{config("sys.version")}}" rel="stylesheet">
</head>

<body class="fixed-sidebar full-height-layout gray-bg">
<div id="wrapper">
    <!--左侧导航开始-->
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="nav-close"><i class="fa fa-times-circle"></i>
        </div>
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                                <span class="block m-t-xs"><strong class="font-bold">{{ Auth::guard('client')->user()->name }}</strong></span>
                                <span class="text-muted text-xs block"><b class="caret"></b></span>
                                </span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            {{--<li><a target="_blank" href="/">网站首页</a></li>--}}
                            {{--<li><a href="/admin/changePassword" class="J_menuItem">修改密码</a></li>--}}
                            {{--<li class="divider"></li>--}}
                            <li><a href="/client/logout">安全退出</a>
                            </li>
                        </ul>
                    </div>
                    <div class="logo-element">
                    </div>
                </li>
                <li>
                    <a href="/client">
                        <i class="fa fa-bar-chart-o"></i>
                        <span class="nav-label">统计管理</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-laptop"></i>
                        <span class="nav-label">设备管理</span>
                        <span class="fa arrow"></span>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="/client/Device/index" class="J_menuItem" data-index="0">设备列表</a>
                            </li>
                        </ul>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <!--左侧导航结束-->
    <!--右侧部分开始-->
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row J_mainContent" id="content-main" style="height:calc(100% - 80px)">
            <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="client/Base/Index/welcome" frameborder="0" data-id="index_v1.html" seamless>
            </iframe>
        </div>
        <div class="footer" style="position: fixed;bottom:0;right: 0;left: 0">
            <div class="pull-right">&copy; 2014-2019 <a href="/" target="_blank">纸妹子</a>
            </div>
        </div>
    </div>
    <!--右侧部分结束-->
    <!--右侧边栏开始-->
    <div id="right-sidebar">

    </div>
    <!--右侧边栏结束-->
    <!-- 全局js -->
    <script src="/base/js/jquery-2.1.1.min.js?v={{config("sys.version")}}" ></script>
    <script src="/base/js/bootstrap.min.js?v=3.4.0"></script>
    <script src="/base/js/plugins/metisMenu/jquery.metisMenu.js?v={{config("sys.version")}}" ></script>
    <script src="/base/js/plugins/slimscroll/jquery.slimscroll.min.js?v={{config("sys.version")}}" ></script>
    <script src="/base/js/plugins/layer/layer.min.js?v={{config("sys.version")}}" ></script>

    <!-- 自定义js -->
    <script src="/base/js/hplus.min.js?v=3.2.0"></script>
    <script type="text/javascript" src="/base/js/contabs.min.js?v={{config("sys.version")}}" ></script>

    <!-- 第三方插件 -->
    <script src="/base/js/plugins/pace/pace.min.js?v={{config("sys.version")}}" ></script>

</body>

</html>