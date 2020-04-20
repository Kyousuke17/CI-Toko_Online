<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"> <?= $title;?></h1>
        <form method="post" action="<?= base_url('menu/ubah');?>">
            <div class="form-group">
                <input type="hidden" name="id" value="<?= $menu['id'];?>">

                <label>Nama Menu</label>
                <input type="text" name="nama" id="nama" value="<?= $menu['menu'];?>">
            </div>

              

            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>

        </form>

</div>
</div>