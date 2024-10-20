<div class="modal fade" id="recall" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Заказать звонок</h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <div class="modal-body">
                <form id="callback-form">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Ваше имя</label>

                        <input type="text" class="form-control" name="name" id="callback-name">
                        <div style="font-size: 14px;color: white;" id="callback-name-error">

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tel" class="col-sm-3 col-form-label">Телефон</label>
                        <input type="text" class="form-control" name="phone" id="callback-phone">
                        <div style="font-size: 14px;color: white;" id="callback-phone-error">

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sms" class="col-sm-3 col-form-label">Сообщение</label>
                        <textarea class="form-control" id="callback-message" name="message" rows="3"></textarea>
                        <div style="font-size: 14px;color: white;" id="callback-message-error">

                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" id="order_call">Заказать</button>
                </form>
            </div>

        </div>
    </div>
</div>
