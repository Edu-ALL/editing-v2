@extends('user.admin.utama.utama')
@section('css')
    <link rel="stylesheet" href="/css/admin/user-mentor.css">
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
                                    <img src="/assets/mentor.png" alt="">
                                    <h6>Mentors</h6>
                                </div>
                                <div class="col-md-4 col-6 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                                    <a href="{{ route('do-sync-mentors') }}" id="sync-mentors" title="Sync CRM Mentors">
                                        <img src="/assets/reload.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="container text-start px-3 py-2">
                                <table class="table  table-bordered" id="listmentor" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Mentor Name</th>
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

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#listmentor').DataTable({
                scrollX: true,
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{{ route('data-mentor') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        class: 'text-center'
                    },
                    {
                        data: 'name',
                        name: 'name'
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
                        data: 'address',
                        name: 'address'
                    },
                ]
            });
        });
    </script>

    <script type="text/javascript">
        // $("#search-mentor").keypress(function(e) {
        //     if (e.keyCode === 13) {
        //         swal.showLoading();
        //         e.preventDefault();
        //         $("#form-mentor-searching").submit();
        //     }
        // });

        $("#sync-mentors").click(function(e) {
            e.preventDefault();
            swal.showLoading();

            $.ajax({
                url: $(this).attr('href'),
                type: "GET",
                success: function(response) {
                    msg = JSON.parse(response);
                    if (msg.success == true) {
                        Swal.fire(
                            'Congratulations !',
                            'Mentors CRM data synchronization<br>has been successful',
                            'success'
                        )
                    } else {
                        Swal.fire(
                            '',
                            msg.message,
                            'info'
                        )
                    }
                }
            })
        })
    </script>
@stop
