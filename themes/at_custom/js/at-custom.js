/**
 * Custom Adminimal theme.
 *
 *  General JS on all pages.
 */
Drupal.behaviors.generalAT = {
  attach: function (context, settings) {
    /* Input mask */
    const idMAsk = document.getElementById('user-profile-form')
    if(idMAsk) {
      let phoneMask = IMask(
        document.getElementById('edit-field-uphone-und-0-value'), {
          mask: '+{237} 000-000-000'
        })
    }
  }
};
