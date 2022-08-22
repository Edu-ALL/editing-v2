@extends('user.admin.utama.utama')
@section('css')
  <link rel="stylesheet" href="/css/admin/setting-detail-categories.css">
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
        <div class="row gap-2">
          <div class="col-lg col-12 p-0 userCard profile">
            <div class="headline d-flex align-items-center gap-3">
              <img src="/assets/add.png" alt="">
              <h6>Add Categories / Tags</h6>
            </div>
            <div class="col d-flex profile-editor align-items-center justify-content-center py-md-4 py-4">
              <div class="col-10">
                <h6 class="pb-2">Title :</h6>
                <input type="text" class="form-control w-100 inputField py-2 px-3" value="Why x School">
              </div>
            </div>
            <div class="col d-flex flex-row align-items-center justify-content-center pb-md-3 pb-3 gap-2">
              <form action="">
                <button class="btn btn-create d-flex align-items-center gap-2" style="background-color: var(--yellow)">
                  <img src="/assets/update.png" alt="">
                  <h6>Update</h6>
                </button>
              </form>
              <form action="">
                <button class="btn btn-create d-flex align-items-center gap-2" style="background-color: var(--red)">
                  <img src="/assets/delete.png" alt="">
                  <h6>Delete</h6>
                </button>
              </form>
            </div>
          </div>
          
          <div class="col-lg-8 col-12 p-0 userCard">
            <div class="headline d-flex justify-content-between">
              <div class="col-md-6 col-10 d-flex align-items-center gap-md-3 gap-2">
                <img src="/assets/tags.png" alt="">
                <h6>Categories / Tags</h6>
              </div>
              <div class="col-md-4 col-auto d-flex align-items-center justify-content-end gap-md-3 gap-2">
                <a href="/admin/setting/categories-tags"><img src="/assets/back.png" alt=""></a>
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
                  <tr onclick="window.location='/admin/setting/categories-tags/detail'">
                    <th scope="row">1</th>
                    <td>Why x School</td>
                  </tr>
                  <tr onclick="window.location='/admin/setting/categories-tags/detail'">
                    <th scope="row">2</th>
                    <td>Contributions</td>
                  </tr>
                  <tr onclick="window.location='/admin/setting/categories-tags/detail'">
                    <th scope="row">3</th>
                    <td>Diversity</td>
                  </tr>
                  <tr onclick="window.location='/admin/setting/categories-tags/detail'">
                    <th scope="row">4</th>
                    <td>Inclusivity</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- End Content --}}
  </div>
</div>
@endsection