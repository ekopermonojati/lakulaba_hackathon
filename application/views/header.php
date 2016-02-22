<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Lakulaba</title>
	<script src="<?php echo base_url('static/jquery-1.12.0.min.js')?>"></script>
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('static/DataTables-1.10.11/media/css/jquery.dataTables.css')?>">
	<script type="text/javascript" charset="utf8" src="<?php echo base_url('static/DataTables-1.10.11/media/js/jquery.dataTables.js')?>"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="<?php echo base_url('static/bootstrap-3.3.6/css/bootstrap.min.css')?>" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<!-- Optional theme -->
	<link rel="stylesheet" href="<?php echo base_url('static/bootstrap-3.3.6/css/bootstrap-theme.min.css') ?>" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	<!-- Latest compiled and minified JavaScript -->
	<script src="<?php echo base_url('static/bootstrap-3.3.6/js/bootstrap.min.js') ?>" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>	
</head>
<body role="document" style="position: relative; overflow: visible; top: 90px;">
<nav class="navbar navbar-inverse navbar-fixed-top" style="top: 0px;">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Dashboard</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="<?php echo site_url('welcome/dashboard')?>">Product</a></li>
            <li><a href="<?php echo site_url('welcome/tambah_produk')?>">Add Product</a></li>
            <li><a href="<?php echo site_url('welcome/daftar_pembayaran')?>">Orders</a></li>
			<li><a href="">Setting</a></li>
            <li><a href="">Help</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>