@extends('user.admin.utama.utama')
@section('css')
  <link rel="stylesheet" href="/css/admin/user-editor.css">
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
              <div class="col-md-5 col-4 d-flex align-items-center gap-md-3 gap-2">
                <img src="/assets/editor.png" alt="">
                <h6>Editors</h6>
              </div>
              <div class="col-md-5 col-7 d-flex align-items-center justify-content-end gap-md-2 gap-2">
                <a class="btn-add-editor" href="/admin/user/editor/add">
                  <img src="/assets/add-people.png" alt="">
                </a>
                <a class="btn-invite" href="/admin/user/editor/invite">
                  <img src="/assets/letter.png" alt="">
                </a>
                <div class="input-group">
                  <form id="form-editor-searching" action="{{ route('list-editor') }}" method="GET" role="search" class="w-100">
                    <input type="text" class="form-control inputField py-2 px-3" name="keyword" id="search-editor" placeholder="Search" required>
                  </form>
                </div>
              </div>
            </div>
            <div class="container text-center" style="overflow-x: auto !important">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Editor Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>City</th>
                    <th>Position</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = ($editors->currentpage()-1)* $editors->perpage() + 1;?>
                  @foreach ($editors as $editor)
                  <tr onclick="window.location='/admin/user/editor/detail/{{ $editor->id_editors }}'">
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $editor->first_name.' '.$editor->last_name }}</td>
                    <td>{{ $editor->email }}</td>
                    <td>{{ $editor->phone }}</td>
                    <td>{{ strip_tags($editor->address) }}</td>
                    @if ($editor->position == 1)
                      <td>Associate</td>
                    @elseif ($editor->position == 2)
                      <td>Senior</td>
                    @elseif ($editor->position == 3)
                      <td>Managing</td>
                    @endif
                    @if ($editor->status == 1)
                      <td>
                        <div class="status-editor">
                          Active
                        </div>
                      </td>
                    @else
                      <td>
                        <div class="status-editor">
                          Deleted
                        </div>
                      </td>
                    @endif
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {{-- Pagination --}}
              <div class="d-flex justify-content-center">
                {{ $editors->links() }}
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
@endsection

@section('js')
  <script type="text/javascript">  
    $("#search-editor").keypress(function(e) {
      if (e.keyCode === 13) {
        swal.showLoading();
        e.preventDefault();
        $("#form-editor-searching").submit();
      }
    });
  </script>
@stop