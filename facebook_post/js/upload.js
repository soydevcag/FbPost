$(document).ready(function(){
	$('#buttonShare').hide();
	var files;

	// Add events
	$('#filePhoto').on('change', prepareUpload);

	// Grab the files and set them to our variable
	function prepareUpload(event) {
	  $("#uploader").LoadingOverlay("show",{
		image       : "",
	    fontawesome : "fa fa-refresh fa-spin"
	});
	  files = event.target.files;
	  uploadFiles(event);
	}

	// Catch the form submit and upload the files
	function uploadFiles(event) {
	    event.stopPropagation(); // Stop stuff happening
	    event.preventDefault(); // Totally stop stuff happening
		
			// Create a formdata object and add the files
		    var data = new FormData();
		    $.each(files, function(key, value) {
		        data.append(key, value);
		    });
		
		    $.ajax({
		        url: 'upload.php?files',
		        type: 'POST',
		        data: data,
		        cache: false,
		        dataType: 'json',
		        processData: false, 
		        contentType: false, 
		    }).done(function(msg) {
			    if( msg.success ){
				    $("#uploader").LoadingOverlay("hide");
				    $('#buttonShare').fadeIn('slow');
			    } else {
				    alert(msg);
			    }
			})
		return false;
	}
	
});