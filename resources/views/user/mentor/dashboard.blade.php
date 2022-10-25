@extends('user.mentor.utama.utama')
@section('css')
    <link rel="stylesheet" href="/css/mentor/dashboard.css">
    <link rel="stylesheet" href="/css/mentor/user-editor-add.css">
    <link rel="stylesheet" href="/css/mentor/user-mentor.css">
@endsection
@section('content')
    <div class="container-fluid p-0">
        <div class="row flex-nowrap main" id="main">

            @include('user.mentor.utama.menu')
            {{-- Content --}}
            <div class="col">
                @include('user.mentor.utama.head')
                <div class="container main-content m-0">
                    <div class="row">
                        <div class="col-md col-12 p-0 userCard" style="cursor: default">
                            <div class="row gap-2 m-3">
                                <div class="col-lg d-flex flex-column gap-2 p-0">
                                    <div class="row gap-2">
                                        <a class="col-md col-12 p-0 userCard" href="/mentor/essay-list/ongoing">
                                            <div class="col-md col-12 p-0 ">
                                                <div class="headline d-flex align-items-center gap-3">
                                                    <img src="/assets/ongoing-essay.png" alt="">
                                                    <h6>Essay Ongoing</h6>
                                                </div>
                                            </div>
                                            <div class="row px-3 countUser align-items-center text-center">
                                                <div class="col" style="color: var(--blue)">
                                                    <h4 class="mb-1">{{ $ongoing_essay }}</h4>
                                                    <h4>Essay Ongoing</h4>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="detailCard ps-3 mt-2">
                                                <h6>See the list of Essay Ongoing</h6>
                                            </div>
                                        </a>
                                        <a class="col-md col-12 p-0 userCard" href="/mentor/essay-list/completed">
                                            <div class="col-md col-12 p-0 ">
                                                <div class="headline d-flex align-items-center gap-3"
                                                    style="background-color: var(--green)">
                                                    <img src="/assets/completed-essay.png" alt="">
                                                    <h6>Essay Completed</h6>
                                                </div>
                                            </div>
                                            <div class="row px-3 countUser align-items-center text-center">
                                                <div class="col" style="color: var(--green)">
                                                    <h4 class="mb-1">{{ $completed_essay }}</h4>
                                                    <h4>Essays Completed</h4>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="detailCard ps-3 mt-2">
                                                <h6>See the list of Essays Completed</h6>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="row gap-2">
                                        <a class="col-md col-12 p-0 userCard" href="/mentor/user/student">
                                            <div class="col-md col-12 p-0 ">
                                                <div class="headline d-flex align-items-center gap-3">
                                                    <img src="/assets/student.png" alt="">
                                                    <h6>Students</h6>
                                                </div>
                                            </div>
                                            <div class="row px-3 countUser align-items-center text-center">
                                                <div class="col" style="color: var(--blue)">
                                                    <h4 class="mb-1">{{ $clients }}</h4>
                                                    <h4>Students</h4>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="detailCard ps-3 mt-2">
                                                <h6>See your student list</h6>
                                            </div>
                                        </a>
                                        <a class="col-md col-12 p-0 userCard" href="/mentor/new-request">
                                            <div class="col-md col-12 p-0 ">
                                                <div class="headline d-flex align-items-center gap-3">
                                                    <img src="/assets/new-request.png" alt="">
                                                    <h6>New Request</h6>
                                                </div>
                                            </div>
                                            <div class="row px-3 countUser align-items-center text-center">
                                                <div class="col" style="color: var(--blue)">
                                                    <img src="/assets/add-blue.png" alt="" style="width: 28px; height: 28px">
                                                    <h4 class="mt-1">Essay Editing</h4>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="detailCard ps-3 mt-2">
                                                <h6>Request New Essay Editing</h6>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg col-12 p-0 userCard" style="cursor: default">
                                    <div class="headline d-flex align-items-center px-4 py-md-4 py-3 gap-3">
                                        <img src="/assets/detail.png" alt="">
                                        <h6>Essays</h6>
                                    </div>
                                    <canvas class="mt-5 mb-1" id="doughnut-chart" style="width:100%"></canvas>
                                    <div class="text-center mt-4 mb-lg-0 mb-4">
                                        <h6 class="mb-4" style="font-size: 12px; color: var(--black)">
                                            {{ date('D, d M Y') }} | Total Essay : {{ $ongoing_essay + $completed_essay }}
                                            Essay</h6>
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
    <script>
        new Chart(document.getElementById("doughnut-chart"), {
            type: 'doughnut',
            data: {
                labels: ["Ongoing", "Completed"],
                datasets: [{
                    backgroundColor: ["#2785DD", "#44DE37"],
                    data: [{{ $ongoing_essay }}, {{ $completed_essay }}]
                }]
            }
        });
    </script>
    @if (session()->has('login-successful'))
        <script>
            $(document).ready(function() {
                setTimeout(() => {
                    $(".alert-success").alert('close');
                }, 3000);
            });
        </script>
    @endif
@stop
