/*
* debouncedresize: special jQuery event that happens once after a window resize
*
* latest version and complete README available on Github:
* https://github.com/louisremi/jquery-smartresize/blob/master/jquery.debouncedresize.js
*
* Copyright 2011 @louis_remi
* Licensed under the MIT license.
*/
var $event = $.event,
$special,
resizeTimeout;

$special = $event.special.debouncedresize = {
	setup: function() {
		$( this ).on( "resize", $special.handler );
	},
	teardown: function() {
		$( this ).off( "resize", $special.handler );
	},
	handler: function( event, execAsap ) {
		// Save the context
		var context = this,
			args = arguments,
			dispatch = function() {
				// set correct event type
				event.type = "debouncedresize";
				$event.dispatch.apply( context, args );
			};

		if ( resizeTimeout ) {
			clearTimeout( resizeTimeout );
		}

		execAsap ?
			dispatch() :
			resizeTimeout = setTimeout( dispatch, $special.threshold );
	},
	threshold: 250
};

// ======================= imagesLoaded Plugin ===============================
// https://github.com/desandro/imagesloaded

// $('#my-container').imagesLoaded(myFunction)
// execute a callback when all images have loaded.
// needed because .load() doesn't work on cached images

// callback function gets image collection as argument
//  this is the container

// original: MIT license. Paul Irish. 2010.
// contributors: Oren Solomianik, David DeSandro, Yiannis Chatzikonstantinou

// blank image data-uri bypasses webkit log warning (thx doug jones)
var BLANK = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==';

$.fn.imagesLoaded = function( callback ) {
	var $this = this,
		deferred = $.isFunction($.Deferred) ? $.Deferred() : 0,
		hasNotify = $.isFunction(deferred.notify),
		$images = $this.find('img').add( $this.filter('img') ),
		loaded = [],
		proper = [],
		broken = [];

	// Register deferred callbacks
	if ($.isPlainObject(callback)) {
		$.each(callback, function (key, value) {
			if (key === 'callback') {
				callback = value;
			} else if (deferred) {
				deferred[key](value);
			}
		});
	}

	function doneLoading() {
		var $proper = $(proper),
			$broken = $(broken);

		if ( deferred ) {
			if ( broken.length ) {
				deferred.reject( $images, $proper, $broken );
			} else {
				deferred.resolve( $images );
			}
		}

		if ( $.isFunction( callback ) ) {
			callback.call( $this, $images, $proper, $broken );
		}
	}

	function imgLoaded( img, isBroken ) {
		// don't proceed if BLANK image, or image is already loaded
		if ( img.src === BLANK || $.inArray( img, loaded ) !== -1 ) {
			return;
		}

		// store element in loaded images array
		loaded.push( img );

		// keep track of broken and properly loaded images
		if ( isBroken ) {
			broken.push( img );
		} else {
			proper.push( img );
		}

		// cache image and its state for future calls
		$.data( img, 'imagesLoaded', { isBroken: isBroken, src: img.src } );

		// trigger deferred progress method if present
		if ( hasNotify ) {
			deferred.notifyWith( $(img), [ isBroken, $images, $(proper), $(broken) ] );
		}

		// call doneLoading and clean listeners if all images are loaded
		if ( $images.length === loaded.length ){
			setTimeout( doneLoading );
			$images.unbind( '.imagesLoaded' );
		}
	}

	// if no images, trigger immediately
	if ( !$images.length ) {
		doneLoading();
	} else {
		$images.bind( 'load.imagesLoaded error.imagesLoaded', function( event ){
			// trigger imgLoaded
			imgLoaded( event.target, event.type === 'error' );
		}).each( function( i, el ) {
			var src = el.src;

			// find out if this image has been already checked for status
			// if it was, and src has not changed, call imgLoaded on it
			var cached = $.data( el, 'imagesLoaded' );
			if ( cached && cached.src === src ) {
				imgLoaded( el, cached.isBroken );
				return;
			}

			// if complete is true and browser supports natural sizes, try
			// to check for image status manually
			if ( el.complete && el.naturalWidth !== undefined ) {
				imgLoaded( el, el.naturalWidth === 0 || el.naturalHeight === 0 );
				return;
			}

			// cached images don't fire load sometimes, so we reset src, but only when
			// dealing with IE, or image is complete (loaded) and failed manual check
			// webkit hack from http://groups.google.com/group/jquery-dev/browse_thread/thread/eee6ab7b2da50e1f
			if ( el.readyState || el.complete ) {
				el.src = BLANK;
				el.src = src;
			}
		});
	}

	return deferred ? deferred.promise( $this ) : $this;
};

