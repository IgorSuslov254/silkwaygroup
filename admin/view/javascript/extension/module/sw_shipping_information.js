$(document).ready(function () {
    $('#input-status').change(function () {
        $('.loader-block').removeClass('hidden');

        $.ajax({
            url: enable_link,
            method: 'post',
            dataType: 'json',
            data: $(this).serialize(),
            success: function(data){
                $('.loader-block').before(data.response).addClass('hidden');
            }
        });
    });

    $('form').submit(function () {
        // $('.loader-block').removeClass('hidden');

        // console.log(($(this).attr('id') === 'create') ? create_link : update_link);

        // $.ajax({
        //     url: ($(this).attr('id') === 'create') ? create_link : update_link,
        //     method: 'post',
        //     dataType: 'json',
        //     data: $(this).serialize()  + '&id=' + $(this).attr('id'),
        //     success: function(data){
        //         $('.loader-block').before(data.response).addClass('hidden');
        //
        //         if ($(this).attr('id') === 'create') {
        //
        //         }
        //     }
        // });

        console.log($('#content > .container-fluid table tr[data-name="create"]').prev().data('id'));

        return false;
    })
});