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
            margin: 0 -12px 16px -12px
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row flex-nowrap main">
            @include('user.editor.utama.menu')

            {{-- Content --}}
            <div class="col">
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
                            <a href="">
                                <h6 class="pt-1 d-none d-md-inline">Editor Name</h6>
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
                                    <img src="/assets/editor.png" alt="">
                                    <h6>Editor List</h6>
                                </div>
                                <div class="col-md-4 col-6 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                                    {{-- <img src="/assets/reload.png" alt=""> --}}
                                    <div class="input-group">
                                        <input type="email" class="form-control inputField py-2 px-3"
                                            placeholder="Search">
                                    </div>
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
                                                onclick="window.location='/admin/user/editor/detail/{{ $editor->id_editors }}'">
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
                                                            Deleted
                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
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
@endsection
