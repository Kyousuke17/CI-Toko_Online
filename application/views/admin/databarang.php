<div class="container-fluid">

  <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>
  
	<?php if(validation_errors()) : ?>
                  <div class="alert alert-danger" role="alert">
                <?= validation_errors();?>
              </div>
              <?php endif; ?>
              <?= $this->session->flashdata('message'); ?>

	<button class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#tambahbarang"><i class="fas fa-plus fa-sm"></i>Tambah Barang</button>

		<table class="table table-bordered text-center">
			<tr>
				<th>NO</th>
				<th>NAMA BARANG</th>
				<th>KETERANGAN</th>
				<th>KATEGORI</th>
				<th>HARGA</th>
				<th>STOK</th>
				<th colspan="3">AKSI</th>
			</tr>
      <tbody>
			<?php $i=1; ?>
			<?php foreach ($barang as $brg) : ?>
				<tr>
					<th scope="row"><?= $i; ?></th>
					<td><?= $brg['nama'];?></td>
					<td><?= $brg['keterangan'];?></td>
					<td><?= $brg['kategori'];?></td>
					<td><?= $brg['harga'];?></td>
					<td><?= $brg['stock'];?></td>
					<td><div class="btn btn-success btn-sm"><i class="fas fa-search-plus"></i></div></td>
					<td><a href="<?= base_url('admin/edit_databarang/') . $brg['id'];?>"><div class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></div></a></td>
					<td><a href="<?= base_url('admin/hapus_databarang/') . $brg['id'];?>"><div class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></div></a></td>
				</tr>
				<?php $i++; ?>
			<?php endforeach; ?>
    </tbody>
		</table>

	</div>


<!-- Modal -->
<div class="modal fade" id="tambahbarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Produk Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
       <form action="<?= base_url('admin/data_barang'); ?>" method="post" entype="multipart/form-data">
       	<div class="form-group">
       		<label>Nama Barang</label>
      		<input type="text" name="nama" id="nama" class="form-control">
      </div>
      		<div class="form-group">
       		<label>Keterangan</label>
      		<input type="text" name="keterangan" id="keterangan" class="form-control">
      </div>
      	<div class="form-group">
      		<label>Kategori</label>
      	 <select name="kategori" id="kategori" class="form-control">
                  <option value="">Select Menu..</option>
                            <option value="Elektronik">Elektronik</option>
                            <option value="Pakaian Pria">Pakaian Pria</option>
                            <option value="Pakaian Wanita">Pakaian Wanita</option>
                            <option value="Pakaian Anak-anak">Pakaian Anak-anak</option>
                            <option value="Pakaian Olahraga">Pakaian Olahraga</option>
             </select>
           </div> 
      	<div class="form-group">
       		<label>Harga</label>
      		<input type="text" name="harga" id="harga" class="form-control">
      </div>
      	<div class="form-group">
       		<label>Stock</label>
      		<input type="text" name="stock" id="stock" class="form-control">
      </div>
      <div class="form-group">
       		<label>Gambar</label>
      		<input type="file" name="gambar" id="gambar" class="form-control" for="gambar">
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>