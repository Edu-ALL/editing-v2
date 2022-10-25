@extends('user.admin.utama.utama')
@section('css')
  <link rel="stylesheet" href="/css/admin/user-student-detail.css">
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
        {{-- Detail Student --}}
        <div class="row">
          <div class="col-md col-12 p-0 studentList">
            <div class="headline d-flex justify-content-between">
              <div class="col-md-6 col-5 d-flex align-items-center gap-md-3 gap-2">
                <img src="/assets/student.png" alt="">
                <h6>Students</h6>
              </div>
              <div class="col-md-4 col-6 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                <a href="/admin/user/student"><img src="/assets/back.png" alt=""></a>
              </div>
            </div>
            <div class="row student-info pb-md-0 pb-4">
              <div class="col-md-4 d-flex align-items-center justify-content-center py-md-0 py-4">
                <div class="pic-profile">
                  <img class="img-fluid" src="/assets/student-bg.png" alt="">
                </div>
              </div>
              <div class="col-md-8 student-desc d-flex flex-column justify-content-center gap-lg-3 gap-2 ps-md-5 px-4">
                <div class="row d-flex align-items-center">
                  <div class="col-md-3 col-4">
                    <h6>Full Name</h6>
                  </div>
                  <div class="col-1 titik2 p-0"><p>:</p></div>
                  <div class="col ps-1">
                    <p>{{ $client->first_name.' '.$client->last_name }}</p>
                  </div>
                </div>
                <div class="row d-flex align-items-center">
                  <div class="col-md-3 col-4">
                    <h6>Phone Number</h6>
                  </div>
                  <div class="col-1 titik2 p-0"><p>:</p></div>
                  <div class="col ps-1">
                    <p>{{ $client->phone ? $client->phone : '-' }}</p>
                  </div>
                </div>
                <div class="row d-flex align-items-center">
                  <div class="col-md-3 col-4">
                    <h6>Email</h6>
                  </div>
                  <div class="col-1 titik2 p-0"><p>:</p></div>
                  <div class="col ps-1">
                    <p>{{ $client->email ? $client->email : '-' }}</p>
                  </div>
                </div>
                <div class="row d-flex align-items-center">
                  <div class="col-md-3 col-4">
                    <h6>Address</h6>
                  </div>
                  <div class="col-1 titik2 p-0"><p>:</p></div>
                  <div class="col ps-1">
                    <p>{!! $client->address ? $client->address : '-' !!}</p>
                  </div>
                </div>
                <div class="row d-flex align-items-center">
                  <div class="col-md-3 col-4">
                    <h6>Mentor</h6>
                  </div>
                  <div class="col-1 titik2 p-0"><p>:</p></div>
                  <div class="col ps-1">
                    <form action="{{ route('update-mentor', ['id_clients' => $client->id_clients]) }}" method="POST" class="p-0" onsubmit="swal.showLoading()">
                      @csrf
                      <select class="select-beast inputField" name="id_mentor" id="mentor" onchange="this.form.submit()">
                        @foreach ($mentors as $mentor)
                          @if ($client->id_mentor_2 != $mentor->id_mentors)
                            @if ($client->id_mentor == $mentor->id_mentors)
                              <option value="{{ $mentor->id_mentors }}" selected>{{ $mentor->first_name.' '.$mentor->last_name }}</option>
                            @endif
                            <option value="{{ $mentor->id_mentors }}">{{ $mentor->first_name.' '.$mentor->last_name }}</option>
                          @endif
                        @endforeach
                      </select>
                    </form>
                  </div>
                </div>
                <div class="row d-flex align-items-center">
                  <div class="col-md-3 col-4">
                    <h6>Backup Mentor</h6>
                  </div>
                  <div class="col-1 titik2 p-0"><p>:</p></div>
                  <div class="col ps-1">
                    <form action="{{ route('update-backup-mentor', ['id_clients' => $client->id_clients]) }}" method="POST" class="p-0" onsubmit="swal.showLoading()">
                      @csrf
                      <select class="select-beast inputField" name="id_mentor_2" id="mentor_2" onchange="this.form.submit()">
                        @if ($client->id_mentor_2 == null)
                          <option value="" selected>-</option>
                        @endif
                        @foreach ($mentors as $mentor)
                          @if ($client->id_mentor != $mentor->id_mentors)
                            @if ($client->id_mentor_2 == $mentor->id_mentors)
                              <option value="{{ $mentor->id_mentors }}" selected>{{ $mentor->first_name.' '.$mentor->last_name }}</option>
                            @endif
                            <option value="{{ $mentor->id_mentors }}">{{ $mentor->first_name.' '.$mentor->last_name }}</option>
                          @endif
                        @endforeach
                      </select>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <div class="row student-addition p-md-5 p-3">
              {{-- Text Area --}}
              <div class="text-area p-md-1 mb-3">
                <h6 class="pb-3">Personal Brand Statement :</h6>
                <textarea name="" class="textarea">{{ $client->personal_brand }}</textarea>
              </div>
              <div class="text-area p-md-1 mb-3">
                <h6 class="pb-3">Academic Goals & Interest :</h6>
                <textarea name="" class="textarea">{{ $client->interests }}</textarea>
              </div>
              <div class="text-area p-md-1 mb-3">
                <h6 class="pb-3">Life Philosophy (Values) & Personalities :</h6>
                <textarea name="" class="textarea">{{ $client->personalities }}</textarea>
              </div>
              {{-- End Text Area --}}
              {{-- Attachment --}}
              <div class="col-lg-2 col-3 mb-lg-4 mb-3 ms-lg-0 ms-2 attachment d-flex align-items-center justify-content-center">
                <h6 class="text-center">Attachment</h6>
              </div>
              <div class="row d-flex flex-column attachment-status gap-lg-3 gap-2 ps-lg-0 ps-1 mb-3">
                {{-- flex-lg-row  --}}
                <div class="col-lg">
                  <h6>Activities Resume<span class="ps-2 pe-1">:</span>
                    @if ($client->resume != null)
                      <a href="{{ asset('uploaded_files/user/students/'.$client->first_name.'/resume'.'/'. $client->resume) }}" style="color: var(--blue)">{{ $client->resume }}</a>
                    @else
                      <span style="color: var(--red)">Not Available</span>
                    @endif
                  </h6>
                </div>
                <div class="col-lg">
                  <h6>Questionnaire<span class="ps-2 pe-1">:</span>
                    @if ($client->questionnaire != null)
                      <a href="{{ asset('uploaded_files/user/students/'.$client->first_name.'/questionnaire'.'/'.$client->questionnaire) }}" style="color: var(--blue)">{{ $client->questionnaire }}</a>
                    @else
                      <span style="color: var(--red)">Not Available</span>
                    @endif
                  </h6>
                </div>
                <div class="col-lg">
                  <h6>Others<span class="ps-2 pe-1">:</span>
                    @if ($client->others != null)
                      <a href="{{ asset('uploaded_files/user/students/'.$client->first_name.'/others'.'/'.$client->others) }}" style="color: var(--blue)">{{ $client->others }}</a>
                    @else
                      <span style="color: var(--red)">Not Available</span>
                    @endif
                  </h6>
                </div>
              </div>
              {{-- End Attachment --}}
            </div>
          </a>
        </div>
        {{-- End Detail Student --}}
      </div>
    </div>
    {{-- End Content --}}
  </div>
</div>
@endsection