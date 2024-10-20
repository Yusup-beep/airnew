// callback
document.addEventListener('DOMContentLoaded', () => {
    const callbackForm = document.getElementById('callback-form')
    const callbackName = document.getElementById('callback-name')
    const callbackPhone = document.getElementById('callback-phone')
    const callbackMessage = document.getElementById('callback-message')
    const callbackNameErr = document.getElementById('callback-name-error')
    const callbackPhoneErr = document.getElementById('callback-phone-error')
    const callbackMessageErr = document.getElementById('callback-message-error')
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    callbackForm.addEventListener('submit', e => {
        e.preventDefault()
        callbackName.style.border = ''
        callbackPhone.style.border = ''
        callbackMessage.style.border = ''

        $.ajax({
            url: "/api/callback",
            type: "POST",
            dataType: 'json',
            data: {
                name: callbackName.value,
                phone: callbackPhone.value,
                message: callbackMessage.value,
            },
            xhrFields: {
                withCredentials: true
            },
            success: function () {
                const recallDialog = document.getElementById('recall')
                recallDialog.classList.remove('show')

                callbackName.value = ''
                callbackPhone.value = ''
                callbackMessage.value = ''
            },
            error: function (err) {
                console.log(err)

                const errors = err.responseJSON.errors

                if (errors.name) {
                    callbackName.style.border = '1px solid red'
                    // callbackNameErr.innerText = errors.name
                }
                if (errors.phone) {
                    callbackPhone.style.border = '1px solid red'
                    // callbackPhoneErr.innerText = errors.phone
                }
                if (errors.message) {
                    callbackMessage.style.border = '1px solid red'
                    // callbackMessageErr.innerText = errors.message
                }
            },
        })
    })
})
// end callback

$(window).on("load resize", function (e) {
    if (window.matchMedia('(max-width: 720px)').matches) {
        $('.page').css('transform', "scale(" + ($('body').width() /
            400) + ")")
        $('.logo').attr('src', "/images/logo-mob.png")
        //$('.page').css('transform',"scale(1)");
        $('.swiper-slide-active img').attr('src', "/images/slider-mob-1.png")

    } else {
        $('.page').css('transform', "scale(" + ($('body').width() / 1440) + ")")
        $('.logo').attr('src', '/storage/images/logo.png')

    }
})
$(document).ready(function () {
    $('[data-toggle="popover"]').popover()

    $('#cart-upload').click(function (e) {
        e.preventDefault()
        const form = $('#cart-upload-form')
        const input = form.find('input[type=file]')
        input.click()
    })

    $(".project_item").each(function () {
        let more = $(this).find(".show_link > .show_link_span")
        let hide = $(this).find(".project_item_text_hide")
        hide.hide()
        more.click(function (e) {
            e.preventDefault()
            hide.slideToggle(500)
            more.text(more.text() == "скрыть" ? "подробнее" : "скрыть")
            $('.project_item_text').height("auto")
        })
    })


    $('#mobile-menu-button').on('click', function (event) {
        event.preventDefault()
        $(this).toggleClass('active_menu')
        $('.nav_menu').slideToggle("fast")
        $('.swiper-slide img').toggleClass('blur_img_slider')
    })

    $('#burder-open').on('click', function (event) {
        event.preventDefault()
        $('.navbar-mob').slideToggle("fast")
    })

    $('#open-catalog-mob').on('click', function (event) {
        event.preventDefault()
        $('.navbar-mob-menu').slideToggle("active_mob_menu")
    })
    $('.accord_item').on('click', function () {
        $('.accord_item').removeClass('active')
        $(this).addClass('active')
        $('.cats_right').html($(this).find('.cats_item').html())
        $('.cats_right').show()
    })
    $('.accord_item').eq(0).click()

    new Swiper(".second-swiper", {
        loop: true,
        autoplay: {
            delay: 5000,
        },
        autoHeight: true,
        speed: 400,
        spaceBetween: 100,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: ".second-swiper-next",
            prevEl: ".second-swiper-prev",
        },
        scrollbar: {
            el: '.swiper-scrollbar',
        },
        breakpoints: {
            390: {
                height: 480,
            },
        },
    })

}) //end
