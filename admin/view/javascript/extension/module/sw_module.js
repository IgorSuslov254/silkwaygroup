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

            if (submit.hasClass('create')) {
                createTd(submit);
            } else {
                sendData(submit.serialize()  + '&id=' + submit.data('id') + '&method=update' + '&table_name=' + submit.data('table'), cud_link).then(data => {
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
                'method': 'delete',
                'table_name': elem.data('table')
            }, cud_link).then(data => {
                $('.loader-block').before(data.response).addClass('hidden');

                $('#content > .container-fluid table tr[data-id="'+ elem.data('table') + elem.data('id') +'"]').remove();
                $('#content > .container-fluid form[id="'+ elem.data('table') + elem.data('id') +'"]').remove();
            });

            return false;
        });

    $('#content .nav > li > a').click(function () {
        $('#content .nav > li').removeClass('active');
        $('#content table').hide();

        $(this).parents('li').addClass('active');
        $('#content table[data-id="'+ $(this).data('action') +'"]').show();

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

    $('#content > .container-fluid table[data-id="'+ submit.attr('id') +'"] tr').each(function () {
        if (dataObj.sort >= $(this).data('sort')) afterElem = $(this);
    });

    sendData(submit.serialize()  + '&id=' + submit.attr('id') + '&method=create' + '&table_name=' + submit.attr('id'), cud_link).then(data => {
        $('.loader-block').before(data.response).addClass('hidden');

        if (data.status === 'error') return false;

        elem = $('#content > .container-fluid table[data-id="'+ submit.attr('id') +'"] tr[data-name="create"]');
        createElem = elem.clone(true);
        createElem
            .removeAttr('data-name')
            .attr({
                'data-id': submit.attr('id') + data.id,
                'data-sort': dataObj.sort
            })
            .hide()
            .find('td:first-child')
            .text(data.id);
        createElem.find('input').attr('form', submit.attr('id') + data.id);
        createElem.find('select').attr('form', submit.attr('id') + data.id);
        createElem.find('td:last-child').replaceWith(
            '<td class="text-right">' +
                '<button type="submit" form="'+ submit.attr('id') + data.id +'" data-toggle="tooltip" title="" class="btn btn-info" data-original-title="'+ text_button_update +'">' +
                    '<i class="fa fa-pencil"></i>' +
                '</button>' +
                '<button data-id="'+ data.id +'" data-table="'+ submit.attr('id') +'" data-toggle="tooltip" title="" class="btn btn-warning button-delete-js" data-original-title="'+ text_button_delete +'">' +
                    '<i class="fa fa-trash-o"></i>' +
                '</button>' +
            '</td>');
        createElem.find('a[id="thumb-image-create"]').attr('id', 'thumb-image' + submit.attr('id') + data.id);
        createElem.find('input[id="input-image-create"]').attr('id', 'input-image' + submit.attr('id') + data.id);

        if (afterElem === undefined) {
            elem.before(createElem);
        } else {
            afterElem.after(createElem);
        }

        createElem.fadeIn('slow');

        $('form[id="'+ submit.attr('id') +'"]').trigger('reset');
        $('tr[data-name="create"] #thumb-image-createsw_services + input[name="photo"]').val('');

        const reset_img = $('tr[data-name="create"] #thumb-image-createsw_services > img');
        reset_img.attr('src', reset_img.data('placeholder'));


        $('a[id="thumb-image-'+ submit.attr('id') +'"] > img').attr('src', $('a[id="thumb-image-'+ submit.attr('id') +'"] > img').data('placeholder'));
        $('form[id="'+ submit.attr('id') +'"]').before('<form id="'+ submit.attr('id') + data.id +'" data-table="'+ submit.attr('id') +'" data-id="'+ data.id +'" class="hidden"></form>');
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