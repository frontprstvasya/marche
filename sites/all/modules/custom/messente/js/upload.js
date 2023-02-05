
(function ($) {
    Drupal.behaviors.oneclickupload = {
        attach: function (context, settings) {
            $('#edit-image-file-input', context).once().on('change', function() {
                $('#im-btn input').mousedown();
            });
        }
    };
  console.log('Upload Loading');
})(jQuery);

function GETONCLICK(){
  jQuery('#edit-image-file-input').click();
}