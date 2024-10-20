<section>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-9 p0 item-search">
                <div class="item">
                    <h2 class="cats_h2">{{ $category->name }}</h2>
                </div>
                <div class="row table_row" style="width: auto;">
                    @php
                        $menuCategories = $products[0]->values;
                        $menuList = [];
                        $excludedKeys = [
                            'keywords',
                            'description',
                            'image_path',
                            'zagolovok',
                            'dimensions',
                        ];

                        foreach ($menuCategories as $key => $mCategory){
                            if (!in_array($key, $excludedKeys) && isset($mCategory['value'])) {
                                if(
                                    (!is_array($mCategory['value']) && !empty($mCategory['value']) && $mCategory['value'] !== null)
                                    ||
                                    (is_array($mCategory['value']) && count($mCategory['value']) > 0 && $mCategory['value'][0] !== null)
                                ) {
                                    $menuList[$key] = $mCategory;
                                }
                            }
                        }
                    @endphp
                    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 col-3 side-menu">
                        @foreach($menuList as $key => $value)
                            <p class="text_blue_td_flow text_slide fz13px p_700">
                                {{ $value['name'] }}
                            </p>
                        @endforeach
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-9 col-lg-10 col-9 swiper-section">
                        <div class="swiper first-swiper">
                            <div class="swiper-wrapper">
                                @foreach($products as $product)
                                    <div class="swiper-slide">
                                        <div class="item">
                                            <div class="header table_name">
                                                <img
                                                    src="/images/salnik.svg"
                                                    alt=""
                                                    class="salnik"
                                                />
                                                <p class="text_blue_td fz15px">
                                                    {{ $product->name }}
                                                    @if(isset($product->values['dimensions']['value'] ))
                                                        <span>{{ $product->values['dimensions']['value'] }}</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="body">
                                                @if(isset($product['image_path'] ))
                                                    <div class="table_img">
                                                        <img src="/storage/{{ $product['image_path'] }}" alt="" />
                                                    </div>
                                                @else
                                                    <div class="table_img">
                                                        <img src="/images/plug.png" alt="" />
                                                    </div>
                                                @endif

                                                @foreach($product->values as $keyV => $value)
                                                    @if($keyV == 'keywords'
                                                        || $keyV == 'description'
                                                        || $keyV == 'keywords'
                                                        || $keyV == 'image_path'
                                                        || $keyV == 'dimensions'
                                                        || $keyV == 'zagolovok')
                                                        @continue;
                                                    @else
                                                        @if(isset($value['value']) && is_array($value['value']))
                                                            @php
                                                                $valueString = '';
                                                                if(isset($value['value']) && $value['value'] !== null){
                                                                    $endEl = count($value['value']) -1;
                                                                    $curCount = 0;
                                                                    foreach ($value['value'] as $val){

                                                                        if($curCount == $endEl){
                                                                            $valueString = $valueString . $val;
                                                                        }else{
                                                                            $valueString = $valueString . $val.' / ';
                                                                        }
                                                                        $curCount++;
                                                                    }
                                                                }else{
                                                                    $valueString = '-';
                                                                }
                                                            @endphp
                                                            @if($valueString !== '-' && $valueString !== '')
                                                                    <div>
                                                                        <p class="text_blue_td">{{$valueString}}</p>
                                                                    </div>
                                                            @endif

                                                        @else
                                                            @php
                                                                $str = '';
                                                                if(isset($value['value']) && $value['value'] !== null){
                                                                    $str = $value['value'];
                                                                }else{
                                                                    $str = '-';
                                                                }
                                                            @endphp
                                                                @if($str !== '-' && $str !== '')
                                                                    <div>
                                                                        <p class="text_blue_td">{{$str}}</p>
                                                                    </div>
                                                                @endif
                                                        @endif
                                                    @endif

                                                @endforeach
                                            </div>
                                            <div class="footer">
                                                <div class="footer-input-section">
                                                    <input
                                                        class="footer-input"
                                                        type="number"
                                                        value="0"
                                                        id="product-{{ $product->id }}-quantity"
                                                        step="1"
                                                        name=""
                                                    />
                                                    <div class="buttons-section">
                                                        <button
                                                            class="increment footer-button"
                                                            onclick="incrementProductQuantity({{ $product->id }})"
                                                            data-action="increment"
                                                        ></button>
                                                        <button
                                                            class="decrement footer-button"
                                                            onclick="decrementProductQuantity({{ $product->id }})"
                                                            data-action="decrement"
                                                        ></button>
                                                    </div>
                                                </div>
                                                <button
                                                    onclick="addProductToCart({{ $product->id }})"
                                                        class="add-button footer-button">
                                                    Добавить
                                                </button>
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
            </div>
        </div>
    </div>
</section>
