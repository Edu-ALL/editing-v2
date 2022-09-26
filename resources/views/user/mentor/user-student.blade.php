@extends('user.mentor.utama.utama')
@section('css')
    <link rel="stylesheet" href="/css/mentor/user-student.css">
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
                <div class="container main-content m-0">
                    {{-- Table Student --}}
                    <div class="row">
                        <div class="col-md col-12 p-0 studentList">
                            <div class="headline d-flex justify-content-between">
                                <div class="col-md-6 col-5 d-flex align-items-center gap-md-3 gap-2">
                                    <img src="/assets/mentor.png" alt="">
                                    <h6>Students List</h6>
                                </div>
                                <div class="col-md-4 col-6 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                                    <img src="/assets/reload.png" alt="">
                                    <div class="input-group">
                                        <form id="form-client-searching" action="{{ route('list-student') }}" method="GET"
                                            role="search" class="w-100">
                                            <input type="text" class="form-control inputField py-2 px-3" name="keyword"
                                                id="search-client" placeholder="Search" required>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="container text-center" style="overflow-x: auto !important">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Student Name</th>
                                            <th>Mentor Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>City</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = ($clients->currentpage() - 1) * $clients->perpage() + 1; ?>
                                        @foreach ($clients as $client)
                                            <tr
                                                onclick="window.location='/mentor/user/student/detail/{{ $client->id_clients }}'">
                                                <th scope="row">{{ $i++ }}</th>
                                                <td>{{ $client->first_name . ' ' . $client->last_name }}</td>
                                                <td>{{ $client->mentors->first_name . ' ' . $client->mentors->last_name }}
                                                </td>
                                                <td>{{ $client->email }}</td>
                                                <td>{{ $client->phone }}</td>
                                                <td>{{ strip_tags($client->address) }}</td>
                                            </tr>
                                        @endforeach

                                        @unless(count($clients))
                                            <tr>
                                                <td colspan="7">No data</td>
                                            </tr>
                                        @endunless
                                    </tbody>
                                </table>
                                {{-- Pagination --}}
                                <div class="d-flex justify-content-center">
                                    {{ $clients->links() }}
                                </div>
                            </div>
                            </a>
                        </div>
                        {{-- End Table Student --}}
                    </div>
                </div>
                {{-- End Content --}}
            </div>
        </div>
    @endsection
