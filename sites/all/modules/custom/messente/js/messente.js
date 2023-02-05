jQuery(window).load(function () {
    const options_script = {
        id_btn: 'MessenteAjax',
        url: '/ajax-messente_upload/',
    }
    jQuery('#' + options_script.id_btn).on('click', function (e) {
        e.preventDefault();
        jQuery.ajax({
            type: 'GET',
            url: options_script.url,
            dataType: "json",
            data: {
                ajx: true,
                method: 'twilio_send',
            },
            success: function (jsonData) {
                console.log('AKJAX loadRusPostSuccess', jsonData);
            },
            error: function () {
                console.log('AKJAX loadAJAXCart ERROR');
            },
        });


    });


});