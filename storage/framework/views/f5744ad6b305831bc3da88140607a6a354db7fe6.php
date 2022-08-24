
<?php $__env->startSection('css'); ?>
  <link rel="stylesheet" href="/css/admin/user-student.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid" style="padding: 0">
  <div class="row flex-nowrap main" id="main">

    
    <?php echo $__env->make('user.admin.utama.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <div class="col" style="overflow: auto !important">
      <?php echo $__env->make('user.admin.utama.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <div class="container main-content m-0">
        
        <div class="row">
          <div class="col-md col-12 p-0 studentList">
            <div class="headline d-flex justify-content-between">
              <div class="col-md-6 col-5 d-flex align-items-center gap-md-3 gap-2">
                <img src="/assets/student.png" alt="">
                <h6>Students</h6>
              </div>
              <div class="col-md-4 col-6 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                <img src="/assets/reload.png" alt="">
                <div class="input-group">
                  <input type="email" class="form-control inputField py-2 px-3" placeholder="Search">
                </div>
              </div>
            </div>
            <div class="container text-center" style="overflow-x: auto !important">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Student Name</th>
                    <th>Mentor Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>City</th>
                  </tr>
                </thead>
                <tbody>
                  <tr onclick="window.location='/admin/user/student/detail'">
                    <th scope="row">1</th>
                    <td>Student Dummy</td>
                    <td>Mentor Dummy</td>
                    <td>studentdummy@example.com</td>
                    <td>12345678</td>
                    <td>Jl Jeruk kembar blok Q9 no. 15</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        
      </div>
    </div>
    
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.admin.utama.utama', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\ALL-in\PLATFORM\editing-v2\resources\views/user/admin/users/user-student.blade.php ENDPATH**/ ?>