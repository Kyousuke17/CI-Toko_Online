<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"> <?= $title;?></h1>
        <form method="post" action="<?= base_url('admin/role_ubah');?>">
            <div class="form-group">
                <input type="hidden" name="id" value="<?= $role['id'];?>">

                <label>Nama Menu</label>
                <input type="text" name="role" id="role" value="<?= $role['role'];?>">
            </div>

              

            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>

        </form>

</div>
</div>