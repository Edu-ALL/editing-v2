<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="/assets/favicon.png" type="image/x-icon">
  <title>Essay Editing Portal</title>
  <link rel="stylesheet" href={{ asset('css/bootstrap.css') }}>
  <link rel="stylesheet" href="/css/admin/dashboard.css">
  <link rel="stylesheet" href="/css/admin/user-student.css">
  <link rel="stylesheet" href="/css/admin/user-student-detail.css">
  <link rel="stylesheet" href="/css/admin/user-mentor.css">
  <link rel="stylesheet" href="/css/admin/user-editor.css">
  <link rel="stylesheet" href="/css/admin/user-editor-invite.css">
  <link rel="stylesheet" href="/css/admin/user-editor-detail.css">
  <link rel="stylesheet" href="/css/admin/user-editor-add.css">
  <link rel="stylesheet" href="/css/admin/essay-ongoing.css">
  <link rel="stylesheet" href="/css/admin/essay-completed.css">
  <link rel="stylesheet" href="/css/admin/essay-completed-detail.css">
  <link rel="stylesheet" href="/css/admin/export-student-essay.css">
  <link rel="stylesheet" href="/css/admin/export-editor-essay.css">
  <link rel="stylesheet" href="/css/admin/setting-universities.css">
  <link rel="stylesheet" href="/css/admin/setting-add-universities.css">
  <link rel="stylesheet" href="/css/admin/setting-detail-universities.css">
  <link rel="stylesheet" href="/css/admin/setting-essay-prompt.css">
  <link rel="stylesheet" href="/css/admin/setting-add-essay-prompt.css">
  <link rel="stylesheet" href="/css/admin/setting-detail-essay-prompt.css">
  <link rel="stylesheet" href="/css/admin/setting-programs.css">
  <link rel="stylesheet" href="/css/admin/setting-add-programs.css">
  <link rel="stylesheet" href="/css/admin/setting-detail-programs.css">
  <link rel="stylesheet" href="/css/admin/setting-categories.css">
  <link rel="stylesheet" href="/css/admin/setting-detail-categories.css">

  {{-- TinyMCE --}}
  <script src="https://cdn.tiny.cloud/1/h7t62ozvqkx2ifkeh051fsy3k9irz7axx1g2zitzpbaqfo8m/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

  {{-- Selectize --}}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.6/css/selectize.bootstrap5.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.6/js/standalone/selectize.min.js"></script>

</head>
<body>
  @yield('content')
  {{-- Footer --}}
  <footer class="container-fluid footer">
    <div class="col-md-5 mx-auto text-center py-2 copyright">
      <p>Copyright ©2022. <b>All-in Eduspace</b>. All Rights Reserved</p>
    </div>
  </footer>
  {{-- End Footer --}}

  <script src={{ asset('js/bootstrap.js') }}></script>
  <script src="/js/admin/admin.js"></script>
  <script>
    tinymce.init({
      selector: '.textarea',
      width: 'auto',
      height: '300'
    });
  </script>
  <script>
    $(".select-beast").selectize({
      create: false,
      sortField: "text",
    });
  </script>
  <script>
    function closeAlert(){
      var alert = document.getElementById("alertComplete");
      alert.classList.add("d-none");
    }
  </script>
  <script>
    function previewImage(){
      const imgPreview = document.querySelector('#img-profile');
      imgPreview.src = URL.createObjectURL(event.target.files[0]);
    }
    var check = false;
    function enableEdit(){
      var chooseFile = document.getElementById('chooseFile');
      var univ = document.getElementById('university');
      var email = document.getElementById('email');
      var web = document.getElementById('website');
      var phone = document.getElementById('phone');
      var country = document.getElementById('country');
      var btnAddUniv = document.getElementById('btnAddUniv');
      if (check == false){
        chooseFile.classList.remove('d-none');
        univ.disabled = false;
        email.disabled = false;
        web.disabled = false;
        phone.disabled = false;
        country.disabled = false;
        btnAddUniv.classList.remove('d-none');
        check = true;
      } else if (check == true){
        chooseFile.classList.add('d-none');
        univ.disabled = true;
        email.disabled = true;
        web.disabled = true;
        phone.disabled = true;
        country.disabled = true;
        btnAddUniv.classList.add('d-none');
        check = false;
      }
    }
  </script>
</body>
</html>