@extends('user.per-editor.utama.utama')

@section('content')
<div class="container-fluid">
  <div class="row flex-nowrap main">

    {{-- Sidenav --}}
    @include('user.per-editor.utama.menu')

    {{-- Content --}}
    <div class="col" style="overflow: auto !important">
      @include('user.per-editor.utama.head')
      <div class="container main-content m-0">
        <div class="row gap-2">
          <div class="col-md col-12 p-0 userCard profile">
            <div class="headline d-flex align-items-center gap-3">
              <img src="/assets/pic.png" alt="">
              <h6>Picture Profile</h6>
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
            <div class="headline d-flex justify-content-between" style="padding: 22px 24px !important">
              <div class="col-md-6 col-8 d-flex align-items-center gap-3">
                <img src="/assets/edit.png" alt="">
                <h6>Profile Editor</h6>
              </div>
              <div class="col-md-4 col-4 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                <button class="btn-edit border-0" onclick="enableEdit()">
                  <img src="/assets/pencil.png" alt="" style="margin-bottom: 2px">
                </button>
              </div>
            </div>
            
            <div class="row field px-md-3 py-md-4 px-3 py-4" style="overflow: auto !important">
              <form action="" class="p-0">
                <div class="col-12 d-flex mb-3">
                  <div class="col-6">
                    <h6 class="pb-2">First Name :</h6>
                    <input type="text" class="form-control inputField py-2 px-3" id="first" disabled>
                  </div>
                  <div class="col-6">
                    <h6 class="pb-2">Last Name :</h6>
                    <input type="text" class="form-control inputField py-2 px-3" id="last" disabled>
                  </div>
                </div>
                <div class="col-12 d-flex mb-3">
                  <div class="col-6">
                    <h6 class="pb-2">Email :</h6>
                    <input type="email" class="form-control inputField py-2 px-3" id="email" disabled>
                  </div>
                  <div class="col-6">
                    <h6 class="pb-2">Phone :</h6>
                    <input type="text" class="form-control inputField py-2 px-3" id="phone" disabled>
                  </div>
                </div>
                <div class="col-12 d-flex mb-3">
                  <div class="col-6">
                    <h6 class="pb-2">Graduated From :</h6>
                    <input type="text" class="form-control inputField py-2 px-3" id="graduated" disabled>
                  </div>
                  <div class="col-6">
                    <h6 class="pb-2">Major :</h6>
                    <input type="text" class="form-control inputField py-2 px-3" id="major" disabled>
                  </div>
                </div>
                <div class="col-12 d-flex mb-3" style="overflow: auto !important">
                  <div class="col">
                    <h6 class="pb-2">Address :</h6>
                    <textarea name="" class="textarea" placeholder="Address"></textarea>
                  </div>
                </div>
                <div class="col-12 d-flex mb-3" style="overflow: auto !important">
                  <div class="col">
                    <h6 class="pb-2">About Me :</h6>
                    <textarea name="" class="textarea" placeholder="About Me"></textarea>
                  </div>
                </div>
                <div class="col-12 d-flex mb-3">
                  <div class="col-6">
                    <h6 class="pb-2">Password :</h6>
                    <input type="password" class="form-control inputField py-2 px-3" id="pass" disabled>
                  </div>
                  <div class="col-6">
                    <h6 class="pb-2">Password Confirm :</h6>
                    <input type="password" class="form-control inputField py-2 px-3" id="confirm" disabled>
                  </div>
                </div>
                <div class="col-12 d-flex mb-4">
                  <div class="col">
                    <h6 class="pb-2" style="font-size: 10px; color: var(--red)">* if you don't want to change your password, don't fill in the password field</h6>
                  </div>
                </div>
                <div class="col-12 d-none d-flex justify-content-center pt-3" id="btnUpdate" style="border-top: 1px solid var(--light-grey)">
                  <button class="btn btn d-flex align-items-center gap-2">
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
    {{-- End Content --}}
  </div>
</div>
@endsection

@section('js')
<script>
  var check = false;
  function enableEdit(){
    var chooseFile = document.getElementById('chooseFile');
    var first = document.getElementById('first');
    var last = document.getElementById('last');
    var email = document.getElementById('email');
    var phone = document.getElementById('phone');
    var graduated = document.getElementById('graduated');
    var major = document.getElementById('major');
    var pass = document.getElementById('pass');
    var confirm = document.getElementById('confirm');
    var btnUpdate = document.getElementById('btnUpdate');
    if (check == false){
      chooseFile.classList.remove('d-none');
      first.disabled = false;
      last.disabled = false;
      email.disabled = false;
      phone.disabled = false;
      graduated.disabled = false;
      major.disabled = false;
      pass.disabled = false;
      confirm.disabled = false;
      btnUpdate.classList.remove('d-none');
      check = true;
    } else if (check == true){
      chooseFile.classList.add('d-none');
      first.disabled = true;
      last.disabled = true;
      email.disabled = true;
      phone.disabled = true;
      graduated.disabled = true;
      major.disabled = true;
      pass.disabled = true;
      confirm.disabled = true;
      btnUpdate.classList.add('d-none');
      check = false;
    }
  }
</script>
@endsection