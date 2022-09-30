@extends('user.editor.utama.utama')
@section('css')
    <link rel="stylesheet" href="/css/editor/dashboard.css">
@endsection
@section('content')
    <div class="container-fluid p-0">
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
                <div class="row gap-2 my-2">
                    <a class="col-md col-12 p-0 userCard">
                        <div class="headline d-flex align-items-center gap-3 p-0">
                            <img src="/assets/essay-list.png" alt="">
                            <h6>All Essay</h6>
                        </div>
                        <div class="col-md col-12 p-4" onclick="location.href='/editor/all-essays/essay-list-due-tommorow'">
                            <div class="headline d-flex align-items-center gap-3" style="background-color: var(--red)">
                                <img src="/assets/danger.png" alt="">
                                <h6>Due Tomorrow</h6>
                            </div>
                            <div class="row p-4 countUser align-items-center text-center">
                                <div class="col">
                                    <h4>1</h4>
                                    <h4>Essay</h4>
                                </div>
                            </div>
                            <hr>
                            <div class="detailCard ps-3 mt-2">
                                <h6>See the list of Essay Due Tomorrow</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md col-6 p-3 "
                                onclick="location.href='/editor/all-essays/essay-list-due-within-three'">
                                <div class="headline d-flex align-items-center gap-3 p-0"
                                    style="background-color: var(--yellow)">
                                    <img src="/assets/danger.png" alt="">
                                    <h6>Due Within 3 Days</h6>
                                </div>
                                <div class="row p-4 countUser align-items-center text-center">
                                    <div class="col">
                                        <h4>1</h4>
                                        <h4>Essay</h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="detailCard ps-3 mt-2">
                                    <h6>See the list of Essay Due Within 3 Days</h6>
                                </div>
                            </div>
                            <div class="col-md col-6 p-3 "
                                onclick="location.href='/editor/all-essays/essay-list-due-within-five'">
                                <div class="headline d-flex align-items-center gap-3">
                                    <img src="/assets/danger.png" alt="">
                                    <h6>Due Within 5 Days</h6>
                                </div>
                                <div class="row p-4 countUser align-items-center text-center">
                                    <div class="col">
                                        <h4>1</h4>
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
                    <a class="col-md col-12 p-0 userCard">
                        <div class="headline d-flex align-items-center gap-3">
                            <img src="/assets/essay-list.png" alt="">
                            <h6>Your Essay</h6>
                        </div>
                        <div class="col-md col-12 p-4" onclick="location.href='/editor/essay-list-due-tommorow'">
                            <div class="headline d-flex align-items-center gap-3" style="background-color: var(--red)">
                                <img src="/assets/danger.png" alt="">
                                <h6>Due Tomorrow</h6>
                            </div>
                            <div class="row p-4 countUser align-items-center text-center">
                                <div class="col">
                                    <h4>1</h4>
                                    <h4>Essay</h4>
                                </div>
                            </div>
                            <hr>
                            <div class="detailCard ps-3 mt-2">
                                <h6>See the list of Essay Due Tomorrow</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md col-6 p-3 " onclick="location.href='/editor/essay-list-due-within-three'">
                                <div class="headline d-flex align-items-center gap-3">
                                    <img src="/assets/danger.png" alt="">
                                    <h6>Due Within 3 Days</h6>
                                </div>
                                <div class="row p-4 countUser align-items-center text-center">
                                    <div class="col">
                                        <h4>1</h4>
                                        <h4>Essay</h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="detailCard ps-3 mt-2">
                                    <h6>See the list of Essay Due Within 3 Days</h6>
                                </div>
                            </div>
                            <div class="col-md col-6 p-3 " onclick="location.href='/editor/essay-list-due-within-five'">
                                <div class="headline d-flex align-items-center gap-3"
                                    style="background-color: var(--yellow)">
                                    <img src="/assets/danger.png" alt="">
                                    <h6>Due Within 5 Days</h6>
                                </div>
                                <div class="row p-4 countUser align-items-center text-center">
                                    <div class="col">
                                        <h4>1</h4>
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
            {{-- End Content --}}
        </div>
    </div>
@endsection
