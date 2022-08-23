@extends('user.editor.utama.utama')
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
                <div class="row col-md-12 head py-4 align-items-center">
                    <div class="container main-content">
                        {{-- User List --}}
                        <div class="row col-md-12">
                            <a class="col-md-6 userCard p-1" href="/mentor/user/student">
                                <div class="container px-3 countUser-editor align-items-center text-center">
                                    <div class="col">
                                        <img class="img-fluid" src="/assets/student-bg.png" alt="">
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md col-12 p-0 ">
                                    <div class="headline d-flex align-items-center gap-3">
                                        <img src="/assets/all-essays.png" alt="">
                                        <h6>All Essays</h6>
                                    </div>
                                </div>
                            </a>
                            <div class="row col-md-6">
                                <a class="col-md-6 userCard p-1" href="/editor/all-essays/not-assign-essay-list">
                                    <div class="col-md col-12 p-0 ">
                                        <div class="headline d-flex align-items-center gap-3">
                                            <img src="/assets/all-essays.png" alt="">
                                            <h6>Not Assign</h6>
                                        </div>
                                    </div>
                                    <div class="row px-3 countUser align-items-center text-center">
                                        <div class="col">
                                            <h4>1</h4>
                                            <h4>Essay</h4>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="detailCard ps-3 mt-2">
                                        <h6>See the list of uploaded essay</h6>
                                    </div>
                                </a>
                                <a class="col-md-6 userCard p-1" href="/editor/all-essays/assigned-essay-list">
                                    <div class="col-md col-12 p-0 ">
                                        <div class="headline d-flex align-items-center gap-3"
                                            style="background-color: var(--green)">
                                            <img src="/assets/all-essays.png" alt="">
                                            <h6>Assigned</h6>
                                        </div>
                                    </div>
                                    <div class="row px-3 countUser align-items-center text-center">
                                        <div class="col">
                                            <h4>1</h4>
                                            <h4>Essay</h4>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="detailCard ps-3 mt-2">
                                        <h6>See the list of assignments</h6>
                                    </div>
                                </a>
                                <a class="col-md-6 userCard p-1" href="/editor/all-essays/ongoing-essay-list">
                                    <div class="col-md col-12 p-0 ">
                                        <div class="headline d-flex align-items-center gap-3">
                                            <img src="/assets/all-essays.png" alt="">
                                            <h6>Ongoing</h6>
                                        </div>
                                    </div>
                                    <div class="row px-3 countUser align-items-center text-center">
                                        <div class="col">
                                            <h4>1</h4>
                                            <h4>Essay</h4>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="detailCard ps-3 mt-2">
                                        <h6>See the list of ongoing essay</h6>
                                    </div>
                                </a>
                                <a class="col-md-6 userCard p-1" href="/editor/all-essays/completed-essay-list">
                                    <div class="col-md col-12 p-0 ">
                                        <div class="headline d-flex align-items-center gap-3"
                                            style="background-color: var(--green)">
                                            <img src="/assets/all-essays.png" alt="">
                                            <h6>Completed</h6>
                                        </div>
                                    </div>
                                    <div class="row px-3 countUser align-items-center text-center">
                                        <div class="col">
                                            <h4>1</h4>
                                            <h4>Essay</h4>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="detailCard ps-3 mt-2">
                                        <h6>See the list of completed essay</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                        {{-- End User List --}}
                    </div>
                    {{-- <div class="container main-content">
                        
                    </div> --}}
                </div>
            </div>
            {{-- End Content --}}
        </div>
    </div>
@endsection
