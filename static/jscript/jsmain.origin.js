//requirejs.config({
//    baseUrl: './',
//    paths: {}
//});

requirejs([
    // primary
    'primary/main',
    // helper
    'platform/core/main',
    //
    'bootstrap/main',
    // chat module
    'platform/message/main',
    //// activity module
    'platform/feed/main',
    // link module
    'platform/link/main',
    //// photo
    'platform/photo/main'
], function () {

});