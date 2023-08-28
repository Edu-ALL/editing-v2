@extends('user.editor.utama.utama')
@section('css')
    <style>
        .unread {
            font-weight: 600
        }
        .pagination { margin: 15px 0}
        .pagination .page-item .page-link { padding: 10px 15px; font-size: 12px; }
    </style>
@endsection
@section('content')
    <div class="container-fluid p-0">
        <div class="row flex-nowrap main">
            @include('user.editor.utama.menu')

            {{-- Content --}}
            <div class="col">
                @include('user.editor.utama.head')
                <div class="container main-content m-0">
                    {{-- Table Student --}}
                    <div class="row">
                        <div class="col-md col-12 p-0 studentList">
                            <div class="headline d-flex justify-content-between">
                                <div class="col-md-6 col-5 d-flex align-items-center gap-md-3 gap-2">
                                    <img src="/assets/essay-list.png" alt="">
                                    <h6>Due Within 5 Days List</h6>
                                </div>
                                <div class="col-md-4 col-6 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                                    {{-- <img src="/assets/reload.png" alt=""> --}}
                                    <div class="input-group">
                                        <form id="editor-list-due-within-five" action="{{ route('editor-list-due-within-five') }}" method="GET" role="search" class="w-100">
                                            <input type="search" class="form-control inputField py-2 px-3" name="keyword" placeholder="Search">
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
                                        <?php $i = ($essays->currentpage()-1)* $essays->perpage() + 1;?>
                                        @foreach ($essays as $essay)
                                        <tr onclick="window.location='/editor/essay-list/ongoing/detail/{{ $essay->id_essay_clients }}'">
                                            <th scope="row" class="{{ $essay->read == 0 ? 'unread' : '' }}">{{ $i++ }}</th>

                                            <td class="{{ $essay->read == 0 ? 'unread' : '' }}">{{ $essay->essay_clients->client_by_id->first_name.' '.$essay->essay_clients->client_by_id->last_name }}</td>
                                            <td class="{{ $essay->read == 0 ? 'unread' : '' }}">{{ $essay->essay_clients->client_by_id->mentors->first_name.' '.$essay->essay_clients->client_by_id->mentors->last_name  }}</td>
                                            <td class="{{ $essay->read == 0 ? 'unread' : '' }}">
                                                @if ($essay->essay_editors->editor != null)
                                                    {{ $essay->essay_editors->editor->first_name.' '.$essay->essay_editors->editor->last_name }}
                                                @elseif ($essay->status_essay_clients == 0 || $essay->editor == null)
                                                    -
                                                @endif
                                            </td>
                                            <td class="{{ $essay->read == 0 ? 'unread' : '' }}">{{ $essay->editor ? $essay->editor->first_name.' '.$essay->editor->last_name : '-' }}</td>
                                            <td class="{{ $essay->read == 0 ? 'unread' : '' }}">{{ $essay->essay_clients->program->program_name.' ('.$essay->essay_clients->program->minimum_word.' - '.$essay->essay_clients->program->maximum_word.' Words)' }}</td>
                                            <td class="{{ $essay->read == 0 ? 'unread' : '' }}">{{ $essay->essay_clients->essay_title }}</td>
                                            <td class="{{ $essay->read == 0 ? 'unread' : '' }}">{{ date('D, d M Y', strtotime($essay->essay_clients->uploaded_at)) }}</td>
                                            <td class="{{ $essay->read == 0 ? 'unread' : '' }}">{{ date('D, d M Y', strtotime($essay->essay_clients->essay_deadline)) }}</td>
                                            <td class="{{ $essay->read == 0 ? 'unread' : '' }}">{{ date('D, d M Y', strtotime($essay->essay_clients->application_deadline)) }}</td>
                                            <td class="{{ $essay->read == 0 ? 'unread' : '' }}" style="color: var(--blue)">{{ $essay->essay_clients->status->status_title }}</td>
                                        </tr>
                                        @endforeach
                                        
                                        @unless (count($essays)) 
                                        <tr>
                                            <td colspan="11">No data</td>
                                        </tr>
                                        @endunless
                                        {{-- <tr onclick="location.href='/editor/list/detail'">
                                            <th scope="row">1</th>
                                            <td>Student Name Dummy</td>
                                            <td>Mentor Name Dummy</td>
                                            <td>Editor Name Dummy</td>
                                            <td>Request</td>
                                            <td>Program name</td>
                                            <td>Title of Essay</td>
                                            <td>01-08-2022</td>
                                            <td>01-09-2022</td>
                                            <td>01-10-2022</td>
                                            <td><span class="badge badge-success">Success</span>
                                            </td>
                                        </tr> --}}
                                    </tbody>
                                </table>
                                {{-- Pagination --}}
                                <div class="d-flex justify-content-center">
                                    {{ $essays->links() }}
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
