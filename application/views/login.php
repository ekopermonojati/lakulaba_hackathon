<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Lakulaba</title>
	<!-- Latest compiled and minified CSS -->
	<script src="<?php echo base_url('static/jquery-1.12.0.min.js')?>"></script>
  <link rel="stylesheet" href="<?php echo base_url('static/bootstrap-3.3.6/css/bootstrap.min.css')?>">
  <link rel="stylesheet" href="<?php echo base_url('static/bootstrap-3.3.6/css/bootstrap-theme.min.css') ?>">
  <script src="<?php echo base_url('static/bootstrap-3.3.6/js/bootstrap.min.js') ?>"></script>
</head>
<body>
	<div class="container">
		<div class="hidden-xs" style="margin-top:10%"></div>
		<div class="col-md-8 col-md-offset-2 text-center">
			<div class="col-md-4">
				<img src='<?php echo $this->config->item('base_url')."images/icon_lakulaba.png"?>' width='200px'>
				<h3>LakuLaba<br><small><i>Jual Cepat Lewat Sosmed</i></small></h3>
			</div>
			<div class="col-md-8">
				<br>
				<br>
				<h4>Login Menggunakan</h4>
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
				echo "<a href='".htmlspecialchars($loginUrl)."'><img src='$fb_login_image' width='300px' ></a>";
				?>
				<br><a href="<?php echo base_url('welcome/login_tw')?>"><img src="<?php echo base_url('static/tw_login.png')?> " width='300px'></a>
			</div>
		</div>
	</div>
</body>
</html>