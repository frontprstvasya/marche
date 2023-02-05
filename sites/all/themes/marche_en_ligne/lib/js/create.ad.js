/**
 * Javascript to page create ad.
 */
Drupal.behaviors.createAd = {
  attach: function (context, settings) {

    /**
     * Auto change subtitle after select categories.
     *
     * Subtitle.
     */
    const catId = document.getElementById('edit-field-categories-und-0-tid-select-1');
    const subCatId = document.getElementById('edit-field-sub-categories-und-0-tid-select-1');
    const form = document.getElementById('submit-an-ad-node-form');

    if(catId) {
      catId.addEventListener('change', function (e) {
        /* Change value */
        let val = e.target.value;
        form.removeAttribute('class');
        form.setAttribute('class', `node-submit_an_ad-form category-tid-${val}`);
        subCatId.value = val;

        /* Add event change on select */
        let event = new Event('change');
        subCatId.dispatchEvent(event);
      });
    }
  }
};

/**
 * Behavior for the automatic file upload.
 */
(function ($) {
  Drupal.behaviors.autoUpload = {
    attach: function(context, settings) {
      $('.form-item input.form-submit[value=Upload]', context).hide();
        $('.form-item input.form-submit[value=Load-img]', context).hide();
      $('.form-item input.form-file', context).change(function() {
        $parent = $(this).closest('.form-item');

        setTimeout(function() {
          if(!$('.error', $parent).length) {
            $('input.form-submit[value=Закачать]', $parent).mousedown();
            $('input.form-submit[value=Transférer]', $parent).mousedown();
            $('input.form-submit[value=Transférer]', $parent).mousedown();
             $('input.form-submit[value=Load-img]', context).mousedown();
          }
        }, 100);
      });
    }
  };
})(jQuery);

