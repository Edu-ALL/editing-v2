@extends('user.admin.utama.utama')
@section('css')
  <link rel="stylesheet" href="/css/admin/export-student-essay.css">
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
              <div class="col d-flex align-items-center gap-md-3 gap-2">
                <img src="/assets/completed-essay.png" alt="">
                <h6>Export - Student Essay</h6>
              </div>
            </div>
            <div class="col-12 search-essay">
              <form action="" class="col d-flex flex-column align-items-center justify-content-center p-0 my-2">
                <div class="col-md-8 col-10 d-flex py-md-3 py-2">
                  <div class="col-6">
                    <h6 class="pb-2">Month</h6>
                    <select class="select-beast inputField">
                      <option value="value 1">Value 1</option>
                      <option value="value 2">Value 2</option>
                      <option value="value 3">Value 3</option>
                    </select>
                  </div>
                  <div class="col-6">
                    <h6 class="pb-2">Year</h6>
                    <select class="select-beast inputField">
                      <option value="value 1">Value 1</option>
                      <option value="value 2">Value 2</option>
                      <option value="value 3">Value 3</option>
                    </select>
                  </div>
                </div>
                <div class="col-12 d-flex justify-content-center py-md-3 py-2">
                  <button class="btn btn-search d-flex align-items-center gap-2">
                    <img src="/assets/search.png" alt="">
                    <h6>Search</h6>
                  </button>
                </div>
              </form>
            </div>
            <div class="headline d-flex justify-content-end">
              <div class="col-md-5 col-12 d-flex align-items-center justify-content-end gap-md-2 gap-2">
                <a class="btn-export col-auto d-flex gap-2 align-items-center justify-content-center" href="">
                  <img src="/assets/excel.png" alt="">
                  <h6>Export to Excel</h6>
                </a>
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
                    <th>Email</th>
                    <th>Phone</th>
                    <th>City</th>
                  </tr>
                </thead>
                <tbody>
                  <tr onclick="window.location='/admin/user/student/detail'">
                    <th scope="row">1</th>
                    <td>Student Dummy</td>
                    <td>Mentor Dummy</td>
                    <td>studentdummy@example.com</td>
                    <td>12345678</td>
                    <td>Jl Jeruk kembar blok Q9 no. 15</td>
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