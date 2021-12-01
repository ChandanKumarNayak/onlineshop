<?php include "top-outside.php"; ?>

<?php 
session_start();
if (isset($_SESSION['ADMIN_ID'])) {
    redirect(ADMIN_LANDING_PATH.'index');
}
?>

<div class="login-box">
    <div class="login-logo">
        <a href="<?php echo USER_LANDING_PATH ?>"><b><?php echo SITE_NAME ?></b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">

            <form id="AdminLogForm">
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email" name="admin_email" id="admin_email" >
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="admin_pass" id="admin_pass" >
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div> -->
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block" name="formSubmit" id="formSubmit"><i
                                class="fas fa-sign-in-alt"></i>&nbsp;Sign In</button>
                        <input type="hidden" name="type" value="admin_login" />
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <!-- <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> -->
            <!-- /.social-auth-links -->

            <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> -->
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<?php include "bottom-outside.php"; ?>

<!-- Login jQuery -->

<script>
$(document).ready(function() {

    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 7000
    });
    var error = 'Something went wrong.';
    var loading = '<img width="20" height="20" alt="loading" src="<?php echo USER_IMAGE_PATH ?>loading.gif">';

    $('#AdminLogForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: 'login_back',
            type: 'POST',
            data: $('#AdminLogForm').serialize(),
            beforesend: $('#formSubmit').attr('disabled', true).html(loading),
            success: function(adLog) {
              $('#formSubmit').attr('disabled', false).html('Submit');
                var result = $.parseJSON(adLog);
                if (result.status == 'error-empty') {
                    Toast.fire({
                        icon: 'error',
                        title: result.msg
                    })
                } else if (result.status == 'login-error') {
                    Toast.fire({
                        icon: 'error',
                        title: result.msg
                    })
                } else if (result.status == 'login-success') {
                    $('#AdminLogForm').trigger('reset');
                    location.href = '<?php echo ADMIN_LANDING_PATH ?>index';
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: error
                    })
                }

            }

        });

    });

});
</script>