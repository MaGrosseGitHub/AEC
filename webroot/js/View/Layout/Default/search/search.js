jQuery(document).ready(function($) {
	var $ctsearch = $( '#ct-search' ),
		$ctsearchinput = $ctsearch.find('input.ct-search-input'),
		$body = $('html,body'),
		openSearch = function() {
			$ctsearch.data('open',true).addClass('ct-search-open');
			$ctsearchinput.focus();
			if($("#searchResults").length != 0){
				$("#searchResults").show();
			}
			return false;
		},
		closeSearch = function() {
			$ctsearch.data('open',false).removeClass('ct-search-open');
			if($("#searchResults").length != 0){
				$("#searchResults").hide();
			}
		};


	var searchOpened = false;
    checkSearchStatus = function(){    	
      if($(window).width() < 400){
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