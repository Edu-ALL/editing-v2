@extends('user.admin.utama.utama')
@section('css')
  <link rel="stylesheet" href="/css/admin/setting-programs.css">
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
                  <tr onclick="window.location='/admin/setting/programs/detail'">
                    <th scope="row">1</th>
                    <td>Cover Letter Editing</td>
                    <td class="desc">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nobis sed cumque quos quia, molestias voluptatum</td>
                    <td>Rp. 0</td>
                    <td>100</td>
                    <td>82</td>
                    <td>image.png</td>
                  </tr>
                </tbody>
              </table>
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