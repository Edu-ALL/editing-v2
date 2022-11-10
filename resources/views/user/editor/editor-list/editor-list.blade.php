@extends('user.editor.utama.utama')
@section('css')
    <link rel="stylesheet" href="/css/admin/user-editor.css">
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
            <div class="col">
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
                                    <form action="{{ route('list-editor') }}"
                                        method="GET" role="search" class="w-100">
                                        <input type="search" class="form-control inputField py-2 px-3"
                                            name="keyword" placeholder="Search">
                                    </form>
                                </div>
                            </div>
                            <div class="container text-center" style="overflow-x: auto !important">
                                <table class="table table-bordered">
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
                                    <tbody>
                                        <?php $i = ($editors->currentpage() - 1) * $editors->perpage() + 1; ?>
                                        @foreach ($editors as $editor)
                                            <tr
                                                onclick="window.location='/editor/list/detail/{{ $editor->id_editors }}'">
                                                <th scope="row">{{ $i++ }}</th>
                                                <td>{{ $editor->first_name . ' ' . $editor->last_name }}</td>
                                                <td>{{ $editor->email }}</td>
                                                <td>{{ $dueTomorrow->where('id_editors', $editor->id_editors)->count() }} Essays</td>
                                                <td>{{ $dueThree->where('id_editors', $editor->id_editors)->count() }} Essays</td>
                                                <td>{{ $dueFive->where('id_editors', $editor->id_editors)->count() }} Essays</td>
                                                @if ($editor->position == 1)
                                                    <td>Associate</td>
                                                @elseif ($editor->position == 2)
                                                    <td>Senior</td>
                                                @elseif ($editor->position == 3)
                                                    <td>Managing</td>
                                                @endif
                                                @if ($editor->status == 1)
                                                    <td>
                                                        <div class="status-editor">
                                                            Active
                                                        </div>
                                                    </td>
                                                @else
                                                    <td>
                                                        <div class="status-editor" style="background-color: var(--red)">
                                                            Deactive
                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach

                                        @unless(count($editors))
                                            <tr style="cursor: default">
                                                <td colspan="8">No data</td>
                                            </tr>
                                        @endunless
                                    </tbody>
                                </table>
                                {{-- Pagination --}}
                                <div class="d-flex justify-content-center">
                                    {{ $editors->links() }}
                                </div>
                            </div>
                            </table>
                        </div>
                        </a>
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
    $(document).ready(function(){
        $("#info-editor").modal('show');
    });
</script>
@endsection