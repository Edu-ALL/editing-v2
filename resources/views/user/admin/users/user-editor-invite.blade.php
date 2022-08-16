@extends('user.admin.utama.utama')
@section('content')
<div class="container-fluid" style="padding: 0">
  <div class="row flex-nowrap main">

    {{-- Sidenav --}}
    @include('user.admin.utama.menu')

    {{-- Content --}}
    <div class="col" style="overflow: auto !important">
      <div class="row head py-4 align-items-center">
        <div class="col-md-6 col-10 ps-md-5 ps-3">
          <h4 class="">Admin Dashboard</h4>
        </div>
        <div class="col-md-6 col-2 pe-md-5 pe-3">
          <div class="head-content d-flex flex-row align-items-center justify-content-end gap-md-4 gap-2">
            <a class="help d-flex flex-row align-items-center gap-md-2 gap-1" href="">
              <img class="img-fluid" src="/assets/help-grey.png" alt="">
              <h6 class="d-none d-md-inline">Help</h6>
            </a>
            <a href="">
              <h6 class="pt-1 d-none d-md-inline">Admin Name</h6>
            </a>
          </div>
        </div>
      </div>
      <div class="container main-content m-0">
        {{-- Detail Student --}}
        <div class="row justify-content-center mt-md-5">
          <div class="col-lg-7 col-12 p-0 invite-card">
            <div class="headline d-flex justify-content-between">
              <div class="col-lg col d-flex align-items-center gap-md-3 gap-2">
                <img src="/assets/letter.png" alt="">
                <h6>Send invitation to the essay editor</h6>
              </div>
              <div class="col-md-4 col-2 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                <a href="/admin/user/editor"><img src="/assets/back.png" alt=""></a>
              </div>
            </div>
            <form action="">
              <div class="col d-flex flex-column align-items-center justify-content-center field-content p-3 my-4">
                <div class="col-md-8 col-10 mb-md-4 mb-3">
                  <h6 class="pb-2">Email</h6>
                  <input type="email" class="form-control inputField py-2 px-3">
                </div>
                <button class="btn btn-create d-flex align-items-center gap-2">
                  <img src="/assets/send.png" alt="">
                  <h6>Send Email</h6>
                </button>
              </div>
            </form>
          </div>
        </div>
        {{-- End Detail Student --}}
      </div>
    </div>
    {{-- End Content --}}
  </div>
</div>
@endsection