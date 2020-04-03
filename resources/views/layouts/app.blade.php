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
{{--    <link rel="stylesheet" href="{{ asset('libs/@fancyapps/fancybox/jquery.fancybox.min.css') }}"/>--}}
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;700&amp;display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('libs/dropzone/dropzone.css') }}"/>
    <link href="{{ asset('css/main.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="/libs/jquery/jquery.min.js"></script>
    <script src="/libs/picturefill/picturefill.min.js"></script>
    <script src="/libs/dropzone/dropzone.js"></script>
    <script src="/libs/object-fit-images/ofi.min.js"></script>
{{--    <script src="/libs/@fancyapps/fancybox/jquery.fancybox.min.js"></script>--}}
    <script src="/libs/swiper/js/swiper.min.js"></script>
    <script src="/libs/svg4everybody/svg4everybody.min.js"></script>

    <script src="{{ asset('js/app.js') }}" defer></script>

</head>
<body>
<div id="app">

    <div class="menu-mobile menu-mobile--js d-lg-none">
        <div class="toggle-menu-mobile toggle-menu-mobile--js">
            <span></span>
        </div>

        <div class="menu-mobile__inner">
            <div class="dropdown">
                <div class="dropdown__block dropdown__block--menu active">
                    <div class="menu-map">
                        <a class="menu-map__btn active" href="#">Yandex </a>
                        <a class="menu-map__btn" href="#">Google</a>
                        <a class="menu-map__btn" href="#">OpenStreet</a>
                    </div>
                    <p class="text-center text-primary">Выберите язык</p>
                    <div class="menu-lang">
                        <a class="menu-lang__btn" href="#">
                                <span class="menu-lang__img-wrap">
                                    <img src="/img/svg/Flag_of_Russia.svg" alt=""/>
                                </span>RU
                        </a>
                        <a class="menu-lang__btn" href="#">
                                <span class="menu-lang__img-wrap">
                                    <img src="/img/svg/Flag_of_Ukraine-98.svg" alt=""/>
                                </span>
                            UA
                        </a>
                        <a class="menu-lang__btn" href="#">
                                <span class="menu-lang__img-wrap">
                                    <img src="img/svg/Flag_of_the_United_Kingdom.svg" alt=""/>
                                </span>EN
                        </a>
                    </div>
                    <div class="dropdown__divider">
                    </div>
                    <div class="nav">
                        <a class="nav__link" href="#">
                                <span class="nav__icon-wrap">
							         <svg class="icon icon-speak ">
								       <use xlink:href="/img/svg/sprite.svg#speak"></use>
							         </svg>
                                </span>Сообщение</a>
                        <a class="nav__link" href="#">
                                <span class="nav__icon-wrap">
							       <svg class="icon icon-icon_feather-star ">
								      <use xlink:href="img/svg/sprite.svg#icon_feather-star"></use>
							       </svg>
                                </span>Избранное
                        </a>
                        <a class="nav__link" href="#">
                                <span class="nav__icon-wrap">
							       <svg class="icon icon-map_marker ">
								      <use xlink:href="/img/svg/sprite.svg#map_marker"></use>
							       </svg>
                                </span>Добавить объект
                        </a>
                    </div>
                    <div class="dropdown__divider">
                    </div>
                    <div class="nav text-center">
                        <a class="nav__link" href="#">Реклама в wikirent.info</a>
                        <a class="nav__link" href="#">Сообщить об ошибке</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-wrapper">
        @yield('content')
        <div id="map"></div>

        <div class="header">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-auto order-md-last d-none d-lg-block">
                        <div class="dropdown dropdown--js">
                            <div class="dropdown__toggle">
                                <svg class="icon icon-menu ">
                                    <use xlink:href="/img/svg/sprite.svg#menu"></use>
                                </svg>
                            </div>
                            <div class="dropdown__block dropdown__block--menu">
                                <div class="menu-map">
                                    <a class="menu-map__btn active" href="#">Yandex1 </a>
                                    <a class="menu-map__btn" href="#">Google</a>
                                    <a class="menu-map__btn" href="#">OpenStreet</a>
                                </div>
                                <p class="text-center text-primary">Выберите язык</p>
                                <div class="menu-lang">
                                    <a class="menu-lang__btn" href="#">
                                            <span class="menu-lang__img-wrap">
                                                <img src="/img/svg/Flag_of_Russia.svg" alt=""/></span>RU
                                    </a>
                                    <a class="menu-lang__btn" href="#">
                                            <span class="menu-lang__img-wrap">
                                                <img src="/img/svg/Flag_of_Ukraine-98.svg" alt=""/></span> UA
                                    </a>
                                    <a class="menu-lang__btn" href="#">
                                            <span class="menu-lang__img-wrap">
                                                <img src="/img/svg/Flag_of_the_United_Kingdom.svg" alt=""/></span>EN
                                    </a>
                                </div>
                                <div class="dropdown__divider">
                                </div>
                                <div class="nav">
                                    <a class="nav__link" href="#">
                                            <span class="nav__icon-wrap">
										        <svg class="icon icon-speak ">
											       <use xlink:href="/img/svg/sprite.svg#speak"></use>
										        </svg>
                                            </span>Сообщение
                                    </a>
                                    <a class="nav__link" href="#">
                                            <span class="nav__icon-wrap">
										        <svg class="icon icon-icon_feather-star ">
											       <use xlink:href="/img/svg/sprite.svg#icon_feather-star"></use>
										        </svg>
                                            </span>Избранное
                                    </a>
                                    <a class="nav__link" href="#">
                                            <span class="nav__icon-wrap">
										          <svg class="icon icon-map_marker ">
											        <use xlink:href="img/svg/sprite.svg#map_marker"></use>
										          </svg>
                                            </span>Добавить объект
                                    </a>
                                </div>
                                <div class="dropdown__divider">
                                </div>
                                <div class="nav text-center">
                                    <a class="nav__link" href="#">Реклама в wikirent.info</a>
                                    <a class="nav__link" href="#">Сообщить об ошибке</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-auto">
                        <form class="search-block">
                            <div class="toggle-menu-mobile toggle-menu-mobile--js d-lg-none">
                                <span> </span>
                            </div>

                                <span class="search-block__title">
                                    <router-link style="color: #fff;text-decoration: none;" to="/">
                                         wikirent.info
                                    </router-link>
                                </span>
                            </router-link>

                            <div class="search-block__input-wrap">
                                <input class="search-block__input" type="text"
                                       placeholder="начните вводить адрес"/>
                                <button class="search-block__btn" type="submit">
                                    <img src="/img/svg/search.svg" alt=""/>
                                </button>
                                <div class="search-block__dropdown">
                                    <div class="search-block__dropdown-title">недавние
                                    </div>
                                    <a class="search-block__dropdown-item" href="#">Lorem ipsum dolor sit amet.</a>
                                    <a class="search-block__dropdown-item" href="#">Lorem ipsum dolor sit amet.</a>
                                    <a class="search-block__dropdown-item" href="#">Lorem ipsum dolor sit amet.</a>
                                </div>
                            </div>
                            <button class="search-block__btn search-block__btn--show-js d-lg-none" type="button">
                                <img src="/img/svg/search.svg" alt=""/>
                            </button>
                        </form>
                    </div>
                    <div class="col d-none d-lg-block">
                        @if(Auth::check())
                            {{ dump(Auth::check()) }}
                        @else
                            <login-block></login-block>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <registrar-block></registrar-block>
        <div class="sidebarLeft sidebarLeft--main section container-fluid" id="sidebarLeft">
            <router-view ></router-view>
        </div>
        <footer class="footer block-with-lazy">
            <div class="container-fluid">
                <div class="row">
                    <div class="footer__col col-auto">
                        <a class="footer__link" href="#">
                            <img src="/img/svg/geolocation.svg" alt=""/>
                        </a>
                    </div>
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
</body>
</html>
