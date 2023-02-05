Drupal.behaviors.inputMask =  {
  attach: function(context, settings) {
    /* Input mask for registration form */
    let phoneMask = IMask(
      document.getElementById('edit-field-uphone-und-0-value'), {
        mask: '+{237} 000-000-000'
      });
  }
};
