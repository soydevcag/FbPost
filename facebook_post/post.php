<?php
	date_default_timezone_set('UTC');
	ini_set('display_errors', 0);
	ini_set('display_startup_errors', 0);
	error_reporting(E_ALL);
	
	session_start();
	require 'Facebook/config.php';
	define('FACEBOOK_SDK_V4_SRC_DIR',__DIR__ .'/Facebook/');
	require_once __DIR__ .'/Facebook/autoload.php';
			
		$fb = new Facebook\Facebook(array(
		  'app_id'  => '',
		  'app_secret' => '',
		  'default_graph_version' => 'v2.4'
		));
		
		 $helper = $fb->getRedirectLoginHelper();
		
		try {
			$accessToken = $helper->getAccessToken();
			$linkData = [
				'source' => $fb->fileToUpload($_SESSION['photoPath']), 
				'message' => '#AsíDeFácilConiShop'
			];
			$petition = $fb->post('/me/photos', $linkData, $accessToken);
			$_SESSION['msg'] = 'True';
		} catch (Facebook\Exceptions\FacebookResponseException $e) {
			// When Graph returns an error
			$_SESSION['msg'] = 'Debes aceptar los permisos'; //. $e->getMessage();
		} catch (Facebook\Exceptions\FacebookSDKException $e) {
			// When validation fails or other local issues
			$_SESSION['msg'] = 'Facebook SDK returned an error: ' . $e->getMessage();
		}
		
		if(isset($_GET['error_reason'])){
			$_SESSION['msg'] = 'Debes aceptar para poder compartir';
		}
		
		unset($_SESSION['imageFileType']);
		unset($_SESSION['tmp_name']);
		unset($_SESSION['size']);
	    echo "<script>
	   		window.onunload = function() {
           		window.opener.location ='http://serverlequar.com/fb/facebook_post/';
            }
	   		window.close();
	   	    </script>";	
	//header('Location: index.php');
?>