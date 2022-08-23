@extends('user.admin.utama.utama')
@section('css')
  <link rel="stylesheet" href="/css/admin/user-editor.css">
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
                  <input type="email" class="form-control inputField py-2 px-3" placeholder="Search">
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
                  <tr onclick="window.location='/admin/user/editor/detail'">
                    <th scope="row">1</th>
                    <td>Editor Dummy</td>
                    <td>editor.dummy@example.com</td>
                    <td>12345678</td>
                    <td>Jl Jeruk kembar blok Q9 no. 15</td>
                    <td>Mentor Dummy</td>
                    <td>
                      <div class="status-editor">
                        Activated
                      </div>
                    </td>
                  </tr>
                  <tr onclick="window.location='/admin/user/editor/detail'">
                    <th scope="row">2</th>
                    <td>Editor Associate Dummy</td>
                    <td>editorassociate.dummy@example.com</td>
                    <td>12345678</td>
                    <td>Jl Jeruk kembar blok Q9 no. 15</td>
                    <td>Mentor Dummy</td>
                    <td>
                      <div class="status-editor">
                        Activated
                      </div>
                    </td>
                  </tr>
                  <tr onclick="window.location='/admin/user/editor/detail'">
                    <th scope="row">3</th>
                    <td>Senior Editor Dummy</td>
                    <td>senioreditor.dummy@example.com</td>
                    <td>12345678</td>
                    <td>Jl Jeruk kembar blok Q9 no. 15</td>
                    <td>Mentor Dummy</td>
                    <td>
                      <div class="status-editor">
                        Activated
                      </div>
                    </td>
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