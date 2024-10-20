@extends('layouts.front')
@if ($category->name != '')
    @section('title')
        {{ $category->name }}
    @endsection
@endif
@section('content')
    <section id="cats">
        <div class="container">
            <div class="row">
                <div class="col-md-3">

                </div>
                <div class="col-md-6 p0">
                    <div class="cats">
                        <h2 class="cats_h2 vint_h2">{{ $category->name }}</h2>
                    </div>
                    <div class="cats_center">
                        @if ($category->slug == 'vintovye-kompressory')
                            <div class="accord">
                                <div class="accord_item accord_o">
                                    <h2 class="accord_h2">
                                        Особенности
                                    </h2>
                                    <p class="accord_p"><span>Самые простые винтовые компрессоры имеют реле, которое
                                            включает и выключает двигатель при определенном давлении</span> <img
                                            src="/images/collapse_arrow.svg" alt="" class="collapse_arrow"></p>
                                    <div class="cats_item" id="tab-in-1">
                                        <p class="fz13px text_blue">
                                            По конструкции принадлежат к ротационному компрессорному оборудованию. Впервые
                                            винтовая модель была запатентована в 1934 г. На сегодня агрегаты данного типа
                                            являются наиболее распространенными в своем сегменте. Этому способствует их
                                            относительно небольшая масса и компактные габариты, надежность, способность
                                            функционировать в автономном режиме, экономичность в плане потребления
                                            электроэнергии и затрат на обслуживание. Невысокий уровень вибрации позволяет
                                            монтировать такие системы без обустройства специального фундамента, как в случае
                                            с поршневыми аналогами.
                                            <img src="/images/accord_arrow.svg" alt="">
                                        </p>
                                    </div>
                                </div>
                                <div class="accord_item accord_prem">
                                    <h2 class="accord_h2">Преимущества и недостатки винтового компрессора</h2>
                                    <p class="accord_p"><span>Самые простые винтовые компрессоры имеют реле, двигатель при
                                            определенном давлении</span> <img src="/images/collapse_arrow.svg"
                                            alt="" class="collapse_arrow"></p>
                                    <div class="cats_item" id="tab-in-2">
                                        <p class="fz13px text_blue">
                                            Тест
                                            <img src="/images/accord_arrow.svg" alt="">
                                        </p>
                                    </div>
                                </div>
                                <div class="accord_item accord_service">
                                    <h2 class="accord_h2">Обслуживание и ремонт</h2>
                                    <p class="accord_p"><span>Самые простые винтовые компрессоры имеют реле, которое
                                            включает и выключает. Компрессоры имеют реле, которое включает и
                                            выключает</span> <img src="/images/collapse_arrow.svg" alt=""
                                            class="collapse_arrow"></p>
                                    <div class="cats_item" id="tab-in-3">
                                        <p class="fz13px text_blue">
                                            Тест 3
                                            <img src="/images/accord_arrow.svg" alt="">
                                        </p>
                                    </div>
                                </div>
                                <div class="accord_item accord_delivery">
                                    <h2 class="accord_h2">Сроки поставки и доставка</h2>
                                    <p class="accord_p"><span>Самые простые винтовые компрессоры имеют реле, которое
                                            включает и выключает двигатель при определенном давлении. Компрессоры имеют
                                            реле, которое включает и выключает</span> <img src="/images/collapse_arrow.svg"
                                            alt="" class="collapse_arrow"></p>
                                    <div class="cats_item" id="tab-in-4">
                                        <p class="fz13px text_blue">
                                            Тест 4
                                            <img src="/images/accord_arrow.svg" alt="">
                                        </p>
                                    </div>
                                </div>

                            </div>
                        @else
                            {!! $category->description !!}
                        @endif
                        <form id="form-search" action="" class="text-light p-3" method="POST">
                            @csrf
                            <input type="hidden" name="from-to" value=1>
                            <div class="row align-items-end">
                                <div class="col">
                                    @foreach ($search as $key => $name)
                                        @include('part.search-item2')
                                    @endforeach
                                </div>
                                <div class="col-md-3">
                                    <div class="calc_right">
                                        <button class="btn submit_podbor">
                                            Подобрать
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <a data-toggle="collapse" data-target="#search-item" aria-expanded="false">{{ count($search) > 2 ? 'Еще' : '' }}</a>
                        </form>
                        <div class="col-xs-8 col-sm-8 col-md-9 col-lg-10 col-9 swiper-section">
                            <div class="swiper first-swiper" data-slidesPerView="4">
                                <div class="swiper-wrapper">
                                </div>
                                <div class="swiper-button-next first-swiper-next"></div>
                                <div class="swiper-button-prev first-swiper-prev"></div>
                            </div>
                        </div>

                        <div class="main_cats_items">
                            <div class="row">
                                {{-- @foreach ($category->childrens as $child) --}}
                                @foreach ($sorted as $child)
                                    <a href="{{ route('catalog.id', ['slug' => $category->slug, 'id' => $child->id]) }}"
                                        class="@if ($child->wide == true) col-md-12 @else col-md-4 @endif">
                                        <div class="cats_items">
                                            <h2>{{ $child->name }}</h2>
                                            <img src="{{ $child->image_path }}" alt="">
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-3 del_pad_cats">
                    <div class="cats_right " style="display: none">

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
@section('scripts')
    <script src="{{ asset('js/catalog.js') }}"></script>
@endsection
