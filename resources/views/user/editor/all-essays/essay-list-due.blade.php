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
                                <div class="headline d-flex align-items-center px-md-4 px-3 py-3 gap-md-3 gap-1">
                                    <div class="col-md col-7 d-flex align-items-center gap-md-3 gap-2">
                                        <img src="/assets/all-essay.png" alt="">
                                        @if (request()->is('editor/all-essays/essay-list-due-tommorow'))
                                            <h6>All Essays - Due Tomorrow List</h6>
                                        @elseif (request()->is('editor/all-essays/essay-list-due-within-three'))
                                            <h6>All Essays - Due Within 3 Days List</h6>
                                        @elseif (request()->is('editor/all-essays/essay-list-due-within-five'))
                                            <h6>All Essays - Due Within 5 Days List</h6>
                                        @endif
                                    </div>
                                </div>
                                <div class="container-fluid text-start px-3 py-2">
                                    <table class="table" id="essaylistdue" style="width: 100%">
                                        <thead class="text-nowrap">
                                            <tr>
                                                <th>No</th>
                                                <th>Student Name</th>
                                                <th>Mentor Name</th>
                                                <th>Editor Name</th>
                                                <th>Request (Editor)</th>
                                                <th>Program Name</th>
                                                <th>Essay Title</th>
                                                <th>Upload Date</th>
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
        if (pathname == '/editor/all-essays/essay-list-due-tommorow') {
            route = '{{ route('managing-data-all-due-tomorrow') }}'
        } else if (pathname == '/editor/all-essays/essay-list-due-within-three'){
            route = '{{ route('managing-data-all-due-three-days') }}'
        } else if (pathname == '/editor/all-essays/essay-list-due-within-five'){
            route = '{{ route('managing-data-all-due-five-days') }}'
        }
        $('#essaylistdue').DataTable({
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
        window.location.href = link;
    }
</script>
@endsection