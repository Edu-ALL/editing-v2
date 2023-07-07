@extends('user.admin.utama.utama')
@section('css')
    <link rel="stylesheet" href="/css/admin/user-student.css">
    <style>
        .pagination {
            margin: 15px 0
        }

        .pagination .page-item .page-link {
            padding: 10px 15px;
            font-size: 12px;
        }
    </style>
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
                                <div class="col-md-6 col-5 d-flex align-items-center gap-md-3 gap-2">
                                    <img src="/assets/student.png" alt="">
                                    <h6>Students</h6>
                                </div>
                                <div class="col-md-4 col-6 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                                    <a href="{{ route('sync-clients') }}" id="sync-clients" title="Sync CRM Clients"
                                        data-bs-target="#syncModal">
                                        <img src="/assets/reload.png" alt="">
                                    </a>
                                    {{-- <div class="input-group">
                                        <form id="form-client-searching" action="{{ route('list-client') }}" method="GET"
                                            role="search" class="w-100">
                                            <input type="text" class="form-control inputField py-2 px-3" name="keyword"
                                                id="search-client" placeholder="Search" required>
                                        </form>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="container text-start px-3 py-2">
                                <table class="table  table-bordered" id="liststudent" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Student Name</th>
                                            <th>Mentor Name</th>
                                            <th>Backup Mentor</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>City</th>
                                        </tr>
                                    </thead>
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

<<<<<<< HEAD
    <!-- Modal -->
    <div class="modal fade" id="syncModal" tabindex="-1" aria-labelledby="syncLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-light" id="syncLabel">Sync Bigdata Platform</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered" width="100%" id="markup-clients">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Students Name</th>
                                <th>Email</th>
                                <th>Mentor Name</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('do-sync-clients') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Sync Now</button>
                    </form>
                </div>
            </div>
        </div>
=======
<!-- Modal -->
<div class="modal fade" id="syncModal" tabindex="-1" aria-labelledby="syncLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-light" id="syncLabel">Sync Bigdata Platform</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered" width="100%" id="markup-clients">
          <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Students Name</th>
                <th>Email</th>
                <th>Mentor Name</th>
                <th>Action</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <form action="{{ route('do-sync-clients') }}" id="do-sync" method="POST">
          <button type="submit" class="btn btn-primary">Sync Now</button>
        </form>
      </div>
>>>>>>> origin/development-v1.0
    </div>
@endsection

@section('js')
<<<<<<< HEAD
    <script>
        $(document).ready(function() {
            $('#liststudent').DataTable({
                scrollX: true,
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{{ route('data-student') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        class: 'text-center'
                    },
                    {
                        data: 'student_name',
                        name: 'student_name'
                    },
                    {
                        data: 'mentor_name',
                        name: 'mentor_name'
                    },
                    {
                        data: 'backup_mentor',
                        name: 'backup_mentor'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'city',
                        name: 'city'
                    },
                ],
                rowCallback: function(row, data) {
                    $(row).on('click', function() {
                        window.location.href = `/admin/user/student/detail/${data.id_clients}`;
                    });
                }
            });
        });
    </script>
    <script>
        $("#do-sync").submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Sync Clients From Bigdata',
                icon: 'info',
                html: 'Are you sure?',
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: '<i class="fa fa-check"></i> Yes',
                cancelButtonText: 'Not sure',
            }).then((result) => {
                if (result.isConfirmed) {
                    swal.showLoading();
                    $.ajax({
                        url: $(this).attr('action'),
                    }).done(function(msg) {
                        Swal.fire('Saved!', '', 'success')
                        location.reload();
                    });
=======
  <script>
    $(document).on('click', '#do-sync button', function(e) {
      e.preventDefault();

      const selectedId = [];

      $(".selectedClient:checkbox:checked").each(function(i) {
        selectedId[i] = $(this).val();
      })

      Swal.fire({
        title: 'Sync Clients From Bigdata',
        icon: 'info',
        html:
          'Are you sure?',
        showCloseButton: true,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText:
          '<i class="fa fa-check"></i> Yes',
        cancelButtonText:
          'Not sure',
      }).then((result) => {
        if (result.isConfirmed) {
          
          var url = $("#do-sync").attr('action');
          
          Swal.showLoading();
          $.ajax({
            url: url,
            type: 'POST',
            data: {
              _token: "{{ csrf_token() }}",
              "selectedClient" : selectedId
            }
          }).done(function(msg) {
            console.log(msg)
            if (msg == true)
              Swal.fire('Sync completed', '', 'success')
            else
              Swal.fire('Error while processing', '', 'error')

            location.reload();
          });
          
        }
      })
      
    })
    $("#ddo-sync").submit(function(e) {
      e.preventDefault();

      Swal.fire({
        title: 'Sync Clients From Bigdata',
        icon: 'info',
        html:
          'Are you sure?',
        showCloseButton: true,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText:
          '<i class="fa fa-check"></i> Yes',
        cancelButtonText:
          'Not sure',
      }).then((result) => {
        if (result.isConfirmed) {
          swal.showLoading();
          $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: {
              selectedClient : selectedClient
            }
          }).done(function(msg) {
            Swal.fire('Saved!', '', 'success')
            location.reload();
          });
          
        }
      })
    });
  </script>
  <script type="text/javascript">  
    $("#search-client").keypress(function(e) {
      if (e.keyCode === 13) {
        swal.showLoading();
        e.preventDefault();
        $("#form-client-searching").submit();
      }
    });
>>>>>>> origin/development-v1.0

                }
            })
        });
    </script>
    <script type="text/javascript">
        // $("#search-client").keypress(function(e) {
        //     if (e.keyCode === 13) {
        //         swal.showLoading();
        //         e.preventDefault();
        //         $("#form-client-searching").submit();
        //     }
        // });

        $("#sync-clients").click(function(e) {
            e.preventDefault();
            swal.showLoading();

<<<<<<< HEAD
            $.ajax({
                url: $(this).attr('href'),
            }).done(function(msg) {
                if (msg.length === 0) {
                    swal.close();
                    Swal.fire(
                        'Sync Clients From Bigdata',
                        'There are no data to sync',
                        'info'
                    );
                    return;
                }
=======
        var markup = "";
        var no = 1;
        for (i in msg) {

          var first_name = msg[i].first_name;
          var last_name = msg[i].last_name;
          if (last_name == null)
            last_name = '';

          var email = msg[i].email;
          if (email == null)
            email = '';

          markup += "<tr>" + 
              "<td>" + no++ + "</td>" +
              "<td>" + first_name + " " + last_name + "</td>" +
              "<td>" + email + "</td>" +
              "<td>" + msg[i].mentor_name + "</td>" +
              "<td><input type='checkbox' class='selectedClient' name='selectedClient[]' value='"+ msg[i].id_clients +"' /></td>"
            "</tr>";
        }
        
        $("#markup-clients tbody").html(''); //set tbody always empty at first
        $("#markup-clients tbody").append(markup);
>>>>>>> origin/development-v1.0

                var markup = "";
                var no = 1;
                for (i in msg) {
                    markup += "<tr>" +
                        "<td>" + no++ + "</td>" +
                        "<td>" + msg[i].first_name + " " + msg[i].last_name + "</td>" +
                        "<td>" + msg[i].email + "</td>" +
                        "<td>" + msg[i].mentor_name + "</td>" +
                        "</tr>";
                }

                $("#markup-clients tbody").html(''); //set tbody always empty at first
                $("#markup-clients tbody").append(markup);

                swal.close();
                $("#syncModal").modal('show');
            });
        });
    </script>
@stop
