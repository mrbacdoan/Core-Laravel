<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>@if(!empty($meta['title'])) {!! $meta['title'] !!} @endif</title>
    @yield('meta')
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <!--CSS-->
    <link href="{{ asset('assets/css/vendor.css?v=1') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css?v=1') }}" rel="stylesheet">
    <!--End-CSS-->
</head>
<body>
<div class="wrapper">
    <div class="global-nav">
        <div class="container">
            <div class="pull-left">
                <ul class="social-lists list-unstyled list-inline">
                    <li>
                        <a href="">
                            <i class="fa fa-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fa fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fa fa-pinterest"></i>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fa fa-google-plus"></i>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fa fa-chevron-right"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="pull-right">
                <ul class="list-unstyled list-inline">
                    <li>
                        <i class="fa fa-envelope-o"></i> info@vich.vn
                    </li>
                    <li>
                        <div class="dropdown language-lists">
                            <a href="#" data-target="#" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-globe"></i>
                                @if(App::getLocale() == 'en') English @else Tiếng Việt @endif
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-mini" role="menu">
                                <li><a href="{{ url('?lang=vi') }}">Tiếng Việt</a></li>
                                <li><a href="{{ url('?lang=en') }}">English</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="navbar navbar-static-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="logo" href="{{ route('frontend.home.index') }}">
                            <img src="{{ asset('assets/img/logo-'.App::getLocale().'.png') }}" alt="Vich.vn">
                        </a>
                    </div>
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li><a href="{{ route('frontend.home.index') }}" class="@if(getRouteName() == 'frontend.home.index') active @endif">{{ trans('default.home') }}</a></li>
                            <li><a href="{{ route('frontend.video.special') }}"  class="@if(getRouteName() == 'frontend.video.special') active @endif">{{ trans('default.video') }}</a></li>
                            <li><a href="{{ route('frontend.photo.special') }}"  class="@if(getRouteName() == 'frontend.photo.special') active @endif">{{ trans('default.photo') }}</a></li>
                            <li><a href="{{ route('frontend.heritage.index') }}"  class="@if(getRouteName() == 'frontend.heritage.index') active @endif">{{ trans('default.document') }}</a>
                            </li>
                        </ul>
                        <div class="searchInput pull-right">
                            <form id="photoSearchInput" class="search-input" method="GET"
                                  action="{{ route('frontend.search.index') }}">
                                <input type="text" name="s" class="form-control"
                                       placeholder="{{ trans('default.search') }}" value="{{ e(Request::get('s')) }}">
                                <button class="btn">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(!empty($sliders))
        <div class="slide-show">
            <div id="featured-slider" class="carousel slide featured-sliders" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <?php $i = 0; ?>
                    @foreach($sliders as $slider)
                        <div class="item @if($i==0) active @endif">
                            <img src="{{ asset($slider->thumbnail) }}" alt="...">

                            <div class="carousel-caption">
                                <a href="{{ $slider->link }}" class="heading">{{ $slider->title }}</a>

                                <p class="description">{{ $slider->description }}</p>
                                <a href="{{ $slider->link }}" class="btn btn-lg">{{ trans('default.discover') }}</a>
                            </div>
                        </div>
                        <?php $i++; ?>
                    @endforeach
                </div>
                <a class="left carousel-control" href="#featured-slider" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#featured-slider" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    @endif
    @yield('contentHeader')
    <div class="page-content">
        <div class="container">
            <div class="main">
                @yield('content')
            </div>
        </div>
    </div>
    <div class="footer text-center">
        <span>&copy; 2016 Copyright by VICH</span>
    </div>
</div>
<!--Script-->
<script src="{{ asset('assets/js/vendor.js?v=1') }}"></script>
<script src="{{ asset('assets/js/app.js?v=1') }}"></script>
@if(request()->getClientIp() != '127.0.0.1')
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-72905971-1', 'auto');
    ga('send', 'pageview');
</script>
@endif
<!--End-Script-->
</body>
</html>