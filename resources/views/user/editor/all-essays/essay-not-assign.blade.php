@extends('user.editor.utama.utama')
@section('css')
    <link rel="stylesheet" href="/css/editor/essay-completed.css">
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
            @include('user.editor.utama.menu')

            {{-- Content --}}
            <div class="col" style="overflow: auto !important">
                @include('user.editor.utama.head')
                <div class="container main-content m-0">
                    {{-- Table Student --}}
                    <div class="row">
                        <div class="col-md col-12 p-0 studentList">
                            <div class="headline d-flex justify-content-between" style="background-color: var(--blue)">
                                <div class="col-md-6 col-7 d-flex align-items-center gap-md-3 gap-2">
                                    <img src="/assets/ongoing-essay.png" alt="">
                                    <h6>List of Not Assign Essay</h6>
                                </div>
                                <div class="col-md-4 col-4 d-flex align-items-center justify-content-end">
                                    <div class="input-group">
                                        <form id="form-ongoing-essay-searching"
                                            action="{{ route('editor-list-not-assign-essay') }}" method="GET"
                                            role="search" class="w-100">
                                            <input type="text" class="form-control inputField py-2 px-3" name="keyword"
                                                placeholder="Search">
                                        </form>
                                    </div>
                                </div>
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
                                        <?php $i = ($essays->currentpage() - 1) * $essays->perpage() + 1; ?>
                                        @foreach ($essays as $essay)
                                            <tr
                                                onclick="window.location='/editor/all-essays/ongoing/detail/{{ $essay->id_essay_clients }}'">
                                                <th scope="row">{{ $i++ }}</th>

                                                <td>{{ $essay->client_by_id->first_name . ' ' . $essay->client_by_id->last_name }}
                                                </td>
                                                <td>{{ $essay->client_by_id->mentors->first_name . ' ' . $essay->client_by_id->mentors->last_name }}
                                                </td>

                                                <td>{{ $essay->status_essay_clients == 0 || $essay->status_essay_clients == 4 ? '-' : $essay->editor->first_name . ' ' . $essay->editor->last_name }}
                                                </td>
                                                <td>{{ $essay->editor ? $essay->editor->first_name . ' ' . $essay->editor->last_name : '-' }}
                                                </td>
                                                <td>{{ $essay->program->program_name . ' (' . $essay->program->minimum_word . ' - ' . $essay->program->maximum_word . ' Words)' }}
                                                </td>
                                                <td>{{ $essay->essay_title }}</td>
                                                <td>{{ date('D, d M Y', strtotime($essay->uploaded_at)) }}</td>
                                                <td>{{ date('D, d M Y', strtotime($essay->essay_deadline)) }}</td>
                                                <td>{{ date('D, d M Y', strtotime($essay->application_deadline)) }}</td>
                                                <td style="color: var(--blue)">{{ $essay->status->status_title }}</td>
                                            </tr>
                                        @endforeach

                                        @unless(count($essays))
                                            <tr>
                                                <td colspan="11">No data</td>
                                            </tr>
                                        @endunless
                                    </tbody>
                                </table>
                                {{-- Pagination --}}
                                <div class="d-flex justify-content-center">
                                    {{ $essays->links() }}
                                </div>
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
    <script type="text/javascript">
        $("#form-ongoing-essay-searching").keypress(function(e) {
            if (e.keyCode === 13) {
                swal.showLoading();
                e.preventDefault();
                $("#form-ongoing-essay-searching").submit();
            }
        });
    </script>
@stop
