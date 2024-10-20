$(document).ready(function () {
    $('#css-toggle').click(function () {
        if ($(this).prop("checked") == false) {
            $('#css-light').prop('disabled', false)
            $('#css-dark').prop('disabled', true)
            window.localStorage.removeItem("user-prefers-color")
        } else if ($(this).prop("checked") == true) {
            $('#css-dark').prop('disabled', false)
            $('#css-light').prop('disabled', true)
            window.localStorage.setItem("user-prefers-color", 1)
        }
    })
    if (window.localStorage.getItem('user-prefers-color') !== null)
        $('#css-toggle').click()
    $(document).on('keypress', function (e) {
        if (e.originalEvent.code == 'KeyB') $('#css-toggle').click()
    })
})
