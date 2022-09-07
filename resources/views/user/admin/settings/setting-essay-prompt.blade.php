@extends('user.admin.utama.utama')
@section('css')
  <link rel="stylesheet" href="/css/admin/setting-essay-prompt.css">
  <style>
    .pagination { margin: 15px 0}
    .pagination .page-item .page-link { padding: 10px 15px; font-size: 12px; }
    .alert {font-size: 14px; margin: 0 -12px 16px -12px}
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

        @if (session()->has('add-prompt-successful'))
          <div class="alert alert-success fade show d-flex justify-content-between" role="alert">
            {{ session()->get('add-prompt-successful') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @elseif (session()->has('delete-prompt-successful'))
          <div class="alert alert-success fade show d-flex justify-content-between" role="alert">
            {{ session()->get('delete-prompt-successful') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        {{-- Detail Student --}}
        <div class="row">
          <div class="col-md col-12 p-0 studentList">
            <div class="headline d-flex justify-content-between">
              <div class="col-md-6 col d-flex align-items-center gap-md-3 gap-2">
                <img src="/assets/essay-prompt.png" alt="">
                <h6>Essay Prompt</h6>
              </div>
              <div class="col-md-4 col-auto d-flex align-items-center justify-content-end gap-md-3 gap-2">
                <a href="/admin/setting/essay-prompt/add"><img src="/assets/add.png" alt=""></a>
                <form id="form-prompt-searching" action="{{ route('list-essay-prompt') }}" method="GET" role="search" class="w-100">
                  <input type="search" class="form-control inputField py-2 px-3" name="keyword" id="search-prompt" placeholder="Search" required>
                </form>
              </div>
            </div>
            <div class="container text-center" style="overflow-x: auto !important">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>University Name</th>
                    <th>Description</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = ($essay_prompts->currentpage()-1)* $essay_prompts->perpage() + 1;?>
                  @foreach ($essay_prompts as $essay_prompt)
                  <tr onclick="window.location='/admin/setting/essay-prompt/detail/{{ $essay_prompt->id_essay_prompt }}'">
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $essay_prompt->title }}</td>
                    <td>{{ $essay_prompt->university->university_name }}</td>
                    <td>{!! $essay_prompt->description !!}</td>
                  </tr>
                  @endforeach
                  
                  @unless (count($essay_prompts)) 
                  <tr>
                    <td colspan="4">No data</td>
                  </tr>
                  @endunless
                </tbody>
              </table>
              {{-- Pagination --}}
              <div class="d-flex justify-content-center">
                {{ $essay_prompts->links() }}
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
  $("#search-prompt").keypress(function(e) {
    if (e.keyCode === 13) {
      swal.showLoading();
      e.preventDefault();
      $("#form-prompt-searching").submit();
    }
  });
</script>
@stop