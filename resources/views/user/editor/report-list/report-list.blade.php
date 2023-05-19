@extends('user.editor.utama.utama')
@section('css')
    <link rel="stylesheet" href="/css/editor/report-list-completed.css">
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
                                <div class="container text-start px-0 py-2">
                                    <table class="table" id="listreport" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Students Name</th>
                                                <th>Editors Name</th>
                                                <th>Program Name</th>
                                                {{-- <th>University</th> --}}
                                                <th>Essay Title</th>
                                                <th>Editors Files</th>
                                                <th>Students Files</th>
                                                <th>Status</th>
                                                <th>Essay Rating</th>
                                                <th>Work Duration (Minutes)</th>
                                                {{-- <th>Application Date</th> --}}
                                                <th>Completed Date</th>
                                            </tr>
                                        </thead>
                                    </table>
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
@section('js')
<script>
    // List Report
    $(document).ready(function () {
        $('#listreport').DataTable({
            scrollX: true,
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: '{{ route('report-list-data') }}' + window.location.search,
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
                    data: 'editor_name',
                    name: 'editor_name'
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
                    data: 'editor_file',
                    name: 'editor_file'
                },
                {
                    data: 'student_file',
                    name: 'student_file'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'essay_rating',
                    name: 'essay_rating',
                    class: 'text-center'
                },
                {
                    data: 'work_duration',
                    name: 'work_duration',
                    class: 'text-center'
                },
                {
                    data: 'completed_date',
                    name: 'completed_date'
                }
            ]
        });
    });
</script>
@endsection