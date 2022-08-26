@extends('user.admin.utama.utama')
@section('css')
  <link rel="stylesheet" href="/css/admin/setting-universities.css">
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
                <img src="/assets/university.png" alt="">
                <h6>Universities</h6>
              </div>
              <div class="col-md-4 col-6 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                <a href="/admin/setting/universities/add"><img src="/assets/add.png" alt=""></a>
              </div>
            </div>
            <div class="container text-center" style="overflow-x: auto !important">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>University Name</th>
                    <th>Website</th>
                    <th>Country</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Image</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = ($universities->currentpage()-1)* $universities->perpage() + 1;?>
                  @foreach ($universities as $university)
                  <tr onclick="window.location='/admin/setting/universities/detail/{{ $university->id_univ }}'">
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $university->university_name}}</td>
                    <td>{{ $university->website }}</td>
                    <td>{{ $university->country }}</td>
                    <td>{{ $university->phone }}</td>
                    <td>{{ strip_tags($university->address) }}</td>
                    <td>{{ $university->photo }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {{-- Pagination --}}
              <div class="d-flex justify-content-center">
                {{ $universities->links() }}
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