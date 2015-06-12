
    <style>
    body{
      background: #727272;
    }
    #map-canvas {
      height: 450px;
    }
    .mapFrance{
      width:173px;
      height:166px;
      background:url(map.png) left top no-repeat;
      position:relative; 
    }
    .mapFrance .overlay{
      width:173px;
      height:166px;
      background:url(map.png) 173px top no-repeat;
      position:absolute;
      top:0;
      left:0;
      z-index:1; 
    }
    .mapFrance img{
      position:absolute;
      top:0;
      left:0;
      z-index:2; 
    }
    .mapFrance .tooltip{
      position:fixed;
      border-radius:5px;
      color:#FFF;
      background:#000;
      padding:0 10px;
      display:inline-block;
      top:0;
      left:0;
      z-index:3;
      text-align:center;
    }

    .clubColor{
      width : 30px;
      height : 30px;
      display : inline-block;
    }
    </style>

    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <script src="https://www.google.com/jsapi"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&region=FR&libraries=geometry,weather"></script>


  <script>
  jQuery(function($){

    var query = '3 rue auguste poullain 93200 saint-denis';
    var query2 = '5 rue paul lafargue 93210 la plaine saint-denis';
    var query3 = '5 Allée des zinnias 92600 asnieres sur seine';
    var query4 = '2 Rue de la Liberté, 93200 Saint-Denis';

    var maps = {
      'marker0' : {
        "idBdd" : 0,
        "mapInfo" : {
          "latlng" : {
            "lat" : 48.9407429, 
            "lng" : 2.3557018999999855
          },
          "adresse" : "5 rue auguste poullain 93200 saint-denis",
          "departement" : {
            "name" : "seine-saint-denis",
            "num" : "93"
          },
          "region" : "Île-de-France"
        },
        'type' : "parapente",
        'auteur' : "user2",
        'club' : 'club1',
        'event' : false
      },
      'marker1' : {
        "idBdd" : 2,
        "mapInfo" : {
          "latlng" : {
            "lat" : 48.93860052944034,  
            "lng" : 2.354886508459458
          },
          "adresse" : "4 Boulevard Carnot, 93200 Saint-Denis, France",
          "departement" : {
            "name" : "seine-saint-denis",
            "num" : "93"
          },
          "region" : "Île-de-France"
        },
        'type' : "parapente",
        'auteur' : "u3",
        'club' : 'club5',
        'event' : false
      },
      'marker2' : {
        "idBdd" : 5,
        "mapInfo" : {
          "latlng" : {
            "lat" : 48.916563, 
            "lng" : 2.359468099999958
          },
          "adresse" : "5 Rue Paul Lafargue, 93210 Saint-Denis, France",
          "departement" : {
            "name" : "seine-saint-denis",
            "num" : "93"
          },
          "region" : "Île-de-France"
        },
        'type' : "parachute",
        'auteur' : "user2",
        'club' : 'club1',
        'event' : false
      },
      'marker3' : {
        "idBdd" : 6,
        "mapInfo" : {
          "latlng" : {
            "lat" : 48.9287629,
            "lng" : 2.2728700999999774
          },
          "adresse" : query3,
          "departement" : {
            "name" : "hauts-de-seine",
            "num" : "92"
          },
          "region" : "Île-de-France"
        },
        'type' : "parachute",
        'auteur' : "test",
        'club' : 'clubTest',
        'event' : false
      },
      'marker4' : {
        "idBdd" : 7,
        "mapInfo" : {
          "latlng" : {
            "lat" : 48.9455196,
            "lng" : 2.363317400000028
          },
          "adresse" : query4,
          "departement" : {
            "name" : "seine-saint-denis",
            "num" : "93"
          },
          "region" : "Île-de-France"
        },
        'type' : "aviation",
        'auteur' : "test3",
        'club' : 'club5',
        'event' : false
      }      
    }

    // console.log(maps);

  ////////////////////////////////////////////////////////////////////////////////////////  

    $('.mapFrance').append('<div class="overlay">').append('<div class="tooltip">Carte du Maroc</div>')
    $('.mapFrance .tooltip').hide();
    var regions = [
            {name : 'Corse', slug: 'corse'},
            {name : 'PACA', slug: 'provence-alpes-cote-d-azur'},
            {name : 'Rhônes Alpes', slug:'rhones-alpes'},
            {name : 'Languedoc Roussillon', slug : 'languedoc-roussillon'},
            {name : 'Midi Pyrénées', slug : 'midi-pyrenees'},
            {name : 'Limousin', slug : 'limousin'},
            {name : 'Alsace', slug:  'alsace'},
            {name : 'Aquitaine', slug:'aquitaine'},
            {name : 'Auvergne', slug:'auvergne'},
            {name : 'Bourgogne', slug:'bourgogne'},
            {name : 'Bretagne', slug:'bretagne'},
            {name : 'Basse Normandie', slug:'basse-normandie'},
            {name : 'Centre', slug: 'centre'},
            {name : 'Champagne Ardenne', slug : 'champagne-ardenne'},
            {name : 'Haute Normandie', slug : 'haute-normandie'},
            {name : 'Franche Comté', slug : 'franche-comte'},
            {name : 'Ile de france', slug : 'ile-de-france'},
            {name : 'Lorraine', slug : 'lorraine'},
            {name : 'Nord pas de Calais', slug:  'nord-pas-de-calais'},
            {name : 'Pays de la loire', slug:   'pays-de-la-loire'},
            {name : 'Picardie', slug : 'picardie'},
            {name : 'Poitou Charente', slug: 'poitou-charente'},
            {name : 'Martinique', slug:  'martinique'},
            {name : 'Réunion', slug: 'reunion'},
            {name : 'Guadeloupe', slug:  'guadeloupe' }
    ];

    // Load the Visualization API and the columnchart package.
    // setTimeout(function(){
    google.load('visualization', '1', {'callback':'console.log("")', 'packages':['columnchart']});
    // }, 1000);
    google.maps.visualRefresh = true;

    // Create our "tiny" marker icon
    var gYellowIcon = new google.maps.MarkerImage(
          "<?php echo HTML::getImg("maps/valid.png",false,null,true); ?>",
          new google.maps.Size(32, 32),
          new google.maps.Point(0, 0),
          new google.maps.Point(16, 16));
    var gRedIcon = new google.maps.MarkerImage(
          "<?php echo HTML::getImg("maps/invalid.png",false,null,true); ?>",
          new google.maps.Size(32, 32),
          new google.maps.Point(0, 0),
          new google.maps.Point(16, 16));

    // var query = 'Rabat-Salé-Zemmour-Zaër, Maroc';

    var map;
    var mapDiv = $("#map-canvas")[0];
    var markerFunctions = new Array();
    var markerArray = {};

    var curRegion, curArea;
    var currentPosition,calculatedDistance;
    var nearestMarkers = {};

    var latlngResult,formattedAddress,formattedPartialAddress,startend;
    var infowindow = new google.maps.InfoWindow();
    var DirectionDiv = $("#directions-panel")[0];
    var geocoder = new google.maps.Geocoder();
    var rendererOptions = {
      draggable: true
    };
    var directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);
    // var directionsDisplay = new google.maps.DirectionsRenderer();
    var directionsService = new google.maps.DirectionsService();
    var stepDisplay, stepsMarkerArray = [];
    stepDisplay = new google.maps.InfoWindow();
    var $start = {}, $end = {}, $newEnd =false,$startAdress,$endAdress, $travelMode = "DRIVING";
    var launchDirection = false, AddDirectionMarkers = false, refreshSteps = false, $showSteps = $('#complex').is(':checked');
    var directionWaypointsAdress = [], directionWaypoints = [];
    var tempDirectionDiv;

    var elevator = new google.maps.ElevationService(); // Create an ElevationService
    var markerElevation, chart, polyline, showLine = false, showElevation = false;
    var elevationChart = $('#elevation_chart')[0];
    var $elevationPath = [], markerElevationArray = [];

    function initialize() {
      var latLngMarker = new google.maps.LatLng(48.9407429, 2.3557019);

      //Options de la carte
        //Options pour le terrain [HYBRID, ROADMAP, SATELLITE, TERRAIN]
      var mapOptions = {
        zoom: 10,
        center: latLngMarker,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      };

      map = new google.maps.Map(mapDiv,mapOptions);

      //Changer le zoom
      // map.setZoom(11);

      //Afficher des controles et changer leur position
      // var control = document.getElementById('control');
      // control.style.display = 'block';
      // map.controls[google.maps.ControlPosition.TOP_CENTER].push(control);

      google.maps.event.addListener(map, 'click', getElevation);
  var homeControlDiv = document.createElement('div');
  var homeControl = new HomeControl(homeControlDiv, map);

  homeControlDiv.index = 1;
  map.controls[google.maps.ControlPosition.TOP_RIGHT].push(homeControlDiv);
    }  

    function HomeControl(controlDiv, map) {

      var chicago = new google.maps.LatLng(41.850033, -87.6500523);
      // Set CSS styles for the DIV containing the control
      // Setting padding to 5 px will offset the control
      // from the edge of the map
      controlDiv.style.padding = '5px';

      // Set CSS for the control border
      var controlUI = document.createElement('div');
      controlUI.style.backgroundColor = 'white';
      controlUI.style.borderStyle = 'solid';
      controlUI.style.borderWidth = '2px';
      controlUI.style.cursor = 'pointer';
      controlUI.style.textAlign = 'center';
      controlUI.title = 'Click to set the map to Home';
      controlDiv.appendChild(controlUI);

      // Set CSS for the control interior
      var controlText = document.createElement('div');
      controlText.style.fontFamily = 'Arial,sans-serif';
      controlText.style.fontSize = '12px';
      controlText.style.paddingLeft = '4px';
      controlText.style.paddingRight = '4px';
      controlText.innerHTML = '<b>Home</b>';
      controlUI.appendChild(controlText);

      // Setup the click event listeners: simply set the map to
      // Chicago
      google.maps.event.addDomListener(controlUI, 'click', function() {
        map.setCenter(chicago)
      });

    }

    function drawPath($path, $showLine) {

      if(typeof $showLine != "undefined" && $showLine) {
        showLine = $showLine;
      }

      // Create a new chart in the elevation_chart DIV.
      chart = new google.visualization.ColumnChart(elevationChart);

      // Create a PathElevationRequest object using this array.
      // Ask for 256 samples along that path.
      var pathRequest = {
        'path': $path,
        'samples': 256
      }

      // Initiate the path request.
      elevator.getElevationAlongPath(pathRequest, plotElevation);
    }

    // Takes an array of ElevationResult objects, draws the path on the map
    // and plots the elevation profile on a Visualization API ColumnChart.
    function plotElevation(results, status) {
      if (status != google.maps.ElevationStatus.OK) {
        return;
      }
      var elevations = results;

      // Extract the elevation samples from the returned results
      // and store them in an array of LatLngs.
      var elevationPath = [];
      for (var i = 0; i < results.length; i++) {
        elevationPath.push(elevations[i].location);
      }

      // Display a polyline of the elevation path.
      if(typeof showLine != "undefined" && showLine) {
        var pathOptions = {
          path: elevationPath,
          strokeColor: '#0000CC',
          opacity: 0.4,
          map: map
        }
        polyline = new google.maps.Polyline(pathOptions);
      }

      // Extract the data from which to populate the chart.
      // Because the samples are equidistant, the 'Sample'
      // column here does double duty as distance along the
      // X axis.
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Sample');
      data.addColumn('number', 'Elevation');
      for (var i = 0; i < results.length; i++) {
        data.addRow(['', elevations[i].elevation]);
      }

      // Draw the chart using the data within its DIV.
      chart.draw(data, {
        height: 150,
        legend: 'none',
        titleY: 'Elevation (m)'
      });
    }

    google.maps.event.addDomListener(window, 'load', initialize);

    function draggableMarker($latLngMarker,$draggable,$title) {
      $marker = replaceMarkerIcon($latLngMarker,$draggable, $title);
      // Update current position info.
      // geocodePosition(latLng);    

      if(typeof $draggable != "undefined" && $draggable) {  
        // Add dragging event listeners.
        google.maps.event.addListener($marker, 'dragstart', function() {
          $marker.setOptions({icon: gRedIcon});
          console.log('Dragging...');
        });
        
        google.maps.event.addListener($marker, 'drag', function() {
          console.log('Dragging...');
          console.log($marker.getPosition());
        });
        
        google.maps.event.addListener($marker, 'dragend', function() {
          console.log('Drag ended');
          $marker.setOptions({icon: gYellowIcon});
          console.log($marker.getPosition());
        });
      }

      return $marker;
    }

    function replaceMarkerIcon($latlng,$draggable,$title) { 
      if(typeof $draggable != "undefined" && $draggable) {
        var $marker = new google.maps.Marker({
          position: $latlng,
          title: $title,
          map: map,
          icon: gYellowIcon,
          draggable: true
        });
      } else {
        var $marker = new google.maps.Marker({
          position: $latlng,
          title: $title,
          map: map,
          icon: gYellowIcon
        });
      }

      return $marker
    }

    function changeMarkerIcon($marker,$icon,$url,$custom,$draggable) { 
      if(typeof $url == "undefined" || $url){
        if(typeof $custom != "undefined" && $custom) {
          $icon = "http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld="+$icon;
        } else {
          $icon = "http://chart.apis.google.com/chart?chst=d_map_spin&chld="+$icon;
        }
      } 
      if(typeof $draggable != "undefined" && $draggable) {
        $marker.setIcon($icon);
        $marker.setDraggable(true);
      } else {
        $marker.setIcon($icon);
      }
    }

    //trouver LatLng à partir d'adresse
    function codeLatLng(address, $callback) {
      var $latlngResult;
      geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            $latlngResult = results[0].geometry.location;
            latlngResult = $latlngResult;
            $callback($latlngResult);
        } else {
          return false;
        }
        // console.log(results[0].geometry.location);
        // map.setCenter(results[0].geometry.location);
        // var marker = new google.maps.Marker({
        //     map: map,
        //     position: results[0].geometry.location
        // });
      });    
    }

    //trouver adresse partiel à partir de LatLng (code postal, departement, pays)
    function codeAddress($marker) {
      // var latlngStr = input.split(',', 2);
      // var lat = parseFloat(latlngStr[0]);
      // var lng = parseFloat(latlngStr[1]);
      var latlngObj = $marker.getPosition();
      var lat = latlngObj.lat();
      var lng = latlngObj.lng();
      var latlng = new google.maps.LatLng(lat, lng);
      geocoder.geocode({'latLng': latlng}, function(results, status) {

        if (status == google.maps.GeocoderStatus.OK) {
          if (results[1]) {
            formattedPartialAddress =  results[1].formatted_address;
          } else {
            alert('No results found');
          }
        } else {
          alert('Geocoder failed due to: ' + status);
        }
      });
    }

    //trouver adresse compléte à partir de LatLng (deuxiéme fonction)
    function geocodePosition($marker, $callback) {
      var pos = $marker.getPosition();
      geocoder.geocode({
        latLng: pos
      }, function(responses) {
        if (responses && responses.length > 0) {
          formattedAddress =  responses[0].formatted_address;
          $callback(responses[0].formatted_address);
        } else {
          alert('Cannot determine address at this location.');
        }
      });
    }  

    //Activer direction() 
    function setDirectionMarkers($marker,$markerAdress){
      if(!AddDirectionMarkers) {
        if(typeof $start.marker == "undefined") {
          $start.marker = $marker;
          $start.markerAdress = $markerAdress;
          var newIcon = "0.8|0|F76C60|20|b|A";
          changeMarkerIcon($start.marker, newIcon);        
          $start.marker.infowindow.close();
        } else if (typeof $end.marker == "undefined" || $newEnd) {
          if($marker != $end.marker && $marker != $start.marker) {
            if($newEnd) {
              var newIcon = "%E2%80%A2|FE7569|000000";
              changeMarkerIcon($end.marker, newIcon, true, true);
            }
            $end.marker = $marker;
            $end.markerAdress = $markerAdress;
            $newEnd = false;
            var newIcon = "0.8|0|F76C60|20|b|B";
            changeMarkerIcon($end.marker, newIcon);        
            $end.marker.infowindow.close();
          }
        } else {
          if($start.marker != $marker) {            
            var newIcon = "%E2%80%A2|FE7569|000000";
            changeMarkerIcon($start.marker, newIcon, true, true);
            $start.marker = $marker;
            $start.markerAdress = $markerAdress;
            $newEnd = true;
            var newIcon = "0.8|0|F76C60|20|b|A";
            changeMarkerIcon($start.marker, newIcon);        
            $start.marker.infowindow.close();
          }
        }
      }
      if(typeof $start.marker != "undefined" && typeof $end.marker != "undefined") { 

        $startAdress = $start.markerAdress;
        $endAdress = $end.markerAdress;

        if(typeof $startAdress == "undefined" && typeof $endAdress != "undefined"){
          geocodePosition($start.marker, function($formattedAddress) {
            $startAdress = $formattedAddress; 
            $('#start').html($startAdress);
            $('#end').html($endAdress);  
          });
        } else if(typeof $startAdress != "undefined" && typeof $endAdress == "undefined") {
          geocodePosition($end.marker, function($formattedAddress) {
            $endAdress = $formattedAddress; 
            $('#start').html($startAdress);
            $('#end').html($endAdress);  
          }); 
        }

        $('#start').html($startAdress);
        $('#end').html($endAdress);
      }

      if(typeof $startAdress != "undefined" && typeof $endAdress != "undefined" && launchDirection) {      

        calcRoute($startAdress,$endAdress,$travelMode);
        startend = true;
        $('.inverser').show();
        $("#travelMode").show();
        $('.stopDirection').show();
        $("#totalDistance").show();
        $(".complex").show();
      } else if (typeof $startAdress != "undefined" && typeof $endAdress != "undefined" && AddDirectionMarkers) {
        var $addedMarker = $marker; 
        var $addedMarkerLatLng = $marker.getPosition();
        var $addedMarkerAdress = $markerAdress;
        $marker.infowindow.close();

        if($.inArray($addedMarkerLatLng, directionWaypoints) != -1){
          directionWaypoints = jQuery.grep(directionWaypoints, function(value) {
            return value != $addedMarkerLatLng;
          });
          directionWaypointsAdress.splice( $.inArray($addedMarkerAdress, directionWaypointsAdress), 1 );
          var newIcon = "%E2%80%A2|FE7569|000000";
          changeMarkerIcon($marker, newIcon, true, true);
        } else {
          directionWaypoints.push($addedMarkerLatLng);
          directionWaypointsAdress.push($addedMarkerAdress);
          var newIcon = "x|CDCDCD|000000";
          changeMarkerIcon($marker, newIcon, true, true);
        }
        $('#added').html(directionWaypointsAdress.join(",<br>"));
      }
    }

    //Direction pour aller d'un point "A" à "B"
    function calcRoute($start,$end,$selectedMode) {
      // First, remove any existing markers from the map.
      removeMarker(null, "clear");
      for (var i = 0; i < stepsMarkerArray.length; i++) {
        stepsMarkerArray[i].setMap(null);
      }
      // Now, clear the array itself.
      stepsMarkerArray = [];

      if(typeof directionWaypoints != "undefined" && directionWaypoints.length != 0) {
        var formattedWaypoints = [];
        for(var waypoint in directionWaypoints) {
          var $formattedWaypoint = {
            location : directionWaypoints[waypoint],
            stopover : true
          };
          formattedWaypoints.push($formattedWaypoint);
        }

        var request = {
          origin: $start,
          destination: $end,
          waypoints: formattedWaypoints,
          optimizeWaypoints: true,
          travelMode: google.maps.TravelMode[$selectedMode]
        };
      } else {
        var request = {
          origin: $start,
          destination: $end,
          travelMode: google.maps.TravelMode[$selectedMode]
        };
      }
      directionsService.route(request, function(response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
          displayDirection(response, map, DirectionDiv);

          refreshSteps = true;  
        }
      });  
    }

    google.maps.event.addListener(directionsDisplay, 'directions_changed', function() {
      if(refreshSteps) {
        removeSteps();
        console.log("test");
        showSteps(directionsDisplay.directions);
        var response = directionsDisplay.directions;
        var route = response.routes[0];
        var totalDistance = 0;
        for (var i = 0; i < route.legs.length; i++) {
          var legDistance = route.legs[i].distance.text;
          legDistance= legDistance.replace(" km","");
          legDistance = legDistance.replace(",",".");
          legDistance = parseFloat(legDistance);
          totalDistance += legDistance;
        } 
        $(".distance").html(totalDistance);
        $("#totalDistance").show();
        refreshSteps = false;
      }
    });

    //Afficher les directions et les étapes
    function displayDirection($response, $map, $div) {
      directionsDisplay.setDirections($response);      
      directionsDisplay.setMap($map);
      directionsDisplay.setPanel($div);
      if($showSteps) {
        showSteps($response);
      }

      var route = $response.routes[0];
      var totalDistance = 0.0;
      for (var i = 0; i < route.legs.length; i++) {
        var legDistance = route.legs[i].distance.text;
        legDistance= legDistance.replace(" km","");
        legDistance = legDistance.replace(",",".");
        legDistance = parseFloat(legDistance);
        totalDistance += legDistance;
      } 
      $(".distance").html(totalDistance);
    }

    //Créer les étapes pour la direction 
    function showSteps($directionResult) {
      // For each step, place a marker, and add the text to the marker's
      // info window. Also attach the marker to an array so we
      // can keep track of it and remove it when calculating new
      // routes.
      var myRoute = $directionResult.routes[0].legs;

      $elevationPath.push($start.marker.getPosition());
      var stepNumber = 0;
      for (var k = 0; k < myRoute.length; k++) {
        for (var i = 0; i < myRoute[k].steps.length; i++) {
          var marker = new google.maps.Marker({
            draggable :false,
            position: myRoute[k].steps[i].start_point,
            map: map
          });
          attachInstructionText(marker, myRoute[k].steps[i].instructions);
          stepsMarkerArray[stepNumber] = marker;
          $elevationPath.push(marker.getPosition());
          stepNumber++;
        }
      }

      $elevationPath.push($end.marker.getPosition());
      if(typeof showElevation != "undefined" && showElevation) {
        drawPath($elevationPath,true);
      }
    }

    //ajouter des "infowindow" pour chaque étape
    function attachInstructionText(marker, text) {
      google.maps.event.addListener(marker, 'click', function() {
        // Open an info window when the marker is clicked on,
        // containing the text of the step.
        stepDisplay.setContent(text);
        stepDisplay.open(map, marker);
      });
    }

    function InverseRoute(){
      if(launchDirection) {
        if(startend){
          calcRoute($endAdress,$startAdress,$travelMode);
          startend = false;
        } else {
          calcRoute($startAdress,$endAdress,$travelMode);
          startend = true;
        }
      } else {
        console.log("inverse");
        var tempStart= $start;
        var newIcon = "0.8|0|F76C60|20|b|B";
        changeMarkerIcon($start.marker, newIcon);
        var newIcon = "0.8|0|F76C60|20|b|A";
        changeMarkerIcon($end.marker, newIcon);
        $start = $end;
        $end = tempStart;
      }
    }

    function removeDirection() {           
      directionsDisplay.setMap(null);
      directionsDisplay.setPanel(null);
      for (var i = 0; i < stepsMarkerArray.length; i++) {
        stepsMarkerArray[i].setMap(null);
      }
      stepsMarkerArray = [];
      directionWaypoints = [];
      directionWaypointsAdress = [];
      $start = {};
      $end = {};
      var $startAdress;
      var $endAdress;
      launchDirection = false;
      AddDirectionMarkers = false;

      findmarkers(curArea, true);
    }

    function removeSteps() {   

      for (var i = 0; i < stepsMarkerArray.length; i++) {
        stepsMarkerArray[i].setMap(null);
      }
      stepsMarkerArray = [];
    }

    //Calculer la distance entre deux points/markers
    function calcDistance($pointA,$pointB) {      

      // console.log(pointB);
      // console.log(pointA);
      // console.log(google.maps.geometry.spherical.computeDistanceBetween(pointA, pointC));
      calculatedDistance = google.maps.geometry.spherical.computeDistanceBetween($pointA, $pointB);
      return google.maps.geometry.spherical.computeDistanceBetween($pointA, $pointB);
    }

    //Récupérer l'élévation d'un marker en particulier
    function getElevation($marker,$addInfo, $callback) {

      var locations = [];
      var randomClick = false;
      // Retrieve the clicked location and push it on the array
      // var clickedLocation = event.latLng;
      if(typeof $marker != "undefined") {
        if ('getPosition' in $marker) {
          var clickedLocation = $marker.getPosition();
        } else {
          // console.log($marker.latlng);
          // console.log(event);
          var clickedLocation = $marker.latLng;
          randomClick = true;
        }
      } else {
        var clickedLocation = $marker.latLng;
      }
      locations.push(clickedLocation);
      // Create a LocationElevationRequest object using the array's one value
      var positionalRequest = {
        'locations': locations
      }
      // Initiate the location request
      elevator.getElevationForLocations(positionalRequest, function(results, status) {
        if (status == google.maps.ElevationStatus.OK) {
          if (results[0]) {
            var $elevationResult = 'The elevation at this point <br>is ' + results[0].elevation + ' meters.'
            markerElevation = $elevationResult;
            if(typeof $addInfo != "undefined" && $addInfo) {
              var $content = $marker.infowindow.content +"<br>"+ markerElevation;
              $marker.infowindow.content = $content;
            }
            if(typeof $callback != "undefined") {
              $callback($elevationResult);
            }
            if(randomClick) {
              infowindow.setContent('The elevation at this point <br>is ' + results[0].elevation + ' meters.');
              infowindow.setPosition(clickedLocation);
              infowindow.open(map);
            }
          } else {
            alert('No results found');
          }
        } else {
          alert('Elevation service failed due to: ' + status);
        }
      });
    }

    //Boucle pour récupérer les élévations d'une liste de markers
    function getMarkersElevation($marker, $markerElevationArray) { 

      // for (var markers in markerArray) {
        // var time = markers+1;
        // var markerNb = 0;  
      getElevation($marker,true, function($markerElevation){
          $markerElevationArray.push($markerElevation); 
      });
        // setTimeout(function() {  
        //   getElevation(markerArray[markerNb].markerSlug,true);
        //   setTimeout(function() {
        //     $markerElevation.push(markerElevation);  
        //     markerElevation = null;
        //   }, 300); 
        //   markerNb++;
        // }, (200+(time*100)) ); 

      // }
    }

    function changeBounds($addBound){    
      var bounds = new google.maps.LatLngBounds();

      if(typeof $addBound != "undefined") {
        if(typeof currentPosition == "undefined") {
          getCurrentPosition(function($curPos){
            bounds.extend($curPos);
          })
        }
        else {
          bounds.extend(currentPosition);
        }
      }
      for (var markers in markerArray) {  
        bounds.extend(markerArray[markers].markerSlug.getPosition());
      }
      map.fitBounds(bounds);               
    }

    function setCurPosMarker($callback) {
      getCurrentPosition(function(results) {
        draggableMarker(currentPosition, false, "Position Actuel");
        if(typeof $callback != "undefined") {
          $callback();  
        }
      });
      // setTimeout(function() {
      //   draggableMarker(currentPosition, false, "Position Actuel");
      //   getClosestMarkers();
      // }, 300);
    }

    function getCurrentPosition($callback){      
      if(navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
          initialLocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
          currentPosition =  initialLocation;
          if(typeof $callback != "undefined") {
            $callback(initialLocation);
          }
        });
      } else {
        alert("Votre navigateur ne supporte pas la géolocalisation");
      }
    }

    function getClosestMarkers($callback){
      for (var markers in markerArray) {
        var $pointA = currentPosition;
        var $pointB = markerArray[markers].markerSlug.getPosition();

        var $markerDistance = calcDistance($pointA,$pointB);
        var $markerId = markerArray[markers].markerId;
        var $markerSlug = markerArray[markers].markerSlug;
        // var $markerAdresse = maps[$markerId].mapInfo.adresse;
        var $markerClub = maps[$markerId].club;

        nearestMarkersLen = countInObject(nearestMarkers);
        var nearestMarkersTemp = {};
        nearestMarkersTemp.club = $markerClub;
        nearestMarkersTemp.distance = $markerDistance;
        nearestMarkersTemp.marker = $markerSlug;
        nearestMarkers[nearestMarkersLen] =  nearestMarkersTemp;
      } 
      nearestMarkers = sortObject(nearestMarkers, "distance");
      if(typeof $callback != "undefined") {
        $callback();
      }
    }

    function setClosestMarkers(){
      getClosestMarkers(function(){
        var clubArray = {};
        var numMarker = 1;
        for(var nearMarker in nearestMarkers){
          var clubName = nearestMarkers[nearMarker].club;
          if(typeof clubArray[clubName] == "undefined") {
            clubArray[clubName] = {};
            clubArray[clubName].markerColor = getRandomColor();
            var clubLetter = countInObject(clubArray);
            clubLetter = String.fromCharCode(96 + clubLetter);
            clubLetter = clubLetter.toUpperCase();
            clubArray[clubName].letter = clubLetter;            
          }  
          var clubLetter = clubArray[clubName].letter;   
          var curClub = clubArray[clubName];    
          if(typeof curClub.clubMarkers == "undefined") {
            curClub.clubMarkers = {};
          }
          var curMarker = nearestMarkers[nearMarker].marker;
          var clubMarkersLen = countInObject(curClub.clubMarkers);
          curClub.clubMarkers[clubMarkersLen] = {};
          curClub.clubMarkers[clubMarkersLen] = curMarker;
          var newIcon = "1|0|"+curClub.markerColor+"|13|b|"+parseInt(numMarker)+"-"+clubLetter;
          changeMarkerIcon(curMarker, newIcon);
          numMarker++;
          var closestDistance = nearestMarkers[nearMarker].distance;

          var $content = "Club : "+clubName+"<br>"+"Site : "+nearMarker+"<br>Distance en vous et la destination : "+(closestDistance /1000).toFixed(2)+"Km ("+closestDistance.toFixed(2)+"m).<br>";
          if($('.'+clubName).length == 0){
            $content = '<div class = "'+clubName+'"><h1><div class ="clubColor" style = "background :'+curClub.markerColor+';"></div>'+clubName+' ('+clubLetter+') :</h1>'+$content+'</div><hr><br>';
            $(".closetMarker").append($content);
          } else {
            $('.'+clubName).append($content);
          }
        }
      });
    }

    function sortObject($array,$needle,$flip) {
      for(data in $array) {
        var valueToSort = $array[data][$needle];
        for (checkedData in $array){
          if($array[data] != $array[checkedData]){
            var $comparedData = $array[checkedData][$needle];
            if(typeof $flip != "undefined" && $flip) {              
              if(valueToSort >= $comparedData) {
                var $tempObjectSort = $array[data];
                var $tempObejctCompared = $array[checkedData];
                $array[data] = $tempObejctCompared;
                $array[checkedData] = $tempObjectSort;
              }
            } else if(typeof $flip == "undefined" || !$flip){
              if(valueToSort <= $comparedData) {
                var $tempObjectSort = $array[data];
                var $tempObejctCompared = $array[checkedData];
                $array[data] = $tempObejctCompared;
                $array[checkedData] = $tempObjectSort;
              }
            }
          }
        }
      }

      return $array;
    }

    function getRandomColor() {
      var randomColor = ('000000' + Math.floor(Math.random()*16777215).toString(16)).slice(-6);
      // var randomColor = Math.floor(Math.random()*16777215).toString(16);
      return randomColor;
    }

    //Fonction pour les marker
    ///------------------------------------------------------------------------------------------------------//

    //Trouver les markers pour une région en particulier
    function findmarkers($region, $erased) {
      var mapInfo;
      var markerRegion;
      var foundMarkers = false;
      $region = $region.toLowerCase();
      if(curRegion != $region || $erased){
        for(markers in maps) { 
          mapInfo = maps[markers].mapInfo;
          markerRegion = mapInfo.region;
          markerRegion = markerRegion.removeAccents();
          markerRegion = markerRegion.toLowerCase();
          if(markerRegion == $region){ 
            var coordinates = mapInfo.latlng;
            var latlngRegion = new google.maps.LatLng(coordinates.lat,coordinates.lng);
            var markerTitle =maps[markers].auteur+" - "+maps[markers].club;
            var markerContent = maps[markers].auteur+" - "+maps[markers].club +"<br>"+ $("#test").html();
            createMarker(map,latlngRegion,markerTitle,markerContent,markers); 
            foundMarkers = true;
          }
        }

        setCurPosMarker();

        if(!foundMarkers) {
          codeLatLng($region, function ($latlngResult) {
            map.setCenter($latlngResult);
          }); 
        } else {
          for (var markers in markerArray) {
            getMarkersElevation(markerArray[markers].markerSlug,markerElevationArray);
          }
          changeBounds(true);
          foundMarkers = false;
        }

        curRegion = $region;
      }
    }

    //Créer marker avec eventListener unique
    function createMarker($map, $pos, $title, $content,$markerId,$markerFunctions) {
      var $marker = new google.maps.Marker({       
          position: $pos, 
          map: $map,
          title: $title      
      }); 

      $content = $content + "<br>" + "Calcul de l'élévation en cours...";
      $marker.infowindow = new google.maps.InfoWindow({
        content: $content,
        maxWidth: 200
      });

      var markerArrayTemp = {};
      if(typeof $markerFunctions != "undefined" && $markerFunctions.length !== 0) {
        markerFunctions = $markerFunctions; 
      } else {
        markerFunctions = new Array(); 
      }
      markerArrayLen = countInObject(markerArray);
      markerArrayTemp.markerSlug = $marker; 
      markerArrayTemp.state = "show"; 
      markerArrayTemp.markerId = $markerId; 
      markerArray[markerArrayLen] = markerArrayTemp;
      
      // markerFunctions = ["infowindow", "directions","elevation"];
      markerFunctions = ["infowindow", "directions","elevation"];
      createListener($marker,map,"click",markerFunctions,infowindow,$markerId);
      markerFunctions = ["remove"];
      createListener($marker,map,"dblclick",markerFunctions,"hide",$markerId);
      return $marker;  
    }

    //créer un eventListner pour un marker en particulier
    function createListener($marker,$map,$event,$type,$additional,$markerId) { 
      google.maps.event.addListener($marker, $event, function() {    
        for (var i = 0; i < $type.length; i++) {
          switch ($type[i]) {
            case 'remove':
              removeMarker($marker,$additional);
            break;
            case 'infowindow':
              $marker.infowindow.open($map,$marker);
            break;
            case 'directions':
              $markerAdress = maps[$markerId].mapInfo.adresse;
              setDirectionMarkers($marker,$markerAdress);
            break;
            case 'elevation':
              getElevation($marker);
            break;
         
            default:
              $marker.infowindow.open($map,$marker);
          }
        };              
      }); 
    }

    //Autre fonction pour créer des écouteurs
    function createListener2($marker,$map,$event,$additional,$function) { 
      google.maps.event.addListener($marker, $event, function() { 
        // infowindow.open(map,marker);
        $function($marker,$map,$event,$additional);      
      }); 
      //Utilisation :      
      // createListener(marker,map,"click",infowindow,function($marker,$map,$event,$additional) {
      //   $additional.open($map,$marker);
      // })
    }

    //Ne pas afficher un marker en particulier
    function removeMarker($marker,$state) { 
      for (var markers in markerArray) {

        markerArray[markers].markerSlug.setMap(null);

        if($state != "clear") {
          if(markerArray[markers].markerSlug == $marker && $state == "hide") {
            markerArray[markers].state = "hide";
          }

          if($state == "remove") {
            if(markerArray[markers].markerSlug == $marker) {
              delete markerArray[markers];
            }
          } 

          if(typeof markerArray[markers] != 'undefined' && markerArray[markers].state != "hide") {
            markerArray[markers].markerSlug.setMap(map);
          }
        }
      }
    }


    //Fonction pour la carte de France ou la page
    ///------------------------------------------------------------------------------------------------------//
    // Tooltip qui suit la souris
    $(document).mousemove(function(e){
        $('.mapFrance .tooltip').css({
          top:e.pageY-$('.map .tooltip').height()-20,
          left:e.pageX-$('.map .tooltip').width()/2-10
        });
    });

    $('.mapFrance area').click(function() {
      var index = $(this).index();
      // console.log(regions[index].slug);
      // codeAddress(regions[index].slug)
      curArea = regions[index].name;
      findmarkers(curArea);
      return false;
    })
    
    // On passe sur une région
    $('.mapFrance area').mouseover(function(){
      var index = $(this).index();
      var left = -index * 173 - 173;
      $('.mapFrance .tooltip').html(regions[index].name).stop().fadeTo(500,0.6);
      $('.mapFrance .overlay').css({
          backgroundPosition : left+"px 0px"
      });
    });
    
    // On sort de la map
    $('.mapFrance').mouseout(function(){
      $('.mapFrance .overlay').css({
          backgroundPosition : "173px 0px"
      });
      $('.mapFrance .tooltip').stop().fadeTo(500,0);
    });

    $(".direction").click(function(){
      launchDirection = true;
      setDirectionMarkers($start.marker, $startAdress);
      $(this).hide();
    });

    $('.stopDirection').click(function() {
      removeMarker(null,"clear");
      removeDirection();
      removeSteps();

      $(".direction").show();
      $(this).hide();
      $("#start").empty();
      $("#end").empty();
      $("#added").empty();
      $("#totalDistance").empty();
      $("#start").hide();
      $("#end").hide();
      $("#added").hide();
      $(".inverser").hide();
      $("#travelMode").hide();
      $(".complex").hide();
      return false;
    })

    $(".inverser").click(function() {
      InverseRoute();
    });

    $("#travelMode").change(function() {      
      $travelMode = $(this).val();
      InverseRoute();
    });

    $("#map-canvas").click(function(){
      if($("#directions-panel").html() != tempDirectionDiv && $("#directions-panel").html() != "") {
        tempDirectionDiv = $("#directions-panel").html();
        refreshSteps = true;
      }
    })

    $(".addDirection").click(function(){
      AddDirectionMarkers = true;
    });    

    $('#complex').click(function(){
      $showSteps = $('#complex').is(':checked');
      if($showSteps && launchDirection) {
        removeSteps();
        showSteps(directionsDisplay.directions);
        var response = directionsDisplay.directions;
        var route = response.routes[0];
        var totalDistance = 0;
        for (var i = 0; i < route.legs.length; i++) {
          var legDistance = route.legs[i].distance.text;
          legDistance= legDistance.replace(" km","");
          legDistance = legDistance.replace(",",".");
          legDistance = parseFloat(legDistance);
          totalDistance += legDistance;
        } 
      } else if(!$showSteps) {        
        removeSteps();
      }      
    });

    $(".weather").click(function(){
      var weatherLayer = new google.maps.weather.WeatherLayer({
        temperatureUnits: google.maps.weather.TemperatureUnit.CELSIUS
      });
      weatherLayer.setMap(map);

      var cloudLayer = new google.maps.weather.CloudLayer();
      cloudLayer.setMap(map); 
    });  

    $(".closest").click(function(){
      if(typeof currentPosition != "undefined") {
        setClosestMarkers(); 
      } else {
        setCurPosMarker(setClosestMarkers);
      }
    });


    //Fonction Générale
    ///------------------------------------------------------------------------------------------------------//

    function countInObject(obj) {
      var count = 0;
      // iterate over properties, increment if a non-prototype property
      for(var key in obj) if(obj.hasOwnProperty(key)) count++;
      return count;
    }
      
    String.prototype.removeAccents = function(){
     return this
             .replace(/[áàãâä]/gi,"a")
             .replace(/[éè¨ê]/gi,"e")
             .replace(/[íìïî]/gi,"i")
             .replace(/[óòöôõ]/gi,"o")
             .replace(/[úùüû]/gi, "u")
             .replace(/[ç]/gi, "c")
             .replace(/[ñ]/gi, "n")
             .replace(/[^a-zA-Z0-9]/g," ");
    }


  });
  </script>

    <div class="mapFrance" style = "float : left;">
      <?php echo HTML::getImg("maps/void.png",false,' alt="map" border="0" usemap="#Map"'); ?>
      <map name="Map">
        <area shape="poly" coords="159,145,169,138,169,153,161,160,159,146" href="/VendreEtAcheter.fr/">
        <area shape="poly" coords="122,130,142,134,157,122,147,116,149,109,143,107,129,117,133,121,125,122,122,130" href="#">
        <area shape="poly" coords="115,116,129,114,150,98,145,93,145,88,118,86,116,97,122,103,115,116" href="#">
    
        <area shape="poly" coords="88,147,102,145,122,127,127,118,111,115,109,127,90,132,88,146" href="#">
        <area shape="poly" coords="70,141,88,142,88,133,109,127,109,112,87,112,83,126,67,129,70,140" href="#">
        <area shape="poly" coords="87,109,93,108,99,96,98,85,77,85,78,97,86,108" href="#">
        <area shape="poly" coords="154,64,161,39,151,41,149,57,155,63" href="#">
        <area shape="poly" coords="69,139,67,130,84,126,86,111,76,96,70,106,57,100,53,136,67,139" href="#">
        <area shape="poly" coords="93,111,100,98,97,83,106,77,118,86,116,99,121,104,117,114,106,109" href="#">
        <area shape="poly" coords="119,84,132,66,124,56,106,51,105,77" href="#">
        <area shape="poly" coords="17,56,38,63,55,58,57,48,44,44,38,48,30,43,15,46" href="#">
        <area shape="poly" coords="53,44,66,46,73,53,80,42,68,31,51,27" href="#">
    
        <area shape="poly" coords="70,69,82,83,95,82,105,74,105,50,94,52,86,42,77,54,70,69" href="#">
        <area shape="poly" coords="131,62,134,56,124,44,130,26,121,23,110,36,110,51" href="#">
        <area shape="poly" coords="83,43,91,25,86,16,71,26,76,37" href="#">
        <area shape="poly" coords="131,86,141,83,151,63,138,58,130,69" href="#">
        <area shape="poly" coords="86,37,98,51,111,44,110,36,90,31" href="#">
        <area shape="poly" coords="146,60,126,46,132,29,158,38,150,41" href="#">
        <area shape="poly" coords="85,11,120,20,104,5,89,3,86,11" href="#">
        <area shape="poly" coords="57,81,58,72,70,71,74,57,66,48,58,48,55,61,42,64,51,84" href="#">
        <area shape="poly" coords="90,30,111,37,119,22,87,12" href="#">
    
        <area shape="poly" coords="58,99,70,104,81,83,68,72,58,77,57,97" href="#">
        <area shape="poly" coords="30,143,49,162,36,162,26,148" href="#">
        <area shape="poly" coords="19,156,28,156,31,175,19,167" href="#">
        <area shape="poly" coords="12,160,21,138,1,139,1,160" href="#">
      </map>
    </div> 

    <div id="start"></div>
    <div id="end"></div>
    <div id="added"></div>
    <div id="totalDistance" style = "display : none;">Total à parcourir : <span class="distance"></span>km.</div>

  <button class="stopDirection" style = "display : none;">Back</button>
  <button class="direction" >Direction</button>
  <button class="addDirection" >Ajouter</button>
  <button class="weather" >Météo</button>
  <button class="closest" >Le plus proche</button>
  <button class="inverser" style = "display : none;" >Inverser</button>
  <div class="complex" style = "display : none;">
    <label for="complex">Complex</label>
    <input type="checkbox" id = "complex" checked = "checked">
  </div>
  <select id="travelMode" style = "display : none;">
    <option value="DRIVING">Driving</option>
    <option value="WALKING">Walking</option>
    <option value="BICYCLING">Bicycling</option>
    <option value="TRANSIT">Transit</option>
  </select>

  <div id="elevation_chart"></div>

  <div id="map-canvas" ></div>
  <div id="directions-panel"></div>

  <div class="closetMarker">
  </div>
  
