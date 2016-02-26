<div class="container" role="main">
    <h1>Daftar Produk</h1>
	<table id="table_id" class="display">
		<thead>
			<tr>
				<th>Nama Produk</th>
				<th>Gambar Produk</th>
				<th>Deskripsi</th>
				<th>Harga Jual</th>
				<th>Biaya Pengiriman</th>
				<th>Stok</th>
				<th>Status</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($data_produk as $row) {?>
			<tr>
				<td><a href="<?php echo base_url('welcome/edit_produk?id=' . $row->id) ?>" ><?php echo $row->nama_produk?></a></td>
				<td><img src="<?php echo base_url('uploads/'. $row->gambar_produk)?>" height="42" width="auto"></td>
				<td><?php echo $row->deskripsi?></td>
				<td><?php echo $row->harga_jual?></td>
				<td><?php echo $row->biaya_pengiriman?></td>
				<td><?php echo $row->stok?></td>
				<td><?php echo $row->status == 0 ? "Belum Approve": "Approve" ?></td>
				<td>
					<?php if ($row->status){ ?>
					<div class="btn-group" role="group">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						  Share
						  <span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
						  <li><a href="#" data-toggle="modal" data-target="#myModal" onclick="set_link('<?php echo base_url('l/l/' . $row->url_code) ?>')">Link</a></li>
						  <li><a href="#">Facebook</a></li>
						  <li><a href="#">Twitter</a></li>
						</ul>
					</div>
					<?php } ?>
				</td>
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
        <button type="button" class="btn btn-primary" id="copy">Copy</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function set_link(x){
	document.getElementById("url_code").innerHTML = x;
}
</script>
<script type="text/javascript">
document.getElementById("copy").addEventListener("click", function() {
    copyToClipboard(document.getElementById("url_code"));
});

function copyToClipboard(elem) {
	  // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);
    
    // copy the selection
    var succeed;
    try {
    	  succeed = document.execCommand("copy");
    } catch(e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }
    
    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
    return succeed;
}
</script>