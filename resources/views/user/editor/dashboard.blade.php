@extends('user.editor.utama.utama')
@section('css')
    <link rel="stylesheet" href="/css/admin/dashboard.css">
    <link rel="stylesheet" href="/css/per-editor/dashboard.css">
@endsection
@section('content')
    <div class="container-fluid p-0">
        <div class="row flex-nowrap main" id="main">
            @include('user.editor.utama.menu')
            {{-- Content --}}
            <div class="col">
                @include('user.editor.utama.head')
                <div class="container main-content m-0">
                    <div class="row gap-2">
                        <a class="col-md col-12 p-0 userCard" style="cursor: default; min-height:min-content">
                            <div class="headline d-flex align-items-center gap-3 p-0">
                                <img src="/assets/essay-list.png" alt="">
                                <h6>All Essay</h6>
                            </div>
                            <div class="col-md col-12 p-4 pointer" onclick="location.href='/editor/all-essays/essay-list-due-tommorow'">
                                <div class="headline d-flex align-items-center gap-3" style="background-color: var(--red)">
                                    <img src="/assets/danger.png" alt="">
                                    <h6>Due Tomorrow</h6>
                                </div>
                                <div class="row p-4 countUser align-items-center text-center">
                                    <div class="col" style="color: var(--red)">
                                        <h4>{{ $allduetomorrow->count() }}</h4>
                                        <h4>Essay</h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="detailCard ps-3 mt-2">
                                    <h6>See the list of Essay Due Tomorrow</h6>
                                </div>
                            </div>
                            <div class="row gap-3">
                                <div class="col-md col-6 ps-4 pointer"
                                    onclick="location.href='/editor/all-essays/essay-list-due-within-three'">
                                    <div class="headline d-flex align-items-center gap-3 p-0" style="background-color: var(--yellow); padding: 24px 18px !important">
                                        <img src="/assets/danger.png" alt="">
                                        <h6>Due Within 3 Days</h6>
                                    </div>
                                    <div class="row p-4 countUser align-items-center text-center">
                                        <div class="col" style="color: var(--yellow)">
                                            <h4>{{ $allduethree->count() }}</h4>
                                            <h4>Essay</h4>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="detailCard ps-3 mt-2">
                                        <h6>See the list of Essay Due Within 3 Days</h6>
                                    </div>
                                </div>
                                <div class="col-md col-6 pe-4 pointer"
                                    onclick="location.href='/editor/all-essays/essay-list-due-within-five'">
                                    <div class="headline d-flex align-items-center gap-3">
                                        <img src="/assets/danger.png" alt="">
                                        <h6>Due Within 5 Days</h6>
                                    </div>
                                    <div class="row p-4 countUser align-items-center text-center">
                                        <div class="col" style="color: var(--blue)">
                                            <h4>{{ $allduefive->count() }}</h4>
                                            <h4>Essay</h4>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="detailCard ps-3 mt-2">
                                        <h6>See the list of Essay Due Within 5 Days</h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="col-md col-12 p-0 userCard" style="cursor: default">
                            <div class="headline d-flex align-items-center gap-3">
                                <img src="/assets/essay-list.png" alt="">
                                <h6>Your Essay</h6>
                            </div>
                            <div class="col-md col-12 p-4 pointer" onclick="location.href='/editor/essay-list-due-tommorow'">
                                <div class="headline d-flex align-items-center gap-3" style="background-color: var(--red)">
                                    <img src="/assets/danger.png" alt="">
                                    <h6>Due Tomorrow</h6>
                                </div>
                                <div class="row p-4 countUser align-items-center text-center">
                                    <div class="col" style="color: var(--red)">
                                        <h4>{{ $duetomorrow->count() }}</h4>
                                        <h4>Essay</h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="detailCard ps-3 mt-2">
                                    <h6>See the list of Essay Due Tomorrow</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md col-6 p-3 pointer" onclick="location.href='/editor/essay-list-due-within-three'">
                                    <div class="headline d-flex align-items-center gap-3" style="background-color: var(--yellow)">
                                        <img src="/assets/danger.png" alt="">
                                        <h6>Due Within 3 Days</h6>
                                    </div>
                                    <div class="row p-4 countUser align-items-center text-center">
                                        <div class="col" style="color: var(--yellow)">
                                            <h4>{{ $duethree->count() }}</h4>
                                            <h4>Essay</h4>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="detailCard ps-3 mt-2">
                                        <h6>See the list of Essay Due Within 3 Days</h6>
                                    </div>
                                </div>
                                <div class="col-md col-6 p-3 pointer" onclick="location.href='/editor/essay-list-due-within-five'">
                                    <div class="headline d-flex align-items-center gap-3"
                                        style="background-color: var(--blue)">
                                        <img src="/assets/danger.png" alt="">
                                        <h6>Due Within 5 Days</h6>
                                    </div>
                                    <div class="row p-4 countUser align-items-center text-center">
                                        <div class="col" style="color: var(--blue)">
                                            <h4>{{ $duefive->count() }}</h4>
                                            <h4>Essay</h4>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="detailCard ps-3 mt-2">
                                        <h6>See the list of Essay Due Within 5 Days</h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
            {{-- End Content --}}
        </div>
    </div>
@endsection
