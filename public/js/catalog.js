let mainData = {
    quantity: 0,
    items: [],
}
function addProductToCart(el, productId) {
    console.log(el)
    const input = document.getElementById(`product-${productId}-quantity`)

    const existItem = mainData.items.filter(item => item.product_id == productId)[0]
    send(productId, parseInt(input.value) + parseInt((existItem ? existItem.amount : 0)))
    input.value = 0
}

function incrementProductQuantity(productId) {
    console.log(this)
    const input = document.getElementById(`product-${productId}-quantity`)
    input.value = parseInt(input.value) + 1
}

function decrementProductQuantity(productId) {
    const input = document.getElementById(`product-${productId}-quantity`)
    if (parseInt(input.value) >= 1) {
        input.value = parseInt(input.value) - 1
    }
}
function send(productId, quantity) {
    $.ajax({
        url: "/api/cart",
        type: "POST",
        dataType: 'json',
        data: {
            product_id: productId,
            quantity: quantity,
        },
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            updateProductsQuantity(data)
        },
    })
}
function updateProductsQuantity(data) {
    $('.footer-input').each(function () {
        $(this).val('0')
    })
    $('.num_cart').text(data.quantity)
    mainData = data
}


$.ajax({
    url: "/api/cart",
    type: "GET",
    dataType: 'json',
    xhrFields: {
        withCredentials: true
    },
    success: function (data) {
        updateProductsQuantity(data)
    },
})

