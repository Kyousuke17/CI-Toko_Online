
  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-lg-7">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
             
              <div class="col-lg">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Change Password</h1>
                    <h5><?= $this->session->userdata('reset_email');?></h5>
                  </div>
                    <?= $this->session->flashdata('message'); ?>

                  <form class="user" method="POST" action="<?= base_url('auth/forgotpassword'); ?>">
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" id="email" a placeholder="Enter Email Address..." name="email" value="<?= set_value('email'); ?>">
                       <small class="text-danger">
                    <?= form_error('email');?> </small>
                    </div>
                   
                    
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Reset Password
                    </button>
                    
                   
                  </form>
                  <hr>
                 
                  <div class="text-center">
                    <a class="small" href="<?= base_url('auth'); ?>">Kembali ke halaman login!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
