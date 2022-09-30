@extends('user.admin.utama.utama')
@section('css')
  <link rel="stylesheet" href="/css/admin/setting-detail-universities.css">
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
        <div class="row gap-2">
          <div class="col-md col-12 p-0 userCard profile">
            <div class="headline d-flex align-items-center gap-3">
              <img src="/assets/pic.png" alt="">
              <h6>Profile Picture</h6>
            </div>
            <div class="col d-flex align-items-center justify-content-center py-md-4 py-4">
              <div class="pic-profile d-flex align-items-center justify-content-center">
                <img class="img-fluid" id="img-profile" src=
                  @if ($university->photo != "default.png" && $university->photo != NULL)
                    {{ asset('uploaded_files/univ/'.$university->photo) }}
                  @else
                    {{ "/assets/editor-bg.png" }}
                  @endif alt="">
              </div>
            </div>
            <div class="col d-none px-md-4 px-3" id="chooseFile">
              <div class="mb-4">
                <input class="form-control form-control-sm" id="formFileSm" name="uploaded_file" type="file" form="form-university" onchange="previewImage()">
              </div>
            </div>
          </div>
          
          <div class="col-md-8 col-12 p-0 userCard">
            <div class="headline d-flex justify-content-between" style="padding: 21px 24px !important;">
              <div class="col-md-6 col-8 d-flex align-items-center gap-md-3 gap-2">
                <img src="/assets/university.png" alt="">
                <h6>University</h6>
              </div>
              <div class="col-md-4 col-4 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                <a href="/admin/setting/universities"><img src="/assets/back.png" alt="" style="width: auto; height: 32px"></a>
                <button class="btn-edit border-0" onclick="enableEdit()">
                  <img src="/assets/pencil.png" alt="">
                </button>
                <form action="{{ route('delete-university', ['uni_id' => $university->id_univ]) }}" method="POST">
                  @method('DELETE')
                  @csrf
                  <button type="submit" class="btn-delete border-0">
                    <img src="/assets/delete.png" alt="">
                  </button>
                </form>
              </div>
            </div>
            
            <div class="row profile-editor px-md-3 py-md-4 px-3 py-4" style="overflow: auto !important">
              <form action="{{ route('update-university', ['uni_id' => $university->id_univ]) }}" class="p-0" id="form-university" onsubmit="swal.showLoading()" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="col-12 d-flex mb-3">
                  <div class="col-6">
                    <h6 class="pb-2">University Name :</h6>
                    <input type="text" name="university_name" class="form-control inputField py-2 px-3" id="university" value="{{ $university->university_name }}" disabled>
                  </div>
                  <div class="col-6">
                    <h6 class="pb-2">Email :</h6>
                    <input type="email" name="email" class="form-control inputField py-2 px-3" id="email" value="{{ $university->univ_email }}" disabled>
                  </div>
                </div>
                <div class="col-12 d-flex mb-3">
                  <div class="col-12">
                    <h6 class="pb-2">Website :</h6>
                    <input type="url" pattern="https://.*" placeholder="https://" name="website" class="form-control inputField py-2 px-3" id="website" style="width: 96.5%;" value="{{ $university->website }}" disabled>
                  </div>
                </div>
                <div class="col-12 d-flex mb-3">
                  <div class="col-6">
                    <h6 class="pb-2">Phone :</h6>
                    <input type="text" name="phone" class="form-control inputField py-2 px-3" id="phone" value="{{ $university->phone }}" disabled>
                  </div>
                  <div class="col-6">
                    <h6 class="pb-2">Country :</h6>
                    <input type="text" name="country" class="form-control inputField py-2 px-3" id="country" value="{{ $university->country }}" disabled>
                  </div>
                </div>
                <div class="col-12 d-flex mb-5" style="overflow: auto !important">
                  <div class="col">
                    <h6 class="pb-2">Address :</h6>
                    <textarea name="address" class="textarea" placeholder="Address">{{ $university->address }}</textarea>
                  </div>
                </div>
                <div class="col-12 d-none d-flex justify-content-center pt-3" id="btnAddUniv" style="border-top: 1px solid var(--light-grey)">
                  <button type="submit" class="btn btn-create d-flex align-items-center gap-2">
                    <img src="/assets/update.png" alt="">
                    <h6>Update University</h6>
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
    var univ = document.getElementById('university');
    var email = document.getElementById('email');
    var web = document.getElementById('website');
    var phone = document.getElementById('phone');
    var country = document.getElementById('country');
    var btnAddUniv = document.getElementById('btnAddUniv');
    if (check == false){
      chooseFile.classList.remove('d-none');
      univ.disabled = false;
      email.disabled = false;
      web.disabled = false;
      phone.disabled = false;
      country.disabled = false;
      btnAddUniv.classList.remove('d-none');
      check = true;
    } else if (check == true){
      chooseFile.classList.add('d-none');
      univ.disabled = true;
      email.disabled = true;
      web.disabled = true;
      phone.disabled = true;
      country.disabled = true;
      btnAddUniv.classList.add('d-none');
      check = false;
    }
  }
</script>
@endsection