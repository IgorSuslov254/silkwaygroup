$(document).ready(function () {
    $('#sw-calc-modal form').submit(function () {
        const elem_answer = $('#sw-calc-modal .modal-footer > p');

        elem_answer
            .text(elem_answer.data('text-load'))
            .removeClass('hidden');

        $.ajax({
            url: links_calc['calc'],
            method: 'post',
            dataType: 'json',
            data: $(this).serialize(),
            success: function(response){
                if (response['status'] === 'success') {
                    elem_answer
                        .text(elem_answer.data('text-answer') + response['price'] + '$')
                        .removeClass('text-danger');
                }

                if (response['status'] === 'error') {
                    elem_answer
                        .text(elem_answer.data('text-error'))
                        .addClass('text-danger');
                }
            }
        });

       return false;
    });
})