
	Array.prototype.insert = function (index, item) {
	  this.splice(index, 0, item);
	};

	//pseudo-equivalent of php's isset()
	function exists($var) {
	    if(typeof $var != "undefined" && $var !== "" && $var != null) {
	    	return true;
	    } else {
	    	return false;
	    }
	}

	function shuffleArray(o){ 
		for(var j, x, i = o.length; i; j = Math.floor(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
		return o;
	};

	//remove precise from one dimensional array
	function grepArray($removeItem, $grepArray) {
		// $grepArray = jQuery.grep($grepArray, function(value) {
		// 	return value != $removeItem;
		// });
		// $grepArray = $grepArray.splice($.inArray($removeItem, $grepArray),1);
		return $grepArray.splice($.inArray($removeItem, $grepArray),1);
	}

	function removeFromArr(needle, haystack) {
	    var found = haystack.indexOf(needle);

	    while (found !== -1) {
	        haystack.splice(found, 1);
	        found = haystack.indexOf(needle);
	    }

	    return haystack;
	}

    function ObjectValToArray($object, $val, $array, $isInArray){    	
		for($objectVal in $object){
			if(exists($isInArray) && $isInArray){
				ObjectValToArray($object[$objectVal], $val, $array);
			} else {
			    $array.push(stringToSlug($object[$objectVal]));
			}
		}
		return $array;
    }

    //deletes duplicates
    function UniqueArray($array){
    	var uniqueNames = [];
		$.each($array, function(i, el){
		    if($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
		});
		return uniqueNames;
    }

    function stringToSlug(str) {
	  str = str.replace(/^\s+|\s+$/g, ''); // trim
	  str = str.toLowerCase();
	  
	  // remove accents, swap ñ for n, etc
	  var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
	  var to   = "aaaaeeeeiiiioooouuuunc------";
	  for (var i=0, l=from.length ; i<l ; i++) {
	    str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
	  }

	  str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
	    .replace(/\s+/g, '-') // collapse whitespace and replace by -
	    .replace(/-+/g, '-'); // collapse dashes

	  return str;
	}
      
    String.prototype.removeAccents = function(){
     return this
             .replace(/[áàãâä]/gi,"a")
             .replace(/[éè¨ê]/gi,"e")
             .replace(/[íìïî]/gi,"i")
             .replace(/[óòöôõ]/gi,"o")
             .replace(/[úùüû]/gi, "u")
             .replace(/[ç]/gi, "c")
             .replace(/[ñ]/gi, "n")
             .replace(/[^a-zA-Z0-9]/g," ");
    }

	function countInObject(obj) {
		var count = 0;
		// iterate over properties, increment if a non-prototype property
		for(var key in obj) if(obj.hasOwnProperty(key)) count++;
		return count;
	}

    function getRandomColor() {
      var randomColor = ('000000' + Math.floor(Math.random()*16777215).toString(16)).slice(-6);
      // var randomColor = Math.floor(Math.random()*16777215).toString(16);
      return randomColor;
    }
    
    function rgb2hex(rgb) {
	    rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
	    function hex(x) {
	        return ("0" + parseInt(x).toString(16)).slice(-2);
	    }
	    return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
	}

    (function($) {
	    $.fn.hasScrollBar = function() {
	        return this.get(0) ? this.get(0).scrollHeight > this.innerHeight() : false;
	    }
	})(jQuery);

	function sortObject($array,$needle,$flip) {
	    for(data in $array) {
	      var valueToSort = $array[data][$needle];
	      for (checkedData in $array){
	        if($array[data] != $array[checkedData]){
	          var $comparedData = $array[checkedData][$needle];
	          if(typeof $flip != "undefined" && $flip) {              
	            if(valueToSort >= $comparedData) {
	              var $tempObjectSort = $array[data];
	              var $tempObejctCompared = $array[checkedData];
	              $array[data] = $tempObejctCompared;
	              $array[checkedData] = $tempObjectSort;
	            }
	          } else if(typeof $flip == "undefined" || !$flip){
	            if(valueToSort <= $comparedData) {
	              var $tempObjectSort = $array[data];
	              var $tempObejctCompared = $array[checkedData];
	              $array[data] = $tempObejctCompared;
	              $array[checkedData] = $tempObjectSort;
	            }
	          }
	        }
	      }
	    }

	    return $array;
	}

	// Object.defineProperty(Object.prototype, "clone", {
	//     enumerable: false,
	//     writable: true,
	//     value: function () {
	//         var i, newObj = (this instanceof Array) ? [] : {};
	//         for (i in this) {
	//             if (i === 'clone') {
	//                 continue;
	//             }
	//             if (this[i] && typeof this[i] === "object") {
	//                 newObj[i] = this[i].clone();
	//             } else {
	//                 newObj[i] = this[i];
	//             }
	//         }
	//         return newObj;
	//     }
	// });

	var fuzzy_match = (function(){
	  var cache = _.memoize(function(str){
	    return new RegExp("^"+str.replace(/./g, function(x){
	      return /[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/.test(x) ? "\\"+x+"?" : x+"?";
	    })+"$");
	  })
	  return function(str, pattern){
	    return cache(str).test(pattern);
	  }
	})()

	function showError($element, $message, $time){
		if(!exists($time)){
			$time = 5000;
		}
		$element.text($message);
		$element.show('slide', { direction: 'up' }, 500);

		var hideError = true;
		if(exists($time) && $time =="none"){
			hideError = false;
		}
		if(hideError){
			setTimeout(function(){
					$element.hide('slide', { direction: 'up' }, 500, function(){
					$element.text('');
				});
			}, $time);
		}
	}

	function checkTextArea(field, rules, i, options){
		if (field.val().length < 3) {
		    return options.allrules.validateTextarea.alertText;
		}
	}

	function checkRedactor(field, rules, i, options){
        var redactorTextLen = $("iframe.redactor_frame").contents().find("div").html();
        redactorTextLen = $.trim(redactorTextLen);
        if(redactorTextLen.length <= 11){
			return options.allrules.validateRedactorArea.alertText;
        }
	}

	function checkFileInput(field, rules, i, options){
		if(!field.val()){
		    return options.allrules.validateFileInput.alertText;
		}
	}

	function checkFileInputImg(field, rules, i, options){
		if(!field.val()){
		    return options.allrules.validateFileInput.alertText;
		} else{			
            var val = field.val();
            var types = ['jpeg', 'jpg', 'png', 'gif'], ext = val.replace(/.*[.]/, '').toLowerCase();
            if (types.indexOf(ext) == -1) {
		    	return options.allrules.validateFileInputImg.alertText;
            } 
		}
	}

    function sleep(seconds) {
      seconds *=1000;
      var start = new Date().getTime();
      for (var i = 0; i < 1e7; i++) {
        if ((new Date().getTime() - start) > seconds){
          break;
        }
      }
    }

	//Fonctions pour surveiller changement dans élément du DOM
	$.fn.watch = function( id, fn ) {
	 
	    return this.each(function(){
	 
	        var self = this;
	 
	        var oldVal = self[id];
	        $(self).data(
	            'watch_timer',
	            setInterval(function(){
	                if (self[id] !== oldVal) {
	                    fn.call(self, id, oldVal, self[id]);
	                    oldVal = self[id];
	                }
	            }, 100)
	        );
	 
	    });
	 
	    // return self;
	};
	 
	$.fn.unwatch = function( id ) {
	 
	    return this.each(function(){
	        clearInterval( $(this).data('watch_timer') );
	    });
	 
	};

	$.fn.valuechange = function(fn) {
    	return this.bind('valuechange', fn);
	};
	 
	$.event.special.valuechange = {
	 
	    setup: function() {
	 
	        $(this).watch('value', function(){
	            $.event.handle.call(this, {type:'valuechange'});
	        });
	 
	    },
	 
	    teardown: function() {
	        $(this).unwatch('value');
	    }
	 
	};

	// $('input').bind('valuechange', function(){
 //    	console.log('Value changed... New value: ' + this.value);
	// });

	var loadedScripts=new Array();

	function loadScriptFiles(scriptArray){

	    if($.isArray(scriptArray)){
	        $.each(scriptArray, function(intIndex, objValue){
	            if($.inArray(objValue, loadedScripts) < 0){
	                $.getScript(objValue, function(){
	                    loadedScripts.push(objValue);
	                });
	            }
	        });
	    }
	    else{
	            if($.inArray(script, loadedScripts) < 0){
	                $.getScript(script, function(){
	                    loadedScripts.push(objValue);
	                });
	            }





	    }
	}

	if(!Array.indexOf){
		Array.prototype.indexOf = function(obj){
		    for(var i=0; i<this.length; i++){
		        if(this[i]==obj){
		            return i;
		        }
		    }
		    return -1;
		}
	}

	// Launch function only after jquery is loaded
	function defer(method) {
	    if (window.jQuery)
	        method();
	    else
	        setTimeout(function() { defer(method) }, 50);

	    // Example : 
	    // defer(function () {
	    //     alert("jQuery is now loaded");
	    // });
	}

	function dirname(path) {
	  //  discuss at: http://phpjs.org/functions/dirname/
	  //        http: //kevin.vanzonneveld.net
	  // original by: Ozh
	  // improved by: XoraX (http://www.xorax.info)
	  //   example 1: dirname('/etc/passwd');
	  //   returns 1: '/etc'
	  //   example 2: dirname('c:/Temp/x');
	  //   returns 2: 'c:/Temp'
	  //   example 3: dirname('/dir/test/');
	  //   returns 3: '/dir'

	  return path.replace(/\\/g, '/')
	    .replace(/\/[^\/]*\/?$/, '');
	}

	function basename(path) {
	   return path.split(/[\\/]/).pop();
	}
	

	// //sort arrays ascending, descending
	// var testarray = [0,9,8,5,6,4,7,23,58,4];
	// console.log(testarray.sort(function(a,b){return a-b})); //ascending
	// console.log(testarray.sort(function(a,b){return b-a})); //descending