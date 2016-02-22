<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Lakulaba</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>	
</head>

<?php
	//memersiapkan login facebook
	require_once( APPPATH . 'libraries/Facebook/autoload.php' );
	//session_start() ;
	$fb = new Facebook\Facebook([
	  'app_id' => $this->config->item('fb_app_id'),
	  'app_secret' => $this->config->item('fb_app_secret'),
	  'default_graph_version' => 'v2.2',
	  ]);

	$helper = $fb->getRedirectLoginHelper();
	$baseurl = $this->config->item('base_url');
	$permissions = ['email']; // Optional permissions
	$loginUrl = $helper->getLoginUrl($baseurl . 'welcome/login_callback', $permissions);
	$fb_login_image = $baseurl . "static/fb_login.png";
	echo '<a href="' . htmlspecialchars($loginUrl) . '"><img src=' . $fb_login_image .'></a>';
?>
<a href="<?php echo base_url('welcome/login_tw')?>"><img src="<?php echo base_url('static/tw_login.png')?>"></a>
</html>