@extends('user.editor.utama.utama')
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
                                <h6 class="pt-1 d-none d-md-inline">Mentor Name</h6>
                            </a>
                        </div>
                    </div>
                </div>
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
                                                    <th scope="row"
                                                        class="{{ $essay->essay_editors->read == 0 ? 'unread' : '' }}">
                                                        {{ $i++ }}</th>
                                                    <td class="{{ $essay->essay_editors->read == 0 ? 'unread' : '' }}">
                                                        {{ $essay->client_by_id->first_name . ' ' . $essay->client_by_id->last_name }}
                                                    </td>
                                                    <td class="{{ $essay->essay_editors->read == 0 ? 'unread' : '' }}">
                                                        {{ $essay->client_by_id->mentors->first_name . ' ' . $essay->client_by_id->mentors->last_name }}
                                                    </td>
                                                    <td class="{{ $essay->essay_editors->read == 0 ? 'unread' : '' }}">
                                                        {{ $essay->editor ? $essay->editor->first_name . ' ' . $essay->editor->last_name : '-' }}
                                                    </td>
                                                    <td class="{{ $essay->essay_editors->read == 0 ? 'unread' : '' }}">
                                                        {{ $essay->program->program_name }}</td>
                                                    <td class="{{ $essay->essay_editors->read == 0 ? 'unread' : '' }}">
                                                        {{ $essay->essay_title }}</td>
                                                    <td class="{{ $essay->essay_editors->read == 0 ? 'unread' : '' }}">
                                                        {{ date('D, d M Y', strtotime($essay->uploaded_at)) }}</td>
                                                    <td class="{{ $essay->essay_editors->read == 0 ? 'unread' : '' }}">
                                                        {{ date('D, d M Y', strtotime($essay->essay_deadline)) }}</td>
                                                    <td class="{{ $essay->essay_editors->read == 0 ? 'unread' : '' }}"
                                                        style="color: var(--red)">{{ $essay->status->status_title }}</td>
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
        </div>
    @endsection
