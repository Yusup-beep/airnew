@extends('layouts.front')
@section('content')
    <section id="item">
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-9 p0">
                    <div class="item">
                        <h2 class="cats_h2">{{ $category->name }}</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="calc_gor">
                                <form>
                                    <div class="form-group calc_gor_item">
                                        <label for="from2">Внутренний Ø, мм</label>
                                        <input
                                            type="text"
                                            id="from2"
                                            class="form-control calc_input"
                                        />
                                        <a href="#">
                                            <img src="/images/white.png" alt="" />
                                        </a>
                                    </div>
                                    <div class="form-group calc_gor_item">
                                        <label for="from2">Внешний Ø, мм</label>
                                        <input
                                            type="text"
                                            id="from2"
                                            class="form-control calc_input"
                                        />
                                        <a href="#">
                                            <img src="/images/white.png" alt="" />
                                        </a>
                                    </div>
                                    <div class="form-group calc_gor_item">
                                        <label for="from2">Толщина, мм</label>
                                        <input
                                            type="text"
                                            id="from2"
                                            class="form-control calc_input"
                                        />
                                        <a href="#">
                                            <img src="/images/white.png" alt="" />
                                        </a>
                                    </div>
                                    <div class="form-group">
                                        <p class="text-center">
                                            <button class="btn submit_podbor">Подобрать</button>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="item_text_center">
                                <p class="text_blue fz13px">
                                    На складе Компании Пневмосистема Вы всегда найдете
                                    сальники для винтовых блоков Rotorcomp, GHH Rand, Sulair,
                                    Termomeccanica, Aerzener, Atlas Copco, FSD, ABAC, Kamsan и
                                    других производителей необходимого Вам размера.
                                </p>
                                <p class="text_blue fz13px">
                                    Даже если вам необходим сальник к блоку неизвестного
                                    производителя — обращайтесь, мы постараемся решить вашу
                                    проблему.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="item_text_center">
                                <p class="text_blue fz13px">
                                    В наличии на складе в Москве сальники Rotorcomp SP №№:
                                    <br />
                                    84683, 107917, 109184, 110303, 110738, 110765, 110766,
                                    111538, 113047, 113351, 114027, 115493, N33593, N34932.
                                </p>
                            </div>
                        </div>
                    </div>
                    @if(!empty($products[0]))
                        <div class="row table_row">
                            <!--Код выше закомментирован но не удален
                            это старый код для этой секции
                            изменено количество колонок для бокового меню на каждом экране
                            -->
{{--                            @dd($products[0]->values)--}}
                            @php
                                $menuCategories= $products[0]->values;
                                $menuList = [];
