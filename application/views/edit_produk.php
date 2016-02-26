<?php 
	// print_r($data_produk);

	// echo $data_produk[0]->gambar_produk;
?>
<div class="container" role="main">
	<div class="col-md-8 col-md-offset-2">
		<h3>Edit Product (<?php echo $data_produk[0]->nama_produk;?>)</h3>

		<form method="post" action="proses_edit_produk">
			<table class="table">
				<tr>
					<td rowspan="7" width="20%"><img src="<?php echo base_url('uploads/'. $data_produk[0]->gambar_produk);?>" width="240px"></td>
					<td width="20%">Nama Produk</td>
					<td><input class="form-control" type="text" value="<?php echo $data_produk[0]->nama_produk;?>" name="nama_produk" required placeholder="Nama Produk"></td>
				</tr>
				<tr>
					<td>Penjelasan jelas mengenai produk</td>
					<td><textarea class="form-control" name="deskripsi" rows="3" required placeholder="Penjelasan jelas mengenai produk"><?php echo $data_produk[0]->deskripsi;?></textarea></td>
				</tr>
				<tr>
					<td>Harga (Rp.)</td>
					<td><input class="form-control" type="text" name="harga_jual" value="<?php echo $data_produk[0]->harga_jual;?>" required placeholder="Harga (Rp.)"></td>
				</tr>
				<tr>
					<td>Biaya Pengiriman (Rp.)</td>
					<td><input class="form-control" type="text" name="biaya_pengiriman" value="<?php echo $data_produk[0]->biaya_pengiriman;?>" required placeholder="Biaya Pengiriman (Rp.)"></td>
				</tr>
				<tr>
					<td>Sisa Stok</td>
					<td><input class="form-control" type="text" name="stok" value="<?php echo $data_produk[0]->stok;?>" required placeholder="Sisa Stok"></td>
				</tr>
				<tr>
					<td>Apakah produk ini siap dijual?</td>
					<td>
						<?php if ($data_produk[0]->status_jual == 0) {
							# code...
							echo "
								<input type='radio' name='active' value='1' >Ya<br>
								<input type='radio' name='active' value='0' checked>Tidak
							";
						} else {
							echo "
								<input type='radio' name='active' value='1' checked>Ya<br>
								<input type='radio' name='active' value='0' >Tidak
							";
						}
						?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td style="text-align:right"><input type="submit" name="click" class="btn btn-success" value="Update!"></td>
				</tr>
			</table>
		</form>
	</div>
</div>