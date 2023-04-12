@extends('user.admin.utama.utama')
@section('css')
    <link rel="stylesheet" href="/css/admin/dashboard.css">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row flex-nowrap main" id="main">

            {{-- Sidenav --}}
            @include('user.admin.utama.menu')

            {{-- Content --}}
            <div class="col">
                @include('user.admin.utama.head')
                <div class="container main-content m-0">
                    @if (session()->has('login-successful'))
                        <div class="row alert alert-success fade show" role="alert">
                            {{ session()->get('login-successful') }}
                        </div>
                    @endif
                    <div class="row gap-4">
                        <div class="col-md col-12">
                            {{-- User List --}}
                            <div class="row gap-2">
                                <a class="col-md col-12 p-0 userCard" href="/admin/user/student">
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
                                </a>
                                <a class="col-md col-12 p-0 userCard" href="/admin/user/mentor">
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
                                </a>
                                <a class="col-md col-12 p-0 userCard" href="/admin/user/editor">
                                    <div class="headline text-center">
                                        <h6>Editors</h6>
                                    </div>
                                    <div class="row px-3 countUser align-items-center text-center">
                                        <div class="col">
                                            <img class="img-fluid" src="/assets/editor-bg.png" alt=""
                                                style="object-fit: contain">
                                        </div>
                                        <div class="col">
                                            <h4>{{ $count_editor }}</h4>
                                            <h4>Editors</h4>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="detailCard ps-3 mt-2">
                                        <h6>See the list of Editors</h6>
                                    </div>
                                </a>
                            </div>
                            {{-- End User List --}}

                            {{-- Essay --}}
                            <div class="row gap-2 my-2">
                                <a class="col-md col-12 p-0 userCard" href="/admin/essay-list/ongoing">
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
                                    <div class="detailCard ps-3 mt-2">
                                        <h6>See the list of Ongoing Essay</h6>
                                    </div>
                                </a>
                                <a class="col-md col-12 p-0 userCard" href="/admin/essay-list/completed">
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
                                    <div class="detailCard ps-3 mt-2">
                                        <h6>See the list of Completed Essay</h6>
                                    </div>
                                </a>
                            </div>
                            {{-- End Essay --}}
                        </div>

                        {{-- Active Editor --}}
                        <div class="col-md col-12">
                            {{-- Table Student --}}
                            <div class="row card">
                                <div class="col-md col-12 p-0 studentList">
                                    <div class="headline d-flex justify-content-between align-items-center">
                                        <div class="col-md-6 col-7 d-flex align-items-center gap-md-3 gap-2">
                                            <h6 class="mb-0">Editor Active + Hour</h6>
                                        </div>
                                        <div class="col-6 col-4 d-flex align-items-center justify-content-end">
                                            <div class="input-group">
                                                <form id="form-dashboard-filter" action="{{ route('admin-dashboard') }}"
                                                    method="GET" class="w-100">
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
                                                                            <option selected value="{{ $month }}">
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
                                                                <select class="form-select" id="floatingSelectGrid"
                                                                    aria-label="Floating label select example"
                                                                    name="active-year">
                                                                    @for ($year = 2016; $year <= Carbon\Carbon::now()->year; $year++)
                                                                        @if ($year == $date['year'])
                                                                            <option selected value="{{ $year }}">
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
                                    <div class="container text-center pt-3" style="overflow-x: auto !important">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Editor Name</th>
                                                    <th>Position</th>
                                                    <th>Completed Essay</th>
                                                    <th>Total Duration</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = ($editors_active->currentpage() - 1) * $editors_active->perpage() + 1; ?>
                                                @foreach ($editors_active as $editor)
                                                    <tr>
                                                        <th scope="row">{{ $i++ }}</th>
                                                        <td>
                                                            {{ $editor->first_name . ' ' . $editor->last_name }}
                                                        </td>
                                                        @if ($editor->position == 1)
                                                            <td>Associate</td>
                                                        @elseif ($editor->position == 2)
                                                            <td>Senior</td>
                                                        @elseif ($editor->position == 3)
                                                            <td>Managing</td>
                                                        @endif
                                                        <td>
                                                            {{ $editor->completed_essay }}
                                                        </td>
                                                        <td>
                                                            {{ $editor->total_duration }}
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                @unless (count($editors_active))
                                                    <tr>
                                                        <td colspan="7">No data</td>
                                                    </tr>
                                                @endunless
                                            </tbody>
                                        </table>
                                        {{-- Pagination --}}
                                        <div class="d-flex justify-content-center">
                                            {{ $editors_active->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End Table Student --}}
                        </div>
                        {{-- End Active Editor --}}
                    </div>
                </div>
            </div>
            {{-- End Content --}}
        </div>
    </div>
@endsection

@section('js')
    @if (session()->has('login-successful'))
        <script>
            $(document).ready(function() {
                setTimeout(() => {
                    $(".alert-success").alert('close');
                }, 3000);
            });
        </script>
    @endif
    <script>
        const formFilter = document.getElementById('form-dashboard-filter');
        formFilter.addEventListener('change', (() => {
            formFilter.submit();
        }))
    </script>
@stop
