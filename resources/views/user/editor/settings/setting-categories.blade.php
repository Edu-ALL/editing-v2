@extends('user.editor.utama.utama')
@section('css')
    <link rel="stylesheet" href="/css/editor/setting-categories.css">
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
                    <div class="row gap-2">
                        @if (session()->has('add-tag-successful'))
                            <div class="row alert alert-success fade show d-flex justify-content-between" role="alert">
                                {{ session()->get('add-tag-successful') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @elseif (session()->has('update-tag-successful'))
                            <div class="row alert alert-success fade show d-flex justify-content-between" role="alert">
                                {{ session()->get('update-tag-successful') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @elseif (session()->has('delete-tag-successful'))
                            <div class="row alert alert-success fade show d-flex justify-content-between" role="alert">
                                {{ session()->get('delete-tag-successful') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        
                        <div class="col-md col-12 p-0 userCard profile" style="cursor: default">
                            <div class="headline d-flex align-items-center gap-3">
                                <img src="/assets/add.png" alt="">
                                <h6>Add Categories / Tags</h6>
                            </div>
                            <form action="{{ route('add-tags') }}" method="POST">
                                @csrf
                                <div
                                    class="col d-flex profile-editor align-items-center justify-content-center py-md-4 py-4">
                                    <div class="col-10">
                                        <h6 class="pb-2">Title :</h6>
                                        <input type="text" name="title"
                                            class="form-control w-100 inputField py-2 px-3">
                                    </div>
                                </div>
                                <div class="col d-flex align-items-center justify-content-center pb-md-3 pb-3">
                                    <button type="submit" class="btn btn-create d-flex align-items-center gap-2">
                                        <img src="/assets/add.png" alt="">
                                        <h6>Add New</h6>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-8 col-12 p-0 userCard" style="cursor: default">
                            <div class="headline d-flex align-items-center px-md-4 px-3 py-3 gap-md-3 gap-1">
                                <div class="col-md col d-flex align-items-center gap-md-3 gap-2">
                                    <img src="/assets/tags.png" alt="">
                                    <h6 class="mt-md-1">Categories / Tags</h6>
                                </div>
                            </div>
                            <div class="container-fluid text-start px-3 py-2">
                                <table class="table" id="listcategories" style="width: 100%">
                                    <thead class="text-nowrap">
                                        <tr>
                                            <th style="width: 10%">No</th>
                                            <th>Category Name</th>
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

    {{-- Modal Info --}}
    @if (session()->has('isTag'))
    <div class="modal fade" id="info-tag" tabindex="-1" show>
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
                <p>{{ session()->get('isTag') }}  <span style="color: var(--red)">*</span></p>
            </div>
        </div>
        </div>
    </div>
    @endif
@endsection
@section('js')
<script>
    $(document).ready(function(){
        $("#info-tag").modal('show');
    });
</script>
<script>
    // List University
    $(document).ready(function () {
        $('#listcategories').DataTable({
            scrollX: true,
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: '{{ route('managing-data-categories') }}',
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    class: 'text-center'
                },
                {
                    data: 'topic_name',
                    name: 'topic_name'
                },
            ]
        });
    });
    function getCategoriesDetail(id){
        var link = '/editor/setting/categories-tags/detail/' + id
        window.location.href = link;
    }
</script>
@endsection