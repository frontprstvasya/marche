
jQuery(window).load(function () {
(function ($) {
    let Field_Name=false;
    let Field_Type=false;
    let URL_FORM=false;
    console.log('Change phone Loading');
    const options_script = {
        id_btn: 'btn_change_phone_form',
        url: '/ajax-messente_upload/',
    };
    returnForm();
    $('#' +options_script.id_btn).on('click', function (e) {
        e.preventDefault();
        console.log('ClickMy');
        if(URL_FORM!==''){
            window.location.href = URL_FORM;
        }
    });
    function returnForm() {
        $.ajax({
            type: 'GET',
            url: options_script.url,
            dataType: "json",
            data: {
                ajx: true,
                method: 'change_phone',
            },
            success: function (jsonData) {
            console.log('success json:', jsonData);
                if (typeof (jsonData) != 'undefined') {
                    URL_FORM = jsonData.url;
                    let input_phone = $('#edit-'+jsonData.field_name+'-und-0-'+jsonData.field_type);
                   // console.log(input_phone);
                    if(typeof (input_phone)!=='undefined'){
                        $( input_phone).attr('disabled','true');
                        let value_phone =  $( input_phone).val();
                        let textfor_value = jsonData.text;
                        if(value_phone){
                          console.log('value_phone true');
                          textfor_value=value_phone;
                        }
                        $( input_phone).after("<p class='actual_phone_user'>"+textfor_value+"</p>");
                        $( input_phone).css('display','none');
                    }
                }

            },
            error: function () {
                console.log('ERROR');
            },
        });
    }
})(jQuery);

});
