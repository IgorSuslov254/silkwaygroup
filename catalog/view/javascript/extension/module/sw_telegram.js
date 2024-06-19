$(document).ready(function () {
    sw_telegram.map(function (value) {
        let selector = value['selector'].replace(/&quot;/g, '"');

        $(selector).click(function () {
            showModal(value['name'], value['description']);

            return false;
        });
    });

    $('#sw-telegram-modal form').submit(function () {
        let button = $(this).find('button[type="submit"]');
        button
            .attr('disabled', 'disabled')
            .text(button.data('loading-text'));

        $.ajax({
            url: sw_telegram_links.send_telegram_link,
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

    $('#sw-telegram-modal').on('hidden.bs.modal', function (e) {
        const button = $('#sw-telegram-modal form button[type="submit"]');

        button
            .removeAttr('disabled')
            .text(button.data('text'));

        $('#sw-telegram-modal form').trigger("reset");
    })

    if (typeof IMask !== "undefined") {
        IMask($('#sw-telegram-modal input[name="phone"]')[0], {
            mask: '+{7}(000)000-00-00'
        });
    }
});

function showModal(name, description)
{
    $('#sw-telegram-modal h2').text(name);
    $('#sw-telegram-modal h3').text(description);
    $('#sw-telegram-modal').modal('show');
}