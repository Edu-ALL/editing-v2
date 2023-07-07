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
                                        <h6>All Essays - Due Within 5 Days List</h6>
                                    </div>
                                </div>
<<<<<<< HEAD
                                <div class="container text-start px-3 py-2">
                                    <table class="table" id="listduefivedays" style="width: 100%">
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
                                                <th>Essay Deadline</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                    </table>
=======
                            </div>
                            <div class="container text-center" style="overflow-x: auto !important">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Student Name</th>
                                            <th>Mentor Name</th>
                                            <th>Editor Name</th>
                                            <th>Request(Editor)</th>
                                            <th>Program Name</th>
                                            <th>Essay Title</th>
                                            <th>Upload Date</th>
                                            <th>Essay Deadline</th>
                                            <th>App Deadline</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = ($essays->currentpage()-1)* $essays->perpage() + 1;?>
                                        @foreach ($essays as $essay)
                                        <tr onclick="window.location='/editor/all-essays/ongoing/detail/{{ $essay->id_essay_clients }}'">
                                            <th scope="row" class="{{ $essay->status_read_editor == 0 ? 'unread' : '' }}">{{ $i++ }}</th>

                                            <td class="{{ $essay->status_read_editor == 0 ? 'unread' : '' }}">{{ $essay->client_by_id->first_name.' '.$essay->client_by_id->last_name }}</td>
                                            <td class="{{ $essay->status_read_editor == 0 ? 'unread' : '' }}">{{ $essay->client_by_id->mentors->first_name.' '.$essay->client_by_id->mentors->last_name  }}</td>
                                            {{-- <td class="{{ $essay->status_read_editor == 0 ? 'unread' : '' }}">{{ $essay->status_essay_clients == 0 ? '-' : $essay->editor->first_name.' '.$essay->editor->last_name }}</td> --}}
                                            <td class="{{ $essay->status_read_editor == 0 ? 'unread' : '' }}">
                                                @if ($essay->essay_editors && $essay->essay_editors->editor != null)
                                                    {{ $essay->essay_editors->editor->first_name.' '.$essay->essay_editors->editor->last_name }}
                                                @elseif ($essay->status_essay_clients == 0 || $essay->editor == null)
                                                    -
                                                @endif
                                            </td>
                                            <td class="{{ $essay->status_read_editor == 0 ? 'unread' : '' }}">{{ $essay->editor ? $essay->editor->first_name.' '.$essay->editor->last_name : '-' }}</td>
                                            <td class="{{ $essay->status_read_editor == 0 ? 'unread' : '' }}">{{ $essay->program->program_name.' ('.$essay->program->minimum_word.' - '.$essay->program->maximum_word.' Words)' }}</td>
                                            <td class="{{ $essay->status_read_editor == 0 ? 'unread' : '' }}">{{ $essay->essay_title }}</td>
                                            <td class="{{ $essay->status_read_editor == 0 ? 'unread' : '' }}">{{ date('D, d M Y', strtotime($essay->uploaded_at)) }}</td>
                                            <td class="{{ $essay->status_read_editor == 0 ? 'unread' : '' }}">{{ date('D, d M Y', strtotime($essay->essay_deadline)) }}</td>
                                            <td class="{{ $essay->status_read_editor == 0 ? 'unread' : '' }}">{{ date('D, d M Y', strtotime($essay->application_deadline)) }}</td>
                                            <td class="{{ $essay->status_read_editor == 0 ? 'unread' : '' }}" style="color: var(--blue)">{{ $essay->status->status_title }}</td>
                                        </tr>
                                        @endforeach
                                        
                                        @unless (count($essays)) 
                                        <tr>
                                            <td colspan="11">No data</td>
                                        </tr>
                                        @endunless
                                    </tbody>
                                </table>
                                {{-- Pagination --}}
                                <div class="d-flex justify-content-center">
                                    {{ $essays->links() }}
>>>>>>> origin/development-v1.0
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
        $('#listduefivedays').DataTable({
            scrollX: true,
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: '{{ route('managing-data-all-due-five-days') }}',
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