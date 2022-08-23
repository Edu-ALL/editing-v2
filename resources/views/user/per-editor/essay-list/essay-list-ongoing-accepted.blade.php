@extends('user.per-editor.utama.utama')

@section('content')
<div class="container-fluid">
  <div class="row flex-nowrap main" id="main">

    {{-- Sidenav --}}
    @include('user.per-editor.utama.menu')

    {{-- Content --}}
    <div class="col" style="overflow: auto !important">
      @include('user.per-editor.utama.head')
      <div class="container main-content m-0">
        <div class="row gap-2">
          <div class="col-md col-12 p-0 userCard profile">
            <div class="headline d-flex align-items-center gap-3">
              <img src="/assets/status.png" alt="">
              <h6>Status</h6>
            </div>
            <div class="col d-flex flex-column align-items-center px-3 py-md-5 py-4 gap-3 text-center justify-content-center" style="color: var(--black)">
              <img class="img-status" src="/assets/status-ongoing.png" alt="">
              <h6>Accepted and Ongoing</h6>
            </div>
            <div class="headline d-flex align-items-center gap-3">
              <img src="/assets/file.png" alt="">
              <h6>Download Student Essay</h6>
            </div>
            <div class="col d-flex align-items-center justify-content-center py-md-4 py-4">
              <img class="img-word" src="/assets/logo-word.png" alt="">
            </div>
            <div class="col d-flex align-items-center justify-content-center pb-md-3 pb-3">
              <form action="">
                <button class="btn btn-download d-flex align-items-center gap-2">
                  <img src="/assets/download.png" alt="">
                  <h6>Download</h6>
                </button>
              </form>
            </div>
          </div>
          
          <div class="col-md-8 col-12 p-0 userCard profile">
            <div class="headline d-flex justify-content-between">
              <div class="col-md-6 col-8 d-flex align-items-center gap-3">
                <img src="/assets/student.png" alt="">
                <h6>Student Detail</h6>
              </div>
              <div class="col-md-4 col-4 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                <a href="/editors/essay-list"><img src="/assets/back.png" alt=""></a>
              </div>
            </div>
            <div class="row profile-editor px-md-4 py-md-4 px-3 py-4 mb-2" style="overflow: auto !important">
              <div class="col-md student-desc d-flex flex-column justify-content-center gap-lg-3 gap-2 ps-lg-3 px-2 border-0">
                <div class="row d-flex align-items-center">
                  <div class="col-md-3 col-4">
                    <h6>Full Name</h6>
                  </div>
                  <div class="col-1 titik2"><p>:</p></div>
                  <div class="col-7">
                    <p>Student Dummy</p>
                  </div>
                </div>
                <div class="row d-flex align-items-center">
                  <div class="col-md-3 col-4">
                    <h6>Email</h6>
                  </div>
                  <div class="col-1 titik2"><p>:</p></div>
                  <div class="col-7">
                    <p>student.dummy@gmail.com</p>
                  </div>
                </div>
                <div class="row d-flex">
                  <div class="col-md-3 col-4">
                    <h6>Address</h6>
                  </div>
                  <div class="col-1 titik2"><p>:</p></div>
                  <div class="col-7">
                    <p>Jl Jeruk Kembar blok Q9 no.15</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="headline d-flex justify-content-between">
              <div class="col d-flex align-items-center gap-3">
                <img src="/assets/detail.png" alt="">
                <h6>Essay Detail</h6>
              </div>
            </div>
            <div class="row profile-editor px-md-4 py-md-4 px-3 py-4 mb-3" style="overflow: auto !important">
              <div class="col-md student-desc d-flex flex-column justify-content-center gap-lg-3 gap-2 ps-lg-3 px-2 border-0">
                <div class="row d-flex align-items-center">
                  <div class="col-md-3 col-4">
                    <h6>University Name</h6>
                  </div>
                  <div class="col-1 titik2"><p>:</p></div>
                  <div class="col-7">
                    <p>Arizona State University</p>
                  </div>
                </div>
                <div class="row d-flex align-items-center">
                  <div class="col-md-3 col-4">
                    <h6>Essay Type</h6>
                  </div>
                  <div class="col-1 titik2"><p>:</p></div>
                  <div class="col-7">
                    <p>Supplemental Essay</p>
                  </div>
                </div>
                <div class="row d-flex align-items-center">
                  <div class="col-md-3 col-4">
                    <h6>Essay Prompt</h6>
                  </div>
                  <div class="col-1 titik2"><p>:</p></div>
                  <div class="col-7">
                    <p>Essay</p>
                  </div>
                </div>
                <div class="row d-flex">
                  <div class="col-md-3 col-4">
                    <h6>Date</h6>
                  </div>
                  <div class="col-1 titik2"><p>:</p></div>
                  <div class="col-7 ps-3">
                    <ul class="d-flex flex-column gap-2">
                      <li><p><b>Essay Deadline</b> : Thu, 28 Jul 2022</p></li>
                      <li><p><b>Application Deadline</b> : Fri, 29 Jul 2022</p></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="headline d-flex justify-content-between">
              <div class="col d-flex align-items-center gap-3">
                <img src="/assets/file.png" alt="">
                <h6>Upload Your File</h6>
              </div>
            </div>
            <div class="row field px-md-3 py-md-4 px-3 py-4" style="overflow: auto !important">
              <form action="" class="p-0">
                <div class="col-12 d-flex mb-3">
                  <div class="col-6">
                    <h6 class="pb-2">Upload Your File :</h6>
                    <div class="col" id="chooseFile">
                      <div class="h-100">
                        <input class="form-control form-control-sm inputField h-100" id="formFileSm" type="file">
                      </div>
                      <h6 class="pt-2" style="font-size: 10px; color: var(--red)">* Upload your essay with the '.docx' format</h6>
                    </div>
                  </div>
                  <div class="col-6">
                    <h6 class="pb-2">Tags :</h6>
                    <select class="select-beast">
                      <option value=""></option>
                      <option value="value 1">Associate Editor</option>
                      <option value="value 2">Senior Editor</option>
                      <option value="value 3">Managing Editor</option>
                    </select>
                  </div>
                </div>
                <div class="col-12 d-flex mb-3">
                  <div class="col-md-6 col">
                    <h6 class="pb-2">Work Duration :</h6>
                    <input type="number" class="form-control inputField py-2 px-3" id="pass">
                  </div>
                </div>
                <div class="col-12 d-flex mb-2" style="overflow: auto !important">
                  <div class="col">
                    <h6 class="pb-2">Descriptions :</h6>
                    <textarea name="" class="textarea" placeholder="Descriptions"></textarea>
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
            <div class="col-12 d-flex py-3 mt-4" style="border-top: 1px solid var(--light-grey)">
              <div class="col d-flex flex-row align-items-center justify-content-center gap-3">
                <form action="/editors/essay-list/ongoing/submitted">
                  <button class="btn btn-download d-flex align-items-center gap-2" style="background-color: var(--blue)">
                    <img src="/assets/upload.png" alt="">
                    <h6>Upload Your File</h6>
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
    {{-- End Content --}}
  </div>
</div>

{{-- Modal Info --}}
<div class="modal fade" id="info" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog d-flex align-items-center justify-content-center">
    <div class="modal-content border-0 w-75">
      <div class="modal-header" style="background-color: var(--green)">
        <div class="col d-flex gap-1 align-items-center">
          <img src="/assets/thumbsup.png" alt="">
          <h6 class="modal-title ms-3">Congratulations</h6>
        </div>
        <div type="button" data-bs-dismiss="modal" aria-label="Close">
          <img src="/assets/close.png" alt="" style="height: 26px">
        </div>
      </div>
      <div class="modal-body text-center px-4 py-4 my-md-3">
        <p>Student Essay Was Accepted <span style="color: var(--red)">*</span></p>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
  $(document).ready(function(){
      $("#info").modal('show');
  });
</script>
@endsection