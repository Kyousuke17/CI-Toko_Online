<div class="container-fluid">
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

	<table class="table table-bordered table-hover table-striped">
		<tr>
			<th>Id Invoice</th>
			<th>Nama Pemesan</th>
			<th>Alamat Pengiriman</th>
			<th>Tanggal Pemesanan</th>
			<th>Batas Pembayaran</th>
			<th>Aksi</th>
		</tr>

		<?php foreach ($invoice as $inv) :?>
			<tr>
				<td><?= $inv->id;?></td>
				<td><?= $inv->nama;?></td>
				<td><?= $inv->alamat;?></td>
				<td><?= $inv->tgl_pesan;?></td>
				<td><?= $inv->batas_bayar;?></td>
				<td><a href="<?= base_url('admin/invoice_detail/').$inv->id;?>"><div class="btn btn-sm btn-primary" >Detail</div></a></td>
			</tr>
			
		<?php endforeach;?>
	</table>

</div>