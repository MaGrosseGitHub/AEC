
$(function($){

	var album = "";
	var prevAlbum = "";
	// console.log($('#album'));
	var useAlbum = $("input[name=album]");
	$(".album").hide();
	$(".newAlbum").hide();

	useAlbum.change(function() {
		if(useAlbum.is(':checked') || addToAlbum){
			$(".album").show();
			chooseAlbum();
			$("#inputalbumSelect").change(function() {
				chooseAlbum();
			});
		} else {
			album = "";
		  	$(".album").hide();
		}
	});

	function chooseAlbum($albumName) {	
		prevAlbum = album;
		if(typeof $albumName == "undefined" || $albumName == ""){
			album = $("#inputalbumSelect :selected").text();
		} else {
			album = $albumName;
		}
		if(prevAlbum == ""){
			prevAlbum = album;
		}
	}

	$(".createAlbum").click(function(){
		$(".newAlbum").show();
	});

	 $('#newAlbumForm').on('submit', function() {
         $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action')+"/"+$("#inputnewAlbum").val(),
                data: $(this).serialize(), 
                success: function(response) {
					response = jQuery.trim(response);
					response = $.parseJSON(response);
					alert(response);
					$(".album").hide();
                },
                error: function (xhr, status, error) {
                  // console.log(status, error); 
                }, 
                complete: function (xhr, status) {
                 // console.log(status); 
               }
        });

        return false;
      });

	var uploader = new plupload.Uploader({
		runtimes : 'html5,flash',
		containes: 'plupload',
		browse_button: 'browse',
		drop_element:"droparea",
		url : 'process',
		flash_swf_url:'js/plupload/plupload.flash.swf',
		multipart : true,
		urlstream_upload:true,
		multipart_params:{directory:'test'},
		max_file_size:'10mb',
		resize : {width:800, height:600, quality:90},
		filters : [
			{ title : 'Images', extensions : 'jpg,gif,png'}
		]
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
		var filelist = $('#filelist');
		for(var i in files){
			var file = files[i]; 
			filelist.prepend('<div id="'+file.id+'" class="file">'+file.name+' ('+plupload.formatSize(file.size)+')'+'<div class="progressbar"><div class="progress"></div></div></div>');
		}	
		$('#droparea').removeClass('hover');
		if(typeof album != "undefined" && album != "") {
			for(var image in uploader.files){
				// console.log("oldAlbum : "+prevAlbum);
				// console.log("AvaA : "+uploader.files[image].name);
				var addAlbum = uploader.files[image].name.replace(prevAlbum+"/", "");
				// console.log("TS : "+addAlbum);
				// console.log("AveA : "+album+"/"+uploader.files[image].name);
				var addAlbum = album+"/"+uploader.files[image].name;
				uploader.files[image].name = addAlbum;	
				// console.log("Result : "+uploader.files[image].name);
			}
		}
		// console.log(uploader);
		uploader.start();
		uploader.refresh();
	});

	// uploader.file(0,"testAlbum",0);

	uploader.bind('Error',function(up, err){
			alert(err.message);
			$('#droparea').removeClass('hover')
			uploader.refresh();
	});

	uploader.bind('FileUploaded',function(up, file, response){
		// console.log(response);
		console.log(response.response);
		data = jQuery.trim(response);
		data = jQuery.trim(response.response);
		data = $.parseJSON(data);
		if(data.error){
			alert(data.message); 
			$('#'+file.id).remove(); 
		}else{
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
			$.get('upload.php',{action:'delete',file:elem.attr('href')});
			elem.parent().parent().slideUp(); 
		}
		return false; 
	});

})