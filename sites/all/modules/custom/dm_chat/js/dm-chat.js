Drupal.behaviors.dmChatFront =  {
  attach: function(context, settings) {

    const input = document.getElementById('form-chat--input');
    const form = document.getElementById('form-chat');
    const messages = document.getElementById('chat-wrapper--msg');
    const burger = document.querySelector('.chat-burger');
    const modalWindow = document.querySelector('.chat-menu');
    let messHeight = messages.offsetHeight;

    if (messages.scrollWidth < messages.offsetWidth){
      messages.classList.add('small-padding');
    }

    burger.addEventListener('click', ()=>{
      if(!burger.classList.contains('active')){
        burger.classList.add('active');
        modalWindow.classList.add('active');
      }
      else{
        burger.classList.remove('active');
        modalWindow.classList.remove('active');
      }
    });

    input.addEventListener("keydown", function (event) {
      if (messages.scrollWidth < messages.offsetWidth){
        messages.classList.add('small-padding');
      }

      const padding = input.offsetHeight - input.clientHeight;
      /* Opened */
      input.style.height = 'auto';
      /* Collapse */
      if(input.scrollHeight < 210){
        input.style.height = (input.scrollHeight + padding) + 'px';
        input.style.overflowY = 'hidden';
        messages.style.height = (messHeight - input.scrollHeight + 40) + 'px';
      }
      else{
        input.style.height = '210px';
        input.style.overflowY = 'scroll';
      }

      if (event.which == 13) {
        if (input.value) {
          document.querySelector('input.submit-message').click();
        }
        setTimeout(()=>{
          input.style.height = '42px';
          input.value = '';
          input.selectionStart = 0;
          messages.scrollTop = messages.scrollHeight;
        },1);
      }
    });

    form.addEventListener('submit', ()=>{

      setTimeout(() => {
        if (messages.scrollWidth < messages.offsetWidth){
          messages.classList.add('small-padding');
        }
        input.style.height = '42px';
        input.value = '';
        input.selectionStart = 0;
        input.style.overflowY = 'hidden';
        messages.scrollTop = messages.scrollHeight;
        messages.style.height = messHeight + 'px';
      }, 10);
    });
  }
};
