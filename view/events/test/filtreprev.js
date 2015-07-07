//Gestion des filtres des evenements
	  var filtreButtons = $('.filtre');
	  var calendarLi = $(".userEvents li");
	  var calendarLiClass, filtresCookie; 

	  //Gestion des cookies pour les filtres
	  var filtreArray = $.cookie('filtres');
	  if(typeof filtreArray == "undefined") {
	    filtreArray = ['parapente','parachute','aviation'];
	    filtrerEvents();
	    filtresCookie = JSON.stringify(filtreArray);
	    var filtreExpiration = (Date.parse(new Date())/1000) + (365*24*3600);
	    var filtreDomain = window.location.host;
	    $.cookie('filtres', filtresCookie, { expires : filtreExpiration, path: "/", domain: null });
	    // $.cookie('filtres', filtresCookie, { expires : filtreExpiration, path: "/", domain: filtreDomain });
	  } else {
	    filtreArray = JSON.parse($.cookie('filtres'));
	    filtrerEvents();
	  }

	  //Fonctions de filtrage
	  function filtreCheck() {       

	    $.each( calendarLi, function( LiKey, LiValue ) {
	      calendarLiClass = $(LiValue).attr("class");
	      calendarLiClass = calendarLiClass.split(" ");

	      if(jQuery.inArray( calendarLiClass[1], filtreArray ) == -1) {
	        $(LiValue).hide();
	      } else {                  
	        $(LiValue).show();
	      }                 
	    });  
	  }

	  function filtrerEvents() {            

	      $.each( filtreButtons, function( filtreKey, filtreValue ) {
	        var classArray = $(filtreValue).attr("class").split(" ");
	        var Curfiltre = classArray[1];

	        if(jQuery.inArray( Curfiltre, filtreArray ) != -1) {
	          if(jQuery.inArray( "checked", classArray ) == -1) {                  
	            $(filtreValue).addClass("checked");  
	          } 
	        }else {
	          if(jQuery.inArray( "checked", classArray ) != -1) {    
	            $(this).removeClass("checked");
	          } 
	        }             
	      });

	      filtreCheck();
	  }

	  $(".filtre").click(function() {
	      var filtre = $(this).attr('class');
	      var classArray = filtre.split(" ");
	      filtre = classArray[1];

	      if(jQuery.inArray( "checked", classArray ) != -1) {
	        $(this).removeClass("checked");
	        filtreArray = jQuery.grep(filtreArray, function(value) {
	          return value != filtre;
	        });

	        filtresCookie = JSON.stringify(filtreArray);
	        var filtreExpiration = (Date.parse(new Date())/1000) + (365*24*3600);
	        var filtreDomain = window.location.host;
	        $.cookie('filtres', filtresCookie, { expires : filtreExpiration, path: "/", domain: null });
	        // $.cookie('filtres', filtresCookie, { expires : filtreExpiration, path: "/", domain: filtreDomain });
	      } else {
	        $(this).addClass("checked");  
	        filtreArray.push(filtre);

	        filtresCookie = JSON.stringify(filtreArray);
	        var filtreExpiration = (Date.parse(new Date())/1000) + (365*24*3600);
	        var filtreDomain = window.location.host;
	        $.cookie('filtres', filtresCookie, { expires : filtreExpiration, path: "/", domain: null });
	        // $.cookie('filtres', filtresCookie, { expires : filtreExpiration, path: "/", domain: filtreDomain });
	      }

	      filtreCheck();

	      $(eventsDiv).hide();
	      if(curEventTd != "undefined" && curEventTd != "") {
	        eraseNewFiltered = true;
	      }
	  });


    // if(settings.filterInput == "filterInput") {
    //   var divInputs = '<div class = "filterInputs">';
    //   var tempFilterInputs = [], filterInputs = $(document).find('filterInput');   
    //   filterInputs.each(function(inputKey, InputValue){
    //     tempFilterInputs.push($(InputValue).text());
    //     filterDivInputs.push($(InputValue));
    //     divInputs += '<button class = "filterButton '+ $(InputValue).text() +'">'+ $(InputValue).text() +'</button>';
    //   });           
    //   divInputs += '</div>';
    //   filterInputs = tempFilterInputs;
    //   divInputs += '</div>';
    // } else {
    //   filterInput = true;
    //   var filterClass, filterInputs = [], filterInputElem = settings.filterInput;
    //   if(filterInputElem.length != 0){
    //     filterInputElem.each(function(inputKey, InputValue){
    //         filterClass = $(InputValue).attr("class");
    //         filterClass = filterClass.split(" ");
    //         filterClass = filterClass[($.inArray("filter", filterClass) +1)];
    //         filterInputs.push(filterClass);
    //         filterDivInputs.push($(InputValue));
    //         // divInputs += '<button class = "filterButton '+ valueClass +'">'+ valueClass +'</button>';
    //     });
    //   } else {
    //     console.log("Filter Plugin ==> Error : given FilterInput does not exists.")
    //   }
    // }