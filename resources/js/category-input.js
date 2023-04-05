let choices_inputs = [];

(function (window, document) {

    let fields = Array.prototype.slice.call(
        document.querySelectorAll('select[data-provides="anomaly.field_type.select"][data-search]')
    );

    fields.forEach(function (field, index) {
        choices_inputs[index] = new Choices(field, {
            shouldSort: false,
            classNames: {
                containerOuter: 'choices ' + 'category-select-' + (index + 1) + (index > 0 ? ' hidden' : ''),
            }
        });
    });

    for (let i = 0; i <= 5; i++) {
        $('#category-select-' + i).on('change', select_option_event)
    }

    $('button[data-action="select"]').on('click', function () {
        $.get(REQUEST_ROOT_PATH + '/api/categories/get-categories?id=' + $(this).data('value'), function (response) {

            let parents = '';

            $.map(response.data.parents.reverse(), function (value, index) {
                parents += value.name + (index < response.data.parents.length - 1 ? " > " : "");
            });

            $('input[name="category"]').val(response.data.entry.id);
            $('#category-modal').modal('hide');
            $('.selected-category td').text(parents);
            $('.selected-category').removeClass('hidden');
        });
    })

})(window, document);

function select_option_event() {
    let element = $(this);
    $.get(REQUEST_ROOT_PATH + '/api/categories/get-categories?parent=' + element.val(), function (response) {
        if (response.success) {
            if (Object.keys(response.data).length > 0) {
                $.each(response.data, function (id, value) {
                    $('#category-select-' + (element.data('index') + 1)).append(`<option value="${id}">${value}</option>`);
                })

                query_data = $.map(response.data, function (item, index) {
                    return {
                        value: index,
                        label: item
                    };
                });

                choices_inputs[element.data('index')].setChoices(query_data, "value", "label", false);

                $('.category-select-' + (element.data('index') + 1)).removeClass('hidden');
            } else {
                $('button[data-action="select"]').data('value', element.val());
                $('.category-select-action').removeClass('hidden');
            }
        }
    })
}