@extends('user.mentor.utama.utama')
@section('css')
    <link rel="stylesheet" href="/css/mentor/dashboard.css">
@endsection
@section('content')
    <div class="container-fluid p-0">
        <div class="row flex-nowrap main">

            @include('user.mentor.utama.menu')
            {{-- Content --}}
            <div class="col">
                @include('user.mentor.utama.head')
                <div class="container main-content">
                    {{-- User List --}}
                    <div class="row gap-2">
                        <a class="col-md-3 col-12 userCard p-0" href="/mentor/user/student">
                            <div class="col-md col-12 p-0 ">
                                <div class="headline d-flex align-items-center gap-3">
                                    <img src="/assets/all-essays.png" alt="">
                                    <h6>Essay Ongoing</h6>
                                </div>
                            </div>
                            <div class="row px-3 countUser align-items-center text-center">
                                {{-- <div class="col">
                                    <img class="img-fluid" src="/assets/student-bg.png" alt="">
                                </div> --}}
                                <div class="col">
                                    <h4>{{ $count_ongoing_essay }}</h4>
                                    <h4>Essay Ongoing</h4>
                                </div>
                            </div>
                            <hr>
                            <div class="detailCard ps-3 mt-2">
                                <h6>See the list of Essay Ongoing</h6>
                            </div>
                        </a>
                        <a class="col-md-3 col-12 userCard p-0">
                            <div class="col-md col-12 p-0 ">
                                <div class="headline d-flex align-items-center gap-3"
                                    style="background-color: var(--green)">
                                    <img src="/assets/completed-essay.png" alt="">
                                    <h6>Essay Completed</h6>
                                </div>
                            </div>
                            <div class="row px-3 countUser align-items-center text-center">
                                <div class="col">
                                    <h4>{{ $count_completed_essay }}</h4>
                                    <h4>Essays Completed</h4>
                                </div>
                            </div>
                            <hr>
                            <div class="detailCard ps-3 mt-2">
                                <h6>See the list of Essays Completed</h6>
                            </div>
                        </a>
                    </div>
                    {{-- End User List --}}
                </div>
                <div class="container main-content">
                    {{-- User List --}}
                    <div class="row gap-2">
                        <a class="col-md-3 col-12 userCard p-0" href="/mentor/user/student">
                            <div class="col-md col-12 p-0 ">
                                <div class="headline d-flex align-items-center gap-3">
                                    <img src="/assets/student.png" alt="">
                                    <h6>Students</h6>
                                </div>
                            </div>
                            <div class="row px-3 countUser align-items-center text-center">
                                {{-- <div class="col">
                                    <img class="img-fluid" src="/assets/student-bg.png" alt="">
                                </div> --}}
                                <div class="col">
                                    <h4>{{ $count_student }}</h4>
                                    <h4>Students</h4>
                                </div>
                            </div>
                            <hr>
                            <div class="detailCard ps-3 mt-2">
                                <h6>See your student list</h6>
                            </div>
                        </a>
                        <a class="col-md-3 col-12 userCard p-0">
                            <div class="col-md col-12 p-0 ">
                                <div class="headline d-flex align-items-center gap-3">
                                    <img src="/assets/add.png" alt="">
                                    <h6>New Request</h6>
                                </div>
                            </div>
                            <div class="row px-3 countUser align-items-center text-center">
                                {{-- <div class="col">
                                    <img class="img-fluid" src="/assets/mentor-bg.png" alt="">
                                </div> --}}
                                <div class="col">
                                    <h4>1</h4>
                                    <h4>Essay Editing</h4>
                                </div>
                            </div>
                            <hr>
                            <div class="detailCard ps-3 mt-2">
                                <h6>See the list of Essay Editing</h6>
                            </div>
                        </a>
                    </div>
                    {{-- End User List --}}
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
@stop
