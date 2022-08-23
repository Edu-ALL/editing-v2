@extends('user.admin.utama.utama')
@section('css')
  <link rel="stylesheet" href="/css/admin/dashboard.css">
@endsection

@section('content')
<div class="container-fluid">
  <div class="row flex-nowrap main" id="main">

    {{-- Sidenav --}}
    @include('user.admin.utama.menu')

    {{-- Content --}}
    <div class="col">
      @include('user.admin.utama.head')
      <div class="container main-content m-0">
        {{-- User List --}}
        <div class="row gap-2">
          <a class="col-md col-12 p-0 userCard" href="/admin/user/student">
            <div class="headline text-center">
              <h6>Students</h6>
            </div>
            <div class="row px-3 countUser align-items-center text-center">
              <div class="col">
                <img class="img-fluid" src="/assets/student-bg.png" alt="">
              </div>
              <div class="col">
                <h4>1</h4>
                <h4>Students</h4>
              </div>
            </div>
            <hr>
            <div class="detailCard ps-3 mt-2">
              <h6>See the list of Students</h6>
            </div>
          </a>
          <a class="col-md col-12 p-0 userCard" href="/admin/user/mentor">
            <div class="headline text-center">
              <h6>Mentors</h6>
            </div>
            <div class="row px-3 countUser align-items-center text-center">
              <div class="col">
                <img class="img-fluid" src="/assets/mentor-bg.png" alt="">
              </div>
              <div class="col">
                <h4>1</h4>
                <h4>Mentors</h4>
              </div>
            </div>
            <hr>
            <div class="detailCard ps-3 mt-2">
              <h6>See the list of Mentors</h6>
            </div>
          </a>
          <a class="col-md col-12 p-0 userCard" href="/admin/user/editor">
            <div class="headline text-center">
              <h6>Editors</h6>
            </div>
            <div class="row px-3 countUser align-items-center text-center">
              <div class="col">
                <img class="img-fluid" src="/assets/editor-bg.png" alt="">
              </div>
              <div class="col">
                <h4>1</h4>
                <h4>Editors</h4>
              </div>
            </div>
            <hr>
            <div class="detailCard ps-3 mt-2">
              <h6>See the list of Editors</h6>
            </div>
          </a>
        </div>
        {{-- End User List --}}

        {{-- Essay --}}
        <div class="row gap-2 my-2">
          <a class="col-md col-12 p-0 userCard">
            <div class="headline d-flex align-items-center gap-3">
              <img src="/assets/ongoing-essay.png" alt="">
              <h6>Ongoing Essay</h6>
            </div>
            <div class="col d-flex flex-column px-3 countEssay text-center justify-content-center">
              <h4>1</h4>
              <h4>Essay</h4>
            </div>
            <hr>
            <div class="detailCard ps-3 mt-2">
              <h6>See the list of Students</h6>
            </div>
          </a>
          <a class="col-md col-12 p-0 userCard" href="/admin/essay-list/completed">
            <div class="headline d-flex align-items-center gap-3" style="background-color: var(--green)">
              <img src="/assets/completed-essay.png" alt="">
              <h6>Completed Essay</h6>
            </div>
<<<<<<< HEAD
            <div class="col-8 pt-1 my-auto d-none d-md-inline">
              <h6 class="menu">
                <form action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="border-0 bg-transparent">Logout</button>
                </form>
              </h6>
=======
            <div class="col d-flex flex-column px-3 countEssay text-center justify-content-center" style="color: var(--green)">
              <h4>1</h4>
              <h4>Essay</h4>
>>>>>>> b115ecc8ae4b0c88efeb4760a6c90bbac3661077
            </div>
            <hr>
            <div class="detailCard ps-3 mt-2">
              <h6>See the list of Students</h6>
            </div>
