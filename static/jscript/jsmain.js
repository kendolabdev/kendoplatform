requirejs.config({
    "baseUrl": ".\/jscript",
    "paths": {
        "jquery": "kendo\/jquery\/jquery",
        "bootstrap": "kendo\/bootstrap\/bootstrap",
        "jqueryui": "kendo\/jquery-ui\/jqueryui",
        "underscore": "kendo\/underscore\/underscore.min"
    },
    "bundles": [],
    "shim": {
        "bootstrap": {
            "deps": [
                "jquery"
            ],
            "exports": "bootstrap"
        },
        "jqueryui": {
            "deps": [
                "jquery"
            ],
            "exports": "jqueryui"
        },
        "underscore": {
            "deps": [
                "jquery"
            ],
            "exports": "_"
        }
    }
});
require([
    "jquery",
    "underscore",
    "bootstrap",
    "jqueryui",
    "kendo\/platform\/main",
    "kendo\/jquery-base\/main",
    "base\/comment\/main",
    "base\/layout\/main",
    "base\/feed\/main",
    "base\/group\/main",
    "base\/photo\/main",
    "base\/event\/main",
    "base\/search\/main",
    "base\/mail\/main",
    "base\/help\/main",
    "base\/relation\/main",
    "base\/report\/main",
    "base\/like\/main",
    "base\/share\/main",
    "base\/follow\/main",
    "base\/review\/main",
    "base\/notification\/main",
    "base\/invitation\/main",
    "base\/link\/main",
    "base\/message\/main"
], function () {
});