$(document).ready(() => {

    $('#upload-file, #uploaded-file').click(function() {
        $(this).children('i').toggleClass('fa-caret-down').toggleClass('fa-caret-up')
    })

    $('input').change(eventName => {
        $('#file-upload').click()
    })
})