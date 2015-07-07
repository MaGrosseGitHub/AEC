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
        $('#view').load(url, function(){ 
        	$("#loader").show();
	      	$(".actu").hide('slide', { direction: 'down' }, 500);
	      	$(".news").show('slide', { direction: 'down' }, 500);
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
					$(".actu").show('slide', { direction: 'down' }, 500);
					$('.news').hide('slide', { direction: 'up' }, 500);
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
				// if(prevPageTitle == "Evenements") {
				// 	$('.md-history').trigger( "click" );
				// 	$('title').text(prevPageTitle);
				// } 

	        	// console.log("NULL - FOUND Prev");
			} else{
				if($("title").text() == "Index") {
					$(".actu").show('slide', { direction: 'down' }, 500);
					$('.news').hide('slide', { direction: 'up' }, 500);
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
				// var checkEvent = new RegExp('\\b' + 'Evenements' + '\\b', 'gi');
				// var checkEvents = new RegExp('\\b' + 'events' + '\\b', 'gi');
				// var titleToCheck = $("title").text();
				// var linkToCheck = document.location.pathname;
				// if(titleToCheck.match(checkEvent) && $("title").text() != "Evenements" && linkToCheck.match(checkEvents)) {
				//     window.location.replace(document.location.pathname);
	   //      	} 		

				// var checkIndex = new RegExp('\\b' + 'Index' + '\\b', 'gi');
				// var titleToCheck = $("title").text();
				// var linkToCheck = document.location.pathname;
				// if(titleToCheck.match(checkIndex) && $("title").text() != "Index") {
				//     prevPageTitle = "Index";
	   //      	}

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
	                url: 'http://localhost/POO3/webroot/lookFor/users/logout',
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

});