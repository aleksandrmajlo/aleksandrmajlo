@php
    $config = [
        'appName' => config('app.name'),
        'locale' => $locale = app()->getLocale(),
        'locales' => config('app.locales'),
    ];
@endphp
    <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('libs/swiper/css/swiper.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('libs/@fancyapps/fancybox/jquery.fancybox.min.css') }}"/>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;700&amp;display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
    crossorigin=""/>
    <link href="{{ asset('css/main.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/app.css') }}" rel="stylesheet">

</head>
<body>
<div id="app">
    <div class="menu-mobile menu-mobile--js d-lg-none">
        <div class=" toggle-menu-mobile toggle-menu-mobile_my toggle-menu-mobile--js">
            <span></span>
        </div>
        <div class="menu-mobile__inner">
            <div class="dropdown">
                <lang-button :mobile="true" active="active"></lang-button>
            </div>
        </div>
    </div>
    <div class="main-wrapper">
        @yield('content')
        <map-block></map-block>
        <div class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-auto order-md-last d-none d-lg-block">
                        <div class="dropdown dropdown--js">
                            <div class="dropdown__toggle dropdown__toggle_my" v-cloak>
                                <svg class="icon icon-menu ">
                                    <use xlink:href="/img/svg/sprite.svg#menu"></use>
                                </svg>
                            </div>
                            <lang-button active=""></lang-button>
                        </div>
                    </div>
                    <div class="col-lg-auto">
                        <div class="search-block">
                            <div class=" toggle-menu-mobile_my toggle-menu-mobile toggle-menu-mobile--js d-lg-none">
                                <span> </span>
                            </div>
                            <span class="search-block__title" id="searchTitleDescop">
                                    <router-link style="color: #fff;text-decoration: none;" to="/"  @click.native="clickRouterLinkActive" >
                                         wikirent.info
                                    </router-link>
                            </span>
                            <search-block v-cloak></search-block>
                        </div>
                    </div>
                    <login-block ></login-block>
                </div>
            </div>
        </div>
        <registrar-block></registrar-block>
        <router-view></router-view>
        <footer class="footer block-with-lazy">
            <div class="container-fluid">
                <div class="row">
                    <geolocation-my></geolocation-my>
                    <div class="footer__col col">
                        © Bethoven.Digital @php echo date('Y'); @endphp
                    </div>
                    <div class="footer__col col-auto">
                        <a class="footer__link" href="#">
                            <svg class="icon icon-share ">
                                <use xlink:href="/img/svg/sprite.svg#share"></use>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

</div>


{{-- Global configuration object --}}
<script>
    window.config = @json($config);
</script>

<script src="/libs/jquery/jquery.min.js"></script>
<script src="/libs/picturefill/picturefill.min.js"></script>
<script src="/libs/object-fit-images/ofi.min.js"></script>
<script src="/libs/@fancyapps/fancybox/jquery.fancybox.min.js"></script>
<script src="/libs/swiper/js/swiper.min.js"></script>
<script src="/libs/svg4everybody/svg4everybody.min.js"></script>

<script defer src="{{ asset('dist/js/app.js') }}"></script>

</body>
</html>
