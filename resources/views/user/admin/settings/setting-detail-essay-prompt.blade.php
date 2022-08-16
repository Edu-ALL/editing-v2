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
        <div class="row">
          <div class="col-12 p-0 userCard">
            <div class="headline d-flex justify-content-between">
              <div class="col-md-6 col-8 d-flex align-items-center gap-md-3 gap-2">
                <img src="/assets/essay-prompt.png" alt="">
                <h6>Essay Prompt</h6>
              </div>
              <div class="col-md-4 col-4 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                <a href="/admin/setting/essay-prompt"><img src="/assets/back.png" alt="" style="width: auto; height: 32px"></a>
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
                  <div class="col-6 me-3">
                    <h6 class="pb-2">University Name :</h6>
                    <input type="text" class="form-control inputField py-2 px-3" id="university" disabled>
                  </div>
                  <div class="col-6">
                    <h6 class="pb-2">Title :</h6>
                    <input type="text" class="form-control inputField py-2 px-3" id="title" disabled>
                  </div>
                </div>
                <div class="col-12 d-flex mb-4" style="overflow: auto !important">
                  <div class="col">
                    <h6 class="pb-2">Description :</h6>
                    <textarea name="" class="textarea" placeholder="Description"></textarea>
                  </div>
                </div>
                <div class="col-12 d-flex mb-5" style="overflow: auto !important">
                  <div class="col">
                    <h6 class="pb-2">Notes :</h6>
                    <textarea name="" class="textarea" placeholder="Notes"></textarea>
                  </div>
                </div>
                <div class="col-12 d-none d-flex justify-content-center pt-3" id="btnUpdateUniv" style="border-top: 1px solid var(--light-grey)">
                  <button class="btn btn-update d-flex align-items-center gap-2">
                    <img src="/assets/update.png" alt="">
                    <h6>Update Essay Prompt</h6>
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