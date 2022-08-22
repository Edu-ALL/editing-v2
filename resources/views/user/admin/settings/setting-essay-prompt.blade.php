@extends('user.admin.utama.utama')
@section('css')
  <link rel="stylesheet" href="/css/admin/setting-essay-prompt.css">
@endsection

@section('content')
<div class="container-fluid" style="padding: 0">
  <div class="row flex-nowrap main">

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
              <div class="col-md-6 col d-flex align-items-center gap-md-3 gap-2">
                <img src="/assets/essay-prompt.png" alt="">
                <h6>Essay Prompt</h6>
              </div>
              <div class="col-md-4 col-auto d-flex align-items-center justify-content-end gap-md-3 gap-2">
                <a href="/admin/setting/essay-prompt/add"><img src="/assets/add.png" alt=""></a>
              </div>
            </div>
            <div class="container text-center" style="overflow-x: auto !important">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>University Name</th>
                    <th>Title</th>
                    <th>Description</th>
                  </tr>
                </thead>
                <tbody>
                  <tr onclick="window.location='/admin/setting/essay-prompt/detail'">
                    <th scope="row">1</th>
                    <td>American University</td>
                    <td>Personal Statement</td>
                    <td>Essay</td>
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