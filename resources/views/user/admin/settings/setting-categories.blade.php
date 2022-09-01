@extends('user.admin.utama.utama')
@section('css')
  <link rel="stylesheet" href="/css/admin/setting-categories.css">
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
        <div class="row gap-2">

          @if($errors->any())
            {!! implode('', $errors->all('<div class="alert alert-danger" role="alert">:message</div>')) !!}
          @endif

          @if(session()->has('add-tag-successful'))
            <div class="alert alert-success fade show" role="alert">
              {{ session()->get('add-tag-successful') }}
            </div>
          @elseif (session()->has('update-tag-successful'))
            <div class="alert alert-success fade show" role="alert">
              {{ session()->get('update-tag-successful') }}
            </div>
          @elseif (session()->has('delete-tag-successful'))
            <div class="alert alert-success fade show" role="alert">
              {{ session()->get('delete-tag-successful') }}
            </div>
          @endif

          <div class="col-md col-12 p-0 userCard profile">
            <div class="headline d-flex align-items-center gap-3">
              <img src="/assets/add.png" alt="">
              <h6>Add Categories / Tags</h6>
            </div>
            <form action="{{ route('add-tag') }}" method="POST">
              @csrf
              <div class="col d-flex profile-editor align-items-center justify-content-center py-md-4 py-4">
                <div class="col-10">
                  <h6 class="pb-2">Title :</h6>
                  <input type="text" name="title" class="form-control w-100 inputField py-2 px-3">
                </div>
              </div>
              <div class="col d-flex align-items-center justify-content-center pb-md-3 pb-3">
                <button type="submit" class="btn btn-create d-flex align-items-center gap-2">
                  <img src="/assets/add.png" alt="">
                  <h6>Add New</h6>
                </button>
              </div>
            </form>
          </div>
          
          <div class="col-md-8 col-12 p-0 userCard">
            <div class="headline d-flex justify-content-between">
              <div class="col d-flex align-items-center gap-md-3 gap-2">
                <img src="/assets/tags.png" alt="">
                <h6>Categories / Tags</h6>
              </div>
              <div class="col-md-4 col-6 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                <div class="input-group">
                  <form id="form-tag-searching" action="{{ route('list-tag') }}" method="GET" role="search" class="w-100">
                    <input type="text" class="form-control inputField py-2 px-3" name="keyword" id="search-tag" placeholder="Search" required>
                  </form>
                </div>
              </div>
            </div>
            <div class="container text-center p-0" style="overflow-x: auto !important">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10%">No</th>
                    <th>Category Name</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = ($tags->currentpage()-1)* $tags->perpage() + 1;?>
                  @foreach ($tags as $tag)
                  <tr onclick="window.location='/admin/setting/categories-tags/detail/{{ $tag->id_topic }}'">
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $tag->topic_name }}</td>
                  </tr>
                  @endforeach

                  @unless (count($tags)) 
                  <tr>
                    <td class="text-center" colspan="2">No data</td>
                  </tr>
                  @endunless
                </tbody>
              </table>
              {{-- Pagination --}}
              <div class="d-flex justify-content-center">
                {{ $tags->links() }}
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

@section('js')
<script>
  $("#search-tag").keypress(function(e) {
    if (e.keyCode === 13) {
      swal.showLoading();
      e.preventDefault();
      $("#form-tag-searching").submit();
    }
  });
</script>
@stop