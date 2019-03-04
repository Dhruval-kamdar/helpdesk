<?php
	session_start();
	$default = false;
	$custId = (!empty($_SESSION['custId'])) ? intval($_SESSION['custId']) : intval($_REQUEST['custId']);
	$username = (isset($_SESSION['username'])) ? $username = $_SESSION['username'] : $_REQUEST['username'];
	if(!isset($_SESSION['ipAddress']) || $default){
		$_SESSION['ipAddress'] = $_SERVER['REMOTE_ADDR'];
	}
	if(!isset($_SESSION['userAgent']) || $default){
		$_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
	}
	if(!isset($_SESSION['time']) || $default){
		$_SESSION['time'] = time();
		$time = $_SESSION['time'];
	}
	if(!isset($_SESSION['sesh_id']) || $default){
		$_SESSION['sesh_id'] = session_id();
		$sesh_id = $_SESSION['sesh_id'];
	} elseif(isset($_SESSION['sesh_id'])) {
		$sesh_id = $_SESSION['sesh_id'];
	}
	if(isset($time) && isset($sesh_id)){
		if(time() - $time < 7200){
			$_SESSION['sesh_id'] = session_id();
			$sesh_id = $_SESSION['sesh_id'];
		}
	}
	include('config/settings.php');
	include('class/dbcon.php');
	include('class/siteNavigation.class.php');
	include('class/headers-class.php');
	include('class/content-class.php');
	include('class/images-class.php');
	include('class/btns-class.php');
	$headers = new headers($dbCon);
	$content = new content($dbCon);
	$images = new images($dbCon);
	$btns = new btns($dbCon);
	$previous = "javascript:history.go(-1)";
	if(isset($_SERVER['HTTP_REFERER'])){
		$previous = $_SERVER['HTTP_REFERER'];
	}
	$previousBtn = "<a href=\"".$previous."\" class=\"btn gray pull-right\" style=\"margin-right:20px; margin-top:5px;\">Go Back</a>";
	$uriAddy = $_SERVER['REQUEST_URI'];
	global $uriAddy;
	global $custId;
	global $username;
	global $sesh_id;
	
?>

