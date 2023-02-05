Drupal.behaviors.removeBookmark = {
  attach: function (context, settings) {
    const flags = document.querySelectorAll('.flag');
    flags.forEach((flag)=>{
      const flagParent = flag.closest('.views-row');
      flag.addEventListener('click', ()=>{
        flagParent.remove();
      });
    });
  }};
