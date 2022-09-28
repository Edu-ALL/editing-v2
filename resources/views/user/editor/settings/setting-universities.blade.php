@extends('user.editor.utama.utama')
@section('css')
    <link rel="stylesheet" href="/css/editor/setting-universities.css">
    <style>
        .pagination {
            margin: 15px 0
        }

        .pagination .page-item .page-link {
            padding: 10px 15px;
            font-size: 12px;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid" style="padding: 0">
        <div class="row flex-nowrap main" id="main">

            {{-- Sidenav --}}
            @include('user.editor.utama.menu')

            {{-- Content --}}
            <div class="col" style="overflow: auto !important">
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
                            <h6 class="pt-1 d-none d-md-inline">Editor Name</h6>
                        </div>
                    </div>
                </div>
                <div class="container main-content m-0">
                    {{-- Detail Student --}}
                    <div class="row">
                        @if (session()->has('delete-successful'))
                            <div class="alert alert-success fade show" role="alert">
                                {{ session()->get('delete-successful') }}
                            </div>
                        @endif

                        <div class="col-md col-12 p-0 studentList">
                            <div class="headline d-flex justify-content-between">
                                <div class="col-md-6 col-5 d-flex align-items-center gap-md-3 gap-2">
                                    <img src="/assets/university.png" alt="">
                                    <h6>Universities</h6>
                                </div>
                                <div class="col-md-4 col-6 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                                    <a href="/admin/setting/universities/add"><img src="/assets/add.png" alt=""></a>
                                    <div class="input-group">
                                        <form id="form-university-searching" action="{{ route('list-university') }}"
                                            method="GET" role="search" class="w-100">
                                            <input type="search" class="form-control inputField py-2 px-3" name="keyword"
                                                id="search-university" placeholder="Search" required>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="container text-center" style="overflow-x: auto !important">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>University Name</th>
                                            <th>Website</th>
                                            <th>Country</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                                {{-- Pagination --}}
                                <div class="d-flex justify-content-center">

                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Detail Student --}}
                </div>
            </div>
            {{-- End Content --}}
        </div>
    </div>
@endsection

@section('js')
    <script>
        $("#search-university").keypress(function(e) {
            if (e.keyCode === 13) {
                swal.showLoading();
                e.preventDefault();
                $("#form-university-searching").submit();
            }
        });
    </script>
@stop
