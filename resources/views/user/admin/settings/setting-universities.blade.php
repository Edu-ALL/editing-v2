@extends('user.admin.utama.utama')
@section('content')
<div class="container-fluid" style="padding: 0">
  <div class="row flex-nowrap main">

    {{-- Sidenav --}}
    @include('user.admin.utama.menu')

    {{-- Content --}}
    <div class="col" style="overflow: auto !important">
      <div class="row head py-4 align-items-center">
        <div class="col-md-6 col-10 ps-md-5 ps-3">
          <h4 class="">Admin Dashboard</h4>
        </div>
        <div class="col-md-6 col-2 pe-md-5 pe-3">
          <div class="head-content d-flex flex-row align-items-center justify-content-end gap-md-4 gap-2">
            <a class="help d-flex flex-row align-items-center gap-md-2 gap-1" href="">
              <img class="img-fluid" src="/assets/help-grey.png" alt="">
              <h6 class="d-none d-md-inline">Help</h6>
            </a>
            <a href="">
              <h6 class="pt-1 d-none d-md-inline">Admin Name</h6>
            </a>
          </div>
        </div>
      </div>
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
                  <tr onclick="window.location='/admin/setting/universities/detail'">
                    <th scope="row">1</th>
                    <td>Adelphi University</td>
                    <td>-</td>
                    <td>US</td>
                    <td>-</td>
                    <td>Nashville, TN</td>
                    <td>image.png</td>
                  </tr>
                  <tr onclick="window.location='/admin/setting/universities/detail'">
                    <th scope="row">2</th>
                    <td>Adelphi University</td>
                    <td>-</td>
                    <td>US</td>
                    <td>-</td>
                    <td>Nashville, TN</td>
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