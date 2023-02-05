jQuery(window).load(function () {
    console.log('Clean Loading');
    const options_script = {
        id_btn: 'edit-clean-config-btn',
        url: '/ajax-messente_upload/',
    };
    let list_configs = document.createElement('div');
    list_configs.id = 'list_config';
    let title_configs = document.createElement('p');
     title_configs.innerText='List of remote configurations:';
  jQuery('#edit-clean-config-btn').on('click', function (e) {
          e.preventDefault();
          console.log('ClickMy');
          list_configs.innerHTML ='';
          list_configs.appendChild(title_configs);
    jQuery.ajax({
      type: 'GET',
      url: options_script.url,
      dataType: "json",
      data: {
        ajx: true,
        method: 'cleanconfig',
      },
      success: function (jsonData) {
        let li_config=[];
        for (let i = 0; i < jsonData.length; i++) {// выведет 0, затем 1, затем 2
          li_config[i]=document.createElement('li');
          li_config[i].innerHTML = jsonData[i];
          list_configs.appendChild(li_config[i]);
        }
        if(typeof(list_configs)!='undefined'){
          jQuery('#list_configs').remove();
        }
        jQuery('#' +options_script.id_btn).after(list_configs);
      },
      error: function () {
        console.log('AKJAX loadAJAXCart ERROR');
      },
    });
      });
});