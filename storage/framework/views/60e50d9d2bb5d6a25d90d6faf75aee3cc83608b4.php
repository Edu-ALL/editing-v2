<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <link rel="shortcut icon" href="/assets/favicon.png" type="image/x-icon">
    <title>Essay Editing Portal</title>
    <link rel="stylesheet" href=<?php echo e(asset('css/bootstrap.css')); ?>>
    <link rel="stylesheet" href="/css/admin/dashboard.css">
    <link rel="stylesheet" href="/css/admin/user-mentor.css">
    <link rel="stylesheet" href="/css/admin/user-student-detail.css">
    <link rel="stylesheet" href="/css/admin/user-editor-detail.css">

</head>

<body>
    
    <?php echo $__env->yieldContent('content'); ?>
    <footer class="container-fluid footer">
        <div class="col-md-5 mx-auto text-center py-2 copyright">
            <p>Copyright ©2022. <b>All-in Eduspace</b>. All Rights Reserved</p>
        </div>
    </footer>
    
</body>

</html>
<?php /**PATH E:\ALL-in\PLATFORM\editing-v2\resources\views/user/editor/utama/utama.blade.php ENDPATH**/ ?>