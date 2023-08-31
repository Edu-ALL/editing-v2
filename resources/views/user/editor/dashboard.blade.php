@extends('user.editor.utama.utama')
@section('css')
    <link rel="stylesheet" href="/css/editor/dashboard.css">
    <style>
        .alert {
            font-size: 14px;
            margin: 0 -12px 16px -12px
        }

        .dataTables_scroll .dataTables_scrollHeadInner {
            width: auto !important;
            padding-right: 0 !important;
        }

        .dataTables_scroll .dataTables_scrollHeadInner .table.dataTable.no-footer {
            width: 100% !important;
        }

        .dataTables_scroll .dataTables_scrollBody .table.dataTable.no-footer {
            width: 100% !important;
        }

        .card {
            border: none;
            border-radius: 6px;
            box-shadow: 0px 2px 10px rgba(58, 53, 65, 0.1);
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid p-0">
        <div class="row flex-nowrap main" id="main">

            {{-- Sidenav --}}
            @include('user.editor.utama.menu')

            {{-- Content --}}
            <div class="col" style="overflow: auto !important">
                @include('user.editor.utama.head')
                <div class="container main-content m-0">
                    @if (session()->has('login-successful'))
                        <div class="row alert alert-success fade show d-flex justify-content-between" role="alert">
                            {{ session()->get('login-successful') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="row justify-content-between">
                        @if($assigned->count()>0)
                        <div class="col-md-6 px-3 m-0">
                            <div class="alert alert-danger d-flex justify-content-between align-items-center" role="alert"
                                style="font-size: 14px;">
                                <label>
                                    There {{ $assigned->count() == 1 ? 'is' : 'are' }}
                                    <strong>{{ $assigned->count() }}</strong> Essay Editor who have not accepted/rejected
                                    essays.
                                </label>
                                <div class="dropstart">
                                    <button class="btn btn-danger btn-sm dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-info-circle"></i>
                                    </button>
                                    <div class="dropdown-menu overflow-auto p-3 pb-0"
                                        style="width: 550px; max-height:400px; font-size:13px;">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>No</th>
                                                    <th>Editor Name</th>
                                                    <th>Mentor Name</th>
                                                    <th>Essay Title</th>
                                                    <th>Essay Deadline</th>
                                                    <th>Uploaded Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($assigned as $item)
                                                    <tr class="text-center" onclick="window.open('{{url('editor/all-essays/ongoing/detail/').'/'.$item->id_essay_clients}}');">
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>
                                                            {{ $item->editor->first_name . ' ' . $item->editor->last_name }}
                                                        </td>
                                                        <td>
                                                            {{ $item->essay_clients->mentor->first_name . ' ' . $item->essay_clients->mentor->last_name }}
                                                        </td>
                                                        <td>{{ $item->essay_clients->essay_title }}</td>
                                                        <td>{{ date('D, d F Y', strtotime($item->essay_clients->essay_deadline)) }}</td>
                                                        <td>{{ date('D, d F Y', strtotime($item->uploaded_at)) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($submited->count()>0)
                        <div class="col-md-6 px-3 m-0">
                            <div class="alert alert-danger d-flex justify-content-between align-items-center" role="alert"
                                style="font-size: 14px;">
                                <label>
                                    There {{ $submited->count() == 1 ? 'is' : 'are' }}
                                    <strong>{{ $submited->count() }}</strong> essay that you need to review.
                                </label>
                                <div class="dropstart">
                                    <button class="btn btn-danger btn-sm dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-info-circle"></i>
                                    </button>
                                    <div class="dropdown-menu overflow-auto p-3 pb-0"
                                        style="width: 550px; max-height:400px; font-size:13px;">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>No</th>
                                                    <th>Editor Name</th>
                                                    <th>Mentor Name</th>
                                                    <th>Essay Title</th>
                                                    <th>Essay Deadline</th>
                                                    <th>Uploaded Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($submited as $item)
                                                    <tr class="text-center" onclick="window.open('{{url('editor/all-essays/ongoing/detail/').'/'.$item->id_essay_clients}}');">
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>
                                                            {{ $item->editor->first_name . ' ' . $item->editor->last_name }}
                                                        </td>
                                                        <td>
                                                            {{ $item->essay_clients->mentor->first_name . ' ' . $item->essay_clients->mentor->last_name }}
                                                        </td>
                                                        <td>{{ $item->essay_clients->essay_title }}</td>
                                                        <td>{{ date('D, d F Y', strtotime($item->essay_clients->essay_deadline)) }}</td>
                                                        <td>{{ date('D, d F Y', strtotime($item->uploaded_at)) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div>
                        <div class="row gap-2">
                            <div class="col-md-5 col-12 mb-0">
                                {{-- User List --}}
                                <div class="row gap-2">
                                    {{-- <a class="col-md col-12 p-0 userCard" href="/admin/user/student">
                                        <div class="headline text-center">
                                            <h6>Students</h6>
                                        </div>
                                        <div class="row px-3 countUser align-items-center text-center">
                                            <div class="col">
                                                <img class="img-fluid" src="/assets/student-bg.png" alt=""
                                                    style="object-fit: contain">
                                            </div>
                                            <div class="col">
                                                <h4>{{ $count_student }}</h4>
                                                <h4>Students</h4>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="detailCard ps-3 mt-2">
                                            <h6>See the list of Students</h6>
                                        </div>
                                    </a> --}}
                                    {{-- <a class="col-md col-12 p-0 userCard" href="/admin/user/mentor">
                                        <div class="headline text-center">
                                            <h6>Mentors</h6>
                                        </div>
                                        <div class="row px-3 countUser align-items-center text-center">
                                            <div class="col">
                                                <img class="img-fluid" src="/assets/mentor-bg.png" alt=""
                                                    style="object-fit: contain">
                                            </div>
                                            <div class="col">
                                                <h4>{{ $count_mentor }}</h4>
                                                <h4>Mentors</h4>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="detailCard ps-3 mt-2">
                                            <h6>See the list of Mentors</h6>
                                        </div>
                                    </a> --}}
                                    <a class="col-md col-12 p-0 userCard" href="/editor/list">
                                        <div class="headline text-center">
                                            <h6>Editors</h6>
                                        </div>
                                        <div
                                            class="row px-3 countUser align-items-center justify-content-center text-center">
                                            <div class="col-md-4 col">
                                                <img class="img-fluid" src="/assets/editor-bg.png" alt=""
                                                    style="object-fit: contain">
                                            </div>
                                            <div class="col-md-3 col">
                                                <h4>{{ $count_editor }}</h4>
                                                <h4>Editors</h4>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="detailCard ps-2 py-1 mt-1 mb-2">
                                            <h6>See the list of Editors</h6>
                                        </div>
                                    </a>
                                </div>
                                {{-- End User List --}}

                                {{-- Essay --}}
                                <div class="row gap-2 mt-2">
                                    <a class="col-md col-12 p-0 userCard" href="/editor/all-essays">
                                        <div class="headline d-flex align-items-center gap-3">
                                            <img src="/assets/ongoing-essay.png" alt="">
                                            <h6>Ongoing Essay</h6>
                                        </div>
                                        <div
                                            class="col d-flex flex-column px-3 countEssay text-center justify-content-center gap-1">
                                            <h4>{{ $count_ongoing_essay }}</h4>
                                            <h4>Essay</h4>
                                        </div>
                                        <hr>
                                        <div class="detailCard ps-2 py-1 mt-1 mb-2">
                                            <h6>See the list of Ongoing Essay</h6>
                                        </div>
                                    </a>
                                    <a class="col-md col-12 p-0 userCard" href="/editor/all-essays">
                                        <div class="headline d-flex align-items-center gap-3"
                                            style="background-color: var(--green)">
                                            <img src="/assets/completed-essay.png" alt="">
                                            <h6>Completed Essay</h6>
                                        </div>
                                        <div class="col d-flex flex-column px-3 countEssay text-center justify-content-center gap-1"
                                            style="color: var(--green)">
                                            <h4>{{ $count_completed_essay }}</h4>
                                            <h4>Essay</h4>
                                        </div>
                                        <hr>
                                        <div class="detailCard ps-2 py-1 mt-1 mb-2">
                                            <h6>See the list of Completed Essay</h6>
                                        </div>
                                    </a>
                                </div>
                                {{-- End Essay --}}
                            </div>

                            {{-- Active Editor --}}
                            <div class="col-md col-12">
                                {{-- Table Student --}}
                                <div class="row card h-100">
                                    <div class="col-md col-12 p-0 d-flex flex-column justify-content-between">
                                        <div>
                                            <div class="headline d-flex justify-content-between align-items-center">
                                                <div class="col-md-6 col d-flex align-items-center gap-md-3 gap-2">
                                                    <h6 class="mb-0">Editor Active + Duration</h6>
                                                </div>
                                                <div class="col-md-6 col d-flex align-items-center justify-content-end">
                                                    <div class="input-group">
                                                        <form id="form-dashboard-filter"
                                                            action="{{ route('editor-dashboard') }}" method="GET"
                                                            class="w-100">
                                                            <div class="row g-2">
                                                                <div class="col-md">
                                                                    <div class="form-floating">
                                                                        <select class="form-select" id="floatingSelectGrid"
                                                                            aria-label="Floating label select example"
                                                                            name="active-month">
                                                                            <?php
                                                                            $months = [
                                                                                1 => 'January',
                                                                                2 => 'February',
                                                                                3 => 'March',
                                                                                4 => 'April',
                                                                                5 => 'May',
                                                                                6 => 'June',
                                                                                7 => 'July',
                                                                                8 => 'August',
                                                                                9 => 'September',
                                                                                10 => 'October',
                                                                                11 => 'November',
                                                                                12 => 'December',
                                                                            ];
                                                                            ?>
                                                                            @dump($date['month'])
                                                                            @foreach ($months as $month => $monthName)
                                                                                @if ($month == (int) $date['month'])
                                                                                    <option selected
                                                                                        value="{{ $month }}">
                                                                                        {{ $monthName }}
                                                                                    </option>
                                                                                @else
                                                                                    <option value="{{ $month }}">
                                                                                        {{ $monthName }}
                                                                                    </option>
                                                                                @endif
                                                                            @endforeach
                                                                        </select>
                                                                        <label for="floatingSelectGrid"
                                                                            class="text-dark">Month</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md">
                                                                    <div class="form-floating">
                                                                        <select class="form-select"
                                                                            id="floatingSelectGrid"
                                                                            aria-label="Floating label select example"
                                                                            name="active-year">
                                                                            @for ($year = 2016; $year <= Carbon\Carbon::now()->year; $year++)
                                                                                @if ($year == $date['year'])
                                                                                    <option selected
                                                                                        value="{{ $year }}">
                                                                                        {{ $year }}
                                                                                    </option>
                                                                                @else
                                                                                    <option value="{{ $year }}">
                                                                                        {{ $year }}
                                                                                    </option>
                                                                                @endif
                                                                            @endfor
                                                                        </select>
                                                                        <label for="floatingSelectGrid"
                                                                            class="text-dark">Year</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="container text-start px-3 py-2">
                                                <table class="table" id="listeditoractiveduration">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Editor Name</th>
                                                            <th>Position</th>
                                                            <th>Completed Essay</th>
                                                            <th>Total Duration</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                        <div>
                                            <hr class="my-1" style="color: var(--grey);">
                                            <div
                                                class="detailCard d-flex justify-content-between align-items-center px-3 py-1 mb-2">
                                                <h6 class="m-0">{{ $essay_per_month }} Essay Total (in
                                                    {{ DateTime::createFromFormat('!m', $date['month'])->format('F') }}
                                                    {{ $date['year'] }})</h6>
                                                <h6 class="m-0">{{ $essay_per_month_completed }} Completed</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Table Student --}}
                            </div>
                            {{-- End Active Editor --}}
                        </div>
                        <div class="row gap-2 mt-3">
                            <div class="col-md col-12 p-0 userCard" style="cursor: default">
                                <div class="headline d-flex align-items-center justify-content-center py-md-4 py-3 gap-3">
                                    <img src="/assets/essay-list.png" alt="">
                                    <h6 style="font-weight: 700; font-size: 16px">ALL ESSAYS</h6>
                                </div>
                                <div class="row gap-2 m-3">
                                    <div class="col-lg d-flex flex-column gap-2 p-0">
                                        <a class="col-md col-12 p-0 userCard"
                                            href="/editor/all-essays/essay-list-due-tommorow">
                                            <div class="headline d-flex align-items-center px-4 py-md-4 py-3 gap-3"
                                                style="background-color: var(--red)">
                                                <img src="/assets/warning.png" alt="">
                                                <h6>Due Tomorrow</h6>
                                            </div>
                                            <div class="col d-flex flex-column px-3 py-2 countEssay text-center justify-content-center"
                                                style="color: var(--red)">
                                                <h4>{{ $allduetomorrow->count() }}</h4>
                                                <h4>Essay</h4>
                                            </div>
                                            <hr>
                                            <div class="detailCard ps-2 py-1 mt-1 mb-2">
                                                <h6>See the list of Essay Due Tomorrow</h6>
                                            </div>
                                        </a>
                                        <div class="row gap-2">
                                            <a class="col-md col-12 p-0 userCard"
                                                href="/editor/all-essays/essay-list-due-within-three">
                                                <div class="headline d-flex align-items-center px-4 py-md-4 py-3 gap-3"
                                                    style="background-color: var(--yellow)">
                                                    <img src="/assets/warning.png" alt="">
                                                    <h6>Due Within 3 Days</h6>
                                                </div>
                                                <div class="col d-flex flex-column px-3 py-2 countEssay text-center justify-content-center"
                                                    style="color: var(--yellow)">
                                                    <h4>{{ $allduethree->count() }}</h4>
                                                    <h4>Essay</h4>
                                                </div>
                                                <hr>
                                                <div class="detailCard ps-2 py-1 mt-1 mb-2">
                                                    <h6>See the list of Essay Due Within 3 Days</h6>
                                                </div>
                                            </a>
                                            <a class="col-md col-12 p-0 userCard"
                                                href="/editor/all-essays/essay-list-due-within-five">
                                                <div class="headline d-flex align-items-center px-4 py-md-4 py-3 gap-3">
                                                    <img src="/assets/warning.png" alt="">
                                                    <h6>Due Within 5 Days</h6>
                                                </div>
                                                <div
                                                    class="col d-flex flex-column px-3 py-2 countEssay text-center justify-content-center">
                                                    <h4>{{ $allduefive->count() }}</h4>
                                                    <h4>Essay</h4>
                                                </div>
                                                <hr>
                                                <div class="detailCard ps-2 py-1 mt-1 mb-2">
                                                    <h6>See the list of Essay Due Within 5 Days</h6>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center m-3 userCard">
                                    <div class="col-md-10 col-12 p-0" style="cursor: default">
                                        <canvas class="mt-4 mb-1" id="all-essay-chart" style="width:100%"></canvas>
                                        <div class="text-center mt-4 mb-lg-0 mb-4">
                                            <h6 class="mb-4" style="font-size: 12px; color: var(--black)">
                                                {{ date('D, d M Y') }} | Total Essay :
                                                {{ $ongoing_essay + $completed_essay }}
                                                Essay</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md col-12 p-0 userCard" style="cursor: default">
                                <div class="headline d-flex align-items-center justify-content-center py-md-4 py-3 gap-3">
                                    <img src="/assets/essay-list.png" alt="">
                                    <h6 style="font-weight: 700; font-size: 16px">YOUR ESSAYS</h6>
                                </div>
                                <div class="row gap-2 m-3">
                                    <div class="col-lg d-flex flex-column gap-2 p-0">
                                        <a class="col-md col-12 p-0 userCard" href="/editor/essay-list-due-tomorrow">
                                            <div class="headline d-flex align-items-center px-4 py-md-4 py-3 gap-3"
                                                style="background-color: var(--red)">
                                                <img src="/assets/warning.png" alt="">
                                                <h6>Due Tomorrow</h6>
                                            </div>
                                            <div class="col d-flex flex-column px-3 py-2 countEssay text-center justify-content-center"
                                                style="color: var(--red)">
                                                <h4>{{ $duetomorrow->count() }}</h4>
                                                <h4>Essay</h4>
                                            </div>
                                            <hr>
                                            <div class="detailCard ps-2 py-1 mt-1 mb-2">
                                                <h6>See the list of Essay Due Tomorrow</h6>
                                            </div>
                                        </a>
                                        <div class="row gap-2">
                                            <a class="col-md col-12 p-0 userCard"
                                                href="/editor/essay-list-due-within-three">
                                                <div class="headline d-flex align-items-center px-4 py-md-4 py-3 gap-3"
                                                    style="background-color: var(--yellow)">
                                                    <img src="/assets/warning.png" alt="">
                                                    <h6>Due Within 3 Days</h6>
                                                </div>
                                                <div class="col d-flex flex-column px-3 py-2 countEssay text-center justify-content-center"
                                                    style="color: var(--yellow)">
                                                    <h4>{{ $duethree->count() }}</h4>
                                                    <h4>Essay</h4>
                                                </div>
                                                <hr>
                                                <div class="detailCard ps-2 py-1 mt-1 mb-2">
                                                    <h6>See the list of Essay Due Within 3 Days</h6>
                                                </div>
                                            </a>
                                            <a class="col-md col-12 p-0 userCard"
                                                href="/editor/essay-list-due-within-five">
                                                <div class="headline d-flex align-items-center px-4 py-md-4 py-3 gap-3">
                                                    <img src="/assets/warning.png" alt="">
                                                    <h6>Due Within 5 Days</h6>
                                                </div>
                                                <div
                                                    class="col d-flex flex-column px-3 py-2 countEssay text-center justify-content-center">
                                                    <h4>{{ $duefive->count() }}</h4>
                                                    <h4>Essay</h4>
                                                </div>
                                                <hr>
                                                <div class="detailCard ps-2 py-1 mt-1 mb-2">
                                                    <h6>See the list of Essay Due Within 5 Days</h6>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center m-3 userCard">
                                    <div class="col-md-10 col-12 p-0" style="cursor: default">
                                        <canvas class="mt-4 mb-1" id="your-essay-chart" style="width:100%"></canvas>
                                        <div class="text-center mt-4 mb-lg-0 mb-4">
                                            <h6 class="mb-4" style="font-size: 12px; color: var(--black)">
                                                {{ date('D, d M Y') }} | Total Essay :
                                                {{ $your_essay_ongoing + $your_essay_completed }}
                                                Essay</h6>
                                        </div>
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
@endsection

@section('js')
    {{-- Chart --}}
    <script>
        new Chart(document.getElementById("all-essay-chart"), {
            type: 'doughnut',
            data: {
                labels: ["Ongoing", "Completed"],
                datasets: [{
                    backgroundColor: ["#2785DD", "#44DE37"],
                    data: [{{ $ongoing_essay }}, {{ $completed_essay }}]
                }]
            }
        });
        new Chart(document.getElementById("your-essay-chart"), {
            type: 'doughnut',
            data: {
                labels: ["Ongoing", "Completed"],
                datasets: [{
                    backgroundColor: ["#2785DD", "#44DE37"],
                    data: [{{ $your_essay_ongoing }}, {{ $your_essay_completed }}]
                }]
            }
        });
    </script>

    <script>
        // List Editor Active
        $(document).ready(function() {
            $('#listeditoractiveduration').DataTable({
                scrollX: true,
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{{ route('managing-data-editor-active-duration') }}' + window.location.search,
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        class: 'text-center'
                    },
                    {
                        data: 'editor_name',
                        name: 'editor_name'
                    },
                    {
                        data: 'position',
                        name: 'position'
                    },
                    {
                        data: 'completed_essay',
                        name: 'completed_essay'
                    },
                    {
                        data: 'total_duration',
                        name: 'total_duration'
                    }
                ]
            });
        });
    </script>

    <script>
        const formFilter = document.getElementById('form-dashboard-filter');
        formFilter.addEventListener('change', (() => {
            formFilter.submit();
        }))
    </script>

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
    {{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <script>
        $('form').change(function(e) {
            e.preventDefault();
            Swal.fire({
                width: 100,
                backdrop: '#4e4e4e7d',
                allowOutsideClick: false,
            })
            Swal.showLoading();
            this.closest('form').submit();
        })
    </script>
@endsection
