<div class="row" style="width: auto;">
    <div class="col-md-3">
        <p class="text_blue_td_flow text_slide"></p>
        <p class="text_blue_td_flow text_slide"></p>
        <p class="text_blue_td_flow text_slide"></p>
        <p class="text_blue_td_flow text_slide"></p>
        @foreach($keys as $key => $value)
            <p class="text_blue_td_flow text_slide fz13px p_700">
                {{ $value[0] }}
            </p>
        @endforeach
    </div>
    <div class="col-md-9 swiper-section">
        <div class="swiper first-swiper">
            <div class="swiper-wrapper">
                @php
                    if (array_key_exists('keys', $products)) {
                        $keys = array_pop($products);
                    }
                @endphp
                @foreach ($products as $k => $product)
                    <div class="swiper-slide">
                        @if ($fromto)
                            <div class="row text_blue_td_flow">
                                {{ $product['category'] }}
                            </div>
                        @endif
                        <div class="item">
                            <div class="header table_name">
                                <img src="/images/salnik.svg" class="salnik" />
                                <p class="text_blue_td fz15px">
                                    {{ $product['name'] }}
                                    <span>
                                        @isset($product['dimensions'])
                                            {{ $product['dimensions']['value'] }}
                                        @endisset
                                    </span>
                                </p>
                            </div>
                            <div class="body">
                                @if (isset($product['image_path']))
                                    <div class="table_img">
                                        <img src="{{ asset('storage/' . $product['image_path']) }}" />
                                    </div>
                                @else
                                    <div class="table_img">
                                        <img src="/images/plug.png" alt="" />
                                    </div>
                                @endif
                                @foreach ($keys as $key => $value)
                                    <div class="text_blue_td">
                                        {{ is_array($product[$key]['value']) ? (implode(' / ', $product[$key]['value']) ?: '-') : ($product[$key]['value'] ?: '-') }}
                                    </div>
                                @endforeach
                            </div>
                            <div class="footer">
                                <div class="footer-input-section">
                                    <input class="footer-input" type="number" value="0" id="product-{{ $product['id'] }}-quantity" step="1" name="" />
                                    <div class="buttons-section">
                                        <button class="increment footer-button" onclick="incrementProductQuantity({{ $product['id'] }})" data-action="increment"></button>
                                        <button class="decrement footer-button" onclick="decrementProductQuantity({{ $product['id'] }})" data-action="decrement"></button>
                                    </div>
                                </div>
                                <button onclick="addProductToCart(this, {{ $product['id'] }})" class="add-button footer-button">Добавить</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-prev first-swiper-prev"></div>
            <div class="swiper-button-next first-swiper-next"></div>
        </div>
    </div>
</div>

@section('scripts')
    @parent
    <script>
        $('.salnik').on('click', function() {
            $(this).parents('.swiper-slide').animate({
                opacity: 0,
            }, 300, function() {
                $(this).remove();
            });
        });
    </script>
@endsection