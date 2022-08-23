
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row flex-nowrap main">
            <?php echo $__env->make('user.editor.utama.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            
            <div class="col">
                <div class="row head py-4 align-items-center">
                    <div class="col-md-6 col-10 ps-md-5 ps-3">
                        <h4 class="">Editor Dashboard</h4>
                    </div>
                    <div class="col-md-6 col-2 pe-md-5 pe-3">
                        <div class="head-content d-flex flex-row align-items-center justify-content-end gap-md-4 gap-2">
                            <a class="help d-flex flex-row align-items-center gap-md-2 gap-1" href="">
                                <img class="img-fluid" src="/assets/help-grey.png" alt="">
                                <h6 class="d-none d-md-inline">Help</h6>
                            </a>
                            <a href="">
                                <h6 class="pt-1 d-none d-md-inline">Editor Name</h6>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="container main-content m-0">
                    
                    <div class="row">
                        <div class="col-md col-12 p-0 studentList">
                            <div class="headline d-flex justify-content-between">
                                <div class="col-md-6 col-5 d-flex align-items-center gap-md-3 gap-2">
                                    <img src="/assets/editor.png" alt="">
                                    <h6>Editor List</h6>
                                </div>
                                <div class="col-md-4 col-6 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                                    <img src="/assets/reload.png" alt="">
                                    <div class="input-group">
                                        <input type="email" class="form-control inputField py-2 px-3"
                                            placeholder="Search">
                                    </div>
                                </div>
                            </div>
                            <div class="container text-center" style="overflow-x: auto !important">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Editor Name</th>
                                            <th>Email</th>
                                            <th>Due Tomorrow</th>
                                            <th>Due Within 3 Days</th>
                                            <th>Due Within 5 Days</th>
                                            <th>Position</th>
                                            <th>Status</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr onclick="location.href='/editor/list/detail'">
                                            <th scope="row">1</th>
                                            <td>Editor Name Dummy</td>
                                            <td>editordummy@example.com</td>
                                            <td>0 Essay</td>
                                            <td>0 Essay</td>
                                            <td>0 Essay</td>
                                            <td>Managing Editor</td>
                                            <td><span class="badge badge-success">Success</span>
                                            </td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            </a>
                        </div>
                        
                    </div>
                </div>

                
            </div>
        </div>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('user.editor.utama.utama', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\ALL-in\PLATFORM\editing-v2\resources\views/user/editor/editor-list/editor-list.blade.php ENDPATH**/ ?>