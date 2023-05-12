@extends('user.admin.utama.utama')
@section('css')
    <link rel="stylesheet" href="/css/admin/setting-categories.css">
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
            @include('user.admin.utama.menu')

            {{-- Content --}}
            <div class="col" style="overflow: auto !important">
                @include('user.admin.utama.head')
                <div class="container main-content m-0">
                    <div class="row gap-2">

                        @if ($errors->any())
                            {!! implode('', $errors->all('<div class="alert alert-danger" role="alert">:message</div>')) !!}
                        @endif

                        @if (session()->has('add-tag-successful'))
                            <div class="alert alert-success fade show" role="alert">
                                {{ session()->get('add-tag-successful') }}
                            </div>
                        @elseif (session()->has('update-tag-successful'))
                            <div class="alert alert-success fade show" role="alert">
                                {{ session()->get('update-tag-successful') }}
                            </div>
                        @elseif (session()->has('delete-tag-successful'))
                            <div class="alert alert-success fade show" role="alert">
                                {{ session()->get('delete-tag-successful') }}
                            </div>
                        @endif

                        <div class="col-md col-12 p-0 userCard profile">
                            <div class="headline d-flex align-items-center gap-3">
                                <img src="/assets/add.png" alt="">
                                <h6>Add Categories / Tags</h6>
                            </div>
                            <form action="{{ route('add-tag') }}" method="POST">
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

                        <div class="col-md-8 col-12 p-0 userCard">
                            <div class="headline d-flex justify-content-between" style="padding: 20px 24px !important">
                                {{-- <div class="col d-flex align-items-center gap-md-3 gap-2">
                <img src="/assets/tags.png" alt="">
                <h6>Categories / Tags</h6>
              </div> --}}
                                <div class="col-md-6 col-5 d-flex align-items-center gap-md-3 gap-2">
                                    <img src="/assets/tags.png" alt="">
                                    <h6>Categories / Tags</h6>
                                </div>
                                <div class="col-md-4 col-6 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                                    <div class="input-group">
                                    </div>
                                </div>
                            </div>
                            <div class="container text-start px-0 py-2">
                                <table class="table table-bordered" id="listcategories" style="width: 100%">
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
            {{-- End Content --}}
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#listcategories').DataTable({
                scrollX: true,
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{{ route('data-list-tag') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        class: 'text-center'
                    },
                    {
                        data: 'category_name',
                        name: 'category_name'
                    },
                ],
                rowCallback: function(row, data) {
                    $(row).on('click', function() {
                        window.location.href =
                            `/admin/setting/categories-tags/detail/${data.id_topic}`;
                    });
                }
            });
        });
    </script>
@stop
