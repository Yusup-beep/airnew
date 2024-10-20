@extends('layouts.front')
@if ($category->title != '')
    @section('title')
        {{ $category->title }}
    @endsection
@endif
@section('content')
<section id="item">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-9 offset-3">
                    <div class="row">
                        <div class="col-12">
                            <div class="item">
                                <h2 class="cats_h2">{{ $category->name }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @livewire(ProductsSlider::class, [
            'slidesPerView' => $slider_items,
            'keys' => $keys,
            'fromto' => 0,
            'text' => $category->up_text
        ])
    </div>

    <div class="row item_text_bottom_row">
        <div class="col-2"></div>
        <div class="col-10">
            <div class="row">
                <style>
                    .item_text_bottom p {
                        font-size: 13px !important;
                    }

                    .item_text_bottom p strong {
                        font-size: 15px !important;
                        font-weight: 700;
                        line-height: 19px;
                    }

                    .item_text_bottom blockquote {
                        margin-top: 2.5rem;
                        color: #be1622;
                        font-size: 13px;
                        line-height: 18px;
                        font-weight: 500;
                    }
                </style>
                <div class="col-md-4">
                    <div class="item_text_bottom">
                        {!! $category->down_text1 !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="item_text_bottom">
                        {!! $category->down_text2 !!}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="slider_sale">
                        <h2 class="h2_sale_slider">Вам может пригодиться</h2>
                        <div class="swiper second-swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="/images/maslo.png" alt="" class="sliders_img" />
                                    <p class="fz13px p_500 desc_sale_slider">
                                        Масло для винтовых и роторно-пластинчатых воздушных
                                        компрессоров
                                    </p>
                                </div>
                                <div class="swiper-slide">
                                    <img src="/images/maslo.png" alt="" class="sliders_img" />
                                    <p class="fz13px p_500 desc_sale_slider">
                                        Масло для винтовых и роторно-пластинчатых воздушных
                                        компрессоров
                                    </p>
                                </div>
                            </div>

                            <div class="swiper-button-prev second-swiper-prev"></div>
                            <div class="swiper-button-next second-swiper-next"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
    <script src="{{ asset('js/catalog.js') }}"></script>
@endsection
