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
                                @foreach (\App\Models\Category::parentGet()->where('published', true)->get() as $category)
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
                </nav>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto mt-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="mobile-menu-button">
                                <span>Каталог</span>
                                запчасти и компрессоры
                            </a>
                            <nav class="nav_menu">
                                @foreach (\App\Models\Category::parentGet()->where('published', true)->get() as $category)
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
                <div class="d-flex lk_icon">
                    <form id="cart-upload-form" method="post" action="{{ route('cart.upload') }}"
                        enctype="multipart/form-data" style="display: none;">
                        @csrf
                        <input name="cart" onchange="form.submit()" type="file" name="avatar"
                            accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                    </form>
                    <div class="custom-control custom-switch d-none">
                        <input type="checkbox" class="custom-control-input" id="css-toggle">
                        <label class="custom-control-label" for="css-toggle"></label>
                    </div>
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
