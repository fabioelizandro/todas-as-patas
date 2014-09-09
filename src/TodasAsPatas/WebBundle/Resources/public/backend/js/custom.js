$(function() {

    $('select').each(function() {
        if ($(this).find('option[value=""]').length > 0) {
            $(this).select2({allowClear: true});
        } else {
            $(this).select2({allowClear: false});
        }
    });

    $('[data-provider="datepicker"]').datetimepicker({
        autoclose: true,
        format: 'dd/mm/yyyy',
        language: 'fr',
        minView: 'month',
        pickerPosition: 'bottom-left',
        todayBtn: true,
        startView: 'month'
    });

    $('[data-provider="datetimepicker"]').datetimepicker({
        autoclose: true,
        format: 'dd/mm/yyyy hh:ii',
        language: 'fr',
        pickerPosition: 'bottom-left',
        todayBtn: true
    });

    $('[data-provider="timepicker"]').datetimepicker({
        autoclose: true,
        format: 'hh:ii',
        formatViewType: 'time',
        maxView: 'day',
        minView: 'hour',
        pickerPosition: 'bottom-left',
        startView: 'day'
    });

    // Restore value from hidden input
    $('input[type=hidden]', '.date').each(function() {
        if ($(this).val()) {
            $(this).parent().datetimepicker('setValue');
        }
    });

    $('form').on('DOMSubtreeModified', function(event) {
        $('input[mask-type="money"]').inputmask('decimal', {
            rightAlign: true,
            radixPoint: ",",
            autoGroup: true,
            groupSeparator: ".",
            groupSize: 3,
            digits: 2
        });
        
        jQuery(event.target).find('select').each(function(element) {
            if ($(this).hasClass('select2-offscreen')) {
                return;
            }
            if ($(this).find('option[value=""]').length > 0) {
                $(this).select2({allowClear: true});
            } else {
                $(this).select2({allowClear: false});
            }
        });

    });

    $('input[mask-type="money"]').inputmask('decimal', {
        rightAlign: true,
        radixPoint: ",",
        autoGroup: true,
        groupSeparator: ".",
        groupSize: 3,
        digits: 2
    });

});