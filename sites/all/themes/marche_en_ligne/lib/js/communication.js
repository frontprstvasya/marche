Drupal.behaviors.unregWindow = {
  attach: function (context, settings) {

    let marginLeft = `-${window.innerWidth - document.documentElement.clientWidth}px`;
    const unregWindow = document.querySelector('.unreg-window');
    const overlay = document.querySelector('.overlay');
    const windowClose = document.querySelector('.window-close');

    function closeParent(closer){
      closer.addEventListener('click', ()=> {
        unregWindow.classList.remove('visible-window');
        overlay.classList.remove('shadow');
        document.documentElement.classList.remove('shadow');
        document.body.style.marginLeft = '0';
      });
    }
    if(unregWindow) {
      closeParent(overlay);
      closeParent(windowClose);

      const connectBtns = document.querySelectorAll('.unreg');

      connectBtns.forEach((conBtn) => {
        conBtn.addEventListener('click', (e) => {
          e.stopPropagation();
          unregWindow.classList.add('visible-window');
          overlay.classList.add('shadow');
          document.documentElement.classList.add('shadow');
          document.body.style.marginLeft = marginLeft;
        });
      });
    }
  }};

function _phone(id, nid) {
  const result = document.getElementById(`nid-${nid}`);

  let url = `/getuphone?ajx=true&method=loadphone&nid=${nid}`;
  result.classList.add('visible');
  let xhr = new XMLHttpRequest();
  xhr.open("GET", url);
  xhr.onload = function (e) {
    if (xhr.readyState === 4 && xhr.status === 200) {
      let response =JSON.parse(xhr.responseText);
      let phone = response.data.phone;
      if(phone){
        let replacePhone = phone.replace(/[^0-9]/g, '');
        result.textContent = '';
        result.textContent = `+${replacePhone}`;

        result.setAttribute('href', `tel:${replacePhone}`);
      }
      else{
        result.textContent = 'Phone is empty';
      }

    }
  };
  xhr.send(null);
}

