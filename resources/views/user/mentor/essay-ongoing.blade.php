@extends('user.mentor.utama.utama')
@section('css')
    <link rel="stylesheet" href="/css/mentor/user-mentor.css">
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
    <div class="container-fluid p-0">
        <div class="row flex-nowrap main" id="main">
            @include('user.mentor.utama.menu')

            {{-- Content --}}
            <div class="col">
                @include('user.mentor.utama.head')
                <div class="container main-content m-0">
                    {{-- Table Student --}}
                    <div class="row">
                        <div class="col-md col-12 p-0 studentList">
                            <div class="headline d-flex justify-content-between">
                                <div class="col-md-6 col-5 d-flex align-items-center gap-md-3 gap-2">
                                    <img src="/assets/ongoing-essay.png" alt="">
                                    <h6>Ongoing Essay List</h6>
                                </div>
                            </div>
                            <div class="container text-start px-3 py-2">
                                <table class="table table-bordered" id="listongoingessay" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Student Name</th>
                                            <th>Mentor Name</th>
                                            <th>Editor Name</th>
                                            <th>Essay Title</th>
                                            <th>Essay Deadline</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            </a>
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
            // List Student
            $(document).ready(function() {
                $('#listongoingessay').DataTable({
                    scrollX: true,
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('data-mentor-essay-list-ongoing') }}',
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
                            data: 'editor_name',
                            name: 'editor_name'
                        },
                        {
                            data: 'essay_title',
                            name: 'essay_title'
                        },
                        {
                            data: 'essay_deadline',
                            name: 'essay_deadline'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                    ],
                    rowCallback: function(row, data) {
                        $(row).on('click', function() {
                            window.location.href =
                                `/mentor/essay-list/ongoing/detail/${data.id_essay_clients}`;
                        });
                    }
                });
            });
        </script>
    @stop
