<div class="container" role="main">
	<div class="col-md-8 col-md-offset-2">
		<h3>Edit Data (<?php print( $users[0]->id_sosmed );?>)</h3>

		<form method="post" action="proses_edit_account">
			<table class="table">
				<tr>
					<td width="20%">Nama Toko</td>
					<td><input class="form-control" type="text" value="<?php echo $users[0]->nama_toko;?>" name="nama_toko" required placeholder="Nama Toko"></td>
				</tr>
				<tr>
					<td>Nama Pemilik</td>
					<td><input class="form-control" type="text" name="nama_pemilik" value="<?php echo $users[0]->nama_pemilik;?>" required placeholder="Nama Pemilik" readonly></td>
				</tr>
				<tr>
					<td>Alamat Toko</td>
					<td><textarea class="form-control" type="text" name="alamat" required><?php echo $users[0]->alamat;?></textarea></td>
				</tr>
				<tr>
					<td>No. Telepon</td>
					<td><input class="form-control" type="text" name="no_telepon" value="<?php echo $users[0]->no_telepon;?>" required placeholder="No. Telepon"></td>
				</tr>
				<tr>
					<td>No. E-Cash Mandiri</td>
					<td><input class="form-control" type="text" name="no_ecash_mandiri" value="<?php echo $users[0]->no_ecash_mandiri;?>" readonly placeholder="No E-Cash Mandiri"></td>
				</tr>
				<tr>
					<td></td>
					<td style="text-align:right"><input type="submit" name="click" class="btn btn-success" value="Update!"></td>
				</tr>
			</table>
		</form>
	</div>
</div>