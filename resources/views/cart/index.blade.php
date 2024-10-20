@extends('layouts.front')
@section('content')
    <section id="cart">
        <div class="container">
            <div class="cart_container">
                <div class="cart">
                    <div class="cart_content">
                        <div class="row d-flex align-items-center h-100">
                            <div class="col-12">

                                <div class="d-flex justify-content-between align-items-center">
                                    <h1 class="cart_h1">Заказ</h1>
                                </div>

                                @if ($items->isEmpty() && !$success)
                                    <div>
                                        Пожалуйста, добавьте товары в корзину из нашего каталога.
                                    </div>
                                @endif

                                @if ($success)
                                    <div>
                                        Заказ успешно сформирован.
                                    </div>
                                @else
                                    <div>{{ $message }}</div>
                                @endif
                                @include('cart.items')
                            </div>
                        </div>
                    </div>
                </div>

                @if ($items->isNotEmpty() && !$success)
                    @include('cart.form')
                @endif

            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            $.ajax({
                url: "/api/cart",
                type: "GET",
                dataType: 'json',
                xhrFields: {
                    withCredentials: true
                },
                success: function(data) {
                    updateProductsQuantity(data, true);
                },
            });

            $('.product-quantity').each(function() {
                const productId = parseInt($(this).attr('id').replace('product-', '').replace('-quantity', ''));
                $(this).on('change', e => {
                    if (parseInt(e.target.value) <= 0) {
                        const element = document.getElementById(`item-${productId}`);
                        element.outerHTML = '';
                    }
                    send(productId, parseInt(e.target.value));
                });
            });
        });

        $(document).ready(function() {
            $('.cart-upload').click(function(e) {
                e.preventDefault();
                const form = $('#cart-upload-form');
                const input = form.find('input[type=file]');
                input.click();
            });
        });

        function needDelivery() {
            const input = document.getElementById('need_delivery');
            const delivery = document.getElementsByClassName('form-group-delivery')[0];
            input.checked ? delivery.setAttribute('style', 'display: flex;') : delivery.setAttribute('style', 'display: none;');
        };

        function updateProductsQuantity(data, firstLoad = false) {
            if (data.quantity == 0 && !firstLoad) {
                window.location.href = "{{ route('pages.cart') }}";
                return;
            }
            $('.product-quantity').each(function() {
                $(this).val('0');
            });
            for (const item of data.items) {
                const input = document.getElementById(`product-${item.product_id}-quantity`);
                if (input) {
                    input.value = item.amount;
                }
            }

            $('.num_cart').text(data.quantity);
        }

        function removeItem(id) {
            const element = document.getElementById(`item-${id}`);
            element.outerHTML = '';
            send(id, 0);
        }

        function incrementProductQuantity(productId) {
            const input = document.getElementById(`product-${productId}-quantity`);
            const newValue = parseInt(input.value) + 1;
            input.value = newValue
            send(productId, newValue);
        }

        function decrementProductQuantity(productId) {
            const input = document.getElementById(`product-${productId}-quantity`);
            const newValue = parseInt(input.value) - 1;
            input.value = newValue
            if (newValue <= 0) {
                const element = document.getElementById(`item-${productId}`);
                element.outerHTML = '';
            }
            send(productId, newValue);
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
                success: function(data) {
                    updateProductsQuantity(data);
                },
            });
        }
        $('form.send-cart').on('submit', (form) => {
            form.preventDefault()
            data = new FormData(form.target)
            $('.cart-error').remove()
            $.ajax({
                    url: $(form.target).attr('action'),
                    type: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                })
                .success((response) => {
                    $(response).insertAfter('.page')
                    $('#cart-success').modal()
                })
                .error((error) => {
                    error = error.responseJSON.errors
                    Object.keys(error).forEach((key) => {
                        $('#' + key).next().length ?
                            $('#' + key + '.cart-error').innerText = error[key] :
                            $('<div class="cart-error" style="margin-top: -6px;font-size: 14px;color: red;">' + error[key] + '</div>').insertAfter('#' + key)
                    })
                });
        })
    </script>
@endsection
