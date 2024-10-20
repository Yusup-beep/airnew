<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="{{ strip_tags($category->description) }}" />
    <meta name="keywords" content="{{ $category->keywords }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
    <link rel="stylesheet" href="/css/style.css">

</head>

<body>
    <div class="modal fade" id="recall" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Заказать звонок</h5>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button> -->
                </div>
                <div class="modal-body">
                    <form id="callback-form">
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Ваше имя</label>

                            <input type="text" class="form-control"
                                name="name"
                                id="callback-name">
                            <div style="font-size: 14px;color: white;" id="callback-name-error">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tel" class="col-sm-3 col-form-label">Телефон</label>
                            <input type="text" class="form-control"
                                name="phone"
                                id="callback-phone">
                            <div style="font-size: 14px;color: white;" id="callback-phone-error">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sms" class="col-sm-3 col-form-label">Сообщение</label>
                            <textarea class="form-control" id="callback-message"
                                name="message"
                                rows="3"></textarea>
                            <div style="font-size: 14px;color: white;" id="callback-message-error">

                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" id="order_call">Заказать</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="page">
        <section id="top-menu">
            <div class="top_menu">
                <ul class="nav top_menu_nav justify-content-center">
                    <li class="nav-item"><a href="#" class="nav-link top_menu_link">Сертификаты, лицензии</a></li>
                    <li class="nav-item"><a href="#" class="nav-link top_menu_link">Как проехать в офис</a></li>
                    <li class="nav-item"><a href="#" class="nav-link top_menu_link">Доставка</a></li>
                    <li class="nav-item"><a href="#" class="nav-link spec_top_link">Подобрать фильтр</a></li>
                    <li class="nav-item"><a href="#" class="nav-link spec_top_link sal">Подобрать сальник</a></li>
                    <div class="carts mt-2 my-lg-0 cart_mob">
                        <p class="p_order text-center">
                            <a href="{{ route('pages.cart') }}"><span class="myord">Мой заказ</span><span
                                    class="num_cart">{{ \Illuminate\Support\Facades\App::make(\App\Services\CartService::class)->get()->count() }}</span></a>
                        </p>
                        <a href="#" class="btn cart_button my-sm-0" type="submit">Заказать</a>
                    </div>
                    <li class="burger" id="burder-open">
                        <a href="#">
                            <img src="/images/menu/menu.svg" alt="">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="main_menu">
                <div class="container">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="/">
                            <img src="/images/logo.png" class="logo" alt="">
                        </a>
                        <div class="menu_mob">
                            <div class="lk_icon_mob">
                                <a href="#">
                                    <img src="/images/star.png" alt="">
                                </a>
                                <a href="#">
                                    <img src="/images/upload.png" alt="">
                                </a>
                                <a href="#">
                                    <img src="/images/download.png" alt="">
                                </a>
                            </div>
                            <div class="callback_mob">
                                <p>
                                    <a href="#" class="btn_call btn" data-toggle="modal" data-target="#recall">Перезвоните
                                        мне</a>
                                </p>
                            </div>
                            <div class="search_mob">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="" aria-label="Username"
                                        aria-describedby="basic-addon1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>-->
                        <nav class="navbar-mob">
                            <ul class="navbar-mob-ul">
                                <li class="nav-item">
                                    <a class="nav-link" href="#" id='open-catalog-mob'>
                                        <span>Каталог</span>
                                        запчасти и компрессоры
                                    </a>
                                    <nav class="navbar-mob-menu">

                                        <a href="#">
                                            <span class="nav_menu_icons">
                                                <img src="/images/menu/1.svg" alt="">
                                            </span>
                                            <span class="nav_menu_names">Винтовые компрессоры</span>
                                        </a>
                                    </nav>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('pages.project') }}">
                                        <span>Проектирование</span>
                                        компрессорной станции
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('pages.montazh') }}">
                                        <span>Монтаж</span>
                                        пневмосетей
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('pages.service') }}">
                                        <span>Сервис и ремонт</span>
                                        компрессоров и осушителей
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('pages.rent') }}">
                                        <span>Аренда</span>
                                        промышленного компрессора
                                    </a>
                                </li>
                            </ul>
                        </nav>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto mt-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="#" id="mobile-menu-button">
                                        <span>Каталог</span>
                                        запчасти и компрессоры
                                    </a>
                                    <nav class="nav_menu">
                                        @foreach (\App\Models\Category::parentGet()->get() as $category)
                                            <a href="{{ route('catalog.id', $category->slug) }}">
                                                <span class="nav_menu_icons">
                                                    <img src="{{ $category->image_path }}"
                                                        alt="{{ $category->name }}" class="svg1">
                                                </span>
                                                <span class="nav_menu_names">{{ $category->name }}</span>
                                            </a>
                                        @endforeach
                                    </nav>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('pages.project') }}">
                                        <span>Проектирование</span>
                                        компрессорной станции
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('pages.montazh') }}">
                                        <span>Монтаж</span>
                                        пневмосетей
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('pages.service') }}">
                                        <span>Сервис и ремонт</span>
                                        компрессоров и осушителей
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('pages.rent') }}">
                                        <span>Аренда</span>
                                        промышленного компрессора
                                    </a>
                                </li>
                            </ul>

                            <div class="carts my-2 my-lg-0">
                                <p class="p_order text-center">
                                    Мой заказ <a href="{{ route('pages.cart') }}"><span
                                            class="num_cart">{{ \Illuminate\Support\Facades\App::make(\App\Services\CartService::class)->get()->count() }}</span></a>
                                </p>
                                <a href="{{ route('pages.cart') }}" class="btn cart_button my-sm-0"
                                    type="submit">Заказать</a>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="menu_bottom">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="budni">
                            <p class="budni_text">08:00 – 17:00 </p>
                            <p class="budni_text_icon">
                                <i class="fa fa-square" aria-hidden="true"></i>
                                <i class="fa fa-square" aria-hidden="true"></i>
                                <i class="fa fa-square" aria-hidden="true"></i>
                                <i class="fa fa-square" aria-hidden="true"></i>
                                <i class="fa fa-square" aria-hidden="true"></i>
                                <i class="fa fa-square-o" aria-hidden="true"></i>
                                <i class="fa fa-square-o" aria-hidden="true"></i>
                            </p>
                        </div>
                        <div class="qr">
                            <img src="/images/qr.png" alt="">

                        </div>
                        <div class="tel">
                            <p class="p_tel">
                                <img src="/images/menu/tel_mob.svg" alt="" class="tel_mob">
                                <a href="tel:+7-495-649-0987" class="link-tel">+7 495 649-0-987</a>
                            </p>
                            <p class="p_tel">
                                <img src="/images/menu/mail_mob.svg" alt="" class="mail_mob">
                                <span class="span_mail">e-mail:</span> <a href="mailto:sales@airsystem.ru"><span>sales@airsystem.ru</span></a>
                            </p>
                        </div>
                        <div class="callback">
                            <p>
                                <a href="#" class="btn_call btn" data-toggle="modal" data-target="#recall">Перезвоните
                                    мне</a>
                            </p>
                        </div>
                        <div class="search">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" placeholder="" aria-label="Username"
                                    aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="lk_icon">
                            <a href="#">
                                <img src="/images/star.png" alt="">
                            </a>
                            <a href="#">
                                <img src="/images/upload.png" alt="">
                            </a>
                            <a href="#">
                                <img src="/images/download.png" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="container">
            @yield('content')
        </div>

        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="footer_left">
                            <img src="/images/qr_footer.png" alt="logo">
                            <div class="footer_left_text">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <p><span>Положение на карте</span></p>
                                <p>107241, Москва,<br> Черницынский проезд 3</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="footer_center">
                            <p>
                                <span>© Компания Пневмосистема 2002—2023</span>
                                Все материалы сайта защищены, использование без письменного разрешения правообладателей
                                приведёт к судебному преследованию.
                                Сайт не хранит персональные данные клиентов.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="footer_right">
                            <p>
                                © дизайн NIYA, 2023
                                <a href="#"><img src="/images/niya.png" alt=""></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="/js/vendor/jquery-1.11.2.min.js"></script>
    <script src="/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="/js/vendor/swiper-bundle.min.js"></script>
    <script src="/js/vendor/jquery.validate.min.js"></script>
    <script>
        // callback
        document.addEventListener('DOMContentLoaded', () => {
            const callbackForm = document.getElementById('callback-form');
            const callbackName = document.getElementById('callback-name');
            const callbackPhone = document.getElementById('callback-phone');
            const callbackMessage = document.getElementById('callback-message');
            const callbackNameErr = document.getElementById('callback-name-error');
            const callbackPhoneErr = document.getElementById('callback-phone-error');
            const callbackMessageErr = document.getElementById('callback-message-error');

            callbackForm.addEventListener('submit', e => {
                e.preventDefault();
                callbackName.style.border = '';
                callbackPhone.style.border = '';
                callbackMessage.style.border = '';

                $.ajax({
                    url: "/api/callback",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: callbackName.value,
                        phone: callbackPhone.value,
                        message: callbackMessage.value,
                    },
                    xhrFields: {
                        withCredentials: true
                    },
                    success: function() {
                        const recallDialog = document.getElementById('recall');
                        recallDialog.classList.remove('show');

                        callbackName.value = '';
                        callbackPhone.value = '';
                        callbackMessage.value = '';
                    },
                    error: function(err) {
                        const errors = err.responseJSON.errors;
                        if (errors.name) {
                            callbackName.style.border = '1px solid red';
                        }
                        if (errors.phone) {
                            callbackPhone.style.border = '1px solid red';
                        }
                        if (errors.message) {
                            callbackMessage.style.border = '1px solid red';
                        }
                    },
                });
            });
        });
        // end callback

        $(window).on("load resize", function(e) {
            if (window.matchMedia('(max-width: 720px)').matches) {
                $('.page').css('transform', "scale(" + ($('body').width() / 400) + ")");
                $('.logo').attr('src', '/images/logo-mob.png');
                //$('.page').css('transform',"scale(1)");
                $('.swiper-slide-active img').attr('src', "{{asset{'images/slider-mob-1.png')}}");

            } else {
                $('.page').css('transform', "scale(" + ($('body').width() / 1440) + ")");
                $('.logo').attr('src', '/images/logo.png');

            }
        });
        $(document).ready(function() {
            $('[data-toggle="popover"]').popover()

            $(".project_item").each(function() {
                let more = $(this).find(".show_link > .show_link_span");
                let hide = $(this).find(".project_item_text_hide");
                hide.hide();
                more.click(function(e) {
                    e.preventDefault();
                    hide.slideToggle(500);
                    more.text(more.text() == "скрыть" ? "подробнее" : "скрыть");
                    $('.project_item_text').height("auto");
                });
            });


            $('#mobile-menu-button').on('click', function(event) {
                event.preventDefault();
                $(this).toggleClass('active_menu');
                $('.nav_menu').slideToggle("fast");
                $('.swiper-slide img').toggleClass('blur_img_slider');
            });

            $('#burder-open').on('click', function(event) {
                event.preventDefault();
                $('.navbar-mob').slideToggle("fast");
            });

            $('#open-catalog-mob').on('click', function(event) {
                event.preventDefault();
                $('.navbar-mob-menu').slideToggle("active_mob_menu");
            });
            $('.accord_item').on('click', function() {
                $('.accord_item').removeClass('active');
                $(this).addClass('active');
                $('.cats_right').html($(this).find('.cats_item').html())
                $('.cats_right').show();
            })
            $('.accord_item').eq(0).click();


            //Настройки для слайдера с сальниками
            new Swiper(".first-swiper", {
                slidesPerView: 7,
                spaceBetween: 25,
                loop: false,
                speed: 400,
                navigation: {
                    nextEl: ".first-swiper-next",
                    prevEl: ".first-swiper-prev",
                },
                breakpoints: {
                    // when window width is >= 320px
                    300: {
                        slidesPerView: 2,
                        spaceBetween: 30,

                    },
                    700: {
                        slidesPerView: 3,
                    },
                    1000: {
                        slidesPerView: 7,
                    }
                },
            });

            new Swiper(".second-swiper", {
                loop: true,
                autoplay: {
                    delay: 5000,
                },
                autoHeight: true,
                speed: 400,
                spaceBetween: 100,
                navigation: {
                    nextEl: ".second-swiper-next",
                    prevEl: ".second-swiper-prev",
                },
                breakpoints: {
                    390: {
                        height: 480,
                    },
                },
            });

        }); //end
    </script>

    @yield('scripts')
</body>

</html>
