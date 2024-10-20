<form action="{{ route('pages.submit-cart') }}" method="POST" class="send-cart">
    @csrf
    <div class="cart_contact">
        <h2 class="cart_h2">
            Реквизиты
        </h2>
        <div class="cart_contact_box">
            <div class="form-group row">
                <label for="ur" class="col-sm-3 col-form-label">Юридическое лицо*</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control required" id="ur" name="ur" value="{{ old('ur', '') }}" requiredd placeholder="">
                </div>
            </div>
            <div class="form-group row">
                <label for="inn" class="col-sm-3 col-form-label">ИНН*</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="inn" name="inn" value="{{ old('inn', '') }}" placeholder="" requiredd>
                </div>
            </div>
            @if (false)
                <div class="form-group row">
                    <label for="ogrn" class="col-sm-3 col-form-label">ОГРН*</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="ogrn" name="ogrn" value="{{ old('ogrn', '') }}" placeholder="" requiredd>
                    </div>
                </div>
            @endif
            <div class="form-group row">
                <label for="uradr" class="col-sm-3 col-form-label">Юридический адрес*</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="uradr" name="uradr" value="{{ old('uradr', '') }}" placeholder="" requiredd>
                </div>
            </div>
            <div class="form-group row">
                <label for="bank" class="col-sm-3 col-form-label">Банк*</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="bank" name="bank" value="{{ old('bank', '') }}" placeholder="" requiredd>
                </div>
            </div>
            <div class="form-group row">
                <label for="bik" class="col-sm-3 col-form-label">БИК*</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="bik" name="bik" value="{{ old('bik', '') }}" placeholder="" requiredd>
                </div>
            </div>
            <div class="form-group row">
                <label for="chet" class="col-sm-3 col-form-label">Расчетный счет*</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="chet" name="chet" value="{{ old('chet', '') }}" placeholder="" requiredd>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check text-right">
                    <label class="form-check-label" id="need_delivery_l" for="need_delivery">
                        Нужна доставка
                    </label>
                    <input onclick="needDelivery()" class="form-check-input" type="checkbox" name="need_delivery" id="need_delivery" value="1">
                </div>
            </div>
            <div class="form-group row form-group-delivery" style="display: none;">
                <label for="delivery" class="col-sm-3 col-form-label">Адрес доставки</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="delivery" name="delivery" rows="3">{{ old('delivery', '') }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="cart_contact">
        <h2 class="cart_h2">
            Контактное лицо
        </h2>
        <div class="cart_contact_box">
            <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label">Имя*</label>
                <div class="col-sm-9">
                    <input type="text" requiredd class="form-control" id="name" name="name" value="{{ old('name', '') }}" placeholder="">
                </div>
            </div>
            <div class="form-group row">
                <label for="phone" class="col-sm-3 col-form-label">Телефон*</label>
                <div class="col-sm-9">
                    <input type="text" requiredd class="form-control" id="phone" name="phone" value="{{ old('phone', '') }}" placeholder="">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">E-mail*</label>
                <div class="col-sm-9">
                    <input type="text" requiredd class="form-control" id="email" name="email" value="{{ old('email', '') }}" placeholder="">
                </div>
            </div>
            <div class="form-group row">
                <label for="comment" class="col-sm-3 col-form-label">Комментарий</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="comment" name="comment" rows="3">
                    {{ old('comment', '') }}
                    </textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check text-right">
                    <label class="form-check-label" for="need_call">
                        Нужно созвониться
                    </label>
                    <input class="form-check-input" type="checkbox" name="need_call" id="need_call" value="1">
                </div>
            </div>
            <div class="form-group">
                <div class="submit">
                    <a href="{{ route('cart.download') }}" style="{{ session()->has('cart') && !count(session()->get('cart')) ? 'pointer-events: none;' : '' }}" class="btn btn-secondary">Сохранить список</a>
                    <button type="button" class="btn btn-secondary">Добавить из списка</button>
                    <button type="button" class="btn btn-secondary cart-upload">Загрузить список</button>
                    <button type="submit" class="btn btn-primary">Отправить запрос</button>
                </div>
            </div>
        </div>
    </div>
</form>
