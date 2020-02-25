(function ($) {
    showSuccessToast = function (title, message) {
        'use strict';
        resetToastPosition();
        $.toast({
            heading: title,
            text: message,
            showHideTransition: 'slide',
            icon: 'success',
            loaderBg: '#f96868',
            position: 'top-right'
        })
    };
    showInfoToast = function (title, message) {
        'use strict';
        resetToastPosition();
        $.toast({
            heading: title,
            text: message,
            showHideTransition: 'slide',
            icon: 'info',
            loaderBg: '#46c35f',
            position: 'top-right'
        })
    };
    showWarningToast = function (title, message) {
        'use strict';
        resetToastPosition();
        $.toast({
            heading: title,
            text: message,
            showHideTransition: 'slide',
            icon: 'warning',
            loaderBg: '#57c7d4',
            position: 'top-right'
        })
    };
    showDangerToast = function (title, message) {
        'use strict';
        resetToastPosition();
        $.toast({
            heading: title,
            text: message,
            showHideTransition: 'slide',
            icon: 'error',
            loaderBg: '#f2a654',
            position: 'top-right'
        })
    };
    showToastPosition = function (position, title, message) {
        'use strict';
        resetToastPosition();
        $.toast({
            heading: title,
            text: message,
            position: String(position),
            icon: 'success',
            stack: false,
            loaderBg: '#f96868'
        })
    }
    showToastInCustomPosition = function (title, message) {
        'use strict';
        resetToastPosition();
        $.toast({
            heading: title,
            text: message,
            icon: 'success',
            position: {
                left: 120,
                top: 120
            },
            stack: false,
            loaderBg: '#f96868'
        })
    }
    resetToastPosition = function () {
        $('.jq-toast-wrap').removeClass('bottom-left bottom-right top-left top-right mid-center'); // to remove previous position class
        $(".jq-toast-wrap").css({
            "top": "",
            "left": "",
            "bottom": "",
            "right": ""
        }); //to remove previous position style
    }
})(jQuery);
