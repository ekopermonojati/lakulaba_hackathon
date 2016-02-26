<div class="container" role="main">
	<div class="col-md-6 col-md-3">
		<h1>Produk</h1>
		
		<?php 
			echo $this->session->userdata('status_produk');
			echo validation_errors(); 
		?>
		<?php //echo form_open('welcome/produk'); ?>
		<?php echo form_open_multipart('welcome/produk');?>
			<input type="text" class="form-control" placeholder="Nama Produk" aria-describedby="sizing-addon2" name="nama_produk"><br>
			<input type="file" class="form-control" placeholder="Gambar Produk" aria-describedby="sizing-addon2" name="gambar_produk" size="20" /><br>
			<input type="text" class="form-control" placeholder="Deskripsi" aria-describedby="sizing-addon2" name="deskripsi"><br>
			<input type="text" class="form-control" placeholder="Harga (Rp.)" aria-describedby="sizing-addon2" name="harga_jual"><br>
			<input type="text" class="form-control" placeholder="Biaya Pengiriman (Rp.)" aria-describedby="sizing-addon2" name="biaya_pengiriman"><br>
			<input type="text" class="form-control" placeholder="stok" aria-describedby="sizing-addon2" name="stok"><br>
			<input type="submit" name="submit" class="btn btn-success" value="Tambah!" />
		</form>
	</div>
</div>
