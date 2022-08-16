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
        <div class="row gap-2">
          <div class="col-md col-12 p-0 userCard profile">
            <div class="headline d-flex align-items-center gap-3">
              <img src="/assets/pic.png" alt="">
              <h6>Editor</h6>
            </div>
            <div class="col d-flex align-items-center justify-content-center py-md-4 py-4">
              <div class="pic-profile">
                <img class="img-fluid" src="/assets/editor-bg.png" alt="">
              </div>
            </div>
          </div>
          
          <div class="col-md-8 col-12 p-0 userCard">
            <div class="headline d-flex justify-content-between">
              <div class="col-md-6 col-8 d-flex align-items-center gap-md-3 gap-2">
                <img src="/assets/edit.png" alt="">
                <h6>Profile New Editor</h6>
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
                    <input type="text" class="form-control inputField py-2 px-3">
                  </div>
                  <div class="col-6">
                    <h6 class="pb-2">Last Name :</h6>
                    <input type="text" class="form-control inputField py-2 px-3">
                  </div>
                </div>
                <div class="col-12 d-flex mb-3">
                  <div class="col-6">
                    <h6 class="pb-2">Email :</h6>
                    <input type="email" class="form-control inputField py-2 px-3">
                  </div>
                  <div class="col-6">
                    <h6 class="pb-2">Phone :</h6>
                    <input type="text" class="form-control inputField py-2 px-3">
                  </div>
                </div>
                <div class="col-12 d-flex mb-3">
                  <div class="col-6">
                    <h6 class="pb-2">Graduated From :</h6>
                    <input type="text" class="form-control inputField py-2 px-3">
                  </div>
                  <div class="col-6">
                    <h6 class="pb-2">Major :</h6>
                    <input type="text" class="form-control inputField py-2 px-3">
                  </div>
                </div>
                <div class="col-12 d-flex mb-3" style="overflow: auto !important">
                  <div class="col">
                    <h6 class="pb-2">Address :</h6>
                    <textarea name="" class="textarea" placeholder="Address"></textarea>
                  </div>
                </div>
                <div class="col-12 d-flex mb-5">
                  <div class="col">
                    <h6 class="pb-2">Position :</h6>
                    <select class="select-beast inputField">
                      <option value="value 1">Value 1</option>
                      <option value="value 2">Value 2</option>
                      <option value="value 3">Value 3</option>
                    </select>
                  </div>
                </div>
                <div class="col-12 d-flex justify-content-center pt-3" style="border-top: 1px solid var(--light-grey)">
                  <button class="btn btn-create d-flex align-items-center gap-2">
                    <img src="/assets/add-people.png" alt="">
                    <h6>Create Editor</h6>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- End Content --}}
  </div>
</div>
@endsection