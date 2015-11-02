//requirejs.config({
//    baseUrl: './',
//    paths: {}
//});

requirejs([
    // primary
    'primary/main',
    // helper
    'base/core/main',
    //// chat module
    'base/message/main',
    //// activity module
    'base/activity/main',
    // link module
    'base/link/main',
    //// photo
    'base/photo/main'
], function () {

});