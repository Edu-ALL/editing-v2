@extends('user.editor.utama.utama')
@section('css')
    <style>
        .alert {font-size: 14px; margin: 0 -12px 16px 0}
    </style>
@endsection
@section('content')
    <div class="container-fluid p-0">
        <div class="row flex-nowrap main" id="main">
            @include('user.editor.utama.menu')

            {{-- Content --}}
            <div class="col" style="overflow: auto !important">
                @include('user.editor.utama.head')
                <div class="container main-content m-0">
                    <div class="row flex-column gap-4">
                        @if (session()->has('delete-successful'))
                            <div class="row alert alert-success fade show d-flex justify-content-between" role="alert">
                                {{ session()->get('delete-successful') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="col p-0">
                            <div class="col-md col-12 p-0 userCard" style="cursor: default">
                                <div class="headline d-flex align-items-center px-md-4 px-3 py-3 gap-md-3 gap-1">
                                    <div class="col-md col d-flex align-items-center gap-md-3 gap-2">
                                        <img src="/assets/university.png" alt="">
                                        <h6 class="mt-md-1">Universities</h6>
                                    </div>
                                    <div class="col-md col-3 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                                        <a href="/editor/setting/universities/add"><img src="/assets/add.png" alt=""></a>
                                    </div>
                                </div>
                                <div class="container text-start px-3 py-2">
                                    <table class="table" id="listuniversity" style="width: 100%">
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
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
    // List University
    $(document).ready(function () {
        $('#listuniversity').DataTable({
            scrollX: true,
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: '{{ route('managing-data-university') }}',
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    class: 'text-center'
                },
                {
                    data: 'university_name',
                    name: 'university_name'
                },
                {
                    data: 'website',
                    name: 'website'
                },
                {
                    data: 'country',
                    name: 'country'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'image',
                    name: 'image'
                },
            ]
        });
    });
    function getUniversityDetail(id){
        var link = '/editor/setting/universities/detail/' + id
        window.location.href = link;
    }
</script>
@endsection