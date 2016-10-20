<?php

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

session_start();
require 'Facebook/config.php';
define('FACEBOOK_SDK_V4_SRC_DIR',__DIR__ .'/Facebook/');
require_once __DIR__ .'/Facebook/autoload.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook\Facebook(array(
  'app_id'  => '',
  'app_secret' => '',
  'default_graph_version' => 'v2.4'
));

$helper = $facebook->getRedirectLoginHelper();
$permissions = ['publish_actions']; 
$loginUrl = $helper->getLoginUrl('http://serverlequar.com/fb/facebook_post/post.php', $permissions);
?>
<div id="uploader" onclick="$('#filePhoto').click()">
	<img src="img/default.png" style="border: none;" width="100%" height="100%">
</div>
<form id="uploadPhoto" method="post" enctype="multipart/form-data">
	<input type="file" id="filePhoto" accept="image/x-png, image/jpeg, image/jpg" required>
	<a id="buttonShare" onclick=" window.open('<?php echo $loginUrl; ?>','',' scrollbars=yes,menubar=no,width=600, height=550, resizable=false,toolbar=no,location=no,status=no')" href="#" style="display: none;">Compartir en Facebook</a>
</form>
	<?php 
		if(isset($_SESSION['msg'])) { 
			if($_SESSION['msg']=='True'){
				echo '<img src="'.$_SESSION['photoPath'].'" width="400" height="350">';
			}else{
				echo $_SESSION['msg'];
			}
			unset($_SESSION['photoPath']);
			unset($_SESSION['msg']); 
		} 
	?>
<style type="text/css" media="screen">
	#uploader {position:relative; overflow:hidden; width:400px; height:350px; background:transparent; border:2px dashed #cbcbcb;cursor:pointer;padding:5px;color:#555;font-family:'Segoe UI';font-weight:bold;}
	#uploader:hover{color:#000; border:2px dashed #000}
	#filePhoto{display:none;}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js" charset="utf-8"></script>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" crossorigin="anonymous">
<script src="js/DragNDrop.js"></script>
<script src="js/upload.js"></script>
<script src="js/loadingoverlay.min.js"></script>