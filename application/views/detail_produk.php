<html>
<head>
	<meta charset="utf-8">
	<title>Lakulaba</title>
	<script src="<?php echo base_url('static/jquery-1.12.0.min.js')?>"></script>
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('static/DataTables-1.10.11/media/css/jquery.dataTables.css')?>">
	<script type="text/javascript" charset="utf8" src="<?php echo base_url('static/DataTables-1.10.11/media/js/jquery.dataTables.js')?>"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="<?php echo base_url('static/bootstrap-3.3.6/css/bootstrap.min.css')?>">
	<!-- Optional theme -->
	<link rel="stylesheet" href="<?php echo base_url('static/bootstrap-3.3.6/css/bootstrap-theme.min.css')?>">
	<!-- Latest compiled and minified JavaScript -->
	<script src="<?php echo base_url('static/bootstrap-3.3.6/js/bootstrap.min.js') ?>"></script>	
</head>
<div class="container">
	<h3>Trx ID:<?php echo $trx_id ?></h3>
	<div class="col-md-6">
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
		<table class="table">
		<tr>
			<td rowspan="6"><img src="<?php echo base_url('uploads/'. $gambar_produk)?>" height="256" width="auto"></td>
		</tr>
		<tr>
			<th>Nama Produk</th>
			<td><?php echo $nama_produk ?></td>
		</tr>
		<tr>
			<th>Deskripsi</th>
			<td><?php echo $deskripsi ?></td>
		</tr>
		<tr>
			<th>Harga Jual</th>
			<td><?php echo $harga_jual ?></td>
		</tr>
		<tr>
			<th>Biaya Kirim</th>
			<td><?php echo $biaya_kirim ?></td>
		</tr>
		<tr>
			<th>Persedian</th>
			<td><?php echo $stok ?></td>
		</tr>
		</table>
	</div>
	<div class="col-lg-6">
	
		<?php echo form_open('Pay/payment'); ?>
		<h3>Buyer & Shipment</h3>
			<input type="text" class="form-control" placeholder="Full Name" aria-describedby="sizing-addon2" name="fullname" required><br>
			<input type="text" class="form-control" placeholder="Phone Number" aria-describedby="sizing-addon2" name="phone" required><br>
			<input type="text" class="form-control" placeholder="Address" aria-describedby="sizing-addon2" name="address" required><br>
			<input type="text" class="form-control" placeholder="Postal Code" aria-describedby="sizing-addon2" name="postalcode" required><br>
			<input type="text" class="form-control" placeholder="Email Pembeli" aria-describedby="sizing-addon2" name="buyer_email" required><br>
			<input type="text" class="form-control" placeholder="Jumlah Pembelian" aria-describedby="sizing-addon2" name="order_number" required><br>
			<input type="text" class="form-control" placeholder="Permintaan Khusus" aria-describedby="sizing-addon2" name="buyer_request" required>
		<h3>Payment Method</h3>
			<input type="radio" name="payment" value="1"> eCash Mandiri<br>
			<input type="radio" name="payment" value="2" disabled="true"> Credit Card<br>
			<input type="radio" name="payment" value="3" disabled="true"> ATM<br>
			<input type="submit" name="submit" class="btn btn-success" value="Continue to Payment" />
		</form>

	</div>
</div>
</html>
