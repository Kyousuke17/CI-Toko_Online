<div class="container-fluid">

<h1 class=""><?= $title;?></h1>

<div class="btn btn-sm btn-success">No.Invoice: <?= $invoice->id;?></div>
	
<table class="table table-bordered table-hover table-striped">
	<tr>
		<th>ID BARANG</th>
		<th>NAMA PRODUK</th>
		<th>JUMLAH PESANAN</th>
		<th>HARGA SATUAN</th>
		<th>SUB TOTAL</th>
	</tr>
	<?php
	$total = 0;
	foreach ($pesanan as $ps) :
		$subtotal = $ps->jumlah * $ps->harga;
		$total += $subtotal;
		?>
	
	<tr>
		<td><?= $ps->id_brg;?></td>
		<td><?= $ps->nama_brg;?></td>
		<td><?= $ps->jumlah;?></td>
		<td><?= number_format($ps->harga,0,',','.');?></td>
		<td><?= number_format($subtotal,0,',','.');?></td>

	</tr>
<?php endforeach;?>
	
	<tr>
		<td colspan="4" align="right">Grand Total</td>
		<td align="right">Rp. <?= number_format($total,0,',','.');?></td>
		</td>
	</tr>
</table>

	<a href="<?= base_url('admin/invoice');?>"><div class="btn btn-sm btn-primary">Kembali</div></a>
</div>