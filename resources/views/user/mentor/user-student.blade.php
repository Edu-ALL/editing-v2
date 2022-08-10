@extends('user.mentor.utama.utama')
@section('content')
    <div class="container-fluid">
        <div class="row flex-nowrap main">
            @include('user.mentor.utama.menu')

            {{-- Content --}}
            <div class="col">
                <div class="row head py-4 align-items-center">
                    <div class="col-md-6 col-10 ps-md-5 ps-3">
                        <h4 class="">Admin Dashboard</h4>
                    </div>
                    <div class="col-md-6 col-2 pe-md-5 pe-3">
                        <div class="head-content d-flex flex-row align-items-center justify-content-end gap-md-4 gap-2">
                            <a class="help d-flex flex-row align-items-center gap-md-2 gap-1" href="">
                                <img class="img-fluid" src="/assets/help-grey.png" alt="">
                                <h6 class="d-none d-md-inline">Help</h6>
                            </a>
                            <a href="">
                                <h6 class="pt-1 d-none d-md-inline">Admin Name</h6>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="container main-content">
                    <div class="row">
                        <a class="col-md col-12 studentList">
                            <div class="headline d-flex align-items-center gap-3">
                                <img src="/assets/student.png" alt="">
                                <h6>Students</h6>
                            </div>
                        </a>
                    </div>


                    <table class="table userCard">
                        <thead>
                            <tr>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td data-label="first-name">John</td>
                                <td data-label="last-name">Doe</td>
                                <td data-label="email">john@example.com</td>
                            </tr>
                            <tr>
                                <td data-label="first-name">Mary</td>
                                <td data-label="last-name">Moe</td>
                                <td data-label="email">mary@example.com</td>
                            </tr>
                            <tr>
                                <td data-label="first-name">July</td>
                                <td data-label="last-name">Dooley</td>
                                <td data-label="email">july@example.com</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- End Content --}}
        </div>
    </div>
@endsection
