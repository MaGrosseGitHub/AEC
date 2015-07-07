
    <style>
    #map-canvas img{max-width: inherit;}
    #map-canvas {
      height: 450px;
    }
    .mapFrance{
      width:173px;
      height:166px;
      background: #727272 url(<?php echo HTML::getImg("maps/map.png",false,true); ?>) left top no-repeat;
      position:relative; 
    }
    .mapFrance .overlay{
      width:173px;
      height:166px;
      background:url(<?php echo HTML::getImg("maps/map.png",false,true); ?>) 173px top no-repeat;
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
    
   .labels {
     color: red;
     background-color: white;
     font-family: "Lucida Grande", "Arial", sans-serif;
     font-size: 10px;
     font-weight: bold;
     text-align: center;
     width: 40px;
     border: 2px solid black;
     white-space: nowrap;
   }

   hr{
    border-color: #000;
   }

   .labels a {
    /*font-size: 18px;*/
   }

   .markerPos{
      text-decoration : none;
      
      display: block;
      padding: 0 0 0 0px;
      background: #ccc;
      
      font: bold 18px sans-serif;
      font-family: Lato;
      text-align: center;
      color : #3D3D3D;
      line-height: 23px;
      
      width: 23px; height: 23px;
      background: #CDCDCD;
      
      -moz-border-radius: 999px;
      border-radius: 999px;
      margin-left : 5px;
   }

   .markerInfo {
      color : #3D3D3D;
      text-decoration: none;
   }

   a .markerInfo:hover {
      color : #959595;
      text-decoration: underline;
   }

   .markerClosest:hover {
      background : #A3A3A3;
   }
    </style>

    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <script src="https://www.google.com/jsapi"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&region=FR&libraries=geometry,weather"></script>
    <script src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerwithlabel/src/markerwithlabel.js"></script>
    <script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/markerclusterer_compiled.js"></script>

    <?php echo HTML::JS("maps/jquery.imagemapster.min"); ?>

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
        'event' : 'site',
        'content' : 'Lorem ipsum Amet quis ut sint culpa et ut laborum qui cupidatat ullamco elit cillum ut in anim.'
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
        'event' : 'event',
        'content' : 'Lorem ipsum Amet quis ut sint culpa et ut laborum qui cupidatat ullamco elit cillum ut in anim.',
        'titre' : 'titre de evenement'
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
        'event' : 'club',
        'content' : 'Lorem ipsum Amet quis ut sint culpa et ut laborum qui cupidatat ullamco elit cillum ut in anim.'
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
        'event' : 'club',
        'content' : 'Lorem ipsum Amet quis ut sint culpa et ut laborum qui cupidatat ullamco elit cillum ut in anim.'
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
        'event' : 'site',
        'content' : 'Lorem ipsum Amet quis ut sint culpa et ut laborum qui cupidatat ullamco elit cillum ut in anim.'
      }      
    }

    // console.log(maps);
    // var query = 'Rabat-Salé-Zemmour-Zaër, Maroc';

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
    var regionsSlug = [];
    regionsSlug = UniqueArray(ObjectValToArray(regions, 'slug', regionsSlug, true));

    // Load the Visualization API and the columnchart package.
    // setTimeout(function(){
    google.load('visualization', '1', {'callback':'console.log("")', 'packages':['columnchart']});
    // }, 1000);
    google.maps.visualRefresh = true;

    // Create our "tiny" marker icon
    var gYellowIcon = new google.maps.MarkerImage(
          "<?php echo HTML::getImg("maps/valid.png",false,true); ?>",
          new google.maps.Size(32, 32),
          new google.maps.Point(0, 0),
          new google.maps.Point(16, 16));
    var gRedIcon = new google.maps.MarkerImage(
          "<?php echo HTML::getImg("maps/invalid.png",false,true); ?>",
          new google.maps.Size(32, 32),
          new google.maps.Point(0, 0),
          new google.maps.Point(16, 16));

    //varibales for basic map display
    var map;
    var mapDiv = $("#map-canvas")[0];

    //marker arrays
    var markerFunctions = new Array();
    var markerArray = {}, simpleMarkersArray = [], svgMarkersArray = {};

    //marker icon paths && label positions
    var DefaultIconPath = "M8,0C4.687,0,2,2.687,2,6c0,3.854,4.321,8.663,5,9.398C7.281,15.703,7.516,16,8,16s0.719-0.297,1-0.602  C9.679,14.663,14,9.854,14,6C14,2.687,11.313,0,8,0z M8,10c-2.209,0-4-1.791-4-4s1.791-4,4-4s4,1.791,4,4S10.209,10,8,10z M8,4  C6.896,4,6,4.896,6,6s0.896,2,2,2s2-0.896,2-2S9.104,4,8,4z";
    var clubIconPath = "M70,1c3.237,1.234,6.598,2.221,9.691,3.747 c12.424,6.128,20.098,20.56,16.199,33.709C91.609,52.898,85.875,66.948,80.143,80.91c-4.322,10.528-9.637,20.648-15.121,32.242 c-5.323-11.144-10.406-20.816-14.626-30.854c-5.663-13.468-11.414-26.98-15.75-40.903C29.156,23.772,39.416,6.899,57.257,2.045 C58.196,1.79,59.087,1.353,60,1C63.333,1,66.666,1,70,1z M73.023,32.811c-0.079-4.33-3.705-7.824-8.071-7.778 c-4.433,0.048-7.885,3.486-7.936,7.908c-0.053,4.537,3.788,8.294,8.275,8.095C69.532,40.847,73.102,37.05,73.023,32.811z M9,129c2.668-21.131,5.337-42.262,7.997-63.322 c10.698-2.01,11.599-1.535,13.309,7.03c-1.958,0.153-3.892,0.306-6.177,0.484c-2.101,15.76-4.183,31.388-6.325,47.46 c31.459,0,62.624,0,94.346,0c-2.092-15.781-4.161-31.384-6.275-47.334c-2.138-0.229-4.195-0.451-6.264-0.674 c1.706-8.307,1.706-8.307,13.305-7.217C115.6,86.533,118.3,107.767,121,129C83.666,129,46.333,129,9,129z";
    var EventIconPath = "M64.819,126.726c-17.694-20.459-33.508-41.212-40.549-67.089 c-6.729-24.734,5.617-48.051,28.493-54.442c15.639-4.37,29.822-1.079,41.525,10.334c12.359,12.053,15.215,26.962,11.104,43.285 c-4.98,19.775-15.852,36.521-28.032,52.494C73.534,116.324,69.403,121.109,64.819,126.726z M64.848,81.088 c18.814,0.126,34.679-15.644,34.769-34.561c0.091-19.299-15.349-34.925-34.712-35.129c-18.892-0.2-34.856,15.458-34.99,34.318 C29.775,65.337,45.201,80.956,64.848,81.088z M90.25,37.544c-3.896,3.828-7.228,6.628-9.92,9.946 c-1.359,1.677-2.26,4.333-2.139,6.478c0.24,4.257,1.332,8.466,2.275,13.858c-3.661-1.877-6.576-2.966-9.021-4.713 c-4.616-3.299-8.864-3.534-13.554-0.114c-2.496,1.82-5.506,2.937-9.208,4.848c0.734-4.641,1.084-8.4,1.97-12.029 c0.97-3.976,0.267-6.987-3.05-9.648c-2.921-2.344-5.413-5.224-8.822-8.584c5.52-0.873,10.098-1.34,14.525-2.425 c1.757-0.431,3.708-1.912,4.649-3.473c2.371-3.929,4.217-8.175,6.525-12.799c1.697,3.372,3.493,6.062,4.449,9.022 c1.906,5.908,5.838,8.25,11.824,8.257C83.52,36.171,86.281,36.939,90.25,37.544z";
    var homeIconPath = "M15.45,7L14,5.551V2c0-0.55-0.45-1-1-1h-1c-0.55,0-1,0.45-1,1v0.553L9,0.555C8.727,0.297,8.477,0,8,0S7.273,0.297,7,0.555  L0.55,7C0.238,7.325,0,7.562,0,8c0,0.563,0.432,1,1,1h1v6c0,0.55,0.45,1,1,1h3v-5c0-0.55,0.45-1,1-1h2c0.55,0,1,0.45,1,1v5h3  c0.55,0,1-0.45,1-1V9h1c0.568,0,1-0.437,1-1C16,7.562,15.762,7.325,15.45,7z";
    var startIconPath = "M256,0C149.969,0,64,85.969,64,192s192,320,192,320s192-213.969,192-320S362.031,0,256,0z M256,320 c-70.688,0-128-57.313-128-128c0-70.688,57.312-128,128-128c70.688,0,128,57.312,128,128C384,262.688,326.688,320,256,320z M205.55,522.605c-16.813,2.873-31.878-3.188-47.086-8.623c-15.324-5.476-30.695-10.814-46.039-16.234 c-1.722-0.607-3.569-1.102-5.039-2.111c-1.239-0.854-2.616-2.305-2.786-3.637c-0.116-0.906,1.563-2.637,2.755-3.021 c13.709-4.436,27.27-9.738,41.324-12.521c6.785-1.346,14.798,1.314,21.786,3.598c20.359,6.651,40.496,13.985,60.689,21.141 c7.952,2.816,8.247,3.765,8.557,11.293c0.206,5.021-2.129,7.873-6.51,8.496c-9.178,1.303-18.441,1.988-27.67,2.93 C205.538,523.477,205.544,523.041,205.55,522.605z M307.437,523.652c-9.563-0.604-16.877-0.844-24.142-1.576 c-9.146-0.924-10.917-3.393-11.007-12.311c-0.053-5.054,3.182-6.559,6.873-7.869c12.371-4.394,24.77-8.709,37.16-13.043 c10.037-3.512,20.07-7.035,30.125-10.5c9.966-3.434,19.911-3.092,29.805,0.363c8.628,3.014,17.307,5.891,25.836,9.162 c2.072,0.795,3.643,2.902,5.443,4.407c-1.675,1.429-3.119,3.491-5.057,4.188c-23.29,8.367-46.483,17.074-70.088,24.465 C323.876,523.605,314.335,522.984,307.437,523.652z M203.479,539.376c10.039,0.576,17.685,0.878,25.305,1.487 c8.938,0.717,12.981,5.951,10.481,14.515c-0.694,2.379-4.077,4.699-6.729,5.664c-19.043,6.925-38.204,13.526-57.355,20.151 c-5.164,1.787-10.349,3.617-15.656,4.873c-9.033,2.139-17.774,0.545-26.367-2.721c-8.069-3.066-16.329-5.637-24.38-8.746 c-1.741-0.672-2.952-2.716-4.407-4.127c1.407-1.242,2.611-3.054,4.253-3.641c23.62-8.436,47.145-17.193,71.05-24.745 C187.868,539.499,197.05,540.033,203.479,539.376z M272.376,552.613c0.004-8.106,0.727-10.141,7.82-10.745 c14.029-1.194,28.348-2.748,42.199-1.152c12.803,1.476,25.252,6.571,37.676,10.628c13.736,4.485,27.271,9.594,40.886,14.457 c1.558,0.557,3.194,1.077,4.545,1.985c2.76,1.854,2.954,4.104-0.112,5.756c-2.614,1.407-5.44,2.494-8.274,3.411 c-9.939,3.216-19.752,7.253-29.952,9.092c-6.724,1.212-14.445,0.48-20.997-1.626c-22.603-7.269-44.892-15.513-67.291-23.407 C274.433,559.445,270.671,557.342,272.376,552.613z M300.074,267.814l-17.061-48.597h-54.027l-17.061,48.597h-29.21L242.429,94.62 h27.142l59.714,173.195H300.074 M256.388,142.701l-17.837,48.598h34.639L256.388,142.701";
    var destIconPath = "M256,0C149.969,0,64,85.969,64,192s192,320,192,320s192-213.969,192-320S362.031,0,256,0z M256,320 c-70.688,0-128-57.313-128-128c0-70.688,57.312-128,128-128c70.688,0,128,57.312,128,128C384,262.688,326.688,320,256,320z M205.55,522.605c-16.813,2.873-31.878-3.188-47.086-8.623c-15.324-5.476-30.695-10.814-46.039-16.234 c-1.722-0.607-3.569-1.102-5.039-2.111c-1.239-0.854-2.616-2.305-2.786-3.637c-0.116-0.906,1.563-2.637,2.755-3.021 c13.709-4.436,27.27-9.738,41.324-12.521c6.785-1.346,14.798,1.314,21.786,3.598c20.359,6.651,40.496,13.985,60.689,21.141 c7.952,2.816,8.247,3.765,8.557,11.293c0.206,5.021-2.129,7.873-6.51,8.496c-9.178,1.303-18.441,1.988-27.67,2.93 C205.538,523.477,205.544,523.041,205.55,522.605z M307.437,523.652c-9.563-0.604-16.877-0.844-24.142-1.576 c-9.146-0.924-10.917-3.393-11.007-12.311c-0.053-5.054,3.182-6.559,6.873-7.869c12.371-4.394,24.77-8.709,37.16-13.043 c10.037-3.512,20.07-7.035,30.125-10.5c9.966-3.434,19.911-3.092,29.805,0.363c8.628,3.014,17.307,5.891,25.836,9.162 c2.072,0.795,3.643,2.902,5.443,4.407c-1.675,1.429-3.119,3.491-5.057,4.188c-23.29,8.367-46.483,17.074-70.088,24.465 C323.876,523.605,314.335,522.984,307.437,523.652z M203.479,539.376c10.039,0.576,17.685,0.878,25.305,1.487 c8.938,0.717,12.981,5.951,10.481,14.515c-0.694,2.379-4.077,4.699-6.729,5.664c-19.043,6.925-38.204,13.526-57.355,20.151 c-5.164,1.787-10.349,3.617-15.656,4.873c-9.033,2.139-17.774,0.545-26.367-2.721c-8.069-3.066-16.329-5.637-24.38-8.746 c-1.741-0.672-2.952-2.716-4.407-4.127c1.407-1.242,2.611-3.054,4.253-3.641c23.62-8.436,47.145-17.193,71.05-24.745 C187.868,539.499,197.05,540.033,203.479,539.376z M272.376,552.613c0.004-8.106,0.727-10.141,7.82-10.745 c14.029-1.194,28.348-2.748,42.199-1.152c12.803,1.476,25.252,6.571,37.676,10.628c13.736,4.485,27.271,9.594,40.886,14.457 c1.558,0.557,3.194,1.077,4.545,1.985c2.76,1.854,2.954,4.104-0.112,5.756c-2.614,1.407-5.44,2.494-8.274,3.411 c-9.939,3.216-19.752,7.253-29.952,9.092c-6.724,1.212-14.445,0.48-20.997-1.626c-22.603-7.269-44.892-15.513-67.291-23.407 C274.433,559.445,270.671,557.342,272.376,552.613z M326.48,225.466c0,4.688-0.693,9.377-2.084,14.064 c-1.389,4.688-3.385,9.028-5.989,13.023c-2.432,3.993-5.383,7.553-8.855,10.678c-3.3,2.952-7.032,5.296-11.2,7.032 c-3.125,1.216-7.031,2.257-11.72,3.125c-4.515,0.695-8.769,1.043-12.763,1.043h-66.155V99.928h66.155 c6.945,0,13.37,1.129,19.273,3.386c5.904,2.258,11.026,5.383,15.367,9.376c4.34,3.82,7.727,8.422,10.158,13.804 c2.431,5.384,3.646,11.2,3.646,17.451c0,16.842-8.162,29.952-24.483,39.328c9.202,4.342,16.235,10.07,21.097,17.189 C323.963,207.582,326.48,215.915,326.48,225.466 M294.706,145.247c0-11.808-6.339-17.711-19.013-17.711h-40.371v42.714H268.4 c3.993,0,7.119-0.261,9.376-0.782c2.257-0.693,4.601-1.996,7.032-3.906C291.406,160.353,294.706,153.581,294.706,145.247 M298.352,225.986c0-5.729-1.563-11.024-4.688-15.888c-2.952-5.035-6.945-8.508-11.98-10.418c-1.91-0.694-3.561-1.041-4.949-1.041 c-1.389-0.174-3.56-0.261-6.512-0.261h-34.9v47.924h41.671C291.232,246.303,298.352,239.53,298.352,225.986";
    var addedIconPath = "M256,0C149.969,0,64,85.969,64,192s192,320,192,320s192-213.969,192-320S362.031,0,256,0z M256,320 c-70.688,0-128-57.313-128-128c0-70.688,57.312-128,128-128c70.688,0,128,57.312,128,128C384,262.688,326.688,320,256,320z M205.55,522.605c-16.813,2.873-31.878-3.188-47.086-8.623c-15.324-5.476-30.695-10.814-46.039-16.234 c-1.722-0.607-3.569-1.102-5.039-2.111c-1.239-0.854-2.616-2.305-2.786-3.637c-0.116-0.906,1.563-2.637,2.755-3.021 c13.709-4.436,27.27-9.738,41.324-12.521c6.785-1.346,14.798,1.314,21.786,3.598c20.359,6.651,40.496,13.985,60.689,21.141 c7.952,2.816,8.247,3.765,8.557,11.293c0.206,5.021-2.129,7.873-6.51,8.496c-9.178,1.303-18.441,1.988-27.67,2.93 C205.538,523.477,205.544,523.041,205.55,522.605z M307.437,523.652c-9.563-0.604-16.877-0.844-24.142-1.576 c-9.146-0.924-10.917-3.393-11.007-12.311c-0.053-5.054,3.182-6.559,6.873-7.869c12.371-4.394,24.77-8.709,37.16-13.043 c10.037-3.512,20.07-7.035,30.125-10.5c9.966-3.434,19.911-3.092,29.805,0.363c8.628,3.014,17.307,5.891,25.836,9.162 c2.072,0.795,3.643,2.902,5.443,4.407c-1.675,1.429-3.119,3.491-5.057,4.188c-23.29,8.367-46.483,17.074-70.088,24.465 C323.876,523.605,314.335,522.984,307.437,523.652z M203.479,539.376c10.039,0.576,17.685,0.878,25.305,1.487 c8.938,0.717,12.981,5.951,10.481,14.515c-0.694,2.379-4.077,4.699-6.729,5.664c-19.043,6.925-38.204,13.526-57.355,20.151 c-5.164,1.787-10.349,3.617-15.656,4.873c-9.033,2.139-17.774,0.545-26.367-2.721c-8.069-3.066-16.329-5.637-24.38-8.746 c-1.741-0.672-2.952-2.716-4.407-4.127c1.407-1.242,2.611-3.054,4.253-3.641c23.62-8.436,47.145-17.193,71.05-24.745 C187.868,539.499,197.05,540.033,203.479,539.376z M272.376,552.613c0.004-8.106,0.727-10.141,7.82-10.745 c14.029-1.194,28.348-2.748,42.199-1.152c12.803,1.476,25.252,6.571,37.676,10.628c13.736,4.485,27.271,9.594,40.886,14.457 c1.558,0.557,3.194,1.077,4.545,1.985c2.76,1.854,2.954,4.104-0.112,5.756c-2.614,1.407-5.44,2.494-8.274,3.411 c-9.939,3.216-19.752,7.253-29.952,9.092c-6.724,1.212-14.445,0.48-20.997-1.626c-22.603-7.269-44.892-15.513-67.291-23.407 C274.433,559.445,270.671,557.342,272.376,552.613z M327.747,149.564l-45.615,43.242l43.242,45.614 c1.401,1.478,1.34,3.827-0.138,5.228l-21.464,20.347c-1.482,1.406-3.827,1.338-5.229-0.141l-43.241-45.614l-45.613,43.241 c-1.48,1.402-3.826,1.338-5.227-0.139l-20.349-21.466c-1.401-1.478-1.341-3.824,0.14-5.228l45.613-43.24l-43.242-45.615 c-1.4-1.477-1.342-3.821,0.14-5.226l21.463-20.347c1.478-1.401,3.826-1.337,5.226,0.14l43.242,45.614l45.614-43.242 c1.478-1.401,3.825-1.338,5.226,0.14l20.35,21.465C329.287,145.816,329.225,148.163,327.747,149.564z";

    var DefaultLabelPos = new google.maps.Point(33, -33); //default (33, -33), club && event (31, -38)
    var clubLabelPos = new google.maps.Point(31, -38);
    var eventLabelPos = clubLabelPos;
    var defaultClosestLabelPos = new google.maps.Point(5, -33); //default (5, -33), club && event (0, -38)
    var clubClosestLabelPos = new google.maps.Point(0, -38);
    var eventClosestLabelPos = clubClosestLabelPos;

    var parapenteColor = "#e74c3c", parachuteColor = "#2980b9", aviationColor = "#f1c40f";
    var parapenteBorderColor = "#c0392b", parachuteBorderColor = "#34495e", aviationBorderColor = "#f39c12";


    //regions and areas and current and closest positions variables
    var curRegion, localRegion, curArea, curLocation, curInfoMarker = "";
    var cookieGeoloc = true, navigatorGeoloc = true, ipGeoloc = true, geoloc = true;
    var currentPosition,calculatedDistance, closestActiv = false;
    var nearestMarkers = {};

    // direction variables
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
    var directionActiv = false, launchDirection = false, AddDirectionMarkers = false, refreshSteps = false, $showSteps = $('#complex').is(':checked');
    var directionWaypointsAdress = [], directionWaypoints = [], directionWaypointsParams = {};
    var tempDirectionDiv;

    // elevation variables
    var elevator = new google.maps.ElevationService(); // Create an ElevationService
    var markerElevation, chart, polyline, showLine = false, showElevation = false;
    var elevationChart = $('#elevation_chart')[0];
    var $elevationPath = [], markerElevationArray = [];

    //Cookie variable
    var HomeExpiration = (Date.parse(new Date())/1000) + (365*24*3600);
    var HomeDomain = window.location.host;

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

      google.maps.event.addListener(map, 'click', getElevation);

      PromptCurrentPosition();

      //Changer le zoom ----------------------
      // map.setZoom(11);

      //Afficher des controles et changer leur position ----------------
      // var control = document.getElementById('control');
      // control.style.display = 'block';
      // map.controls[google.maps.ControlPosition.TOP_CENTER].push(control);


      //Afficher bouton "Home" -------------------
      // var homeControlDiv = document.createElement('div');
      // var homeControl = new HomeControl(homeControlDiv, map);
      // homeControlDiv.index = 1;
      // map.controls[google.maps.ControlPosition.TOP_RIGHT].push(homeControlDiv);
    }  

    google.maps.event.addDomListener(window, 'load', initialize);

    //fonction pour placer un bouton "home"
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
      controlText.innerHTML = '<b>Clucb</b>';
      controlUI.appendChild(controlText);

      // Setup the click event listeners: simply set the map to
      // Chicago
      google.maps.event.addDomListener(controlUI, 'click', function() {
        map.setCenter(chicago)
      });
    }

    // Takes an array of ElevationResult objects, draws the path on the map
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

    // Takes an array of ElevationResult objects, plots the elevation profile on a Visualization API ColumnChart.
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
      if(typeof $url != "undefined" && $url){
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
            $callback(results);
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
    function codeMarkerAddress($marker) {
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

    //trouver adresse compléte à partir de LatLng d'un marker(deuxiéme fonction)
    function geocodePosition($marker, $callback) {
      var pos = $marker.getPosition();
      geocoder.geocode({
        latLng: pos
      }, function(responses) {
        if (responses && responses.length > 0) {
          formattedAddress =  responses[0].formatted_address;
          if(exists($callback)){
            $callback(responses);
          }
        } else {
          alert('Cannot determine address at this location.');
        }
      });
    } 

    //Trouver adresse à partir de latlng donné
    function codeAdress($position, $callback){
      geocoder.geocode({
        latLng: $position
      }, function(responses) {
        if (responses && responses.length > 0) {
          formattedAddress =  responses[0].formatted_address;
          if(exists($callback)){
            $callback(responses);
          }
        } else {
          alert('Cannot determine address at this location.');
        }
      });
    } 

    //Activer direction() 
    function setDirectionMarkers($marker,$markerAdress, $markerColor, $markerType){
      
      var newIcon = {
                      path : DefaultIconPath,
                      fillColor: $markerColor,
                      fillOpacity: 1,
                      strokeColor: '#FFFFFF',
                      strokeWeight: 1,
                      scale: 0.08,
                    };
      var oldIcon = {
                      path : DefaultIconPath,
                      fillColor: '#000000',
                      fillOpacity: 1,
                      strokeColor: '#000000',
                      strokeWeight: 1,
                      scale: 0.30,
                    };

      markerArray[$marker.arrayKey].oldMarker = markerArray[$marker.arrayKey].markerSlug;
      if(!AddDirectionMarkers) {
        if(typeof $start.marker == "undefined") {
          $start.marker = $marker;
          $start.markerAdress = $markerAdress;
          $start.markerType = $markerType;
          $start.markerColor = $markerColor;
          newIcon.path = startIconPath;
          changeMarkerIcon($start.marker, newIcon);        
          $start.marker.infowindow.close();
        } else if (typeof $end.marker == "undefined" || $newEnd) {
          if($marker != $end.marker && $marker != $start.marker) {
            if($newEnd) {
              oldIcon.path = findMarkerPathType($end.markerType);
              oldIcon.fillColor = $end.markerColor;
              if($end.markerType == "site"){
                oldIcon.scale = 2;
              }
              changeMarkerIcon($end.marker, oldIcon);
            } 

            $end.marker = $marker;
            $end.markerAdress = $markerAdress;
            $end.markerType = $markerType;
            $end.markerColor = $markerColor;
            $newEnd = false;
            newIcon.path = destIconPath;
            changeMarkerIcon($end.marker, newIcon);        
            $end.marker.infowindow.close();
          }
        } else {
          if($start.marker != $marker) {            
            oldIcon.path = findMarkerPathType($start.markerType);
            oldIcon.fillColor = $start.markerColor;
            if($start.markerType == "site"){
              oldIcon.scale = 2;
            }
            changeMarkerIcon($start.marker, oldIcon);

            $start.marker = $marker;
            $start.markerAdress = $markerAdress;
            $start.markerType = $markerType;
            $start.markerColor = $markerColor;
            $newEnd = true;
            newIcon.path = startIconPath;
            changeMarkerIcon($start.marker, newIcon);        
            $start.marker.infowindow.close();
          }
        }
      }

      if(typeof $start.marker != "undefined"){
        $startAdress = $start.markerAdress;

        if(typeof $startAdress == "undefined"){
          geocodePosition($start.marker, function($formattedAddress) {
            $startAdress = $formattedAddress[0].formatted_address; 
            $('#start').html($startAdress);
          });
        }
        $('#start').html($startAdress);
      }

      if(typeof $end.marker != "undefined"){
        $endAdress = $end.markerAdress;

        if(typeof $endAdress == "undefined"){
          geocodePosition($end.marker, function($formattedAddress) {
            $endAdress = $formattedAddress[0].formatted_address; 
            $('#end').html($endAdress);
          });
        }
        $('#end').html($endAdress);
      }

      if(typeof $start.marker != "undefined" && typeof $end.marker != "undefined") { 
        $('button.addDirection').show();
        $(".direction").show();
      }

      if (typeof $startAdress != "undefined" && typeof $endAdress != "undefined" && AddDirectionMarkers) {
        var $addedMarker = $marker; 
        var $addedMarkerLatLng = $marker.getPosition();
        var $addedMarkerAdress = $markerAdress;
        var $addedMarkerColor = $markerColor;
        var $addedMarkerType = $markerType;
        $marker.infowindow.close();

        if($.inArray($addedMarkerLatLng, directionWaypoints) != -1){ 
          $markerArrayPos = $.inArray($addedMarkerLatLng, directionWaypoints) +1 ;
          $markerIconInfo = directionWaypointsParams[$markerArrayPos];   
          oldIcon.path = findMarkerPathType($markerIconInfo.markerType);
          oldIcon.fillColor = $markerIconInfo.markerColor;
          if($markerIconInfo.markerType == "site"){
            oldIcon.scale = 2;
          }
          changeMarkerIcon($marker, oldIcon);

          directionWaypoints = jQuery.grep(directionWaypoints, function(value) {
            return value != $addedMarkerLatLng;
          });
          directionWaypointsAdress.splice( $.inArray($addedMarkerAdress, directionWaypointsAdress), 1 );  
          delete directionWaypointsParams[$markerArrayPos];    
        } else {
          directionWaypoints.push($addedMarkerLatLng);
          directionWaypointsAdress.push($addedMarkerAdress);
          directionWaypointsParams[directionWaypoints.length] = {};
          directionWaypointsParams[directionWaypoints.length].markerColor = $markerColor;
          directionWaypointsParams[directionWaypoints.length].markerType = $markerType;
                  
          newIcon.path = addedIconPath;
          newIcon.fillColor = "#B1B1B1";
          changeMarkerIcon($marker, newIcon);
        }
        $('#added').html(directionWaypointsAdress.join(",<br>"));
      }

      if(typeof $startAdress != "undefined" && typeof $endAdress != "undefined" && launchDirection) {      

        calcRoute($startAdress,$endAdress,$travelMode);
        startend = true;
        $('.inverser').show();
        $("#travelMode").show();
        $('.stopDirection').show();
        $("#totalDistance").show();
        $(".complex").show();
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
        var formatedWaypoints = [];
        for(var waypoint in directionWaypoints) {
          var $formatedWaypoint = {
            location : directionWaypoints[waypoint],
            stopover : true
          };
          formatedWaypoints.push($formatedWaypoint);
        }

        // if(formatedWaypoints[countInObject(formatedWaypoints)] == 'function (index, item) {    this.splice(index, 0, item);  } '){
          formatedWaypoints.pop(); //fait pour éviter une erreur bizzare avec jQuery
        // }

        var request = {
          origin: $start,
          destination: $end,
          waypoints: formatedWaypoints,
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

    //if the start/destination or a waypoint has been changed, update directions
    google.maps.event.addListener(directionsDisplay, 'directions_changed', function() {
      if(refreshSteps) {
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
      // info window. Also push the marker in an array so we
      // can keep track of it and remove it when calculating new
      // routes.
      var myRoute = $directionResult.routes[0].legs;

      $elevationPath.push($start.marker.getPosition());
      for (var k = 0; k < myRoute.length; k++) {
        for (var i = 0; i < myRoute[k].steps.length; i++) {
          var marker = new google.maps.Marker({
            draggable :false,
            position: myRoute[k].steps[i].start_point,
            map: map
          });
          attachInstructionText(marker, myRoute[k].steps[i].instructions);
          stepsMarkerArray.push(marker);
          $elevationPath.push(marker.getPosition());
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

      findmarkers(curArea, true); //remplacer par boucle ou réaffiche tout les markers dans l'array markerArray
    }

    function removeSteps() { 
      for (var i = 0; i < stepsMarkerArray.length; i++) {
        stepsMarkerArray[i].setMap(null);
      }
      stepsMarkerArray = [];
    }

    //Calculer la distance entre deux points/markers
    function calcDistance($pointA,$pointB) {      
      calculatedDistance = google.maps.geometry.spherical.computeDistanceBetween($pointA, $pointB);
      return google.maps.geometry.spherical.computeDistanceBetween($pointA, $pointB);
    }

    //Boucle pour récupérer les élévations d'une liste de markers
    function getMarkersElevation($marker, $markerElevationArray) { 
      getElevation($marker,true, function($markerElevation){
          $markerElevationArray.push($markerElevation); 
      });
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
            var $elevationResult = '<hr> L\'élévation à ce point <br>est de : ' + results[0].elevation + ' métres.'
            markerElevation = $elevationResult;
            if(typeof $addInfo != "undefined" && $addInfo) {
              var $content = $marker.infowindow.content;
              $content = $content.replace("Calcul de l'élévation en cours...", "");
              $content = $content +markerElevation;
              $marker.infowindow.content = $content;
            }
            if(typeof $callback != "undefined") {
              $callback($elevationResult);
            }
            if(randomClick) {
              infowindow.setContent('L\'élévation à ce point <br>est de : ' + results[0].elevation + ' métres.');
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

    function changeBounds($addBound){    
      var bounds = new google.maps.LatLngBounds();

      if(typeof $addBound != "undefined" && geoloc) {
        if(typeof currentPosition == "undefined") {
          getCurrentPosition(function($curPos){
            bounds.extend($curPos.LatLng);
          })
        }
        else {
          bounds.extend(curLocation.LatLng);
        }
      }
      for (var markers in markerArray) {  
        bounds.extend(markerArray[markers].markerSlug.getPosition());
      }
      map.fitBounds(bounds);               
    }

    function PromptCurrentPosition($adress){
      if(exists(markerArray.home)){
        markerArray.home.markerSlug.setVisible(false);
      }

      if(exists($.cookie('home')) && cookieGeoloc){
        var homeCookie = JSON.parse($.trim($.cookie('home')));
        curLocation = homeCookie;
        curLocation['address'] = curLocation[0].formatted_address;      
        curLocation['LatLng'] = new google.maps.LatLng(parseFloat(curLocation[0].geometry.location.nb), parseFloat(curLocation[0].geometry.location.ob));
        localRegion = findRegion(curLocation);     
        curLocation['region'] = localRegion; 
        findmarkers(findRegion(curLocation), false);
        showCurrentAdress(curLocation);

        getCurrentPosition(function($location){
          if($location.region != curLocation.region){
            $('p.correctAddress').show();
            $('button.adressChange').hide();
          } else{
            $('p.correctAddress').hide();
            $('button.adressChange').show();
          }
        });
        return true;
      }

      if(navigatorGeoloc || ipGeoloc){
        getCurrentPosition(function($location){
          showCurrentAdress($location);
          $('div.correctAddress').show();
        });
      } else {
        if(exists($adress)){
          codeLatLng($adress, function($location){
            $location['address'] = $location[0].formatted_address;
            $location['LatLng'] = $location[0].geometry.location;
            $adress['region'] = findRegion($location);
            $('div#localAdress .curAddress').html($location.address);
            curLocation = $location;  
            $('div.correctAddress').show();     
          });
        } else {
          var currentPosition, curLocation, curRegion, localRegion, curArea;
          $('div.noGeoloc').show();
          $('div#localAdress').hide();
          geoloc = false;
        }
      }
      return currentPosition;
    }

    function showCurrentAdress($location){
      $('div#localAdress .curAddress').html($location.address);

      var $svgOptions = {
        arrayId : 'home',
        name : 'home',
        title : "Home",
        content : 'Position Actuel',
        position : $location.LatLng,        
        iconOptions : {
                        path : homeIconPath,
                        scale : 1.5
        }, 
        region : $location.region,
        animation : 'DROP',
        ZIndex : 0
      }
      createMarker(map, $svgOptions);
      map.setCenter($location.LatLng);
      currentAddress = { adress : $location.address, position : $location.LatLng};
      $('div#localAdress').show();
    }

    function saveCurrentAdress(){
      if(exists(curLocation)){ 
        var tempCurLocation = {};
        tempCurLocation[0] = curLocation[0];
        tempCurLocation['address'] = curLocation['address']
        tempCurLocation['LatLng'] = curLocation['LatLng']
        LocationCookie = JSON.stringify(tempCurLocation);
        $.cookie('home', LocationCookie, { expires : HomeExpiration, path: "/", domain: null });
        // $.cookie('home', cur, { expires : HomeExpiration, path: "/", domain: HomeDomain });
        $('p.correctAddress').hide();
        $('button.adressChange').show();
      }
    }

    function getCurrentPosition($callback){ 
      if(navigator.geolocation && navigatorGeoloc) {
        navigator.geolocation.getCurrentPosition(function(position) {
          initialLocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
          currentPosition =  initialLocation;          
          codeAdress(initialLocation, function($adress){
            // $('div#localAdress .curAddress').html($adress[0].formatted_address);
            currentAddress = { adress : $adress[0].formatted_address, position : initialLocation};
            $adress['browserLocation'] = position;
            $adress['LatLng'] = initialLocation;
            $adress['address'] = $adress[0].formatted_address;
            $adress['region'] = findRegion($adress);
            curLocation = $adress; 
            if(typeof $callback != "undefined") {
              $callback(curLocation);
            }
          });
        });
      } else if(!navigator.geolocation || !navigatorGeoloc) {   
        navigatorGeoloc = false;     
        jQuery.getJSON('http://freegeoip.net/json/', function(location) {
          initialLocation = new google.maps.LatLng(location.latitude,location.longitude);
          currentPosition =  initialLocation;          
          codeAdress(initialLocation, function($adress){
            currentAddress = { adress : $adress[0].formatted_address, position : initialLocation};
            $adress['ipLocation'] = location;
            $adress['LatLng'] = initialLocation;
            $adress['address'] = $adress[0].formatted_address;
            $adress['region'] = findRegion($adress);
            curLocation = $adress; 
            if(typeof $callback != "undefined") {
              $callback(curLocation);
            }
          });
        });
      } else if(!ipGeoloc && !navigatorGeoloc) {
        geoloc = false;
        return geoloc;
      }
    }

    function setCurPosMarker($callback) {
      getCurrentPosition(function(results) {
        draggableMarker(currentPosition, false, "Position Actuel");
        if(typeof $callback != "undefined") {
          $callback();  
        }
      });
    }

    function getClosestMarkers($callback){
      for (var markers in markerArray) {
        var $pointA = markerArray.home.markerSlug.getPosition(); //markerArray.home.markerSlug.getPosition()
        var $pointB = markerArray[markers].markerSlug.getPosition();

        var $markerDistance = calcDistance($pointA,$pointB);
        var $markerId = markerArray[markers].markerId;
        var $markerRegion = markerArray[markers].markerRegion;
        $markerId = $markerId.replace($markerRegion+'-', '');

        if($markerId != 'home'){
          var $markerSlug = markerArray[markers].markerSlug;
          var $markerClub = maps[$markerId].club;

          nearestMarkersLen = countInObject(nearestMarkers);
          var nearestMarkersTemp = {};
          nearestMarkersTemp.distance = $markerDistance;
          nearestMarkersTemp.arrayKey = [$markerId, markers]; //$markerId is the key for maps object, markers is the key for markerArray
          nearestMarkers[nearestMarkersLen] =  nearestMarkersTemp;
        }

      } 
      nearestMarkers = sortObject(nearestMarkers, "distance");
      if(typeof $callback != "undefined") {
        $callback();
      }
    }

    function setClosestMarkers(){
      getClosestMarkers(function(){
        var clubArray = {};
        var closestMarkersArray = [];
        for(var nearMarker in nearestMarkers){
          // console.log(nearMarker);
          // console.log(nearestMarkers[nearMarker]);

          var nearMarkerInfo = nearestMarkers[nearMarker];
          var $markerInfo = maps[nearMarkerInfo.arrayKey[0]];
          var $markerArrayValue = markerArray[nearMarkerInfo.arrayKey[1]];
          $markerArrayValue.markerSlug.setVisible(false);

          var $markerDistance = nearMarkerInfo.distance;
          if($markerDistance > 1000){
            $markerDistance = ($markerDistance /1000).toFixed(2)+"Km";
          } else{
            $markerDistance = $markerDistance.toFixed(2)+"m";
          }

          if($markerInfo.event != 'event'){
            $markerInfo.titre = $markerInfo.club;
          }
          markerPosition = parseInt(nearMarker) +1 ; 

          var SvgMarkerOptions1 = {
                                  saveMarker : false,
                                  closest : true,
                                  preContent : false,
                                  name : $markerArrayValue.markerRegion+'-'+nearMarker,
                                  title :  $markerArrayValue.markerSlug.title,
                                  content : $markerArrayValue.markerSlug.infowindow.content,
                                  type : $markerInfo.type,
                                  eventType : $markerInfo.event,
                                  position : $markerArrayValue.markerSlug.getPosition(),
                                  region : $markerArrayValue.markerRegion,
                                  infokey : nearMarkerInfo.arrayKey[0],
                                  listenerOptions : {
                                    arrayKey : nearMarkerInfo.arrayKey[1]
                                  },
                                  labelOptions : {
                                        labelContent : '<a href = "#" class = "markerPos" style = "font-size: 18px;">'+markerPosition+'</a>',
                                        labelStyle: {
                                                // opacity: 0.85, 
                                                width : '40px', 
                                                height : '28px', 
                                                'font-size' : '18px', 
                                                'font-family' : 'Lato', 
                                                color : "#3D3D3D", 
                                                background : '#BBBBBB', 
                                                border : 'none',
                                                padding : '2px',
                                                'overflow-x' : 'scroll'
                                              }
                                  }
                                }
          $svgMarkerPos = createMarker(map, SvgMarkerOptions1); //marker contenant la position du marker (du plus proche au moins proche)
          $markerArrayValue.svgMarkerPos = $svgMarkerPos;

          $labelContent = $markerInfo.club.substr(0, 17);
          var SvgMarkerOptions2 = {
                                  saveMarker : false,
                                  preContent : false,
                                  name : $markerArrayValue.markerRegion+'-'+nearMarker,
                                  title :  $markerArrayValue.markerSlug.title,
                                  content : $markerArrayValue.markerSlug.infowindow.content,
                                  type : $markerInfo.type,
                                  eventType : $markerInfo.event,
                                  position : $markerArrayValue.markerSlug.getPosition(),
                                  region : $markerArrayValue.markerRegion,
                                  infokey : nearMarkerInfo.arrayKey[0],
                                  listenerOptions : {
                                    arrayKey : nearMarkerInfo.arrayKey[1]
                                  },
                                  labelOptions : {
                                        labelContent : $markerDistance+'<br><a href = "#closest'+markerPosition+'" class = "markerInfo" style = "font-size: 15px;">'+$markerInfo.club+'</a>',
                                  }
                                }
          $svgMarkerInfo = createMarker(map, SvgMarkerOptions2); //marker contenant les informations (distance, club)
          $markerArrayValue.svgMarkerInfo = $svgMarkerInfo;
          $svgMarkerInfo.setVisible(false);

          // closestMarkersArray.push($svgMarkerInfo);
          closestMarkersArray.push($svgMarkerPos);

          var clubName = $markerInfo.club;
          if(typeof clubArray[clubName] == "undefined") {
            clubArray[clubName] = {};           
          }    
          var curClub = clubArray[clubName];    
          if(typeof curClub.clubMarkers == "undefined") {
            curClub.clubMarkers = {};
          }
          var curMarker = $markerArrayValue.markerSlug;
          var clubMarkersLen = countInObject(curClub.clubMarkers);
          curClub.clubMarkers[clubMarkersLen] = {};
          curClub.clubMarkers[clubMarkersLen] = curMarker;

          var closestDistance = nearMarkerInfo.distance;

          var $insideContent = $markerArrayValue.markerSlug.infowindow.content;
          var elevPos = $insideContent.indexOf("<hr> L'élévation à ce point");
          $insideContent = $insideContent.substr(0, elevPos);
          if(exists($markerInfo.mapInfo.adresse)){
            $insideContent = $insideContent + '<em><strong>Adresse : </strong></em>' + $markerInfo.mapInfo.adresse;
          }
          $insideContent = $insideContent + "<br>(<em><strong>Coordonnées - </strong> Latitude : "+$markerInfo.mapInfo.latlng.lat.toFixed(2)+" , longitude : "+$markerInfo.mapInfo.latlng.lng.toFixed(2) + "</em>)";

          var $listLink = '<a href = "#closest'+markerPosition+'">'+markerPosition+'</a>';
          $('ul.closestList').append('<li>'+$listLink+'</li>');

          var $content = "<div id = \"closest"+markerPosition+"\" class = \"markerClosest\"> Proximité : "+markerPosition+" - Distance jusqu'à la destination : "+(closestDistance /1000).toFixed(2)+"Km ("+closestDistance.toFixed(2)+"m).<br>"+$insideContent+"<hr/></div>";
          if($('.'+clubName).length == 0){
            $content = '<div class = "'+clubName+'"><h1>'+clubName+' :</h2>'+$content+'</div><hr/><br>';
            $(".closetMarker").append($content);
          } else {
            $('.'+clubName).append($content);
          }
        }

        var markerClusterer = new MarkerClusterer(map, closestMarkersArray, {
          maxZoom: 10,
          gridSize: 80
        });

      });
    }

    function EraseClosestMarkers(){
      for(var nearMarker in nearestMarkers){

        var nearMarkerInfo = nearestMarkers[nearMarker];
        var $markerInfo = maps[nearMarkerInfo.arrayKey[0]];
        var $markerArrayValue = markerArray[nearMarkerInfo.arrayKey[1]];

        $markerArrayValue.svgMarkerPos.setVisible(false);
        $markerArrayValue.svgMarkerInfo.setVisible(false);

        closestActiv = false;

        $markerArrayValue.markerSlug.setVisible(true);
      }
    }

    //trouver la region d'un marker, adresse, latlng
    function findRegion($haystack, $needle, $callback){
      for($zone in $haystack[0].address_components){
        for($info in $haystack[0].address_components[$zone]){
          $region = $haystack[0].address_components[$zone][$info];
          if(!$.isArray($region)){
            $region = stringToSlug($region);
            if($.inArray($region, regionsSlug) != -1){
              return $region;
            }
          }
        }
      }
    }

    function findMarkerColor($type){
        if($type == "parapente"){
          return parapenteColor;
        } else if($type == "parachute"){
          return parachuteColor;
        } else if($type == "aviation"){
          return aviationColor;
        }
    }

    function findMarkerLabelPos($type, $closest){
      if(exists($closest) && $closest) {
        if($type ==  "club" || $type == "event"){
          return clubClosestLabelPos;
        } else{
          return defaultClosestLabelPos;
        }
      }

      if($type ==  "club" || $type == "event"){
        return clubLabelPos;
      } else {
        return DefaultLabelPos
      }
    }

    function findMarkerPathType($type){
      if($type == "club"){
        return clubIconPath;
      } else if($type == "event"){
        return EventIconPath;
      } else {
        return DefaultIconPath;
      }
    }

    //Fonction pour les marker
    ///------------------------------------------------------------------------------------------------------//

    //Trouver les markers pour une région en particulier
    function findmarkers($region, $erased, $changeBounds) {
      var mapInfo;
      var markerRegion;
      var foundMarkers = false;
      $region = stringToSlug($region);
      if(curRegion != $region || $erased){
        for(markers in maps) { 
          mapInfo = maps[markers].mapInfo;
          markerRegion = mapInfo.region;
          // markerRegion = markerRegion.removeAccents();
          markerRegion = stringToSlug(markerRegion);
          if(markerRegion == $region){ 
            var coordinates = mapInfo.latlng;
            var MarkerlatlngRegion = new google.maps.LatLng(coordinates.lat,coordinates.lng);
            if(exists(maps[markers].titre)){
              var markerTitle = "<h4><trong>"+maps[markers].titre +" </strong></h4><em>" + maps[markers].auteur+" - "+maps[markers].club +"</em><br>";
            } else{
              var markerTitle = "<em>" + maps[markers].auteur+" - "+maps[markers].club +"</em><br>";
            }
            var markerContent = markerTitle+ maps[markers].content;
            var markerInfoKey = markers;
            var markerOptions = {
                                  infoKey : markerInfoKey,
                                  name : $region+'-'+markers,
                                  title : markerTitle,
                                  content : markerContent,
                                  type : maps[markers].type,
                                  region : $region,
                                  eventType : maps[markers].event,
                                  position : MarkerlatlngRegion
                                }
            createMarker(map, markerOptions); 
            foundMarkers = true;
          }
        }

        var markerClusterer = new MarkerClusterer(map, simpleMarkersArray, {
          maxZoom: 12,
          gridSize: 80
        });
        // setCurPosMarker();

        if(!foundMarkers) {
          codeLatLng($region, function ($latlngResult) {
            map.setCenter($latlngResult[0].geometry.location);
          }); 
        } else {
          for (var markers in markerArray) {
            getMarkersElevation(markerArray[markers].markerSlug,markerElevationArray);
          }
          if(exists($changeBounds) && !$changeBounds){

          } else{
            changeBounds(true);
          }
          foundMarkers = false;
        }

        curRegion = $region;
      }
    }

    //Créer marker avec eventListener unique
    // function createMarker($map, $region, $options, $infoKey) {
    function createMarker($map, $options) {

      if(exists($options) && exists($options.infoKey)){
        $markerInfo = maps[$options.infoKey];
      }

      $optionsDefault = {
        infoKey : 'none',
        name : 'none',
        title : 'Marker',
        content : '',
        type : 'none',
        eventType : 'none',
        position : currentPosition,
        region : 'none', 
        ZIndex : 100,
        preContent : true,
        markerFunctions : [
                            ['click', ["infowindow", "directions","elevation"]],
                            ['dblclick', ['remove']],
                            ['mouseover', ['fadeIn']],
                            ['mouseout', ['fadeOut']]
                          ],        
        iconOptions : {
              path : DefaultIconPath,
              fillColor: '#000000',
              fillOpacity: 1,
              strokeColor: '#000000',
              strokeWeight: 1,
              scale: 2,
              // origin: new google.maps.Point(-300,-1000),
              // anchor: new google.maps.Point(-30, -40)
        }, 
        animation : 'BOUNCE',
        saveMarker : true,
        createListener : true,
        closest : false
      }

      if(exists($options)){
        if(exists($options.iconOptions)){
          $options.iconOptions = $.extend($optionsDefault.iconOptions, $options.iconOptions);
        }
        if(exists($options.labelOptions)){
          $labelContent = $markerInfo.club.substr(0, 17);
          $labelOptionsDefault = {
                                labelContent : '<a href = "#">'+$labelContent+'</a>',
                                labelAnchor: DefaultLabelPos, //default (33, -33), club && event (31, -38)
                                labelClass: "labels", // the CSS class for the label
                                labelStyle: {
                                        // opacity: 0.85, 
                                        width : '100px', 
                                        height : '40px', 
                                        'font-size' : '1em', 
                                        'font-family' : 'Lato', 
                                        color : "#3D3D3D", 
                                        background : '#BBBBBB', 
                                        border : '1px solid #black',
                                        padding : '5px',
                                        'overflow-x' : 'scroll'
                                      }
                                  }
          if(exists($options.eventType)){
            $labelOptionsDefault.labelAnchor = findMarkerLabelPos($options.eventType, $options.closest);
          }
          $options.labelOptions = $.extend($labelOptionsDefault, $options.labelOptions);
        }
        $options =  $.extend($optionsDefault, $options);
      } else {
        $options = $optionsDefault;
      }

      if(exists($options.type)){
        $options.iconOptions.fillColor = findMarkerColor($options.type);
        $markerColor = $options.iconOptions.fillColor;
      }

      if(exists($options.type) && exists($options.labelOptions)){
        $type = $options.type;
        $options.labelOptions.labelStyle.color = "#BBBBBB";
        if($type == "parapente"){
          $options.labelOptions.labelStyle.background = parapenteColor;
          $labelOptionsDefault.labelStyle.border = "1px solid "+parapenteBorderColor;
        } else if($type == "parachute"){
          $options.labelOptions.labelStyle.background = parachuteColor;
          $labelOptionsDefault.labelStyle.border = "1px solid "+parachuteBorderColor;
        } else if($type == "aviation"){
          $options.labelOptions.labelStyle.background = aviationColor;
          $options.labelOptions.labelStyle.color = "#3D3D3D";
          $labelOptionsDefault.labelStyle.border = "1px solid "+aviationBorderColor;
        }
      }

      if(exists($options.eventType)){
        $type = $options.eventType;
        if($type ==  "club" || $type == "event"){
          $options.iconOptions.scale = 0.30;
          $options.iconOptions.path = findMarkerPathType($type);
          // var $markerType = $options.iconOptions.path;
        }
      }

      //Création marker
      var $markerOptions = {
          map: $map,
          title: $($options.title).text(),
          position: $options.position,
          animation: google.maps.Animation[$options.animation],
          ZIndex : $options.ZIndex
      }; 
      if(exists($options.iconOptions)){ //adding iconOptions
        $markerOptions.icon = $options.iconOptions
      }

      if(exists($options.labelOptions)){ //adding labelOptions
        $markerOptions = $.extend($markerOptions, $options.labelOptions);
        var $marker = new MarkerWithLabel($markerOptions);
      } else {
        var $marker = new google.maps.Marker($markerOptions);
      }

      //création infoWindow du marker
      if(exists($options.preContent) && $options.preContent){
        $content = $options.content + "<br> Calcul de l'élévation en cours...";
      } else {
        $content = $options.content;
      }
      $marker.infowindow = new google.maps.InfoWindow({
        content: $content,
        maxWidth: 200
      });
      setTimeout(function(){ $marker.setAnimation(null); }, 3000); //stop Bounce animation
      $marker.infoKey = $options.infoKey;

      //ajout marker dans tableau à unidimensionnel
      simpleMarkersArray.push($marker);

      //Ajouter marker et options marker dans tableau multidimensionnel
      var markerArrayTemp = {};
      if(typeof $markerFunctions != "undefined" && $markerFunctions.length !== 0) {
        markerFunctions = $markerFunctions; 
      } else {
        markerFunctions = new Array(); 
      }

      if(exists($options.saveMarker) && $options.saveMarker){
        markerArrayLen = countInObject(markerArray);
        markerArrayTemp.markerSlug = $marker; 
        markerArrayTemp.state = "show"; 
        markerArrayTemp.markerId = $options.name; 
        markerArrayTemp.markerRegion = $options.region; 
        markerArrayTemp.markerType = $options.type; 
        markerArrayTemp.markerEvent = $options.eventType; 
        if(exists($options.arrayId)){
          markerArray[$options.arrayId] = markerArrayTemp;
          $marker.arrayKey = $options.arrayId;
        } else {
          markerArray[markerArrayLen] = markerArrayTemp;
          $marker.arrayKey = markerArrayLen;
        }
      }
      
      //Ajout des listener pour le marker      
      if(exists($options.createListener) && $options.createListener){
        for(functionsKey in $options.markerFunctions){
          var markerEvent = $options.markerFunctions[functionsKey][0];
          var markerFunctionArray = $options.markerFunctions[functionsKey][1]
          listenerOptions = {
            infoWindow : $marker.infowindow,
            infoKey : $options.infoKey,
            arrayKey : markerArrayLen,
            name : $options.name,
            iconOptions : $options.iconOptions,
            markerState : 'hide',
            markerColor : $markerColor,
            markerType : $options.eventType,
            // markerType : $markerType,
            callback : $options.callback
          };
          $options.listenerOptions = $.extend(listenerOptions, $options.listenerOptions)
          createListener($marker,map,markerEvent,markerFunctionArray,$options.listenerOptions);
        }
      }

      return $marker;  
    }

    //créer un eventListner pour un marker en particulier
    function createListener($marker,$map,$event,$functions,$options) { 
      google.maps.event.addListener($marker, $event, function() {    
        for (var i = 0; i < $functions.length; i++) {
          switch ($functions[i]) {
            case 'remove':
              removeMarker($marker,$options.markerState);
            break;
            case 'infowindow':
              if(exists(curInfoMarker)){
                curInfoMarker.infowindow.close();
              }
              $marker.infowindow.open($map,$marker);
              curInfoMarker = $marker;
            break;
            case 'directions':
              if(directionActiv){
                // var $mapsId = $options.name.replace(curRegion+'-', '', $options.name);
                var $mapsId = $options.infoKey;
                if(exists(maps[$mapsId])){
                  $markerAdress = maps[$mapsId].mapInfo.adresse;
                  setDirectionMarkers($marker,$markerAdress, $options.markerColor, $options.markerType);
                }
                if($mapsId == "home"){
                  $markerAdress = curLocation.address;
                  setDirectionMarkers($marker,$markerAdress, "#000000", 'none');
                }
              }
            break;
            case 'elevation':
              getElevation($marker);
            break;
            case 'fadeIn':
              if(!directionActiv){
                $options.iconOptions.fillOpacity = 0.5;
                if(closestActiv && $options.name != "home"){
                  $marker.setVisible(false);
                  markerArray[$options.arrayKey].svgMarkerPos.setVisible(false);
                  markerArray[$options.arrayKey].svgMarkerInfo.setVisible(true);
                  markerArray[$options.arrayKey].svgMarkerInfo.setIcon($options.iconOptions);
                }
                $marker.setIcon($options.iconOptions);
              }
            break;
            case 'fadeOut':
              if(!directionActiv){
                $options.iconOptions.fillOpacity = 1;
                if(closestActiv && $options.name != "home"){
                  $marker.setVisible(false);
                  markerArray[$options.arrayKey].svgMarkerPos.setVisible(true);
                  markerArray[$options.arrayKey].svgMarkerPos.setIcon($options.iconOptions);
                  markerArray[$options.arrayKey].svgMarkerInfo.setVisible(false);
                }
                $marker.setIcon($options.iconOptions);
              }
            break;
         
            default:
              $marker.infowindow.open($map,$marker);
          }
        };              
      }); 
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

    // Crée un marker SVG, sans autre option
    function createSVGMarker($map, $options){
      $optionsDefault = {
        name : 'none',
        path : "M8,0C4.687,0,2,2.687,2,6c0,3.854,4.321,8.663,5,9.398C7.281,15.703,7.516,16,8,16s0.719-0.297,1-0.602  C9.679,14.663,14,9.854,14,6C14,2.687,11.313,0,8,0z M8,10c-2.209,0-4-1.791-4-4s1.791-4,4-4s4,1.791,4,4S10.209,10,8,10z M8,4  C6.896,4,6,4.896,6,6s0.896,2,2,2s2-0.896,2-2S9.104,4,8,4z",
        title : 'Marker',
        Info : '',
        position : currentPosition,
        iconOptions : {
              fillColor: '#FF0000',
              fillOpacity: 1,
              strokeColor: '',
              strokeWeight: 0,
              scale: 1.5
          }
      }

      $options =  $.extend($optionsDefault, $options);
      $options.iconOptions['path'] = $options.path;

      var $marker = new google.maps.Marker({
          map: $map,
          title: $options.title,
          position: $options.position,
          animation: google.maps.Animation.DROP,
          icon: $options.iconOptions
      });

      $marker.infowindow = new google.maps.InfoWindow({
        content: $options.info,
        maxWidth: 200
      });

      svgMarkersArray[$options.name] = $marker;

      markerFunctions = ["infowindow", "elevation"];
      createListener($marker,map,"click",markerFunctions);
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
      if(!directionActiv){
        directionActiv = true;
        $('button.closest').hide();
        $(this).text("Lancer");
        $("div#directions-panel").show();
        $(this).hide();
      } else {
        launchDirection = true;
        setDirectionMarkers($start.marker, $startAdress);
        $(this).hide();
      }
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
      closestActiv = true;
      if(typeof currentPosition != "undefined") {
        setClosestMarkers(); 
      } else {
        setCurPosMarker(setClosestMarkers);
      }
      $(this).hide();
      $('button.closestBack').show();
      $('button.direction').hide();

      $('div#directions-panel').hide();
      $('div.closetMarker').show();
    });

    $('button.adressTrue').click(function(){
      if(!navigatorGeoloc && !ipGeoloc){
        showCurrentAdress(curLocation);
        saveCurrentAdress(); 
        $('.manualAdress').hide();
      } else{
        saveCurrentAdress(); 
      }
    });

    $('button.adressChange').click(function(){
      $.cookie('filters', "", {path: "/", domain: null });
      // $.cookie('filters', "", {path: "/", domain: HomeDomain });
      $(this).hide();
      $('p.correctAddress').show();
    });

    $('button.adressFalse').click(function(){
      if(exists($.cookie('home'))){
        $.cookie('home', "", {path: "/", domain: null });
      }

      if(cookieGeoloc){
        cookieGeoloc = false;
        PromptCurrentPosition();
      } else if(navigatorGeoloc){
        navigatorGeoloc = false;
        PromptCurrentPosition();
      } else if(ipGeoloc && !navigatorGeoloc){
        ipGeoloc = false;
        $('p.manualAdress').show();
      } else if(!ipGeoloc && !navigatorGeoloc){
        geoloc = false;
        PromptCurrentPosition();
      }
    })

    $('.adressInput').keyup(function(){
      PromptCurrentPosition($(this).val());
    });

    $('button.closestBack').click(function(){
      EraseClosestMarkers();
      $('button.closest').show();
      $('button.direction').show();
      $('div#directions-panel').show();
      $('div.closetMarker').hide();
    });

    ///------------------------------------------------------------------------------------------------------//

    // $('#make-small').bind('click',function() {
    //     console.log('CLICK');
    //     $('#mapImg').mapster('resize', 200, 0, 1000);
    // });
    // $('#make-big').bind('click',function() {
    //     $('#mapImg').mapster('resize', 720, 0, 1000);
    // });
    // $('#make-any').bind('click',function() {
    //     $('#mapImg').mapster('resize', $('#new-size').val(), 0, 1000);
    // });

  });
  </script>

<!-- <div style="margin: auto;">
    <input id="make-small" type="button" value="Make it small">
    <input id="make-big" type="button" value="Make it big"> 
    <input id="make-any" type="button" value="Make it this width">
    <input style="width:80px;" type="text" id="new-size" value="1500">


    <div style="clear:both; height:8px;"></div>
</div> -->
<div class="row"> 

  <div class="col-md-5">
    <div class="mapFrance">
      <?php echo HTML::getImg("maps/void.png",false,false,' alt="map" border="0" id = "mapImg" usemap="#Map" width = "200px"'); ?>
      <map name="Map">
        <area shape="poly" coords="159,145,169,138,169,153,161,160,159,146" href="#">
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

    <div id="directions-panel" style = "display : none;">
      <div id="start"></div>
      <div id="end"></div>
      <div id="added"></div>
      <div id="totalDistance" style = "display : none;">Total à parcourir : <span class="distance"></span>km.</div>
    </div>

    <div class="closetMarker" style = "display : none;"><ul class = "closestList"></ul></div>

    <p>Lorem ipsum Ut minim laborum Ut amet non pariatur qui in aliqua elit est voluptate in sed sed tempor velit sint cupidatat fugiat in dolore aliqua aliquip amet mollit Excepteur magna fugiat magna irure aliqua nostrud ea aliqua magna incididunt est cillum voluptate.</p>
  </div> <!-- end of col5 -->

  <div class="col-md-7">
    <div id="localAdress" style = "display : none;">
        <p class = "manualAdress" style = "display : none;">
          Veuillez entré votre adresse, ou une autre adresse proche de celle-ci.
          <input type="text" class ="adressInput">
        </p>
        Votre adresse est : 
        <div class="curAddress"></div>
        <p class="correctAddress"> Cette Adresse est elle correcte ?
          <button class = "adressTrue">Oui</button>
          <button class = "adressFalse">Non, Réessayer.</button>
          <br>
          Il n'est pas nécessaire que l'adresse trouvé soit correcte à 100%, il suffit que ce soit proche de votre vrai adresse pour que les services proposé fonctionne au mieux.
        </p>
        <button class = "adressChange" style = "display : none;">Changer</button>
    </div>
    <div class="noGeoloc" style = "display : none;">
      <p>Votre navigateur ne supporte pas la géolocalisation, certaines fonctions du site seront désactivé.</p>
    </div>
    <button class="weather" >Météo</button>

    <!-- Buttons for closest markers -->
    <button class="closest" >Le plus proche</button>
    <button class="closestBack" style = "display : none;">Retour</button>

    <!-- Buttons for directions -->
    <button class="stopDirection" style = "display : none;">Back</button>
    <button class="direction" >Direction</button>
    <button class="addDirection" style = "display : none;">Ajouter</button>
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
    <br>
    <br>
    <br>
    <div id="elevation_chart"></div>
  
    <div id="map-canvas"></div><!-- google map -->
  </div><!-- end of col7 -->

</div><!-- end of row -->