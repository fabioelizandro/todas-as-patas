$(function () {
    $("input:checkbox, input:radio").uniform();

    $("#todasaspatas_apibundle_organization_address_city").select2({
        placeholder: "Busque uma Cidade",
        minimumInputLength: 3,
        ajax: {
            url: Routing.generate('app_city_index', null, true),
            dataType: 'json',
            quietMillis: 100,
            data: function (term, page) {
                return {
                    query: term,
                    page: page
                };
            },
            results: function (data, page) {
                var more = false;
                if (data.next_page > 0) {
                    more = true;
                }
                return {results: data.resources, more: more};
            }
        },
        initSelection: function (element, callback) {
            var id = $(element).val();
            if (id !== "") {
                $.ajax(Routing.generate('app_city_show', {id: id}), {
                    dataType: "json"
                }).done(function (data) {
                    callback(data);
                });
            }
        },
        formatSelection: function (item) {
            return item.name + ' ' + item.state.acronym;
        },
        formatResult: function (item) {
            return item.name + ' ' + item.state.acronym;
        }
    });
});