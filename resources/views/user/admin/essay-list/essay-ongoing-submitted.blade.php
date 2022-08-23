@extends('user.admin.utama.utama')
@section('css')
  <link rel="stylesheet" href="/css/admin/essay-ongoing-detail.css">
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
              <img src="/assets/status.png" alt="">
              <h6>Status</h6>
            </div>
            <div class="col d-flex flex-column align-items-center px-3 py-md-5 py-4 gap-3 text-center justify-content-center" style="color: var(--black)">
              <img class="img-status" src="/assets/status-ongoing.png" alt="">
              <h6>Assigned to editor</h6>
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
          
          <div class="col-md-8 col-12 p-0 userCard">
            <div class="headline d-flex justify-content-between">
              <div class="col-md-6 col-8 d-flex align-items-center gap-3">
                <img src="/assets/student.png" alt="">
                <h6>Student Detail</h6>
              </div>
              <div class="col-md-4 col-4 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                <a href="/admin/essay-list/completed"><img src="/assets/back.png" alt=""></a>
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
                <div class="row d-flex align-items-center">
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
            <div class="row profile-editor px-md-3 py-md-4 px-3 py-4">
              <form action="" class="p-0">
                <div class="col-12 d-flex mb-3">
                  <div class="col-6">
                    <h6 class="pb-2">University Name :</h6>
                    <input type="text" class="form-control inputField py-2 px-3" disabled value="Arizona State University">
                  </div>
                  <div class="col-6">
                    <h6 class="pb-2">Essay Title :</h6>
                    <input type="text" class="form-control inputField py-2 px-3" disabled value="Supplemental Essay">
                  </div>
                </div>
                <div class="col-12 d-flex mb-4" style="overflow: auto !important">
                  <div class="col">
                    <h6 class="pb-2">Essay Prompt :</h6>
                    <textarea name="" class="textarea" style="overflow: auto !important"></textarea>
                  </div>
                </div>
                <div class="col-12 d-flex mb-3">
                  <div class="col-6">
                    <h6 class="pb-2">Essay Deadline :</h6>
                    <input type="text" class="form-control inputField py-2 px-3" disabled value="Arizona State University">
                  </div>
                  <div class="col-6">
                    <h6 class="pb-2">Application Deadline :</h6>
                    <input type="text" class="form-control inputField py-2 px-3" disabled value="Supplemental Essay">
                  </div>
                </div>
                <div class="col-12 d-flex flex-lg-row flex-column mb-3">
                  <div class="col">
                    <div class="col mb-3">
                      <h6 class="pb-2">Essay Deadline :</h6>
                      <input type="text" class="form-control inputField py-2 px-3" disabled value="Arizona State University">
                    </div>
                    <div class="col mb-3">
                      <h6 class="pb-2">Tags :</h6>
                      <div class="col d-flex flex-wrap gap-1 list-tags pe-2">
                        <div class="tags py-2 px-3">
                          <h6 style="font-size: 12px; font-weight: 500">The role model</h6>
                        </div>
                        <div class="tags py-2 px-3">
                          <h6 style="font-size: 12px; font-weight: 500">The model</h6>
                        </div>
                        <div class="tags py-2 px-3">
                          <h6 style="font-size: 12px; font-weight: 500">The role</h6>
                        </div>
                      </div>
                    </div>
                    <div class="col mb-3">
                      <h6 class="pb-2">Editor Essay :</h6>
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
                  </div>
                  <div class="col-lg-7 col">
                    <div class="col">
                      <h6 class="pb-2">Notes :</h6>
                      <textarea name="" class="textarea" style="overflow: auto !important"></textarea>
                    </div>
                    <div class="col d-flex align-items-center justify-content-center py-3">
                      <form action="">
                        <button class="btn btn-download d-flex align-items-center gap-2" style="background-color: var(--red)">
                          <img src="/assets/danger.png" alt="">
                          <h6>Revise</h6>
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="col-12 d-flex justify-content-center pt-3" style="border-top: 1px solid var(--light-grey)">
                  <button class="btn btn-create d-flex align-items-center gap-2" style="background-color: var(--green)">
                    <img src="/assets/assign-list.png" alt="">
                    <h6>Accept</h6>
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
  $(document).ready(function(){
      $("#info").modal('show');
  });
</script>
@endsection