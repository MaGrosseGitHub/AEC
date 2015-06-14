jQuery(function($){
  //----------------------------------------------------------------------------------------------------------------------------//
                              //-----------------------------------------------------------//
  var filtered = false;
  var customCSS = false;
  var filterObjects = {};
  var textParents, lastElement = "";
  var filterCallback, filterCheckButtonsObj = {}, divInputsNumber = 0;
  var filterCheckClass, filterUncheckClass, filterCookies;
  var startFilterData = false;
  var foundErrors = false;
  var pasteText = false, oldText;
  var prevFilterSorted = false;
  $.fn.DataFilter = function($settings) {
    var curElement = this;
    if(!exists($settings.update) || (exists($settings.update) && $settings.update) ){
      if(!filtered || curElement != lastElement){
        textParents = this.CreateFilter($settings);
        filtered = true;
        lastElement = this;
      }
    }

    $('filter').hide();
    $('filterInput').hide();

    if(exists(filterCallback.callback) && (!filterCallback.event || !exists(filterCallback.event))){
      filterCallback.callback(); //callback with no event
    }
    this.CheckFilters(textParents, divInputsNumber);
    filterCookies = this.checkCookies();
    this.ShowFilterErrors();
    startFilterData = true;
  }

                              //-----------------------------------------------------------//

  $.fn.GetFilterCookies = function(){
    return filterCookies;
  }
                              //-----------------------------------------------------------//

  $.fn.SetFilterCookies = function(){
    var setFilters;
    if(exists($.cookie('filters'))){
      setFilters = JSON.parse($.cookie('filters'));
    }
    return setFilters;
  }

                              //-----------------------------------------------------------//
  $.fn.CreateFilter = function($settings) {
    settings = $.extend({
      element : this, // element to filter
      filterTypes : {},  //type of filter(possible options : text, option, list, toggle, array[])
      filterInput : {}, //use existing dom element as filter buttons or input
      textParents : {}, //elements to hide or show for text inputs (if parents are not the same as settings.element)[use 'parentElem' if the element to hide is direct parent]
      div : false, //create filter element inside div with class "filterDiv"
      append : false, // append (true) or prepend(false) filter element to dom ()
      appendTo : undefined, //append filter buttons or filter div to dom element
      callback : undefined,//function to callback
      callbackEvent :undefined, //event to bind to callback
      checkedClass : "checked", // class to add when option is checked or input used
      uncheckedClass : "unchecked" // class to add when option is unchecked or input unused
    }, $settings);

    filterCheckClass = settings.checkedClass;
    filterUncheckClass = settings.uncheckedClass;


    filterInputDefaults = {
      type : ['parapente', 'parachute', 'aviation'],
      typeEvent : ['club', 'site', 'event'],
      site : "text",
      user : "text",
      club : "text",
      ImageVideo : ["image", "video"],
      date : ["ascending", "descending"],
      like : ["ascending", "descending"],
      vu : ["ascending", "descending"],
      comments : ["ascending", "descending"]
    }

    //find or save filter inputs
    var filterInputFound = false, filterDivInputs = [], divInputs = "";
    var sortElemFound = false;

    if($.isEmptyObject(settings.filterTypes)){
      console.log("Filter Plugin ==> Error : No filter inputs found in settings, trying automatic detection.")
    } 

    var filterInputArray = $.extend(filterInputDefaults, settings.filterTypes);
    var filterInputsTemp = [], filterInputs = settings.element.find('filter');
    //instead of going trough hundreds of elements, we only iterate through the number of element in the filterInputArray arrays
    if(filterInputs.length <= countInObject(filterInputArray)){
      var iterate = filterInputs.length;
    } else {
      var iterate = countInObject(filterInputArray);
    }
    for(var i = 0; i<iterate; i++){
      filterClasses = filterInputs.eq(i).attr("class");
      filterClasses = filterClasses.split(" ");
      filterClasses = filterClasses[0];
      if($.inArray(filterClasses, filterInputsTemp) == -1){
        filterInputsTemp.push(filterClasses);
      }
    }
    filterInputs = filterInputsTemp;

    var filterTextExists = false, filterTextInput = "";
    var filterElementsTemp = {};
    $.each(filterInputs, function(key, filterInput) {
      var divInputsTemp = "";
      //if filterInput exists in filterInputDefaults array
      if(exists(filterInputArray[filterInput])){
        //if filterInput isArray, create buttons from array values 
        var filterElementsArray = {}, filterElements = settings.element.find("filter."+filterInput);
        //if the filter does not have the class filterSort
        if(filterElements.attr("class").split(" ")[1] != "filterSort") { 
          //the values in the filter input are not empty
          if($.isArray(filterInputArray[filterInput])){
            divInputsTemp+= '<button class = "filterButton '+ filterInput +' cookieFilter" style = "display : none">cookie</button>';
            $.each(filterInputArray[filterInput], function(inputKey, InputValue){
              divInputsTemp += '<button class = "filterButton '+ filterInput +" "+ InputValue +'">'+ InputValue +'</button>';
            }); 
          } else if(filterInputArray[filterInput] == "option" || filterInputArray[filterInput] == "toggle" || filterInputArray[filterInput] == "list"){
            //if filterInput is "option", find the options and create buttons from values
            var filterElements = settings.element.find("filter."+filterInput);
            if(filterInputArray[filterInput] == "list") {
              divInputsTemp += '<select class = "filterSelect '+filterInput+'">'
              divInputsTemp += '<option class = "filterOption filterSort All" value = "All">All</option>'
            }
            if(filterInputArray[filterInput] == "option"){
              divInputsTemp+= '<button class = "filterButton '+ filterInput +' cookieFilter" style = "display : none">cookie</button>';
            }
            //create buttons for each type if input and add to array
            filterElements.each(function(optionKey, optionValue){ 
              if(!exists(filterElementsTemp[filterInput])){
                filterElementsTemp[filterInput] = [];
              }
              if($.inArray($(optionValue).text(), filterElementsTemp[filterInput]) == -1 && $(optionValue).text() != ""){
                filterElementsTemp[filterInput].push($(optionValue).text());
                if(filterInputArray[filterInput] == "option") {
                  divInputsTemp += '<button class = "filterButton '+ filterInput +" "+ $(optionValue).text() +'">'+ $(optionValue).text() +'</button>';
                } else if(filterInputArray[filterInput] == "toggle") {
                  divInputsTemp += '<button class = "filterButton toggle '+ filterInput +" "+ $(optionValue).text() +'">'+ $(optionValue).text() +'</button>';
                } else if(filterInputArray[filterInput] == "list") {
                  divInputsTemp += '<option class = "filterOption '+ filterInput +" "+ $(optionValue).text() +'" value = "'+ $(optionValue).text() +'">'+ $(optionValue).text() +'</option>';
                }
              }
            });           
            if(filterInputArray[filterInput] == "list") {
              divInputsTemp += '</select>'
            }
            filterElementsArray =  filterElementsTemp;
          } else if(filterInputArray[filterInput] == "text") {
            // if text input exists add new one
            if(filterTextExists){
              // $('.filterText').addClass(filterInput); 
              filterTextInput += " "+filterInput
            }

            //if type = text add text input
            if($(".filterText").length === 0 && filterTextInput == ""){
              divInputsTemp += '<filterTextInputHere>'; 
              filterTextExists = true;
              filterTextInput = filterInput;
            } 
          }
        } else {            
          //if the filter has the class filterSort          
          if($.isArray(filterInputArray[filterInput])){
            $.each(filterInputArray[filterInput], function(inputKey, InputValue){
              divInputsTemp += '<button class = "filterButton filterSort toggle '+ filterInput + ' ' + InputValue +'">'+ filterInput + " " + InputValue +'</button>';
            }); 
          } else {
            buttonsArray = ["ascending", "descending"];
            if(filterInputArray[filterInput] == "list") { 
              divInputsTemp += '<select class = "filterSelect filterSort '+filterInput+'">'                    
              divInputsTemp += '<option class = "filterOption filterSort none" value = "none">None</option>'                    
              $.each(buttonsArray, function(inputKey, InputValue){
                divInputsTemp += '<option class = "filterOption filterSort '+ InputValue+'" value = "'+ InputValue +'">'+ filterInput + " " + InputValue +'</option>';
              }); 
              divInputsTemp += '</select>'
            } else if(filterInputArray[filterInput] == "toggle" || filterInputArray[filterInput] == "option"){                
              $.each(buttonsArray, function(inputKey, InputValue){
                divInputsTemp += '<button class = "filterButton filterSort toggle '+ filterInput + ' ' + InputValue +'">'+ filterInput + " " + InputValue +'</button>';
              }); 
            }
          }
          sortElemFound = true;
        }

        if(!exists(settings.filterInput[filterInput])){
          divInputs += divInputsTemp;
        } else {    
          customCSS = true;    
          if($(settings.filterInput[filterInput]).length ===0){
            divInputs += divInputsTemp;
            console.log("Filter Plugin ==> Error : DOM element with '"+settings.filterInput[filterInput]+"' does not exist, creating it.")
          } else {
            var elementToAdd = $(settings.filterInput[filterInput]);
            var element = settings.filterInput[filterInput].replace(".","");
            var element = element.replace("#","");
            if($.isArray(filterInputArray[filterInput])){
              $.each(elementToAdd, function(inputKey, InputValue){
                var elementClass = $(this).attr("class").split(' ');
                var elementTypePos = $.inArray(element, elementClass)+1;
                var elementType = elementClass[(elementTypePos)];
                var elementValue = elementClass[(elementTypePos+1)];
                if($.inArray(elementValue,filterInputArray[filterInput]) != -1){
                  elementClass.insert(0, 'filterButton');
                  elementClass = elementClass.join(' ');
                  $(this).attr('class', elementClass);
                }
              }); 
            } else if(filterInputArray[filterInput] == "option" || filterInputArray[filterInput] == "toggle" || filterInputArray[filterInput] == "list") {              
                elementToAdd.append(divInputsTemp);
            } else if(filterInputArray[filterInput] == "text"){
              if(elementToAdd.is( "input:text" )){                
                var elementClass = elementToAdd.attr("class").split(' ');
                var elementTypePos = $.inArray(element, elementClass)+1;
                var elementType = elementClass[(elementTypePos)];
                elementClass.insert(0, 'filterText');
                elementClass = elementClass.join(' ');
                elementToAdd.attr('class', elementClass);
              } else{ 
                elementToAdd.append(divInputsTemp);
              }
            }
          }          
        }
      } 
    });

    divInputs += '<button class="resetFilters">reset</button>';
    //add error div
    var errorDiv = '<div class = "filterErrors" style = "display : none;"></div>'
    divInputs +=errorDiv;
    divInputs += "</div>"; //end of filterInputX div


    if(filterTextExists){
      divInputs = divInputs.replace("<filterTextInputHere>", '<input type = "text" class = "filterText '+filterTextInput+'" />');
    }

    //Create filter Div
    var filterDivNumber = $('div[class^="filterInputs"]').length;
    divInputsNumber = filterDivNumber;
    var divInputsTop = '<div class = "filterInputs'+filterDivNumber+'">';
    divInputs = divInputsTop+divInputs;
    if(settings.div) {      
        var filterDiv = '<div class = "filterDiv">';
        if(exists(divInputs)){
          filterDiv += divInputs;
        }
        filterDiv += "</div>";
    } else {      
      if(exists(divInputs)){
        var filterDiv = divInputs;
      }
    }

    //Append filterInputs or filterDiv to fom element
    if(settings.appendTo){
      var appendElement = settings.appendTo;
    } 

    if(sortElemFound) {
      filterDiv = $(filterDiv).ChangeSortInputs([settings.checkedClass, settings.uncheckedClass]);
    }

    //if filter input(s) are defined no need to add new filter buttons
    if(!filterInputFound) {
      if(typeof appendElement != "undefined" && appendElement != "") {
        if(settings.append) {
          appendElement.append($(filterDiv));
        } else {
          appendElement.prepend($(filterDiv));
        }
      } else {
        console.log("Filter Plugin ==> Error : No DOM element to append filter inputs to.")
      }
    }

    if(pasteText && (exists($settings.reAddText) && $settings.reAddText) ){
      $(".filterDiv:first").find('div[class^="filterInputs"]:first').prepend(oldText);
    }
    if(filterTextExists){
      pasteText = true;
      oldText = '<input type = "text" class = "filterText '+filterTextInput+'" />';
    }

    //Save callback in global varibale
    filterCallback = {};    
    if(!$.isArray(settings.callbackEvent)){
      settings.callbackEvent = [settings.callbackEvent];
    }  
    if(!$.isArray(settings.callback)){
      settings.callback = [settings.callback];
    }
    filterCallback.callback = settings.callback;
    filterCallback.event = settings.callbackEvent;

    if(exists(settings.textParents)){
      return settings.textParents;
    }
  }
                              //-----------------------------------------------------------//
  $.fn.CheckFilters = function($textParents, divInputsNumber){
    $element = this;
    // check for filterDiv of divInputs
    if($("div.filterDiv").length !== 0){
      var filterDiv = $("div.filterDiv");
      var divInputs = filterDiv.find("div.filterInputs"+divInputsNumber);
    } else if($("div.filterDiv").length === 0 && $("div.filterInputs").length !== 0) {
      var divInputs = filterDiv.find("div.filterInputs"+divInputsNumber);
    } 

    if(customCSS){
      //Corriger problée avec ligne en dessous (qui ne détécte pas les boutons existants)
      //modifier les fonctions de text et option pour commencer à partir de la position ou se trouve .filterXXX plûtot que directement à zero
      // var divInputs = $($('*[class^="filter"]'));
      customCSS = false;
    }


    // console.log(divInputs.html());
    filterObjects = {};
    // check for inputs
    if(divInputs.find("button").length !== 0){
      var filterButtons = divInputs.find("button.filterButton");
      filterButtons.each(function(buttonKey, buttonValue){
        var ButtonClass = $(buttonValue).attr("class");
        ButtonClass = ButtonClass.split(" ");
        if($.inArray("filterSort", ButtonClass) == -1) {
          if($.inArray("toggle", ButtonClass) != -1){
            var togglePosition = $.inArray("toggle", ButtonClass);
            var inputType = "toggle";
          } else {
            var togglePosition = $.inArray("filterButton", ButtonClass);
            var inputType = "button";
          }
          if(!exists(filterObjects[ButtonClass[(togglePosition+1)]])){
            filterObjects[ButtonClass[(togglePosition+1)]] = {};
            filterObjects[ButtonClass[(togglePosition+1)]].inputType = inputType;
            filterObjects[ButtonClass[(togglePosition+1)]].inputName = ButtonClass[(togglePosition+1)];
            filterObjects[ButtonClass[(togglePosition+1)]].inputs = [];              
          } 
          if($.inArray(ButtonClass[(togglePosition+2)], filterObjects[ButtonClass[(togglePosition+1)]].inputs) == -1) {
            filterObjects[ButtonClass[(togglePosition+1)]].inputs.push(ButtonClass[(togglePosition+2)]);
            divInputs.find("button."+ButtonClass.join(".")).live('click', function() {
              $(this).Activefilter(inputType, ButtonClass[(togglePosition+2)], filterObjects[ButtonClass[(togglePosition+1)]], $element);
              if($.inArray("click", settings.callbackEvent) != -1){
                var callbackEventPos = $.inArray("click", settings.callbackEvent);
                if(exists(settings.callback[callbackEventPos])) {
                  settings.callback[callbackEventPos]();
                }
              }
              return false;
            });
          }
        } else if($.inArray("filterSort", ButtonClass) != -1){
          // console.log("sortToggle"); 
          var inputType = "sortToggle";
          var togglePosition = $.inArray("toggle", ButtonClass);
          // console.log(togglePosition);        
          if(!exists(filterObjects[ButtonClass[(togglePosition+1)]])){
            filterObjects[ButtonClass[(togglePosition+1)]] = {};
            filterObjects[ButtonClass[(togglePosition+1)]].inputType = inputType;
            filterObjects[ButtonClass[(togglePosition+1)]].inputName = ButtonClass[(togglePosition+1)];
            filterObjects[ButtonClass[(togglePosition+1)]].inputs = [];              
          } 
          if($.inArray(ButtonClass[(togglePosition+2)], filterObjects[ButtonClass[(togglePosition+1)]].inputs) == -1) {
            filterObjects[ButtonClass[(togglePosition+1)]].inputs.push(ButtonClass[(togglePosition+2)]);
            $("button."+ButtonClass.join(".")).click(function() {
              $(this).Activefilter(inputType, ButtonClass[(togglePosition+2)], filterObjects[ButtonClass[(togglePosition+1)]], $element);
              if($.inArray("click", settings.callbackEvent) != -1){
                var callbackEventPos = $.inArray("click", settings.callbackEvent);
                if(exists(settings.callback[callbackEventPos])) {
                  settings.callback[callbackEventPos]();
                }
              }
              return false;
            });
          }
        }
      });
    } 

    if(divInputs.find("select").length !== 0) {
      var filterSelect = divInputs.find("select");
      filterSelect.each(function(){
        var selectClass = $(this).attr('class').split(" ");
        var filterOptions = $(this).find("option.filterOption");
        var activeFilterSettings, inputType = "";
        filterOptions.each(function(){
          var optionClass = $(this).attr("class").split(" ");
          if($.inArray("filterSort", selectClass) == -1){
            inputType = "list";
            if(!exists(filterObjects[selectClass[1]])){
              filterObjects[selectClass[1]] = {};
              filterObjects[selectClass[1]].inputType = inputType;
              filterObjects[selectClass[1]].inputName = selectClass[1];
              filterObjects[selectClass[1]].inputs = [];              
            } 
            if($.inArray(optionClass[2], filterObjects[selectClass[1]].inputs) == -1) {
              filterObjects[selectClass[1]].inputs.push(optionClass[2]);
            }
            activeFilterSettings = filterObjects[selectClass[1]];
          } else {
            inputType = "sortList";
            if(!exists(filterObjects[selectClass[2]])){
              filterObjects[selectClass[2]] = {};
              filterObjects[selectClass[2]].inputType = inputType;
              filterObjects[selectClass[2]].inputName = selectClass[2];
              filterObjects[selectClass[2]].inputs = ["ascending", "descending"];              
            } 
            activeFilterSettings = filterObjects[selectClass[2]];
          }
        });
        $(this).change(function() {
          var optionSelected = $("option:selected", this);
          if(inputType == "sortList"){
            var inputValue = optionSelected.val();
          } else{
            var inputValue = optionSelected.text();
          }
          $(this).Activefilter(inputType, inputValue, activeFilterSettings, $element);
          if($.inArray("change", settings.callbackEvent) != -1){
            var callbackEventPos = $.inArray("change", settings.callbackEvent);
            if(exists(settings.callback[callbackEventPos])) {
              settings.callback[callbackEventPos]();
            }
          }
          return false;
        });
      });
    }

    if(divInputs.find("input:text.filterText").length !== 0){
      var textFilters = divInputs.find("input:text.filterText");
      var inputType = "text";
      var inputClasses = textFilters.attr("class").split(" ");
      var filterPosition = $.inArray("filterText", inputClasses);
      inputClasses = inputClasses.splice((filterPosition+1),(inputClasses.length-filterPosition));
      $.each(inputClasses, function(key, value){
        if(!exists(filterObjects[value])){
          filterObjects[value] = {};
          filterObjects[value].inputType = inputType;
          filterObjects[value].inputName = value;        
          filterObjects[value].inputClass = textFilters.attr("class");        
        } 
        textFilters.live('keyup', function() {
          var filterSearch = $(this).val();
          $(this).Activefilter(inputType, filterSearch, inputClasses, $element, $textParents);
          if($.inArray("keyup", settings.callbackEvent) != -1){
            var callbackEventPos = $.inArray("keyup", settings.callbackEvent);
            if(exists(settings.callback[callbackEventPos])) {
              settings.callback[callbackEventPos](filterSearch);
            }
          }
        });
      });      

      var resetElem = $(this);
      $('button.resetFilters').click(function(){
        resetElem.DeleteFilterCookies();
      });

    }

  }

                              //-----------------------------------------------------------//
  $.fn.Activefilter = function($type, $input, $inputArray, $elementEvent, $textParents){
    if($type == "button" || $type == "toggle" || $type == "list"){
      $elementEvent.ButtonListFilter($input, $(this), $type, $inputArray);
    } else if($type == "text"){
      $elementEvent.TextFilter($input, $textParents, $inputArray);
    } else if($type == "sortToggle" || $type == "sortList"){
      $elementEvent.SortFilter($input, $type, $inputArray);
    }

    $(this).ShowFilterErrors();
  }
                              //-----------------------------------------------------------//
  $.fn.ButtonListFilter = function($button, $buttonDom, $buttonType, $settings){   
    var nbActiveButtons = 0;
    $buttonDom.closest("div[class^='filterInputs']").find('button.filterButton').each(function(){
      if($(this).hasClass(filterCheckClass)){
        nbActiveButtons++;
      }
    });

    var filterErrorDiv = $buttonDom.closest("div[class^='filterInputs']").find('div.filterErrors');
    if(nbActiveButtons <= 2 && startFilterData && $buttonDom.hasClass(filterCheckClass)){
      filterErrorDiv.text('Au moins un filtre doit resté actif.');
      filterErrorDiv.show('slide', { direction: 'up' }, 500);
      setTimeout(function(){
        filterErrorDiv.hide('slide', { direction: 'up' }, 500, function(){
          filterErrorDiv.text('');
        });
      }, 5000);
      return false;
    }

    if(!exists($settings.filteredInputs)){
      $settings.filteredInputs = [];
    }
    var filters = {};
    if(exists($.cookie('filters'))){
      filters = JSON.parse($.cookie('filters'));
      if(exists(filters[$settings.inputName])) {
        $settings.filteredInputs = filters[$settings.inputName];
      }
    }

    if($buttonType == "button"){
      if($.inArray($button, $settings.filteredInputs) == -1){
        $settings.filteredInputs.push($button);
        filters[$settings.inputName] = $settings.filteredInputs;
        filtersCookie = JSON.stringify(filters);
        var filterExpiration = (Date.parse(new Date())/1000) + (365*24*3600);
        var filterDomain = window.location.host;
        $.cookie('filters', filtersCookie, { expires : filterExpiration, path: "/", domain: null });
        // $.cookie('filters', filtersCookie, { expires : filterExpiration, path: "/", domain: filterDomain });
      } else {
        $settings.filteredInputs = jQuery.grep($settings.filteredInputs, function(value) {
            return value != $button;
        });
        filters[$settings.inputName] = $settings.filteredInputs;
        filtersCookie = JSON.stringify(filters);
        var filterExpiration = (Date.parse(new Date())/1000) + (365*24*3600);
        var filterDomain = window.location.host;
        $.cookie('filters', filtersCookie, { expires : filterExpiration, path: "/", domain: null });
        // $.cookie('filters', filtersCookie, { expires : filterExpiration, path: "/", domain: filterDomain });
      }
    }
    if($buttonType == "button"){
      if($buttonDom.hasClass(filterCheckClass)){
        $buttonDom.removeClass(filterCheckClass);
        $buttonDom.addClass(filterUncheckClass);
      } else{
        if($buttonDom.hasClass(filterUncheckClass)){
          $buttonDom.removeClass(filterUncheckClass);
        }
        $buttonDom.addClass(filterCheckClass);
      }
    } else if ($buttonType == "toggle"){
      if(!exists(filterCheckButtonsObj[$settings.inputName])){
        filterCheckButtonsObj[$settings.inputName] = [];
      }
      if($.inArray($buttonDom, filterCheckButtonsObj[$settings.inputName]) == -1){
        $.each(filterCheckButtonsObj[$settings.inputName], function(buttonKey){
          filterCheckButtonsObj[$settings.inputName][buttonKey].addClass(filterUncheckClass);
          filterCheckButtonsObj[$settings.inputName][buttonKey].removeClass(filterCheckClass);
        });
        filterCheckButtonsObj[$settings.inputName] = [];
        filterCheckButtonsObj[$settings.inputName].push($buttonDom);
        $buttonDom.removeClass(filterUncheckClass);
        $buttonDom.addClass(filterCheckClass);
      }
    }

    this.each(function(){
      $filteredElement = $(this).find("filter."+$settings.inputName);
      $filteredElementValue = $filteredElement.text();
      if($filteredElement.length > 1){
        $filteredElementValue = $filteredElement.first().text();
      }
      if($buttonType == "button"){
        if($.inArray($filteredElementValue, $settings.filteredInputs) != -1){
          $(this).show(200);
        } else{        
          $(this).hide(200);
        }
      } else if($buttonType == "toggle" || $buttonType == "list"){
        if($filteredElementValue == $button && $button != "All"){
          $(this).show(200);
        } else if($button == "All"){
          $(this).show(200);
        } else{          
          $(this).hide(200);
        }
      }
    });

  }

  $.fn.TextFilter = function($search, $textParents, $settings){
    $filteredTextElements = $(this);
    $.each($settings, function(settingKey, settingVal){
      var parentElem = false;
      var noFilterTextResults = true;

      curTextFilter = filterObjects[settingVal];
      if(exists($textParents) && exists($textParents[curTextFilter.inputName])){
        if($textParents[curTextFilter.inputName] != "parentElem"){
          var parentElements = $($textParents[curTextFilter.inputName]);
        } else{
          var parentElements = $("filter."+curTextFilter.inputName);
          parentElem = true;
          // var parentElements = $(this);
        }
      } else {
        var parentElements = $filteredTextElements;
        parentElem = true;
      }

      var selectedElements = [];
      var textElements = $filteredTextElements.find("filter."+curTextFilter.inputName);
      var shownElements = [];
      textElements.each(function(elementKey, elementValue){
        if(fuzzy_match($(elementValue).text(), $search)){
          noFilterTextResults = false;
          if(!parentElem) {
            parentElements.each(function(){
              var parentClass = $(this).attr("class").split(' ');
              if($.inArray($(elementValue).text(), parentClass) != -1){
                shownElements.push($(this));
              }  
              if($search != ""){
                $(this).hide();
              } else {
                $(this).show();
              }
            });
          } else {
            $(elementValue).parent().show();
          }
        } else{
          if($search != "" && !parentElem){
            parentElements.hide();
          } else if($search != "" && parentElem) {
            $(elementValue).parent().hide();
          }
        } 
      });

      $.each(shownElements, function(){
        $(this).show();
      });
      if(noFilterTextResults) {
        foundErrors = true;
        textElements.each(function(elementKey, elementValue){
          parentElements.each(function(){
            $(this).show();
          });
        });
      }

    });
  }

  $.fn.SortFilter = function($button, $buttonType, $settings){
    var elementParent = this.parent();
    var SortObjArray = {};
    if($button == "ascending"){
      var flip = false;
    } else if($button == "descending"){
      var flip = true;
    } else if($button == "resetSort"){
      var flip = false;
    } else {
      flip = false;
    }

    if($button != "resetSort") {
      var elementRank = 0;
      if($buttonType == "sortToggle" || $buttonType == "sortList"){
        this.each(function(key){
          SortObjArray[key] = {};
          SortObjArray[key].inputValue = $(this).find('filter.'+$settings.inputName).text();
          SortObjArray[key].inputDom = $(this);
          if(typeof $(this).attr('data-rank') !== 'undefined' && $(this).attr('data-rank') !== false) {
            elementRank = $(this).attr('data-rank')+1;
          } else {
            $(this).attr('data-rank', elementRank++);
          }
        });

        SortObjArray =  sortObject(SortObjArray, 'inputValue', flip);
        $.each(SortObjArray, function(ObjKey){
          elementParent.append(SortObjArray[ObjKey].inputDom).hide().show(200);
        });
      }
      prevFilterSorted = true;
    } else {
      resetSortElem = this;
      this.detach().sort(function(a,b) {
          return $(a).attr('data-rank') - $(b).attr('data-rank');  
      });
      $.each(resetSortElem, function(ObjKey){
        elementParent.append(resetSortElem[ObjKey]).hide().show(200);
      });
    }
  }
                                //-----------------------------------------------------------//
  $.fn.checkCookies = function($sort){
    var $checkedFilterElem = $(this);
    if(!exists($sort) || !$sort){     
      if(exists($.cookie('filters'))){
        filters = JSON.parse($.cookie('filters'));
        $.each(filters, function(filterName, filterValues){
          if(filterValues.length != 1){
            if($('button.filterButton.'+filterName+'.cookieFilter').length != 0){
              $('button.filterButton.'+filterName+'.cookieFilter').trigger("click");
              $.each(filterValues, function(filterKey, filterButton){
                $('button.filterButton.'+filterName+'.'+filterButton).removeClass(filterUncheckClass);
                $('button.filterButton.'+filterName+'.'+filterButton).addClass(filterCheckClass);
              });
            }
          }
        });

        $('button.filterButton').each(function(){
          if(!$(this).hasClass(filterCheckClass)){
            $(this).addClass(filterUncheckClass);
          }
        });
        return filters;
      } else{
        if($.cookie('filters') == null || $.cookie('filters') == ""){
          $('button.filterButton').each(function(){
            if(!$(this).hasClass('filterSort')){
              if($(this).hasClass(filterCheckClass)){
                $(this).removeClass(filterUncheckClass);
              } else {
                $(this).trigger('click');
                $(this).addClass(filterCheckClass);
                $(this).removeClass(filterUncheckClass);
              }
            } else {
              $(this).addClass(filterUncheckClass);
              if(prevFilterSorted) {
                $checkedFilterElem.SortFilter('resetSort');
              }
            }
          });
        }
      }

    } else {
      $checkedFilterElem.SortFilter('resetSort');
    }

    $('button.cookieFilter').removeClass(filterCheckClass);
    $('button.cookieFilter').addClass(filterUncheckClass);

  }
                                //-----------------------------------------------------------//
                                //-----------------------------------------------------------//
  $.fn.DeleteFilterCookies = function(){
    if(exists($.cookie('filters'))){   
        $.cookie('filters', "", {path: "/", domain: null });
        // $.cookie('filters', "", {path: "/", domain: filterDomain });
        this.checkCookies();
    } else {
      this.checkCookies(true);
    }
  }
                                //-----------------------------------------------------------//
  $.fn.ChangeSortInputs = function($checkClasses){
    var filterSortButtonCheck, filterSortButtonUncheck;
    if(exists($checkClasses)){
      filterSortButtonCheck = $checkClasses[0];
      filterSortButtonUncheck = $checkClasses[1];
    } else {
      filterSortButtonCheck = 'checked';
      filterSortButtonUncheck = 'unchecked';
    }

    var filterSortArr = [];
    var FilterSortNewInput= '<select class = "filterSortList">'
    var filterDivChange = $(this);
    filterDivChange.find('.filterSort').each(function(){
      filterSortClasses = $(this).attr('class').split(" ");
      if($.inArray(filterSortClasses[3], filterSortArr) == -1){
        filterSortArr.push(filterSortClasses[3]);
        FilterSortNewInput += '<option class = "filterSort'+filterSortClasses[3]+'" value = "'+$(this).attr('class')+'">'+ filterSortClasses[3] +'</option>';    
      } 
      $(this).hide();
    });
    FilterSortNewInput += '</select>'
    FilterSortNewInput += '<button id = "filterSortButtons" class = "filterSortAsc '+filterSortButtonUncheck+'">/\\</button>';
    FilterSortNewInput += '<button id = "filterSortButtons" class = "filterSortDesc '+filterSortButtonUncheck+'">\\/</button>';

    filterReset = filterDivChange.find('div[class^="filterInputs"]:first').find('button.resetFilters');
    filterDivChange.find('div[class^="filterInputs"]:first').find('button.resetFilters').remove();
    filterDivChange.find('div[class^="filterInputs"]:first').append(FilterSortNewInput);
    filterDivChange.find('div[class^="filterInputs"]:first').append(filterReset);

    // $('#filterSortButtons').live('click', function(){
    filterDivChange.find('#filterSortButtons').on('click', function(){

      // console.log(filterDivChange.find('div[class^="filterInputs"]:first'));
      console.log($(this).closest('div[class^="filterInputs"]'));
      filterSortListClass = $(this).closest('div[class^="filterInputs"]').find('.filterSortList').val();
      filterSortButtonClass = $(this).attr('class').replace('filterSort', '').replace(filterSortButtonUncheck, '').replace(filterSortButtonCheck, '').replace(' ', '').toLowerCase();
      filterSortButtonClass += 'ending';
      filterSortListClass = findSortButton(filterSortListClass);

      filterSortButton = $(this).closest('div[class^="filterInputs"]').find('button.'+filterSortListClass+'.'+filterSortButtonClass);
      filterSortButton.click();

      if(filterSortButtonClass == "ascending"){
        $(this).removeClass(filterSortButtonUncheck);
        $(this).addClass(filterSortButtonCheck);
        $('.filterSortDesc').addClass(filterSortButtonUncheck);
        $('.filterSortDesc').removeClass(filterSortButtonCheck);
      } else {
        $(this).removeClass(filterSortButtonUncheck);
        $(this).addClass(filterSortButtonCheck);
        $('.filterSortAsc').addClass(filterSortButtonUncheck);
        $('.filterSortAsc').removeClass(filterSortButtonCheck);
      }
    });

    function findSortButton($buttonClass){
      $buttonClass = $buttonClass.split(' ');
      $buttonClass.pop();
      $buttonClass = $buttonClass.join('.');

      return $buttonClass;
    }

    return filterDivChange;
  }
                                //-----------------------------------------------------------//
  $.fn.ShowFilterErrors = function(){
    if(foundErrors){ 
      var filterErrorDiv = $(this).closest("div[class^='filterInputs']").find('div.filterErrors');
      filterErrorDiv.text('Aucun résultats trouvé.');
      filterErrorDiv.show('slide', { direction: 'up' }, 500);
      setTimeout(function(){
        filterErrorDiv.hide('slide', { direction: 'up' }, 500, function(){
          filterErrorDiv.text('');
        });
      }, 5000);
    }
  }
                                //-----------------------------------------------------------//
});