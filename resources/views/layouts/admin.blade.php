<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    @include('includes.ad-head')
</head>
<body>
    @include('includes.ad-nav')
    <div id="wrapper">
        <!----->
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="content-main">
                @yield('container')
                <div class="copy">
                    <p> &copy; {{ date('Y') }} Hard Shop. All Rights Reserved</p>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</body>
</html>