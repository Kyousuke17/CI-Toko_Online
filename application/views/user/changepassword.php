
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>
          <div class="row">
          	<div class="col-lg-6">
          		 <?= $this->session->flashdata('message'); ?>
          		<form action="<?= base_url('user/changepassword');?>" method="post">
          			<div class="form-group">
          				<label for="password_saat_ini">Password Saat Ini</label>
          				<input type="password" name="password_saat_ini" class="form-control" id="password_saat_ini"> 
          				<small class="text-danger">
                    <?= form_error('password_saat_ini');?> </small>
          			</div>
          			<div class="form-group">
          				<label for="password_baru1">Password Baru</label>
          				<input type="password" name="password_baru1" class="form-control" id="password_baru1">
          				 <small class="text-danger">
                    <?= form_error('password_baru1');?> </small>
          			</div>
          			<div class="form-group">
          				<label for="password_baru2">Ulangi Password</label>
          				<input type="password" name="password_baru2" class="form-control" id="password_baru2">
          				 <small class="text-danger">
                    <?= form_error('password_baru2');?> </small>
          			</div>
          			<div class="form-group">
          				<button type="submit" class="btn btn-primary">Change Pasword</button>

          			</div>
          		</form>
          	</div>
          </div>
      </div>
  </div>