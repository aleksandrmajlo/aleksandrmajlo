var JSCCommon = {
    btnToggleMenuMobile: [].slice.call(document.querySelectorAll(".toggle-menu-mobile--js")),
    menuMobile: document.querySelector(".menu-mobile--js"),
    menuMobileLink: [].slice.call(document.querySelectorAll(".menu-mobile--js ul li a")),
    body: document.querySelector("body"),
    modalCall: function modalCall() {
        $(".link-modal").fancybox({
            arrows: false,
            infobar: false,
            touch: false,
            type: 'inline',
            i18n: {
                en: {
                    CLOSE: "Закрыть",
                    NEXT: "Вперед",
                    PREV: "Назад" // PLAY_START: "Start slideshow",
                    // PLAY_STOP: "Pause slideshow",
                    // FULL_SCREEN: "Full screen",
                    // THUMBS: "Thumbnails",
                    // DOWNLOAD: "Download",
                    // SHARE: "Share",
                    // ZOOM: "Zoom"

                }
            }
        });
        $(".modal-close-js").click(function () {
            $.fancybox.close();
        });
    },
    toggleMenu: function toggleMenu() {
        var _this = this;

        _this.btnToggleMenuMobile.forEach(function (element) {
            element.addEventListener('click', function () {
                _this.btnToggleMenuMobile.forEach(function (element) {
                    element.classList.toggle("on");
                });

                _this.menuMobile.classList.toggle("active");

                _this.body.classList.toggle("fixed");

                return false;
            });
        });
    },

    closeMenu: function closeMenu() {
        // var _this = this;
        // _this.btnToggleMenuMobile.forEach(function (element) {
        // element.classList.remove("on");
        // });
        // _this.menuMobile.classList.remove("active");
        // _this.body.classList.remove("fixed");

    },

    mobileMenu: function mobileMenu() {
        var _this = this;
        _this.toggleMenu();
        _this.menuMobileLink.forEach(function (element) {
            element.addEventListener('click', function (e) {
                _this.closeMenu();
            });
        });
        document.addEventListener('mouseup', function (event) {
            var container = event.target.closest(".menu-mobile--js.active"); // (1)
            if (!container) {
                _this.closeMenu();
            }
        });
    },
    // табы  .
    tabscostume: function tabscostume(tab) {
        $('.' + tab + '__caption').on('click', '.' + tab + '__btn:not(.active)', function (e) {
            $(this).addClass('active').siblings().removeClass('active').closest('.' + tab).find('.' + tab + '__content').hide().removeClass('active').eq($(this).index()).show().addClass('active');
        });
    },

};

function eventHandler() {
    // полифил для object-fit
    objectFitImages(); // Picture element HTML5 shiv
    document.createElement("picture"); // для свг
    svg4everybody({});
    // JSCCommon.modalCall();
    JSCCommon.tabscostume('tabs');
    // JSCCommon.mobileMenu();
    $(".main-wrapper").after('<div class="screen" style="background-image: url(/screen/main.jpg);"></div>'); // /добавляет подложку для pixel perfect
    function heightses() {
        var w = $(window).width(); // $(".main-wrapper").css("margin-bottom", $('footer').height())
        var topH = $("header ").innerHeight();
        $(window).scroll(function () {
            if ($(window).scrollTop() > topH) {
                $('.top-nav  ').addClass('fixed');
            } else {
                $('.top-nav  ').removeClass('fixed');
            }
        }); // конец добавил

        if (window.matchMedia("(min-width: 992px)").matches) {
            JSCCommon.closeMenu();
        }
    }
    $(window).resize(function () {
        heightses();
    });
    heightses(); // листалка по стр
    $(" .top-nav li a, .scroll-link").click(function () {
        var elementClick = $(this).attr("href");
        var destination = $(elementClick).offset().top;
        $('html, body').animate({
            scrollTop: destination
        }, 1100);
        return false;
    });
    var swiper4 = new Swiper('.carusel--js', {
        slidesPerView: 3,
        spaceBetween: 15,
        loop: true // freeMode: true,

    });

    var isIE11 = !!window.MSInputMethodContext && !!document.documentMode;
    if (isIE11) {
        $("body").prepend("<p   class=\"browsehappy container\">\u041A \u0441\u043E\u0436\u0430\u043B\u0435\u043D\u0438\u044E, \u0432\u044B \u0438\u0441\u043F\u043E\u043B\u044C\u0437\u0443\u0435\u0442\u0435 \u0443\u0441\u0442\u0430\u0440\u0435\u0432\u0448\u0438\u0439 \u0431\u0440\u0430\u0443\u0437\u0435\u0440. \u041F\u043E\u0436\u0430\u043B\u0443\u0439\u0441\u0442\u0430, <a href=\"http://browsehappy.com/\" target=\"_blank\">\u043E\u0431\u043D\u043E\u0432\u0438\u0442\u0435 \u0432\u0430\u0448 \u0431\u0440\u0430\u0443\u0437\u0435\u0440</a>, \u0447\u0442\u043E\u0431\u044B \u0443\u043B\u0443\u0447\u0448\u0438\u0442\u044C \u043F\u0440\u043E\u0438\u0437\u0432\u043E\u0434\u0438\u0442\u0435\u043B\u044C\u043D\u043E\u0441\u0442\u044C, \u043A\u0430\u0447\u0435\u0441\u0442\u0432\u043E \u043E\u0442\u043E\u0431\u0440\u0430\u0436\u0430\u0435\u043C\u043E\u0433\u043E \u043C\u0430\u0442\u0435\u0440\u0438\u0430\u043B\u0430 \u0438 \u043F\u043E\u0432\u044B\u0441\u0438\u0442\u044C \u0431\u0435\u0437\u043E\u043F\u0430\u0441\u043D\u043E\u0441\u0442\u044C.</p>");
    }

    // $(".dropdown__toggle").click(function () {
    //     $(this).toggleClass('active').next().toggleClass("active");
    // });

    $(".search-block__btn--show-js").click(function () {
        $(".search-block__input-wrap").toggleClass("active");
    });

    $(document).mouseup(function (e) {
        var container = $(".search-block__input-wrap.active");
        if (container.has(e.target).length === 0) {
            container.removeClass("active");
        }
    });
    $(".accordion-item__toggle--js").click(function () {
        $(this).next().slideToggle(function () {
            $(this).parents(".accordion-item--js").toggleClass("active");
        });
    });
};
$(document).ready(function () {
    eventHandler();
});
