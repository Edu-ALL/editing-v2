@extends('user.editor.utama.utama')
@section('css')
    <style>
        .unread {
            font-weight: 600
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row flex-nowrap main">
            @include('user.editor.utama.menu')

            {{-- Content --}}
            <div class="col">
                <div class="row head py-4 align-items-center">
                    <div class="col-md-6 col-10 ps-md-5 ps-3">
                        <h4 class="">Editor Dashboard</h4>
                    </div>
                    <div class="col-md-6 col-2 pe-md-5 pe-3">
                        <div class="head-content d-flex flex-row align-items-center justify-content-end gap-md-4 gap-2">
                            <a class="help d-flex flex-row align-items-center gap-md-2 gap-1" href="">
                                <img class="img-fluid" src="/assets/help-grey.png" alt="">
                                <h6 class="d-none d-md-inline">Help</h6>
                            </a>
                            <a href="">
                                <h6 class="pt-1 d-none d-md-inline">Editor Name</h6>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="container main-content m-0">
                    {{-- Table Student --}}
                    <div class="row">
                        <div class="col-md col-12 p-0 studentList">
                            <div class="headline d-flex justify-content-between">
                                <div class="col-md-6 col-5 d-flex align-items-center gap-md-3 gap-2">
                                    <img src="/assets/all-essay.png" alt="">
                                    <h6>All Essays - Due Tomorrow List</h6>
                                </div>
                                <div class="col-md-4 col-6 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                                    <div class="input-group">
                                        <form id="editor-list-due-tomorrow" action="{{ route('editor-list-due-tomorrow') }}" method="GET" role="search" class="w-100">
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
                                        <tr onclick="window.location='/editor/all-essays/essay-list-due-detail/{{ $essay->id_essay_clients }}'">
                                            <th scope="row" class="{{ $essay->status_read_editor == 0 ? 'unread' : '' }}">{{ $i++ }}</th>

                                            <td class="{{ $essay->status_read_editor == 0 ? 'unread' : '' }}">{{ $essay->client_by_id->first_name.' '.$essay->client_by_id->last_name }}</td>
                                            <td class="{{ $essay->status_read_editor == 0 ? 'unread' : '' }}">{{ $essay->client_by_id->mentors->first_name.' '.$essay->client_by_id->mentors->last_name  }}</td>
                                            <td class="{{ $essay->status_read_editor == 0 ? 'unread' : '' }}">{{ $essay->status_essay_clients == 0 ? '-' : $essay->editor->first_name.' '.$essay->editor->last_name }}</td>
                                            <td class="{{ $essay->status_read_editor == 0 ? 'unread' : '' }}">{{ $essay->editor->first_name.' '.$essay->editor->last_name }}</td>
                                            <td class="{{ $essay->status_read_editor == 0 ? 'unread' : '' }}">{{ $essay->program->program_name }}</td>
                                            <td class="{{ $essay->status_read_editor == 0 ? 'unread' : '' }}">{{ $essay->essay_title }}</td>
                                            <td class="{{ $essay->status_read_editor == 0 ? 'unread' : '' }}">{{ date('D, d M Y', strtotime($essay->uploaded_at)) }}</td>
                                            <td class="{{ $essay->status_read_editor == 0 ? 'unread' : '' }}">{{ date('D, d M Y', strtotime($essay->essay_deadline)) }}</td>
                                            <td class="{{ $essay->status_read_editor == 0 ? 'unread' : '' }}">{{ date('D, d M Y', strtotime($essay->application_deadline)) }}</td>
                                            <td class="{{ $essay->status_read_editor == 0 ? 'unread' : '' }}" style="color: var(--green)">{{ $essay->status->status_title }}</td>
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
