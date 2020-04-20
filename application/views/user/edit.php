

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


          <div class="row">

          	<div class="col-lg-8">
          		<?= form_open_multipart('user/edit');?>
          			<div class="form-group row">
          				<label for="email" class="col-sm-2 col-form-label">Email</label>
          				<div class="col-sm-10">
          					<input type="text" name="email" id="email" class="form-control" value="<?= 
          					$user['email'];?>" readonly>
          			</div>
          		</div>
          		<div class="form-group row">
          				<label for="name" class="col-sm-2 col-form-label">Full name</label>
          				<div class="col-sm-10">
          					<input type="text" name="name" id="name" class="form-control" value="<?= 
          					$user['name'];?>">
          					<small class="text-danger">
          						<?= form_error('name');?> </small>
          			</div>
          			<div class="form-group row">
          				<div class="col-sm-2">Picture</div>
          				<div class="col-sm-10">
          					<div class="row">
          						<div class="col-sm-3">
          							<img src="<?= base_url('assets/img/') . $user['image'];?>" class="img-thumbnail">

          						</div>

          						<div class="col-sm-9">
          							
          							<div class="custom-file">
          								<input type="file" name="image" class="custom-file-input" id="image">
          								<label class="custom-file-label" for="image">choose file</label>
          						</div>	
          					</div>

          				</div>
          			</div>
          		
          		</div>
          			<div class="form-group row justify-content-end">
          				<div class="col-sm-10">
          					<button type="submit" class="btn btn-primary">Edit</button>
          				</div>
          			</div>

          		</form>
          	</div>

          </div>
          
          

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
