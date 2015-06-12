
<!DOCTYPE html>
  <head>
    <title>Solutions to the Too Many Markers problem with the Google Maps JavaScript API V3</title>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/tags/markermanager/1.0/src/markermanager.js"></script>
    <script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/markerclusterer_compiled.js"></script>
    <script type="text/javascript" src ="http://gmaps-samples-v3.googlecode.com/svn/trunk/toomanymarkers/markers.js">
 </script>

    <script type="text/javascript">
/**
 * The MarkerClusterer object.
 * @type {MarkerCluster}
 */
var mc = null;

/**
 * The Map object.
 * @type {google.maps.Map}
 */
var map = null;

/**
 * Marker Clusterer display/hide flag.
 * @type {boolean}
 */
var showMarketClusterer = false;

/**
 * Toggles Marker Clusterer visibility.
 */
function toggleMarkerClusterer() {
  showMarketClusterer = !showMarketClusterer;
  if (showMarketClusterer) {
    if (mc) {
      mc.addMarkers(markers.locations);
    } else {
      mc = new MarkerClusterer(map, markers.locations, {maxZoom: 19});
    }
  } else {
    mc.clearMarkers();
  }
}


/**
 * Initializes the map and listeners.
 */
function initialize() {
  map = new google.maps.Map(document.getElementById('map'), {
    center: new google.maps.LatLng(48, 2),
    zoom: 8,
    mapTypeId: 'terrain'
  });

  // Prepares the marker object, creating a google.maps.Marker object for each
  // location, place and country
  if (markers) {
    for (var level in markers) {
      for (var i = 0; i < markers[level].length; i++) {
        var details = markers[level][i];
        markers[level][i] = new google.maps.Marker({
          title: details.level,
          position: new google.maps.LatLng(
              details.location[0], details.location[1]),
          clickable: false,
          draggable: true,
          flat: true
        });
      }
    }
  }
}

google.maps.event.addDomListener(window, 'load', initialize);
  google.maps.event.addDomListener(window, 'load', toggleMarkerClusterer);
    </script>

    <style type="text/css">
    #map {
      width: 900px;
      height: 600px;
    }
    #controls {
      margin: 0;
      list-style: none;
    }
    #controls li {
      display: inline;
      margin-left: 42px;
      font-family: Sans-Serif;
      font-size: 10pt;
    }
    #fusion-hm-li {
      visibility: hidden;
      margin-left: 8px;
    }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <ul id="controls">
      <li>
        <label for="mc-cb">Marker Clusterer</label>
        <input type="checkbox" id="mc-cb" name="mc-cb" />
      </li>
    </ul>
  </body>
</html>
