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
          titles.viewFullScreen = 'Vaihtaa koko näytön tilassa';
          break;
        // Assume default is English
        default:
          titles.zoomInTitle = 'Zoom In';
          titles.zoomOutTitle = 'Zoom Out';
          titles.viewFullScreen = 'Toggle Fullscreen mode';
      }

      // Define DOM/jQuery elements of Zoom controls
      const zoomInElement = $('.leaflet-control-zoom-in');
      const zoomOutElement = $('.leaflet-control-zoom-out');
      const viewFullScreenElement = $('.leaflet-control-fullscreen-button');

      // Set titles to the elements
      zoomInElement.attr('aria-label', titles.zoomInTitle);
      zoomInElement.prop('title', titles.zoomInTitle);

      zoomOutElement.attr('aria-label', titles.zoomOutTitle);
      zoomOutElement.prop('title', titles.zoomOutTitle);

      viewFullScreenElement.attr('aria-label', titles.viewFullScreen);
      viewFullScreenElement.prop('title', titles.viewFullScreen);
      viewFullScreenElement.attr('role','button');
    },
  };
}(jQuery, Drupal));
