@extends('user.admin.utama.utama')
@section('css')
  <link rel="stylesheet" href="/css/admin/essay-ongoing.css">
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
                  <input type="email" class="form-control inputField py-2 px-3" placeholder="Search">
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
                  <tr onclick="window.location='/admin/essay-list/ongoing/detail'">
                    <th scope="row">1</th>
                    <td>Student Dummy</td>
                    <td>Mentor Dummy</td>
                    <td>Senior Editor Dummy</td>
                    <td>Supplemental Essay</td>
                    <td>Thu, 28 Jul 2022</td>
                    <td style="color: var(--red)">Ongoing</td>
                  </tr>
                </tbody>
              </table>
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