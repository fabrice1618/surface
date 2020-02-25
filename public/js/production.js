$(function () {

    var ctx = $('#prodOverTime');
    var isProducting = false;

    var ctrl = ['5s', 'starting', 'firstpart']

    $('#startstop').click(function () {
        switch (isProducting) {
            case false:
                $('#startstop .card-text').html('Arrêt de production');
                isProducting = true;
                break;
            case true:
                $('#startstop .card-text').html('Démarrage de production');
                isProducting = false;

                /* Reset control status*/
                ctrl.forEach(function (value) {
                    $('#check-' + value + ' i').removeClass('fa-check-circle text-success');
                    $('#check-' + value + ' i').addClass('fa-times-circle text-danger');
                });

                break;
        }
        $('#startstop i').toggleClass('fa-play-circle text-success fa-stop-circle text-danger');
        $('#mainBoard').toggleClass('bg-light bg-success');
    });

    function checkCtrl(name) {
        if (isProducting) {
            $('#check-' + name + ' i').toggleClass('fa-times-circle text-danger fa-check-circle text-success');
        }
    }

    ctrl.forEach(function (value) {
        $('#check-' + value).click(function () {
            checkCtrl(value);
        });
    });

    function auth(v_action) {
        $('#badge').modal({
            keyboard: false
        });

        $('#badgeID').focus();

        $('#badge .modal-footer button.btn-primary').click(function () {

            v_regNumber = $('#badgeID').val();
            $.ajax({
                url: '/api/operator',
                method: 'PUT',
                type: 'PUT',
                data: {
                    action: v_action,
                    regNumber: v_regNumber,
                }
            })
                .done(function (data) {
                    switch (v_action) {
                        case 'connect':
                            // If no user is connected
                            if ($('#listOp li').length == 0) {
                                $('#listOp').append('<li class="list-inline-item" id="op' + data.id + '">' + data.name + '</li>');
                            } else {
                                $('#listOp li:last').after('<li class="list-inline-item" id="op' + data.id + '">' + data.name + '</li>');
                            }
                            $('#disconnect').removeClass('d-none');
                            break;
                        case 'disconnect':
                            $('#op' + data.id).remove();

                            if ($('#listOp li').length == 0) {
                                $('#disconnect').addClass('d-none');
                            }
                            break;
                    }
                })
                .fail(function () {
                    switch (v_action) {
                        case 'connect':
                            showDangerToast('Error', 'Unable to connect operator');
                            break;
                        case 'disconnect':
                            showDangerToast('Error', 'Unable to disconnect operator');
                            break;
                    }
                })
                .always(function () {
                    $('#badge .modal-footer button.btn-primary').unbind('click');
                    $('#badge').modal('hide');
                    $('#badgeID').val('');
                });
        });
    }

    $('#disconnect').click(function () {
        auth('disconnect');
    });
    $('#connect').click(function () {
        auth('connect');
    });

    $('#buttonScrap').click(function () {
        $('#modalScrap').modal({
            keyboard: false,
        });
        $('#modalScrap').modal('show');
    });


    $('#buttonPrelev').click(function () {
        $('#modalPrelev').modal({
            keyboard: false,
        });
        $('#modalPrelev').modal('show');
    });
});

