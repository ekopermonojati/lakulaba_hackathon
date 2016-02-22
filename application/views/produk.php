<div class="container" role="main">
	<h1>Produk</h1>
	
	<?php 
		echo $this->session->userdata('status_produk');
		echo validation_errors(); 
	?>
	<?php //echo form_open('welcome/produk'); ?>
	<?php echo form_open_multipart('welcome/produk');?>
		<div class="input-group">
			<input type="text" class="form-control" placeholder="Nama Produk" aria-describedby="sizing-addon2" name="nama_produk">
		</div>
		<div class="input-group">
			<input type="file" class="form-control" placeholder="Gambar Produk" aria-describedby="sizing-addon2" name="gambar_produk" size="20" />
			
		</div>
		<div class="input-group">
			<input type="text" class="form-control" placeholder="Deskripsi" aria-describedby="sizing-addon2" name="deskripsi">
		</div>
		<div class="input-group">
			<input type="text" class="form-control" placeholder="Harga (Rp.)" aria-describedby="sizing-addon2" name="harga_jual">
		</div>
		<div class="input-group">
			<input type="text" class="form-control" placeholder="Biaya Pengiriman (Rp.)" aria-describedby="sizing-addon2" name="biaya_pengiriman">
		</div>
		<div class="input-group">
			<input type="text" class="form-control" placeholder="stok" aria-describedby="sizing-addon2" name="stok">
		</div>
		<input type="submit" name="submit" value="Tambah!" />
	</form>
</div>
