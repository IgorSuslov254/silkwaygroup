const get_url_params = getUrlParams();

$(document).ready(function () {
    sendData({'entity': 'id_sw_calc_route'}, '/admin/index.php?route=extension/module/sw_calc/getRouteAndClothType&user_token=' + get_url_params['user_token']).then(data => {
        $('input[name="id_sw_calc_route"]').each(function () {
            setSelect($(this), data['response']['sw_calc_route'], $(this).val());
        });

        $('input[name="id_sw_calc_cloth_type"]').each(function () {
            setSelect($(this), data['response']['sw_calc_cloth_type'], $(this).val());
        });
    });

    $('body')
        .on('click', 'select[name="id_sw_calc_route"]', function () {
            sendData({'entity': 'id_sw_calc_route'}, '/admin/index.php?route=extension/module/sw_calc/getSelect&user_token=' + get_url_params['user_token']).then(data => {
                setSelect($(this), data['response'], undefined);
            });

            return false;
        })
        .on('click', 'select[name="id_sw_calc_cloth_type"]', function () {
            sendData({'entity': 'id_sw_calc_cloth_type'}, '/admin/index.php?route=extension/module/sw_calc/getSelect&user_token=' + get_url_params['user_token']).then(data => {
                setSelect($(this), data['response'], undefined);
            });

            return false;
        })
});

function setSelect(elem, data, value = undefined)
{
    if (value !== undefined) {
        let new_data = {};
        new_data[value] = data[value];
        data = new_data;
    } else {
        if (data[elem.val()] === undefined) {
            data[0] = {
                'id': elem.val(),
                'name': elem.text()
            }
        }
    }

    if (value === '') {
        data = {
            0: {
                'id': '',
                'name': 'Выбере значение'
            }
        }
    }

    if (value !== undefined) {
        let select = '<select name="'+ elem.attr('name') +'" form="'+ elem.attr('form') +'">';

        for (let key in data) {
            select += '<option value="'+ data[key]['id'] +'" selected>'+ data[key]['name'] +'</option>';
        }

        select += '</select>'

        elem.replaceWith(select);
    } else {
        let select = '';

        for (let key in data) {
            if (elem.val() === key) {
                select += '<option value="'+ data[key]['id'] +'" selected>'+ data[key]['name'] +'</option>';
            } else {
                select += '<option value="'+ data[key]['id'] +'">'+ data[key]['name'] +'</option>';
            }
        }

        elem.html(select);
    }


}

/**
 * @return {{}}
 */
function getUrlParams()
{
    return window
        .location
        .search
        .replace('?','')
        .split('&')
        .reduce(
            function(p,e){
                var a = e.split('=');
                p[ decodeURIComponent(a[0])] = decodeURIComponent(a[1]);
                return p;
            },
            {}
        );
}

/**
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