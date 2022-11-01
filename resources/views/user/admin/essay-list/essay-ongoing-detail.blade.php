@extends('user.admin.utama.utama')
@section('css')
  <link rel="stylesheet" href="/css/admin/essay-ongoing-detail.css">
  <style>
    .pagination { margin: 0}
    .pagination .page-item .page-link { padding: 10px 15px; font-size: 12px; }
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
        <div class="row gap-2">
          <div class="col-md col-12 p-0 userCard profile">
            <div class="headline d-flex align-items-center gap-3">
              <img src="/assets/status.png" alt="">
              <h6>Status</h6>
            </div>
            <div class="col d-flex flex-column align-items-center px-3 py-md-5 py-4 gap-3 text-center justify-content-center" style="color: var(--black)">
              <img class="img-status" src="/assets/status-edit.png" alt="">
              <h6>{{ $ongoing->status->status_title }}</h6>
            </div>
            <div class="headline d-flex align-items-center gap-3">
              <img src="/assets/file.png" alt="">
              <h6>Download Student Essay</h6>
            </div>
            <div class="col d-flex align-items-center justify-content-center py-md-4 py-4">
              <img class="img-word" src="/assets/logo-word.png" alt="">
            </div>
            <div class="col d-flex align-items-center justify-content-center pb-md-3 pb-3">
              <a class="btn btn-download d-flex align-items-center gap-2" href={{ asset('uploaded_files/program/essay/students/'.$ongoing->attached_of_clients) }}>
                <img src="/assets/download.png" alt="">
                <h6>Download</h6>
              </a>
            </div>
            {{-- <div class="headline d-flex align-items-center gap-3">
              <img src="/assets/assign.png" alt="">
              <h6>Assignment</h6>
            </div>
            <div class="col d-flex align-items-center justify-content-center py-md-4 py-4">
              <button class="btn btn-download d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#selectEditor" style="background-color: var(--yellow); color: var(--white)">
                <img src="/assets/assign-list.png" alt="">
                <h6>Select Editor</h6>
              </button>
            </div> --}}
          </div>
          
          <div class="col-md-8 col-12 p-0 userCard">
            <div class="headline d-flex justify-content-between">
              <div class="col-md-6 col-8 d-flex align-items-center gap-3">
                <img src="/assets/student.png" alt="">
                <h6>Student Detail</h6>
              </div>
              <div class="col-md-4 col-4 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                <a href="/admin/essay-list/ongoing"><img src="/assets/back.png" alt=""></a>
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
                    <p>{{ $ongoing->client_by_id->first_name.' '.$ongoing->client_by_id->last_name }}</p>
                  </div>
                </div>
                <div class="row d-flex align-items-center">
                  <div class="col-md-3 col-4">
                    <h6>Email</h6>
                  </div>
                  <div class="col-1 titik2"><p>:</p></div>
                  <div class="col-7">
                    <p>{{ $ongoing->client_by_id->email ? $ongoing->client_by_id->email : '-' }}</p>
                  </div>
                </div>
                <div class="row d-flex align-items-center">
                  <div class="col-md-3 col-4">
                    <h6>Address</h6>
                  </div>
                  <div class="col-1 titik2"><p>:</p></div>
                  <div class="col-7">
                    <p>{!! $ongoing->client_by_id->address ? $ongoing->client_by_id->address : '-' !!}</p>
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
                <div class="col-12 d-flex mb-3">
                  <div class="col-6">
                    <h6 class="pb-2">University Name :</h6>
                    <input type="text" class="form-control inputField py-2 px-3" disabled value="{{ $ongoing->university->university_name }}">
                  </div>
                  <div class="col-6">
                    <h6 class="pb-2">Essay Title :</h6>
                    <input type="text" class="form-control inputField py-2 px-3" disabled value="{{ $ongoing->essay_title }}">
                  </div>
                </div>
                <div class="col-12 d-flex mb-4" style="overflow: auto !important">
                  <div class="col">
                    <h6 class="pb-2">Essay Prompt :</h6>
                    <textarea name="" class="textarea" style="overflow: auto !important">{{ $ongoing->essay_prompt }}</textarea>
                  </div>
                </div>
                <div class="col-12 d-flex mb-3">
                  <div class="col-6">
                    <h6 class="pb-2">Essay Deadline :</h6>
                    <input type="text" class="form-control inputField py-2 px-3" disabled value="{{ date('D, d M Y', strtotime($ongoing->essay_deadline)) }}">
                  </div>
                  <div class="col-6">
                    <h6 class="pb-2">Application Deadline :</h6>
                    <input type="text" class="form-control inputField py-2 px-3" disabled value="{{ date('D, d M Y', strtotime($ongoing->application_deadline)) }}">
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
        <p>Assign this essay to editor <span style="color: var(--red)">*</span></p>
      </div>
    </div>
  </div>
</div>
{{-- Modal Select Editor --}}
<div class="modal fade" id="selectEditor" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" style="max-width: 80% !important">
    <div class="modal-content border-0">
      <div class="modal-header" style="border-bottom: 0px">
        <div class="col d-flex gap-1 align-items-center">
          <img src="/assets/assign-list.png" alt="">
          <h6 class="modal-title ms-3">Select Editor</h6>
        </div>
        <div type="button" data-bs-dismiss="modal" aria-label="Close">
          <img src="/assets/close.png" alt="" style="height: 26px">
        </div>
      </div>
      <div class="modal-body p-0">
        <form action="{{ route('assign-editor', $ongoing->id_essay_clients) }}" method="POST">
          @csrf
          <div class="container text-center p-0" style="overflow-x: auto !important">
            <table class="table table-bordered m-0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Editor Name</th>
                  <th>Graduated From</th>
                  <th>Due Tomorrow</th>
                  <th>Due Within 3 Days</th>
                  <th>Due Within 5 Days</th>
                  <th>Completed Essay</th>
                  <th>Assign</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = ($editors->currentpage()-1)* $editors->perpage() + 1;?>
                @foreach ($editors as $editor)
                <tr style="cursor: default">
                  <th scope="row">{{ $i++ }}</th>
                  <td>{{ $editor->first_name.' '.$editor->last_name }}</td>
                  <td>{{ $editor->graduated_from }}</td>
                  <td>{{ $editor->graduated_from }}</td>
                  <td>{{ $editor->graduated_from }}</td>
                  <td>{{ $editor->graduated_from }}</td>
                  <td>{{ $editor->graduated_from }}</td>
                  <td class="d-flex align-items-center justify-content-center">
                    <div class="form-check d-flex align-items-center justify-content-center">
                      <input class="form-check-input" type="radio" name="id_editors" id="flexRadioDefault1" value="{{ $editor->id_editors }}">
                    </div>
                  </td>
                </tr>
                @endforeach
                
                @unless (count($editors)) 
                <tr>
                  <td colspan="8">No data</td>
                </tr>
                @endunless
              </tbody>
            </table>
          </div>
          <div class="col d-flex align-items-center justify-content-between py-md-3 px-md-3 px-3 py-3 gap-2">
            {{ $editors->links() }}
            <button class="btn btn-download d-flex align-items-center justify-content-center gap-2" data-bs-toggle="modal" data-bs-target="#selectEditor" style="background-color: var(--yellow); color: var(--white)">
              <img src="/assets/assign-list.png" alt="">
              <h6 class="my-auto">Select Editor</h6>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

{{-- @section('js')
<script>
  $(document).ready(function(){
      $("#info").modal('show');
  });
</script>
@endsection --}}