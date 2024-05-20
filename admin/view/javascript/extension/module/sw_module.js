$(document).ready(function () {
    $('#input-status').change(function () {
        $('.loader-block').removeClass('hidden');

        sendData($(this).serialize(), enable_link).then(data => {
            $('.loader-block').before(data.response).addClass('hidden');
        });
    });

    $('body')
        .on('submit', 'form', function () {
            $('.loader-block').removeClass('hidden');

            let submit = $(this);

            if (submit.attr('id') === 'create') {
                createTd(submit);
            } else {
                sendData(submit.serialize()  + '&id=' + submit.attr('id') + '&method=update', cud_link).then(data => {
                    $('.loader-block').before(data.response).addClass('hidden');
                });
            }

            return false;
        })
        .on('click', '.button-delete-js', function () {
            $('.loader-block').removeClass('hidden');

            let elem = $(this);

            sendData({
                'id': elem.data('id'),
                'method': 'delete'
            }, cud_link).then(data => {
                $('.loader-block').before(data.response).addClass('hidden');
                $('#content > .container-fluid table tr[data-id="'+ elem.data('id') +'"]').remove();
            });

            return false;
        });
});

/**
 * @return void
 * @param submit
 */
function createTd(submit)
{
    let elem = undefined;
    let createElem = undefined;
    let afterElem = undefined;
    let dataObj = {};

    submit.serializeArray().map(function (dataArr) {
        if (dataArr.name === 'sort' && dataArr.value === '') dataArr.value = 0;

        dataObj[dataArr.name] = dataArr.value;
    })

    $('#content > .container-fluid table tr').each(function () {
        if (dataObj.sort >= $(this).data('sort')) afterElem = $(this);
    });

    sendData(submit.serialize()  + '&id=' + submit.attr('id') + '&method=create', cud_link).then(data => {
        $('.loader-block').before(data.response).addClass('hidden');

        elem = $('#content > .container-fluid table tr[data-name="create"]');
        createElem = elem.clone(true);
        createElem
            .removeAttr('data-name')
            .attr({
                'data-id': data.id,
                'data-sort': dataObj.sort
            })
            .hide()
            .find('td:first-child')
            .text(data.id);
        createElem.find('input').attr('form', data.id);
        createElem.find('td:last-child').replaceWith('<td class="text-right">' +
            '<button type="submit" form="'+ data.id +'" data-toggle="tooltip" title="" class="btn btn-info" data-original-title="'+ text_button_update +'">' +
            '<i class="fa fa-pencil"></i>' +
            '</button>' +
            '<button data-id="'+ data.id +'" data-toggle="tooltip" title="" class="btn btn-warning button-delete-js" data-original-title="'+ text_button_delete +'">' +
            '<i class="fa fa-trash-o"></i>' +
            '</button>' +
            '</td>');
        createElem.find('a[id="thumb-image-create"]').attr('id', 'thumb-image' + data.id);
        createElem.find('input[id="input-image-create"]').attr('id', 'input-image' + data.id);

        if (afterElem === undefined) {
            elem.before(createElem);
        } else {
            afterElem.after(createElem);
        }

        createElem.fadeIn('slow');

        $("form[id=\"create\"]").trigger("reset");
        $("a[id=\"thumb-image-create\"] > img").attr('src', $('a[id="thumb-image-create"] > img').data('placeholder'));

        $('form[id="create"]').before('<form id="'+ data.id +'" class="hidden"></form>');
    });
}

/**
 *
 * @param data
 * @param url
 * @return {Promise<unknown>}
 */
async function sendData(data, url)
{
    return new Promise((resolve) => {
        $.ajax({
            url: url,
            method: 'post',
            dataType: 'json',
            data: data,
            success: function(data){
                resolve(data);
            }
        });
    })
}