(function ($) {

    $(document).on('click', '[data-control="select-option"]', function () {

        var element = $(this),
            control = element.closest('.dropdown-control'),
            input = control.find('input.hidden:first'),
            label = control.find('span.txt-label:first');

        console.log(element.attr('value'), element.attr('label'));

        input.val(element.attr('value'));
        label.text(element.attr('label'));
    });
})(jQuery);