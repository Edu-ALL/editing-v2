@extends('user.per-editor.utama.utama')
@section('css')
  <style>
    .pagination { margin: 15px 0}
    .pagination .page-item .page-link { padding: 10px 15px; font-size: 12px; }
  </style>
@endsection

@section('content')
<div class="container-fluid">
  <div class="row flex-nowrap main" id="main">

    {{-- Sidenav --}}
    @include('user.per-editor.utama.menu')

    {{-- Content --}}
    <div class="col" style="overflow-x: auto !important">
      @include('user.per-editor.utama.head')
      <div class="container main-content m-0">
        <div class="row flex-column gap-4">
          <div class="col p-0">
            <div class="col-md col-12 p-0 userCard">
              <div class="headline d-flex align-items-center gap-3" style="padding: 18px 24px !important;">
                <div class="col-md col-7 d-flex align-items-center gap-md-3 gap-2">
                  <img src="/assets/ongoing-essay.png" alt="">
                  <h6>List of Ongoing Essay</h6>
                </div>
                <div class="col-md-4 col-4 d-flex align-items-center justify-content-end">
                  <div class="input-group">
                    <input type="email" class="form-control inputField py-2 px-3" placeholder="Search">
                  </div>
                </div>
              </div>
              <div class="container text-center p-0" style="overflow-x: auto !important">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Student Name</th>
                      <th>Mentor Name</th>
                      <th>Editor Name</th>
                      <th>Essay Title</th>
                      <th>Essay Deadline</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = ($ongoing_essay->currentpage()-1)* $ongoing_essay->perpage() + 1;?>
                    @foreach ($ongoing_essay as $essay)
                    <tr onclick="window.location='/editors/essay-list/ongoing/detail/{{ $essay->id_essay_clients }}'">
                      <th scope="row">{{ $i++ }}</th>

                      @if ($essay->client_by_id)
                        <td>{{ $essay->client_by_id->first_name.' '.$essay->client_by_id->last_name }}</td>
                        <td>{{ $essay->client_by_id->mentors->first_name.' '.$essay->client_by_id->mentors->last_name  }}</td>
                      @elseif ($essay->client_by_email)
                        <td>{{ $essay->client_by_email->first_name.' '.$essay->client_by_email->last_name }}</td>
                        <td>{{ $essay->client_by_email->mentors->first_name.' '.$essay->client_by_email->mentors->last_name }}</td>
                      @endif

                      <td>{{ $essay->editor ? $essay->editor->first_name.' '.$essay->editor->last_name : '-' }}</td>
                      <td>{{ $essay->essay_title }}</td>
                      <td>{{ date('D, d M Y', strtotime($essay->essay_deadline)) }}</td>
                      <td style="color: var(--red)">{{ $essay->status->status_title }}</td>
                    </tr>
                    @endforeach
                    
                    @unless (count($ongoing_essay)) 
                    <tr>
                      <td colspan="7">No data</td>
                    </tr>
                    @endunless
                  </tbody>
                </table>
                {{-- Pagination --}}
                <div class="d-flex justify-content-center">
                  {{ $ongoing_essay->links() }}
                </div>
              </div>
            </div>
          </div>
          <div class="col p-0">
            <div class="col-md col-12 p-0 userCard">
              <div class="headline d-flex align-items-center gap-3" style="background-color: var(--green); padding: 18px 24px !important">
                <div class="col-md col-7 d-flex align-items-center gap-md-3 gap-2">
                  <img src="/assets/completed-essay.png" alt="">
                  <h6>List of Completed Essay</h6>
                </div>
                <div class="col-md-4 col-4 d-flex align-items-center justify-content-end">
                  <div class="input-group">
                    <input type="email" class="form-control inputField py-2 px-3" placeholder="Search">
                  </div>
                </div>
              </div>
              <div class="container text-center p-0" style="overflow-x: auto !important">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Student Name</th>
                      <th>Mentor Name</th>
                      <th>Editor Name</th>
                      <th>Essay Title</th>
                      <th>Essay Deadline</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = ($completed_essay->currentpage()-1)* $completed_essay->perpage() + 1;?>
                    @foreach ($completed_essay as $essay)
                    <tr onclick="window.location='/editors/essay-list/completed/detail/{{ $essay->id_essay_clients }}'">
                      <th scope="row">{{ $i++ }}</th>

                      @if ($essay->client_by_id)
                        <td>{{ $essay->client_by_id->first_name.' '.$essay->client_by_id->last_name }}</td>
                        <td>{{ $essay->client_by_id->mentors->first_name.' '.$essay->client_by_id->mentors->last_name  }}</td>
                      @elseif ($essay->client_by_email)
                        <td>{{ $essay->client_by_email->first_name.' '.$essay->client_by_email->last_name }}</td>
                        <td>{{ $essay->client_by_email->mentors->first_name.' '.$essay->client_by_email->mentors->last_name }}</td>
                      @endif

                      <td>{{ $essay->editor ? $essay->editor->first_name.' '.$essay->editor->last_name : '-' }}</td>
                      <td>{{ $essay->essay_title }}</td>
                      <td>{{ date('D, d M Y', strtotime($essay->essay_deadline)) }}</td>
                      <td style="color: var(--green)">{{ $essay->status->status_title }}</td>
                    </tr>
                    @endforeach
                    
                    @unless (count($completed_essay)) 
                    <tr>
                      <td colspan="7">No data</td>
                    </tr>
                    @endunless
                  </tbody>
                </table>
                {{-- Pagination --}}
                <div class="d-flex justify-content-center">
                  {{ $completed_essay->links() }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- End Content --}}
  </div>
</div>
@endsection