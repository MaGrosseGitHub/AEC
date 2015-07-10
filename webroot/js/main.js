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

	$("#inputsearch").keyup(function(e) {
		var search = $(this).val();
		var data = search;
		data = data.replace(' ', '+');

		if(search.length >= 3){
			console.log(data);
			console.log(window.location);
			// var pathname = "<?php echo $_SERVER['PATH_INFO']; ?>"; 
			// var pathnameController = pathname.replace("/index","");
			// pathname = window.location.href.replace(pathname,""); 
			// var lookFor = pathname+"/lookFor"+pathnameController+"/weather/"+$markerLocation+"/"+$markerIdBdd;
			// lookFor = lookFor.replace("#","");
			$.ajax({
				type: 'GET',
				url: window.location.origin+'/AEC/webroot/lookFor/search/preview/'+data,
				success: function (response) {
					// console.log(response);
					$('#searchResults').html(response);
					console.log(response);
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