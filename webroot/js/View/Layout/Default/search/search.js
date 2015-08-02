jQuery(document).ready(function($) {
	var $ctsearch = $( '#ct-search' ),
		$ctsearchinput = $ctsearch.find('input.ct-search-input'),
		$ctsearchinputView = $ctsearch.find('input.ct-search-input.tt-query'),
		$body = $('html,body'),
		$searchSuggestions = $('.twitter-typeahead'),
		$singleSearchSuggestion = $('.tt-suggestion'),
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
					$('.ct-search-input-wrap.single-search').animate({width : 265}, 300); //may conflict with css rules
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
	$ctsearchinput.val("");
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

		console.log($ctsearchinput);
		console.log($ctsearch);
		if($ctsearchinput.val() !== '' || $ctsearchinputView.val() !== ''){
			alert("FUL SEARCH");
		}

		if( !$ctsearch.data('open') ) {
			openSearch();
			$body.off( 'click' ).on( 'click', function(e) {
				closeSearch();
			} );

			$searchSuggestions.off('click').on( 'click', function(e) {
				return false;
			} );
		}
		else {
			if( $ctsearchinput.val() === '' ) {
				closeSearch();
				return false;
			}
		}
	});

	$singleSearchSuggestion.off('click').on( 'click', function(e) {
		alert("test click");
		return false;
	} );

});


			$(document).ready(function($) {
				(function() {
					var morphSearch = $("#ct-search")[0];
					if($(morphSearch).length){
						var input = morphSearch.querySelector( 'input.morphsearch-input' ),
						ctrlClose = morphSearch.querySelector( 'span.morphsearch-close' ),
						isOpen = isAnimating = false;
					}
						// show/hide search area
					toggleSearch = function(evt) {
						if($(morphSearch).length){
							// return if open and the input gets focused
							if( evt.type.toLowerCase() === 'focus' && isOpen ) return false;

							var offsets = morphSearch.getBoundingClientRect();
							if( isOpen ) {
								classie.remove( morphSearch, 'open' );

								// trick to hide input text once the search overlay closes 
								// todo: hardcoded times, should be done after transition ends
								if( input.value !== '' ) {
									setTimeout(function() {
										classie.add( morphSearch, 'hideInput' );
										setTimeout(function() {
											classie.remove( morphSearch, 'hideInput' );
											input.value = '';
										}, 300 );
									}, 500);
								}
								
								input.blur();
								searchEnterPressed = false;
								$('.morphsearch-submit').hide();
							}
							else {
								classie.add( morphSearch, 'open' );
								$('.morphsearch-submit').show();
							}
							isOpen = !isOpen;
						} else {
							return false;
						}
					};

					// events
					// input.addEventListener( 'focus', toggleSearch );
					searchEnterPressed = false;
					$('.morphsearch-submit').hide();
					$(input).keydown(function(e) {
						if(e.keyCode == 13)
					    {
					    	e.preventDefault();
					        $(this).trigger("enterKey");	
					    }
						$(input).bind("enterKey",function(e){
							if(!searchEnterPressed){
								e.preventDefault();
								toggleSearch(e);
								searchEnterPressed = true;
							}
						});
					});

					if($(morphSearch).length){
						ctrlClose.addEventListener( 'click', toggleSearch );
					}
					// esc key closes search overlay
					// keyboard navigation events
					document.addEventListener( 'keydown', function( ev ) {
						var keyCode = ev.keyCode || ev.which;
						if( keyCode === 27 && isOpen ) {
							toggleSearch(ev);
						}
					} );

					$("form.searchform").submit(function (e) {
      					e.preventDefault();
      				});

					/***** for demo purposes only: don't allow to submit the form *****/
					// morphSearch.querySelector( 'button[type="submit"]' ).addEventListener( 'click', function(ev) { ev.preventDefault(); } );
				})();
			});