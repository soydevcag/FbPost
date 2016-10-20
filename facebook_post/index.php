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
    <center>Click aqui o arrastra tu imagen</center>
    <img src="" width="400" height="350" style="border: none;">
</div>
<form id="uploadPhoto" method="post" enctype="multipart/form-data">
	<input type="file" id="filePhoto" accept="image/x-png, image/jpeg, image/jpg" required>
	<a id="buttonShare" href="<?php echo $loginUrl; ?>" style="display: none;">Compartir en Facebook</a>
</form>
	<?php 
		if(isset($_SESSION['msg'])) { 
			echo $_SESSION['msg']; 
			unset($_SESSION['msg']); 
		} 
	?>
<style type="text/css" media="screen">
	#uploader {position:relative; overflow:hidden; width:400px; height:350px; background:transparent; border:2px dashed #e8e8e8;cursor:pointer;padding:5px;color:#555;font-family:'Segoe UI';font-weight:bold;}
	#uploader:hover{color:#000; border:2px dashed #000}
	#filePhoto{display:none;}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js" charset="utf-8"></script>
<script src="js/DragNDrop.js"></script>
<script src="js/upload.js"></script>