const get_url_params = swCalcGetUrlParams();

$(document).ready(function () {
    swCalcSendData({'entity': 'id_sw_calc_route'}, '/admin/index.php?route=extension/module/sw_calc/getRouteAndClothType&user_token=' + get_url_params['user_token']).then(response => {
        $('input[name="id_sw_calc_route"]').each(function () {
            swCalcCreateSelect($(this), response['sw_calc_route']);
        });

        $('input[name="id_sw_calc_cloth_type"]').each(function () {
            swCalcCreateSelect($(this), response['sw_calc_cloth_type']);
        });
    });

    $('body').on('change', 'select[name="id_sw_calc_route"], select[name="id_sw_calc_cloth_type"]', function () {
        $(this).find('option[value="'+ $(this).val() +'"]').attr('selected', '');
    });
});

/**
 * @param elem
 * @param entity_elems
 */
function swCalcCreateSelect(elem, entity_elems)
{
    elem.replaceWith(
        swCalcBuildSelect(entity_elems, elem.val(), elem)
    );
}

/**
 * @param data_for_build_select
 * @param id_selected
 * @param elem
 * @return {string}
 */
function swCalcBuildSelect(data_for_build_select, id_selected, elem)
{
    return '' +
        '<select name="'+ elem.attr('name') +'" form="'+ elem.attr('form') +'" class="loader-select" required>' +
            swCalcBuildOption(data_for_build_select, id_selected) +
        '</select>';
}

/**
 * @param data_for_build_select
 * @param id_selected
 * @return {string}
 */
function swCalcBuildOption(data_for_build_select, id_selected)
{
    let option = '';
    for (let key in data_for_build_select) {
        const selected = (key === id_selected) ? 'selected' : '';

        option += '<option value="'+ data_for_build_select[key]['id'] +'" '+ selected +' >'+ data_for_build_select[key]['name'] +'</option>';
    }

    return option;
}

/**
 * @return {{}}
 */
function swCalcGetUrlParams()
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
async function swCalcSendData(data, url)
{
    return new Promise((resolve) => {
        $.ajax({
            url: url,
            method: 'post',
            dataType: 'json',
            data: data,
            success: function(response){
                resolve(response);
            }
        });
    })
}