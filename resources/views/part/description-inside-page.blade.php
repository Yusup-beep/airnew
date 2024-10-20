<div class="accord">
    <div class="accord_item">
        <h2 class="accord_h2">
            {{ $desc['caption'] }}
        </h2>
        <p class="accord_{{ $desc['right'] ? 'p' : '' }}">
            <span>
                {{ $desc['left'] }}
            </span>
            @if ($desc['right'])
                <img src="/images/collapse_arrow.svg" alt="" class="collapse_arrow hidden">
            @endif
        </p>
        @if ($desc['right'])
            <div class="cats_item" id="tab-in-1">
                <div class="fz13px text_blue">
                    <p class="text">
                        {{ $desc['right'] }}
                    </p>
                    <img src="/images/accord_arrow.svg" alt="">
                </div>
            </div>
        @endif
    </div>
</div>
