<div {{ $loop->index > 2 ? 'id = search-item' : '' }} class="form-group calc_gor_item align-items-center {{ $loop->index > 2 ? 'collapse' : 'd-flex' }}">
    <label class="font-weight-bolder my-0 p-0" for="{{ $key }}">{{ $name[0] }}</label>
    <input type="text" id="{{ $key }}" name="{{ $key }}" wire:model="searchdata.{{ $key }}" class="form-control calc_input" />
    <a class="" data-toggle="popover" data-trigger="click" data-placement="top" title="{{ $name[1] }}">
        <img class="d-block" src="/images/white.png" alt="" />
    </a>
</div>
