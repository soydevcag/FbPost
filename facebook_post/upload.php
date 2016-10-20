<?php
	session_start();
	$data = array();

	if(isset($_GET['files'])) {  
	    $error = false;
	    $files = array();
	    $uploaddir = 'uploads/';
	    $uploadOk = 1;
	    foreach($_FILES as $file) {
	        if(move_uploaded_file($file['tmp_name'], $uploaddir .basename($file['name']))) {
		            $_SESSION['photoPath'] = $uploaddir . basename($file["name"]);
					$_SESSION['imageFileType'] = pathinfo($_SESSION['photoPath'],PATHINFO_EXTENSION);
					$_SESSION['tmp_name'] =$file["tmp_name"];
					$_SESSION['size'] = $file["size"];
					
					if($_SESSION['photoPath'] != "") {
						
						// Check file size
						if ($_SESSION['size'] > 500000) {
						    $data['success'] = "Cargue una imagen de menor tamaño";
						    $uploadOk = 0;
						}
						
						// Allow certain file formats
						if($_SESSION['imageFileType'] != "jpg" && $_SESSION['imageFileType'] != "png" && $_SESSION['imageFileType'] != "jpeg") {
						    $data['success']= "Solo se aceptan formatos JPG, JPEG, y PNG";
						    $uploadOk = 0;
						}
						
						// Check if $uploadOk is set to 0 by an error
						if ($uploadOk == 0) {
						    $data['success'] = "Error, consulte con el administrador.";
						
						} else {
							$files[] = $uploaddir .$file['name'];
							$i = 1;
							while(file_exists($uploaddir.'ishopcolombia'.$i.'.'.$_SESSION['imageFileType'])){
								$i++;
							}
							rename($_SESSION['photoPath'], $uploaddir.'ishopcolombia'.$i.'.'.$_SESSION['imageFileType']);
							$_SESSION['photoPath'] = $uploaddir.'ishopcolombia'.$i.'.'.$_SESSION['imageFileType'];
							$data['success'] = true;
						}
					}
		        
	        } else {
	             $data['success'] = false;
	        }
	    }
	    
	} else {
	   $data['success'] = false;
	}
	
	echo json_encode($data);