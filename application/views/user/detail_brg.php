<div class="container-fluid">

<div class="card">
  <h5 class="card-header">Detail Barang</h5>
  <div class="card-body">
  	<?php foreach ($barang as $brg) :?>
  		
  	
   	<div class="row">
   		<div class="col-md-4">
   			<img src="<?= base_url('/assets/img/').$brg->gambar;?>" class="card-img-top">
   		</div>
   			<div class="col-md-8">
   				<table class="table">
   					<tr>
   						<td>Nama Produk</td>
   						<td><strong><?= $brg->nama;?></strong></td>
   					</tr>
   					<tr>
   						<td>Keterangan</td>
   						<td><strong><?= $brg->keterangan;?></strong></td>
   					</tr>
   					<tr>
   						<td>Kategori</td>
   						<td><strong><?= $brg->kategori;?></strong></td>
   					</tr>
   					<tr>
   						<td>Stok</td>
   						<td><strong><?= $brg->stock;?></strong></td>
   					</tr>
   					<tr>
   						<td>Harga</td>
   						<td><strong><div class="btn btn-sm btn-success">Rp.
   							<?= number_format($brg->harga,0,',','.');?></strong></td>
   					</tr>

   					
   				</table>
   				<a href="<?= base_url('user/tambah_keranjang/').$brg->id;?>" class="btn btn-sm btn-primary">Tambah ke Keranjang</a>
   				<a href="<?= base_url('user/toko_online/')?>" class="btn btn-sm btn-danger">Kembali</a>
   			</div>
  </div>
<?php endforeach;?>

</div>

</div>