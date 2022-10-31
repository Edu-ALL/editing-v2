@extends('user.editor.utama.utama')
@section('css')
    <link rel="stylesheet" href="/css/per-editor/dashboard.css">
    <style>
        .alert {font-size: 14px; margin: 0 -12px 16px -12px}
    </style>
@endsection
@section('content')
    <div class="container-fluid p-0">
        <div class="row flex-nowrap main" id="main">

            {{-- Sidenav --}}
            @include('user.editor.utama.menu')

            {{-- Content --}}
            <div class="col">
                @include('user.editor.utama.head')
                <div class="container main-content m-0">
                    @if (session()->has('login-successful'))
                    <div class="row alert alert-success fade show d-flex justify-content-between" role="alert">
                        {{ session()->get('login-successful') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <div class="row gap-2">
                        <div class="col-md col-12 p-0 userCard" style="cursor: default">
                            <div class="headline d-flex align-items-center justify-content-center py-md-4 py-3 gap-3">
                                <img src="/assets/essay-list.png" alt="">
                                <h6 style="font-weight: 700; font-size: 16px">ALL ESSAYS</h6>
                            </div>
                            <div class="row gap-2 m-3">
                                <div class="col-lg d-flex flex-column gap-2 p-0">
                                    <a class="col-md col-12 p-0 userCard" href="/editor/all-essays/essay-list-due-tommorow">
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
                                        <a class="col-md col-12 p-0 userCard" href="/editor/all-essays/essay-list-due-within-three">
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
                                        <a class="col-md col-12 p-0 userCard" href="/editor/all-essays/essay-list-due-within-five">
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
                            <div class="row m-3">
                                <div class="col-lg col-12 p-0 userCard" style="cursor: default">
                                    <canvas class="mt-4 mb-1" id="all-essay-chart" style="width:100%"></canvas>
                                    <div class="text-center mt-4 mb-lg-0 mb-4">
                                        <h6 class="mb-4" style="font-size: 12px; color: var(--black)">
                                            {{ date('D, d M Y') }} | Total Essay : {{ $ongoing_essay + $completed_essay }}
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
                                    <a class="col-md col-12 p-0 userCard" href="/editor/essay-list-due-tommorow">
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
                                        <a class="col-md col-12 p-0 userCard" href="/editor/essay-list-due-within-three">
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
                                        <a class="col-md col-12 p-0 userCard" href="/editor/essay-list-due-within-five">
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
                            <div class="row m-3">
                                <div class="col-lg col-12 p-0 userCard" style="cursor: default">
                                    <canvas class="mt-4 mb-1" id="your-essay-chart" style="width:100%"></canvas>
                                    <div class="text-center mt-4 mb-lg-0 mb-4">
                                        <h6 class="mb-4" style="font-size: 12px; color: var(--black)">
                                            {{ date('D, d M Y') }} | Total Essay : {{ $your_essay_ongoing + $your_essay_completed }}
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
@endsection
