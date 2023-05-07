<!DOCTYPE html>
<html lang="en" @if($userCurrentLang->rtl == 1) dir="rtl" @endif>
    <head>
        <!--====== Required meta tags ======-->
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="@yield('meta-description')">
        <meta name="keywords" content="@yield('meta-keywords')">

        @yield('og-meta')
        <!--====== Title ======-->
        <title>{{$user->username}} - @yield('tab-title')</title>

        <!--====== Favicon Icon ======-->
        <link rel="shortcut icon" href="{{!empty($userBs->favicon) ? asset('assets/front/img/user/'.$userBs->favicon) : ''}}" type="image/png">
        <link rel="stylesheet" href="{{asset('assets/front/css/plugin.min.css')}}">
        <!--====== Common css ======-->
        <link rel="stylesheet" href="{{asset('assets/front/css/profile/common.css')}}">
        <!--====== Default css ======-->
        <link rel="stylesheet" href="{{asset('assets/front/css/profile/theme5/default.css')}}">
        <!--====== Style css ======-->
        <link rel="stylesheet" href="{{asset('assets/front/css/profile/theme5/style.css')}}">
        <!--====== Responsive css ======-->
        <link rel="stylesheet" href="{{asset('assets/front/css/profile/theme5/responsive.css')}}">
        @if ($userCurrentLang->rtl == 1)
        <!--====== Common RTL Style css ======-->
        <link rel="stylesheet" href="{{asset('assets/front/css/profile/common-rtl.css')}}">
        <!--====== RTL Style css ======-->
        <link rel="stylesheet" href="{{asset('assets/front/css/profile/theme5/rtl.css')}}">
        <!--====== RTL Responsive css ======-->
        <link rel="stylesheet" href="{{asset('assets/front/css/profile/theme5/rtl-responsive.css')}}">
        @endif
        @php
            if(!empty($userBs->base_color)) {
                $baseColor = $userBs->base_color;
            } else {
                $baseColor = 'F57236';
            }
            if(!empty($userBs->secondary_base_color)) {
                $secBaseColor = $userBs->secondary_base_color;
            } else {
                $secBaseColor = 'FEAF2F';
            }
        @endphp
        <link rel="stylesheet" href="{{asset('assets/front/css/profile/common-base-color.php?color=' . $baseColor)}}">
        <link rel="stylesheet" href="{{asset('assets/front/css/profile/theme5/base-color.php?color=' . $baseColor . '&color2=' . $secBaseColor)}}">


        @yield('styles')
    </head>
    <body>
        @if (!empty($userBs->preloader))
        <!--====== Start Preloader ======-->
        <div class="preloader">
            <div class="lds-ellipsis">
                <img src="{{asset('assets/front/img/user/' . $userBs->preloader)}}" alt="">
            </div>
        </div><!--====== End Preloader ======-->
        @endif

                <!--====== Start nav-toggole ======-->
                <div class="nav-toggoler">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <!--====== End nav-toggole ======-->
                <!--====== Start Header Section ======-->
                <header class="header-area">
                    <div class="navigation-wrapper">
                        <div class="user-box text-center">
                            <div class="user-img">
                                @if(isset($user->photo))
                                    <img class="lazy" data-src="{{asset('assets/front/img/user/'.$user->photo)}}" alt="">
                                @else
                                    <img data-src="{{asset('assets/admin/img/propics/blank_user.jpg')}}" alt="..."
                                        class="avatar-img rounded-circle lazy">
                                @endif
                            </div>
                            <h4>{{$home_text->first_name ?? $user->first_name}} {{$home_text->last_name ?? $user->last_name}}</h4>
                            @php
                                $user = getUser();
                            @endphp
                            <span class="position">{{'@' . $user->username}}</span>
                        </div>
                        <div class="primary-menu">
                            <nav class="main-menu">
                                <ul>
                                    <li>
                                        <a href="{{route('front.user.detail.view', getParam())}}"><i class="fas fa-home"></i>{{$keywords["Home"] ?? "Home"}}</a>
                                    </li>

                                    @if(is_array($userPermissions) && is_array($packagePermissions) && in_array('Service',$userPermissions) && in_array('Service',$packagePermissions))
                                    <li>
                                        <a href="{{route('front.user.services', getParam())}}"><i class="fas fa-tools"></i>{{$keywords["Services"] ?? "Services"}}</a>
                                    </li>
                                    @endif

                                    @if(is_array($userPermissions) && is_array($packagePermissions) && in_array('Portfolio',$userPermissions) && in_array('Portfolio',$packagePermissions))
                                    <li>
                                        <a href="{{route('front.user.portfolios', getParam())}}"><i class="fas fa-briefcase"></i>{{$keywords["Portfolios"] ?? "Portfolios"}}</a>
                                    </li>
                                    @endif
                                    @if(is_array($userPermissions) && is_array($packagePermissions) && in_array('Blog',$userPermissions) && in_array('Blog',$packagePermissions))
                                    <li>
                                        <a href="{{route('front.user.blogs', getParam())}}"><i class="fas fa-pencil-alt"></i>{{$keywords["Blogs"] ?? "Blogs"}}</a>
                                    </li>
                                    @endif
                                    @if(is_array($userPermissions) && in_array('Contact',$userPermissions))
                                    <li>
                                        <a
                                        @if (request()->routeIs('front.user.detail.view'))
                                            href="#contact"
                                        @else
                                            href="{{route('front.user.detail.view', getParam())}}#contact"
                                        @endif><i class="far fa-address-book"></i>{{$keywords["Contact"] ?? "Contact"}}</a>
                                    </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                        <div class="nav-social">
                            <ul class="social-link">
                                @if(isset($social_medias))
                                    @foreach($social_medias as $social_media)
                                    <li><a href="{{$social_media->url}}" target="_blank"><i class="{{$social_media->icon}}"></i></a>
                                    </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>

                    @if (!empty($userLangs))
                    <div class="language-selector bordered-style  d-flex">
                        <form action="{{route('changeUserLanguage', getParam())}}" id="userLangForm">
                            <input type="hidden" name="username" value="{{$user->username}}">
                            <select name="code" onchange="document.getElementById('userLangForm').submit();">
                                @foreach ($userLangs as $userLang)
                                    <option value="{{$userLang->code}}" {{$userLang->id == $userCurrentLang->id ? 'selected' : ''}}>{{$userLang->name}}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                    @endif
                </header>
                <!--====== End Header Section ======-->

                @if (!request()->routeIs('front.user.detail.view'))
                    <div class="main-wrapper">
                        <!--====== Start Hero Section ======-->
                        <div class="hero-area">
                            <div class="breadcrumbs-section">
                                <div class="container">
                                    <div class="row align-items-center justify-content-center">
                                        <div class="col-lg-10">
                                            <div class="page-title">
                                                <h1>@yield('br-title')</h1>
                                                <ul class="breadcrumbs-link">
                                                    <li><a href="{{route('front.user.detail.view', getParam())}}">{{$keywords["Home"] ?? "Home"}}</a></li>
                                                    <li class="">@yield('br-link')</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--====== Start Page Content ======-->
                @endif

                @yield('content')


                <!--====== Start Footer ======-->
                <footer class="footer-area">
                    <div class="footer-wrapper-one">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <div class="footer-content text-center">
                                        @if(is_array($userPermissions) && in_array('Footer Mail',$userPermissions))
                                            <span class="sub-title">{{$keywords["Stay_Connected"] ?? "Stay Connected"}}</span>
                                            <h5><a href="mailto:{{$user->email}}">{{$user->email}}</a></h5>
                                        @endif
                                        <ul class="social-link">
                                            @if(isset($social_medias))
                                                @foreach($social_medias as $social_media)
                                                <li><a href="{{$social_media->url}}" target="_blank"><i class="{{$social_media->icon}}"></i></a>
                                                </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer><!--====== End Footer ======-->
            @if (!request()->routeIs('front.user.detail.view'))
                </div>
            @endif
        </div>
        <!--====== back-to-top ======-->
        <a href="#" class="back-to-top" ><i class="fas fa-angle-up"></i></a>
        <!--====== Jquery ======-->
        <script src="{{asset('assets/front/js/vendor/jquery-3.4.1.min.js')}}"></script>
        <!--====== plugin js ======-->
        <script src="{{asset('assets/front/js/plugin.min.js')}}"></script>
        <script>
            "use strict";
            var rtl = {{$userCurrentLang->rtl}};
        </script>
        <!--====== Common js ======-->
        <script src="{{asset('assets/front/js/profile/common.js')}}"></script>
        <!--====== Main js ======-->
        <script src="{{asset('assets/front/js/profile/theme5/main.js')}}"></script>
        @if (session()->has('success'))
        <script>
            "use strict";
            toastr['success']("{{ __(session('success')) }}");
        </script>
        @endif
        @yield('scripts')
    </body>
</html>