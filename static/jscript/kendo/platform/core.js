(function(){
    var Core;
    Core = {
        /**
         * Base options
         */
        options: {
            baseUrl: '/',
            logged: false,
            isUser: false
        },
        /**
         * Set options
         * @param options
         */
        setOptions: function (options) {
            this.options = $.extend({}, this.options, options);
        },
        /**
         * get options
         * @returns {*}
         */
        getOptions: function () {
            return this.options;
        },
        /**
         * @returns {string}
         */
        getBaseUrl: function () {
            return this.options.baseUrl;
        },
        /**
         *
         * @param {string} url
         * @param {object|undefined|string} data
         * @returns {string}
         */
        getUrl: function (url, data) {

            var h = '';

            if (typeof data == 'string') {
                h = '?' + data;
            } else if (typeof data == 'object') {
                h = '?' + $.param(data);
            }

            return this.getBaseUrl() + url.replace(/^\/+/, '') + h;
        },
        /**
         * Open modal box
         * @param url
         * @param data
         */
        modal: function (url, data) {
            data = $.extend({isDialog: true}, data);
            return K.ajax(url, data)
                .done(function (response) {
                    Hyves.create(response.html).show();
                });
        },
        /**
         * Close model box
         */
        closeModal: function () {
            Hyves.destroy();
        },
        /**
         * General id then
         * @param {string} prefix
         * @param {number} count
         * @returns {string}
         */
        newId: function (prefix, count) {
            if (typeof count == 'undefined') {
                count = 10;
            }
            if (typeof prefix == 'undefined') {
                prefix = '_';
            }

            if (prefix == '') {
                prefix = '_';
            }

            var response = prefix;

            var seek = 'qwertyuiopasdfghjklzxcvbnm';
            var max = seek.length;
            for (var i = 0; i < count; ++i) {
                response += seek.charAt(Math.round(Math.random() * max));
            }
            return response;
        },
        /**
         * Generate new id for an element
         * @param {Element} e element
         * @param {string} prefix
         * @returns {string}
         */
        idIfNot: function (e, prefix) {
            if (!e.attr('id')) {
                e.attr('id', this.newId(prefix))
            }
            return e.attr('id');
        },
        /**
         * Create ajax request
         * @param url
         * @param data
         * @returns {jQuery.ajax}
         */
        ajax: function (url, data) {
            return $.ajax({
                url: K.getUrl(url),
                data: arguments[1],
                method: 'post',
                dataType: 'json'
            });
        },
        /**
         * Current viewer logged?
         *
         * @returns {boolean}
         */
        logged: function () {
            return this.options.logged
        },
        /**
         * Current viewer is user
         *
         * @returns {boolean}
         */
        isUser: function () {
            return this.options.isUser
        },
        authRequired: function () {
            if (!this.logged()) {
                this.modal('ajax/user/auth/login-dialog', {msg: 'core.login_required'});
                return false;
            }
            return true;
        }
    };
    window.K = Core;
})(jQuery);