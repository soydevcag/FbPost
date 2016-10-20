	var imageLoader = document.getElementById('filePhoto');
	imageLoader.addEventListener('change', handleImage, false);

	function handleImage(e) {
	    var reader = new FileReader();
	    reader.onload = function (event) {
	        $('#uploader img').attr('src',event.target.result);
	    }
	    reader.readAsDataURL(e.target.files[0]);  
	}

	var dropbox;
	dropbox = document.getElementById("uploader");
	dropbox.addEventListener("dragenter", dragenter, false);
	dropbox.addEventListener("dragover", dragover, false);
	dropbox.addEventListener("dragleave", dragleave, false);
	dropbox.addEventListener("drop", drop, false);
	
	function dragenter(e) {
	  e.stopPropagation();
	  e.preventDefault();
	}
	
	function dragleave(e) {
	  $('#uploader').css('background','none');
	  e.stopPropagation();
	  e.preventDefault();
	}
	
	function dragover(e) {
	  $('#uploader').css('background','orange');
	  e.stopPropagation();
	  e.preventDefault();
	}
	
	function drop(e) {
	  $('#uploader').css('background','none');
	  e.stopPropagation();
	  e.preventDefault();
	  var dt = e.dataTransfer;
	  var files = dt.files;
	  imageLoader.files = files;
	}