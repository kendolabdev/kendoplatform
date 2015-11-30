requirejs.config({
    //enforceDefine: true,
    baseUrl: './jscript',
    paths: {
        'jquery': 'kendo/jquery/jquery',
        'bootstrap': 'kendo/bootstrap/bootstrap',
        'jqueryui': 'kendo/jquery-ui/jqueryui',
        'underscore': 'kendo/underscore/underscore.min'
    },
    shim: {
        'bootstrap': {
            deps: ['jquery'],
            exports: 'bootstrap'
        },
        'jqueryui': {
            deps: ['jquery'],
            exports: 'jqueryui',
        },
        'underscore': {
            deps: ['jquery'],
            exports: '_',
        }
    }
});

require([
    'jquery',
    'underscore',
    'bootstrap',
    'jqueryui',
    'kendo/platform/main',
    'kendo/jquery-base/main'
], function () {

});