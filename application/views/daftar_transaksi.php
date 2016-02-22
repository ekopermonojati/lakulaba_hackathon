<div class="container" role="main">
    <h1>Data Transaksi</h1>
	<table id="table_id" class="display">
		<thead>
			<tr>
				<th>Nama Produk</th>
				<th>Payment Method</th>
				<th>Buyer Phone</th>
				<th>Buyer Name</th>
				<th>Buyer Address</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($data as $row) {?>
			<tr>
				<td><?php echo $row->nama_produk?></td>
				<td><?php echo $row->payment_method?></td>
				<td><?php echo $row->buyer_id?></td>
				<td><?php echo $row->buyer_name?></td>
				<td><?php echo $row->buyer_address?></td>
			</tr>
			<?php }?>
		</tbody>
	</table>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Share this link below</h4>
      </div>
      <div class="modal-body">
        <div id="url_code"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Copy</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function set_link(x){
	document.getElementById("url_code").innerHTML = x;
}
</script>