<<<<<<< HEAD
          </div>
        </div>
        <div class="container main-content m-0">
          @if(session()->has('login-successful'))
            <div class="row alert alert-success fade show" role="alert">
              {{ session()->get('login-successful') }}
            </div>
          @endif
          {{-- User List --}}
          <div class="row gap-2">
            <a class="col-md col-12 p-0 userCard" href="/admin/user/student">
              <div class="headline text-center">
                <h6>Students</h6>
              </div>
              <div class="row px-3 countUser align-items-center text-center">
                <div class="col">
                  <img class="img-fluid" src="/assets/student-bg.png" alt="">
                </div>
                <div class="col">
                  <h4>1</h4>
                  <h4>Students</h4>
                </div>
              </div>
              <hr>
              <div class="detailCard ps-3 mt-2">
                <h6>See the list of Students</h6>
              </div>
            </a>
            <a class="col-md col-12 p-0 userCard" href="/admin/user/mentor">
              <div class="headline text-center">
                <h6>Mentors</h6>
              </div>
              <div class="row px-3 countUser align-items-center text-center">
                <div class="col">
                  <img class="img-fluid" src="/assets/mentor-bg.png" alt="">
                </div>
                <div class="col">
                  <h4>1</h4>
                  <h4>Mentors</h4>
                </div>
              </div>
              <hr>
              <div class="detailCard ps-3 mt-2">
                <h6>See the list of Mentors</h6>
              </div>
            </a>
            <a class="col-md col-12 p-0 userCard" href="/admin/user/editor">
              <div class="headline text-center">
                <h6>Editors</h6>
              </div>
              <div class="row px-3 countUser align-items-center text-center">
                <div class="col">
                  <img class="img-fluid" src="/assets/editor-bg.png" alt="">
                </div>
                <div class="col">
                  <h4>1</h4>
                  <h4>Editors</h4>
                </div>
              </div>
              <hr>
              <div class="detailCard ps-3 mt-2">
                <h6>See the list of Editors</h6>
              </div>
            </a>
          </div>
          {{-- End User List --}}

          {{-- Essay --}}
          <div class="row gap-2 my-2">
            <a class="col-md col-12 p-0 userCard">
              <div class="headline d-flex align-items-center gap-3">
                <img src="/assets/ongoing-essay.png" alt="">
                <h6>Ongoing Essay</h6>
              </div>
              <div class="col d-flex flex-column px-3 countEssay text-center justify-content-center">
                <h4>1</h4>
                <h4>Essay</h4>
              </div>
              <hr>
              <div class="detailCard ps-3 mt-2">
                <h6>See the list of Students</h6>
              </div>
            </a>
            <a class="col-md col-12 p-0 userCard" href="/admin/essay-list/completed">
              <div class="headline d-flex align-items-center gap-3" style="background-color: var(--green)">
                <img src="/assets/completed-essay.png" alt="">
                <h6>Completed Essay</h6>
              </div>
              <div class="col d-flex flex-column px-3 countEssay text-center justify-content-center" style="color: var(--green)">
                <h4>1</h4>
                <h4>Essay</h4>
              </div>
              <hr>
              <div class="detailCard ps-3 mt-2">
                <h6>See the list of Students</h6>
              </div>
            </a>
          </div>
          {{-- End Essay --}}
=======
          </a>
>>>>>>> b115ecc8ae4b0c88efeb4760a6c90bbac3661077
        </div>
        {{-- End Essay --}}
      </div>
    </div>
    {{-- End Content --}}
  </div>
<<<<<<< HEAD
  {{-- Footer --}}
  <footer class="container-fluid footer">
    <div class="col-md-5 mx-auto text-center py-2 copyright">
      <p>Copyright ©2022. <b>All-in Eduspace</b>. All Rights Reserved</p>
    </div>
  </footer>
  {{-- End Footer --}}

  <script src={{ asset('js/bootstrap.js') }}></script>
  <script src="/js/admin/admin.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  @if(session()->has('login-successful'))
  <script>
    $(document).ready(function() {
      setTimeout(() => {
        $(".alert-success").alert('close');
      }, 3000);
    });
  </script>
  @endif
</body>
</html>
=======
</div>
@endsection
>>>>>>> b115ecc8ae4b0c88efeb4760a6c90bbac3661077
