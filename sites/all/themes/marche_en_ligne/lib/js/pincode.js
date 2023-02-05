function subValue(){
  const pincode = document.querySelector('.pincode');
  if(pincode){
  const inputs =  document.querySelectorAll('.pincode__input');
  const inputHidden = document.getElementById('edit-code');
  const buttonSub = document.getElementById('edit-next');
  buttonSub.setAttribute('disabled', 'disabled');
  focusCycle: for(let i = 0; i < inputs.length; i++){
    inputs[i].addEventListener('input', ()=>{
      let val = '';
      const maxChar = 1;
      if(inputs[i].value.length > maxChar) {
        inputs[i].value = inputs[i].value.substr(0, maxChar);
      }
      if(i < inputs.length - 1 && inputs[i].value){
        inputs[i + 1].value = '';
        inputs[i + 1].focus();
      }
      for(let input of inputs){
        val = val + input.value;
        if(val.length == 6){
          inputHidden.value = val;
          buttonSub.removeAttribute('disabled', 'disabled');
        }
       else {
          buttonSub.setAttribute('disabled', 'disabled');
        }
      }

    });
  }

  }
}

function addInputs(){
  const inputsQuan = 6;
  const pincodeWrapper = document.querySelector('.pincode');
  for(let i = 0; i < inputsQuan; i++){
    let input = document.createElement('input');
    input.classList.add('pincode__input');
    input.setAttribute('type', 'number');
    input.setAttribute('max', '9');
    pincodeWrapper.appendChild(input);
  }
  subValue();
}


function changePassLabel(id, text){
  const labelWrap = document.querySelector(`.${id}`);
  if(labelWrap){
    const label = labelWrap.querySelector('label');
    label.textContent = text;
  }
}


document.addEventListener('DOMContentLoaded', ()=>{
  addInputs();
  changePassLabel('form-item-pass-pass1', 'Entrez un mot de passe');
  changePassLabel('form-item-pass-pass2', 'Saisissez le mot de passe encore une fois');
});
