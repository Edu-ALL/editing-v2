<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="/assets/favicon.png" type="image/x-icon">
  <title>Essay Editing Portal</title>
  <link rel="stylesheet" href={{ asset('css/bootstrap.css') }}>
  <link rel="stylesheet" href="/css/admin/essay-completed-detail.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdn.tiny.cloud/1/h7t62ozvqkx2ifkeh051fsy3k9irz7axx1g2zitzpbaqfo8m/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: '.textarea',
      width: 'auto',
      height: '300'
    });
  </script>
</head>
<body>
  <div class="container-fluid" style="padding: 0">
    <div class="row flex-nowrap main">

      {{-- Sidenav --}}
      <div class="col-md-2 col-2 sidenav py-4 px-md-0 px-2 text-center">
        <a class="navbar-brand mb-3" href="/">
          <img class="img-logo img-fluid" src="/assets/admin-logo.png" alt="">
        </a>
        <hr class="smallLine mx-auto mt-4">
        {{-- Menu --}}
        <div class="container ps-lg-5 ps-md-4 menuList d-flex flex-column text-md-start align-items-md-start align-items-center mt-5 mb-5 gap-5">
          {{-- Dashboard --}}
          <a class="row w-100" href="/admin/dashboard" style="cursor: pointer">
            <div class="col-md-3">
              <img class="non-active" src="/assets/dashboard-blue.png" alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
              <h6 class="menu">Dashboard</h6>
            </div>
          </a>

          {{-- Users --}}
          <div class="row w-100" id="users" style="cursor: pointer">
            <div class="col-md-3 ps-lg-1">
              <img class="non-active" src="/assets/users.png" alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
              <h6 class="menu">Users</h6>
            </div>
            {{-- Popup --}}
            <div class="col-auto d-none d-flex flex-column gap-4 popup-menu ps-4 pe-5 py-3" id="menu-users">
              <a class="col d-flex gap-3 align-items-center" href="/admin/user/student">
                <img class="active" src="/assets/student.png" alt="">
                <h6 class="menu">Students</h6>
              </a>
              <a class="col d-flex gap-3 align-items-center" href="/admin/user/mentor">
                <img class="active" src="/assets/mentor.png" alt="">
                <h6 class="menu">Mentors</h6>
              </a>
              <a class="col d-flex gap-3 align-items-center" href="/admin/user/editor">
                <img class="active" src="/assets/editor.png" alt="">
                <h6 class="menu">Editors</h6>
              </a>
            </div>
            {{-- End Popup --}}
          </div>

          {{-- Essay List --}}
          <div class="row w-100" id="essay" style="cursor: pointer">
            <div class="col-md-3 ps-lg-1">
              <img class="active" src="/assets/essay-list-blue.png" alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
              <h6 class="menu active">Essay List</h6>
            </div>
            {{-- Popup --}}
            <div class="col-auto d-none d-flex flex-column gap-4 popup-menu ps-4 pe-5 py-3" id="menu-essay">
              <a class="col d-flex gap-3 align-items-center" href="/admin/essay-list/ongoing">
                <img class="active" src="/assets/ongoing-essay.png" alt="">
                <h6 class="menu">Ongoing Essay</h6>
              </a>
              <a class="col d-flex gap-3 align-items-center" href="/admin/essay-list/completed">
                <img class="active" src="/assets/completed-essay.png" alt="">
                <h6 class="menu">Completed Essay</h6>
              </a>
            </div>
            {{-- End Popup --}}
          </div>

          {{-- Export to Excel --}}
          <div class="row w-100" id="export" style="cursor: pointer">
            <div class="col w-100 d-flex flex-row align-items-center justify-content-md-start justify-content-center">
              <div class="col-md-3 ps-lg-1">
                <img class="active" src="/assets/excel.png" alt="">
              </div>
              <div class="col-7 pt-1 my-auto d-none d-md-inline">
                <h6 class="menu">Export to Excel</h6>
              </div>
            </div>
            {{-- Popup --}}
            <div class="col-auto d-none d-flex flex-column gap-4 popup-menu ps-4 pe-5 py-3" id="menu-export">
              <a class="col d-flex gap-3 align-items-center" href="/admin/export-excel/student">
                <img class="active" src="/assets/student.png" alt="">
                <h6 class="menu">Students Essay</h6>
              </a>
              <a class="col d-flex gap-3 align-items-center" href="/admin/export-excel/editor">
                <img class="active" src="/assets/editor.png" alt="">
                <h6 class="menu">Editors Essay</h6>
              </a>
            </div>
            {{-- End Popup --}}
          </div>

          {{-- Settings --}}
          <div class="row w-100" id="setting" style="cursor: pointer">
            <div class="col-md-3 ps-lg-1">
              <img class="active" src="/assets/setting.png" alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
              <h6 class="menu">Settings</h6>
            </div>
            {{-- Popup --}}
            <div class="col-auto d-none d-flex flex-column gap-4 popup-menu ps-4 pe-5 py-3" id="menu-setting">
              <a class="col d-flex gap-3 align-items-center" href="/admin/setting/universities">
                <img class="active" src="/assets/university.png" alt="">
                <h6 class="menu">Universities</h6>
              </a>
              <a class="col d-flex gap-3 align-items-center" href="/admin/setting/essay-prompt">
                <img class="active" src="/assets/essay-prompt.png" alt="">
                <h6 class="menu">Essay Prompt</h6>
              </a>
              <a class="col d-flex gap-3 align-items-center" href="/admin/setting/programs">
                <img class="active" src="/assets/program.png" alt="">
                <h6 class="menu">Programs</h6>
              </a>
              <a class="col d-flex gap-3 align-items-center" href="/admin/setting/categories-tags">
                <img class="active" src="/assets/tags.png" alt="">
                <h6 class="menu">Categories/Tags</h6>
              </a>
            </div>
            {{-- End Popup --}}
          </div>
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
          <div class="row gap-2">
            <div class="col-md col-12 p-0 userCard profile">
              <div class="headline d-flex align-items-center gap-3">
                <img src="/assets/status.png" alt="">
                <h6>Status</h6>
              </div>
              <div class="col d-flex flex-column align-items-center px-3 py-md-5 py-4 gap-3 text-center justify-content-center" style="color: var(--black)">
                <img class="img-status" src="/assets/status-complete.png" alt="">
                <h6>Completed</h6>
              </div>
              <div class="headline d-flex align-items-center gap-3">
                <img src="/assets/file.png" alt="">
                <h6>Download Student Essay</h6>
              </div>
              <div class="col d-flex align-items-center justify-content-center py-md-4 py-4">
                <img class="img-word" src="/assets/logo-word.png" alt="">
              </div>
              <div class="col d-flex align-items-center justify-content-center pb-md-3 pb-3">
                <form action="">
                  <button class="btn btn-download d-flex align-items-center gap-2">
                    <img src="/assets/download.png" alt="">
                    <h6>Download</h6>
                  </button>
                </form>
              </div>
              <div class="headline d-flex align-items-center gap-3" style="background-color: var(--yellow)">
                <img src="/assets/file.png" alt="">
                <h6>Download Your File</h6>
              </div>
              <div class="col d-flex align-items-center justify-content-center py-md-4 py-4">
                <img class="img-word" src="/assets/logo-word.png" alt="">
              </div>
              <div class="col d-flex align-items-center justify-content-center pb-md-3 pb-3">
                <form action="">
                  <button class="btn btn-download d-flex align-items-center gap-2">
                    <img src="/assets/download.png" alt="">
                    <h6>Download</h6>
                  </button>
                </form>
              </div>
              <div class="headline d-flex align-items-center gap-3">
                <img src="/assets/assign.png" alt="">
                <h6>Assignment</h6>
              </div>
              <div class="col d-flex flex-column px-3 py-md-4 py-4 my-md-1 countEssay text-center justify-content-center" style="color: var(--black)">
                <h6 style="font-size: 14px; font-weight: 400">Senior Editor Dummy</h6>
              </div>
              <div class="headline d-flex align-items-center gap-3">
                <img src="/assets/tags.png" alt="">
                <h6>Tags</h6>
              </div>
              <div class="col d-flex flex-column px-3 py-md-4 py-4 my-md-1 countEssay text-center justify-content-center" style="color: var(--black)">
                <div class="col list-tags">
                  <div class="tags py-2 px-3">
                    <h6 style="font-size: 14px; font-weight: 400">The role model</h6>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-md-8 col-12 p-0 userCard">
              <div class="headline d-flex justify-content-between">
                <div class="col-md-6 col-8 d-flex align-items-center gap-3">
                  <img src="/assets/student.png" alt="">
                  <h6>Student Detail</h6>
                </div>
                <div class="col-md-4 col-4 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                  <a href="/admin/essay-list/completed"><img src="/assets/back.png" alt=""></a>
                </div>
              </div>
              <div class="row profile-editor px-md-4 py-md-4 px-3 py-4 mb-2" style="overflow: auto !important">
                <div class="col-md student-desc d-flex flex-column justify-content-center gap-lg-3 gap-2 ps-lg-3 px-2">
                  <div class="row d-flex align-items-center">
                    <div class="col-md-3 col-4">
                      <h6>Full Name</h6>
                    </div>
                    <div class="col-1 titik2"><p>:</p></div>
                    <div class="col-7">
                      <p>Student Dummy</p>
                    </div>
                  </div>
                  <div class="row d-flex align-items-center">
                    <div class="col-md-3 col-4">
                      <h6>Email</h6>
                    </div>
                    <div class="col-1 titik2"><p>:</p></div>
                    <div class="col-7">
                      <p>student.dummy@gmail.com</p>
                    </div>
                  </div>
                  <div class="row d-flex align-items-center">
                    <div class="col-md-3 col-4">
                      <h6>Address</h6>
                    </div>
                    <div class="col-1 titik2"><p>:</p></div>
                    <div class="col-7">
                      <p>Jl Jeruk Kembar blok Q9 no.15</p>
                    </div>
                  </div>
                  
                </div>
              </div>
              <div class="headline d-flex justify-content-between">
                <div class="col d-flex align-items-center gap-3">
                  <img src="/assets/detail.png" alt="">
                  <h6>Essay Detail</h6>
                </div>
              </div>
              <div class="row profile-editor px-md-3 py-md-4 px-3 py-4" style="overflow: auto !important">
                <form action="" class="p-0">
                  <div class="col-12 d-flex mb-3">
                    <div class="col-6">
                      <h6 class="pb-2">University Name :</h6>
                      <input type="text" class="form-control inputField py-2 px-3" disabled value="Arizona State University">
                    </div>
                    <div class="col-6">
                      <h6 class="pb-2">Essay Title :</h6>
                      <input type="text" class="form-control inputField py-2 px-3" disabled value="Supplemental Essay">
                    </div>
                  </div>
                  <div class="col-12 d-flex mb-4" style="overflow: auto !important">
                    <div class="col">
                      <h6 class="pb-2">Essay Prompt :</h6>
                      <textarea name="" class="textarea" style="overflow: auto !important"></textarea>
                    </div>
                  </div>
                  <div class="col-12 d-flex flex-lg-row flex-column mb-3">
                    <div class="col-lg-6 col d-flex mb-3">
                      <div class="col-6">
                        <h6 class="pb-2">Essay Deadline :</h6>
                        <input type="text" class="form-control inputField py-2 px-3" disabled value="Thu, 28 Jul 2022">
                      </div>
                      <div class="col-6">
                        <h6 class="pb-2">Application Deadline :</h6>
                        <input type="text" class="form-control inputField py-2 px-3" disabled value="Thu, 28 Jul 2022">
                      </div>
                    </div>
                    <div class="col-lg-6 col d-flex mb-3">
                      <div class="col-6">
                        <h6 class="pb-2">Editor Upload :</h6>
                        <input type="text" class="form-control inputField py-2 px-3" disabled value="Thu, 28 Jul 2022">
                      </div>
                      <div class="col-6">
                        <h6 class="pb-2">Status Essay :</h6>
                        <input type="text" class="form-control inputField py-2 px-3" disabled value="Late">
                      </div>
                    </div>
                  </div>
                  <div class="col-12 d-flex pt-3" style="border-top: 1px solid var(--light-grey)">
                    <div class="col d-flex flex-row align-items-center justify-content-center gap-3">
                      <button class="btn btn-create d-flex align-items-center gap-2" style="background-color: var(--green)">
                        <img src="/assets/letter.png" alt="">
                        <h6>Send to Student / Mentor</h6>
                      </button>
                      <button class="btn btn-create d-flex align-items-center gap-2" style="background-color: var(--red)">
                        <img src="/assets/danger.png" alt="">
                        <h6>Cancel, Revise</h6>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
              <div class="col d-flex flex-row alert-complete py-3 px-4" id="alertComplete">
                <div class="col d-flex align-items-center gap-2">
                  <img src="/assets/thumbsup.png" alt="">
                  <h6><b>Congratulations</b>, editor essay has been completed</h6>
                </div>
                <img src="/assets/exit.png" alt="" onclick="closeAlert()" style="cursor: pointer">
              </div>
              <div class="headline d-flex justify-content-between mt-1">
                <div class="col d-flex align-items-center gap-3">
                  <img src="/assets/feedback.png" alt="">
                  <h6>Feedback</h6>
                </div>
              </div>
              <div class="col-12 d-flex px-3 py-3 feedback">
                <div class="col d-flex flex-row align-items-center justify-content-center gap-3">
                  <div class="col d-flex flex-column gap-2">
                    <h6>Turn Around Time</h6>
                    <p>How long does it take for the editors to edit and then return the essays</p>
                  </div>
                  <div class="col-auto d-flex align-self-center">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                  </div>
                </div>
              </div>
              <div class="col-12 d-flex px-3 py-3 feedback" style="border-top: 1px solid var(--light-grey)">
                <div class="col d-flex flex-row align-items-center justify-content-center gap-3">
                  <div class="col d-flex flex-column gap-2">
                    <h6>Specificity of feedback</h6>
                    <p>How helpful is the feedback</p>
                  </div>
                  <div class="col-auto d-flex align-self-center">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                  </div>
                </div>
              </div>
              <div class="col-12 d-flex px-3 py-3 feedback" style="border-top: 1px solid var(--light-grey)">
                <div class="col d-flex flex-row align-items-center justify-content-center gap-3">
                  <div class="col d-flex flex-column gap-2">
                    <h6>Clarity of feedback</h6>
                  </div>
                  <div class="col-auto d-flex align-self-center">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                  </div>
                </div>
              </div>
              <div class="col-12 d-flex px-3 py-3 feedback" style="border-top: 1px solid var(--light-grey)">
                <div class="col d-flex flex-row align-items-center justify-content-center gap-3">
                  <div class="col d-flex flex-column gap-2">
                    <h6>How encouraged do you feel from the feedback</h6>
                    <p>How the editor speaks with the client AKA customer service</p>
                  </div>
                  <div class="col-auto d-flex align-self-center">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                  </div>
                </div>
              </div>
              <div class="col-12 d-flex px-3 py-3 feedback" style="border-top: 1px solid var(--light-grey)">
                <div class="col d-flex flex-row align-items-center justify-content-center gap-3">
                  <div class="col d-flex flex-column gap-2">
                    <h6>Do they help you grow as a writer/did you learn anything new</h6>
                  </div>
                  <div class="col-auto d-flex align-self-center">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                  </div>
                </div>
              </div>
              <div class="col-12 d-flex px-3 py-3 feedback" style="border-top: 1px solid var(--light-grey)">
                <div class="col d-flex flex-row align-items-center justify-content-center gap-3">
                  <div class="col d-flex flex-column gap-2">
                    <h6>How likely would you recommend this editor to others?</h6>
                  </div>
                  <div class="col-auto d-flex align-self-center">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                  </div>
                </div>
              </div>
              <div class="col-12 d-flex px-3 py-3 feedback" style="border-top: 1px solid var(--light-grey)">
                <div class="col-12 d-flex mb-2" style="overflow: auto !important">
                  <div class="col">
                    <h6 class="pb-2">Essay Prompt :</h6>
                    <textarea name="" class="textarea" style="overflow: auto !important"></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
        </div>
      </div>
      {{-- End Content --}}
    </div>
  </div>
  {{-- Footer --}}
  <footer class="container-fluid footer">
    <div class="col-md-5 mx-auto text-center py-2 copyright">
      <p>Copyright ©2022. <b>All-in Eduspace</b>. All Rights Reserved</p>
    </div>
  </footer>
  {{-- End Footer --}}

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
  
  <script src={{ asset('js/bootstrap.bundle.js') }}></script>
  <script src="/js/admin/admin.js"></script>
  <script>
    function closeAlert(){
      var alert = document.getElementById("alertComplete");
      alert.classList.add("d-none");
    }
  </script>
</body>
</html>