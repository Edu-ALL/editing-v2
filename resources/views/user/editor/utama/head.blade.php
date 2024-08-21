<div class="row head py-4 align-items-center">
    <div class="col-md-6 col-10 ps-md-5 ps-3">
        <h4 class="">Editor Dashboard</h4>
    </div>
    <div class="col-md-6 col-2 pe-md-5 pe-3">
        <div class="head-content d-flex flex-row align-items-center justify-content-end gap-md-4 gap-3">
            <a class="help d-flex flex-row align-items-center gap-md-2 gap-1" href="/editor/help">
                <img class="img-fluid" src="/assets/help-grey.png" alt="">
                <h6 class="d-none d-md-inline">Help</h6>
            </a>
            <a class="help d-flex flex-row align-items-center gap-md-2 gap-1" href="/editor/profile">
                <img class="img-fluid" src="/assets/profile-grey.png" alt="">
                <h6 class="pt-1 d-none d-md-inline">
                    {{ Auth::guard('web-editor')->user()->first_name . ' ' . Auth::guard('web-editor')->user()->last_name }}
                </h6>
            </a>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mx-2 my-1" role="alert">
        <strong>Oops!</strong> {{ implode("\n", $errors->all()) }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
