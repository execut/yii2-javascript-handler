(function () {
    // Patch for Samsung Internet (Browser) V 7.2
    // see: https://github.com/SamsungInternet/support/issues/56
    if (navigator.userAgent.match(/SamsungBrowser\/7\.2/i)) {
        Function.prototype.ToString = function () {
            return this.toString();
        }
    }

    // Patch for chrome , see https://stackoverflow.com/questions/26483541/referenceerror-cant-find-variable-gcrweb
    if (!window.__gCrWeb) {
        window['__gCrWeb'] = {};
    }

    // https://lealog.hateblo.jp/entry/2015/02/24/131643
    window.__gCrWeb.autofill = window.__gCrWeb.autofill || {};
    window.__gCrWeb.autofill.extractForms = window.__gCrWeb.autofill.extractForms || function() {};
    window.__gCrWeb.innerSizeAsString = window.__gCrWeb.innerSizeAsString || function() {};
    window.__gCrWeb.getElementFromPoint = window.__gCrWeb.getElementFromPoint || function() {};

    // Patch for old chrome 49.0.2623.75
    if (!Object.entries) {
        Object.entries = function (obj) {
            var ownProps = Object.keys(obj),
                i = ownProps.length,
                resArray = new Array(i); // preallocate the Array

            while (i--)
                resArray[i] = [ownProps[i], obj[ownProps[i]]];
            return resArray;
        };
    }


    $.widget("execut.JavascriptHandlerWidget", {
        options: {
            errorsLimit: 100,
            debug: false,
            handleUrl: '/javascriptHandler/handle'
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

            window.onerror = function (message, errorUrl, lineNo, columnNo, error) {
                return t._onError(message, errorUrl, lineNo, columnNo, error);
            };
            if (opts.debug) {
                setTimeout(function () {
                    asdasdasd23();
                }, 2000);
            }
        },
        _onError: function (message, errorUrl, lineNo, columnNo, error) {
            var t = this,
                el = t.element,
                opts = t.options,
                errorData = {
                    message: message,
                    errorUrl: errorUrl,
                    lineNo: lineNo,
                    columnNo: columnNo,
                    url: document.location.href,
                    error: error
                };

            if (typeof error.stack !== 'undefined') {
                errorData.stack = error.stack;
            }

            $.post(opts.handleUrl,{
                data:errorData
            });
            return false;
        }
    });
}());