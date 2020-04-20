<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"> <?= $title;?></h1>
        <form method="post" action="<?= base_url('admin/edit_databarang');?>">
            <div class="form-group">
                <input type="hidden" name="id" value="<?= $brg['id'];?>">

                <label>Nama Barang</label>
                <input type="text" name="nama" id="nama" value="<?= $brg['nama'];?>">
            </div>

              <div class="form-group">
                <label>Keterangan</label>
                <input type="text" name="keterangan" id="keterangan" value="<?= $brg['keterangan'];?>">
            </div>

              <div class="form-group">
                <label>Kategori</label>
                 <select class="form-control"
                            id="kategori" name="kategori">
                            
                            <?php foreach($brg2 as $k) : ?>
                            <?php if($k == $brg['kategori']) : ?>
                                <option value="<?= $k; ?>" selected><?= $k; ?></option>
                                <?php else : ?>
                                    <option value="<?= $k; ?>"><?= $k; ?></option>
                            <?php endif; ?>
                            <?php endforeach; ?>
                            
                            </select>
            </div>

              <div class="form-group">
                <label>Harga</label>
                <input type="text" name="harga" id="harga" value="<?= $brg['harga'];?>">
            </div>

              <div class="form-group">
                <label>Stock</label>
                <input type="text" name="stock" id="stock" value="<?= $brg['stock'];?>">
            </div>

              

            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>

        </form>

</div>