<html>
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
<div class="container" role="main">
	<h3>Trx ID:<?php echo $trx_id ?></h3>
	<h3>Product Detail</h3>
	
	<?php 
		foreach($produk->result() as $row){
			$nama_produk = $row->nama_produk;
			$gambar_produk = $row->gambar_produk;
			$deskripsi = $row->deskripsi;
			$harga_jual = $row->harga_jual;
			$biaya_kirim = $row->biaya_pengiriman;
			$stok = $row->stok;
		}
	?>
	<table border="1">
	<tr>
		<td></td>
		<td><img src="<?php echo base_url('uploads/'. $gambar_produk)?>" height="256" width="auto"></td>
	</tr>
	<tr>
		<td>Nama Produk</td>
		<td><?php echo $nama_produk ?></td>
	</tr>
	<tr>
		<td>Deskripsi</td>
		<td><?php echo $deskripsi ?></td>
	</tr>
	<tr>
		<td>Harga Jual</td>
		<td><?php echo $harga_jual ?></td>
	</tr>
	<tr>
		<td>Biaya Kirim</td>
		<td><?php echo $biaya_kirim ?></td>
	</tr>
	<tr>
		<td>Persedian</td>
		<td><?php echo $stok ?></td>
	</tr>
	</table>
	<?php echo form_open('Pay/payment'); ?>
	<h3>Buyer & Shipment</h3>
		<div class="input-group">
			<input type="text" class="form-control" placeholder="Full Name" aria-describedby="sizing-addon2" name="fullname"><br>
			<input type="text" class="form-control" placeholder="Phone Number" aria-describedby="sizing-addon2" name="phone"><br>
			<input type="text" class="form-control" placeholder="Address" aria-describedby="sizing-addon2" name="address"><br>
			<input type="text" class="form-control" placeholder="Postal Code" aria-describedby="sizing-addon2" name="postalcode"><br>
			<input type="text" class="form-control" placeholder="Email Pembeli" aria-describedby="sizing-addon2" name="buyer_email"><br>
			<input type="text" class="form-control" placeholder="Jumlah Pembelian" aria-describedby="sizing-addon2" name="order_number"><br>
			<input type="text" class="form-control" placeholder="Permintaan Khusus" aria-describedby="sizing-addon2" name="buyer_request">
		</div>
	<h3>Payment Method</h3>
		<input type="radio" name="payment" value="1"> eCash Mandiri<br>
		<input type="radio" name="payment" value="2" disabled="true"> Credit Card<br>
		<input type="radio" name="payment" value="3" disabled="true"> ATM<br>
		<input type="submit" name="submit" value="Continue to Payment" />
	</form>
</div>
</html>
