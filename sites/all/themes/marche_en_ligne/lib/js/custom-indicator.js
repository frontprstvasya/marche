
/*
* Custom password indicator
* */


document.addEventListener('DOMContentLoaded', ()=>{
  const passInput = document.getElementById('edit-pass-pass1');
  const passIndicator = document.querySelector('.password-strength-text');
  passInput.addEventListener('click', ()=>{
    passIndicator.classList.add('active-ind');
  });
  passInput.addEventListener('input', ()=>{
    setTimeout(()=>{
      const indicator = document.querySelector('.indicator');
      const width = Number(window.getComputedStyle(indicator).width.replace(/[a-zа-яё]/gi, ''));
      if(width <= 40){
        passIndicator.style.background = '#F5B4B4';
      }
      else if(width > 40 && width <= 60){
        passIndicator.style.background = '#FFE884';
      }
      else if(width > 60 && width <= 75){
        passIndicator.style.background = '#BBDFD8';
      }
      else {
        passIndicator.style.background = '#B9F5B4';
      }
    }, 200);

  });
});



