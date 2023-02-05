let hide = .form - item - field - photo - und - 0. label

    <
    script >
    function hide(.form - item - field - photo - und - 0. label) {
        elem = document.querySelector('.form-item-field-photo-und-0.label'); //находим блок div по его id, который передали в функцию
        state = elem.style.display; //смотрим, включен ли сейчас элемент
        if (state == '') elem.style.display = 'none'; //если включен, то выключаем
        else elem.style.display = ''; //иначе - включаем
    } <
    /script>