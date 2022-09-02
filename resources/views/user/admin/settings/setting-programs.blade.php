@extends('user.admin.utama.utama')
@section('css')
  <link rel="stylesheet" href="/css/admin/setting-programs.css">
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
        {{-- Detail Student --}}
        <div class="row">
          <div class="col-md col-12 p-0 studentList">
            <div class="headline d-flex justify-content-between">
              <div class="col-md-6 col-5 d-flex align-items-center gap-md-3 gap-2">
                <img src="/assets/program.png" alt="">
                <h6>Programs</h6>
              </div>
              <div class="col-md-4 col-6 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                <a href="/admin/setting/programs/add"><img src="/assets/add.png" alt=""></a>
                <div class="input-group">
                  <form id="form-programs-searching" action="{{ route('list-program') }}" method="GET" role="search" class="w-100">
                    <input type="text" class="form-control inputField py-2 px-3" name="keyword" id="search-programs" placeholder="Search" required>
                  </form>
                </div>
              </div>
            </div>
            <div class="container text-center" style="overflow-x: auto !important">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Program Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Max Word</th>
                    <th>Completed Within</th>
                    <th>Image</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = ($programs->currentpage()-1)* $programs->perpage() + 1;?>
                  @foreach ($programs as $program)
                  <tr onclick="window.location='/admin/setting/programs/detail/{{ $program->id_program }}'">
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $program->program_name }}</td>
                    <td style="text-align: start">{{ $program->description }}</td>
                    <td>{{ $program->price }}</td>
                    <td>{{ $program->maximum_word }}</td>
                    <td>{{ $program->completed_within }}</td>
                    <td><img src="
                      @if ($program->images)
                      {{ asset('uploaded_files/programs/'.$program->images) }}
                      @else
                      {{ asset('uploaded_files/programs/default.png') }}
                      @endif
                      " alt="{{ $program->images }}" style="max-width:50px;" /></td>
                  </tr>
                  @endforeach
                  
                  @unless (count($programs)) 
                  <tr>
                    <td colspan="7">No data</td>
                  </tr>
                  @endunless
                </tbody>
              </table>
              {{-- Pagination --}}
              <div class="d-flex justify-content-center">
                {{ $programs->links() }}
              </div>
            </div>
          </div>
        </div>
        {{-- End Detail Student --}}
      </div>
    </div>
    {{-- End Content --}}
  </div>
</div>
@endsection

@section('js')
<script>
  $("#search-programs").keypress(function(e) {
    if (e.keyCode === 13) {
      swal.showLoading();
      e.preventDefault();
      $("#form-programs-searching").submit();
    }
  });
</script>
@stop