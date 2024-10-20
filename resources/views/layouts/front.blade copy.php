<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="/css/swiper-bundle.min.css" />
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <div class="modal fade" id="recall" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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

                            <input type="text" class="form-control" name="name" id="callback-name">
                            <div style="font-size: 14px;color: white;" id="callback-name-error">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tel" class="col-sm-3 col-form-label">Телефон</label>
                            <input type="text" class="form-control" name="phone" id="callback-phone">
                            <div style="font-size: 14px;color: white;" id="callback-phone-error">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sms" class="col-sm-3 col-form-label">Сообщение</label>
                            <textarea class="form-control" id="callback-message" name="message" rows="3"></textarea>
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
                                    <a href="#" class="btn_call btn" data-toggle="modal"
                                        data-target="#recall">Перезвоните
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
                                                <img src="/images/menu/compressors-air.png" alt="">
                                            </span>
                                            <span class="nav_menu_names">Винтовые компрессоры</span>
                                        </a>
                                        {{-- <a href="#"> --}}
                                        {{-- <span class="nav_menu_icons"> --}}
                                        {{-- <img src="/images/menu/2.svg" alt=""> --}}
                                        {{-- </span> --}}
                                        {{-- <span class="nav_menu_names">Поршневые компрессоры</span> --}}
                                        {{-- </a> --}}
                                        {{-- <a href="#"> --}}
                                        {{-- <span class="nav_menu_icons"> --}}
                                        {{-- <img src="/images/menu/3.svg" alt=""> --}}
                                        {{-- </span> --}}
                                        {{-- <span class="nav_menu_names">Ресиверы</span> --}}
                                        {{-- </a> --}}
                                        {{-- <a href="#"> --}}
                                        {{-- <span class="nav_menu_icons"> --}}
                                        {{-- <img src="/images/menu/4.svg" alt=""> --}}
                                        {{-- </span> --}}
                                        {{-- <span class="nav_menu_names">Осушители</span> --}}
                                        {{-- </a> --}}
                                        {{-- <a href="#"> --}}
                                        {{-- <span class="nav_menu_icons"> --}}
                                        {{-- <img src="/images/menu/5.svg" alt=""> --}}
                                        {{-- </span> --}}
                                        {{-- <span class="nav_menu_names">Магистральные фильтры</span> --}}
                                        {{-- </a> --}}
                                        {{-- <a href="#"> --}}
                                        {{-- <span class="nav_menu_icons"> --}}
                                        {{-- <img src="/images/menu/6.svg" alt=""> --}}
                                        {{-- </span> --}}
                                        {{-- <span class="nav_menu_names">Панельные фильтры</span> --}}
                                        {{-- </a> --}}
                                        {{-- <a href="#"> --}}
                                        {{-- <span class="nav_menu_icons"> --}}
                                        {{-- <img src="/images/menu/7.svg" alt=""> --}}
                                        {{-- </span> --}}
                                        {{-- <span class="nav_menu_names">Воздушные фильтры</span> --}}
                                        {{-- </a> --}}
                                        {{-- <a href="#"> --}}
                                        {{-- <span class="nav_menu_icons"> --}}
                                        {{-- <img src="/images/menu/8.svg" alt=""> --}}
                                        {{-- </span> --}}
                                        {{-- <span class="nav_menu_names">Масляные фильтры</span> --}}
                                        {{-- </a> --}}
                                        {{-- <a href="#"> --}}
                                        {{-- <span class="nav_menu_icons"> --}}
                                        {{-- <img src="/images/menu/9.svg" alt=""> --}}
                                        {{-- </span> --}}
                                        {{-- <span class="nav_menu_names">Сепараторы</span> --}}
                                        {{-- </a> --}}
                                        {{-- <a href="#"> --}}
                                        {{-- <span class="nav_menu_icons"> --}}
                                        {{-- <img src="/images/menu/10.svg" alt=""> --}}
                                        {{-- </span> --}}
                                        {{-- <span class="nav_menu_names">Компрессорное масло</span> --}}
                                        {{-- </a> --}}
                                        {{-- <a href="#"> --}}
                                        {{-- <span class="nav_menu_icons"> --}}
                                        {{-- <img src="/images/menu/11.svg" alt=""> --}}
                                        {{-- </span> --}}
                                        {{-- <span class="nav_menu_names">Ремни приводные</span> --}}
                                        {{-- </a> --}}
                                        {{-- <a href="#"> --}}
                                        {{-- <span class="nav_menu_icons"> --}}
                                        {{-- <img src="/images/menu/12.svg" alt=""> --}}
                                        {{-- </span> --}}
                                        {{-- <span class="nav_menu_names">Реле давления (кондоры)</span> --}}
                                        {{-- </a> --}}
                                        {{-- <a href="#"> --}}
                                        {{-- <span class="nav_menu_icons"> --}}
                                        {{-- <img src="/images/menu/13.svg" alt=""> --}}
                                        {{-- </span> --}}
                                        {{-- <span class="nav_menu_names">Винтовые блоки</span> --}}
                                        {{-- </a> --}}
                                        {{-- <a href="#"> --}}
                                        {{-- <span class="nav_menu_icons"> --}}
                                        {{-- <img src="/images/menu/14.svg" alt=""> --}}
                                        {{-- </span> --}}
                                        {{-- <span class="nav_menu_names">Сальники винтового блока</span> --}}
                                        {{-- </a> --}}
                                        {{-- <a href="#"> --}}
                                        {{-- <span class="nav_menu_icons"> --}}
                                        {{-- <img src="/images/menu/15.svg" alt=""> --}}
                                        {{-- </span> --}}
                                        {{-- <span class="nav_menu_names">Втулки винтового блока</span> --}}
                                        {{-- </a> --}}
                                        {{-- <a href="#"> --}}
                                        {{-- <span class="nav_menu_icons"> --}}
                                        {{-- <img src="/images/menu/16.svg" alt=""> --}}
                                        {{-- </span> --}}
                                        {{-- <span class="nav_menu_names">Клапаны для компрессора</span> --}}
                                        {{-- </a> --}}
                                        {{-- <a href="#"> --}}
                                        {{-- <span class="nav_menu_icons"> --}}
                                        {{-- <img src="/images/menu/17.svg" alt=""> --}}
                                        {{-- </span> --}}
                                        {{-- <span class="nav_menu_names">Подшипники</span> --}}
                                        {{-- </a> --}}
                                        {{-- <a href="#"> --}}
                                        {{-- <span class="nav_menu_icons"> --}}
                                        {{-- <img src="/images/menu/18.svg" alt=""> --}}
                                        {{-- </span> --}}
                                        {{-- <span class="nav_menu_names">Лопатки компрессора</span> --}}
                                        {{-- </a> --}}

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
                                                <img src="/images/menu/{{ $category->slug }}.png"
                                                    alt="{{ $category->name }}" class="svg1">
                                            </span>
                                            <span class="nav_menu_names">{{ $category->name }}</span>
                                        </a>
                                        @endforeach
                                        {{-- <a href="#"> --}}
                                        {{-- <span class="nav_menu_icons"> --}}
                                        {{-- <img src="/images/menu/2.svg" alt=""> --}}
                                        {{-- </span> --}}
                                        {{-- <span class="nav_menu_names">Поршневые компрессоры</span> --}}
                                        {{-- </a> --}}
                                        {{-- <a href="#"> --}}
                                        {{-- <span class="nav_menu_icons"> --}}
                                        {{-- <img src="/images/menu/3.svg" alt=""> --}}
                                        {{-- </span> --}}
                                        {{-- <span class="nav_menu_names">Ресиверы</span> --}}
                                        {{-- </a> --}}
                                        {{-- <a href="#"> --}}
                                        {{-- <span class="nav_menu_icons"> --}}
                                        {{-- <img src="/images/menu/4.svg" alt=""> --}}
                                        {{-- </span> --}}
                                        {{-- <span class="nav_menu_names">Осушители</span> --}}
                                        {{-- </a> --}}
                                        {{-- <a href="#"> --}}
                                        {{-- <span class="nav_menu_icons"> --}}
                                        {{-- <img src="/images/menu/5.svg" alt=""> --}}
                                        {{-- </span> --}}
                                        {{-- <span class="nav_menu_names">Магистральные фильтры</span> --}}
                                        {{-- </a> --}}
                                        {{-- <a href="#"> --}}
                                        {{-- <span class="nav_menu_icons"> --}}
                                        {{-- <img src="/images/menu/6.svg" alt=""> --}}
                                        {{-- </span> --}}
                                        {{-- <span class="nav_menu_names">Панельные фильтры</span> --}}
                                        {{-- </a> --}}
                                        {{-- <a href="#"> --}}
                                        {{-- <span class="nav_menu_icons"> --}}
                                        {{-- <img src="/images/menu/7.svg" alt=""> --}}
                                        {{-- </span> --}}
                                        {{-- <span class="nav_menu_names">Воздушные фильтры</span> --}}
                                        {{-- </a> --}}
                                        {{-- <a href="#"> --}}
                                        {{-- <span class="nav_menu_icons"> --}}
                                        {{-- <img src="/images/menu/8.svg" alt=""> --}}
                                        {{-- </span> --}}
                                        {{-- <span class="nav_menu_names">Масляные фильтры</span> --}}
                                        {{-- </a> --}}
                                        {{-- <a href="#"> --}}
                                        {{-- <span class="nav_menu_icons"> --}}
                                        {{-- <img src="/images/menu/9.svg" alt=""> --}}
                                        {{-- </span> --}}
                                        {{-- <span class="nav_menu_names">Сепараторы</span> --}}
                                        {{-- </a> --}}
                                        {{-- <a href="#"> --}}
                                        {{-- <span class="nav_menu_icons"> --}}
                                        {{-- <img src="/images/menu/10.svg" alt=""> --}}
                                        {{-- </span> --}}
                                        {{-- <span class="nav_menu_names">Компрессорное масло</span> --}}
                                        {{-- </a> --}}
                                        {{-- <a href="#"> --}}
                                        {{-- <span class="nav_menu_icons"> --}}
                                        {{-- <img src="/images/menu/11.svg" alt=""> --}}
                                        {{-- </span> --}}
                                        {{-- <span class="nav_menu_names">Ремни приводные</span> --}}
                                        {{-- </a> --}}
                                        {{-- <a href="#"> --}}
                                        {{-- <span class="nav_menu_icons"> --}}
                                        {{-- <img src="/images/menu/12.svg" alt=""> --}}
                                        {{-- </span> --}}
                                        {{-- <span class="nav_menu_names">Реле давления (кондоры)</span> --}}
                                        {{-- </a> --}}
                                        {{-- <a href="#"> --}}
                                        {{-- <span class="nav_menu_icons"> --}}
                                        {{-- <img src="/images/menu/13.svg" alt=""> --}}
                                        {{-- </span> --}}
                                        {{-- <span class="nav_menu_names">Винтовые блоки</span> --}}
                                        {{-- </a> --}}
                                        {{-- <a href="#"> --}}
                                        {{-- <span class="nav_menu_icons"> --}}
                                        {{-- <img src="/images/menu/14.svg" alt=""> --}}
                                        {{-- </span> --}}
                                        {{-- <span class="nav_menu_names">Сальники винтового блока</span> --}}
                                        {{-- </a> --}}
                                        {{-- <a href="#"> --}}
                                        {{-- <span class="nav_menu_icons"> --}}
                                        {{-- <img src="/images/menu/15.svg" alt=""> --}}
                                        {{-- </span> --}}
                                        {{-- <span class="nav_menu_names">Втулки винтового блока</span> --}}
                                        {{-- </a> --}}
                                        {{-- <a href="#"> --}}
                                        {{-- <span class="nav_menu_icons"> --}}
                                        {{-- <img src="/images/menu/16.svg" alt=""> --}}
                                        {{-- </span> --}}
                                        {{-- <span class="nav_menu_names">Клапаны для компрессора</span> --}}
                                        {{-- </a> --}}
                                        {{-- <a href="#"> --}}
                                        {{-- <span class="nav_menu_icons"> --}}
                                        {{-- <img src="/images/menu/17.svg" alt=""> --}}
                                        {{-- </span> --}}
                                        {{-- <span class="nav_menu_names">Подшипники</span> --}}
                                        {{-- </a> --}}
                                        {{-- <a href="#"> --}}
                                        {{-- <span class="nav_menu_icons"> --}}
                                        {{-- <img src="/images/menu/18.svg" alt=""> --}}
                                        {{-- </span> --}}
                                        {{-- <span class="nav_menu_names">Лопатки компрессора</span> --}}
                                        {{-- </a> --}}

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
                                <span class="span_mail">e-mail:</span> <a
                                    href="mailto:sales@airsystem.ru"><span>sales@airsystem.ru</span></a>
                            </p>
                        </div>
                        <div class="callback">
                            <p>
                                <a href="#" class="btn_call btn" data-toggle="modal"
                                    data-target="#recall">Перезвоните
                                    мне</a>
                            </p>
                        </div>
                        <form method="get" action="/search" class="search">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </span>
                                    <button type="submit" class="btn btn-search-input">Найти</button>
                                </div>
                                <input id="query" name="query" type="text" class="form-control"
                                    placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                        </form>
                        <div class="lk_icon">
                            <form id="cart-upload-form" method="post" action="{{ route('cart.upload') }}"
                                enctype="multipart/form-data" style="display: none;">
                                @csrf
                                <input name="cart" onchange="form.submit()" type="file" name="avatar"
                                    accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                            </form>
                            <a href="#">
                                <img src="/images/star.png" alt="">
                            </a>
                            <a id="cart-upload" href="#">
                                <img src="/images/upload.png" alt="">
                            </a>
                            <a href="{{ route('cart.download') }}"
                                {{ session()->has('cart') && !count(session()->get('cart')) ?? 'style="pointer-events: none;"' }}">
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
        @if (false)
        <section id="sliders">
            <div class="container">
                <div class="row">
                    <div class="swiper second-swiper">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <div class="swiper-slide">
                                <img src="/images/slider.png" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img src="/images/slider.png" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img src="/images/slider.png" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img src="/images/slider.png" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img src="/images/slider.png" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img src="/images/slider.png" alt="">
                            </div>

                        </div>
                        <!-- If we need pagination -->
                        <div class="swiper-pagination"></div>

                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>

                        <!-- If we need scrollbar -->
                        <div class="swiper-scrollbar"></div>

                    </div>
                </div>
                <div class="row">
                    <div class="pags text-center"></div>
                </div>
            </div>
        </section>
        @endif
        @if (false)
        <section id="main-text">
            <div class="container">
                <div class="main_text">
                    <div class="row">
                        <h1 class="main_h1 ">
                            Сертификат Системы менеджмента качества
                            Удостоверение №01-13-9101-01 Федеральной службы
                            по экологическому, техническому и атомному надзору.
                        </h1>
                        <p class="main_text_p">
                            Мы находимся в постоянном поиске оптимальных решений для наших клиентов.
                            Квалифицированная
                            диагностика позволяет ремонтировать сломавшуюся деталь, а не менять блок целиком. Мы
                            ищем
                            запчасти и расходные материалы не уступающие оригинальным запчастям производителя
                            оборудования,
                            но выигрывающие по цене. Постоянно следим за новинками рынка компрессорного оборудования
                            и
                            предлагаем нашим покупателям оптимальные по цене/качеству образцы.
                            Главным критерием в современном быстро меняющемся мире для нас является практика.
                            Наработанный
                            опыт позволяет нашим специалистам принимать верные решения в сложны ситуациях как в
                            случае
                            ремонта так и при подборе оборудования.
                        </p>
                        <p class="main_text_p">Вы можете позвонить нашим специалистам с самым сложным вопросом, мы
                            постараемся помочь.</p>
                        <p class="main_text_p">
                            Компания “Пневмосистема” имеет сертификат Системы менежмента качества ГОСТ ISO 9001-2011
                            (ISO
                            9001:2008) и Удостоверение №01-13-9101-01 Федеральной службы по экологическому,
                            техническому
                            и
                            атомному надзору.
                        </p>
                    </div>
                    <div class="row row_top">
                        <div class="col-md-6 col-6 main_text_bottom">
                            <h1 class="main_h1 index_h1">
                                Сертификат Системы менеджмента качества
                            </h1>
                            <p class="main_text_p">
                                Мы находимся в постоянном поиске оптимальных решений для наших клиентов.
                                Квалифицированная
                                диагностика позволяет ремонтировать сломавшуюся деталь, а не менять блок целиком. Мы
                                ищем
                                запчасти и расходные материалы не уступающие оригинальным запчастям производителя
                                оборудования, но выигрывающие по цене. Постоянно следим за новинками рынка
                                компрессорного
                                оборудования и предлагаем нашим покупателям оптимальные по цене/качеству образцы.

                            </p>
                        </div>
                        <div class="col-md-6 col-6 main_text_bottom">
                            <h1 class="main_h1 index_h1">
                                Удостоверение Федеральной службы
                            </h1>
                            <p class="main_text_p">
                                Главным критерием в современном быстро меняющемся мире для нас является практика.
                                Наработанный опыт позволяет нашим специалистам принимать верные решения в сложны
                                ситуациях
                                как в случае ремонта так и при подборе оборудования.

                            </p>
                            <div class="main_text_p">
                                Вы можете позвонить нашим специалистам с самым сложным вопросом, мы постараемся
                                помочь.

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif

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
    <script src="/js/vendor/bootstrap.min.js"></script>
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
                $('.page').css('transfohttp://7391335.ru/service-and-repairrm', "scale(" + ($('body').width() /
                    400) + ")");
                $('.logo').attr('src', '/images/logo-mob.png');
                //$('.page').css('transform',"scale(1)");
                $('.swiper-slide-active img').attr('src', "{{asset{'images/slider-mob-1.png')}}");

            } else {
                $('.page').css('transform', "scale(" + ($('body').width() / 1440) + ")");
                $('.logo').attr('src', '/images/logo.png');

            }
        });
        $(document).ready(function() {

            $('#cart-upload').click(function(e) {
                e.preventDefault();
                const form = $('#cart-upload-form');
                const input = form.find('input[type=file]');
                input.click();
            });

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


            new Swiper(".second-swiper", {
                // НЕ ЗАБЫТЬ НАСТРОИТЬ СЛАЙДЕРЫ swiper - это слайдер на главной
                loop: true,
                autoplay: {
                    delay: 5000,
                },
                autoHeight: true,
                speed: 400,
                spaceBetween: 100,
                pagination: {
                    el: '.swiper-pagination',
                },
                navigation: {
                    nextEl: ".second-swiper-next",
                    prevEl: ".second-swiper-prev",
                },
                scrollbar: {
                    el: '.swiper-scrollbar',
                },
                breakpoints: {
                    // when window width is >= 320px
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