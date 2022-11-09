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
        .alert {font-size: 14px; margin: 0 -12px 16px 0}
    </style>
@endsection

@section('content')
    <div class="container-fluid" style="padding: 0">
        <div class="row flex-nowrap main" id="main">

            {{-- Sidenav --}}
            @include('user.editor.utama.menu')

            {{-- Content --}}
            <div class="col" style="overflow: auto !important">
                @include('user.editor.utama.head')
                <div class="container main-content m-0">
                    {{-- Detail Student --}}
                    <div class="row">
                        @if (session()->has('delete-successful'))
                            <div class="row alert alert-success fade show d-flex justify-content-between" role="alert">
                                {{ session()->get('delete-successful') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="col-md col-12 p-0 studentList">
                            <div class="headline d-flex justify-content-between">
                                <div class="col-md-6 col-5 d-flex align-items-center gap-md-3 gap-2">
                                    <img src="/assets/university.png" alt="">
                                    <h6>Universities</h6>
                                </div>
                                <div class="col-md-4 col-6 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                                    <a href="/editor/setting/universities/add"><img src="/assets/add.png" alt=""></a>
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
                                        <?php $i = ($universities->currentpage()-1)* $universities->perpage() + 1;?>
                                        @foreach ($universities as $university)
                                        <tr onclick="window.location='/editor/setting/universities/detail/{{ $university->id_univ }}'">
                                            <th scope="row">{{ $i++ }}</th>
                                            <td>{{ $university->university_name }}</td>
                                            <td>{{ $university->website }}</td>
                                            <td>{{ $university->country }}</td>
                                            <td>{{ $university->phone }}</td>
                                            <td>{{ $university->address }}</td>
                                            <td><img src="
                                            @if ($university->photo)
                                            {{ asset('uploaded_files/univ/'.$university->photo) }}
                                            @else
                                            {{ asset('uploaded_files/univ/default.png') }}
                                            @endif
                                            " alt="{{ $university->photo }}" style="max-width:50px;" /></td>
                                        </tr>
                                        @endforeach
                                        
                                        @unless (count($universities)) 
                                        <tr>
                                            <td colspan="7">No data</td>
                                        </tr>
                                        @endunless
                                    </tbody>
                                </table>
                                {{-- Pagination --}}
                                <div class="d-flex justify-content-center">
                                    {{ $universities->links() }}
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

    {{-- Modal Info --}}
    @if (session()->has('isUniv'))
    <div class="modal fade" id="info-univ" tabindex="-1" show>
        <div class="modal-dialog d-flex align-items-center justify-content-center">
        <div class="modal-content border-0 w-75">
            <div class="modal-header" style="background-color: var(--red)">
                <div class="col d-flex gap-1 align-items-center">
                    <img src="/assets/info.png" alt="">
                    <h6 class="modal-title ms-3">Alert</h6>
                </div>
                <div type="button" data-bs-dismiss="modal" aria-label="Close">
                    <img src="/assets/close.png" alt="" style="height: 26px">
                </div>
            </div>
            <div class="modal-body text-center px-4 py-4 my-md-3">
                <p>{{ session()->get('isUniv') }}  <span style="color: var(--red)">*</span></p>
            </div>
        </div>
        </div>
    </div>
    @endif
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $("#info-univ").modal('show');
        });
    </script>
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
