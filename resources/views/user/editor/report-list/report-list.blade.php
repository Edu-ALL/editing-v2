@extends('user.editor.utama.utama')
@section('css')
    <link rel="stylesheet" href="/css/editor/report-list-completed.css">
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
                            <div class="headline d-flex justify-content-between" style="padding: 24px !important">
                                <div class="col d-flex align-items-center gap-md-3 gap-2">
                                    <img src="/assets/report.png" alt="">
                                    <h6>Report List</h6>
                                </div>
                            </div>
                            <div class="col-12 search-essay">
                                <form action="{{ route('report-list') }}" id="export-submit" method="GET"
                                    class="col d-flex flex-column align-items-center justify-content-center p-0 mt-3 mb-2">
                                    @csrf
                                    <div class="col-md-8 col-10 d-flex py-md-3 py-2">
                                        <div class="col">
                                            <h6 class="pb-2">Editor Name</h6>
                                            <select class="select-normal" style="width: 96.5%;" name="f-editor-name">
                                                {{-- <option value="all">All Editors</option>
                                                @foreach ($editors as $editor)
                                                    <option value="{{ $editor->email }}">
                                                        {{ $editor->first_name . ' ' . $editor->last_name }}</option>
                                                @endforeach --}}

                                                <option value="all" {{ $request->get('f-editor-name') == 'all' ? 'selected' : null }}>All Editors</option>
                                                @foreach ($editors as $editor)
                                                    <option value="{{ $editor->email }}" {{ $request->get('f-editor-name') == $editor->email ? "selected" : null }}>{{ $editor->first_name.' '.$editor->last_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-10 d-flex py-md-3 py-2">
                                        <div class="col-6">
                                            <h6 class="pb-2">Month</h6>
                                            <select class="select-date inputField" name="f-month">
                                                <option value="01" {{ $request->get('f-month') == '01' ? 'selected' : null }}>January</option>
                                                <option value="02" {{ $request->get('f-month') == '02' ? 'selected' : null }}>February</option>
                                                <option value="03" {{ $request->get('f-month') == '03' ? 'selected' : null }}>March</option>
                                                <option value="04" {{ $request->get('f-month') == '04' ? 'selected' : null }}>April</option>
                                                <option value="05" {{ $request->get('f-month') == '05' ? 'selected' : null }}>May</option>
                                                <option value="06" {{ $request->get('f-month') == '06' ? 'selected' : null }}>June</option>
                                                <option value="07" {{ $request->get('f-month') == '07' ? 'selected' : null }}>July</option>
                                                <option value="08" {{ $request->get('f-month') == '08' ? 'selected' : null }}>August</option>
                                                <option value="09" {{ $request->get('f-month') == '09' ? 'selected' : null }}>September</option>
                                                <option value="10" {{ $request->get('f-month') == '10' ? 'selected' : null }}>October</option>
                                                <option value="11" {{ $request->get('f-month') == '11' ? 'selected' : null }}>November</option>
                                                <option value="12" {{ $request->get('f-month') == '12' ? 'selected' : null }}>December</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <h6 class="pb-2">Year</h6>
                                            <select class="select-date inputField" name="f-year">
                                                {{-- @for ($i = date('Y'); $i >= 2016; $i--)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor --}}

                                                @for ($i = date('Y') ; $i >= 2016  ; $i--)
                                                    <option value="{{ $i }}" {{ $request->get('f-year') == $i ? 'selected' : null }}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-10 d-flex py-md-3 py-2">
                                        <div class="col-8">
                                            <h6 class="pb-2">Essay Type</h6>
                                            <select class="select-normal" style="width: 94.5%;" name="f-essay-type">
                                                {{-- <option value="all">All Essay Type</option>
                                                @for ($i = 0; $i < count($essay_type); $i++)
                                                    <option value="{{ $essay_type[$i] }}">{{ $essay_type[$i] }}</option>
                                                @endfor --}}

                                                <option value="all" {{ $request->get('f-essay-type') == 'all' ? 'selected' : null }}>All Essay Type</option>
                                                @for ($i = 0 ; $i < count($essay_type) ; $i++)
                                                    <option value="{{ $essay_type[$i] }}"
                                                    {{ $request->get('f-essay-type') == $essay_type[$i] ? 'selected' : null }}
                                                    >{{ $essay_type[$i] }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <h6 class="pb-2">Status</h6>
                                            <select class="select-normal" style="width: 90%;" name="f-status">
                                                {{-- <option value="all">All Status</option>
                                                @foreach ($status as $_status)
                                                    <option value="{{ $_status->id }}">{{ $_status->status_title }}
                                                    </option>
                                                @endforeach --}}

                                                <option value="all" {{ $request->get('f-status') == null || $request->get('f-status') == "all" ? 'selected' : null }}>All Status</option>
                                                @foreach ($status as $_status)
                                                    <option value="{{ $_status->id }}" 
                                                    {{ $request->get('f-status') != null && $request->get('f-status') != "all" && $request->get('f-status') == $_status->id ? 'selected' : null }}>{{ $_status->status_title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-center py-md-3 py-2">
                                        <button type="submit" class="btn btn-search d-flex align-items-center gap-2">
                                            <img src="/assets/search.png" alt="">
                                            <h6>Search</h6>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <section id="search-result" @if (!$results) class="d-none" @endif>

                                <div class="headline d-flex align-items-center justify-content-between" style="padding: 28px !important">
                                    <div class="col-md-5 col-6">
                                        <h6>Results</h6>
                                    </div>
                                    
                                </div>
                                <div class="container text-center p-0" style="overflow-x: auto !important">
                                    <table class="table table-bordered" id="table-result">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Students Name</th>
                                                <th>Editors Name</th>
                                                <th>Program Name</th>
                                                <th>University</th>
                                                <th>Essay Title</th>
                                                <th>Editors Files</th>
                                                <th>Students Files</th>
                                                <th>Status</th>
                                                <th>Essay Rating</th>
                                                <th>Work Duration (Minutes)</th>
                                                <th>Application Date</th>
                                                <th>Completed Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($results)
                                                <?php $i = ($results->currentpage() - 1) * $results->perpage() + 1; ?>
                                                @foreach ($results as $result)
                                                    <tr style="cursor: default">
                                                        <td>{{ $i++ }}</td>
                                                        <td>
                                                            @if ($result->essay_clients->client_by_id == null)
                                                                {{ $result->essay_clients->client_by_email->first_name . ' ' . $result->essay_clients->client_by_email->last_name }}
                                                            @else
                                                                {{ $result->essay_clients->client_by_id->first_name . ' ' . $result->essay_clients->client_by_id->last_name }}
                                                            @endif
                                                        </td>
                                                        <td>{{ $result->editor->first_name . ' ' . $result->editor->last_name }}
                                                        </td>
                                                        <td>{{ $result->essay_clients->program->program_name }}</td>
                                                        <td>{{ $result->essay_clients->university->university_name }}</td>
                                                        <td>{{ $result->essay_clients->essay_title }}</td>

                                                        @if ($result->status->id == 8)
                                                        <td><a href="{{ asset('uploaded_files/program/essay/revised/'.$result->attached_of_editors) }}" rel="noopener" target="_blank" title="{{ $result->attached_of_editors }}">Download</a>
                                                        </td>
                                                        @else
                                                        <td><a href="{{ asset('uploaded_files/program/essay/editors/'.$result->attached_of_editors) }}" rel="noopener" target="_blank" title="{{ $result->attached_of_editors }}">Download</a>
                                                        </td>
                                                        @endif

                                                        <td><a href="{{ asset('uploaded_files/program/essay/students/'.$result->essay_clients->attached_of_clients) }}" rel="noopener" target="_blank" title="{{ $result->essay_clients->attached_of_clients }}">Download</a>
                                                        </td>

                                                        @if ($result->status->id == 7)
                                                        <td style="color: var(--green)">{{ $result->status->status_title }}</td>
                                                        @else
                                                        <td style="color: var(--red)">{{ $result->status->status_title }}</td>
                                                        @endif

                                                        <td>{{ $result->essay_clients->essay_rating }}</td>
                                                        <td>{{ $result->work_duration }}</td>
                                                        <td>{{ $result->essay_clients->application_deadline }}</td>
                                                        <td>{{ $result->essay_clients->completed_at }}</td>
                                                    </tr>
                                                @endforeach

                                                @unless(count($results))
                                                    <tr>
                                                        <td colspan="13">No data</td>
                                                    </tr>
                                                @endunless
                                            @endif
                                        </tbody>
                                    </table>
                                    @if ($results)
                                        {{-- Pagination --}}
                                        <div class="d-flex justify-content-center">
                                            {{ $results->links() }}
                                        </div>
                                    @endif
                                </div>
                            </section>
                        </div>
                    </div>
                    {{-- End Table Student --}}
                </div>
            </div>
            {{-- End Content --}}
        </div>
    </div>
@endsection
