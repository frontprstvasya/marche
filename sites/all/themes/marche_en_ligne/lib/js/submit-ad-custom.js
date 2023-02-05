document.addEventListener('DOMContentLoaded', () => {
  /**
   * Security block
   */
  const blockWrap = document.querySelector('.field-name-field-security-block');
  if (blockWrap) {
    const fullText = blockWrap.getElementsByTagName('p');
    const hideText = blockWrap.querySelector('.block');
    const closeBtn = document.createElement('div');
    closeBtn.classList.add('close-btn');
    blockWrap.append(closeBtn);
    hideText.addEventListener('click', () => {
      fullText[0].classList.add('visible');
      hideText.classList.add('visible');
      setTimeout(()=>{
        closeBtn.classList.add('visible');
      }, 500)
    });
    closeBtn.addEventListener('click', () => {
      fullText[0].classList.remove('visible');
      closeBtn.classList.remove('visible');
      setTimeout(() => {
        hideText.classList.remove('visible');
      }, 400)
    });
  }

});
