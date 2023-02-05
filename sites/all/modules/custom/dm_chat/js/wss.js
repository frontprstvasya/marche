(function ($) {

  $(document).ready(function() {

    const room = Drupal.settings.dmChat.json.room;
    const currentId = Drupal.settings.dmChat.json.current_id;
    const nid = Drupal.settings.dmChat.json.nid;
    const realName = Drupal.settings.dmChat.json.real_name;
    const uImg = Drupal.settings.dmChat.json.img;
    const timeZone = Drupal.settings.dmChat.json.timezone;
    const timeZoneDefault = 'Africa/Algiers';
    const uPath = Drupal.settings.dmChat.json.path;
    const arbID = Drupal.settings.dmChat.json.arbitrage_id;
    const arbMsg = Drupal.settings.dmChat.json.arbitrage_msg;
    const arbName = Drupal.settings.dmChat.json.arbitrage_name;
    const arbImg = Drupal.settings.dmChat.json.arbitrage_img;
    const arbPath = Drupal.settings.dmChat.json.arbitrage_path;
    const urlWs = Drupal.settings.dmChat.json.url_ws;
    const loadImgBtn =  document.querySelector('#chat--load-img--wrapper .icon-nm_59-piper-clip');
    const chatWrap = document.querySelector('.chat-wrapper');

    const status = document.getElementById('chat-status');
    const messages = document.getElementById('chat-wrapper--msg');
    const form = document.getElementById('form-chat');
    const input = document.getElementById('form-chat--input');
    const arbBtn = document.getElementById('chat-arb');
    const views = document.querySelector('.view-views-chat-rooms');
    const infoClose = document.querySelector('.info-block-close');

    createWS(room, currentId);

    /**
     * Create websocket.
     */
    function createWS(dataNid,dataId) {
      const ws = new WebSocket(`wss://${urlWs}/params?room=${room}&id=${dataId}`);

      form.addEventListener('submit', event => {
        // Disabled submit to URL
        event.preventDefault();
        ws.send(JSON.stringify(messageData('message', currentId, realName, uImg, uPath, room, input.value )))

        input.value = '';
        input.style.height = '42px';
      });

      /** AJAX start */
      $(document).ajaxStart(function() {
        // console.log('start ajax')
        chatWrap.classList.remove('loaded')
      })

      /** Send image AJAX complete */
      $(document).ajaxComplete(function() {
        //console.log('start complete')

        let inputNameImage = document.getElementById('input--chat-load-img');
        const error = document.querySelector('#form-chat .messages')

        if(error){
          let div = document.createElement('div');
          div.className = "icon-nm_13-plus close-error";
          error.append(div)

          const closeError = document.querySelector('.close-error');
          closeError.addEventListener('click', event => {
            console.log('click close')
            removeMessageBlock(error)
          })
        }

        let nameImage = inputNameImage.value;
        if(nameImage !== 'not_validate') {
          let splitNameImg = nameImage.split('/').pop()
          ws.send(JSON.stringify(messageData('image', currentId, realName, uImg, uPath, room, splitNameImg )));
        }
        nameImage.value = '';
        chatWrap.classList.add('loaded')
      });

      /**
       * Remove message block.
       */
      function removeMessageBlock(error){
        error.remove();
      }

      /**
       * Listener click upload file.
       */
      loadImgBtn.addEventListener('click', ()=>{
        console.log('click')
      })


      /**
       * Listener adding arbitrage.
       */
      arbBtn.addEventListener('click', event => {
        ws.send(JSON.stringify(messageData('arbitrage', arbID, arbName, arbImg, arbPath, room, arbMsg)))
        views.classList.add('overlay-chat');
      });

      /**
       * Listener close info block.
       */
      infoClose.addEventListener('click', event => {
        views.classList.remove('overlay-chat');
      });

      /* Websocket OPEN */
      ws.onopen = () => {
        messages.scrollTop = messages.scrollHeight;
        setTimeout(() => {
          connectStatusClass('on');
        }, 500);
        ws.send(JSON.stringify(messageData('connection', currentId, realName, uImg, uPath, room, 'NULL')))
      }

      /* Websocket CLOSE */
      ws.onclose = () => {
        // connectStatusClass();
        ws.close();
        ws.send(JSON.stringify(messageData('close', currentId, realName, uImg, uPath, room, input.value)))
      }

      /* Websocket MESSAGE */
      ws.onmessage = response => {
        /* Response parse */
        let PM = JSON.parse(response.data);
        let class_name;
        // console.log(PM)

        switch (PM.method) {
          case 'connection':
            class_name = 'user-connected';
            console.log('connection')
            break;

          case 'message':
            if (PM.id !== currentId) {
              class_name = 'msg-row--remote-user';
            }
            printMessage(PM, class_name);
            break;

          case 'image':
            if (PM.id !== currentId) {
              class_name = 'msg-row--remote-user';
            }
            printMessage(PM, class_name);
            setTimeout(() => {
              messages.scrollTop = messages.scrollHeight;
            }, 10);
            break;

          case 'arbitrage':
            console.log(PM)
            class_name = 'msg-row--arbitrage';
            printMessage(PM, class_name);
            activeArb();
            setTimeout(() => {
              messages.scrollTop = messages.scrollHeight;
            }, 10);
            break;

          case 'arbitrage':
            console.log(PM)
            class_name = 'msg-row--arbitrage';
            printMessage(PM, class_name);
            setTimeout(()=>{
              messages.scrollTop = messages.scrollHeight;
            }, 10);
            break;

          case 'close':
            class_name = 'user-connected';
            break;
        }
      }
    }

    /*
    * Function add unclick for arbitrage Btn
    */
    function activeArb(){
      arbBtn.classList.add('chat-arb--active');
    }

    /**
     * Function Print message EVENT message.
     *
     *  @param parse body message from server.
     *  @param className - add class into views-row.
     */
    function printMessage(parse,className, arbitrage = 0) {
      const msg_row = document.createElement('div');

      /**
       * Adds the desired path to the file name.
       *
       */
      function correctPath(parse) {
        if(parse.img === 'avatar.jpg'){
          return  '/sites/default/files/default_images/';
        }else{
          return  '/sites/default/files/styles/thumbnail/public/pictures/';
        }
      }

      /**
       * Arbitrage
       */
      if(parse.id == arbID && parse.id !== currentId){
        className = className + ' ' + 'msg-row--arbitrage';
      }

      /* Convert time zone */
      let timeConvert = toTimeZone(new Date(parse.time * 1000), timeZone);
      let method = parse.method;

      if(method === 'message' || method === 'arbitrage') {
        msg_row.innerHTML =
            `<div class="views-chat--header">
                <div class="views-chat--img">
                  <a href="/${parse.path}">
                    <img src="${correctPath(parse)}${parse.img}">
                  </a>
                </div>
                <div class="views-chat--name">${parse.name}</div>
                <div class="views-chat--time">${timeConvert}</div>
            </div>
            <div class="views-chat--value">${parse.value}</div>`;

        messages.appendChild(msg_row).setAttribute("class", `msg-row ${className}`);
      }

      if(method === 'image') {
        msg_row.innerHTML =
            `<div class="views-chat--header">
                <div class="views-chat--img">
                  <a href="/${parse.path}">
                    <img src="${correctPath(parse)}${parse.img}">
                  </a>
                </div>
                <div class="views-chat--name">${parse.name}</div>
                <div class="views-chat--time">${timeConvert}</div>
            </div>
            <div class="views-chat--value">
              <a href="/sites/default/files/chat-img/${parse.value}" target="_blank">
                  <img src="/sites/default/files/chat-img/${parse.value}" width="350" height="auto" >
              </a>
            </div>`;
        messages.appendChild(msg_row).setAttribute("class", `msg-row ${className}`);
      }
    }

    /**
     *  Print message  Open/close event.
     *
     *  @param parse body message from server.
     *  @param className - add class into views-row.
     *  @param text - text after name.
     */
    function printMessageInfo(parse, className, text) {
      const msg_row = document.createElement('div');

      msg_row.innerHTML =
          `<div><span>${parse.name}</span> ${text}</div>`;
      messages.appendChild(msg_row).setAttribute("class", `${className}`);
    }

    function connectStatusClass(val = 'off') {
      if(val ==='on'){
        status.classList.add('loaded');
      }
      else if(val === 'off'){
        status.classList.remove('loaded');
      }
    }

    /**
     * Message object
     * @param {string}   method message.
     * @param {*} id     user ID.
     * @param {*} name   Name author message.
     * @param {*} img    Path to author message.
     * @param {*} path   Path to img author.
     * @param {*} room   Chat-room.
     * @param {*} value  text message.
     */
    function messageData(method, id, name, img, path, room, value) {
      return {
        method : method,
        id: id,
        name: name,
        img: img,
        path: path,
        room: room,
        value: value,
        time: Math.round(new Date()/1000)
      }
    }

    /**
     ***************** EXTENSION for working chat ******************************
     */
    arbBtn.addEventListener('click', event => {
      AddingArbitrage(nid);
      arbBtn.classList.add('chat-arb--active');
    })

    /**
     * Convert time zone on client.
     *
     * @param time * unix time (10).
     * @param zone  * TimeZone - get from JS.
     *
     * Dependencies moment.js && moment-timezone-with-data.js
     *
     * return  the time according to the user's timezone.
     */
    function toTimeZone(time, zone) {
      let format = 'DD MMM HH:mm';
      if(zone) {
        return moment(time, format).tz(zone).format(format);
      }else{
        return moment(time, format).tz(timeZoneDefault).format(format);
      }
    }


    /**
     * Adding arbitrage to chat through php function dm_chat_adding_arbitrage().
     *
     * @param nid   Number ID node.
     * @constructor
     */
    function AddingArbitrage(nid) {
      let urlPath = `/chat/ar?r=${nid}`;
      let xhr;

      xhr = new XMLHttpRequest()
      xhr.open("GET", urlPath)
      xhr.onload = function (e) {

        if (xhr.readyState === 4 && xhr.status === 200) {
          let response = JSON.parse(xhr.responseText)
          response.arbitrage = undefined;
          let arbitrage = response.arbitrage
          if(arbitrage === 'active') {
            arbBtn.classList.add('chat-arb--active');
          }
        }
      };
      xhr.send(null);
    }
  });

})(jQuery);
