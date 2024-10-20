<div class="{{ $fromto ? '' : 'col-12' }}">
  @if ($keys)
      <div class="row">
          <div class="{{ $fromto ? 'col-md-6 offset-md-3 mt-5' : 'col-md-3 offset-md-3' }}">
              <form wire:submit="search" class="text-light calc">
                  @csrf
                  <input type="hidden" name="showRows" wire:model="showRows">
                  @if ($fromto)
                      @foreach ($keys as $key => $name)
                          @include('part.search-item' . $fromto)
                      @endforeach

                      <div class="row d-flex justify-content-between">
                          <div class="col-md-4">
                              <div style="width: 119px; margin-right: 30px;">
                                  <a id="more" class="small font-weight-bold text-white collapsed" data-toggle="collapse" data-target="#search-item" aria-expanded="false">{{ count($keys) > 2 ? 'Еще' : '' }}</a>
                              </div>
                          </div>
                          <div style="margin: -44px 20px 0 20px;">
                              <button type="submit" class="btn submit_podbor">Подобрать</button>
                          </div>
                      </div>

                  @else
                      @foreach ($keys as $key => $name)
                          @include('part.search-item' . $fromto)
                      @endforeach
                      <div class="form-group d-flex align-items-center mb-0 mt-2">
                          <div style="width: 119px; margin-right: 30px;">
                              <a id="more" class="small font-weight-bold text-white collapsed" data-toggle="collapse" data-target="#search-item" aria-expanded="false">{{ count($keys) > 2 ? 'Еще' : '' }}</a>
                          </div>
                          <button type="submit" class="btn submit_podbor">Подобрать</button>
                      </div>
                  @endif
              </form>
          </div>
          <div class="col-md-4">
              <div class="item_text_center text_blue fz13px">
                  {!! $text !!}
              </div>
          </div>
      </div>
  @endif
  @if (is_string($products))
      <div class="row table_row cats_center_title products-slider-empty">
          <p class="cats_h2_title_sec">{{ $products }}</p>
      </div>
  @else
      @php
          if (is_int(array_keys($products)[0])) {
              $products_temp[] = $products;
          } else {
              $products_temp = $products;
          }
      @endphp
      @foreach ($products_temp as $products)
          @include('part.catalog-swiper-item', ['button_class' => $button_class])
      @endforeach
  @endif
  <div class="products-slider-empty"></div>
</div>
@section('scripts')
  @parent
  <script>
      function initSwiper() {
          new Swiper('.first-swiper', {
              slidesPerView: 7,
              spaceBetween: 25,
              loop: false,
              speed: 400,
              navigation: {
                  nextEl: '.first-swiper-next',
                  prevEl: '.first-swiper-prev',
              },
              breakpoints: {
                  300: {
                      slidesPerView: 2,
                      spaceBetween: 30,

                  },
                  700: {
                      slidesPerView: 3,
                  },
                  1000: {
                      slidesPerView: 7,
                  }
              },
          });
      }

      Livewire.hook('morph.updated', ({ component, el }) => {
          initSwiper();
      })

      Livewire.on('search', () => {
          initSwiper();
      })

      $('#more').click(function(params) {
          $('input[name="showRows"]').val($('input[name="showRows"]').val() === 'true' ? 'false' : 'true');
      });

      $('#search-item').on('show.bs.collapse', function (el) {
          var $parent = $(this).parent();
          $parent.children().addClass('d-flex');
          $('#more').html('Скрыть');
      });

      $('#search-item').on('hide.bs.collapse', function (el) {
          var $parent = $(this).parent();
          // $parent.children('.collapse').removeClass('d-flex');
          $('#more').html('Еще');
      });
  </script>
@endsection
