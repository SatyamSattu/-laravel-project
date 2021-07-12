<?php $__env->startSection('content'); ?>
<section class=form-login>
  <div class="container">
      <div class="row ">
          <div class="col-md-6 mx-auto">
              <div class="card">
                  <div class="card-header bg-dark text-white">
                        <h4 class="text-center">Account Login</h4>
                  </div>
                  <div class="card-body">
                      <form>
                          <div class="form-group">
                              <label for="email">Email</label>
                              <input type="email" name="email" id="email" class="form-control">
                          </div>

                          <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-dark btn-block" id="loginBtn">LOGIN</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('javascript'); ?>
<script>
    $(document).ready(function() {
        $("#loginBtn").click(function(e) {
  
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    
            e.preventDefault();
            var email     = $("#email").val();
            var password  = $("#password").val();
    
            $.ajax({
                url: 'admin_login',
                type: 'POST',
                data: {
                    email: email,
                    password: password
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                      if(data.success) {
                        $('#notifDiv').fadeIn();
                        $('#notifDiv').css('background', 'green');
                        $('#notifDiv').text('Admin Successfully Login');
                        setTimeout(() => {
                            $('#notifDiv').fadeOut();
                        }, 3000);
                    window.location = "<?php echo e(route('admin.dashboard')); ?>";
                  } 
                    } 
                     else {
                       $('#notifDiv').fadeIn();
                       $('#notifDiv').css('background', 'red');
                       $('#notifDiv').text('An error occured. Please try later');
                       setTimeout(() => {
                        $('#notifDiv').fadeOut();
                       }, 3000);
                    }
                }
            });
          });  
        }); 
</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\complete_auth\resources\views/admin/login.blade.php ENDPATH**/ ?>