(function ($, Drupal) {
  Drupal.behaviors.leaflet_map = {
    attach(context, settings) {
      const mapid = Object.keys(settings['leaflet']);
      var loadedMap = settings['leaflet'][mapid[0]]['lMap'];

      let lat = loadedMap._lastCenter.lat;
      let lon = loadedMap._lastCenter.lng;
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

      document.getElementById(mapid[0]).innerHTML = "<div id='map' style='width: 100%; height: 100%;' tabindex='0'></div>";
      var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        osmAttribution = 'Map data © <a href="http://openstreetmap.org">OpenStreetMap</a>',
        osmLayer = new L.TileLayer(osmUrl, {maxZoom: 18, attribution: osmAttribution});
      var map = new L.Map('map', {zoomControl: false, scrollWheelZoom: false, fullscreenControl: false});
      map.setView(new L.LatLng(lat,lon), 12 );
      map.addLayer(osmLayer);
      L.marker([lat,lon]).addTo(map);
      // var validatorsLayer = new OsmJs.Weather.LeafletLayer({lang: 'en'});
      // map.addLayer(validatorsLayer);
      var plusUri = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAaCAYAAACpSkzOAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3wYJFTodgbZtSwAAABl0RVh0Q29tbWVudABDcmVhdGVkIHdpdGggR0lNUFeBDhcAAABoSURBVEjHY2AYBaNg2AJmMvQkMTAwGDAwMHAzMDA8JlYTIxkW/SdHPxO9gm7kWWQNjRNkjB5fMPyXgYEhg1yL1Eh0tCm5FpGSKr/jUz+avOlq0Xco/Y8UTSxkWLQCGk+nR6uKUTC4AQC8oBHyYLAfhwAAAABJRU5ErkJggg=='
      var minusUri = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAaCAYAAACpSkzOAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3wYJFgAjZzgQwAAAABl0RVh0Q29tbWVudABDcmVhdGVkIHdpdGggR0lNUFeBDhcAAAAvSURBVEjHY2AYBaNgFIyCUcDAwMAQzsDA8J8InIPPECZ6uZZpNMJGwSgYBSMAAADZ/wm/p4Wt3gAAAABJRU5ErkJggg=='
      // var fullScreenUri = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAABmJLR0QA/wD/AP+gvaeTAAABqklEQVR4nO3cMU/CUBSG4RcGEkz837gYIxqZUX8aRBdhEEZxKC5a0d7enkvhfZIuJL095wu0SWkPSJIkSZIknbcRcAUsgV2LbQXcAeOAmi+Ae2DdsuYFMKHKoHOTlsV+32YBNc8y1zwJqJlF5qI3wLDDeofANnPNi6ZFDBIK3yXsc8gWuAQ+Mq/7ZQi8k/8U1Si7Lr9J/zWnu5DZrz3vcP3O5Pr5vQG3xFwMx8CU6gKcq/5Gcp46Utbqgyz9HsOp4ywYdBCDDmLQQQw6iEEHMeggBh3EoIMYdBCDDpIS9Lrms1XbQo5Yln5Tgn6u+ewpYZ2+KNbvmOqvoc1+eyDmVmcpxfsdcLq3RuucW7+SJEmSJEmSJEmSJHXg3B4nC+93TPWy/Hq/TTn9B2iK9HvDz5cbryMOXEixfl9qDvwaceBCsvTrm7N/883ZPjHoIAYdxKCDGHQQgw5i0EEMOohBBzHoIAYdJGfQTceZ9WU2aTE5R0/u6Ods0qJz71I5MvMXy4R9Tk3jDFKCfkzY55A+ziYNmXU6opqf3Ha8cR9nk4YO6pYkSZIkSTpWnzEaQvQ9Q7BGAAAAAElFTkSuQmCC';
      var zoomIn = L.easyButton('<img class="zoom-in zoom-btn" src="'+ plusUri +'" alt="'+ titles.zoomInTitle +'"/>',
        function(control, map){map.setZoom(map.getZoom()+1);});
      var zoomOut = L.easyButton('<img class="zoom-out zoom-btn" src="' + minusUri + '" alt="'+ titles.zoomOutTitle +'"/>',
        function(control, map){map.setZoom(map.getZoom()-1);});
      // var fullScreen = L.easyButton('<img class="map-full-screen" src="' + fullScreenUri + '" alt="'+ titles.viewFullScreen +'"/>',
      //   function(control, map){map.toggleFullscreen()});
      var zoomBar = L.easyBar([ zoomIn, zoomOut, fullScreen ]);
      zoomBar.addTo(map);


      // Define DOM/jQuery elements of Zoom controls
      const zoomInElement = $('.leaflet-control-zoom-in');
      const zoomOutElement = $('.leaflet-control-zoom-out');
      const viewFullScreenElement = $('.leaflet-control-fullscreen-button');

      // Set titles to the elements
      zoomInElement.attr('aria-label', titles.zoomInTitle);
      zoomInElement.prop('title', titles.zoomInTitle);
      zoomInElement.removeAttr('role');

      zoomOutElement.attr('aria-label', titles.zoomOutTitle);
      zoomOutElement.prop('title', titles.zoomOutTitle);
      zoomOutElement.removeAttr('role');

      viewFullScreenElement.attr('aria-label', titles.viewFullScreen);
      viewFullScreenElement.prop('title', titles.viewFullScreen);
      viewFullScreenElement.removeAttr('role');
    },
  };
}(jQuery, Drupal));
