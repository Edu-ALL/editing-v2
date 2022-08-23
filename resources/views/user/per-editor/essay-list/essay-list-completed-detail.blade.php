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
              <img class="img-status" src="/assets/status-complete.png" alt="">
              <h6>Completed</h6>
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
            <div class="headline d-flex align-items-center gap-3" style="background-color: var(--yellow)">
              <img src="/assets/file.png" alt="">
              <h6>Download Your File</h6>
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
            <div class="headline d-flex align-items-center gap-3">
              <img src="/assets/tags.png" alt="">
              <h6>Tags</h6>
            </div>
            <div class="col d-flex flex-column px-3 py-md-4 py-4 my-md-1 countEssay text-center justify-content-center" style="color: var(--black)">
              <div class="col list-tags">
                <div class="tags py-2 px-3">
                  <h6 style="font-size: 14px; font-weight: 400">The role model</h6>
                </div>
              </div>
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
            <div class="row profile-editor px-md-4 py-md-4 px-3 py-4 mb-2" style="overflow: auto !important">
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
                    <ul>
                      <li><p><b>Essay Deadline</b> : Thu, 28 Jul 2022</p></li>
                      <li><p><b>Application Deadline</b> : Fri, 29 Jul 2022</p></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="col d-flex flex-row alert-complete py-3 px-4" id="alertComplete">
              <div class="col d-flex align-items-center gap-2">
                <img src="/assets/thumbsup.png" alt="">
                <h6><b>Congratulations</b>, editor essay has been completed</h6>
              </div>
              <img src="/assets/exit.png" alt="" onclick="closeAlert()" style="cursor: pointer">
            </div>
          </div>
        </div>
        
      </div>
    </div>
    {{-- End Content --}}
  </div>
</div>
@endsection