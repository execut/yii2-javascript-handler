(function () {
    // Patch for Samsung Internet (Browser) V 7.2
    // see: https://github.com/SamsungInternet/support/issues/56
    if(navigator.userAgent.match(/SamsungBrowser\/7\.2/i)){
        Function.prototype.ToString = function () { return this.toString(); }
    }

    // Patch for chrome , see https://stackoverflow.com/questions/26483541/referenceerror-cant-find-variable-gcrweb
    if (!window.__gCrWeb) window['__gCrWeb'] = {};

    $.widget("execut.JavascriptHandlerWidget", {
        options: {
            errorsLimit: 100,
            debug: false,
            handleUrl: '/javascriptHandler/handle',
        },
        _create: function () {
            var t = this;
            t._initElements();
            t._initEvents();
        },
        _initElements: function () {
            var t = this,
                el = t.element,
                opts = t.options;
        },
        _initEvents: function () {
            var t = this,
                el = t.element,
                opts = t.options;
            window.onerror = function(msg, url, lineNo, columnNo, error) {
                var errorData = {
                    message: msg,
                    errorUrl: url,
                    lineNo: lineNo,
                    columnNo: columnNo,
                    url: document.location.href,
                    error: error,
                };

                if (typeof error.stack !== 'undefined') {
                    errorData.stack = error.stack;
                }

                $.post(opts.handleUrl,{
                    data:errorData
                });
                return false;
            };
            if (opts.debug) {
                setTimeout(function () {
                    asdasdasd23();
                }, 2000);
            }
        }
    });
}());