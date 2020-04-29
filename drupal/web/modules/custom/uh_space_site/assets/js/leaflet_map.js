(function ($, Drupal) {
  Drupal.behaviors.leaflet_map = {
    attach(context, settings) {

      // Get language code
      const {currentLanguage} = settings['path'];

      // Prepare title texts depending on language
      const titles = {};
      switch (currentLanguage) {
        case 'fi':
          titles.zoomInTitle = 'Lähennä';
          titles.zoomOutTitle = 'Pienennä';
          break;
        // Assume default is English
        default:
          titles.zoomInTitle = 'Zoom In';
          titles.zoomOutTitle = 'Zoom Out';
      }

      // Define DOM/jQuery elements of Zoom controls
      const zoomInElement = $('.leaflet-control-zoom-in');
      const zoomOutElement = $('.leaflet-control-zoom-out');

      // Set titles to the elements
      zoomInElement.attr('aria-label', titles.zoomInTitle);
      zoomInElement.prop('title', titles.zoomInTitle);

      zoomOutElement.attr('aria-label', titles.zoomOutTitle);
      zoomOutElement.prop('title', titles.zoomOutTitle);
    },
  };
}(jQuery, Drupal));
