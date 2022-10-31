@extends('user.editor.utama.utama')
@section('content')
    <div class="container-fluid p-0">
        <div class="row flex-nowrap main" id="main">

            @include('user.editor.utama.menu')
            {{-- Content --}}
            <div class="col">
                @include('user.editor.utama.head')
                <div class="container main-content m-0">
                    <div class="row col-md-12 head align-items-center" style="background-color: transparent !important">
                        {{-- User List --}}
                        <div class="row col-md-12 gap-2">
                            <div class="col-md-5 userCard" style="cursor: default">
                                <div class="row p-4 align-items-center text-center" style="height: 87%">
                                    <div class="col">
                                        <img class="img-fluid" src="/assets/all-essay-logo.png" alt="" width="280" height="280">
                                    </div>
                                </div>
                                <div class="col-md col-12 p-0 ">
                                    <div class="headline d-flex align-items-center gap-3" style="border-bottom-left-radius: 6px; border-bottom-right-radius: 6px; border-top-left-radius: 0px; border-top-right-radius: 0px;">
                                        <img src="/assets/all-essay.png" alt="">
                                        <h6>All Essays</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="row col gap-2">
                                <div class="d-flex flex-md-row flex-column gap-2">
                                    <a class="col userCard" href="/editor/all-essays/not-assign-essay-list">
                                        <div class="col-md col-12 p-0 ">
                                            <div class="headline d-flex align-items-center gap-3">
                                                <img src="/assets/essay-list.png" alt="">
                                                <h6>Not Assign</h6>
                                            </div>
                                        </div>
                                        <div class="row px-3 countUser align-items-center text-center">
                                            <div class="col">
                                                <h4>{{ $count_not_assign_essay }}</h4>
                                                <h4>Essay</h4>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="detailCard ps-3 mt-2">
                                            <h6>See the list of uploaded essay</h6>
                                        </div>
                                    </a>
                                    <a class="col userCard" href="/editor/all-essays/assigned-essay-list">
                                        <div class="col-md col-12 p-0 ">
                                            <div class="headline d-flex align-items-center gap-3"
                                                style="background-color: var(--green)">
                                                <img src="/assets/essay-list.png" alt="">
                                                <h6>Assigned</h6>
                                            </div>
                                        </div>
                                        <div class="row px-3 countUser align-items-center text-center">
                                            <div class="col" style="color: var(--green)">
                                                <h4>{{ $count_assign_essay }}</h4>
                                                <h4>Essay</h4>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="detailCard ps-3 mt-2">
                                            <h6>See the list of assignments</h6>
                                        </div>
                                    </a>
                                </div>
                                <div class="d-flex flex-md-row flex-column gap-2">
                                    <a class="col userCard" href="/editor/all-essays/ongoing-essay-list">
                                        <div class="col-md col-12 p-0 ">
                                            <div class="headline d-flex align-items-center gap-3">
                                                <img src="/assets/ongoing-essay.png" alt="">
                                                <h6>Ongoing</h6>
                                            </div>
                                        </div>
                                        <div class="row px-3 countUser align-items-center text-center">
                                            <div class="col">
                                                <h4>{{ $count_ongoing_essay }}</h4>
                                                <h4>Essay</h4>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="detailCard ps-3 mt-2">
                                            <h6>See the list of ongoing essay</h6>
                                        </div>
                                    </a>
                                    <a class="col userCard" href="/editor/all-essays/completed-essay-list">
                                        <div class="col-md col-12 p-0 ">
                                            <div class="headline d-flex align-items-center gap-3"
                                                style="background-color: var(--green)">
                                                <img src="/assets/completed-essay.png" alt="">
                                                <h6>Completed</h6>
                                            </div>
                                        </div>
                                        <div class="row px-3 countUser align-items-center text-center">
                                            <div class="col" style="color: var(--green)">
                                                <h4>{{ $count_completed_essay }}</h4>
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
                        </div>
                        {{-- End User List --}}
                    </div>
                </div>
            </div>
            {{-- End Content --}}
        </div>
    </div>
@endsection
