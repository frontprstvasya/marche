document.addEventListener('DOMContentLoaded', ()=>{
  
  /* FRONTPAGE FILTER OPEN/CLOSE BUTTON */
  const filterContainer = document.querySelector('.filters-container');
  const toggleBtn = document.querySelector('.filter-toggle-btn');

  function closeBtn(btn, content) {
    const closeButton = document.querySelector(btn);
    const closeContent = document.querySelector(content);
    if(closeButton != null && closeContent != null){
      closeButton.addEventListener('click', () => {
        closeContent.classList.toggle('showSub');
        toggleBtn.classList.toggle('greenBtn');
      });
    }
  }

  closeBtn('.filter-toggle-btn', '.filters-container');
  closeBtn('.exit-btn ', '.filters-container');

  /* ADD PLACEHOLDER */

  function addPlaceholder(id, placeholder) {
    const input = document.getElementById(id);
    if (input != null){
      input.setAttribute('placeholder', placeholder);
      input.addEventListener('focus', () => {
        input.removeAttribute('placeholder', placeholder);
      });
      input.addEventListener('focusout', () => {
        input.setAttribute('placeholder', placeholder);
      });
    }
  }

  addPlaceholder('edit-field-price-value', 'Min');
  addPlaceholder('edit-field-price-value-1', 'Max');

  window.onscroll = function() {myFunction()};

  const myBtn = document.querySelector('.filter-toggle-btn');


  /**
   *  Добавить класс sticky к навигационной панели, когда вы достигнете ее положения прокрутки. Удалите "sticky", когда вы покидаете положение прокрутки
   */

  function myFunction() {
    if (myBtn != null){
      if (window.scrollY >= 1300 && window.innerWidth < 1024) {
        myBtn.classList.add("sticky");
        filterContainer.classList.add('scroll-container');
      } else {
        myBtn.classList.remove("sticky");
        filterContainer.classList.remove('scroll-container');
      }
    }

  }

 });
