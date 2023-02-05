jQuery(document).ready(function() {
    jQuery.fn.setCursorPosition = function(pos) {
        if (jQuery(this).get(0).setSelectionRange) {
            jQuery(this).get(0).setSelectionRange(pos, pos);
        } else if (jQuery(this).get(0).createTextRange) {
            var range = jQuery(this).get(0).createTextRange();
            range.collapse(true);
            range.moveEnd('character', pos);
            range.moveStart('character', pos);
            range.select();
        }
    };

    console.log('mask load');

    if (key_exists('settings', Drupal) || key_exists('Messente', Drupal.settings)) {
        const Data = Drupal.settings.Messente;

        let parentselect = getParentMask();


        let block_inputs_pincodes = document.getElementById('block_inputs_pincodes');
        if(block_inputs_pincodes){
            block_inputs_pincodes.style.display = 'none';
        }
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

        if(key_exists('mask', Data)){
            if(Data.mask.length){
                if (parentselect) {
                    parentselect.style.display = 'flex';
                    addSelectMask(Data);
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
        } else {
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

    function getParentMask() {
        if (typeof(document.getElementById('country_mask_select')) === 'object') {
            return document.getElementById('country_mask_select');
        } else {
            return false;
        }
    }
});