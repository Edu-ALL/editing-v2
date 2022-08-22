@extends('user.admin.utama.utama')
@section('css')
  <link rel="stylesheet" href="/css/admin/setting-add-essay-prompt.css">
@endsection

@section('content')
<div class="container-fluid" style="padding: 0">
  <div class="row flex-nowrap main">

    {{-- Sidenav --}}
    @include('user.admin.utama.menu')

    {{-- Content --}}
    <div class="col" style="overflow: auto !important">
      @include('user.admin.utama.head')
      <div class="container main-content m-0">
        <div class="row">
          <div class="col-12 p-0 userCard">
            <div class="headline d-flex justify-content-between">
              <div class="col-md-6 col-8 d-flex align-items-center gap-md-3 gap-2">
                <img src="/assets/edit.png" alt="">
                <h6>New Essay Prompt</h6>
              </div>
              <div class="col-md-4 col-4 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                <a href="/admin/setting/essay-prompt"><img src="/assets/back.png" alt=""></a>
              </div>
            </div>
            
            <div class="row profile-editor px-md-3 py-md-4 px-3 py-4" style="overflow: auto !important">
              <form action="" class="p-0">
                <div class="col-12 d-flex mb-3">
                  <div class="col-6 me-3">
                    <h6 class="pb-2">University Name :</h6>
                    <input type="text" class="form-control inputField py-2 px-3">
                  </div>
                  <div class="col-6">
                    <h6 class="pb-2">Title :</h6>
                    <input type="text" class="form-control inputField py-2 px-3">
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
                <div class="col-12 d-flex justify-content-center pt-3" style="border-top: 1px solid var(--light-grey)">
                  <button class="btn btn-create d-flex align-items-center gap-2">
                    <img src="/assets/add.png" alt="">
                    <h6>Add Essay Prompt</h6>
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