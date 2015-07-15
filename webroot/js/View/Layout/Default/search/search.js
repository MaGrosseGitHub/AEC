jQuery(document).ready(function($) {
	var $ctsearch = $( '#ct-search' ),
		$ctsearchinput = $ctsearch.find('input.ct-search-input'),
		$body = $('html,body'),
		$searchSuggestions = $('.twitter-typeahead'),
		$searchSlider = $("#searchSlider"),
		$open = false,
		openSearch = function() {
			$ctsearch.data('open',true).addClass('ct-search-open');
			if($("#searchResults").length != 0){
				$("#searchResults").show();
			}
		    $open = true;
			$searchSlider.on("webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend", function(e){
				if($open){
				    $searchSlider.hide();
				    $searchSuggestions.show();
					$ctsearchinput.focus();
				    // console.log("end open");
				    // console.log("open = >"+$open);
				}
			});

			return false;
		},
		closeSearch = function() {
		    $searchSlider.show();
		    $searchSuggestions.hide();
			$ctsearch.data('open',false).removeClass('ct-search-open');
		    $open = false;
		    $searchSlider.on("webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend", function(e){
				// console.log($searchSuggestions.children("#inputsearch"));
			    // console.log("end close");
			    // console.log("open = >"+$open);
			});
		};

	$searchSuggestions.hide();

	var searchOpened = false;
    checkSearchStatus = function(){    	
      if($(window).width() <= 400){
      	openSearch();
      	searchOpened = true;
      }
      if($(window).width() > 400 && $ctsearchinput.val() == "" && checkSearchStatus){
      	closeSearch();
      	searchOpened = false;
      }
    }

	checkSearchStatus();
	$(window).resize(function() { 
		checkSearchStatus();   
    });

	$ctsearchinput.on('click',function(e) { e.stopPropagation(); $ctsearch.data('open',true); });

	$ctsearch.on('click',function(e) {
		e.stopPropagation();
		if( !$ctsearch.data('open') ) {

			openSearch();

			$body.off( 'click' ).on( 'click', function(e) {
				closeSearch();
			} );

		}
		else {
			if( $ctsearchinput.val() === '' ) {
				closeSearch();
				return false;
			}
		}
	});

});