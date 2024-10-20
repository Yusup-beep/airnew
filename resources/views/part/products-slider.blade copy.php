<div class="row">
    <div class="col-3 col-md-2 side-menu">
        @foreach ($keys as $key)
            <p class="text_blue_td_flow text_slide fz13px p_700" :wire:key="$key">
                {{ $key }}
            </p>
        @endforeach
    </div>
    <div class="col-8 col-md-10 swiper-section">
        <div class="swiper first-swiper">
            <div class="swiper-wrapper" :wire:key="$products[0]->id">
                @include('part.catalog-swiper-item')
            </div>
            <div class="swiper-button-next first-swiper-next"></div>
            <div class="swiper-button-prev first-swiper-prev"></div>
        </div>
    </div>
</div>
<div class="products-slider-empty"></div>
@section('scripts')
    @parent
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            function slider(data) {
                if (typeof(first_swiper) == 'undefined')
                    first_swiper = new Swiper(".first-swiper", {
                        spaceBetween: 25,
                        loop: false,
                        navigation: {
                            nextEl: ".first-swiper-next",
                            prevEl: ".first-swiper-prev",
                        },
                        breakpoints: {
                            300: {
                                slidesPerView: {{ $slidesPerView }} / 4,
                                spaceBetween: 30,
                            },
                            700: {
                                slidesPerView: {{ $slidesPerView }} / 2,
                            },
                            1000: {
                                slidesPerView: {{ $slidesPerView }},
                            }
                        },
                    });
                else {
                    $('.swiper-wrapper').html(data)
                    first_swiper.updateSlides()
                }
            }
            document.querySelectorAll('.salnik').forEach(element => {
                element.onclick = (e) => {
                    e.target.parentNode.parentNode.parentNode.remove()
                }
            })
            $('.footer-input').each(function() {
                const productId = parseInt($(this).attr('id').replace('product-', '').replace('-quantity', ''))
                $(this).on('change', e => {
                    send(productId, parseInt(e.target.value))
                })
            })
            document.getElementById('form-search').addEventListener('submit', (e) => {
                e.preventDefault()
                fetch(e.target.action, {
                    method: 'POST',
                    body: new FormData(e.target),
                }).then(resp => resp.text()).then(data => {
                    slider(data)
                }).catch(error => {
                    console.error(error)
                })
            })
            slider()
        })
    </script>
@endsection
