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
                  <h1 class="h4 text-gray-900"><?= $menu_; ?></h1>
                  <h5 class="mb-4"><?= $email; ?></h5>
                </div>
                <?= $this->session->flashdata("message"); ?>
                <form class="user" method="post" action="<?= base_url('login/changepassword'); ?>">
                  <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Enter new password..." autofocus>
                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat new password...">
                  </div>
                  <button type="submit" class="btn btn-primary btn-user btn-block">
                    Reset password
                  </button>
                </form>
                <hr>
                <div class="text-center">
                  <a class="small" href="<?= base_url("login") ?>">Back to login</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

</div>