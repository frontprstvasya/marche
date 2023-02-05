jQuery(document).ready(function() {
    console.log('pincode script loading');
    if (key_exists('settings', Drupal)) {
        if (key_exists('Messente', Drupal.settings)) {
            const Data = Drupal.settings.Messente;
            if (key_exists('pin_length', Data) || key_exists('step', Data)) {
                if (parseInt(Data.step) === 2) {
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


                    let form_item_code = jQuery('.form-item-code');
                    form_item_code.hide();
                    const pin_length = Data.pin_length;
                    addInputs(pin_length);
                    if (key_exists('request_timer_msg', Data) || key_exists('user_phone_and_mail', Data)) {
                        let msg_block = getMsgBlock(Data.request_timer_msg);
                        if (key_exists('request_msg', Data) || key_exists('user_phone_and_mail', Data)) {
                            msg_block = getMsgBlock(Data.request_msg);
                            if (key_exists('text_for_change_number', Data) || key_exists('user_phone_and_mail', Data)) {
                                msg_block = getMsgBlock(Data.request_msg, Data.text_for_change_number);
                            }
                        }
                        let msg_drp_txt = document.getElementsByClassName('messages--status');
                        if (msg_drp_txt.length) {
                            let txt = msg_drp_txt[0].outerText.replace('Status message', '');
                            const reg = /\n+/g;
                            txt = txt.replace(reg, '');
                            msg_block = getMsgBlock(txt);

                        }
                        let msg_drp_error = document.getElementsByClassName('messages--error');
                        let parent_block = document.getElementById('block_pincode_msg_time');
                        if (parent_block) {
                            parent_block.appendChild(msg_block);
                            let msg_drupal = document.getElementById('messages');
                            if (msg_drupal) {
                                msg_drupal.style.display = 'none';
                            }
                        }

                    }
                }
            }
        }
    }


    function getMsgBlock(msg, text_btn) {
        let parent = document.createElement('div');
        let child = document.createElement('p');
        let link_a = document.createElement('a');
        let link_b = document.createElement('a');

        parent.id = 'pincode_msg_time';
        link_a.className = 'prosto-A';
        link_b.className = 'prosto-A';
        link_a.href = '#';
        link_b.href = '#';
        child.innerText = msg;
        if (text_btn) {
            link_a.innerText = text_btn;
        } else {
            link_a.innerText = 'Change the phone numb';
        }
        link_b.innerText = 'Contact support';
        parent.appendChild(child);
        // parent.appendChild(link_a);
        // parent.appendChild(link_b);
        return parent;
    }


    function subValue(pin_count){
        if(getParentCode()){
            const inputs =  document.querySelectorAll('.pincode__input');
            const inputHidden = document.getElementById('edit-code');
            const buttonSub = document.getElementById('edit-next');
            for(var i=1;i<inputs.length;i++){
                inputs[i].setAttribute('disabled', 'disabled');
            }
            focusCycle: for(let i = 0; i < inputs.length; i++){
                inputs[i].addEventListener('input', ()=>{
                    let val = '';
                    const maxChar = 1;
                    if(inputs[i].value.length > maxChar) {
                        inputs[i].value = inputs[i].value.substr(0, maxChar);
                    }
                    if(i < inputs.length - 1 && inputs[i].value){
                        inputs[i + 1].value = '';
                        inputs[i + 1].removeAttribute('disabled');
                        inputs[i + 1].focus();
                    }
                    for(let input of inputs){
                        val = val + input.value;
                        if(val.length === pin_count){
                            inputHidden.value = val;
                            buttonSub.removeAttribute('disabled');
                            buttonSub.click();
                        }
                        else {
                            buttonSub.setAttribute('disabled', 'disabled');
                        }
                    }

                });
            }
        }
    }

    function addInputs(pin_count) {
        if (getParentCode) {
            const pincodeWrapper = getParentCode();
            if (pincodeWrapper) {
                for (let i = 0; i < pin_count; i++) {
                    let input = document.createElement('input');
                    input.classList.add('pincode__input');
                    input.setAttribute('type', 'number');
                    input.setAttribute('max', '9');
                    pincodeWrapper.appendChild(input);
                }
                subValue(pin_count);
            }
        } else {

        }


    }

    function changePassLabel(id, text) {
        const labelWrap = document.querySelector(`.${id}`);
        if (labelWrap) {
            const label = labelWrap.querySelector('label');
            label.textContent = text;
        }
    }

    function getParentCode() {
        if (!document.getElementById('block_inputs_pincodes')) {
            return false;
        }
        if (typeof(document.getElementById('block_inputs_pincodes')) === 'object') {
            let block_inputs_pincodes = document.getElementById('block_inputs_pincodes');
            block_inputs_pincodes.style.display = 'flex';
            return block_inputs_pincodes;
        } else {
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

    document.addEventListener('DOMContentLoaded', () => {
        changePassLabel('form-item-pass-pass1', 'Entrez un mot de passe');
        changePassLabel('form-item-pass-pass2', 'Saisissez le mot de passe encore une fois');
    });

});