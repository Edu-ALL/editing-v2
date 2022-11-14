@extends('user.admin.utama.utama')
@section('css')
  <link rel="stylesheet" href="/css/admin/essay-ongoing.css">
  <style>
    .pagination { margin: 15px 0}
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
        {{-- Table Student --}}
        <div class="row">
          <div class="col-md col-12 p-0 studentList">
            <div class="headline d-flex justify-content-between">
              <div class="col-md-6 col-7 d-flex align-items-center gap-md-3 gap-2">
                <img src="/assets/ongoing-essay.png" alt="">
                <h6>List of Ongoing Essay</h6>
              </div>
              <div class="col-md-4 col-4 d-flex align-items-center justify-content-end">
                <div class="input-group">
                  <form id="form-ongoing-essay-searching" action="{{ route('list-ongoing-essay') }}" method="GET" role="search" class="w-100">
                    <input type="search" class="form-control inputField py-2 px-3" name="keyword" placeholder="Search">
                  </form>
                </div>
              </div>
            </div>
            <div class="container text-center" style="overflow-x: auto !important">
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
                  <?php $i = ($essays->currentpage()-1)* $essays->perpage() + 1;?>
                  @foreach ($essays as $essay)
                  <tr onclick="window.location='/admin/essay-list/ongoing/detail/{{ $essay->id_essay_clients }}'">
                    <th scope="row">{{ $i++ }}</th>

                    <td>{{ isset($essay->client_by_id) ? $essay->client_by_id->first_name.' '.$essay->client_by_id->last_name : $essay->client_by_email->first_name.' '.$essay->client_by_email->last_name }}</td>
                    <td>{{ isset($essay->client_by_id) ? $essay->client_by_id->mentors->first_name.' '.$essay->client_by_id->mentors->last_name : $essay->client_by_email->mentors->first_name.' '.$essay->client_by_email->mentors->last_name }}</td>
                    
                    {{-- <td>{{ $essay->status_essay_clients == 0 ? '-' : $essay->editor->first_name.' '.$essay->editor->last_name }}</td> --}}
                    <td>
                      @if ($essay->status_essay_clients == 0 || $essay->status_essay_clients == 4 || $essay->status_essay_clients == 5)
                          -
                      @else
                        {{-- {{ isset ($essay->editor) ? $essay->editor->first_name.' '.$essay->editor->last_name : "-"}} --}}
                        {{ $essay->essay_editors->editor->first_name.' '.$essay->essay_editors->editor->last_name }}
                      @endif
                    </td>
                    <td>{{ $essay->essay_title }}</td>
                    <td>{{ date('D, d M Y', strtotime($essay->essay_deadline)) }}</td>
                    <td style="color: var(--red)">{{ isset($essay->status) ? $essay->status->status_title : null }}</td>
                  </tr>
                  @endforeach
                  
                  @unless (count($essays)) 
                  <tr>
                    <td colspan="7">No data</td>
                  </tr>
                  @endunless
                </tbody>
              </table>
              {{-- Pagination --}}
              <div class="d-flex justify-content-center">
              {{ $essays->links() }}
              </div>
            </div>
          </div>
        </div>
        {{-- End Table Student --}}
      </div>
    </div>
    {{-- End Content --}}
  </div>
</div>

{{-- Modal Info --}}
@if (session()->has('isEssay'))
<div class="modal fade" id="info-essay" tabindex="-1" show>
    <div class="modal-dialog d-flex align-items-center justify-content-center">
    <div class="modal-content border-0 w-75">
        <div class="modal-header" style="background-color: var(--red)">
            <div class="col d-flex gap-1 align-items-center">
                <img src="/assets/info.png" alt="">
                <h6 class="modal-title ms-3">Alert</h6>
            </div>
            <div type="button" data-bs-dismiss="modal" aria-label="Close">
                <img src="/assets/close.png" alt="" style="height: 26px">
            </div>
        </div>
        <div class="modal-body text-center px-4 py-4 my-md-3">
            <p>{{ session()->get('isEssay') }}  <span style="color: var(--red)">*</span></p>
        </div>
    </div>
    </div>
</div>
@endif
@endsection

@section('js')
  <script type="text/javascript">
    $("#form-ongoing-essay-searching").keypress(function(e) {
      if (e.keyCode === 13) {
        swal.showLoading();
        e.preventDefault();
        $("#form-ongoing-essay-searching").submit();
      }
    });
    
    $(document).ready(function(){
        $("#info-essay").modal('show');
    });
  </script>
@stop