jQuery(document).ready(function() {
  console.log('mask for user login loading');
  if (key_exists('settings', Drupal)) {
    if (key_exists('Messente', Drupal.settings)) {
      const Data = Drupal.settings.Messente;
        //console.log( Data);
         let parentselect = document.getElementById('country_mask_select');
         if (key_exists('step', Data) && Data.step ===1) {
         if(parentselect){
         let messages_inline = document.getElementsByClassName('messages-inline');
         if(messages_inline && messages_inline.length){
                 messages_inline[0].style.display='none';
                 if(messages_inline[0].innerText){
                     console.log(messages_inline[0].innerText);
                     let parent_error = document.getElementById('messente_error_block');
                     if(parent_error) {
                         let label_error = document.createElement('span');
                         label_error.innerText = messages_inline[0].innerText;
                         parent_error.appendChild(label_error);
                     }
                 }
             }
          let label = getLabelName();
          parentselect.style.display = 'flex';
          parentselect.innerHTML = '';
          jQuery(parentselect).before(getRadioType());
          let radioselect = document.getElementsByName('radio_type_enter');
          let input_phone = jQuery('#edit-phone-and-mail');
            if(parseInt(radioselect[0].value) === 2){
                addSelectMask(Data);
                if(label){
                    label.innerText = Data.text_for_enter.phone;
                }
            }
            for(let i =0;i<radioselect.length;i++){
              radioselect[i].onchange = function (){
             //console.log(radioselect[i].value);
                if(parseInt(this.value) === 2){
                    parentselect.style.display='flex';
                    addSelectMask(Data);
                    if(label){
                        label.innerText = Data.text_for_enter.phone;
                    }
                }else{
                //    console.log('clean Mask');
                    input_phone.val('');
                    parentselect.innerHTML='';
                    parentselect.style.display='none';
                    jQuery(input_phone).unmask();
                    if(label){
                        label.innerText = Data.text_for_enter.mail;
                    }

                }
              };
            }
        }
        }
    }
  }

    function addSelectMask(Data, labeltext) {
        let input_phone = jQuery('#edit-phone-and-mail');
        input_phone.val('');
        let parentselect = document.getElementById('country_mask_select');
        parentselect.innerHTML = '';
        let selectList = document.createElement('div');
        selectList.id = 'SelectListMask';
        let labelselect = document.createElement('div');
        labelselect.id = 'SelectItemMask';
        let label_text = document.createElement('span');
        let label_row = document.createElement('span');
        label_text.className = 'label_mask_span';
        label_row.className = 'label_mask_row';
        if (labeltext) {
            label_text.innerHTML = labeltext;
        }else {
            var labal_array = addLabelStar(Data);
            if (labal_array) {
                setMaskPhone(
                    input_phone, getValueIsDataMask(Data.mask, labal_array[0], 'code'),
                    getValueIsDataMask(Data.mask, labal_array[0], 'mask')
                );
                ChangeSelectMaskPhone(labal_array[0], getValueIsDataMask(Data.mask, labal_array[0], 'count'));
                var arrass = [];
                for (var i = 0; i < labal_array[1][0].children.length; i++) {
                    arrass[i] = labal_array[1][0].children[i];
                }
                for (var i = 0; i < arrass.length; i++) {
                    label_text.appendChild(arrass[i]);
                }
            }
        }
        label_row.innerText = '';
        labelselect.appendChild(label_text); //↑ ˅ ˄
        labelselect.appendChild(label_row);
        parentselect.appendChild(labelselect);

        let option = [];
        let link = [];
        let img = [];

        for (let i = 0; i < Data.mask.length; i++) {
            option[i] = document.createElement('div');
            img[i] = document.createElement('img');
            link[i] = document.createElement('a');
            option[i].setAttribute('data_id', Data.mask[i].id);
            img[i].className = 'img_mask';
            link[i].className = 'link_mask';
            img[i].setAttribute('src', Data.mask[i].img);
            link[i].innerText = Data.mask[i].country + ' (+' + Data.mask[i].code + ') ';
            option[i].className = 'item_mask';
            option[i].appendChild(img[i]);
            option[i].appendChild(link[i]);
            selectList.appendChild(option[i]);
        }
        if (key_exists('id_select', Data)) {
            if (Data.id_select !== null) {
                selectList.value = Data.id_select;
            }
        }
        parentselect.appendChild(selectList);
        let isShow = false;
        document.getElementById('SelectItemMask').onclick = function() {
            if (isShow) {
                this.children[1].innerText = '';
                document.getElementById('SelectListMask').style.display = 'none';
                isShow = false;
            } else {
                this.children[1].innerText = '';
                document.getElementById('SelectListMask').style.display = 'block';
                var item_mask = document.getElementsByClassName('item_mask');
                for (var i = 0; i < item_mask.length; i++) {
                    item_mask[i].onclick = function() {
                        addSelectMask(Data, this.innerHTML);
                        setMaskPhone(
                            input_phone, getValueIsDataMask(Data.mask, this.getAttribute('data_id'), 'code'),
                            getValueIsDataMask(Data.mask, this.getAttribute('data_id'), 'mask')
                        );
                        ChangeSelectMaskPhone(this.getAttribute('data_id'), getValueIsDataMask(Data.mask, this.getAttribute('data_id'), 'count'));
                    };
                }
                isShow = true;
            }
        };
    }

    function addLabelStar(Data) {
        let option = [];
        let link = [];
        let img = [];
        for (let i = 0; i < Data.mask.length; i++) {
            option[i] = document.createElement('div');
            img[i] = document.createElement('img');
            link[i] = document.createElement('a');
            option[i].setAttribute('data_id', Data.mask[i].id);
            img[i].className = 'img_mask';
            link[i].className = 'link_mask';
            img[i].setAttribute('src', Data.mask[i].img);
            link[i].innerText = Data.mask[i].country + ' (+' + Data.mask[i].code + ') ';
            option[i].className = 'item_mask';
            option[i].appendChild(img[i]);
            option[i].appendChild(link[i]);
        }
        return [option[0].getAttribute('data_id'), option];
    }

    function setMaskPhone(input_phone, mask_code, mask_number) {
        jQuery.mask.definitions['9'] = false;
        jQuery.mask.definitions['x'] = "[0-9]";
        let count_code = mask_code.length + 4;
        jQuery(input_phone).mask("+" + mask_code + " " + mask_number, {
            autoclear: false,
            placeholder: " "
        });
    }

    function getValueIsDataMask(data, id, name) {
        let result = null;
        for (let i = 0; i < data.length; i++) {
            if (data[i]['id'] == id) {
                result = data[i][name];
            }
        }
        return result;
    }

    function getLabelName(){
        let label_text = null;
        let labeles = document.querySelectorAll('label');
        if(labeles){
            for(var i=0;i<labeles.length;i++){
                if(labeles[i].getAttribute("for")==="edit-name"){
                    label_text=labeles[i];
                }
            }
        }
       if(label_text!==null){
           return label_text;
       }else{
           return false;
       }
    }

    function key_exists(key, search) {
        if (!search || (search.constructor !== Array && search.constructor !== Object)) {
            return false;
        }
        for (var i = 0; i < search.length; i++) {
            if (search[i] === key) {
                return true;
            }
        }
        return key in search;
    }

    function ChangeSelectMaskPhone(phone_mask_id, count_phone) {
        jQuery.ajax({
            type: 'GET',
            url: '/ajax-messente-changephonemask',
            dataType: "json",
            data: {
                ajx: true,
                method: 'changephonemask',
                phonemask: phone_mask_id,
                phonecount: count_phone,

            },
            success: function(jsonData) {
                // console.log('success json:', jsonData);
            },
            error: function() {
                // console.log('ERROR');
            },
        });
    }

  function getRadioType(){
    let data_type = {
      phone:{name:'radio_type_enter', value:2, text:'Login by phone number',checked:true},
      mail:{name:'radio_type_enter', value:1, text:'Login by e-mail',checked:false}
    };

    let parent = document.createElement('div');
    parent.id = 'block_change_type_enter';
    let enterradio = [];
    let key_data = Object.keys(data_type);
    for(let i=0;i<key_data.length;i++){
      enterradio[i]= makeRadioButton(data_type[key_data[i]].name, data_type[key_data[i]].value, data_type[key_data[i]].text,data_type[key_data[i]].checked);
      parent.appendChild(enterradio[i]);
    }
    return parent;
  }

  function makeRadioButton(name, value, text,checked) {
    var parent = document.createElement('div');
    var label = document.createElement("label");
    var radio = document.createElement("input");
    parent.className = 'parent_radio_select_enter_type';
    label.innerText = text;
    radio.type = "radio";
    radio.className = "radio_enter_login";
    radio.name = name;
    radio.value = value;
    if(checked){
      radio.checked = true;
    }
    label.appendChild(radio);
    parent.appendChild(label);
    return  parent;
  }
});