<div id="cart-items">
    @foreach ($items as $item)
        <div class="card rounded-3" id="item-{{ $item['product']->id }}">
            <div class="card-body">
                <div class="row d-flex justify-content-between align-items-center">
                    <div class="col-md-1 col-lg-1 col-xl-1 text-center closer_box">
                        <button onclick="removeItem({{ $item['product']->id }})" style="appearance: none;border:none;background: transparent;" class="text-danger closer">
                            <img src="images/close_cart.png" alt="">
                        </button>
                    </div>
                    @if (isset($item['product']->image_path))
                        <div class="col-md-1 col-lg-1 col-xl-1 col-2">
                            <div class="cart_img_box">
                                <img src="{{ asset('storage/' . $item['product']->image_path) }}" class="img-fluid rounded-3 cart_img">
                            </div>
                        </div>
                    @else
                        <div class="col-md-1 col-lg-1 col-xl-1 col-2">
                            <div class="cart_img_box">
                                <img src="/images/plug.png" class="img-fluid rounded-3 cart_img">
                            </div>
                        </div>
                    @endif

                    <div class="col-md-5 col-lg-5 col-xl-5 col-10">
                        <p class="cart_zag">{{ $item['product']->name }}</p>

                    </div>
                    <div class="col-md-3 col-lg-2 col-xl-2 col-4">
                        <h5 class="mb-0 cart_price">150 р/шт</h5>
                    </div>

                    <div class="col-md-3 col-lg-3 col-xl-3 d-flex cart_forms col-3">

                        <input min="0" name="quantity" id="product-{{ $item['product']->id }}-quantity" value="{{ $item['amount'] }}" type="number" class="form-control product-quantity form-control-sm" />
                        <div class="buttons-section">
                            <button class="increment footer-button" onclick="incrementProductQuantity({{ $item['product']->id }})" data-action="increment"></button>
                            <button class="decrement footer-button" onclick="decrementProductQuantity({{ $item['product']->id }})" data-action="decrement"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
