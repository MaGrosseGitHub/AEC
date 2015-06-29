
$(function($){
		
	var filesData = []; 
	var getimgData = $("#inputimages_id").val();
	if(getimgData != ""){
		getimgData = JSON.parse(getimgData);
	}
	if( $.isArray(getimgData) && getimgData.length > 0) {
		filesData = getimgData;
	}
	$("#inputimages_id").val(JSON.stringify(filesData));

	var uploader = new plupload.Uploader({
		runtimes : 'html5,flash',
		containes: 'plupload',
		browse_button: 'browse',
		drop_element:"droparea",
		url : document.getElementById("urlCorrected").value+'process',
		flash_swf_url:'js/plupload/plupload.flash.swf',
		multipart : true,
		urlstream_upload:true,
		multipart_params:{directory:'test'},
		max_file_size:'10mb',
		resize : {width:800, height:600, quality:90},
		filters : [
			{ title : 'Images', extensions : 'jpg,gif,png'}
		],
	    multipart_params : {
	    }
		// multipart_params : {
	    //     "name1" : "value1",
	    //     "name2" : "value2"
	    // });
	});

	uploader.bind('Init',function(up, params){
		if(params.runtime != 'html5'){
			$('#droparea').css('border','none').find('p,span').remove();
		} 
	})

	uploader.bind('UploadProgress',function(up, file){
		$('#'+file.id).find('.progress').css('width',file.percent+'%');
	})

	uploader.init();

	uploader.bind('FilesAdded',function(up,files){
		uploader.settings.multipart_params.phpId = $("#inputid").val();
		var filelist = $('#filelist');
		for(var i in files){
			if (files.hasOwnProperty(i)) {
				var file = files[i]; 
				filelist.prepend('<div id="'+file.id+'" class="file">'+file.name+' ('+plupload.formatSize(file.size)+')'+'<div class="progressbar"><div class="progress"></div></div></div>');		
		    }
		}	
		$('#droparea').removeClass('hover');
		uploader.start();
		uploader.refresh();
	});


	uploader.bind('Error',function(up, err){
			alert(err.message);
			$('#droparea').removeClass('hover')
			uploader.refresh();
	});

	uploader.bind('FileUploaded',function(up, file, response){
		data = jQuery.trim(response);
		data = jQuery.trim(response.response);
		console.log(data);
		data = JSON.parse(data);
		if(data.error){
			alert(data.message); 
			$('#'+file.id).remove(); 
		}else{
			filesData.push(data.imgData); 
			$("#inputimages_id").val(JSON.stringify(filesData));
			$('#'+file.id).replaceWith(data.html); 
		}
	});


	$('#droparea').bind({
	   dragover : function(e){
	       $(this).addClass('hover'); 
	   },
	   dragleave : function(e){
	       $(this).removeClass('hover'); 
	   }
	});

	$('.del').live('click',function(e){
		e.preventDefault();
		var elem = $(this);
		if(confirm('Voulez vous vraiment supprimer cette image ?')){
			var imgName = elem.attr('href').replace("delete_img/", "");
			imgName = "img/galerie/"+imgName
			filesData = removeFromArr(imgName, filesData);
			$("#inputimages_id").val(JSON.stringify(filesData));
			imgName = basename(elem.attr('href'));
			imgName = imgName.replace("img/galerie/", "");
			$.ajax({
			  	method: "POST",
			  	url: document.getElementById("urlCorrected").value+"delete_img/",
			  	data: { id : $("#inputid").val() , img : imgName }
			}).done(function(data){
				console.log(data);
			});
			elem.parent().parent().slideUp(); 
		}
		return false; 
	});

	$('#deleteAllImgs').live('click',function(e){
		e.preventDefault();
		var elem = $(this);
		filesData = [];
		$("#inputimages_id").val(JSON.stringify(filesData));
		if(confirm('Voulez vous vraiment supprimer toutes les images ?')){
			$.ajax({
			  	method: "POST",
			  	url: document.getElementById("urlCorrected").value+"delete_img/",
			  	data: { id : $("#inputid").val() , img : "none", deleteAll : true }
			}).done(function(){
				$("#filelist").html("");
			});
		}
		return false; 
	});

})