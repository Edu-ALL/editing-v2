
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row flex-nowrap main">
            <?php echo $__env->make('user.editor.utama.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            
            <div class="col" style="overflow: auto !important">
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
                    <div class="row gap-2">
                        <div class="col-md col-12 p-0 userCard profile">
                            <div class="headline-editor d-flex align-items-center gap-3">
                                <img src="/assets/status.png" alt="">
                                <h6>Status</h6>
                            </div>
                            <div class="col d-flex align-items-center justify-content-center py-md-4 py-4">
                                <div>
                                    <img class="img-fluid" src="/assets/status-bg.png" alt="">
                                </div>
                            </div>
                            <div class="col d-flex align-items-center justify-content-center pb-md-3 pb-3">
                                
                                <h6>Assign To Editor</h6>
                                
                            </div>
                            <div class="headline-editor d-flex align-items-center gap-3">
                                <img src="/assets/completed-essay.png" alt="">
                                <h6>Download Student Essay</h6>
                            </div>
                            <div class="col d-flex align-items-center justify-content-center py-md-4 py-4">
                                <div>
                                    <img class="img-fluid" src="/assets/status-bg.png" alt="">
                                </div>
                            </div>
                            <div class="col d-flex align-items-center justify-content-center pb-md-3 pb-3">
                                
                                <button class="btn btn-create d-flex align-items-center gap-4">
                                    <img src="/assets/update.png" alt="">
                                    <h6>Update Editor</h6>
                                </button>
                                
                            </div>
                            <div class="headline-editor d-flex align-items-center gap-3">
                                <img src="/assets/assign.png" alt="">
                                <h6>Assignment</h6>
                            </div>
                            <div class="col d-flex align-items-center justify-content-center py-md-4 py-4">
                                <div>
                                    <h6>Senior Editor Dummy</h6>
                                </div>
                            </div>
                            <div class="col d-flex align-items-center justify-content-center pb-md-3 pb-3">
                                
                                <button class="btn btn-create d-flex align-items-center gap-4">
                                    <img src="/assets/update.png" alt="">
                                    <h6>Update Editor</h6>
                                </button>
                                
                            </div>
                        </div>

                        <div class="col-md-8 col-12 p-0 userCard">
                            <div class="headline-editor d-flex justify-content-between">
                                <div class="col-md-6 col-8 d-flex align-items-center gap-3">
                                    <img src="/assets/edit.png" alt="">
                                    <h6>View Editor</h6>
                                </div>
                                <div class="col-md-4 col-4 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                                    <a href="/admin/user/editor"><img src="/assets/back.png" alt=""></a>
                                </div>
                            </div>

                            <div class="row profile-editor px-md-3 py-md-4 px-3 py-4" style="overflow: auto !important">
                                <form action="" class="p-0">
                                    <div class="col-12 d-flex mb-3">
                                        <div class="col-6">
                                            <h6 class="pb-2">First Name :</h6>
                                            <input type="text" class="form-control inputField py-2 px-3" disabled
                                                value="Senior Editor">
                                        </div>
                                        <div class="col-6">
                                            <h6 class="pb-2">Last Name :</h6>
                                            <input type="text" class="form-control inputField py-2 px-3" disabled
                                                value="Dummy">
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex mb-3">
                                        <div class="col-6">
                                            <h6 class="pb-2">Email :</h6>
                                            <input type="email" class="form-control inputField py-2 px-3" disabled
                                                value="senioreditor.dummy@example.com">
                                        </div>
                                        <div class="col-6">
                                            <h6 class="pb-2">Phone :</h6>
                                            <input type="text" class="form-control inputField py-2 px-3" disabled
                                                value="12345678">
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex mb-3">
                                        <div class="col-6">
                                            <h6 class="pb-2">Graduated From :</h6>
                                            <input type="text" class="form-control inputField py-2 px-3" disabled
                                                value="BA, UC Berkeley">
                                        </div>
                                        <div class="col-6">
                                            <h6 class="pb-2">Major :</h6>
                                            <input type="text" class="form-control inputField py-2 px-3" disabled
                                                value="Space Travel">
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex mb-3" style="overflow: auto !important">
                                        <div class="col">
                                            <h6 class="pb-2">Address :</h6>
                                            <textarea name="" id="textarea" input="dsad"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex mb-5">
                                        <div class="col">
                                            <h6 class="pb-2">Position :</h6>
                                            <select class="form-select form-select-sm"
                                                aria-label=".form-select-sm example">
                                                <option selected>Open this select menu</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-center pt-3"
                                        style="border-top: 1px solid var(--light-grey)">
                                        <button class="btn btn-create d-flex align-items-center gap-2">
                                            <img src="/assets/update.png" alt="">
                                            <h6>Update Editor</h6>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.editor.utama.utama', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\ALL-in\PLATFORM\editing-v2\resources\views/user/editor/all-essays/editor-list-due-detail.blade.php ENDPATH**/ ?>