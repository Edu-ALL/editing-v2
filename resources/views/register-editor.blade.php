<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="/assets/favicon.png" type="image/x-icon">
  <title>Essay Editing Portal</title>
  <link rel="stylesheet" href={{ asset('css/bootstrap.css') }}>
  <link rel="stylesheet" href="/css/home/home.css">
  <style>
    .file {
      visibility: hidden;
      position: absolute;
    }
    .fs-10 {
      font-size: 10px
    }
  </style>
</head>
<body> 
  <nav class="navbar" style="background-color: var(--bs-white)">
    <div class="container py-2 px-4">
      <a class="navbar-brand" href="/login/admin">
        <img class="img-logo " src="/assets/logo.png" alt="" width="220px" height="40">
      </a>
      <a class="btn btn-warning btnLogin" href="#role">Login</a>
    </div>
  </nav>
    
  {{-- Role --}}
  <div class="container text-center mt-4 pt-5" id="role">
    <div class="headline d-flex justify-content-center">
      <div class="col-md-6 col-8 text-center">
          <h5 class="pt-2">Complete your data</h5>
      </div>
    </div>
    {{-- @if($errors->any())
      <div class="row">
        {!! implode('', $errors->all('<div class="alert alert-danger" role="alert">:message</div>')) !!}
      </div>
    @endif --}}

    <div class="row mt-4 justify-content-center gap-3">
        <div class="col col-md-8 mt-3">
            <form class="text-start" autocomplete="off" action="{{ route('self-add-editor') }}" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="editorToken" value="{{ $request->get('token') }}">
              @csrf
              <div class="row">
                <div class="col col-md-4">
                  Picture
                    <div class="ml-2">
                      <div id="msg"></div>
                      {{-- <form method="post" id="image-form"> --}}
                        <input type="file" name="img" class="file" accept="image/*">
                        @error('img')
                            <small class="alert text-danger fs-10">{{ $message }}</small>
                        @enderror
                        <div class="input-group my-3">
                          <input type="text" class="form-control" disabled placeholder="Upload File" id="file">
                          <div class="input-group-append">
                            <button type="button" class="browse btn btn-primary">Browse...</button>
                          </div>
                        </div>
                      {{-- </form> --}}
                    </div>
                    <div class="ml-2">
                      <img src="https://placehold.it/80x80" id="preview" class="img-thumbnail">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <div class="d-flex">
                            <div class="me-3 col">
                                <label for="firstName" class="form-label">First name <i class="text-danger">*</i></label>
                                <input type="text" class="form-control" aria-describedby="firstName" name="first_name">
                                @error('first_name')
                                    <div class="alert text-danger fs-10">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="lastName" class="form-label">Last name</label>
                                <input type="text" class="form-control" aria-describedby="lastName" name="last_name">
                                @error('last_name')
                                    <div class="alert text-danger fs-10">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex">
                            <div class="me-3 col">
                                <label for="email" class="form-label">Email <i class="text-danger">*</i></label>
                                <input type="email" class="form-control" value="{{ $request->get('email') }}" autocomplete="off" name="email" readonly>
                                @error('email')
                                    <div class="alert text-danger fs-10">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="phone" class="form-label">Phone <i class="text-danger">*</i></label>
                                <input type="text" class="form-control" name="phone">
                                @error('phone')
                                    <div class="alert text-danger fs-10">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex">
                            <div class="me-3 col">
                                <label for="graduatedFrom" class="form-label">Graduated From <i class="text-danger">*</i></label>
                                <input type="text" class="form-control" name="graduated_from">
                                @error('graduated_from')
                                    <div class="alert text-danger fs-10">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="major" class="form-label">Major <i class="text-danger">*</i></label>
                                <input type="text" class="form-control" autocomplete="off" name="major" readonly onfocus="this.removeAttribute('readonly')">
                                @error('major')
                                    <div class="alert text-danger fs-10">{{ $message }}</div>
                                @enderror
                          </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address <i class="text-danger">*</i></label>
                        <textarea id="textarea" name="address" cols="30" rows="10" class="form-control"></textarea>
                        @error('address')
                            <div class="alert text-danger fs-10">{{ $message }}</div>
                        @enderror
                        {{-- <input type="text" class="form-control" autocomplete="off" readonly onfocus="this.removeAttribute('readonly')"> --}}
                    </div>
                    <div class="mb-3">
                      <div class="d-flex">
                          <div class="me-3 col">
                              <label for="password" class="form-label">Password <i class="text-danger">*</i></label>
                              <input type="password" class="form-control" autocomplete="off" name="password" readonly onfocus="this.removeAttribute('readonly')">
                              @error('password')
                                  <div class="alert text-danger fs-10">{{ $message }}</div>
                              @enderror
                          </div>
                          <div class="col">
                              <label for="confirmationPassword" class="form-label">Confirmation Password <i class="text-danger">*</i></label>
                              <input type="password" class="form-control" name="password_confirmation" readonly onfocus="this.removeAttribute('readonly')">
                              @error('password_confirmation')
                                  <div class="alert text-danger fs-10">{{ $message }}</div>
                              @enderror
                        </div>
                      </div>
                  </div>
                </div>
              </div>
              
              <div class="row text-center mt-4">
                <div class="col">
                  <button type="submit" class="btn btn-primary">Submit</button>

                </div>
              </div>
            </form>
        </div>
    </div>
  </div>
  {{-- End Role --}}

  {{-- Footer --}}
  <footer class="container-fluid pt-5 footer">
    <div class="row px-md-5 px-3 mb-4 justify-content-evenly">
      <div class="col-md-3 about mb-md-3 mb-4">
        <h5 class="mb-4">About Us</h5>
        <img src="/assets/logo.png" alt="" width="160" height="26" style="filter: saturate(0)">
        <p class="mt-3">We guide students who plan to study at top universities abroad and place them at their best-fit schools.</p>
        <div class="row">
          <a href="https://www.instagram.com/allineduspace/" target="_blank" style="width: auto">
            <img class="img-fluid sosmed" src="/assets/instagram.png" alt="">
          </a>
          <a href="https://www.linkedin.com/company/all-in-eduspace/" target="_blank" style="width: auto">
            <img class="img-fluid sosmed" src="/assets/linkedin.png" alt="">
          </a>
          <a href="https://www.facebook.com/allineduspace/" target="_blank" style="width: auto">
            <img class="img-fluid sosmed" src="/assets/facebook.png" alt="">
          </a>
          <a href="https://www.youtube.com/channel/UCLZ0P-RRdr7k5j2dxhNlObg" target="_blank" style="width: auto">
            <img class="img-fluid sosmed" src="/assets/youtube.png" alt="">
          </a>
        </div>
      </div>
      <div class="col-md-3 opening mb-3">
        <h5 class="mb-4">Opening Times</h5>
        <p>Monday - Saturday</p>
        <p>08.00 - 17.00</p>
        <p>Address : Jl. Panjang No. 36 Kebon Jeruk Jakarta Barat</p>
      </div>
      <div class="col-md-3 contact">
        <h5 class="mb-4">Contact Us</h5>
        <ul>
          <li>Tel : +62 818 0808 1363</li>
          <li>Tel : +62 878 6081 1413</li>
          <li>Email : info@all-inedu.com</li>
        </ul>
      </div>
    </div>
    <hr style="margin: 0;">
    <div class="col-md-5 mx-auto text-center mt-3 copyright">
      <p>Copyright ©2022. <b>All-in Eduspace</b>. All Rights Reserved</p>
    </div>
  </footer>
  {{-- End Footer --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    $(document).on("click", ".browse", function() {
      var file = $(this).parents().find(".file");
      file.trigger("click");
    });
    $('input[type="file"]').change(function(e) {
      var fileName = e.target.files[0].name;
      $("#file").val(fileName);

      var reader = new FileReader();
      reader.onload = function(e) {
        // get loaded data and render thumbnail.
        document.getElementById("preview").src = e.target.result;
      };
      // read the image file as a data URL.
      reader.readAsDataURL(this.files[0]);
    });
  </script>
</body>
</html>