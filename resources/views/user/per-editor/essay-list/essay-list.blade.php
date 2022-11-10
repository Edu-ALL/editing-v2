@extends('user.per-editor.utama.utama')
@section('css')
    <style>
        .pagination {
            margin: 15px 0
        }

        .pagination .page-item .page-link {
            padding: 10px 15px;
            font-size: 12px;
        }

        .unread {
            font-weight: 600
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row flex-nowrap main" id="main">

            {{-- Sidenav --}}
            @include('user.per-editor.utama.menu')

            {{-- Content --}}
            <div class="col" style="overflow-x: auto !important">
                @include('user.per-editor.utama.head')
                <div class="container main-content m-0">
                    <div class="row flex-column gap-4">
                        <div class="col p-0">
                            <div class="col-md col-12 p-0 userCard">
                                <div class="headline d-flex align-items-center px-md-4 px-3 py-3 gap-md-3 gap-1">
                                    <div class="col-md col-7 d-flex align-items-center gap-md-3 gap-2">
                                        <img src="/assets/ongoing-essay.png" alt="">
                                        <h6>List of Ongoing Essay</h6>
                                    </div>
                                    <div class="col-md-4 col d-flex align-items-center justify-content-end">
                                        <div class="input-group">
                                            <form id="form-ongoing-essay-searching" action="{{ route('list-essay') }}"
                                                method="GET" role="search" class="w-100">
                                                <input type="search" class="form-control inputField py-2 px-3"
                                                    name="keyword-ongoing" placeholder="Search">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="container text-center p-0" style="overflow-x: auto !important">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Student Name</th>
                                                <th>Mentor Name</th>
                                                <th>Editor Name</th>
                                                <th>Program Name</th>
                                                <th>Essay Title</th>
                                                <th>Upload Date</th>
                                                <th>Essay Deadline</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = ($ongoing_essay->currentpage() - 1) * $ongoing_essay->perpage() + 1; ?>
                                            @foreach ($ongoing_essay as $essay)
                                                <tr
                                                    onclick="window.location='/editors/essay-list/ongoing/detail/{{ $essay->id_essay_clients }}'">
                                                    <th scope="row" class="{{ $essay->read == 0 ? 'unread' : '' }}">
                                                        {{ $i++ }}</th>
                                                    <td class="{{ $essay->read == 0 ? 'unread' : '' }}">
                                                        {{ $essay->essay_clients->client_by_id->first_name . ' ' . $essay->essay_clients->client_by_id->last_name }}
                                                    </td>
                                                    <td class="{{ $essay->read == 0 ? 'unread' : '' }}">
                                                        {{ $essay->essay_clients->client_by_id->mentors->first_name . ' ' . $essay->essay_clients->client_by_id->mentors->last_name }}
                                                    </td>
                                                    <td class="{{ $essay->read == 0 ? 'unread' : '' }}">
                                                        {{ $essay->editor ? $essay->editor->first_name . ' ' . $essay->editor->last_name : '-' }}
                                                    </td>
                                                    <td class="{{ $essay->read == 0 ? 'unread' : '' }}">
                                                        {{ $essay->essay_clients->program->program_name }}</td>
                                                    <td class="{{ $essay->read == 0 ? 'unread' : '' }}">
                                                        {{ $essay->essay_clients->essay_title }}</td>
                                                    <td class="{{ $essay->read == 0 ? 'unread' : '' }}">
                                                        {{ date('D, d M Y', strtotime($essay->essay_clients->uploaded_at)) }}
                                                    </td>
                                                    <td class="{{ $essay->read == 0 ? 'unread' : '' }}">
                                                        {{ date('D, d M Y', strtotime($essay->essay_clients->essay_deadline)) }}
                                                    </td>
                                                    <td class="{{ $essay->read == 0 ? 'unread' : '' }}"
                                                        style="color: var(--green)">{{ $essay->status->status_title }}</td>
                                                </tr>
                                            @endforeach

                                            @unless(count($ongoing_essay))
                                                <tr style="cursor: default">
                                                    <td colspan="9">No data</td>
                                                </tr>
                                            @endunless
                                        </tbody>
                                    </table>
                                    {{-- Pagination --}}
                                    <div class="d-flex justify-content-center">
                                        {{ $ongoing_essay->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col p-0">
                            <div class="col-md col-12 p-0 userCard">
                                <div class="headline d-flex align-items-center px-md-4 px-3 py-3 gap-md-3 gap-1"
                                    style="background-color: var(--green);">
                                    <div class="col-md col-7 d-flex align-items-center gap-md-3 gap-2">
                                        <img src="/assets/completed-essay.png" alt="">
                                        <h6>List of Completed Essay</h6>
                                    </div>
                                    <div class="col-md-4 col d-flex align-items-center justify-content-end">
                                        <div class="input-group">
                                            <form id="form-completed-essay-searching" action="" method="GET"
                                                role="search" class="w-100">
                                                <input type="search" class="form-control inputField py-2 px-3"
                                                    name="keyword-completed" placeholder="Search">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="container text-center p-0" style="overflow-x: auto !important">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Student Name</th>
                                                <th>Mentor Name</th>
                                                <th>Editor Name</th>
                                                <th>Program Name</th>
                                                <th>Essay Title</th>
                                                <th>Upload Date</th>
                                                <th>Essay Deadline</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = ($completed_essay->currentpage() - 1) * $completed_essay->perpage() + 1; ?>
                                            @foreach ($completed_essay as $essay)
                                                <tr
                                                    onclick="window.location='/editors/essay-list/completed/detail/{{ $essay->id_essay_clients }}'">
                                                    <th scope="row" class="{{ $essay->read == 0 ? 'unread' : '' }}">
                                                        {{ $i++ }}</th>
                                                    <td class="{{ $essay->read == 0 ? 'unread' : '' }}">
                                                        {{ $essay->essay_clients->client_by_id->first_name . ' ' . $essay->essay_clients->client_by_id->last_name }}
                                                    </td>
                                                    <td class="{{ $essay->read == 0 ? 'unread' : '' }}">
                                                        {{ $essay->essay_clients->client_by_id->mentors->first_name . ' ' . $essay->essay_clients->client_by_id->mentors->last_name }}
                                                    </td>
                                                    <td class="{{ $essay->read == 0 ? 'unread' : '' }}">
                                                        {{ $essay->editor ? $essay->editor->first_name . ' ' . $essay->editor->last_name : '-' }}
                                                    </td>
                                                    <td class="{{ $essay->read == 0 ? 'unread' : '' }}">
                                                        {{ $essay->essay_clients->program->program_name }}</td>
                                                    <td class="{{ $essay->read == 0 ? 'unread' : '' }}">
                                                        {{ $essay->essay_clients->essay_title }}</td>
                                                    <td class="{{ $essay->read == 0 ? 'unread' : '' }}">
                                                        {{ date('D, d M Y', strtotime($essay->essay_clients->uploaded_at)) }}
                                                    </td>
                                                    <td class="{{ $essay->read == 0 ? 'unread' : '' }}">
                                                        {{ date('D, d M Y', strtotime($essay->essay_clients->essay_deadline)) }}
                                                    </td>
                                                    <td class="{{ $essay->read == 0 ? 'unread' : '' }}"
                                                        style="color: var(--green)">{{ $essay->status->status_title }}</td>
                                                </tr>
                                            @endforeach

                                            @unless(count($completed_essay))
                                                <tr style="cursor: default">
                                                    <td colspan="9">No data</td>
                                                </tr>
                                            @endunless
                                        </tbody>
                                    </table>
                                    {{-- Pagination --}}
                                    <div class="d-flex justify-content-center">
                                        {{ $completed_essay->links() }}
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

    {{-- Modal Info --}}
    @if (session()->has('isEssay'))
    <div class="modal fade" id="info-essay" tabindex="-1" show>
        <div class="modal-dialog d-flex align-items-center justify-content-center">
        <div class="modal-content border-0 w-75">
            <div class="modal-header" style="background-color: var(--red)">
                <div class="col d-flex gap-1 align-items-center">
                    <img src="/assets/info.png" alt="">
                    <h6 class="modal-title ms-3">Alert</h6>
                </div>
                <div type="button" data-bs-dismiss="modal" aria-label="Close">
                    <img src="/assets/close.png" alt="" style="height: 26px">
                </div>
            </div>
            <div class="modal-body text-center px-4 py-4 my-md-3">
                <p>{{ session()->get('isEssay') }}  <span style="color: var(--red)">*</span></p>
            </div>
        </div>
        </div>
    </div>
    @endif
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
        $("#form-completed-essay-searching").keypress(function(e) {
            if (e.keyCode === 13) {
                swal.showLoading();
                e.preventDefault();
                $("#form-completed-essay-searching").submit();
            }
        });
        $(document).ready(function(){
            $("#info-essay").modal('show');
        });
    </script>
@stop
