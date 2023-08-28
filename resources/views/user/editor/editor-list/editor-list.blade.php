@extends('user.editor.utama.utama')
@section('css')
    <link rel="stylesheet" href="/css/editor/user-editor.css">
    <style>
        .pagination {
            margin: 15px 0
        }

        .pagination .page-item .page-link {
            padding: 10px 15px;
            font-size: 12px;
        }

        .alert {
            font-size: 14px;
            margin: 0 -12px 12px -12px
        }
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
                    @if (session()->has('deactive-editor-successful'))
                    <div class="row alert alert-success fade show d-flex justify-content-between" role="alert">
                        {{ session()->get('deactive-editor-successful') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @elseif (session()->has('active-editor-successful'))
                    <div class="row alert alert-success fade show d-flex justify-content-between" role="alert">
                        {{ session()->get('active-editor-successful') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    {{-- Table Student --}}
                    <div class="row">
                        <div class="col-md col-12 p-0 studentList">
                            <div class="headline d-flex justify-content-between">
                                <div class="col-md-6 col-5 d-flex align-items-center gap-md-3 gap-2">
                                    <img src="/assets/editor.png" alt="">
                                    <h6>Editor List</h6>
                                </div>
                                
                                <div class="col-md-4 col-6 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                                    <a class="btn-invite" href="/editor/invite">
                                        <img src="/assets/letter.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="container text-start px-3 py-2">
                                <table class="table" id="listeditor" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Editor Name</th>
                                            <th>Email</th>
                                            <th>Due Tomorrow</th>
                                            <th>Due Within 3 Days</th>
                                            <th>Due Within 5 Days</th>
                                            <th>Position</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- End Table Student --}}
                </div>
            </div>
            {{-- End Content --}}
        </div>
    </div>

    {{-- Modal Info --}}
    @if (session()->has('isEditor'))
    <div class="modal fade" id="info-editor" tabindex="-1" show>
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
                <p>{{ session()->get('isEditor') }}  <span style="color: var(--red)">*</span></p>
            </div>
        </div>
        </div>
    </div>
    @endif
@endsection
@section('js')
<script>
    // List Editor
    $(document).ready(function () {
        $('#listeditor').DataTable({
            scrollX: true,
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: '{{ route('managing-data-editor') }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    class: 'text-center'
                },
                {
                    data: 'fullname',
                    name: 'fullname'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'dueTomorrow',
                    name: 'dueTomorrow'
                },
                {
                    data: 'dueThree',
                    name: 'dueThree'
                },
                {
                    data: 'dueFive',
                    name: 'dueFive'
                },
                {
                    data: 'position',
                    name: 'position'
                },
                {
                    data: 'status',
                    name: 'status',
                    class: 'text-center'
                },
            ]
        });
    });
    function getDetail(id){
        var link = '/editor/list/detail/' + id
        window.location.href = link;
    }
    $(document).ready(function(){
        $("#info-editor").modal('show');
    });
</script>
@endsection