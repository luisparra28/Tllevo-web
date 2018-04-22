'use strict';

/**
 * uShip namespace
 * Defines a library of common utilities

 */
(function (root) {
    var previousuShip = root.uship;

    var uship = void 0;
    if (typeof root.exports !== 'undefined') {
        uship = root.exports;
    } else {
        uship = root.uship = {};
    }

    var isArray = Array.isArray || function (obj) {
        return Object.prototype.toString.call(obj) == '[object Array]';
    };

    /**
     * Returns a nested namespace. Takes three argument forms:
     *    var module = uship.namespace('path.to.module');
     *    var module = uship.namespace(['path', 'to', 'module']);
     *    var module = uship.namespace('path', 'to', 'module');
     * ...where the path to the module is a series of nested namespaces that may or may not have been initialized
     */
    uship.namespace = function (namespacePath) {
        var namespaceParts = void 0;

        if (arguments.length > 1) {
            namespaceParts = toArray(arguments);
        } else if (isArray(namespacePath)) {
            namespaceParts = namespacePath;
        } else if (typeof namespacePath === 'string') {
            namespaceParts = namespacePath.split('.');
        }

        if (!namespaceParts) throw new Error('Either pass in a single string with dot-separated namespaces, an array of namespace strings, or a separate string param for each namespace');

        if (namespaceParts[0].toLowerCase() === 'uship') {
            namespaceParts = namespaceParts.slice(1);
        }

        return addPartToNamespace(uship, namespaceParts);
    };

    var nsProto = {
        extend: function extend(source) {
            _extend(this, source);
            return this;
        }
    };

    function addPartToNamespace(ns, parts) {
        if (parts.length === 0) return ns;
        var first = parts.shift();
        if (!ns[first]) ns[first] = Object.create(nsProto);
        return addPartToNamespace(ns[first], parts);
    }

    //Utilities

    function identity(x) {
        return x;
    }

    function noop() {
        return undefined;
    }

    function toType(obj) {
        // IE requires some special-case handling, otherwise returns 'object' for both of the below
        if (obj === null) return 'null';
        if (obj === undefined) return 'undefined';
        // Angus Croll (http://javascriptweblog.wordpress.com/2011/08/08/fixing-the-javascript-typeof-operator)
        return {}.toString.call(obj).match(/\s([a-zA-Z]+)/)[1].toLowerCase();
    }

    function isObject(obj) {
        return toType(obj) === 'object';
    }

    function isFunction(obj) {
        return toType(obj) === 'function';
    }

    function isString(obj) {
        return toType(obj) === 'string';
    }

    function isNumber(obj) {
        return toType(obj) === 'number';
    }

    function isTruthy(obj) {
        return !!obj;
    }

    function isBoolean(obj) {
        return toType(obj) === 'boolean';
    }

    function isNullOrUndefined(obj) {
        var type = toType(obj);
        return type === 'null' || type === 'undefined';
    }

    function toArray(args, ix) {
        return Array.prototype.slice.call(args, ix || 0);
    }

    function format(template /*, ...replacements*/) {
        var replacements = toArray(arguments, 1);
        for (var i = 0, j = replacements.length; i < j; i++) {
            template = template.replace(new RegExp('\\{' + i + '\\}', 'g'), replacements[i]);
        }
        return template;
    }

    function getCookie(cname) {
        var name = cname + '=';
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
        }
        return '';
    }

    function setCookie(cname, cvalue) {
        document.cookie = cname + '=' + cvalue + '; ';
    }

    /**
     * Ensures that the given argument can be called as a function:
     *
     *    var definitelyFn = asCallable(maybeFn);
     *    definitelyFn(); // calling maybeFn would throw if maybeFn is not a function
     *
     * @param {*} maybeFn - value to ensure is callable
     * @param {string|function} instead - function to call if maybeFn is not callable, OR the string 'identity' to return the value of maybeFn
     * @returns {function}
     */
    function asCallable(maybeFn, instead) {
        if (isFunction(maybeFn)) return maybeFn;
        if (isFunction(instead)) return instead;
        if (instead === 'identity') return partial(identity, maybeFn);
        return noop;
    }

    function _extend(target, source /*, ...sources */) {
        if (source) {
            for (var prop in source) {
                if (source.hasOwnProperty(prop) && typeof source[prop] !== 'undefined') {
                    target[prop] = source[prop];
                }
            }
        }

        //Recursively apply additional sources
        if (arguments.length > 2) {
            var args = toArray(arguments, 2);
            args.unshift(target);
            return _extend.apply(this, args);
        }

        return target;
    }

    function extendUshipForWebProject(target, source /*, ...sources */) {
        if (source) {
            for (var prop in source) {
                if (source.hasOwnProperty(prop) && source[prop]) {
                    if (!target.hasOwnProperty(prop)) {
                        target[prop] = source[prop];
                    } else {
                        for (var propToExtend in source[prop]) {
                            if (!target[prop].hasOwnProperty(propToExtend)) {
                                target[prop][propToExtend] = source[prop][propToExtend];
                            }
                        }
                    }
                }
            }
        }

        //Recursively apply additional sources
        if (arguments.length > 2) {
            var args = toArray(arguments, 2);
            args.unshift(target);
            return _extend.apply(this, args);
        }

        return target;
    }

    function assignDeep(target) {
        for (var _len = arguments.length, sources = Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {
            sources[_key - 1] = arguments[_key];
        }

        return sources.reduce(function (t, source) {
            Object.keys(source).forEach(function (x) {
                t[x] = isObject(t[x]) && isObject(source[x]) ? assignDeep(t[x], source[x]) : t[x] = source[x];
            });
            return t;
        }, target);
    }

    function forEach(obj, fn) {
        if (isArray(obj)) {
            obj.forEach(fn, this);
        } else {
            for (var prop in obj) {
                if (obj.hasOwnProperty(prop)) {
                    fn(prop, obj[prop]);
                }
            }
        }
    }

    function restParams(func, args) {
        if (typeof func !== 'function') return [];
        if (func.length >= args.length) return [];
        var restArgs = toArray(args, func.length);
        if (!restArgs || !restArgs.length) return [];
        return restArgs;
    }

    function flattenToArray() /* arguments */{
        var acc = [];
        var args = toArray(arguments);

        args.forEach(function (item) {
            if (isArray(item)) {
                acc = acc.concat(flattenToArray.apply(null, item));
            } else {
                acc.push(item);
            }
        });

        return acc;
    }

    function partial(fn) {
        for (var _len2 = arguments.length, boundArgs = Array(_len2 > 1 ? _len2 - 1 : 0), _key2 = 1; _key2 < _len2; _key2++) {
            boundArgs[_key2 - 1] = arguments[_key2];
        }

        return function () {
            for (var _len3 = arguments.length, args = Array(_len3), _key3 = 0; _key3 < _len3; _key3++) {
                args[_key3] = arguments[_key3];
            }

            return fn.apply(this, boundArgs.concat(args));
        };
    }

    function getUrlParam(key) {
        var result = new RegExp(key + '=([^&]*)', 'i').exec(window.location.search);
        return result && result[1] || '';
    }

    function Url(url) {
        var baseUrl = url.split('?')[0].split('#')[0],
            self = this;

        this.queryStringValues = {};
        this.fragmentIdentifier = '';

        if (url.split('#').length > 1) {
            self.fragmentIdentifier = url.split('#')[1];
        }

        if (url.split('?').length > 1) {
            url.split('?')[1].split('&').forEach(function (qsv) {
                var asKvp = qsv.split('=');
                self.queryStringValues[asKvp[0]] = asKvp[1];
            });
        }

        this.addQueryStringParam = function (param, value) {
            this.queryStringValues[param] = value;
        };

        Url.prototype.toString = function urlToString() {
            var fullUrl = baseUrl;

            for (var key in self.queryStringValues) {
                var separator = fullUrl.indexOf('?') > -1 ? '&' : '?';
                fullUrl = fullUrl + separator + key + '=' + self.queryStringValues[key];
            }

            if (self.fragmentIdentifier.length > 1) return fullUrl + '#' + self.fragmentIdentifier;

            return fullUrl;
        };
    }

    // Based on curl.js loader -- simple injection with success/failure events translated to promise resolution
    var activeScripts = {},
        doc = window.document,
        head = doc && (doc.head || doc.getElementsByTagName('head')[0]),
        insertBeforeEl = head && head.getElementsByTagName('base')[0] || null,
        readyStates = 'addEventListener' in window ? {} : { 'loaded': 1, 'complete': 1 };

    function injectScript(src) {
        if (activeScripts[src]) return activeScripts[src];

        var scriptPromise = new Promise(function (resolve, reject) {
            var el = doc.createElement('script');

            function process(ev) {
                ev = ev || window.event;
                if (ev.type == 'load' || readyStates[el.readyState]) {
                    el.onload = el.onreadystatechange = el.onerror = '';
                    resolve();
                }
            }

            function fail() /*ev*/{
                reject(new Error('Syntax or http error: ' + src));
                delete activeScripts[src];
            }

            el.onload = el.onreadystatechange = process;
            el.onerror = fail;
            el.type = 'text/javascript';
            el.charset = 'utf-8';
            el.src = src;

            head.insertBefore(el, insertBeforeEl);
        });

        activeScripts[src] = scriptPromise;

        return scriptPromise;
    }

    var activeCallbackScripts = {};

    function injectCallbackScript(src, callbackName) {
        var timeout = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 10000;

        if (activeCallbackScripts[src]) return activeCallbackScripts[src];

        var scriptPromise = new Promise(function (resolve, reject) {
            var timeoutId = root.setTimeout(handleFailure, timeout);

            root[callbackName] = function () {
                for (var _len4 = arguments.length, args = Array(_len4), _key4 = 0; _key4 < _len4; _key4++) {
                    args[_key4] = arguments[_key4];
                }

                root.clearTimeout(timeoutId);
                resolve(args);
            };

            function handleFailure() {
                var err = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : new Error('Timeout error: ' + src);

                delete activeCallbackScripts[src];
                reject(err);
            }

            injectScript(src).catch(handleFailure);
        });

        activeCallbackScripts[src] = scriptPromise;
        return scriptPromise;
    }

    function injectTemplate(templateName, templateString, overrideExisting) {
        if (document.getElementById(templateName) && !overrideExisting) return document.getElementById(templateName);

        var el = doc.createElement('script');

        el.type = 'text/html';
        el.id = templateName;
        el.text = templateString;

        doc.body ? doc.body.appendChild(el) : head.insertBefore(el, insertBeforeEl);

        return el;
    }

    // Returns a function, that, as long as it continues to be invoked, will not
    // be triggered. The function will be called after it stops being called for
    // N milliseconds. If `immediate` is passed, trigger the function on the
    // leading edge, instead of the trailing.
    // function debounce(func, wait, immediate) {
    //     var timeout;
    //     return function() {
    //         var context = this, args = arguments;
    //         var later = function() {
    //             timeout = null;
    //             if (!immediate) func.apply(context, args);
    //         };
    //         var callNow = immediate && !timeout;
    //         clearTimeout(timeout);
    //         timeout = setTimeout(later, wait);
    //         if (callNow) func.apply(context, args);
    //     }
    // }

    var debounceOptions = {
        'leading': false,
        'maxWait': 0,
        'trailing': false
    };

    /**
     * Creates a function that will delay the execution of `func` until after
     * `wait` milliseconds have elapsed since the last time it was invoked.
     * Provide an options object to indicate that `func` should be invoked on
     * the leading and/or trailing edge of the `wait` timeout. Subsequent calls
     * to the debounced function will return the result of the last `func` call.
     *
     * Note: If `leading` and `trailing` options are `true` `func` will be called
     * on the trailing edge of the timeout only if the the debounced function is
     * invoked more than once during the `wait` timeout.
     */
    function debounce(func, wait, options) {
        var args = void 0,
            maxTimeoutId = void 0,
            result = void 0,
            stamp = void 0,
            thisArg = void 0,
            timeoutId = void 0,
            trailingCall = void 0,
            lastCalled = 0,
            maxWait = false,
            trailing = true,
            leading = void 0;

        if (!isFunction(func)) {
            throw new TypeError();
        }
        wait = Math.max(0, wait) || 0;
        if (options === true) {
            leading = true;
            trailing = false;
        } else if (isObject(options)) {
            leading = options.leading;
            maxWait = 'maxWait' in options && (Math.max(wait, options.maxWait) || 0);
            trailing = 'trailing' in options ? options.trailing : trailing;
        }

        var delayed = function delayed() {
            var remaining = wait - (Date.now() - stamp);
            if (remaining <= 0) {
                if (maxTimeoutId) {
                    clearTimeout(maxTimeoutId);
                }
                var isCalled = trailingCall;
                maxTimeoutId = timeoutId = trailingCall = undefined;
                if (isCalled) {
                    lastCalled = Date.now();
                    result = func.apply(thisArg, args);
                    if (!timeoutId && !maxTimeoutId) {
                        args = thisArg = null;
                    }
                }
            } else {
                timeoutId = setTimeout(delayed, remaining);
            }
        };

        var maxDelayed = function maxDelayed() {
            if (timeoutId) {
                clearTimeout(timeoutId);
            }
            maxTimeoutId = timeoutId = trailingCall = undefined;
            if (trailing || maxWait !== wait) {
                lastCalled = Date.now();
                result = func.apply(thisArg, args);
                if (!timeoutId && !maxTimeoutId) {
                    args = thisArg = null;
                }
            }
        };

        return function () {
            args = arguments;
            stamp = Date.now();
            thisArg = this;
            trailingCall = trailing && (timeoutId || !leading);

            var leadingCall = void 0,
                isCalled = void 0;

            if (maxWait === false) {
                leadingCall = leading && !timeoutId;
            } else {
                if (!maxTimeoutId && !leading) {
                    lastCalled = stamp;
                }
                var remaining = maxWait - (stamp - lastCalled);
                isCalled = remaining <= 0;

                if (isCalled) {
                    if (maxTimeoutId) {
                        maxTimeoutId = clearTimeout(maxTimeoutId);
                    }
                    lastCalled = stamp;
                    result = func.apply(thisArg, args);
                } else if (!maxTimeoutId) {
                    maxTimeoutId = setTimeout(maxDelayed, remaining);
                }
            }
            if (isCalled && timeoutId) {
                timeoutId = clearTimeout(timeoutId);
            } else if (!timeoutId && wait !== maxWait) {
                timeoutId = setTimeout(delayed, wait);
            }
            if (leadingCall) {
                isCalled = true;
                result = func.apply(thisArg, args);
            }
            if (isCalled && !timeoutId && !maxTimeoutId) {
                args = thisArg = null;
            }
            return result;
        };
    }

    /**
     * Creates a function that, when executed, will only call the `func` function
     * at most once per every `wait` milliseconds. Provide an options object to
     * indicate that `func` should be invoked on the leading and/or trailing edge
     * of the `wait` timeout. Subsequent calls to the throttled function will
     * return the result of the last `func` call.
     *
     * Note: If `leading` and `trailing` options are `true` `func` will be called
     * on the trailing edge of the timeout only if the the throttled function is
     * invoked more than once during the `wait` timeout.
     */
    function throttle(func, wait, options) {
        var leading = true,
            trailing = true;

        if (!isFunction(func)) {
            throw new TypeError();
        }
        if (options === false) {
            leading = false;
        } else if (isObject(options)) {
            leading = 'leading' in options ? options.leading : leading;
            trailing = 'trailing' in options ? options.trailing : trailing;
        }
        debounceOptions.leading = leading;
        debounceOptions.maxWait = wait;
        debounceOptions.trailing = trailing;

        return debounce(func, wait, debounceOptions);
    }

    /**
     * Used to intercept events happening in third-party libraries
     *
     * For example, Google Places autocomplete attaches to the enter key in a way we can't override.
     * We can intercept the enter key event and transform it to a different event type,
     * allowing us to work around the default behavior
     */
    function createListenerFacade(el, transformers) {
        if (!el) return;
        var nativeAddListener = el.addEventListener || el.attachEvent;

        function addListenerFacade(type, callback) {
            var tCallback = void 0;

            var typeName = type.replace(/on/i, '');
            if (typeName in transformers) {
                tCallback = function tCallback(ev) {
                    var transformed = transformers[typeName].call(el, ev);
                    callback.call(el, transformed);
                };
            }

            nativeAddListener.call(el, type, tCallback || callback);
        }

        if (el.addEventListener) el.addEventListener = addListenerFacade;
        if (el.attachEvent) el.attachEvent = addListenerFacade;
    }

    function formatNumber(number, decimals, decPoint, thousandsSep) {
        var n = number;
        var c = isNaN(decimals = Math.abs(decimals)) ? 2 : decimals,
            d = decPoint || '.',
            t = thousandsSep || ',',
            str = n < 0 ? '-' : '',
            i = parseInt(n = Math.abs(+n || 0).toFixed(c), 10) + '',
            j = i.length > 3 ? i.length % 3 : 0;
        return str + (j ? i.substr(0, j) + t : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, '$1' + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : '');
    }

    function joinTruthy() {
        var args = toArray(arguments),
            sep = args.pop(),
            toJoin = flattenToArray(args);

        return toJoin.filter(isTruthy).join(sep);
    }

    /**
     * Utility for concatenating HTML element class names into a class list
     *
     * @param {...string|Object} names - strings to concatenate, or KVP where key is the classname and value is boolean
     * @return {string} Space-separated class list
     */
    function classNames() {
        var classes = '';

        for (var _len5 = arguments.length, names = Array(_len5), _key5 = 0; _key5 < _len5; _key5++) {
            names[_key5] = arguments[_key5];
        }

        for (var i = 0; i < names.length; i++) {
            var arg = names[i];
            if (!arg) continue;

            if (isString(arg) || isNumber(arg)) {
                classes += ' ' + arg;
            } else if (Array.isArray(arg)) {
                var toAdd = classNames.apply(null, arg);
                if (toAdd) {
                    classes += ' ' + classNames.apply(null, arg);
                }
            } else if (isObject(arg)) {
                for (var key in arg) {
                    if (arg.hasOwnProperty(key) && arg[key]) {
                        classes += ' ' + key;
                    }
                }
            }
        }

        return classes.substr(1);
    }

    /**
     * Returns a copy of an object with specified keys removed
     *
     * @param  {Object}    obj           The object to copy
     * @param  {...string} keysNotToCopy The keys to excluded from the copied object
     * @return {Object}                  The copied object
     */
    function objectExcept(obj) {
        for (var _len6 = arguments.length, keysNotToCopy = Array(_len6 > 1 ? _len6 - 1 : 0), _key6 = 1; _key6 < _len6; _key6++) {
            keysNotToCopy[_key6 - 1] = arguments[_key6];
        }

        var newObj = {};
        Object.keys(obj).filter(function (k) {
            return keysNotToCopy.indexOf(k) === -1;
        }).forEach(function (k) {
            return newObj[k] = obj[k];
        });
        return newObj;
    }

    /**
     * Helper for Object.prototype.hasOwnProperty
     *
     * @param  {Object}  obj object to check for key
     * @param  {string}  key key to check for in object
     * @return {Boolean}     Flag indicating presence of key
     */
    function hasProp(obj, key) {
        if (!obj) return false;
        return Object.prototype.hasOwnProperty.call(obj, key);
    }

    function createGuid() {
        function s4() {
            return Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(1);
        }

        return s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();
    }

    function assert(condition, message) {
        var conditionMet = isFunction(condition) ? condition() : condition;

        if (!conditionMet) {
            if (message instanceof Error) throw message;
            throw new Error(message || 'Assertion failed: ' + condition.toString());
        }
    }

    function failAsync(message) {
        return Promise.reject(message);
    }

    function genericFactory(Ctor) {
        var args = toArray(arguments, 1),
            inst = Object.create(Ctor.prototype);

        Ctor.apply(inst, args);
        return inst;
    }

    function cachingFactory(Ctor) {
        if (!Ctor.__instances) Ctor.__instances = [];
        var inst = genericFactory.apply(null, arguments);
        Ctor.__instances.push(inst);
        return inst;
    }

    function singletonFactory(Ctor) {
        var args = [Ctor].concat(toArray(arguments, 1));
        if (Ctor.__instances && Ctor.__instances.length) {
            return Ctor.__instances[0];
        }
        return cachingFactory.apply(null, args);
    }

    function viewPortDimensions() {
        var container = window;
        var a = 'inner';
        if (!window.innerWidth) {
            a = 'client';
            container = document.documentElement || document.body;
        }
        var w = a + 'Width',
            h = a + 'Height';
        //return a func because the return values may change everytime the user tries to get dimensions.
        return function () {
            return {
                width: container[w],
                height: container[h],
                innerWidth: window.innerWidth,
                innerHeight: window.innerHeight
            };
        };
    }

    function isMobileBrowser() {
        var MOBILE_UA_STRINGS = /(android|ipad|playbook|silk|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i,
            MOBILE_UA_PATTERNS = /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw-(n|u)|c55\/|capi|ccwa|cdm-|cell|chtm|cldc|cmd-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc-s|devi|dica|dmob|do(c|p)o|ds(12|-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(-|_)|g1 u|g560|gene|gf-5|g-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd-(m|p|t)|hei-|hi(pt|ta)|hp( i|ip)|hs-c|ht(c(-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i-(20|go|ma)|i230|iac( |-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|-[a-w])|libw|lynx|m1-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|-([1-8]|c))|phil|pire|pl(ay|uc)|pn-2|po(ck|rt|se)|prox|psio|pt-g|qa-a|qc(07|12|21|32|60|-[2-7]|i-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h-|oo|p-)|sdk\/|se(c(-|0|1)|47|mc|nd|ri)|sgh-|shar|sie(-|m)|sk-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h-|v-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl-|tdg-|tel(i|m)|tim-|t-mo|to(pl|sh)|ts(70|m-|m3|m5)|tx-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas-|your|zeto|zte-/i;

        var isMobile = false;
        var ua = navigator.userAgent || navigator.vendor || window.opera;

        if (MOBILE_UA_STRINGS.test(ua) || MOBILE_UA_PATTERNS.test(ua.substr(0, 4))) {
            isMobile = true;
        }

        return isMobile;
    }

    var utils = uship.namespace('utils').extend({
        identity: identity,
        noop: noop,
        toType: toType,
        isObject: isObject,
        isFunction: isFunction,
        isString: isString,
        isArray: isArray,
        isNumber: isNumber,
        isBoolean: isBoolean,
        isTruthy: isTruthy,
        isNullOrUndefined: isNullOrUndefined,
        toArray: toArray,
        format: format,
        extend: _extend,
        assignDeep: assignDeep,
        forEach: forEach,
        flattenToArray: flattenToArray,
        partial: partial,
        getUrlParam: getUrlParam,
        asCallable: asCallable,
        Url: Url,
        injectScript: injectScript,
        injectCallbackScript: injectCallbackScript,
        injectTemplate: injectTemplate,
        restParams: restParams,
        createListenerFacade: createListenerFacade,
        formatNumber: formatNumber,
        debounce: debounce,
        throttle: throttle,
        joinTruthy: joinTruthy,
        objectExcept: objectExcept,
        hasProp: hasProp,
        createGuid: createGuid,
        assert: assert,
        failAsync: failAsync,
        genericFactory: genericFactory,
        cachingFactory: cachingFactory,
        singletonFactory: singletonFactory,
        classNames: classNames,
        viewPortDimensions: viewPortDimensions,
        isMobileBrowser: isMobileBrowser,
        getCookie: getCookie,
        setCookie: setCookie
    });

    // Polyfill helpers

    /**
     * Deprecated -- noop
     */
    function placeholder() {}

    /**
     * Deprecated -- noop
     */
    function refreshModelFromDom() {}

    uship.namespace('polyfills').extend({
        placeholder: placeholder,
        refreshModelFromDom: refreshModelFromDom
    });

    // Common helpers
    if (typeof root.console === 'undefined') {
        root.console = {
            log: noop,
            info: noop
        };
    }

    var noopAlert = {
        log: noop,
        info: noop,
        success: noop,
        error: noop,
        debug: noop
    };

    uship.namespace('helpers').extend({
        alert: noopAlert,
        noopAlert: noopAlert
    });

    utils.extend(uship, {
        path: function path(key) {
            if (!uship.bootstrap) {
                throw new Error('Cannot retrieve ' + key + ': uship.bootstrap is undefined');
            }

            if (!uship.bootstrap.routes) {
                throw new Error('Cannot retrieve ' + key + ': uship.bootstrap.routes is undefined');
            }

            if (!uship.bootstrap.routes[key]) {
                throw new Error('Cannot retrieve ' + key + ': route not found');
            }

            return uship.bootstrap.routes[key];
        }
    });

    // log errors that happened before documentReady
    document.addEventListener('DOMContentLoaded', function () {
        if (root.logging && root.logging.logQueue) root.logging.logQueue();
    });

    if (previousuShip && (window.location.pathname.indexOf('listing2.aspx') > 0 || window.location.pathname.indexOf('interview_listing.aspx') > 0)) {
        extendUshipForWebProject(uship, previousuShip);
    } else if (previousuShip) {
        _extend(uship, previousuShip);
        previousuShip.utils && _extend(uship.utils, utils);
    }
})(window);