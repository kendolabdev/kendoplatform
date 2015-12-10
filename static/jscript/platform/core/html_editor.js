define(['wysiwyg-html5/bootstrap3-wysihtml5.all'], function () {

    var checkEditors;

    checkEditors = function () {
        $('[data-initialize="html_editor"]').each(function (index, element) {

            var $element = $(element);

            $element.wysihtml5({});
            //
            //console.log('data');
        });
    };

    window.checkEditors = checkEditors;
});