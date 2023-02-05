const pinArray = ['в закреп', 'из закрепа'];
const archiveArray = ['в архив', 'из архива'];
const deleteArray = ['в корзину'];
const okBtnText = 'OK';
const okArhText = 'Archiver';
const cancelArhText = 'Annuler';
const cancelDelText = `J'ai changé d'avis`;
const okDelText = 'Supprimer';


const cmEvent = (e) => {
    e = e || window.event;
    let thisElem = e.target || e.srcElement;
    let room = thisElem.parentElement.dataset.r;
    let uid = thisElem.parentElement.dataset.u;
    let listEvent = thisElem.dataset.event;
    let mass = listEvent.split('-');
    let event = mass[0];
    let statusNow = mass[1];
    const menuList = thisElem.closest('.chat-menu');
    const modalWindow = document.createElement('div');
    const pinDescr = document.createElement('p');
    const pinBtn = document.createElement('button');
    modalWindow.classList.add('chat-modal');
    modalWindow.classList.add(event);
    document.body.append(modalWindow);
    pinBtn.classList.add('pinBtn');
    pinDescr.classList.add('pinDescr');
    modalWindow.append(pinDescr);
    modalWindow.append(pinBtn);
    menuList.classList.remove('active');
    switch (event) {
        case 'pin':
            variableBtns(modalWindow, pinBtn, pinDescr, statusNow, btnsQuan = 1, textDescr = pinArray, okBtnText);
            pinBtn.addEventListener('click', () => {
                fetchEvent('/chat/event', room, uid, listEvent, thisElem);
                modalWindow.remove();
                pinVariable(thisElem, statusNow);
            });
            break;
        case 'archive':
            variableBtns(modalWindow, pinBtn, pinDescr, statusNow, btnsQuan = 2, textDescr = archiveArray, okArhText, cancelArhText);
            pinBtn.addEventListener('click', () => {
                fetchEvent('/chat/event', room, uid, listEvent, thisElem);
                modalWindow.remove();
                thisElem.closest('.views-row').remove();
            });
            break;
        case 'delete':
            variableBtns(modalWindow, pinBtn, pinDescr, statusNow, btnsQuan = 2, textDescr = deleteArray, okDelText, cancelDelText);
            pinBtn.addEventListener('click', () => {
                fetchEvent('/chat/event', room, uid, listEvent, thisElem);
                modalWindow.remove();
                thisElem.closest('.views-row').remove();
            });
            break;
    }
}

document.addEventListener('DOMContentLoaded', () => {
    let pinnedCards = document.querySelectorAll('.pin-1');
    if (pinnedCards) {
        pinnedCards.forEach((card) => {
            card.closest('.views-row').classList.add('pinned');
        });
    }
})

function variableBtns(modalWindow, pinBtn, pinDescr, statusNow, btnsQuan = 1, textDescr, okBtn, cancelBtnText) {
    pinBtn.textContent = okBtn;
    pinDescr.textContent = textDescr[statusNow];
    if (btnsQuan == 2 && statusNow == '0') {
        const cancelBtn = document.createElement('button');
        cancelBtn.textContent = cancelBtnText;
        cancelBtn.classList.add('cancelBtn');
        modalWindow.append(cancelBtn);
        cancelBtn.addEventListener('click', () => {
            modalWindow.remove();
        });
    } else {
        pinBtn.textContent = okBtnText;
    }
}

function pinVariable(thisElem, statusNow) {
    switch (statusNow) {
        case '0':
            thisElem.closest('.views-row').classList.add('pinned');
            break;
        case '1':
            thisElem.closest('.views-row').classList.remove('pinned');
            break;
    }
}

function fetchEvent(url, room, uid, listEvent, thisElem) {
    fetch(`${url}?r=${room}&u=${uid}&e=${listEvent}`)
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            data.status === '0' ? thisElem.classList.add('event-active') : thisElem.classList.add('event-inactive');
            thisElem.setAttribute('data-event', `${data.event}-${data.status}`);
            thisElem.className = '';
            thisElem.classList.add(`chat-menu__${data.event}`);
            thisElem.classList.add(`${data.event}-${data.status}`);
        });
}