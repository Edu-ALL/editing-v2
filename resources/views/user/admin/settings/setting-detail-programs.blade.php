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
              <h6>Profile Picture</h6>
            </div>
            <div class="col d-flex align-items-center justify-content-center py-md-4 py-4">
              <div class="pic-profile d-flex align-items-center justify-content-center">
                <img class="img-fluid" id="img-profile" src="/assets/editor-bg.png" alt="">
              </div>
            </div>
            <div class="col d-none px-md-4 px-3" id="chooseFile">
              <div class="mb-4">
                <input class="form-control form-control-sm" id="formFileSm" type="file" onchange="previewImage()">
              </div>
            </div>
          </div>
          
          <div class="col-md-8 col-12 p-0 userCard">
            <div class="headline d-flex justify-content-between">
              <div class="col-md-6 col-8 d-flex align-items-center gap-md-3 gap-2">
                <img src="/assets/program.png" alt="">
                <h6>Program</h6>
              </div>
              <div class="col-md-4 col-4 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                <a href="/admin/setting/programs"><img src="/assets/back.png" alt="" style="width: auto; height: 32px"></a>
                <button class="btn-edit border-0" onclick="enableEdit()">
                  <img src="/assets/pencil.png" alt="">
                </button>
                <button class="btn-delete border-0">
                  <img src="/assets/delete.png" alt="">
                </button>
              </div>
            </div>
            
            <div class="row profile-editor px-md-3 py-md-4 px-3 py-4" style="overflow: auto !important">
              <form action="" class="p-0">
                <div class="col-12 d-flex mb-3">
                  <div class="col-6">
                    <h6 class="pb-2">Program Name :</h6>
                    <input type="text" class="form-control inputField py-2 px-3" id="name" disabled value="Cover Letter Editing">
                  </div>
                  <div class="col-6">
                    <h6 class="pb-2">Program Category :</h6>
                    <input type="text" class="form-control inputField py-2 px-3" id="category" disabled value="Cover Letter Editing">
                  </div>
                </div>
                <div class="col-12 d-flex mb-3" style="overflow: auto !important; padding-right: 3%;">
                  <div class="col">
                    <h6 class="pb-2">Description :</h6>
                    <textarea name="" class="textarea" placeholder="Description"></textarea>
                  </div>
                </div>
                <div class="col-12 d-flex mb-3">
                  <div class="col-6">
                    <h6 class="pb-2">Price :</h6>
                    <input type="number" class="form-control inputField py-2 px-3" id="price" disabled value="0">
                  </div>
                  <div class="col-6">
                    <h6 class="pb-2">Discount :</h6>
                    <input type="number" class="form-control inputField py-2 px-3" id="discount" disabled value="0">
                  </div>
                </div>
                <div class="col-12 d-flex mb-3">
                  <div class="col-6">
                    <div class="col d-flex flex-lg-row flex-column mb-3" style="padding-right: 3%">
                      <div class="col-lg-6 col mb-lg-0 mb-3">
                        <h6 class="pb-2">Minimum Words :</h6>
                        <input type="number" class="form-control inputField py-2 px-3" id="min" disabled value="0">
                      </div>
                      <div class="col-lg-6 col">
                        <h6 class="pb-2">Maximum Words :</h6>
                        <input type="number" class="form-control inputField py-2 px-3" id="max" disabled value="0">
                      </div>
                    </div>
                  </div>
                  <div class="col-6" style="padding-right: 3%">
                    <h6 class="pb-2">Completed Within :</h6>
                    {{-- <input type="text" class="form-control inputField py-2 px-3"> --}}
                    <div class="input-group mb-3">
                      <input type="number" class="form-control py-2 px-3" id="complete" disabled value="0" aria-describedby="basic-addon1">
                      <div class="input-group-prepend">
                        <span class="input-group-text py-2 px-2" id="basic-addon1">Hours</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 d-none d-flex justify-content-center pt-3" id="btnAddUniv" style="border-top: 1px solid var(--light-grey)">
                  <button class="btn btn-create d-flex align-items-center gap-2">
                    <img src="/assets/update.png" alt="">
                    <h6>Update Program</h6>
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