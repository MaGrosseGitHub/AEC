jQuery(function($){

	//Gestion du LocalStorage
	$.fn.formBackUp = function(){
		if(!localStorage){
			return false; 
		}
		var forms = this;
		var datas = {}; 
		var ls = false; 
		datas.href = window.location.href;
		if(localStorage['formBackUp']){
			ls = JSON.parse(localStorage['formBackUp']);
			if(ls.href == datas.href){
				for(var id in ls){
					if(id != 'href'){
						$('#'+id).val(ls[id]);
						if($('#'+id).attr("class") == "redactor") {							
							$("iframe.redactor_frame").contents().find("div").html(ls[id]);
						}
						datas[id] = ls[id]; 
					}
				}
			}
		}

		$('.redactor').redactor({
                lang: 'fr',
                keyupCallback: function(e){
					var redactorText = $(".redactor").attr('id');
					datas[redactorText] = $(".redactor_frame").contents().find("div").html();
					localStorage.setItem('formBackUp',JSON.stringify(datas));
                }
        });

		forms.find('input, textarea').keyup(function(e){
			datas[$(this).attr('id')] = $(this).val();
			localStorage.setItem('formBackUp',JSON.stringify(datas));
		});

		forms.submit(function(e){
			localStorage.removeItem('formBackUp');
		})

	}

	$('form').formBackUp();

	//Gestion du chargement Ajax avec historique dynamique
    isHistoryAvailable = true;
	if(typeof  history.pushState === 'undefined'){
		isHistoryAvailable = false;
		$.getScript( "js/history.js");
		History = history;
	}

	var lastFilter;
	$('.ajax').live('click', function(event){
		event.preventDefault();
		var $a = $(this);
		var url = $a.attr('href');
		formatedUrl = url.replace("lookFor_","");
		if(isHistoryAvailable){
			history.pushState({key : $("title").text(), 'url' : url}, $("title").text(), formatedUrl);
		}
    	prevPageTitle = $('title').text();
		ajaxLoad(url);
	});

	function ajaxLoad(url){
		lastFilter = $(".actu").find(".filterDiv");
        $("#loader").show();
        $('#view').load(url, function(){ 
			$(".actu").hide('slide', { direction: 'down' }, 500, function(){
				$('.news').show('slide', { direction: 'up' }, 500);
			});
        	$("#loader").hide();
        });
	}

	window.onpopstate = function(event){
		// console.log(event);
		// console.log(event.state);
		// console.log(history);
		// console.log(document.location);
		if(event.state == null){
			if(prevPageTitle != ""){
				if(prevPageTitle == "Index") {
					if(prevIndex){
						window.location.replace(document.location.href);
					}
					$(".actu").show('slide', { direction: 'down' }, 500, function(){
						$('.news').hide('slide', { direction: 'up' }, 500);
					});
					$('#view').html("");      
					$('#view').empty();      
					$('#disqus_thread').html("");
					$('#disqus_thread').empty();
					if($(".filterDiv").length > 1){
				        $(".actu").find(".post").DataFilter({
				          div : true,
				          appendTo : $('.posts'),
				          filterTypes : {
				            type : ['parapente', 'parachute', 'aviation']
				          }
				        });
	                	var filterContainer = $(".filterDiv:last").show();
	                	$(".filterDiv").remove();
	                	$(".posts").prepend(filterContainer);
					}
					$('title').text(prevPageTitle);
					prevPageTitle = "";
				}

	        	// console.log("NULL - FOUND Prev");
			} else{
				if($("title").text() == "Index") {
					$(".actu").show('slide', { direction: 'down' }, 500, function(){
						$('.news').hide('slide', { direction: 'up' }, 500);
					});
					$('#view').empty();        
					if($(".filterDiv").length > 1){
				        $(".actu").find(".post").DataFilter({
				          div : true,
				          appendTo : $('.posts'),
				          filterTypes : {
				            type : ['parapente', 'parachute', 'aviation']
				          }
				        });
	                	var filterContainer = $(".filterDiv:last").show();
	                	$(".filterDiv").remove();
	                	$(".posts").prepend(filterContainer);
					}
					$('title').text(prevPageTitle);
				}

	        	// console.log("NULL - No Prev");
			}
		}else if(event.state != null && event.state.key != $("title").text()){
    		// console.log("NOT TITLE");
			ajaxLoad(document.location.pathname);
		} else if(event.state != null && event.state.key == $("title").text()) {
        	// console.log("TITLE");
        	if($("title").text() == "Evenements"){
        		if(curMdTrigger != ""){
        			curMdTrigger.trigger('click');
        		} else{
        			formatedUrl = event.state.url;
  					formatedUrl = formatedUrl.replace("lookFor_","");
  					window.location.replace(formatedUrl);
        		}
        	}
			ajaxLoad(event.state.url);
		}
	}	


	$(".logout").click(function() {
		var checklogout = new RegExp('\\b' + 'cockpit' + '\\b', 'gi');
		var linkToCheck = location.href;
		if(linkToCheck.match(checklogout)) {
		    return true;
		} else {
	        $.ajax({
	                type: "get",
	                url: 'http://localhost/AEC/webroot/lookFor/users/logout',
	                data: "ajax", 
	                success: function(response) {
	              		response = jQuery.trim(response);
	              		$(document.body).append(response);
	              		$.setNotif();
	              		$(".logout").hide(500);
	                },
	                error: function (xhr, status, error) {
	                	// console.log(status, error); 
	                }, 
	                complete: function (xhr, status) {
	                	// console.log(status); 
	               }
	        });
		}
		return false;
	});

	$resultsCount = 0;
	$slyLoaded = false;
	$(".twitter-typeahead").children("#s").keyup(function(e) {
		var search = $(this).val();
		var data = search;
		data = data.replace(' ', '+');

		$(".twitter-typeahead").children("#inputsearch").val(search);
		$(".ct-search-input-wrap single-search").children("#inputsearch:first").val(search);
		$searchLoading = '<div class="tt-suggestion"><div id="result" class="preview"><span id="searchBorder"></span><div class="searchThumb"></div><div class="searchInfo" style = "text-align: center; width: 100%; height : 100%; position: absolute; top: 12px; left: 0px;"><span class = "si-name" title="test6"><img src="'+$searchLoadingImg+'" alt = "searchloader"></span></div><div class="infoType"><span></span></div></div></div>';
		if($('.tt-dataset-search').parent().find('div.scrollbar').length){
			$('.tt-dataset-search').parent().find('div.scrollbar').remove();
		}
		if($('.tt-dataset-search').parent().find('div#btnBackward').length){
			$('.tt-dataset-search').parent().find('div#btnBackward').remove();
		}
		if($('.tt-dataset-search').parent().find('div#btnForward').length){
			$('.tt-dataset-search').parent().find('div#btnForward').remove();
		}

		if(search.length >= 3){
			// console.log(data);
			// console.log(window.location);
			// var pathname = "<?php echo $_SERVER['PATH_INFO']; ?>"; 
			// var pathnameController = pathname.replace("/index","");
			// pathname = window.location.href.replace(pathname,""); 
			// var lookFor = pathname+"/lookFor"+pathnameController+"/weather/"+$markerLocation+"/"+$markerIdBdd;
			// lookFor = lookFor.replace("#","");
			$('#searchResults').html($searchLoading);
			$.ajax({
				type: 'GET',
				url: window.location.origin+'/AEC/webroot/lookFor/search/preview/'+data,
				success: function (response) {
					$('#searchResults').html($.trim(response));
					$resultsCount = $('#searchResults').children('.tt-suggestion').length;

					if($resultsCount > 3){
						if($('.tt-dataset-search').parent().find('div.scrollbar').length){
							$('.tt-dataset-search').parent().find('div.scrollbar').remove();
						}
						if($('.tt-dataset-search').parent().find('div#btnBackward').length){
							$('.tt-dataset-search').parent().find('div#btnBackward').remove();
						}
						if($('.tt-dataset-search').parent().find('div#btnForward').length){
							$('.tt-dataset-search').parent().find('div#btnForward').remove();
						} 

						var $frame = $('.tt-dataset-search');
						var $wrap  = $frame.parent();

						$wrap.prepend('<div id="btnBackward" style="height: 35px; vertical-align: middle; overflow: hidden; width: 299px; margin-left: -34px; margin-bottom: -1px; border-bottom: 2px solid #ACACAC;" class="tt-suggestion"><div style="height: 35px; vertical-align: middle;" id="result" class="preview"><span id="searchBorder"></span><div style="text-align: center; border-right: 2px solid rgb(172, 172, 172); height: 100%; vertical-align: middle; padding-top: 7px; font-size: 32px; font-family: &quot;Lato&quot; ! important; font-style: normal; color: rgb(107, 107, 107);" class="searchThumb"><span><button style = "outline: none; border: none; background-color: transparent; color :#ACACAC;width: 110%; height: 120%;" class = "toEnd">>></button></span></div><div class="searchInfo" style="width: 75%; height: 100%; font-family: lato; text-align: center; margin-top: -23px;"><span style="font-size: 50px; color: rgb(107, 107, 107);" class="si-name" title="test6"><button style = "outline: none; border: none; background-color: transparent;color :#ACACAC; width: 110%; height: 120%;" class = "backward">...</button></span></div><div class="infoType"><span></span></div></div></div>');
						$wrap.append('<div id="btnForward" style="height: 35px; vertical-align: middle; overflow: hidden; position: absolute; top: 253px; left: 0px; width: 100%; z-index: 3000; width: 299px; margin-left: -34px; margin-top: 0px; border-top: 2px solid #ACACAC" class="tt-suggestion"><div style="height: 35px; vertical-align: middle; border-bottom: 2px solid rgb(172, 172, 172);" id="result" class="preview"><span id="searchBorder"></span><div style="text-align: center; border-right: 2px solid rgb(172, 172, 172); height: 100%; vertical-align: middle; padding-top: 7px; font-size: 32px; font-family: &quot;lato&quot; !important; font-style: normal; color: rgb(107, 107, 107);" class="searchThumb"><span><button style = "outline: none; border: none; background-color: transparent;color :#ACACAC;width: 110%;height: 120%;" class = "toStart"><<</button></span></div><div class="searchInfo" style="width: 75%; height: 100%; font-family: lato; text-align: center; margin-top: -23px;"><span style="font-size: 50px; color: rgb(107, 107, 107);" class="si-name" title="test6"><button style = "outline: none; border: none; background-color: transparent;color :#ACACAC;width: 110%; height: 120%;" class = "forward">...</button></span></div><div class="infoType"><span></span></div></div></div>');

						$wrap.prepend('<div class="scrollbar"><div class="handle"><div class="mousearea"></div></div></div>');
						
						$slySettings = {
							speed: 300,
							easing: 'easeOutExpo',
							// pagesBar: $wrap.find('.pages'),
							activatePageOn: 'click',
							scrollBar: $wrap.find('.scrollbar'),
							scrollBy: 100,
							dragHandle: 1,
							dynamicHandle: 1,
							touchDragging: 1,
							clickBar: 1,
							moveBy: 600,
							startAt: 1,

							// Buttons
							forward: $wrap.find('button.forward'),
							backward: $wrap.find('button.backward')
							// prevPage: $wrap.find('.prevPage'),
							// nextPage: $wrap.find('.nextPage')
						};
						if(!$slyLoaded){
							// Call Sly on frame
							curSly = $frame.sly($slySettings);

							// To Start button
							$wrap.find('.toStart').on('click', function () {
								var item = $(this).data('item');
								// Animate a particular item to the start of the frame.
								// If no item is provided, the whole content will be animated.
								$frame.sly('toStart', item);
							});

							// To End button
							$wrap.find('.toEnd').on('click', function () {
								var item = $(this).data('item');
								// Animate a particular item to the end of the frame.
								// If no item is provided, the whole content will be animated.
								$frame.sly('toEnd', item);
							});

							$( ".toStart" ).trigger( "click" );

							$slyLoaded = true;
						} else {
							$frame.sly(false);
							// Call Sly on frame
							$frame.sly($slySettings);

							// To Start button
							$wrap.find('.toStart').on('click', function () {
								var item = $(this).data('item');
								// Animate a particular item to the start of the frame.
								// If no item is provided, the whole content will be animated.
								$frame.sly('toStart', item);
							});

							// To End button
							$wrap.find('.toEnd').on('click', function () {
								var item = $(this).data('item');
								// Animate a particular item to the end of the frame.
								// If no item is provided, the whole content will be animated.
								$frame.sly('toEnd', item);
							});

							$( ".toStart" ).trigger( "click" );
						}
					}
				},
				error: function (e) {
					console.log(e.message);
				}
			});
		} else if(search.length == 0){
			$('#searchResults').html("");
		}

	    if(e.keyCode == 13)
	    {
	        $(this).trigger("enterKey");
	    }
	});
	$('#inputsearch').bind("enterKey",function(e){
		alert("test");
	});

});