requirejs.config({
    "baseUrl": "\/kendoplatform\/static\/jscript\/",
    "paths": {
        "jquery": "kendo\/jquery\/jquery",
        "bootstrap": "kendo\/bootstrap\/bootstrap",
        "jqueryui": "kendo\/jquery-ui\/jqueryui",
        "underscore": "kendo\/underscore\/underscore.min",
        "jquery-ext": "kendo\/jquery-ext\/jquery-ext",
        "kd": "kendo\/core\/main"
    },
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
    "jquery-ext",
    "kd",
    "platform\/comment\/main",
    "platform\/layout\/main",
    "platform\/user\/main",
    "platform\/feed\/main",
    "platform\/group\/main",
    "platform\/photo\/main",
    "platform\/social\/main",
    "platform\/event\/main",
    "platform\/search\/main",
    "platform\/mail\/main",
    "platform\/help\/main",
    "platform\/relation\/main",
    "platform\/report\/main",
    "platform\/like\/main",
    "platform\/share\/main",
    "platform\/follow\/main",
    "platform\/review\/main",
    "platform\/notification\/main",
    "platform\/invitation\/main",
    "platform\/link\/main",
    "platform\/message\/main"
], function(){});