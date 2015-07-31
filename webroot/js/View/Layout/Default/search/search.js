jQuery(document).ready(function($) {
	var $ctsearch = $( '#ct-search' ),
		$ctsearchinput = $ctsearch.find('input.ct-search-input'),
		$body = $('html,body'),
		$searchSuggestions = $('.twitter-typeahead'),
		$searchSlider = $("#searchSlider"),
		$open = false,
		openSearch = function() {
			// $('.ct-search-input-wrap.single-search').show();
			$ctsearch.data('open',true).addClass('ct-search-open');
			if($("#searchResults").length != 0){
				$("#searchResults").show();
			}
		    $open = true;
			$searchSlider.on("webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend", function(e){
				if($open){
					$('.ct-search-input-wrap.single-search').animate({width : 265}, 300);
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
				// $('.ct-search-input-wrap.single-search').hide();
				$('.ct-search-input-wrap.single-search').width(0);
			});
		};

	$searchSuggestions.hide();
	// $('.ct-search-input-wrap.single-search').hide();
	$('.ct-search-input-wrap.single-search').width(0);

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

			$searchSuggestions.off('click').on( 'click', function(e) {
				return false;
			} );

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