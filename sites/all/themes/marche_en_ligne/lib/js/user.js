/**
 * JS for user pages.
 */
function listOpen() {
  let UBL = document.getElementById('UBL');
  UBL.classList.add('active--user-benefit');
}

function listClose() {
  let UBL = document.getElementById('UBL');
  UBL.classList.remove('active--user-benefit');
}

/**
 * JS placeholder for user pages.
 */
(function ($) {
  Drupal.behaviors.formPlaceholderUser =  {
    attach: function(context, settings) {
      const name = '#edit-name';
      const nameEmail = '#user-pass #edit-name';
      const pass = '#edit-pass';
      const mail = '#edit-mail';
      const phone = '#edit-field-user-phone-und-0-value';

      $(name).attr('placeholder', 'Connexion');
      $(nameEmail).attr('placeholder', 'E-mail');
      $(pass).attr('placeholder', 'Mot de passe');
      $(mail).attr('placeholder', 'E-mail');
      $(phone).attr('placeholder', 'Téléphone');
    }
  };
})(jQuery);