//да простит меня бог программирования
                                foreach ($products[0]->values as $key => $mCategory){
                                    if(
                                        $key == "keywords"
                                        || $key == "description"
                                        || $key == "keywords"
                                        || $key == "image_path"
                                        || $key == "zagolovok"
                                        || $key == "dimensions"
                                        ){
                                           continue;
                                        }else{
                                            if(
                                                (!empty($mCategory['value']) && $mCategory['value'] !== null )
                                             ||
                                             (is_array($mCategory['value']) && !empty($mCategory['value'][0]))
                                                ){
                                                if($mCategory['value'][0] !== null){
                                                  $menuList[$key] = $mCategory;
                                                }
                                            }
                                        }
                                }
                            @endphp
                            <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 col-3 side-menu">
                                @foreach($menuList as $key => $mCategoryItem)
                                    <p class="text_blue_td_flow text_slide fz13px p_700">
                                        {{$mCategoryItem['name']}}
                                    </p>
                                @endforeach
                            </div>
                            <!-- Сделаны три слайдера для каждого типа экрана
                            в зависимости от экрана отображается свой слайдер с
                            определенным количеством элементов
                            создна карточка элемента, который отображается,
                            внутри него хедер, боди и футер
                            в хедере информация и картинка
                            в боди характеристики
                            в футере счетчик и кнопки
                          -->
                            <div class="col-xs-8 col-sm-8 col-md-9 col-lg-10 col-9 swiper-section">
                                <div class="swiper first-swiper">
                                    <div class="swiper-wrapper">
                                        @foreach($products as $product)
{{--                                            @dd($product->values)--}}
                                            {{--                                        @dd($product->values);--}}
                                            <div class="swiper-slide">
                                                <div class="item " >
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
                                                        @if(isset($product->values['image_path']['patch'][0] ))
                                                            <div class="table_img">
                                                                <img src="{{ $product->values['image_path']['patch'][0] }}" alt="" />
                                                            </div>
                                                        @else
                                                            <div class="table_img">
                                                                <img src="/images/plug.png" alt="" />
                                                            </div>
                                                        @endif

                                                        @foreach($product->values as $keyV => $value)
                                                            @if( $keyV == "keywords"
                                                                || $keyV == "description"
                                                                || $keyV == "keywords"
                                                                || $keyV == "image_path"
                                                                || $keyV == "dimensions"
                                                                || $keyV == "zagolovok")
                                                                @continue;
                                                            @else
                                                                @if(is_array($value['value']))
                                                                    @php
                                                                        $valueString = '';
                                                                        if(  $value['value'] !== null){
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
                                                                        if($value['value'] !== null){
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
                                                        {{--                                                <div>--}}
                                                        {{--                                                    <p class="text_blue_td">10</p>--}}
                                                        {{--                                                </div>--}}
                                                        {{--                                                <div>--}}
                                                        {{--                                                    <p class="text_blue_td">14</p>--}}
                                                        {{--                                                </div>--}}
                                                        {{--                                                <div>--}}
                                                        {{--                                                    <p class="text_blue_td">11</p>--}}
                                                        {{--                                                </div>--}}
                                                        {{--                                                <div>--}}
                                                        {{--                                                    <p class="text_blue_td">14</p>--}}
                                                        {{--                                                </div>--}}
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

                                        {{--                                    <div class="swiper-slide">--}}
                                        {{--                                        <div class="item">--}}
                                        {{--                                            <div class="header table_name">--}}
                                        {{--                                                <img--}}
                                        {{--                                                    src="/images/salnik.svg"--}}
                                        {{--                                                    alt=""--}}
                                        {{--                                                    class="salnik"--}}
                                        {{--                                                />--}}
                                        {{--                                                <p class="text_blue_td fz15px">--}}
                                        {{--                                                    Сальник винтового блока--}}
                                        {{--                                                    <span>10 х 14 х 11</span>--}}
                                        {{--                                                </p>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="body">--}}
                                        {{--                                                <div class="table_img">--}}
                                        {{--                                                    <img src="/images/items/1.png" alt="" />--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div>--}}
                                        {{--                                                    <p class="text_blue_td">10</p>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div>--}}
                                        {{--                                                    <p class="text_blue_td">14</p>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div>--}}
                                        {{--                                                    <p class="text_blue_td">11</p>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div>--}}
                                        {{--                                                    <p class="text_blue_td">14</p>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="footer">--}}
                                        {{--                                                <div class="footer-input-section">--}}
                                        {{--                                                    <input--}}
                                        {{--                                                        class="footer-input"--}}
                                        {{--                                                        type="number"--}}
                                        {{--                                                        value="0"--}}
                                        {{--                                                        step="1"--}}
                                        {{--                                                        name=""--}}
                                        {{--                                                        id="items-counter"--}}
                                        {{--                                                    />--}}
                                        {{--                                                    <div class="buttons-section">--}}
                                        {{--                                                        <button--}}
                                        {{--                                                            class="increment footer-button"--}}
                                        {{--                                                            data-action="increment"--}}
                                        {{--                                                        ></button>--}}
                                        {{--                                                        <button--}}
                                        {{--                                                            data-action="decrement"--}}
                                        {{--                                                            class="decrement footer-button"--}}
                                        {{--                                                        ></button>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <button class="add-button footer-button">--}}
                                        {{--                                                    Добавить--}}
                                        {{--                                                </button>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}
                                        {{--                                    <div class="swiper-slide">--}}
                                        {{--                                        <div class="item">--}}
                                        {{--                                            <div class="header table_name">--}}
                                        {{--                                                <img--}}
                                        {{--                                                    src="/images/salnik.svg"--}}
                                        {{--                                                    alt=""--}}
                                        {{--                                                    class="salnik"--}}
                                        {{--                                                />--}}
                                        {{--                                                <p class="text_blue_td fz15px">--}}
                                        {{--                                                    Сальник винтового блока--}}
                                        {{--                                                    <span>10 х 14 х 11</span>--}}
                                        {{--                                                </p>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="body">--}}
                                        {{--                                                <div class="table_img">--}}
                                        {{--                                                    <img src="/images/items/1.png" alt="" />--}}
                                        {{--                                                    <img--}}
                                        {{--                                                        src="/images/akcia.svg"--}}
                                        {{--                                                        alt=""--}}
                                        {{--                                                        class="akcia"--}}
                                        {{--                                                    />--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div>--}}
                                        {{--                                                    <p class="text_blue_td">10</p>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div>--}}
                                        {{--                                                    <p class="text_blue_td">14</p>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div>--}}
                                        {{--                                                    <p class="text_blue_td">11</p>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div>--}}
                                        {{--                                                    <p class="text_blue_td">14</p>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="footer">--}}
                                        {{--                                                <div class="footer-input-section">--}}
                                        {{--                                                    <input--}}
                                        {{--                                                        class="footer-input"--}}
                                        {{--                                                        type="number"--}}
                                        {{--                                                        value="0"--}}
                                        {{--                                                        step="1"--}}
                                        {{--                                                        name=""--}}
                                        {{--                                                        id="items-counter"--}}
                                        {{--                                                    />--}}
                                        {{--                                                    <div class="buttons-section">--}}
                                        {{--                                                        <button--}}
                                        {{--                                                            class="increment footer-button"--}}
                                        {{--                                                            data-action="increment"--}}
                                        {{--                                                        ></button>--}}
                                        {{--                                                        <button--}}
                                        {{--                                                            class="decrement footer-button"--}}
                                        {{--                                                            data-action="decrement"--}}
                                        {{--                                                        ></button>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <button class="add-button footer-button">--}}
                                        {{--                                                    Добавить--}}
                                        {{--                                                </button>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}
                                        {{--                                    <div class="swiper-slide">--}}
                                        {{--                                        <div class="item">--}}
                                        {{--                                            <div class="header table_name">--}}
                                        {{--                                                <img--}}
                                        {{--                                                    src="/images/salnik.svg"--}}
                                        {{--                                                    alt=""--}}
                                        {{--                                                    class="salnik"--}}
                                        {{--                                                />--}}
                                        {{--                                                <p class="text_blue_td fz15px">--}}
                                        {{--                                                    Сальник винтового блока--}}
                                        {{--                                                    <span>10 х 14 х 11</span>--}}
                                        {{--                                                </p>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="body">--}}
                                        {{--                                                <div class="table_img">--}}
                                        {{--                                                    <img src="/images/items/1.png" alt="" />--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div>--}}
                                        {{--                                                    <p class="text_blue_td">10</p>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div>--}}
                                        {{--                                                    <p class="text_blue_td">14</p>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div>--}}
                                        {{--                                                    <p class="text_blue_td">11</p>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div>--}}
                                        {{--                                                    <p class="text_blue_td">14</p>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="footer">--}}
                                        {{--                                                <div class="footer-input-section">--}}
                                        {{--                                                    <input--}}
                                        {{--                                                        class="footer-input"--}}
                                        {{--                                                        type="number"--}}
                                        {{--                                                        value="0"--}}
                                        {{--                                                        step="1"--}}
                                        {{--                                                        name=""--}}
                                        {{--                                                        id="items-counter"--}}
                                        {{--                                                    />--}}
                                        {{--                                                    <div class="buttons-section">--}}
                                        {{--                                                        <button--}}
                                        {{--                                                            class="increment footer-button"--}}
                                        {{--                                                            data-action="increment"--}}
                                        {{--                                                        ></button>--}}
                                        {{--                                                        <button--}}
                                        {{--                                                            class="decrement footer-button"--}}
                                        {{--                                                            data-action="decrement"--}}
                                        {{--                                                        ></button>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <button class="add-button footer-button">--}}
                                        {{--                                                    Добавить--}}
                                        {{--                                                </button>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}
                                        {{--                                    <div class="swiper-slide">--}}
                                        {{--                                        <div class="item">--}}
                                        {{--                                            <div class="header table_name">--}}
                                        {{--                                                <img--}}
                                        {{--                                                    src="/images/salnik.svg"--}}
                                        {{--                                                    alt=""--}}
                                        {{--                                                    class="salnik"--}}
                                        {{--                                                />--}}
                                        {{--                                                <p class="text_blue_td fz15px">--}}
                                        {{--                                                    Сальник винтового блока--}}
                                        {{--                                                    <span>10 х 14 х 11</span>--}}
                                        {{--                                                </p>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="body">--}}
                                        {{--                                                <div class="table_img">--}}
                                        {{--                                                    <img src="/images/items/1.png" alt="" />--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div>--}}
                                        {{--                                                    <p class="text_blue_td">10</p>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div>--}}
                                        {{--                                                    <p class="text_blue_td">14</p>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div>--}}
                                        {{--                                                    <p class="text_blue_td">11</p>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div>--}}
                                        {{--                                                    <p class="text_blue_td">14</p>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="footer">--}}
                                        {{--                                                <div class="footer-input-section">--}}
                                        {{--                                                    <input--}}
                                        {{--                                                        class="footer-input"--}}
                                        {{--                                                        type="number"--}}
                                        {{--                                                        value="0"--}}
                                        {{--                                                        step="1"--}}
                                        {{--                                                        name=""--}}
                                        {{--                                                        id="items-counter"--}}
                                        {{--                                                    />--}}
                                        {{--                                                    <div class="buttons-section">--}}
                                        {{--                                                        <button--}}
                                        {{--                                                            class="increment footer-button"--}}
                                        {{--                                                            data-action="increment"--}}
                                        {{--                                                        ></button>--}}
                                        {{--                                                        <button--}}
                                        {{--                                                            class="decrement footer-button"--}}
                                        {{--                                                            data-action="decrement"--}}
                                        {{--                                                        ></button>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <button class="add-button footer-button">--}}
                                        {{--                                                    Добавить--}}
                                        {{--                                                </button>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}
                                        {{--                                    <div class="swiper-slide">--}}
                                        {{--                                        <div class="item">--}}
                                        {{--                                            <div class="header table_name">--}}
                                        {{--                                                <img--}}
                                        {{--                                                    src="/images/salnik.svg"--}}
                                        {{--                                                    alt=""--}}
                                        {{--                                                    class="salnik"--}}
                                        {{--                                                />--}}
                                        {{--                                                <p class="text_blue_td fz15px">--}}
                                        {{--                                                    Сальник винтового блока--}}
                                        {{--                                                    <span>10 х 14 х 11</span>--}}
                                        {{--                                                </p>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="body">--}}
                                        {{--                                                <div class="table_img">--}}
                                        {{--                                                    <img src="/images/items/1.png" alt="" />--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div>--}}
                                        {{--                                                    <p class="text_blue_td">10</p>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div>--}}
                                        {{--                                                    <p class="text_blue_td">14</p>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div>--}}
                                        {{--                                                    <p class="text_blue_td">11</p>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div>--}}
                                        {{--                                                    <p class="text_blue_td">14</p>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="footer">--}}
                                        {{--                                                <div class="footer-input-section">--}}
                                        {{--                                                    <input--}}
                                        {{--                                                        class="footer-input"--}}
                                        {{--                                                        type="number"--}}
                                        {{--                                                        value="0"--}}
                                        {{--                                                        step="1"--}}
                                        {{--                                                        name=""--}}
                                        {{--                                                        id="items-counter"--}}
                                        {{--                                                    />--}}
                                        {{--                                                    <div class="buttons-section">--}}
                                        {{--                                                        <button--}}
                                        {{--                                                            class="increment footer-button"--}}
                                        {{--                                                            data-action="increment"--}}
                                        {{--                                                        ></button>--}}
                                        {{--                                                        <button--}}
                                        {{--                                                            class="decrement footer-button"--}}
                                        {{--                                                            data-action="decrement"--}}
                                        {{--                                                        ></button>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <button class="add-button footer-button">--}}
                                        {{--                                                    Добавить--}}
                                        {{--                                                </button>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}
                                        {{--                                    <div class="swiper-slide">--}}
                                        {{--                                        <div class="item">--}}
                                        {{--                                            <div class="header table_name">--}}
                                        {{--                                                <img--}}
                                        {{--                                                    src="/images/salnik.svg"--}}
                                        {{--                                                    alt=""--}}
                                        {{--                                                    class="salnik"--}}
                                        {{--                                                />--}}
                                        {{--                                                <p class="text_blue_td fz15px">--}}
                                        {{--                                                    Сальник винтового блока--}}
                                        {{--                                                    <span>10 х 14 х 11</span>--}}
                                        {{--                                                </p>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="body">--}}
                                        {{--                                                <div class="table_img">--}}
                                        {{--                                                    <img src="/images/items/1.png" alt="" />--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div>--}}
                                        {{--                                                    <p class="text_blue_td">10</p>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div>--}}
                                        {{--                                                    <p class="text_blue_td">14</p>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div>--}}
                                        {{--                                                    <p class="text_blue_td">11</p>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div>--}}
                                        {{--                                                    <p class="text_blue_td">14</p>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="footer">--}}
                                        {{--                                                <div class="footer-input-section">--}}
                                        {{--                                                    <input--}}
                                        {{--                                                        class="footer-input"--}}
                                        {{--                                                        type="number"--}}
                                        {{--                                                        value="0"--}}
                                        {{--                                                        step="1"--}}
                                        {{--                                                        name=""--}}
                                        {{--                                                        id="items-counter"--}}
                                        {{--                                                    />--}}
                                        {{--                                                    <div class="buttons-section">--}}
                                        {{--                                                        <button--}}
                                        {{--                                                            class="increment footer-button"--}}
                                        {{--                                                            data-action="increment"--}}
                                        {{--                                                        ></button>--}}
                                        {{--                                                        <button--}}
                                        {{--                                                            class="decrement footer-button"--}}
                                        {{--                                                            data-action="decrement"--}}
                                        {{--                                                        ></button>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <button class="add-button footer-button">--}}
                                        {{--                                                    Добавить--}}
                                        {{--                                                </button>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}
                                        {{--                                    <div class="swiper-slide">--}}
                                        {{--                                        <div class="item">--}}
                                        {{--                                            <div class="header table_name">--}}
                                        {{--                                                <img--}}
                                        {{--                                                    src="/images/salnik.svg"--}}
                                        {{--                                                    alt=""--}}
                                        {{--                                                    class="salnik"--}}
                                        {{--                                                />--}}
                                        {{--                                                <p class="text_blue_td fz15px">--}}
                                        {{--                                                    Сальник винтового блока--}}
                                        {{--                                                    <span>10 х 14 х 11</span>--}}
                                        {{--                                                </p>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="body">--}}
                                        {{--                                                <div class="table_img">--}}
                                        {{--                                                    <img src="/images/items/1.png" alt="" />--}}
                                        {{--                                                    <img--}}
                                        {{--                                                        src="/images/akcia.svg"--}}
                                        {{--                                                        alt=""--}}
                                        {{--                                                        class="akcia"--}}
                                        {{--                                                    />--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div>--}}
                                        {{--                                                    <p class="text_blue_td">10</p>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div>--}}
                                        {{--                                                    <p class="text_blue_td">14</p>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div>--}}
                                        {{--                                                    <p class="text_blue_td">11</p>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div>--}}
                                        {{--                                                    <p class="text_blue_td">14</p>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="footer">--}}
                                        {{--                                                <div class="footer-input-section">--}}
                                        {{--                                                    <input--}}
                                        {{--                                                        class="footer-input"--}}
                                        {{--                                                        type="number"--}}
                                        {{--                                                        value="0"--}}
                                        {{--                                                        step="1"--}}
                                        {{--                                                        name=""--}}
                                        {{--                                                        id="items-counter"--}}
                                        {{--                                                    />--}}
                                        {{--                                                    <div class="buttons-section">--}}
                                        {{--                                                        <button--}}
                                        {{--                                                            class="increment footer-button"--}}
                                        {{--                                                            data-action="increment"--}}
                                        {{--                                                        ></button>--}}
                                        {{--                                                        <button--}}
                                        {{--                                                            class="decrement footer-button"--}}
                                        {{--                                                            data-action="decrement"--}}
                                        {{--                                                        ></button>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <button class="add-button footer-button">--}}
                                        {{--                                                    Добавить--}}
                                        {{--                                                </button>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}
                                        {{--                                    <div class="swiper-slide">--}}
                                        {{--                                        <div class="item">--}}
                                        {{--                                            <div class="header table_name">--}}
                                        {{--                                                <img--}}
                                        {{--                                                    src="/images/salnik.svg"--}}
                                        {{--                                                    alt=""--}}
                                        {{--                                                    class="salnik"--}}
                                        {{--                                                />--}}
                                        {{--                                                <p class="text_blue_td fz15px">--}}
                                        {{--                                                    Сальник винтового блока--}}
                                        {{--                                                    <span>10 х 14 х 11</span>--}}
                                        {{--                                                </p>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="body">--}}
                                        {{--                                                <div class="table_img">--}}
                                        {{--                                                    <img src="/images/items/1.png" alt="" />--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div>--}}
                                        {{--                                                    <p class="text_blue_td">10</p>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div>--}}
                                        {{--                                                    <p class="text_blue_td">14</p>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div>--}}
                                        {{--                                                    <p class="text_blue_td">11</p>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div>--}}
                                        {{--                                                    <p class="text_blue_td">14</p>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="footer">--}}
                                        {{--                                                <div class="footer-input-section">--}}
                                        {{--                                                    <input--}}
                                        {{--                                                        class="footer-input"--}}
                                        {{--                                                        type="number"--}}
                                        {{--                                                        value="0"--}}
                                        {{--                                                        step="1"--}}
                                        {{--                                                        name=""--}}
                                        {{--                                                        id="items-counter"--}}
                                        {{--                                                    />--}}
                                        {{--                                                    <div class="buttons-section">--}}
                                        {{--                                                        <button--}}
                                        {{--                                                            class="increment footer-button"--}}
                                        {{--                                                            data-action="increment"--}}
                                        {{--                                                        ></button>--}}
                                        {{--                                                        <button--}}
                                        {{--                                                            class="decrement footer-button"--}}
                                        {{--                                                            data-action="decrement"--}}
                                        {{--                                                        ></button>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <button class="add-button footer-button">--}}
                                        {{--                                                    Добавить--}}
                                        {{--                                                </button>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}
                                    </div>
                                    <div class="swiper-button-next first-swiper-next"></div>
                                    <div class="swiper-button-prev first-swiper-prev"></div>
                                </div>

                                <!-- <div
                                  id="carouselControls"
                                  class="carousel slide"
                                  data-ride="carousel"
                                >
                                <div class="carousel-inner small-devices-slider">
                                  <div class="carousel-item active">
                                    <div class="row items-row">
                                      <div class="col-6">
                                        <div class="item">
                                          <div class="header table_name">
                                            <img
                                              src="/images/salnik.svg"
                                              alt=""
                                              class="salnik"
                                            />
                                            <p class="text_blue_td fz15px">
                                              Сальник винтового блока
                                              <span>10 х 14 х 11</span>
                                            </p>
                                          </div>
                                          <div class="body">
                                            <div class="table_img">
                                              <img src="/images/items/1.png" alt="" />
                                              <img
                                                src="/images/hit.svg"
                                                alt=""
                                                class="hit"
                                              />
                                            </div>
                                            <div>
                                              <p class="text_blue_td">10</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">14</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">11</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">14</p>
                                            </div>
                                          </div>
                                          <div class="footer">
                                            <div class="footer-input-section">
                                              <input
                                                class="footer-input"
                                                type="number"
                                                value="0"
                                                step="1"
                                                name=""
                                                id=""
                                              />
                                              <div class="buttons-section">
                                                <button
                                                  class="increment footer-button"
                                                ></button>
                                                <button
                                                  class="decrement footer-button"
                                                ></button>
                                              </div>
                                            </div>
                                            <button class="add-button footer-button">
                                              Добавить
                                            </button>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-6">
                                        <div class="item">
                                          <div class="header table_name">
                                            <img
                                              src="/images/salnik.svg"
                                              alt=""
                                              class="salnik"
                                            />
                                            <p class="text_blue_td fz15px">
                                              Сальник винтового блока
                                              <span>10 х 14 х 11</span>
                                            </p>
                                          </div>
                                          <div class="body">
                                            <div class="table_img">
                                              <img src="/images/items/1.png" alt="" />
                                            </div>
                                            <div>
                                              <p class="text_blue_td">10</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">14</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">11</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">14</p>
                                            </div>
                                          </div>
                                          <div class="footer">
                                            <div class="footer-input-section">
                                              <input
                                                class="footer-input"
                                                type="number"
                                                value="0"
                                                step="1"
                                                name=""
                                                id=""
                                              />
                                              <div class="buttons-section">
                                                <button
                                                  class="increment footer-button"
                                                ></button>
                                                <button
                                                  class="decrement footer-button"
                                                ></button>
                                              </div>
                                            </div>
                                            <button class="add-button footer-button">
                                              Добавить
                                            </button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="carousel-item">
                                    <div class="row items-row">
                                      <div class="col-6">
                                        <div class="item">
                                          <div class="header table_name">
                                            <img
                                              src="/images/salnik.svg"
                                              alt=""
                                              class="salnik"
                                            />
                                            <p class="text_blue_td fz15px">
                                              Сальник винтового блока
                                              <span>10 х 14 х 11</span>
                                            </p>
                                          </div>
                                          <div class="body">
                                            <div class="table_img">
                                              <img src="/images/items/1.png" alt="" />
                                              <img
                                                src="/images/akcia.svg"
                                                alt=""
                                                class="akcia"
                                              />
                                            </div>
                                            <div>
                                              <p class="text_blue_td">10</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">14</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">11</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">14</p>
                                            </div>
                                          </div>
                                          <div class="footer">
                                            <div class="footer-input-section">
                                              <input
                                                class="footer-input"
                                                type="number"
                                                value="0"
                                                step="1"
                                                name=""
                                                id=""
                                              />
                                              <div class="buttons-section">
                                                <button
                                                  class="increment footer-button"
                                                ></button>
                                                <button
                                                  class="decrement footer-button"
                                                ></button>
                                              </div>
                                            </div>
                                            <button class="add-button footer-button">
                                              Добавить
                                            </button>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-6">
                                        <div class="item">
                                          <div class="header table_name">
                                            <img
                                              src="/images/salnik.svg"
                                              alt=""
                                              class="salnik"
                                            />
                                            <p class="text_blue_td fz15px">
                                              Сальник винтового блока
                                              <span>10 х 14 х 11</span>
                                            </p>
                                          </div>
                                          <div class="body">
                                            <div class="table_img">
                                              <img src="/images/items/1.png" alt="" />
                                            </div>
                                            <div>
                                              <p class="text_blue_td">10</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">14</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">11</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">14</p>
                                            </div>
                                          </div>
                                          <div class="footer">
                                            <div class="footer-input-section">
                                              <input
                                                class="footer-input"
                                                type="number"
                                                value="0"
                                                step="1"
                                                name=""
                                                id=""
                                              />
                                              <div class="buttons-section">
                                                <button
                                                  class="increment footer-button"
                                                ></button>
                                                <button
                                                  class="decrement footer-button"
                                                ></button>
                                              </div>
                                            </div>
                                            <button class="add-button footer-button">
                                              Добавить
                                            </button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="carousel-item">
                                    <div class="row items-row">
                                      <div class="col-6">
                                        <div class="item">
                                          <div class="header table_name">
                                            <img
                                              src="/images/salnik.svg"
                                              alt=""
                                              class="salnik"
                                            />
                                            <p class="text_blue_td fz15px">
                                              Сальник винтового блока
                                              <span>10 х 14 х 11</span>
                                            </p>
                                          </div>
                                          <div class="body">
                                            <div class="table_img">
                                              <img src="/images/items/1.png" alt="" />
                                            </div>
                                            <div>
                                              <p class="text_blue_td">10</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">14</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">11</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">14</p>
                                            </div>
                                          </div>
                                          <div class="footer">
                                            <div class="footer-input-section">
                                              <input
                                                class="footer-input"
                                                type="number"
                                                value="0"
                                                step="1"
                                                name=""
                                                id=""
                                              />
                                              <div class="buttons-section">
                                                <button
                                                  class="increment footer-button"
                                                ></button>
                                                <button
                                                  class="decrement footer-button"
                                                ></button>
                                              </div>
                                            </div>
                                            <button class="add-button footer-button">
                                              Добавить
                                            </button>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-6">
                                        <div class="item">
                                          <div class="header table_name">
                                            <img
                                              src="/images/salnik.svg"
                                              alt=""
                                              class="salnik"
                                            />
                                            <p class="text_blue_td fz15px">
                                              Сальник винтового блока
                                              <span>10 х 14 х 11</span>
                                            </p>
                                          </div>
                                          <div class="body">
                                            <div class="table_img">
                                              <img src="/images/items/1.png" alt="" />
                                            </div>
                                            <div>
                                              <p class="text_blue_td">10</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">14</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">11</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">14</p>
                                            </div>
                                          </div>
                                          <div class="footer">
                                            <div class="footer-input-section">
                                              <input
                                                class="footer-input"
                                                type="number"
                                                value="0"
                                                step="1"
                                                name=""
                                                id=""
                                              />
                                              <div class="buttons-section">
                                                <button
                                                  class="increment footer-button"
                                                ></button>
                                                <button
                                                  class="decrement footer-button"
                                                ></button>
                                              </div>
                                            </div>
                                            <button class="add-button footer-button">
                                              Добавить
                                            </button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="carousel-item">
                                    <div class="row items-row">
                                      <div class="col-6">
                                        <div class="item">
                                          <div class="header table_name">
                                            <img
                                              src="/images/salnik.svg"
                                              alt=""
                                              class="salnik"
                                            />
                                            <p class="text_blue_td fz15px">
                                              Сальник винтового блока
                                              <span>10 х 14 х 11</span>
                                            </p>
                                          </div>
                                          <div class="body">
                                            <div class="table_img">
                                              <img src="/images/items/1.png" alt="" />
                                            </div>
                                            <div>
                                              <p class="text_blue_td">10</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">14</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">11</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">14</p>
                                            </div>
                                          </div>
                                          <div class="footer">
                                            <div class="footer-input-section">
                                              <input
                                                class="footer-input"
                                                type="number"
                                                value="0"
                                                step="1"
                                                name=""
                                                id=""
                                              />
                                              <div class="buttons-section">
                                                <button
                                                  class="increment footer-button"
                                                ></button>
                                                <button
                                                  class="decrement footer-button"
                                                ></button>
                                              </div>
                                            </div>
                                            <button class="add-button footer-button">
                                              Добавить
                                            </button>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-6">
                                        <div class="item">
                                          <div class="header table_name">
                                            <img
                                              src="/images/salnik.svg"
                                              alt=""
                                              class="salnik"
                                            />
                                            <p class="text_blue_td fz15px">
                                              Сальник винтового блока
                                              <span>10 х 14 х 11</span>
                                            </p>
                                          </div>
                                          <div class="body">
                                            <div class="table_img">
                                              <img src="/images/items/1.png" alt="" />
                                            </div>
                                            <div>
                                              <p class="text_blue_td">10</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">14</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">11</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">14</p>
                                            </div>
                                          </div>
                                          <div class="footer">
                                            <div class="footer-input-section">
                                              <input
                                                class="footer-input"
                                                type="number"
                                                value="0"
                                                step="1"
                                                name=""
                                                id=""
                                              />
                                              <div class="buttons-section">
                                                <button
                                                  class="increment footer-button"
                                                ></button>
                                                <button
                                                  class="decrement footer-button"
                                                ></button>
                                              </div>
                                            </div>
                                            <button class="add-button footer-button">
                                              Добавить
                                            </button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  </div>
                                <div class="carousel-inner normal-devices-slider">
                                  <div class="carousel-item active">
                                    <div class="row items-row">
                                      <div class="col-4">
                                        <div class="item">
                                          <div class="header table_name">
                                            <img
                                              src="/images/salnik.svg"
                                              alt=""
                                              class="salnik"
                                            />
                                            <p class="text_blue_td fz15px">
                                              Сальник винтового блока
                                              <span>10 х 14 х 11</span>
                                            </p>
                                          </div>
                                          <div class="body">
                                            <div class="table_img">
                                              <img src="/images/items/1.png" alt="" />
                                              <img
                                                src="/images/hit.svg"
                                                alt=""
                                                class="hit"
                                              />
                                            </div>
                                            <div>
                                              <p class="text_blue_td">10</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">14</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">11</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">14</p>
                                            </div>
                                          </div>
                                          <div class="footer">
                                            <input
                                              class="footer-input"
                                              type="number"
                                              value="0"
                                              step="1"
                                              name=""
                                              id=""
                                            />
                                            <div class="buttons-section">
                                              <button
                                                class="increment footer-button"
                                              ></button>
                                              <button
                                                class="decrement footer-button"
                                              ></button>
                                            </div>
                                            <button class="add-button footer-button">
                                              Добавить
                                            </button>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-4">
                                        <div class="item">
                                          <div class="header table_name">
                                            <img
                                              src="/images/salnik.svg"
                                              alt=""
                                              class="salnik"
                                            />
                                            <p class="text_blue_td fz15px">
                                              Сальник винтового блока
                                              <span>10 х 14 х 11</span>
                                            </p>
                                          </div>
                                          <div class="body">
                                            <div class="table_img">
                                              <img src="/images/items/1.png" alt="" />
                                              <img
                                                src="/images/akcia.svg"
                                                alt=""
                                                class="akcia"
                                              />
                                            </div>
                                            <div>
                                              <p class="text_blue_td">10</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">14</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">11</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">14</p>
                                            </div>
                                          </div>
                                          <div class="footer">
                                            <input
                                              class="footer-input"
                                              type="number"
                                              value="0"
                                              step="1"
                                              name=""
                                              id=""
                                            />
                                            <div class="buttons-section">
                                              <button
                                                class="increment footer-button"
                                              ></button>
                                              <button
                                                class="decrement footer-button"
                                              ></button>
                                            </div>
                                            <button class="add-button footer-button">
                                              Добавить
                                            </button>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-4">
                                        <div class="item">
                                          <div class="header table_name">
                                            <img
                                              src="/images/salnik.svg"
                                              alt=""
                                              class="salnik"
                                            />
                                            <p class="text_blue_td fz15px">
                                              Сальник винтового блока
                                              <span>10 х 14 х 11</span>
                                            </p>
                                          </div>
                                          <div class="body">
                                            <div class="table_img">
                                              <img src="/images/items/1.png" alt="" />
                                            </div>
                                            <div>
                                              <p class="text_blue_td">10</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">14</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">11</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">14</p>
                                            </div>
                                          </div>
                                          <div class="footer">
                                            <input
                                              class="footer-input"
                                              type="number"
                                              value="0"
                                              step="1"
                                              name=""
                                              id=""
                                            />
                                            <div class="buttons-section">
                                              <button
                                                class="increment footer-button"
                                              ></button>
                                              <button
                                                class="decrement footer-button"
                                              ></button>
                                            </div>
                                            <button class="add-button footer-button">
                                              Добавить
                                            </button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="carousel-item">
                                    <div class="row items-row">
                                      <div class="col-4">
                                        <div class="item">
                                          <div class="header table_name">
                                            <img
                                              src="/images/salnik.svg"
                                              alt=""
                                              class="salnik"
                                            />
                                            <p class="text_blue_td fz15px">
                                              Сальник винтового блока
                                              <span>10 х 14 х 11</span>
                                            </p>
                                          </div>
                                          <div class="body">
                                            <div class="table_img">
                                              <img src="/images/items/1.png" alt="" />
                                            </div>
                                            <div>
                                              <p class="text_blue_td">10</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">14</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">11</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">14</p>
                                            </div>
                                          </div>
                                          <div class="footer">
                                            <input
                                              class="footer-input"
                                              type="number"
                                              value="0"
                                              step="1"
                                              name=""
                                              id=""
                                            />
                                            <div class="buttons-section">
                                              <button
                                                class="increment footer-button"
                                              ></button>
                                              <button
                                                class="decrement footer-button"
                                              ></button>
                                            </div>
                                            <button class="add-button footer-button">
                                              Добавить
                                            </button>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-4">
                                        <div class="item">
                                          <div class="header table_name">
                                            <img
                                              src="/images/salnik.svg"
                                              alt=""
                                              class="salnik"
                                            />
                                            <p class="text_blue_td fz15px">
                                              Сальник винтового блока
                                              <span>10 х 14 х 11</span>
                                            </p>
                                          </div>
                                          <div class="body">
                                            <div class="table_img">
                                              <img src="/images/items/1.png" alt="" />
                                            </div>
                                            <div>
                                              <p class="text_blue_td">10</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">14</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">11</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">14</p>
                                            </div>
                                          </div>
                                          <div class="footer">
                                            <input
                                              class="footer-input"
                                              type="number"
                                              value="0"
                                              step="1"
                                              name=""
                                              id=""
                                            />
                                            <div class="buttons-section">
                                              <button
                                                class="increment footer-button"
                                              ></button>
                                              <button
                                                class="decrement footer-button"
                                              ></button>
                                            </div>
                                            <button class="add-button footer-button">
                                              Добавить
                                            </button>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-4">
                                        <div class="item">
                                          <div class="header table_name">
                                            <img
                                              src="/images/salnik.svg"
                                              alt=""
                                              class="salnik"
                                            />
                                            <p class="text_blue_td fz15px">
                                              Сальник винтового блока
                                              <span>10 х 14 х 11</span>
                                            </p>
                                          </div>
                                          <div class="body">
                                            <div class="table_img">
                                              <img src="/images/items/1.png" alt="" />
                                            </div>
                                            <div>
                                              <p class="text_blue_td">10</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">14</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">11</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">14</p>
                                            </div>
                                          </div>
                                          <div class="footer">
                                            <input
                                              class="footer-input"
                                              type="number"
                                              value="0"
                                              step="1"
                                              name=""
                                              id=""
                                            />
                                            <div class="buttons-section">
                                              <button
                                                class="increment footer-button"
                                              ></button>
                                              <button
                                                class="decrement footer-button"
                                              ></button>
                                            </div>
                                            <button class="add-button footer-button">
                                              Добавить
                                            </button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="carousel-item">
                                    <div class="row items-row">
                                      <div class="col-4">
                                        <div class="item">
                                          <div class="header table_name">
                                            <img
                                              src="/images/salnik.svg"
                                              alt=""
                                              class="salnik"
                                            />
                                            <p class="text_blue_td fz15px">
                                              Сальник винтового блока
                                              <span>10 х 14 х 11</span>
                                            </p>
                                          </div>
                                          <div class="body">
                                            <div class="table_img">
                                              <img src="/images/items/1.png" alt="" />
                                            </div>
                                            <div>
                                              <p class="text_blue_td">10</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">14</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">11</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">14</p>
                                            </div>
                                          </div>
                                          <div class="footer">
                                            <input
                                              class="footer-input"
                                              type="number"
                                              value="0"
                                              step="1"
                                              name=""
                                              id=""
                                            />
                                            <div class="buttons-section">
                                              <button
                                                class="increment footer-button"
                                              ></button>
                                              <button
                                                class="decrement footer-button"
                                              ></button>
                                            </div>
                                            <button class="add-button footer-button">
                                              Добавить
                                            </button>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-4">
                                        <div class="item">
                                          <div class="header table_name">
                                            <img
                                              src="/images/salnik.svg"
                                              alt=""
                                              class="salnik"
                                            />
                                            <p class="text_blue_td fz15px">
                                              Сальник винтового блока
                                              <span>10 х 14 х 11</span>
                                            </p>
                                          </div>
                                          <div class="body">
                                            <div class="table_img">
                                              <img src="/images/items/1.png" alt="" />
                                            </div>
                                            <div>
                                              <p class="text_blue_td">10</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">14</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">11</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">14</p>
                                            </div>
                                          </div>
                                          <div class="footer">
                                            <input
                                              class="footer-input"
                                              type="number"
                                              value="0"
                                              step="1"
                                              name=""
                                              id=""
                                            />
                                            <div class="buttons-section">
                                              <button
                                                class="increment footer-button"
                                              ></button>
                                              <button
                                                class="decrement footer-button"
                                              ></button>
                                            </div>
                                            <button class="add-button footer-button">
                                              Добавить
                                            </button>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-4">
                                        <div class="item">
                                          <div class="header table_name">
                                            <img
                                              src="/images/salnik.svg"
                                              alt=""
                                              class="salnik"
                                            />
                                            <p class="text_blue_td fz15px">
                                              Сальник винтового блока
                                              <span>10 х 14 х 11</span>
                                            </p>
                                          </div>
                                          <div class="body">
                                            <div class="table_img">
                                              <img src="/images/items/1.png" alt="" />
                                            </div>
                                            <div>
                                              <p class="text_blue_td">10</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">14</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">11</p>
                                            </div>
                                            <div>
                                              <p class="text_blue_td">14</p>
                                            </div>
                                          </div>
                                          <div class="footer">
                                            <input
                                              class="footer-input"
                                              type="number"
                                              value="0"
                                              step="1"
                                              name=""
                                              id=""
                                            />
                                            <div class="buttons-section">
                                              <button
                                                class="increment footer-button"
                                              ></button>
                                              <button
                                                class="decrement footer-button"
                                              ></button>
                                            </div>
                                            <button class="add-button footer-button">
                                              Добавить
                                            </button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                  <div class="carousel-inner large-devices-slider">
                                    <div class="carousel-item active">
                                      <div class="row items-row">
                                        <div class="col-2">
                                          <div class="item">
                                            <div class="header table_name">
                                              <img
                                                src="/images/salnik.svg"
                                                alt=""
                                                class="salnik"
                                              />
                                              <p class="text_blue_td fz15px">
                                                Сальник винтового блока
                                                <span>10 х 14 х 11</span>
                                              </p>
                                            </div>
                                            <div class="body">
                                              <div class="table_img">
                                                <img src="/images/items/1.png" alt="" />
                                                <img
                                                  src="/images/hit.svg"
                                                  alt=""
                                                  class="hit"
                                                />
                                              </div>
                                              <div>
                                                <p class="text_blue_td">10</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">14</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">11</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">14</p>
                                              </div>
                                            </div>
                                            <div class="footer">
                                              <input
                                                class="footer-input"
                                                type="number"
                                                value="0"
                                                step="1"
                                                name=""
                                                id=""
                                              />
                                              <div class="buttons-section">
                                                <button
                                                  class="increment footer-button"
                                                ></button>
                                                <button
                                                  class="decrement footer-button"
                                                ></button>
                                              </div>
                                              <button class="add-button footer-button">
                                                Добавить
                                              </button>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-2">
                                          <div class="item">
                                            <div class="header table_name">
                                              <img
                                                src="/images/salnik.svg"
                                                alt=""
                                                class="salnik"
                                              />
                                              <p class="text_blue_td fz15px">
                                                Сальник винтового блока
                                                <span>10 х 14 х 11</span>
                                              </p>
                                            </div>
                                            <div class="body">
                                              <div class="table_img">
                                                <img src="/images/items/1.png" alt="" />
                                                <img
                                                  src="/images/akcia.svg"
                                                  alt=""
                                                  class="akcia"
                                                />
                                              </div>
                                              <div>
                                                <p class="text_blue_td">10</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">14</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">11</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">14</p>
                                              </div>
                                            </div>
                                            <div class="footer">
                                              <input
                                                class="footer-input"
                                                type="number"
                                                value="0"
                                                step="1"
                                                name=""
                                                id=""
                                              />
                                              <div class="buttons-section">
                                                <button
                                                  class="increment footer-button"
                                                ></button>
                                                <button
                                                  class="decrement footer-button"
                                                ></button>
                                              </div>
                                              <button class="add-button footer-button">
                                                Добавить
                                              </button>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-2">
                                          <div class="item">
                                            <div class="header table_name">
                                              <img
                                                src="/images/salnik.svg"
                                                alt=""
                                                class="salnik"
                                              />
                                              <p class="text_blue_td fz15px">
                                                Сальник винтового блока
                                                <span>10 х 14 х 11</span>
                                              </p>
                                            </div>
                                            <div class="body">
                                              <div class="table_img">
                                                <img src="/images/items/1.png" alt="" />
                                              </div>
                                              <div>
                                                <p class="text_blue_td">10</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">14</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">11</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">14</p>
                                              </div>
                                            </div>
                                            <div class="footer">
                                              <input
                                                class="footer-input"
                                                type="number"
                                                value="0"
                                                step="1"
                                                name=""
                                                id=""
                                              />
                                              <div class="buttons-section">
                                                <button
                                                  class="increment footer-button"
                                                ></button>
                                                <button
                                                  class="decrement footer-button"
                                                ></button>
                                              </div>
                                              <button class="add-button footer-button">
                                                Добавить
                                              </button>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-2">
                                          <div class="item">
                                            <div class="header table_name">
                                              <img
                                                src="/images/salnik.svg"
                                                alt=""
                                                class="salnik"
                                              />
                                              <p class="text_blue_td fz15px">
                                                Сальник винтового блока
                                                <span>10 х 14 х 11</span>
                                              </p>
                                            </div>
                                            <div class="body">
                                              <div class="table_img">
                                                <img src="/images/items/1.png" alt="" />
                                              </div>
                                              <div>
                                                <p class="text_blue_td">10</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">14</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">11</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">14</p>
                                              </div>
                                            </div>
                                            <div class="footer">
                                              <input
                                                class="footer-input"
                                                type="number"
                                                value="0"
                                                step="1"
                                                name=""
                                                id=""
                                              />
                                              <div class="buttons-section">
                                                <button
                                                  class="increment footer-button"
                                                ></button>
                                                <button
                                                  class="decrement footer-button"
                                                ></button>
                                              </div>
                                              <button class="add-button footer-button">
                                                Добавить
                                              </button>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-2">
                                          <div class="item">
                                            <div class="header table_name">
                                              <img
                                                src="/images/salnik.svg"
                                                alt=""
                                                class="salnik"
                                              />
                                              <p class="text_blue_td fz15px">
                                                Сальник винтового блока
                                                <span>10 х 14 х 11</span>
                                              </p>
                                            </div>
                                            <div class="body">
                                              <div class="table_img">
                                                <img src="/images/items/1.png" alt="" />
                                              </div>
                                              <div>
                                                <p class="text_blue_td">10</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">14</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">11</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">14</p>
                                              </div>
                                            </div>
                                            <div class="footer">
                                              <input
                                                class="footer-input"
                                                type="number"
                                                value="0"
                                                step="1"
                                                name=""
                                                id=""
                                              />
                                              <div class="buttons-section">
                                                <button
                                                  class="increment footer-button"
                                                ></button>
                                                <button
                                                  class="decrement footer-button"
                                                ></button>
                                              </div>
                                              <button class="add-button footer-button">
                                                Добавить
                                              </button>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-2">
                                          <div class="item">
                                            <div class="header table_name">
                                              <img
                                                src="/images/salnik.svg"
                                                alt=""
                                                class="salnik"
                                              />
                                              <p class="text_blue_td fz15px">
                                                Сальник винтового блока
                                                <span>10 х 14 х 11</span>
                                              </p>
                                            </div>
                                            <div class="body">
                                              <div class="table_img">
                                                <img src="/images/items/1.png" alt="" />
                                              </div>
                                              <div>
                                                <p class="text_blue_td">10</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">14</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">11</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">14</p>
                                              </div>
                                            </div>
                                            <div class="footer">
                                              <input
                                                class="footer-input"
                                                type="number"
                                                value="0"
                                                step="1"
                                                name=""
                                                id=""
                                              />
                                              <div class="buttons-section">
                                                <button
                                                  class="increment footer-button"
                                                ></button>
                                                <button
                                                  class="decrement footer-button"
                                                ></button>
                                              </div>
                                              <button class="add-button footer-button">
                                                Добавить
                                              </button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="carousel-item">
                                      <div class="row items-row">
                                        <div class="col-2">
                                          <div class="item">
                                            <div class="header table_name">
                                              <img
                                                src="/images/salnik.svg"
                                                alt=""
                                                class="salnik"
                                              />
                                              <p class="text_blue_td fz15px">
                                                Сальник винтового блока
                                                <span>10 х 14 х 11</span>
                                              </p>
                                            </div>
                                            <div class="body">
                                              <div class="table_img">
                                                <img src="/images/items/1.png" alt="" />
                                                <img
                                                  src="/images/hit.svg"
                                                  alt=""
                                                  class="hit"
                                                />
                                              </div>
                                              <div>
                                                <p class="text_blue_td">10</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">14</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">11</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">14</p>
                                              </div>
                                            </div>
                                            <div class="footer">
                                              <input
                                                class="footer-input"
                                                type="number"
                                                value="0"
                                                step="1"
                                                name=""
                                                id=""
                                              />
                                              <div class="buttons-section">
                                                <button
                                                  class="increment footer-button"
                                                ></button>
                                                <button
                                                  class="decrement footer-button"
                                                ></button>
                                              </div>
                                              <button class="add-button footer-button">
                                                Добавить
                                              </button>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-2">
                                          <div class="item">
                                            <div class="header table_name">
                                              <img
                                                src="/images/salnik.svg"
                                                alt=""
                                                class="salnik"
                                              />
                                              <p class="text_blue_td fz15px">
                                                Сальник винтового блока
                                                <span>10 х 14 х 11</span>
                                              </p>
                                            </div>
                                            <div class="body">
                                              <div class="table_img">
                                                <img src="/images/items/1.png" alt="" />
                                                <img
                                                  src="/images/akcia.svg"
                                                  alt=""
                                                  class="akcia"
                                                />
                                              </div>
                                              <div>
                                                <p class="text_blue_td">10</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">14</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">11</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">14</p>
                                              </div>
                                            </div>
                                            <div class="footer">
                                              <input
                                                class="footer-input"
                                                type="number"
                                                value="0"
                                                step="1"
                                                name=""
                                                id=""
                                              />
                                              <div class="buttons-section">
                                                <button
                                                  class="increment footer-button"
                                                ></button>
                                                <button
                                                  class="decrement footer-button"
                                                ></button>
                                              </div>
                                              <button class="add-button footer-button">
                                                Добавить
                                              </button>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-2">
                                          <div class="item">
                                            <div class="header table_name">
                                              <img
                                                src="/images/salnik.svg"
                                                alt=""
                                                class="salnik"
                                              />
                                              <p class="text_blue_td fz15px">
                                                Сальник винтового блока
                                                <span>10 х 14 х 11</span>
                                              </p>
                                            </div>
                                            <div class="body">
                                              <div class="table_img">
                                                <img src="/images/items/1.png" alt="" />
                                              </div>
                                              <div>
                                                <p class="text_blue_td">10</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">14</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">11</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">14</p>
                                              </div>
                                            </div>
                                            <div class="footer">
                                              <input
                                                class="footer-input"
                                                type="number"
                                                value="0"
                                                step="1"
                                                name=""
                                                id=""
                                              />
                                              <div class="buttons-section">
                                                <button
                                                  class="increment footer-button"
                                                ></button>
                                                <button
                                                  class="decrement footer-button"
                                                ></button>
                                              </div>
                                              <button class="add-button footer-button">
                                                Добавить
                                              </button>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-2">
                                          <div class="item">
                                            <div class="header table_name">
                                              <img
                                                src="/images/salnik.svg"
                                                alt=""
                                                class="salnik"
                                              />
                                              <p class="text_blue_td fz15px">
                                                Сальник винтового блока
                                                <span>10 х 14 х 11</span>
                                              </p>
                                            </div>
                                            <div class="body">
                                              <div class="table_img">
                                                <img src="/images/items/1.png" alt="" />
                                              </div>
                                              <div>
                                                <p class="text_blue_td">10</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">14</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">11</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">14</p>
                                              </div>
                                            </div>
                                            <div class="footer">
                                              <input
                                                class="footer-input"
                                                type="number"
                                                value="0"
                                                step="1"
                                                name=""
                                                id=""
                                              />
                                              <div class="buttons-section">
                                                <button
                                                  class="increment footer-button"
                                                ></button>
                                                <button
                                                  class="decrement footer-button"
                                                ></button>
                                              </div>
                                              <button class="add-button footer-button">
                                                Добавить
                                              </button>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-2">
                                          <div class="item">
                                            <div class="header table_name">
                                              <img
                                                src="/images/salnik.svg"
                                                alt=""
                                                class="salnik"
                                              />
                                              <p class="text_blue_td fz15px">
                                                Сальник винтового блока
                                                <span>10 х 14 х 11</span>
                                              </p>
                                            </div>
                                            <div class="body">
                                              <div class="table_img">
                                                <img src="/images/items/1.png" alt="" />
                                              </div>
                                              <div>
                                                <p class="text_blue_td">10</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">14</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">11</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">14</p>
                                              </div>
                                            </div>
                                            <div class="footer">
                                              <input
                                                class="footer-input"
                                                type="number"
                                                value="0"
                                                step="1"
                                                name=""
                                                id=""
                                              />
                                              <div class="buttons-section">
                                                <button
                                                  class="increment footer-button"
                                                ></button>
                                                <button
                                                  class="decrement footer-button"
                                                ></button>
                                              </div>
                                              <button class="add-button footer-button">
                                                Добавить
                                              </button>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-2">
                                          <div class="item">
                                            <div class="header table_name">
                                              <img
                                                src="/images/salnik.svg"
                                                alt=""
                                                class="salnik"
                                              />
                                              <p class="text_blue_td fz15px">
                                                Сальник винтового блока
                                                <span>10 х 14 х 11</span>
                                              </p>
                                            </div>
                                            <div class="body">
                                              <div class="table_img">
                                                <img src="/images/items/1.png" alt="" />
                                              </div>
                                              <div>
                                                <p class="text_blue_td">10</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">14</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">11</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">14</p>
                                              </div>
                                            </div>
                                            <div class="footer">
                                              <input
                                                class="footer-input"
                                                type="number"
                                                value="0"
                                                step="1"
                                                name=""
                                                id=""
                                              />
                                              <div class="buttons-section">
                                                <button
                                                  class="increment footer-button"
                                                ></button>
                                                <button
                                                  class="decrement footer-button"
                                                ></button>
                                              </div>
                                              <button class="add-button footer-button">
                                                Добавить
                                              </button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="carousel-item">
                                      <div class="row items-row">
                                        <div class="col-2">
                                          <div class="item">
                                            <div class="header table_name">
                                              <img
                                                src="/images/salnik.svg"
                                                alt=""
                                                class="salnik"
                                              />
                                              <p class="text_blue_td fz15px">
                                                Сальник винтового блока
                                                <span>10 х 14 х 11</span>
                                              </p>
                                            </div>
                                            <div class="body">
                                              <div class="table_img">
                                                <img src="/images/items/1.png" alt="" />
                                                <img
                                                  src="/images/hit.svg"
                                                  alt=""
                                                  class="hit"
                                                />
                                              </div>
                                              <div>
                                                <p class="text_blue_td">10</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">14</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">11</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">14</p>
                                              </div>
                                            </div>
                                            <div class="footer">
                                              <input
                                                class="footer-input"
                                                type="number"
                                                value="0"
                                                step="1"
                                                name=""
                                                id=""
                                              />
                                              <div class="buttons-section">
                                                <button
                                                  class="increment footer-button"
                                                ></button>
                                                <button
                                                  class="decrement footer-button"
                                                ></button>
                                              </div>
                                              <button class="add-button footer-button">
                                                Добавить
                                              </button>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-2">
                                          <div class="item">
                                            <div class="header table_name">
                                              <img
                                                src="/images/salnik.svg"
                                                alt=""
                                                class="salnik"
                                              />
                                              <p class="text_blue_td fz15px">
                                                Сальник винтового блока
                                                <span>10 х 14 х 11</span>
                                              </p>
                                            </div>
                                            <div class="body">
                                              <div class="table_img">
                                                <img src="/images/items/1.png" alt="" />
                                                <img
                                                  src="/images/akcia.svg"
                                                  alt=""
                                                  class="akcia"
                                                />
                                              </div>
                                              <div>
                                                <p class="text_blue_td">10</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">14</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">11</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">14</p>
                                              </div>
                                            </div>
                                            <div class="footer">
                                              <input
                                                class="footer-input"
                                                type="number"
                                                value="0"
                                                step="1"
                                                name=""
                                                id=""
                                              />
                                              <div class="buttons-section">
                                                <button
                                                  class="increment footer-button"
                                                ></button>
                                                <button
                                                  class="decrement footer-button"
                                                ></button>
                                              </div>
                                              <button class="add-button footer-button">
                                                Добавить
                                              </button>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-2">
                                          <div class="item">
                                            <div class="header table_name">
                                              <img
                                                src="/images/salnik.svg"
                                                alt=""
                                                class="salnik"
                                              />
                                              <p class="text_blue_td fz15px">
                                                Сальник винтового блока
                                                <span>10 х 14 х 11</span>
                                              </p>
                                            </div>
                                            <div class="body">
                                              <div class="table_img">
                                                <img src="/images/items/1.png" alt="" />
                                              </div>
                                              <div>
                                                <p class="text_blue_td">10</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">14</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">11</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">14</p>
                                              </div>
                                            </div>
                                            <div class="footer">
                                              <input
                                                class="footer-input"
                                                type="number"
                                                value="0"
                                                step="1"
                                                name=""
                                                id=""
                                              />
                                              <div class="buttons-section">
                                                <button
                                                  class="increment footer-button"
                                                ></button>
                                                <button
                                                  class="decrement footer-button"
                                                ></button>
                                              </div>
                                              <button class="add-button footer-button">
                                                Добавить
                                              </button>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-2">
                                          <div class="item">
                                            <div class="header table_name">
                                              <img
                                                src="/images/salnik.svg"
                                                alt=""
                                                class="salnik"
                                              />
                                              <p class="text_blue_td fz15px">
                                                Сальник винтового блока
                                                <span>10 х 14 х 11</span>
                                              </p>
                                            </div>
                                            <div class="body">
                                              <div class="table_img">
                                                <img src="/images/items/1.png" alt="" />
                                              </div>
                                              <div>
                                                <p class="text_blue_td">10</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">14</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">11</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">14</p>
                                              </div>
                                            </div>
                                            <div class="footer">
                                              <input
                                                class="footer-input"
                                                type="number"
                                                value="0"
                                                step="1"
                                                name=""
                                                id=""
                                              />
                                              <div class="buttons-section">
                                                <button
                                                  class="increment footer-button"
                                                ></button>
                                                <button
                                                  class="decrement footer-button"
                                                ></button>
                                              </div>
                                              <button class="add-button footer-button">
                                                Добавить
                                              </button>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-2">
                                          <div class="item">
                                            <div class="header table_name">
                                              <img
                                                src="/images/salnik.svg"
                                                alt=""
                                                class="salnik"
                                              />
                                              <p class="text_blue_td fz15px">
                                                Сальник винтового блока
                                                <span>10 х 14 х 11</span>
                                              </p>
                                            </div>
                                            <div class="body">
                                              <div class="table_img">
                                                <img src="/images/items/1.png" alt="" />
                                              </div>
                                              <div>
                                                <p class="text_blue_td">10</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">14</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">11</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">14</p>
                                              </div>
                                            </div>
                                            <div class="footer">
                                              <input
                                                class="footer-input"
                                                type="number"
                                                value="0"
                                                step="1"
                                                name=""
                                                id=""
                                              />
                                              <div class="buttons-section">
                                                <button
                                                  class="increment footer-button"
                                                ></button>
                                                <button
                                                  class="decrement footer-button"
                                                ></button>
                                              </div>
                                              <button class="add-button footer-button">
                                                Добавить
                                              </button>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-2">
                                          <div class="item">
                                            <div class="header table_name">
                                              <img
                                                src="/images/salnik.svg"
                                                alt=""
                                                class="salnik"
                                              />
                                              <p class="text_blue_td fz15px">
                                                Сальник винтового блока
                                                <span>10 х 14 х 11</span>
                                              </p>
                                            </div>
                                            <div class="body">
                                              <div class="table_img">
                                                <img src="/images/items/1.png" alt="" />
                                              </div>
                                              <div>
                                                <p class="text_blue_td">10</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">14</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">11</p>
                                              </div>
                                              <div>
                                                <p class="text_blue_td">14</p>
                                              </div>
                                            </div>
                                            <div class="footer">
                                              <input
                                                class="footer-input"
                                                type="number"
                                                value="0"
                                                step="1"
                                                name=""
                                                id=""
                                              />
                                              <div class="buttons-section">
                                                <button
                                                  class="increment footer-button"
                                                ></button>
                                                <button
                                                  class="decrement footer-button"
                                                ></button>
                                              </div>
                                              <button class="add-button footer-button">
                                                Добавить
                                              </button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <button
                                    class="carousel-control-prev"
                                    type="button"
                                    data-target="#carouselControls"
                                    data-slide="prev"
                                  >
                                    <span
                                      class="carousel-control-prev-icon"
                                      aria-hidden="true"
                                    ></span>
                                    <span class="sr-only">Previous</span>
                                  </button>
                                  <button
                                    class="carousel-control-next"
                                    type="button"
                                    data-target="#carouselControls"
                                    data-slide="next"
                                  >
                                    <span
                                      class="carousel-control-next-icon"
                                      aria-hidden="true"
                                    ></span>
                                    <span class="sr-only">Next</span>
                                  </button>
                                </div> -->
                            </div>
                            <!-- <div class="col-9 normal-devices-slider">
                              <div
                                id="carouselExampleControls"
                                class="carousel slide"
                                data-ride="carousel"
                              >
                                <button
                                  class="carousel-control-prev"
                                  type="button"
                                  data-target="#carouselExampleControls"
                                  data-slide="prev"
                                >
                                  <span
                                    class="carousel-control-prev-icon"
                                    aria-hidden="true"
                                  ></span>
                                  <span class="sr-only">Previous</span>
                                </button>
                                <button
                                  class="carousel-control-next"
                                  type="button"
                                  data-target="#carouselExampleControls"
                                  data-slide="next"
                                >
                                  <span
                                    class="carousel-control-next-icon"
                                    aria-hidden="true"
                                  ></span>
                                  <span class="sr-only">Next</span>
                                </button>
                              </div>
                            </div>
                            <div class="col-8 small-devices-slider">
                              <div
                                id="carouselSmallControls"
                                class="carousel slide"
                                data-ride="carousel"
                              >

                                </div>
                                <button
                                  class="carousel-control-prev"
                                  type="button"
                                  data-target="#carouselSmallControls"
                                  data-slide="prev"
                                >
                                  <span
                                    class="carousel-control-prev-icon"
                                    aria-hidden="true"
                                  ></span>
                                  <span class="sr-only">Previous</span>
                                </button>
                                <button
                                  class="carousel-control-next"
                                  type="button"
                                  data-target="#carouselSmallControls"
                                  data-slide="next"
                                >
                                  <span
                                    class="carousel-control-next-icon"
                                    aria-hidden="true"
                                  ></span>
                                  <span class="sr-only">Next</span>
                                </button>
                              </div> -->
                        </div>
                    @else
                        <div class="row table_row cats_center_title">
                            <p class="cats_h2_title_sec">Товары в данной категории отсутствуют</p>
                        </div>
                    @endif
                    <div class="row item_text_bottom_row">
                        <div class="col-md-4">
                            <div class="item_text_bottom">
                                <p class="fz15px p_700">Если нет подходящего размера</p>
                                <p class="fz13px">
                                    Если у Вас не совпадает один из размеров сальника, лучше
                                    позвонить нашим специалистам и уточнить, поскольку
                                    сальники имеют стандартные размеры.
                                </p>
                                <p class="fz15px p_700">
                                    Производство сальников с заданными характеристиками
                                </p>
                                <p class="fz13px">
                                    Компания Пневмосистема может организовать производство
                                    специализированных сальников с заданными характеристиками.
                                    Изготовление осуществляется на современном оборудовании с
                                    использованием новейших технологий и высококачественных
                                    материалов. Образцы можно посмотреть в офисе компании,
                                    предварительно договорившись о встрече, и лично убедиться
                                    в их качестве.
                                </p>
                                <p class="fz15px p_700">Для чего применяется</p>
                                <p class="fz13px">
                                    В винтовой паре компрессора герметизирует зазор между
                                    ведущим винтом и корпусом пары. Корпус сальника стальной,
                                    с губками высокой прочности, обеспечивающими герметичность
                                    при рабочей температуре до 250 °С и давлением 25 бар, при
                                    частоте вращения вала до 10000 об/мин. Для большей
                                    надежности часто сальник винтового блока имеет несколько
                                    рабочих губок.
                                </p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="item_text_bottom">
                                <p class="fz15px p_700">
                                    Особенности сальников винтового блока компрессора
                                </p>
                                <p class="fz13px">
                                    Зачастую у потребителя возникает вопрос: в чем отличие
                                    сальника от манжета? И сальник и манжета предназначены для
                                    уплотнения механизмов и предотвращения просачивания
                                    жидкостей или газов между деталями и корпусом механизма,
                                    но манжеты не рассчитаны на высокое рабочее давление. Для
                                    исправной работы винтового блока необходимо своевременно
                                    производить замену изнашивающихся элементов, поскольку со
                                    временем даже самый надежный сальник подвержен износу. В
                                    случае износа губок произойдет разгерметизация винтового
                                    блока и масло из компрессора начнет течь наружу.
                                    Последствия этого для любого технаря очевидны — перегрев
                                    винтового блока и его последующее заклинивание.
                                </p>
                                <p class="red">
                                    Автомобильные сальники ни в коем случае не нужно
                                    устанавливать на Ваше компрессорное оборудование, так как
                                    их рабочее давление всего 0,5 бар, а значит
                                    герметизировать винтовой блок они не могут.
                                </p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="slider_sale">
                                <h2 class="h2_sale_slider">Вам может пригодиться</h2>

                                <div class="swiper second-swiper">
                                    <!-- Additional required wrapper -->
                                    <div class="swiper-wrapper">
                                        <!-- Slides -->
                                        <div class="swiper-slide">
                                            <img
                                                src="/images/maslo.png"
                                                alt=""
                                                class="sliders_img"
                                            />
                                            <p class="fz13px p_500 desc_sale_slider">
                                                Масло для винтовых и роторно-пластинчатых воздушных
                                                компрессоров
                                            </p>
                                        </div>
                                        <div class="swiper-slide">
                                            <img
                                                src="/images/maslo.png"
                                                alt=""
                                                class="sliders_img"
                                            />
                                            <p class="fz13px p_500 desc_sale_slider">
                                                Масло для винтовых и роторно-пластинчатых воздушных
                                                компрессоров
                                            </p>
                                        </div>
                                    </div>

                                    <!-- If we need navigation buttons -->
                                    <div class="swiper-button-prev second-swiper-prev"></div>
                                    <div class="swiper-button-next second-swiper-next"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
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
