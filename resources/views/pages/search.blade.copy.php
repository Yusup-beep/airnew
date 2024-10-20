@extends('layouts.front')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 p0">
                    {{-- @if ($items->count()) --}}
                    {{-- @foreach ($items as $index => $item) --}}
                    @livewire(ProductsSlider::class, ['keyword' => $keyword])
                    {{-- @include('pages.search-item', ['category' => $item, 'products' => $item->products, 'idx' => $index]) --}}
                    {{-- @endforeach --}}
                    {{-- @else
                        <div class="row table_row cats_center_title">
                            <p class="cats_h2_title_sec">Товары не найдены</p>
                        </div>
                    @endif --}}
                </div>
            </div>
        </div>
    </section>
@endsection
