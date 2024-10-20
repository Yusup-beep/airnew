@isset($elements)
    @foreach ($elements as $el)
        @php
            // dump($el['category']->name);
        @endphp
        @include('part.catalog-swiper-item', $el)
    @endforeach
@endisset
@if (!isset($elements))
    <div class="container-fluid">
        <div class="row table_row cats_center_title">
            <p class="cats_h2_title_sec">Товары отсутствуют</p>
        </div>
    </div>
@endif
