$(document).ready(function () {
    $('#sw_calculation form').submit(function () {
        let button = $(this).find('button');
        button
            .attr('disabled', 'disabled')
            .text(button.data('loading-text'));

        $.ajax({
            url: links.send_telegram_link,
            method: 'post',
            dataType: 'json',
            data: $(this).serialize(),
            success: function(data){
                if (data.status === 'success') {
                    button
                        .text(button.data('success'))
                        .removeClass('btn-default')
                        .addClass('btn-success');
                } else {
                    button
                        .text(button.data('error'))
                        .removeClass('btn-default')
                        .addClass('btn-danger');
                }
            }
        });

        return false;
    });

    setMask($('#sw_calculation input[name="phone"]'));
});

function setMask (elem)
{
    IMask(elem[0], {
        mask: elem.data('mask')
    });
}