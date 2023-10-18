@extends('user.editor.utama.utama')
@section('css')
    <style>
        .unread {
            font-weight: 600
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid p-0">
        <div class="row flex-nowrap main" id="main">
            @include('user.editor.utama.menu')

            {{-- Content --}}
            <div class="col" style="overflow: auto !important">
                @include('user.editor.utama.head')
                <div class="container main-content m-0">
                    <div class="row flex-column gap-4">
                        <div class="col p-0">
                            <div class="col-md col-12 p-0 userCard" style="cursor: default">
                                <div class="headline d-flex align-items-center px-md-4 px-3 py-3 gap-md-3 gap-1"
                                @if (request()->is('editor/all-essays/assigned-essay-list'))
                                    style="background-color: var(--green)"
                                @endif
                                >
                                    <div class="col-md col-7 d-flex align-items-center gap-md-3 gap-2">
                                        @if (request()->is('editor/all-essays/assigned-essay-list'))
                                            <img src="/assets/completed-essay.png" alt="">
                                        @else
                                            <img src="/assets/ongoing-essay.png" alt="">
                                        @endif
                                        
                                        @if (request()->is('editor/all-essays/not-assign-essay-list'))
                                            <h6>List of Not Assign Essay</h6>
                                        @elseif (request()->is('editor/all-essays/assigned-essay-list'))
                                            <h6>List of Assign Essay</h6>
                                        @elseif (request()->is('editor/all-essays/ongoing-essay-list'))
                                            <h6>List of Ongoing Essay</h6>
                                        @endif
                                    </div>
                                </div>
                                <div class="container text-start px-3 py-2">
                                    <table class="table" id="listessayongoing" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Student Name</th>
                                                <th>Mentor Name</th>
                                                <th>Editor Name</th>
                                                <th>Request (Editor)</th>
                                                <th>Program Name</th>
                                                <th>Essay Title</th>
                                                <th>Upload Date</th>
                                                <th>Editors Deadline</th>
                                                <th>Essay Deadline</th>
                                                <th>Status</th>
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
    // List Essay
    $(document).ready(function () {
        var pathname = window.location.pathname;
        var route;
        if (pathname == '/editor/all-essays/not-assign-essay-list') {
            route = '{{ route('managing-data-essay-not-assign') }}'
        } else if (pathname == '/editor/all-essays/assigned-essay-list'){
            route = '{{ route('managing-data-essay-assign') }}'
        } else if (pathname == '/editor/all-essays/ongoing-essay-list'){
            route = '{{ route('managing-data-all-essay-ongoing') }}'
        }
        $('#listessayongoing').DataTable({
            scrollX: true,
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: route,
            columns: [
                {
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
                    data: 'request_editor',
                    name: 'request_editor'
                },
                {
                    data: 'program_name',
                    name: 'program_name'
                },
                {
                    data: 'essay_title',
                    name: 'essay_title'
                },
                {
                    data: 'upload_date',
                    name: 'upload_date'
                },
                {
                    data: 'editors_deadline',
                    name: 'editors_deadline'
                },
                {
                    data: 'essay_deadline',
                    name: 'essay_deadline'
                },
                {
                    data: 'status',
                    name: 'status',
                },
            ]
        });
    });
    function getOngoingDetail(id){
        var link = '/editor/all-essays/ongoing/detail/' + id
        // window.location.href = link;
        window.open(link, '_blank');
    }
</script>
@endsection