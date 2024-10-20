@extends('layouts.front')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 p0">
                    @if($items->count())
                        @foreach ($items as $index => $item)
                            @include('pages.search-item', ['category' => $item, 'products' => $item->products, 'idx' => $index])
                        @endforeach
                    @else
                        <div class="row table_row cats_center_title">
                            <p class="cats_h2_title_sec">Товары не найдены</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            new Swiper('.first-swiper', {
                slidesPerView: 7,
                spaceBetween: 25,
                loop: false,
                speed: 400,
                navigation: {
                    nextEl: '.first-swiper-next',
                    prevEl: '.first-swiper-prev',
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
        });

        let mainData = {
            quantity: 0,
            items: [],
        };
        function updateProductsQuantity(data) {
            $('.footer-input').each(function () {
                $(this).val('0');
            })
            $('.num_cart').text(data.quantity);
            mainData = data;
        }
        document.addEventListener('DOMContentLoaded', () => {
            $.ajax({
                url: "/api/cart",
                type: "GET",
                dataType: 'json',
                xhrFields: {
                    withCredentials: true
                },
                success: function (data) {
                    updateProductsQuantity(data);
                },
            });

            $('.footer-input').each(function () {
                const productId = parseInt($(this).attr('id').replace('product-', '').replace('-quantity', ''));
                $(this).on('change', e => {
                    send(productId, parseInt(e.target.value));
                });
            });
        });
        function addProductToCart(productId) {
            const input = document.getElementById(`product-${productId}-quantity`);

            const existItem = mainData.items.filter(item => item.product_id == productId)[0];
            send(productId, parseInt(input.value) + parseInt((existItem ? existItem.amount : 0)));
            input.value = 0;
        }

        function incrementProductQuantity(productId) {
            const input = document.getElementById(`product-${productId}-quantity`);
            input.value = parseInt(input.value) + 1;
        }

        function decrementProductQuantity(productId) {
            const input = document.getElementById(`product-${productId}-quantity`);
            if (parseInt(input.value) >= 1) {
                input.value = parseInt(input.value) - 1;
            }
        }

        function send(productId, quantity) {
            $.ajax({
                url: "/api/cart",
                type: "POST",
                dataType: 'json',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: productId,
                    quantity: quantity,
                },
                xhrFields: {
                    withCredentials: true
                },
                success: function (data) {
                    updateProductsQuantity(data);
                },
            });
        }
    </script>
@endsection
