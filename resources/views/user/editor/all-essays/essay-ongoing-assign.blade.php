@extends('user.editor.utama.utama')
@section('css')
  <link rel="stylesheet" href="/css/admin/essay-ongoing-detail.css">
@endsection

@section('content')
<div class="container-fluid" style="padding: 0">
  <div class="row flex-nowrap main" id="main">

    {{-- Sidenav --}}
    @include('user.editor.utama.menu')

    {{-- Content --}}
    <div class="col" style="overflow: auto !important">
      @include('user.editor.utama.head')
      <div class="container main-content m-0">
        <div class="row gap-2">
          <div class="col-md col-12 p-0 userCard profile" style="cursor: default">
            <div class="headline d-flex align-items-center gap-3">
              <img src="/assets/status.png" alt="">
              <h6>Status</h6>
            </div>
            <div class="col d-flex flex-column align-items-center px-3 py-md-5 py-4 gap-3 text-center justify-content-center" style="color: var(--black)">
              <img class="img-status" src="/assets/status-edit.png" alt="">
              <h6>{{ $essay->status->status_title }}</h6>
            </div>
            <div class="headline d-flex align-items-center gap-3">
              <img src="/assets/file.png" alt="">
              <h6>Download Student Essay</h6>
            </div>
            <div class="col d-flex align-items-center justify-content-center py-md-4 py-4">
              <img class="img-word" src="/assets/logo-word.png" alt="">
            </div>
            <div class="col d-flex align-items-center justify-content-center pb-md-3 pb-3">
              <a class="btn btn-download d-flex align-items-center gap-2" href={{ asset('uploaded_files/program/essay/students/'.$essay->attached_of_clients) }}>
                <img src="/assets/download.png" alt="">
                <h6>Download</h6>
              </a>
            </div>
            <div class="headline d-flex align-items-center gap-3">
              <img src="/assets/assign.png" alt="">
              <h6>Assignment</h6>
            </div>
            <div class="col d-flex flex-column px-3 pt-md-4 pt-4 pb-2 text-center justify-content-center" style="color: var(--black)">
              <h6 style="font-size: 14px; font-weight: 500">{{ $essay->essay_editors->editor->first_name.' '.$essay->essay_editors->editor->last_name }}</h6>
            </div>
            <div class="col d-flex align-items-center justify-content-center py-md-3 py-3">
              <form action="{{ route('cancel-editor', ['id_essay' => $essay->id_essay_clients]) }}" method="POST" class="p-0">
                @csrf
                <button class="btn btn-download d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#selectEditor" style="background-color: var(--red); color: var(--white)">
                  <img src="/assets/exit.png" alt="">
                  <h6>Cancel</h6>
                </button>
              </form>
            </div>
            @if (isset($essay->essay_editors->notes_editors))
              <div class="headline d-flex align-items-center gap-3">
                <img src="/assets/download.png" alt="">
                <h6>Notes</h6>
              </div>
              <div class="col d-flex flex-column px-3 py-md-4 py-4 my-md-1 countEssay text-center justify-content-center" style="color: var(--black)">
                <div class="col d-flex flex-row flex-wrap gap-2 justify-content-center" style="font-size:12px">
                    {!! $essay->essay_editors->notes_editors !!}
                </div>
              </div>
            @endif
          </div>
          
          <div class="col-md-8 col-12 p-0 userCard" style="cursor: default">
            <div class="headline d-flex justify-content-between">
              <div class="col-md-6 col-8 d-flex align-items-center gap-3">
                <img src="/assets/student.png" alt="">
                <h6>Student Detail</h6>
              </div>
              <div class="col-md-4 col-4 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                <a href="/editor/all-essays/assigned-essay-list"><img src="/assets/back.png" alt=""></a>
              </div>
            </div>
            <div class="row profile-editor px-md-4 py-md-4 px-3 py-4 mb-2" style="overflow: auto !important">
              <div class="col-md student-desc d-flex flex-column justify-content-center gap-lg-3 gap-2 ps-lg-3 px-2 border-0">
                <div class="row d-flex align-items-center">
                  <div class="col-md-3 col-3">
                    <h6>Full Name</h6>
                  </div>
                  <div class="col-1 titik2"><p>:</p></div>
                  <div class="col-7">
                    <p>{{ $essay->client_by_id->first_name.' '.$essay->client_by_id->last_name }}</p>
                  </div>
                </div>
                <div class="row d-flex align-items-center">
                  <div class="col-md-3 col-3">
                    <h6>Email</h6>
                  </div>
                  <div class="col-1 titik2"><p>:</p></div>
                  <div class="col-7">
                    <p>{{ $essay->client_by_id->email ? $essay->client_by_id->email : '-' }}</p>
                  </div>
                </div>
                <div class="row d-flex align-items-center">
                  <div class="col-md-3 col-3">
                    <h6>Address</h6>
                  </div>
                  <div class="col-1 titik2"><p>:</p></div>
                  <div class="col-7">
                    <p>{!! $essay->client_by_id->address ? $essay->client_by_id->address : '-' !!}</p>
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
            <div class="row profile-editor px-md-3 py-md-4 px-3 py-4" style="overflow: auto !important">
              <form action="" class="p-0">
                <div class="col-12 d-flex flex-lg-row flex-column mb-3 gap-lg-2 gap-3">
                  <div class="col">
                    <h6 class="pb-2">University Name :</h6>
                    <input type="text" class="form-control inputField py-2 px-3 w-100" disabled value="{{ $essay->university->university_name }}">
                  </div>
                  <div class="col">
                    <h6 class="pb-2">Essay Title :</h6>
                    <input type="text" class="form-control inputField py-2 px-3 w-100" disabled value="{{ $essay->essay_title }}">
                  </div>
                </div>
                <div class="col-12 d-flex mb-4" style="overflow: auto !important">
                  <div class="col">
                    <h6 class="pb-2">Concern :</h6>
                    <textarea name="" class="textarea" style="overflow: auto !important">{{ $essay->essay_prompt }}</textarea>
                  </div>
                </div>
                <div class="col-12 d-flex mb-4" style="overflow: auto !important">
                  <div class="col">
                    <h6 class="pb-2">Notes :</h6>
                    <div style="font-size:12px">{!! $essay->essay_notes !!}</div>
                  </div>
                </div>
                <div class="col-12 d-flex flex-lg-row flex-column mb-3 gap-lg-2 gap-3">
                  <div class="col">
                    <h6 class="pb-2">Essay Deadline :</h6>
                    <input type="text" class="form-control inputField py-2 px-3 w-100" disabled value="{{ date('D, d M Y', strtotime($essay->essay_deadline)) }}">
                  </div>
                  <div class="col">
                    <h6 class="pb-2">Application Deadline :</h6>
                    <input type="text" class="form-control inputField py-2 px-3 w-100" disabled value="{{ date('D, d M Y', strtotime($essay->application_deadline)) }}">
                  </div>
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
{{-- Modal Info --}}
<div class="modal fade" id="info" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog d-flex align-items-center justify-content-center">
    <div class="modal-content border-0 w-75">
      <div class="modal-header">
        <div class="col d-flex gap-1 align-items-center">
          <img src="/assets/info.png" alt="">
          <h6 class="modal-title ms-3">Please</h6>
        </div>
        <div type="button" data-bs-dismiss="modal" aria-label="Close">
          <img src="/assets/close.png" alt="" style="height: 26px">
        </div>
      </div>
      <div class="modal-body text-center px-4 py-4 my-md-3">
        <p>Waiting for accepted by editor <span style="color: var(--red)">*</span></p>
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