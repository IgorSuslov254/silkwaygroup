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
});