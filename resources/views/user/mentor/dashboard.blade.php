@extends('user.mentor.utama.utama')
@section('content')
    <div class="container-fluid">
        <div class="row flex-nowrap main">

            @include('user.mentor.utama.menu')
            {{-- Content --}}
            <div class="col">
                <div class="row head py-4 align-items-center">
                    <div class="col-md-6 col-10 ps-md-5 ps-3">
                        <h4 class="">Mentor Dashboard</h4>
                    </div>
                    <div class="col-md-6 col-2 pe-md-5 pe-3">
                        <div class="head-content d-flex flex-row align-items-center justify-content-end gap-md-4 gap-2">
                            <a class="help d-flex flex-row align-items-center gap-md-2 gap-1" href="">
                                <img class="img-fluid" src="/assets/help-grey.png" alt="">
                                <h6 class="d-none d-md-inline">Help</h6>
                            </a>
                            <a href="">
                                <h6 class="pt-1 d-none d-md-inline">Mentor Name</h6>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="container main-content">
                    {{-- User List --}}
                    <div class="row gap-2">
                        <a class="col-md col-12 userCard" href="/mentor/user/student">
                            <div class="headline text-center">
                                <h6>Students</h6>
                            </div>
                            <div class="row px-3 countUser align-items-center text-center">
                                <div class="col">
                                    <img class="img-fluid" src="/assets/student-bg.png" alt="">
                                </div>
                                <div class="col">
                                    <h4>1</h4>
                                    <h4>Students</h4>
                                </div>
                            </div>
                            <hr>
                            <div class="detailCard ps-3 mt-2">
                                <h6>See the list of Students</h6>
                            </div>
                        </a>
                        <a class="col-md col-12 userCard">
                            <div class="headline text-center">
                                <h6>Mentors</h6>
                            </div>
                            <div class="row px-3 countUser align-items-center text-center">
                                <div class="col">
                                    <img class="img-fluid" src="/assets/mentor-bg.png" alt="">
                                </div>
                                <div class="col">
                                    <h4>1</h4>
                                    <h4>Mentors</h4>
                                </div>
                            </div>
                            <hr>
                            <div class="detailCard ps-3 mt-2">
                                <h6>See the list of Mentors</h6>
                            </div>
                        </a>
                        <a class="col-md col-12 userCard">
                            <div class="headline text-center">
                                <h6>Editors</h6>
                            </div>
                            <div class="row px-3 countUser align-items-center text-center">
                                <div class="col">
                                    <img class="img-fluid" src="/assets/editor-bg.png" alt="">
                                </div>
                                <div class="col">
                                    <h4>1</h4>
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
                        <a class="col-md col-12 userCard">
                            <div class="headline d-flex align-items-center gap-3">
                                <img src="/assets/ongoing-essay.png" alt="">
                                <h6>Ongoing Essay</h6>
                            </div>
                            <div class="col d-flex flex-column px-3 countUser text-center justify-content-center">
                                <h4>1</h4>
                                <h4>Essay</h4>
                            </div>
                            <hr>
                            <div class="detailCard ps-3 mt-2">
                                <h6>See the list of Students</h6>
                            </div>
                        </a>
                        <a class="col-md col-12 userCard" href="">
                            <div class="headline d-flex align-items-center gap-3" style="background-color: var(--green)">
                                <img src="/assets/completed-essay.png" alt="">
                                <h6>Completed Essay</h6>
                            </div>
                            <div class="col d-flex flex-column px-3 countUser text-center justify-content-center"
                                style="color: var(--green)">
                                <h4>1</h4>
                                <h4>Essay</h4>
                            </div>
                            <hr>
                            <div class="detailCard ps-3 mt-2">
                                <h6>See the list of Students</h6>
                            </div>
                        </a>
                    </div>
                    {{-- End Essay --}}
                </div>
            </div>
            {{-- End Content --}}
        </div>
    </div>
@endsection
