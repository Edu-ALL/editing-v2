@extends('user.editor.utama.utama')
@section('css')
    <link rel="stylesheet" href="/css/editor/setting-detail-categories.css">
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
                    <div class="row gap-2">

                        @if ($errors->any())
                            {!! implode('', $errors->all('<div class="alert alert-danger" role="alert">:message</div>')) !!}
                        @endif

                        <div class="col-lg col-12 p-0 userCard profile" style="cursor: default">
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
                            <div class="headline d-flex justify-content-between" style="padding: 20px 24px !important">
                                <div class="col d-flex align-items-center gap-md-3 gap-2">
                                    <img src="/assets/tags.png" alt="">
                                    <h6>Categories / Tags</h6>
                                </div>
                                <div class="col-md-4 col-6 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                                    <div class="input-group">
                                        <form id="form-tag-searching" action="{{ route('list-tag') }}" method="GET"
                                            role="search" class="w-100">
                                            <input type="text" class="form-control inputField py-2 px-3" name="keyword"
                                                id="search-tag" placeholder="Search" required>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="container text-center p-0" style="overflow-x: auto !important">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%">No</th>
                                            <th>Category Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = ($tags->currentpage() - 1) * $tags->perpage() + 1; ?>
                                        @foreach ($tags as $tag)
                                            <tr
                                                onclick="window.location='/editor/setting/categories-tags/detail/{{ $tag->id_topic }}'">
                                                <th scope="row">{{ $i++ }}</th>
                                                <td>{{ $tag->topic_name }}</td>
                                            </tr>
                                        @endforeach

                                        @unless(count($tags))
                                            <tr>
                                                <td colspan="2">No data</td>
                                            </tr>
                                        @endunless
                                    </tbody>
                                </table>
                                {{-- Pagination --}}
                                <div class="d-flex justify-content-center">
                                    {{ $tags->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Content --}}
        </div>
    </div>
@endsection

{{-- @section('js')
    <script>
        $("#update-tag, #delete-tag").click(function() {
            var link = $(this).data('link');
            var method = $(this).data('method');

            if (method == "DELETE") {
                Swal.fire({
                    icon: 'info',
                    title: 'Are you sure want to delete this tag?',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $("input[name=_method]").val(method);
                        $("#update-delete-form").attr('action', link).submit();
                    }
                })
            } else {
                $("input[name=_method]").val(method);
                $("#update-delete-form").attr('action', link).submit();
            }

        })
    </script>
@stop --}}
