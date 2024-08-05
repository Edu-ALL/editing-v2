@extends('user.mentor.utama.utama')
@section('css')
    <link rel="stylesheet" href="/css/mentor/user-student.css">
@endsection
@section('content')
    <div class="container-fluid p-0">
        <div class="row flex-nowrap main" id="main">
            @include('user.mentor.utama.menu')

            {{-- Content --}}
            <div class="col" style="overflow: auto !important">
                @include('user.mentor.utama.head')
                <div class="container main-content m-0">
                    <div class="row">
                        @if ($errors->any())
                            {!! implode('', $errors->all('<div class="alert alert-danger" role="alert">:message</div>')) !!}
                        @endif

                        @if (session()->has('update-data-successful'))
                            <div class="alert alert-success fade show" role="alert">
                                {{ session()->get('update-data-successful') }}
                            </div>
                        @endif
                        <div class="col p-0">
                            <div class="col-md col-12 p-0 userCard studentList" style="cursor: default">
                                <div class="headline d-flex align-items-center px-md-4 px-3 py-3 gap-md-3 gap-1">
                                    <div class="col-md col-7 d-flex align-items-center gap-md-3 gap-2">
                                        <img src="/assets/student.png" alt="">
                                        <h6>Students List</h6>
                                    </div>
                                </div>
                                <div class="container text-start px-3 py-2">
                                    <table class="table" id="liststudent" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Student Name</th>
                                                <th>Status</th>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        // List Student
        $(document).ready(function() {
            $('#liststudent').DataTable({
                scrollX: true,
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{{ route('mentor-data-student') }}',
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
                        data: 'status',
                        name: 'status',
                        render(h) {
                            let is_active = h == 1 ? 'Active' : 'Inactive'
                            let bg_badge = h == 1 ? 'bg-success' : 'bg-danger'
                            let status = '<span class="badge py-1 px-2 ' + bg_badge + '" >' +
                                is_active + '</span>'

                            return status
                        },
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
                ]
            });
        });

        function getStudentDetail(id) {
            var link = '/mentor/user/student/detail/' + id
            window.location.href = link;
        }
    </script>
@endsection
