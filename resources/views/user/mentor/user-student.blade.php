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
    <div class="container-fluid p-0">
        <div class="row flex-nowrap main" id="main">
            @include('user.mentor.utama.menu')

            {{-- Content --}}
            <div class="col">
                @include('user.mentor.utama.head')
                <div class="container main-content m-0">
                    {{-- Table Student --}}
                    <div class="row">
                        @if ($errors->any())
                            {!! implode('', $errors->all('<div class="alert alert-danger" role="alert">:message</div>')) !!}
                        @endif

                        @if (session()->has('update-data-successful'))
                            <div class="alert alert-success fade show" role="alert">
                                {{ session()->get('update-data-successful') }}
                            </div>
                        @endif
                        <div class="col-md col-12 p-0 studentList">
                            <div class="headline d-flex justify-content-between">
                                <div class="col-md-6 col-5 d-flex align-items-center gap-md-3 gap-2">
                                    <img src="/assets/student.png" alt="">
                                    <h6>Students List</h6>
                                </div>
                                <div class="col-md-4 col-6 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                                    <div class="input-group">
                                        <form id="form-client-searching" action="{{ route('list-student') }}" method="GET"
                                            role="search" class="w-100">
                                            <input type="search" class="form-control inputField py-2 px-3" name="keyword" id="search-client" placeholder="Search">
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
                                            <th>Backup Mentor</th>
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
                                                <td>{{ isset($client->mentors2) ? $client->mentors2->first_name.' '.$client->mentors2->last_name : '-' }}</td>
                                                <td>{{ $client->email ? $client->email : '-' }}</td>
                                                <td>{{ $client->phone ? $client->phone : '-' }}</td>
                                                <td>{{ $client->address ? strip_tags($client->address) : '-' }}</td>
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
