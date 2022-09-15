@extends('user.admin.utama.utama')
@section('css')
  <link rel="stylesheet" href="/css/admin/setting-detail-programs.css">
  <style>
    .selectize-input {padding: 8px 16px; border-radius: 6px}
    .alert {font-size: 14px}
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

        @if(session()->has('update-program-successful'))
        <div class="row alert alert-success fade show d-flex justify-content-between" role="alert">
          {{ session()->get('update-program-successful') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                <img class="img-fluid" id="img-profile" src={{ asset('uploaded_files/programs/'.$program->images) }} alt="">
              </div>
            </div>
            <div class="col d-none px-md-4 px-3" id="chooseFile">
              <div class="mb-4">
                <input class="form-control form-control-sm" id="formFileSm" name="uploaded_file" form="form-program" type="file" onchange="previewImage()">
              </div>
            </div>
          </div>
          
          <div class="col-md-8 col-12 p-0 userCard">
            <div class="headline d-flex justify-content-between" style="padding: 20px 24px !important">
              <div class="col-md-6 col-8 d-flex align-items-center gap-md-3 gap-2">
                <img src="/assets/program.png" alt="">
                <h6>Program</h6>
              </div>
              <div class="col-md-4 col-4 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                <a href="/admin/setting/programs"><img src="/assets/back.png" alt="" style="width: auto; height: 32px"></a>
                <button class="btn-edit border-0" onclick="enableEdit()">
                  <img src="/assets/pencil.png" alt="">
                </button>
                <form action="{{ route('delete-program', ['program_id' => $program->id_program]) }}" method="POST">
                  @method('DELETE')
                  @csrf
                  <button type="submit" class="btn-delete border-0">
                    <img src="/assets/delete.png" alt="">
                  </button>
                </form>
              </div>
            </div>
            
            <div class="row profile-editor px-md-3 py-md-4 px-3 py-4" style="overflow: auto !important">
              <form action="{{ route('update-program', ['program_id' => $program->id_program]) }}" class="p-0" id="form-program" onsubmit="swal.showLoading()" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="col-12 d-flex mb-3">
                  <div class="col-6">
                    <h6 class="pb-2">Program Name :</h6>
                    <input type="text" class="form-control inputField py-2 px-3" id="name" name="program_name" disabled value="{{ $program->program_name }}">
                  </div>
                  <div class="col-6">
                    <h6 class="pb-2">Program Category :</h6>
                    <select class="select-normal" style="width: 96.5%;" name="id_category">
                      <option value="{{ $program->category->id_category }}">{{ $program->category->category_name }}</option>
                      @foreach ($category as $category)
                        <option value="{{ $category->id_category }}">{{ $category->category_name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-12 d-flex mb-3" style="overflow: auto !important; padding-right: 3%;">
                  <div class="col">
                    <h6 class="pb-2">Description :</h6>
                    <textarea name="description" class="textarea" placeholder="Description">{{ $program->description }}</textarea>
                  </div>
                </div>
                <div class="col-12 d-flex mb-3">
                  <div class="col-6">
                    <h6 class="pb-2">Price :</h6>
                    <input type="number" class="form-control inputField py-2 px-3" id="price" name="price" disabled value="{{ $program->price }}">
                  </div>
                  <div class="col-6">
                    <h6 class="pb-2">Discount :</h6>
                    <input type="number" class="form-control inputField py-2 px-3" id="discount" name="discount" disabled value="{{ $program->discount }}">
                  </div>
                </div>
                <div class="col-12 d-flex mb-3">
                  <div class="col-6">
                    <div class="col d-flex flex-lg-row flex-column mb-3" style="padding-right: 3%">
                      <div class="col-lg-6 col mb-lg-0 mb-3">
                        <h6 class="pb-2">Minimum Words :</h6>
                        <input type="number" class="form-control inputField py-2 px-3" id="min" name="minimum_word" disabled value="{{ $program->minimum_word }}">
                      </div>
                      <div class="col-lg-6 col">
                        <h6 class="pb-2">Maximum Words :</h6>
                        <input type="number" class="form-control inputField py-2 px-3" id="max" name="maximum_word" disabled value="{{ $program->maximum_word }}">
                      </div>
                    </div>
                  </div>
                  <div class="col-6" style="padding-right: 3%">
                    <h6 class="pb-2">Completed Within :</h6>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control py-2 px-3" id="complete" name="completed_within" disabled value="{{ $program->completed_within }}" aria-describedby="basic-addon1">
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

@section('js')
<script>
  var check = false;
  function enableEdit(){
    var chooseFile = document.getElementById('chooseFile');
    var name = document.getElementById('name');
    var price = document.getElementById('price');
    var discount = document.getElementById('discount');
    var min = document.getElementById('min');
    var max = document.getElementById('max');
    var complete = document.getElementById('complete');
    var btnAddUniv = document.getElementById('btnAddUniv');
    if (check == false){
      chooseFile.classList.remove('d-none');
      name.disabled = false;
      price.disabled = false;
      discount.disabled = false;
      min.disabled = false;
      max.disabled = false;
      complete.disabled = false;
      btnAddUniv.classList.remove('d-none');
      check = true;
    } else if (check == true){
      chooseFile.classList.add('d-none');
      name.disabled = true;
      price.disabled = true;
      discount.disabled = true;
      min.disabled = true;
      max.disabled = true;
      complete.disabled = true;
      btnAddUniv.classList.add('d-none');
      check = false;
    }
  }
</script>
@endsection