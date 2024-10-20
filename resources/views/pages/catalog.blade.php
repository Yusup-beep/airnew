@extends('layouts.front')
@if ($category->title != '')
    @section('title')
        - {{ $category->title }}
    @endsection
@endif
@section('content')
    <section id="cats">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3 p0">
                    <div class="cats">
                        <h2 class="cats_h2 vint_h2">{{ $category->name }}</h2>
                    </div>
                    <div class="cats_center">
                        @if (is_null($category->description_inside_page))
                            {!! $category->description !!}
                        @else
                            @each ('part.description-inside-page',$category->description_inside_page,'desc')
                        @endif
                    </div>
                </div>
                <div class="col-md-3 del_pad_cats">
                    <div class="cats_right" style="display: none"></div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    @livewire(ProductsSlider::class, ['slidesPerView' => 6, 'keys' => $keys, 'fromto' => 1, ])
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 offset-md-3 p0">
                    <div class="main_cats_items">
                        <div class="row">
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
        </div>
    </section>
@endsection
@section('scripts')
    <script src="{{ asset('js/catalog.js') }}"></script>
@endsection
