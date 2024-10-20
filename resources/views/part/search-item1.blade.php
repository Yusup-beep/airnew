<div {{ $loop->index > 2 ? 'id = search-item' : '' }} class="fromto row mb-3{{ $loop->index > 2 ? ' collapse' : '' }} {{ $showRows ? ' show' : '' }}">
    <div class="col-md-4">
        <div class="calc_left">
            <p class="calc_left_p_top">{{ $name[0] }}</p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="calc_center">
            <div class="form-group d-flex align-items-center m-0">
                <label class="m-0" for="{{ $key }}from">от</label>
                <input type="text" id="{{ $key }}from" wire:model="searchdata.{{ $key }}.from" class="col-3 form-control calc_input">
                <label class="m-0" for="{{ $key }}to">до</label>
                <input type="text" id="{{ $key }}to" wire:model="searchdata.{{ $key }}.to" class="col-3 form-control calc_input">
                <div class="hint ml-3" data-toggle="popover" data-trigger="click" data-placement="top" title="{{ $name[1] }}">
                    <img src="/images/white.png" alt="" />
                </div>
            </div>
        </div>
    </div>
</div>
