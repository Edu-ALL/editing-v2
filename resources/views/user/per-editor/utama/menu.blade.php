{{-- Sidenav --}}
<div class="col-md-2 col-2 sidenav py-4 px-md-0 px-2 text-center">
  <a class="navbar-brand mb-3" href="/">
    <img class="img-logo img-fluid" src="/assets/admin-logo.png" alt="">
  </a>
  <hr class="smallLine mx-auto mt-4">
  {{-- Menu --}}
  <div class="container ps-lg-5 ps-md-4 menuList d-flex flex-column text-md-start align-items-md-start align-items-center mt-5 mb-5 gap-5">
    {{-- Dashboard --}}
    <a class="row w-100" href="/editors/dashboard" style="cursor: pointer">
      <div class="col-md-3">
        <img class="{{ request()->is('editors/dashboard') ? 'active' : 'non-active' }}" src="/assets/dashboard-blue.png" alt="">
      </div>
      <div class="col-7 pt-1 my-auto d-none d-md-inline">
        <h6 class="menu {{ request()->is('editors/dashboard') ? 'active' : '' }}">Dashboard</h6>
      </div>
    </a>

    {{-- Essay List --}}
    <a class="row w-100" href="/editors/essay-list" style="cursor: pointer">
      <div class="col-md-3 ps-lg-1">
        <img class="{{ request()->is('editors/essay-list') || request()->is('editors/essay-list/completed/detail') || request()->is('editors/essay-list/ongoing/detail') || request()->is('editors/essay-list/ongoing/eccepted') || request()->is('editors/essay-list/ongoing/submitted') || request()->is('editors/essay-list/ongoing/revise') || request()->is('editors/essay-list/ongoing/revised') ? 'active' : 'non-active' }}" src="/assets/essay-list-blue.png" alt="">
      </div>
      <div class="col-7 pt-1 my-auto d-none d-md-inline">
        <h6 class="menu {{ request()->is('editors/essay-list') || request()->is('editors/essay-list/completed/detail') || request()->is('editors/essay-list/ongoing/detail') || request()->is('editors/essay-list/ongoing/eccepted') || request()->is('editors/essay-list/ongoing/submitted') || request()->is('editors/essay-list/ongoing/revise') || request()->is('editors/essay-list/ongoing/revised') ? 'active' : '' }}">Essay List</h6>
      </div>
    </a>
  </div>

  <hr class="smallLine mx-auto mt-4">
  <div class="container ps-lg-5 ps-md-4 menuList d-flex flex-column text-md-start align-items-md-start align-items-center mt-5 mb-5 gap-4">
    <div type="button" class="row w-100" data-bs-toggle="modal" data-bs-target="#logout">
      <div class="col-md-3 ps-lg-1">
        <img class="active" src="/assets/logout.png" alt="">
      </div>
      <div class="col-8 pt-1 my-auto d-none d-md-inline">
        <h6 class="menu">Logout</h6>
      </div>
    </div>
  </div>
</div>
{{-- End Sidenav --}}

{{-- Modal Logout --}}
<div class="modal fade" id="logout" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content border-0">
      <div class="modal-header">
        <div class="col d-flex gap-2 align-items-center">
          <img src="/assets/logout-2.png" alt="">
          <h6 class="modal-title ms-3">Ready to leave?</h6>
        </div>
        <div type="button" data-bs-dismiss="modal" aria-label="Close">
          <img src="/assets/close.png" alt="" style="height: 26px">
        </div>
      </div>
      <div class="modal-body text-center px-4 py-4">
        <p>Select "Logout" below if you are ready to end your current session.</p>
      </div>
      <div class="modal-footer d-flex align-items-start justify-content-center border-0 pt-1 pb-4">
        <form action="/">
          <button type="submit">Logout</button>
        </form>
      </div>
    </div>
  </div>
</div>