@extends('user.admin.utama.utama')
@section('css')
  <link rel="stylesheet" href="/css/admin/setting-add-programs.css">
  <style>
    .selectize-input {padding: 8px 16px; border-radius: 6px}
    .error-style{
      font-size: 12px;
      margin-bottom: 20px;
      padding: 0px;
    }
    .error-style ul {
      list-style-type: none;
      margin: 0px; 
      padding: 0px;
    }
  </style>
@endsection

@section('content')
<div class="container-fluid" style="padding: 0">
  <div class="row flex-nowrap main" id="main">

    {{-- Sidenav --}}
    @include('user.admin.utama.menu')

    {{-- Content --}}
    <div class="col" style="overflow: auto !important">
      @include('user.admin.utama.head')
      <div class="container main-content m-0">

        @if(session()->has('add-program-successful'))
          <div class="row alert alert-success fade show" role="alert">
            {{ session()->get('add-program-successful') }}
          </div>
        @endif

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
            <div class="col px-md-4 px-3">
              <div class="mb-4">
                <input class="form-control form-control-sm" id="formFileSm" name="uploaded_file" form="form-program" type="file" onchange="previewImage()">
              </div>
            </div>
          </div>
          
          <div class="col-md-8 col-12 p-0 userCard">
            <div class="headline d-flex justify-content-between">
              <div class="col-md-6 col-8 d-flex align-items-center gap-md-3 gap-2">
                <img src="/assets/edit.png" alt="">
                <h6>New Program</h6>
              </div>
              <div class="col-md-4 col-4 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                <a href="/admin/setting/programs"><img src="/assets/back.png" alt=""></a>
              </div>
            </div>
            
            <div class="row profile-editor px-md-3 py-md-4 px-3 py-4" style="overflow: auto !important">

              @if($errors->any())
                <div class="error-style">
                  <div class="alert alert-danger" role="alert">
                    <ul>
                      {!! implode('', $errors->all('<li>:message</li>')) !!}
                    </ul>
                    
                  </div>
                </div>
              @endif

              <form action="{{ route('add-program') }}" id="form-program" onsubmit="swal.showLoading()" method="POST" class="p-0" enctype="multipart/form-data">
                @csrf
                <div class="col-12 d-flex mb-3">
                  <div class="col-6">
                    <h6 class="pb-2">Program Name :</h6>
                    <input type="text" class="form-control inputField py-2 px-3" name="program_name">
                  </div>
                  <div class="col-6">
                    <h6 class="pb-2">Program Category :</h6>
                    <select class="select-normal" style="width: 96.5%;" name="id_category">
                      <option value=""></option>
                      @foreach ($category as $category)
                        <option value="{{ $category->id_category }}">{{ $category->category_name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-12 d-flex mb-3" style="overflow: auto !important; padding-right: 3%;">
                  <div class="col">
                    <h6 class="pb-2">Description :</h6>
                    <textarea name="description" class="textarea" placeholder="Description"></textarea>
                  </div>
                </div>
                <div class="col-12 d-flex mb-3">
                  <div class="col-6">
                    <h6 class="pb-2">Price :</h6>
                    <input type="number" class="form-control inputField py-2 px-3" name="price">
                  </div>
                  <div class="col-6">
                    <h6 class="pb-2">Discount :</h6>
                    <input type="number" class="form-control inputField py-2 px-3" name="discount">
                  </div>
                </div>
                <div class="col-12 d-flex mb-3">
                  <div class="col-6">
                    <div class="col d-flex flex-lg-row flex-column mb-3" style="padding-right: 3%">
                      <div class="col-lg-6 col mb-lg-0 mb-3">
                        <h6 class="pb-2">Minimum Words :</h6>
                        <input type="number" class="form-control inputField py-2 px-3" name="min-word">
                      </div>
                      <div class="col-lg-6 col">
                        <h6 class="pb-2">Maximum Words :</h6>
                        <input type="number" class="form-control inputField py-2 px-3" name="max-word">
                      </div>
                    </div>
                  </div>
                  <div class="col-6" style="padding-right: 3%">
                    <h6 class="pb-2">Completed Within :</h6>
                    <div class="input-group mb-3">
                      <input type="text" name="complete-within" class="form-control py-2 px-3" aria-describedby="basic-addon1">
                      <div class="input-group-prepend">
                        <span class="input-group-text py-2 px-2" id="basic-addon1">Hours</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 d-flex justify-content-center pt-3" style="border-top: 1px solid var(--light-grey)">
                  <button class="btn btn-create d-flex align-items-center gap-2">
                    <img src="/assets/add.png" alt="">
                    <h6>Add Program</h6>
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