var Grid = (function() {

		// list of items
	var $grid = $( '#og-grid' ),
		// the items
		$items = $grid.children( 'li.albumDiv' ),
		// current expanded item's index
		current = -1,
		// position (top) of the expanded item
		// used to know if the preview will expand in a different row
		previewPos = -1,
		// extra amount of pixels to scroll the window
		scrollExtra = 0,
		// extra margin when expanded (between preview overlay and the next items)
		marginExpanded = 10,
		$window = $( window ), winsize,
		$body = $( 'html, body' ),
		// transitionend events
		transEndEventNames = {
			'WebkitTransition' : 'webkitTransitionEnd',
			'MozTransition' : 'transitionend',
			'OTransition' : 'oTransitionEnd',
			'msTransition' : 'MSTransitionEnd',
			'transition' : 'transitionend'
		},
		transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
		// support for csstransitions
		support = Modernizr.csstransitions,
		// default settings
		settings = {
			minHeight : 500,
			speed : 350,
			easing : 'ease'
		};

	function init( config ) {
		
		// the settings..
		settings = $.extend( true, {}, settings, config );

		// preload all images
		$grid.imagesLoaded( function() {

			// save item´s size and offset
			saveItemInfo( true );
			// get window´s size
			getWinSize();
			// initialize some events
			initEvents();

		} );

	}

	// add more items to the grid.
	// the new items need to appended to the grid.
	// after that call Grid.addItems(theItems);
	function addItems( $newitems ) {

		$items = $items.add( $newitems );

		$newitems.each( function() {
			var $item = $( this );
			$item.data( {
				offsetTop : $item.offset().top,
				height : $item.height()
			} );
		} );

		initItemsEvents( $newitems );

	}

	// saves the item´s offset top and height (if saveheight is true)
	function saveItemInfo( saveheight ) {
		$items.each( function() {
			var $item = $( this );
			$item.data( 'offsetTop', $item.offset().top );
			if( saveheight ) {
				$item.data( 'height', $item.height() );
			}
		} );
	}

	function initEvents() {
		
		// when clicking an item, show the preview with the item´s info and large image.
		// close the item if already expanded.
		// also close if clicking on the item´s cross
		initItemsEvents( $items );
		
		// on window resize get the window´s size again
		// reset some values..
		$window.on( 'debouncedresize', function() {
			
			scrollExtra = 0;
			previewPos = -1;
			// save item´s offset
			saveItemInfo();
			getWinSize();
			var preview = $.data( this, 'preview' );
			if( typeof preview != 'undefined' ) {
				hidePreview();
			}

		} );

	}

	function initItemsEvents( $items ) {

		$items.unbind("click").on( 'click', 'span.og-close', function() {
			if($(this).parents('li.file').hasClass('albumDiv')){
				hidePreview();
			}
			return false;
		});

		$items.find( 'a.gridTrigger' ).unbind("click").on( 'click', function() {
			sliderDisplayed = false; //hide the thumbnails slider in the modal when new album clicked
			//check this line for errors
			var $item = $( this ).parents('li.file');
			current === $item.index() ? hidePreview() : showPreview( $item );
			return false;
		} );

	}

	function getWinSize() {
		winsize = { width : $window.width(), height : $window.height() };
	}

	function showPreview( $item ) {

		var preview = $.data( this, 'preview' ),
			// item´s offset top
			position = $item.data( 'offsetTop' );

		scrollExtra = 0;

		// if a preview exists and previewPos is different (different row) from item´s top then close it
		if( typeof preview != 'undefined' ) {

			// not in the same row
			if( previewPos !== position ) {
				// if position > previewPos then we need to take te current preview´s height in consideration when scrolling the window
				if( position > previewPos ) {
					scrollExtra = preview.height;
				}
				hidePreview();
			}
			// same row
			else {
				preview.update( $item );
				return false;
			}
			
		}

		// update previewPos
		previewPos = position;
		// initialize new preview for the clicked item
		preview = $.data( this, 'preview', new Preview( $item ) );
		// expand preview overlay
		preview.open();

	}

	function hidePreview() {
		current = -1;
		var preview = $.data( this, 'preview' );
		preview.close();
		$.removeData( this, 'preview' );
	}

	// the preview obj / overlay
	function Preview( $item ) {
		this.$item = $item;
		this.expandedIdx = this.$item.index();
		this.create();
		this.update();
	}

	Preview.prototype = {
		create : function() {		

			//delete the og expander variable
			$( 'div.og-expander' ).html("");
			$( 'div.og-expander' ).empty();	
			$( 'div.og-expander' ).remove();	
			
			curViewedAlbum = this.$item;
			// create Preview structure:
			this.$loading = $( '<div class="og-loading"></div>' );
			this.$closePreview = $( '<span class="og-close"></span>' );
			this.$previewInner = $( '<div class="og-expander-inner"></div>' );
			this.$previewEl = $( '<div class="og-expander"></div>' ).append( this.$previewInner );

			var imgUrl = this.$item.find( 'a.gridTrigger:first' ).attr( 'href' );
			var albumsObject = JSON.parse(this.$item.find('#albumObjInfo').text());

			// append preview element to the item
			this.$item.append( this.getEl() );
			$( 'div.og-expander' ).width($('.galerie').width());

			$( 'div.og-expander-inner' ).html("");
			$( 'div.og-expander-inner' ).empty();
			$( 'div.og-expander-inner' ).append( this.$closePreview);

			var divLoader = this.$loading.appendTo($( 'div.og-expander-inner' )).show().css({
				'position': 'absolute',
				'top': '0px',
				'bottom': 0,
				'left': '0px',
				'right': 0,
				'margin': 'auto',
				'z-index': '1201'
			});

			var albumThumbnails = '<div class="albumThumbnails" style = "display : none;""></div>';
			var albumThumbs = '<div class="albumThumbs"></div>';
          	$( 'div.og-expander-inner' ).append(albumThumbs);
          	$( 'div.og-expander-inner' ).append(albumThumbnails);
          	var zIndex = 1200;
			// for($image in albumsObject){
			// 	if($image != "insert" && $image != "peek" && $image != "nbImgs"){
			// 		$imageInfo = albumsObject[$image];

			// 		$('div.modal li:last').clone().appendTo('.albumThumbs');
			// 		$('.albumThumbs li:last').find('img').attr('src', $imageInfo.thumb).attr('slug', $imageInfo.slug);
			// 		$('.albumThumbs li:last').find('a').attr('href', $imageInfo.url).attr('data-index', $image);
			// 		$('.albumThumbs li:last').find('span').html($imageInfo.user);
			// 		if($imageInfo.type == "video"){
			// 			$('.albumThumbs li:last').find('a').addClass('video');
			// 			// $('.albumThumbs li:last').find('a:first').append('<span class="videoData" style = "display : none;">'+$imageInfo.videoData+'</span>');
			// 			$imageInfo.playIcon = '<img src = "'+$imageInfo.playIcon+'" style = "width : 70px; height : 70px; position : absolute; top : 48%; right : 0%" alt="A sample SVG button." onerror="this.removeAttribute(\'onerror\'); this.src=\'buttonA.png\'"';
			// 			$('.albumThumbs li:last').find('a:first').append($imageInfo.playIcon);
			// 		} 
			// 		$('.albumThumbs li:last').find('h3').html("");
			// 		$('.albumThumbs li:last').append('<filter class = "user">'+$imageInfo.user+'</filter>');
			// 		$('.albumThumbs li:last').append('<filter class = "type">'+$imageInfo.eventType+'</filter>');
			// 		$('.albumThumbs li:last').append('<filter class = "date filterSort">'+$imageInfo.date+'</filter>');

			// 		$('.albumThumbs li:last').css('z-index', (zIndex--));
			// 		$('.albumThumbs li:last').show();

			// 		// $('.albumThumbs li:last').find('a.mdTrigger:first').clone().appendTo('.albumThumbnails');
			// 		$('.albumThumbs li:last').find('a.mdTrigger:first').clone().removeAttr('style').addClass('inExpandedAlbum').css('display', 'inline-block').appendTo('.albumThumbnails');					
			// 		if($imageInfo.type == "video"){
			// 			$('.albumThumbnails a:last').css('position','relative');
			// 		}
			// 	}
			// }
          	$('filter').hide();
          	$('filterInput').hide();

			// addnicescroll						
            $( 'div.og-expander-inner' ).niceScroll({
              cursorwidth : '6px'
            });
            var niceScrollObjectId = $( 'div.og-expander-inner' ).getNiceScroll();
            niceScrollObjectId = niceScrollObjectId[0].id;
            $("#"+niceScrollObjectId).css("background-color","rgba(0, 0, 0, 0.14902)");
            $("#"+niceScrollObjectId).css("z-index","auto");
            $("#"+niceScrollObjectId).css("cursor","pointer");
            $("#"+niceScrollObjectId).css("width","3px");
            $("#"+niceScrollObjectId).append(scrollToolsDiv);

            var scroller = $("#"+niceScrollObjectId).find("div");
            scroller.css('left', "1px");
            var scrollerHr = $("#"+niceScrollObjectId+"-hr").find("div");
            scrollerHr.css('left', "3px");

            var margin = 0;
            $( 'div.og-expander-inner' ).find("#down").click(function () {
              margin +=250;
              nice[0].doScrollTop(margin,500);
            });
            $( 'div.og-expander-inner' ).find("#up").click(function () {
              if(margin != 0) {
                margin -= 250;
              }
              nice[0].doScrollTop(margin,500);
            });

            $("div#"+niceScrollObjectId).css("top", "100px");
            $("div.nicescroll-rails").css("top", "100px");

			$('div.og-expander').offset({left: ($('ul.filelist').offset().left) });
			divLoader.hide();

			// set the transitions for the preview and the item
			if( support ) {
				this.setTransition();
			}
		},
		update : function( $item ) {
			
			this.$item.addClass('no-after');
			if( $item ) {
				this.$item = $item;
			}
			this.$item.removeClass('no-after');
			curViewedAlbum = this.$item;

			this.calcHeight();
			
			// if already expanded remove class "og-expanded" from current item and add it to new item
			var alreadyExpanded = false;
			if( current !== -1 ) {
				var $currentItem = $items.eq( current );
				$currentItem.removeClass( 'og-expanded' );
				this.$item.addClass( 'og-expanded' );
				$('div.og-expander').offset({left: ($('ul.filelist').offset().left) });
				// position the preview correctly
				this.positionPreview();
				alreadyExpanded = true;
			}

			// update current value
			current = this.$item.index();

			var imgUrl = this.$item.find( 'a.gridTrigger:first' ).attr( 'href' );
			var albumsObject = JSON.parse(this.$item.find('#albumObjInfo').text());
			var updateContent = function(){
				this.$loading = $( '<div class="og-loading"></div>' );
				this.$closePreview = $( '<span class="og-close"></span>' );

				$( 'div.og-expander-inner' ).html("");
				$( 'div.og-expander-inner' ).empty();
				$( 'div.og-expander-inner' ).append( this.$closePreview);

				var divLoader = this.$loading.appendTo($( 'div.og-expander-inner' )).show().css({
					'position': 'absolute',
					'top': '0px',
					'bottom': 0,
					'left': '0px',
					'right': 0,
					'margin': 'auto',
					'z-index': '1201'
				});
  				$('.albumThumbs').remove();
				var albumThumbnails = '<div class="albumThumbnails" style = "display : none;"></div>';
				var albumThumbs = '<div class="albumThumbs"></div>';
	          	$( 'div.og-expander-inner' ).append(albumThumbs);
	          	$( 'div.og-expander-inner' ).append(albumThumbnails);
	          	var zIndex = 1200;
	          	fotoramaData = [], fotoramaDataImg = [], fotoramaDataVid = [], albumObj = this;
				for($image in albumsObject){
					if($image != "insert" && $image != "peek" && $image != "nbImgs"){
						$imageInfo = albumsObject[$image];

						$('div.modal li:last').clone().appendTo('.albumThumbs');
						$('.albumThumbs li:last').find('img').attr('src', $imageInfo.thumb).attr('slug', $imageInfo.slug);
						$('.albumThumbs li:last').find('a').attr('href', $imageInfo.url).attr('data-index', $image);
						$('.albumThumbs li:last').find('span').html($imageInfo.user);
						if($imageInfo.type == "video"){
							$('.albumThumbs li:last').find('a').addClass('video');
							// $('.albumThumbs li:last').find('a:first').append('<span class="videoData" style = "display : none;">'+$imageInfo.videoData+'</span>');
							$imageInfo.playIcon = '<img src = "'+$imageInfo.playIcon+'" style = "width : 70px; height : 70px; position : absolute; top : 48%; right : 0%" alt="A sample SVG button." onerror="this.removeAttribute(\'onerror\'); this.src=\'buttonA.png\'">';
							$('.albumThumbs li:last').find('a:first').append($imageInfo.playIcon);
							if($imageInfo.service == "dailymotion"){
								$videoLink = $imageInfo.iframe;
							} else {
								$videoLink = $imageInfo.link;
							}
							var fotoramaObj = {video : $videoLink, thumb : $imageInfo.thumb, caption : '<a href = "'+$imageInfo.url+'">Voir vidéo</a>'};
							fotoramaDataVid.push(fotoramaObj);
						} else {
							var fotoramaObj = {img : $imageInfo.origin, thumb : $imageInfo.thumb, caption : '<a href = "'+$imageInfo.url+'">Voir image</a>'};
							fotoramaDataImg.push(fotoramaObj);
						}
						fotoramaData.push(fotoramaObj);
						$('.albumThumbs li:last').find('h3').html("");
						$('.albumThumbs li:last').append('<filter class = "user">'+$imageInfo.user+'</filter>');
						$('.albumThumbs li:last').append('<filter class = "type">'+$imageInfo.eventType+'</filter>');
						$('.albumThumbs li:last').append('<filter class = "date filterSort">'+$imageInfo.date+'</filter>');

						$('.albumThumbs li:last').css('z-index', (zIndex--));
						$('.albumThumbs li:last').show();

						// $('.albumThumbs li:last').find('a.mdTrigger:first').clone().appendTo('.albumThumbnails');
						// $('.albumThumbs li:last').find('a.mdTrigger:first').clone().appendTo('.albumThumbnails').removeAttr('style').find('img').removeAttr('style');
						$('.albumThumbs li:last').find('a.mdTrigger:first').clone().removeAttr('style').addClass('inExpandedAlbum').css('display', 'inline-block').appendTo('.albumThumbnails');						
						if($imageInfo.type == "video"){
							$('.albumThumbnails a:last').css('position','relative');
						}
					}
				}
				
              	$('filter').hide();
              	$('filterInput').hide();

				$('.albumThumbs').html($('.albumThumbs:last').html());
				$( 'div.og-expander-inner' ).show('slide', { direction: 'up' }, 350);
				divLoader.hide();
			};
			// $( 'div.og-expander-inner' ).html($( 'div.og-expander-inner:last' ).html());
			 
			var AddNiceScroll = function(){
	            $( 'div.og-expander-inner' ).niceScroll({
	              cursorwidth : '6px'
	            });
	            var niceScrollObjectId = $( 'div.og-expander-inner:last' ).getNiceScroll();
	            niceScrollObjectId = niceScrollObjectId[0].id;
	            $("#"+niceScrollObjectId).css("background-color","rgba(0, 0, 0, 0.14902)");
	            $("#"+niceScrollObjectId).css("z-index","auto");
	            $("#"+niceScrollObjectId).css("cursor","pointer");
	            $("#"+niceScrollObjectId).css("width","3px");
	            $("#"+niceScrollObjectId).append(scrollToolsDiv);

	            var scroller = $("#"+niceScrollObjectId).find("div");
	            scroller.css('left', "1px");
	            var scrollerHr = $("#"+niceScrollObjectId+"-hr").find("div");
	            scrollerHr.css('left', "3px");

	            var margin = 0;
	            $( 'div.og-expander-inner' ).find("#down").click(function () {
	              margin +=250;
	              nice[0].doScrollTop(margin,500);
	            });
	            $( 'div.og-expander-inner' ).find("#up").click(function () {
	              if(margin != 0) {
	                margin -= 250;
	              }
	              nice[0].doScrollTop(margin,500);
	            });

	            $("div#"+niceScrollObjectId).css("top", "100px");
	            $("div.nicescroll-rails").css("top", "100px");
			}

			// update preview´s content
			if(alreadyExpanded){
				$( 'div.og-expander-inner' ).hide('slide', { direction: 'down' }, 350, function(){
					updateContent();
				});
			} else {
				updateContent();
			}
			AddNiceScroll();

			var self = this;
			
			//remove the current image in the preview
			if( typeof self.$largeImg != 'undefined' ) {
				self.$largeImg.remove();
			}

			// preload large image and add it to the preview
			// for smaller screens we don´t display the large image (the media query will hide the fullimage wrapper)
			// if( self.$fullimage.is( ':visible' ) ) {
			// 	this.$loading.show();
			// 	$( '<img/>' ).load( function() {
			// 		var $img = $( this );
			// 		if( $img.attr( 'src' ) === self.$item.children('a').data( 'largesrc' ) ) {
			// 			self.$loading.hide();
			// 			self.$fullimage.find( 'img' ).remove();
			// 			self.$largeImg = $img.fadeIn( 350 );
			// 			self.$fullimage.append( self.$largeImg );
			// 		}
			// 	} ).attr( 'src', eldata.largesrc );	
			// }

		},
		fotorama : function($type, $img, $thumb){
			// var fotoramaData = [];
			// {img: '9-lo.jpg', thumb: '1-thumb.jpg'},
			// {video: 'http://vimeo.com/61527416', thumb: '3-thumb.jpg'}, //link
			// {video: 'http://youtube.com/watch?v=C3lWwBslWqg', thumb: '3-thumb.jpg'},
			// {video: 'http://dailymotion.com/embed/video/xxgmlg?autoplay=1', thumb: '3-thumb.jpg'}, //embed
			return {$type : $img, thumb : $thumb};
		},
		open : function() {
			setTimeout( $.proxy( function() {	
				// set the height for the preview and the item
				this.setHeights();
				// scroll to position the preview in the right place
				this.positionPreview();
			}, this ), 25 );

		},
		close : function() {

			var self = this,
				onEndFn = function() {
					if( support ) {
						$( this ).off( transEndEventName );
					}
					self.$item.removeClass( 'og-expanded' );
					self.$previewEl.remove();
				};

			setTimeout( $.proxy( function() {

				if( typeof this.$largeImg !== 'undefined' ) {
					this.$largeImg.fadeOut( 'fast' );
				}
				this.$previewEl.css( 'height', 0 );
				// the current expanded item (might be different from this.$item)
				var $expandedItem = $items.eq(this.expandedIdx);
				// $expandedItem.css( 'height', $expandedItem.data( 'height' ) ).on( transEndEventName, onEndFn );
				// this.$item.data( 'jumpPosItem').css( 'margin-top', 0 ).on( transEndEventName, onEndFn ).css( 'margin-top', '' );
				this.$item.data( 'jumpPosItem').css( 'margin-top', 0 ).on( transEndEventName, onEndFn );
				this.$item.addClass('no-after');
				$expandedItem.removeClass( 'og-expanded' );
				this.EraseMargin(this.$item.index());

				if( !support ) {
					onEndFn.call();
				}

			}, this ), 25 );
			
			return false;

		},
		calcHeight : function($calcAll) {

			// var heightPreview = winsize.height - this.$item.data( 'height' ) - marginExpanded,
			// 	itemHeight = winsize.height;

			// if( heightPreview < settings.minHeight ) {
			// 	heightPreview = settings.minHeight;
			// 	itemHeight = settings.minHeight + this.$item.data( 'height' ) + marginExpanded;
			// }

			var expanderHeight = 300;
			var expanderJump = expanderHeight + this.$item.outerWidth();
			var expanderJump = expanderHeight;

			var rowWidth = $('.filelist').width(); //container width
			var liWidth = this.$item.outerWidth(true); //item width
			var nbItemsPerRow = Math.floor(rowWidth/liWidth); //nb of items per row
			var nbItems = $('li.file').length; //nb of items in container
			var curItemIndex = this.$item.index()+1; //index of element in items
			var curItemRowPos = curItemIndex % nbItemsPerRow; //position of item in the row
			if(curItemRowPos == 0){
				curItemRowPos = nbItemsPerRow;
			}
			var jumpItemPos = (nbItemsPerRow - curItemRowPos) ; //position of the first element on the next row

			// console.log("JUMP = "+jumpItemPos);
			// console.log("CUR-ROW-POS = "+curItemRowPos);
			// console.log("ITEMS PER ROW = "+nbItemsPerRow);
			if(exists($calcAll) && $calcAll){
				this.height = expanderHeight;
				this.itemHeight = expanderJump;
				this.jumpItemPos = jumpItemPos;

				this.$item.data( 'height', expanderJump );
				this.$item.data( 'jumpItemPos', jumpItemPos );
				this.$item.data( 'jumpPosItem', this.$item.nextAll().eq(jumpItemPos) );
			} else {
				this.$item.data( 'jumpPosItem', this.$item.nextAll().eq(jumpItemPos) );
			}
			this.CheckValidPreview();

			// this.height = 300;
			// console.log(itemHeight);
			// this.itemHeight = 500;
			// this.itemHeight = itemHeight;

		},
		CheckValidPreview : function($itemValid) {
			//checks if the jumpItem is valid, meaning if it's not in diplay : none mode
			//for an item to be valid it has to be displayed not hidden
			
			var jumpPosElem = this.$item.data( 'jumpPosItem');

			function nextvalidElem(elem){
                if(elem.next('li.file').hasClass('albumDiv')){
                  nextvalidElem(elem.next('li.file'));
                  return false;
                }
                nextvalidElem = elem.next('li.file');
                return nextvalidElem;
            }

			var jumpCount = 0;
			for (var i = 0; i <= $grid.find('li').length;  i++) {
				$element = $grid.find('li').eq(i);
				if(!$element.hasClass('albumImg') && !$element.is(":visible")){
					jumpCount++;
				}
				if(jumpPosElem.html() == $element.html() && $element.is(":visible")){
					break;
				} else if( jumpPosElem.html() == $element.html() && !$element.is(":visible") ) {
					jumpCount++;
					jumpPosElem = nextvalidElem(jumpPosElem);
				}
			};

			jumpItemPos = this.$item.data( 'jumpItemPos') + jumpCount;
			this.$item.data( 'jumpItemPos', jumpItemPos );
			this.$item.data( 'jumpPosItem', this.$item.nextAll().eq(jumpItemPos) );
		},
		EraseMargin : function($startIndex) {
			//checks if the jumpItem is valid, meaning if it's not in diplay : none mode
			//for an item to be valid it has to be displayed not hidden

			for (var i = $startIndex-1; i <= $grid.find('li').length -$startIndex;  i++) {
				$element = $grid.find('li').eq(i);
				if($element.css('margin-top') !== '0px'){
					$element.css( 'margin-top', 0 );
					break;
				}
				if($element.nextAll('li.file:not(.albumImg)').css('height') !== '175px' && $element.nextAll('li.file:not(.albumImg)').css('height') !== '135px'){
					//used to correct error where li div stays with haight 300px and doesn't change back to narmal height
					// if($element.nextAll('li.file:not(.albumImg)').hasClass('albumDiv')){
					// 	$element.nextAll('li.file:not(.albumImg)').css('height', '135px');
					// } else {
					// 	$element.nextAll('li.file:not(.albumImg)').css('height', '175px');
					// }
				}
			};
		},
		setHeights : function() {

			var self = this,
				onEndFn = function() {
					if( support ) {
						self.$item.off( transEndEventName );
					}
					self.$item.addClass( 'og-expanded' );
				};

			this.calcHeight(true);
			this.$previewEl.css( 'height', this.height );
			// this.$item.css( 'height', this.itemHeight ).on( transEndEventName, onEndFn );
			this.$item.data( 'jumpPosItem').css( 'margin-top', this.itemHeight ).on( transEndEventName, onEndFn );

			if( !support ) {
				onEndFn.call();
			}

		},
		positionPreview : function() {

			// scroll page
			// case 1 : preview height + item height fits in window´s height
			// case 2 : preview height + item height does not fit in window´s height and preview height is smaller than window´s height
			// case 3 : preview height + item height does not fit in window´s height and preview height is bigger than window´s height
			var position = this.$item.data( 'offsetTop' ),
				previewOffsetT = this.$previewEl.offset().top - scrollExtra,
				scrollVal = this.height + this.$item.data( 'height' ) + marginExpanded <= winsize.height ? position : this.height < winsize.height ? previewOffsetT - ( winsize.height - this.height ) : previewOffsetT;
			
			$body.animate( { scrollTop : scrollVal - 100}, settings.speed );

		},
		setTransition  : function() {
			this.$previewEl.css( 'transition', 'height ' + settings.speed + 'ms ' + settings.easing );
			this.$item.css( 'transition', 'height ' + settings.speed + 'ms ' + settings.easing );
			// this.$item.data( 'jumpPosItem').css( 'transition', 'margin-top ' + settings.speed + 'ms ' + settings.easing );
		},
		getEl : function() {
			return this.$previewEl;
		}
	}

	return { 
		init : init,
		addItems : addItems
	};

})();