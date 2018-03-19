// Require application style
require('./main.scss');

(function ($, Drupal) {
  Drupal.behaviors.uhMultiselect = {
    attach: function (context, settings) {
      // Multiselect with Select2.
      $('select[multiple="multiple"]').select2({
        theme: 'default'
      });
    }
  };
})(jQuery, Drupal);
