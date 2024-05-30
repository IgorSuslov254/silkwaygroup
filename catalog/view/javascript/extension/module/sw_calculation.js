$(document).ready(function () {
    $('#sw_calculation form').submit(function () {
        $.ajax({
            url: links.send_telegram_link,
            method: 'post',
            dataType: 'json',
            data: $(this).serialize(),
            success: function(data){
                console.log(data);
            }
        });

        return false;
    });
});