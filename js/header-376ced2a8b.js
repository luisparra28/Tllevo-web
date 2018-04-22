'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

(function () {
    var recorder = this.uship.recorder;

    var MaybeElement = function () {
        function MaybeElement(maybeElement) {
            _classCallCheck(this, MaybeElement);

            this.hasElement = Boolean(maybeElement);
            this.element = maybeElement;

            this.classList = {
                contains: this.containsClass.bind(this),
                add: this.addClass.bind(this),
                remove: this.removeClass.bind(this),
                toggle: this.toggleClass.bind(this)
            };

            this._defineProperty('scrollTop', 0);
            this._defineProperty('checked', false);
        }

        _createClass(MaybeElement, [{
            key: 'addEventListener',
            value: function addEventListener() {
                var _element;

                if (this.hasElement) (_element = this.element).addEventListener.apply(_element, arguments);
            }
        }, {
            key: 'removeEventListener',
            value: function removeEventListener() {
                var _element2;

                if (this.hasElement) (_element2 = this.element).addEventListener.apply(_element2, arguments);
            }
        }, {
            key: 'containsClass',
            value: function containsClass() {
                var _element$classList;

                if (!this.hasElement) return false;
                return (_element$classList = this.element.classList).contains.apply(_element$classList, arguments);
            }
        }, {
            key: 'addClass',
            value: function addClass() {
                var _element$classList2;

                if (this.hasElement) (_element$classList2 = this.element.classList).add.apply(_element$classList2, arguments);
            }
        }, {
            key: 'removeClass',
            value: function removeClass() {
                var _element$classList3;

                if (this.hasElement) (_element$classList3 = this.element.classList).remove.apply(_element$classList3, arguments);
            }
        }, {
            key: 'toggleClass',
            value: function toggleClass() {
                var _element$classList4;

                if (!this.hasElement) return true;
                return (_element$classList4 = this.element.classList).toggle.apply(_element$classList4, arguments);
            }
        }, {
            key: 'getAttribute',
            value: function getAttribute() {
                var _element3;

                if (!this.hasElement) return null;
                return (_element3 = this.element).getAttribute.apply(_element3, arguments);
            }
        }, {
            key: '_defineProperty',
            value: function _defineProperty(property) {
                var defaultValue = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : undefined;

                Object.defineProperty(this, property, {
                    set: function set(value) {
                        if (this.hasElement) this.element[property] = value;
                    },
                    get: function get() {
                        return this.hasElement ? this.element[property] : defaultValue;
                    }
                });
            }
        }]);

        return MaybeElement;
    }();

    MaybeElement.querySelector = function (selector) {
        var within = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : document;

        return new MaybeElement(within.querySelector(selector));
    };

    MaybeElement.querySelectorAll = function (selector) {
        var within = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : document;

        return [].concat(_toConsumableArray(within.querySelectorAll(selector))).map(function (x) {
            return new MaybeElement(x);
        });
    };

    MaybeElement.from = function () {
        for (var _len = arguments.length, maybeElements = Array(_len), _key = 0; _key < _len; _key++) {
            maybeElements[_key] = arguments[_key];
        }

        var els = maybeElements.map(function (x) {
            return new MaybeElement(x);
        });
        return els.length === 1 ? els[1] : els;
    };

    var cssClasses = {
        isHidden: 'is-hidden',
        overlay: 'containerOverlay',
        isOpen: 'is-open'
    };

    var animationDuration = 510;
    var clickEvent = isMobileBrowser() ? 'touchstart' : 'click';

    var menuLink = MaybeElement.querySelector('.js-mobileNav-menu');
    var closeLink = MaybeElement.querySelector('.js-siteNav-content-closeLink');
    var navContent = MaybeElement.querySelector('.js-siteNav-content');
    var contentContainer = MaybeElement.querySelector('main');
    var logoBox = MaybeElement.querySelector('.js-siteNav-logoBox');
    var moreLink = MaybeElement.querySelector('.js-siteNav-moreLink');
    var backLink = MaybeElement.querySelector('.js-siteNav-backLink');
    var banners = MaybeElement.querySelector('#banners');
    var mainLinksContainer = MaybeElement.querySelector('.js-siteNav-linksContainer');
    var footerLinksContainer = MaybeElement.querySelector('.js-siteNav-footerLinks');
    var userProfileLink = MaybeElement.querySelector('.js-siteNav-userProfile-link');
    var focusPoints = MaybeElement.querySelectorAll('.js-siteNav-dropdownLink a, .js-siteNav-modeToggle input');
    var notificationDrawerToggle = MaybeElement.querySelector('.js-notificationsDrawer-toggle');
    var notificationContainer = MaybeElement.querySelector('.js-siteNav-notificationContainer');
    var notificationCards = MaybeElement.querySelectorAll('.js-siteNav-notification');
    // Mobile dropdown link iniitialization

    userProfileLink.addEventListener('touchstart', function (e) {
        setDropdownHover(e);
    });

    document.body.addEventListener('touchstart', function () {
        userProfileLink.classList.remove('hover');
    });

    [].concat(_toConsumableArray(focusPoints)).forEach(function (fp) {
        fp.addEventListener('focus', function () {
            if (userProfileLink) {
                userProfileLink.classList.add('focus');
            }
        });

        fp.addEventListener('blur', function () {
            if (userProfileLink) {
                userProfileLink.classList.remove('focus');
            }
        });
    });

    menuLink.addEventListener(clickEvent, function (e) {
        e.stopPropagation();
        e.preventDefault();
        openMobileDrawer();
    });

    notificationDrawerToggle.addEventListener(clickEvent, function (e) {
        notificationContainer.classList.toggle('isOpen');
        e.stopPropagation();
    });

    notificationContainer.addEventListener(clickEvent, function (e) {
        e.stopPropagation();
    });

    [].concat(_toConsumableArray(notificationCards)).forEach(function (nc) {
        nc.addEventListener('click', function (e) {
            e.stopPropagation();
            e.preventDefault();
            var url = nc.getAttribute('data-link-url');
            if (url) {
                window.location.href = url;
            }
        });
    });

    document.body.addEventListener(clickEvent, function () {
        notificationContainer.classList.remove('isOpen');
    });

    moreLink.addEventListener('click', toggleMoreBackDisplay);
    backLink.addEventListener('click', toggleMoreBackDisplay);

    function toggleMoreBackDisplay() {
        if (footerLinksContainer.classList.contains(cssClasses.isOpen)) {
            mainLinksContainer.classList.add(cssClasses.isOpen);
            footerLinksContainer.classList.remove(cssClasses.isOpen);
            scrollMainDrawerToTop();
        } else {
            scrollBackDrawerToTop();
            setTimeout(function () {
                mainLinksContainer.classList.remove(cssClasses.isOpen);
            }, 400);
            footerLinksContainer.classList.add(cssClasses.isOpen);
        }
    }

    function setDropdownHover(e) {
        if (e.target.href === undefined) {
            e.preventDefault();
            e.stopPropagation();
        }
        userProfileLink.classList.toggle('hover');
    }

    var windowWidth = window.innerWidth;

    var mql = window.matchMedia('(min-width: 1025px)');

    mql.addListener(function (mq) {
        if (mq.matches && window.innerWidth != windowWidth) {
            windowWidth = window.innerWidth;
            closeMobileDrawer();
        }
    });

    contentContainer.addEventListener('touchend', interceptClicks);
    logoBox.addEventListener('touchend', interceptClicks);
    contentContainer.addEventListener('click', interceptClicks);
    logoBox.addEventListener('click', interceptClicks);
    closeLink.addEventListener(clickEvent, interceptClicks);

    function interceptClicks(e) {
        if (!navContent.classList.contains(cssClasses.isHidden)) {
            e.stopPropagation();
            e.preventDefault();
            closeMobileDrawer();
        }
    }

    function isMobileBrowser() {
        var MOBILE_UA_STRINGS = /(android|ipad|playbook|silk|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i;
        var MOBILE_UA_PATTERNS = /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw-(n|u)|c55\/|capi|ccwa|cdm-|cell|chtm|cldc|cmd-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc-s|devi|dica|dmob|do(c|p)o|ds(12|-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(-|_)|g1 u|g560|gene|gf-5|g-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd-(m|p|t)|hei-|hi(pt|ta)|hp( i|ip)|hs-c|ht(c(-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i-(20|go|ma)|i230|iac( |-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|-[a-w])|libw|lynx|m1-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|-([1-8]|c))|phil|pire|pl(ay|uc)|pn-2|po(ck|rt|se)|prox|psio|pt-g|qa-a|qc(07|12|21|32|60|-[2-7]|i-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h-|oo|p-)|sdk\/|se(c(-|0|1)|47|mc|nd|ri)|sgh-|shar|sie(-|m)|sk-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h-|v-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl-|tdg-|tel(i|m)|tim-|t-mo|to(pl|sh)|ts(70|m-|m3|m5)|tx-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas-|your|zeto|zte-/i;
        var ua = navigator.userAgent || navigator.vendor || window.opera;
        return MOBILE_UA_STRINGS.test(ua) || MOBILE_UA_PATTERNS.test(ua.substr(0, 4));
    }

    function scrollMainDrawerToTop() {
        mainLinksContainer.scrollTop = 0;
    }

    function scrollBackDrawerToTop() {
        footerLinksContainer.scrollTop = 0;
    }

    function openMobileDrawer() {
        scrollMainDrawerToTop();
        navContent.classList.remove(cssClasses.isHidden);
        closeLink.classList.remove(cssClasses.isHidden);
        contentContainer.classList.add(cssClasses.overlay);
        banners.classList.add(cssClasses.overlay);
        document.body.classList.add(cssClasses.isOpen);
        logoBox.classList.add(cssClasses.isHidden);
    }

    function closeMobileDrawer() {
        navContent.classList.add(cssClasses.isHidden);
        if (closeLink) closeLink.classList.add(cssClasses.isHidden);
        contentContainer.classList.remove(cssClasses.overlay);
        banners.classList.remove(cssClasses.overlay);
        logoBox.classList.remove(cssClasses.isHidden);
        document.body.classList.remove(cssClasses.isOpen);
        setTimeout(function () {
            footerLinksContainer.classList.remove(cssClasses.isOpen);
            mainLinksContainer.classList.add(cssClasses.isOpen);
            scrollMainDrawerToTop();
        }, animationDuration); // wait for drawer to close fully before defaulting the view back to More
    }

    var modeToggle = MaybeElement.querySelector('.js-siteNav-modeToggle');
    var toggle = MaybeElement.querySelector('.js-siteNav-modeToggle-toggle');

    var hasBeenToggled = false;

    toggle.addEventListener('click', function (e) {
        if (!hasBeenToggled) {
            toggleMode();
        } else {
            e.preventDefault();
            e.stopPropagation();
        }
    });

    modeToggle.addEventListener('click', function (e) {
        if (!hasBeenToggled) {
            toggle.checked = !toggle.checked;
            toggleMode();
        } else {
            e.preventDefault();
            e.stopPropagation();
        }
    });

    function toggleMode() {
        hasBeenToggled = true;
        modeToggle.classList.toggle('is-active');

        var name = 'mode';
        var carrier = 'Carrier';
        var shipper = 'Shipper';

        var value = carrier;
        if (!toggle.checked) {
            value = shipper;
        }

        var daysUntilExpiration = 365;
        var toMilliseconds = 24 * 60 * 60 * 1000;
        var expires = new Date(new Date().getTime() + daysUntilExpiration * toMilliseconds);
        var cookie = name + '=' + value + ';expires=' + expires + ';path=/';
        document.cookie = cookie;

        var redirect = value === carrier ? '/drivers.aspx?f=loads' : '/myshipments';
        setTimeout(function () {
            window.location.href = redirect;
        }, 250);
    }

    if (recorder) {
        var rec = recorder.withSettings({
            methodSinks: {
                linkClick: [recorder.sinks.googleAnalytics, recorder.sinks.console]
            }
        });

        rec.linkClick('#howitworks-header-link', 'How It Works', { 'type': 'Exit Link Click' });
        rec.linkClick('#help-header-link', 'Help', { 'type': 'Exit Link Click' });
    }

    // /**
    //  * Simple wrapper around addEventListener to avoid null checks everywhere
    //  * @param {HTMLElement} element
    //  * @param {string} event
    //  * @param {function} handler
    //  */
    // function onEvent (element, e, handler) {
    //     if (!element) return;
    //     element.addEventListener(e, handler);
    // }
}).call(this);