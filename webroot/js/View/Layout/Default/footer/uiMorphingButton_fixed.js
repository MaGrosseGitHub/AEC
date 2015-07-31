/**
 * uiMorphingButton_fixed.js v1.0.0
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2014, Codrops
 * http://www.codrops.com
 */
;( function( window ) {
	
	'use strict';

	$(document).ready(function() {	

		var transEndEventNames = {
				'WebkitTransition': 'webkitTransitionEnd',
				'MozTransition': 'transitionend',
				'OTransition': 'oTransitionEnd',
				'msTransition': 'MSTransitionEnd',
				'transition': 'transitionend'
			},
			transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
			support = { transitions : Modernizr.csstransitions };

		function extend( a, b ) {
			for( var key in b ) { 
				if( b.hasOwnProperty( key ) ) {
					a[key] = b[key];
				}
			}
			return a;
		}

		function UIMorphingButton( el, options ) {
			this.el = el;
			this.options = extend( {}, this.options );
			extend( this.options, options );
			this._init();
		}

		UIMorphingButton.prototype.options = {
			closeEl : '',
			onBeforeOpen : function() { return false; },
			onAfterOpen : function() { return false; },
			onBeforeClose : function() { return false; },
			onAfterClose : function() { return false; }
		}

		UIMorphingButton.prototype._init = function() {
			// the button
			this.button = $(this.el).children('button.morphButton').get()[0];
			// state
			this.expanded = false;
			// content el
			this.contentEl = $(this.el).children('div.morph-content').get()[0];
			// init events
			this._initEvents();
		}

		UIMorphingButton.prototype._initEvents = function() {
			var self = this;
			// open
			this.button.addEventListener( 'click', function() { self.toggle(false); } );
			// close
			if( this.options.closeEl !== '' ) {
				var closeEl = this.el.querySelector( this.options.closeEl );
				if( closeEl ) {
					closeEl.addEventListener( 'click', function() { self.toggle(true); } );
				}
			}
		}

		var over = true;
		UIMorphingButton.prototype.toggle = function(closeEvent) {
			if( this.isAnimating ) return false;

			// callback
			if( this.expanded ) {
				this.options.onBeforeClose();
			}
			else {
				// add class active (solves z-index problem when more than one button is in the page)
				classie.addClass( this.el, 'active' );
				this.options.onBeforeOpen();
			}

			if(closeEvent) {
				over = false;
				// $(this.el).children('div.morph-content').animate({
				// 	width : $(this.el).width()+10, 
				// 	height : $(this.el).height()+10, 
				// 	WebkitTransition : 'opacity 0.3s 0.5s, width 0.4s 0.1s, height 0.4s 0.1s, top 0.4s 0.1s, left 0.4s 0.1s, margin 0.4s 0.1s',
				// 	MozTransition : 'opacity 0.3s 0.5s, width 0.4s 0.1s, height 0.4s 0.1s, top 0.4s 0.1s, left 0.4s 0.1s, margin 0.4s 0.1s',
				// 	MsTransition : 'opacity 0.3s 0.5s, width 0.4s 0.1s, height 0.4s 0.1s, top 0.4s 0.1s, left 0.4s 0.1s, margin 0.4s 0.1s',
				// 	OTransition : 'opacity 0.3s 0.5s, width 0.4s 0.1s, height 0.4s 0.1s, top 0.4s 0.1s, left 0.4s 0.1s, margin 0.4s 0.1s',
				// 	transition : 'opacity 0.3s 0.5s, width 0.4s 0.1s, height 0.4s 0.1s, top 0.4s 0.1s, left 0.4s 0.1s, margin 0.4s 0.1s'
				// }, 500, function(){
				// 	over = true;
				// });
				// if(!over)
				// 	return false;
			}
			this.isAnimating = true;

			var self = this,
				onEndTransitionFn = function( ev ) {
					if( ev.target !== this ) return false;

					if( support.transitions ) {
						// console.log("HERE");
						// open: first opacity then width/height/left/top
						// close: first width/height/left/top then opacity
						if( self.expanded && ev.propertyName !== 'opacity' || !self.expanded && ev.propertyName !== 'width' && ev.propertyName !== 'height' && ev.propertyName !== 'left' && ev.propertyName !== 'top' ) {
							return false;
						}
						this.removeEventListener( transEndEventName, onEndTransitionFn );
					}
					self.isAnimating = false;
					
					// callback
					if( self.expanded ) {
						// remove class active (after closing)
						classie.removeClass( self.el, 'active' );
						self.options.onAfterClose();
					}
					else {
						console.log("TEST");
						self.options.onAfterOpen();
					}

					self.expanded = !self.expanded;
				};

			if( support.transitions ) {
				this.contentEl.addEventListener( transEndEventName, onEndTransitionFn );
			}
			else {
				onEndTransitionFn();
			}
				
			// set the left and top values of the contentEl (same like the button)
			var buttonPos = this.button.getBoundingClientRect();
			// need to reset
			classie.addClass( this.contentEl, 'no-transition' );
			this.contentEl.style.left = 'auto';
			this.contentEl.style.top = 'auto';
			
			// add/remove class "open" to the button wraper
			setTimeout( function() { 
				self.contentEl.style.left = buttonPos.left + 'px';
				self.contentEl.style.top = buttonPos.top + 'px';
				
				if( self.expanded ) {
					// $(self.el).children('div.morph-content').animate({width : "150px", height : "40px"}, 500);
					classie.removeClass( self.contentEl, 'no-transition' );
					classie.removeClass( self.el, 'open' );
				}
				else {
					setTimeout( function() { 
						classie.removeClass( self.contentEl, 'no-transition' );
						classie.addClass( self.el, 'open' ); 
						// $(self.el).children('div.morph-content').css({width : "", height : ""});
					}, 25 );
				}
			}, 25 );
		}

		// add to global namespace
		window.UIMorphingButton = UIMorphingButton;


		var docElem = window.document.documentElement, didScroll, scrollPosition;

		// trick to prevent scrolling when opening/closing button
		function noScrollFn() {
			window.scrollTo( scrollPosition ? scrollPosition.x : 0, scrollPosition ? scrollPosition.y : 0 );
		}

		function noScroll() {
			window.removeEventListener( 'scroll', scrollHandler );
			window.addEventListener( 'scroll', noScrollFn );
		}

		function scrollFn() {
			window.addEventListener( 'scroll', scrollHandler );
		}

		function canScroll() {
			window.removeEventListener( 'scroll', noScrollFn );
			scrollFn();
		}

		function scrollHandler() {
			if( !didScroll ) {
				didScroll = true;
				setTimeout( function() { scrollPage(); }, 60 );
			}
		};

		function scrollPage() {
			scrollPosition = { x : window.pageXOffset || docElem.scrollLeft, y : window.pageYOffset || docElem.scrollTop };
			didScroll = false;
		};

		scrollFn();

		var morphButtons = $('.ct-fmenu li').each(function(index){
			// var singleButton = $(this).children('div.morph-button').get();
			var singleButton = $(this).children('div.morph-button').get();
			if(singleButton.length != 0){
				var morphContent = $(singleButton).children('div.morph-content');
				// console.log($(singleButton).width());
				// morphContent.css({width : $(singleButton).width()+10, height : $(singleButton).height()+10});
				// console.log(morphContent);
				var UIBtnn = new UIMorphingButton( singleButton[0], {
					closeEl : '.icon-close',
					onBeforeOpen : function() {
						// don't allow to scroll
						noScroll();
					},
					onAfterOpen : function() {
						// can scroll again
						canScroll();
					},
					onBeforeClose : function() {
						// don't allow to scroll
						noScroll();
					},
					onAfterClose : function() {
						// can scroll again
						canScroll();
					}
				} );

				// document.getElementById( 'terms' ).addEventListener( 'change', function() {
				// 	UIBtnn.toggle();
				// } );
			}
		});
		// var UIBtnn = new UIMorphingButton( document.querySelector( '.morph-button' ), {
		// 	closeEl : '.icon-close',
		// 	onBeforeOpen : function() {
		// 		// don't allow to scroll
		// 		noScroll();
		// 	},
		// 	onAfterOpen : function() {
		// 		// can scroll again
		// 		canScroll();
		// 	},
		// 	onBeforeClose : function() {
		// 		// don't allow to scroll
		// 		noScroll();
		// 	},
		// 	onAfterClose : function() {
		// 		// can scroll again
		// 		canScroll();
		// 	}
		// } );


	});
})( window );