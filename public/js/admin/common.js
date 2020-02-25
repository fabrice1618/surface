function setActiveNav(selector) {
    $('.nav-item.active').removeClass('active');
    $(selector).closest('div.nav-item').addClass('active');
    $(selector).addClass('active');
}

function AnimForm() {
    $('.form-display').click(function () {
        $('.card-footer').slideToggle('fast');
        $('.card-body').slideToggle('fast');
        $('.form-display').toggleClass('fa-plus fa-minus');

        $('input').css('border-color', '');
        $('input').tooltip('hide');
    });

    $('button.cancel').click(function () {
        $('.card-body input').val('');
    });
}

function isEmptyVal(selector) {
    if ($(selector).val().replace(/\s/g, '') == '') {
        $(selector).css('border-color', 'red');
        $(selector).tooltip({
            title: "Required",
            placement: 'bottom',
            trigger: 'manual'
        });
        $(selector).tooltip('show');
        $(selector).val('');

        return true;
    }
    return false;
}

function clearToolTip(selector) {
    $(selector).css('border-color', '');
    $(selector).tooltip('hide');
}

function registerClearToolTip(selector) {
    $(selector).keyup(function () {
        clearToolTip(this);
    });
}

function registerEditableCell(selector, callback) {
    $(selector).dblclick(function (e) {
        e.stopPropagation();

        if ($(e.target).is(".trval")) {
            return;
        }

        var cell = $(this);
        var value = $(this).html();
        var oldValue = value;

        if ($('.trval').length > 0) {
            $('.trval').parent().html($('.trval').val());
        }

        $('.trval').dblclick(function (evt) {
            return;
        });

        $(cell).html('<input class="trval form-control form-control-sm text-center" type="text" value="' + value + '" />');
        $('.trval').focus();

        $(document).click(function (evt) {
            if ($(evt.target).is(".trval")) {
                return;
            }
            $(cell).html(oldValue);
        });

        $('.trval').keyup(function (event) {
            // Enter key
            if (event.keyCode == 13) {
                if (typeof callback === 'function') {
                    callback(cell, oldValue);
                }
            }

            // Escape key
            if (event.keyCode == 27) {
                $(cell).html(oldValue);
            }
        });

    });
}

function formatVal(selector) {
    var data = $(selector).val().replace(/\s/g, '');

    return data;
}

function registerModalClear(selector) {
    $(selector).on('hidden.bs.modal', function () {
        $('.modal-title').html('');
        $('.modal-list').html('');
    });
}