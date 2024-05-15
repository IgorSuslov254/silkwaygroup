$(document).ready(function () {
    $('#input-status').change(function () {
        $('.loader-block').removeClass('hidden');

        $.ajax({
            url: link,
            method: 'post',
            dataType: 'json',
            data: $(this).serialize(),
            success: function(data){
                $('.loader-block').before(data.response).addClass('hidden');
            }
        });
    });

    $('form').submit(function () {
        let data = $(this).serialize() + '&id=' + $(this).attr('id');

        console.log(data)

        return false;
    })
});