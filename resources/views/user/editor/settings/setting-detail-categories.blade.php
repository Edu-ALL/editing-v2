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
                        @if ($errors->any())
                            {!! implode('', $errors->all('<div class="alert alert-danger" role="alert">:message</div>')) !!}
                        @endif
                        
                        <div class="col-md col-12 p-0 userCard profile" style="cursor: default">
                            <div class="headline d-flex align-items-center gap-3">
                                <img src="/assets/add.png" alt="">
                                <h6>Add Categories / Tags</h6>
                            </div>
                            <div class="col d-flex profile-editor align-items-center justify-content-center py-md-4 py-4">
                                <div class="col-10">
                                    <h6 class="pb-2">Title :</h6>
                                    <input type="text" name="title" form="form-update" class="form-control w-100 inputField py-2 px-3" value="{{ $tag->topic_name }}">
                                </div>
                            </div>
                            <div class="col d-flex flex-row align-items-center justify-content-center pb-md-3 pb-3 gap-2">
                                <form action="{{ route('update-tags', ['tag_id' => $tag->id_topic]) }}" method="POST" id="form-update" onsubmit="swal.showLoading()">
                                    @csrf
                                    <button class="btn btn-create d-flex align-items-center gap-2"  style="background-color: var(--yellow)">
                                        <img src="/assets/update.png" alt="">
                                        <h6>Update</h6>
                                    </button>
                                </form>
                                <form action="{{ route('delete-tags', ['tag_id' => $tag->id_topic]) }}" method="POST" onsubmit="swal.showLoading()">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-create d-flex align-items-center gap-2" style="background-color: var(--red)">
                                        <img src="/assets/delete.png" alt="">
                                        <h6>Delete</h6>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-8 col-12 p-0 userCard" style="cursor: default">
                            <div class="headline d-flex align-items-center px-md-4 px-3 py-3 gap-md-3 gap-1">
                                <div class="col-md col d-flex align-items-center gap-md-3 gap-2">
                                    <img src="/assets/tags.png" alt="">
                                    <h6 class="mt-md-1">Categories / Tags</h6>
                                </div>
                            </div>
                            <div class="container text-start px-3 py-2">
                                <table class="table" id="listcategories" style="width: 100%">
                                    <thead>
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
@endsection
@section('js')
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