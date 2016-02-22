<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Lakulaba</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="<?php echo base_url('static/bootstrap-3.3.6/css/bootstrap.min.css')?>" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<!-- Optional theme -->
	<link rel="stylesheet" href="<?php echo base_url('static/bootstrap-3.3.6/css/bootstrap-theme.min.css') ?>" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	<!-- Latest compiled and minified JavaScript -->
	<script src="<?php echo base_url('static/bootstrap-3.3.6/js/bootstrap.min.js') ?>" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>	
</head>
<body>
<div class="container" role="main">
<h1>Registrasi</h1>
<p>Anda belum terdaftar di sistem kami. Silahkan isi form dibawah ini lalu klik tombol kirim
<?php 
	echo validation_errors(); 
?>
<?php echo form_open('welcome/registration_insert'); ?>
	<div class="input-group">
		<input type="hidden" class="form-control" placeholder="" aria-describedby="sizing-addon2" name="id_user" value="<?php echo $id_user ?>" >
	</div>
	<div class="input-group">
		<input type="text" class="form-control" placeholder="" aria-describedby="sizing-addon2" name="email" value="<?php echo $email ?>" >
	</div>
	<div class="input-group">
		<input type="text" class="form-control" placeholder="Nama Pemilik" aria-describedby="sizing-addon2" name="nama_pemilik" value="<?php echo $name ?>">
	</div>
	<div class="input-group">
		<input type="text" class="form-control" placeholder="Nama Toko" aria-describedby="sizing-addon2" name="nama_toko">
	</div>
	<div class="input-group">
		<input type="text" class="form-control" placeholder="Alamat" aria-describedby="sizing-addon2" name="alamat">
	</div>
	<div class="input-group">
		<input type="text" class="form-control" placeholder="No Telepon" aria-describedby="sizing-addon2" name="no_telepon">
	</div>
	<div class="input-group">
		<input type="text" class="form-control" placeholder="No e-Cash Mandiri" aria-describedby="sizing-addon2" name="no_ecash">
	</div>
	<input type="submit" name="submit" value="Registrasi!" />
</form>
</body>
</body>
</html>