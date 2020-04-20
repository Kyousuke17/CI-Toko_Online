<div class="container-fluid">

	<h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>

	<table class="table table-bordered table-striped table-hover">
		
		<tr>
			<th>NO</th>
			<th>Nama Produk</th>
			<th>Jumlah</th>
			<th>Harga</th>
			<th>Sub-Total</th>
		</tr>

		<?php
		$no=1;
		foreach ($this->cart->contents() as $items) : ?>
			<tr>
				<td><?= $no++; ?></td>
				<td><?= $items['name'];?></td>
				<td><?= $items['qty'];?></td>
				<td align="right">Rp.<?= number_format($items['price'],0,',','.');?></td>
				<td align="right">Rp.<?= number_format($items['subtotal'],0,',','.');?></td>
			</tr>

			
		<?php endforeach; ?>
		
		<tr>
			<td colspan="4"> 
				
			</td>
				<td align="right">Rp.<?= number_format($this->cart->total(),0,',','.');?></td>
			</tr>

	</table>

	<div align="right">
			<a href="<?= base_url('user/hapus_keranjang');?>">
			<div class="btn btn-sm btn-danger">Hapus Keranjang</div></a>
			<a href="<?= base_url('user/toko_online');?>">
			<div class="btn btn-sm btn-primary">Lanjutkan Belanja</div></a>
			<a href="<?= base_url('user/pembayaran_keranjang');?>">
			<div class="btn btn-sm btn-success">Pembayaran</div></a>

</div>