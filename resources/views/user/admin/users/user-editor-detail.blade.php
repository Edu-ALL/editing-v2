@extends('user.admin.utama.utama')
@section('css')
    <link rel="stylesheet" href="/css/admin/user-editor-detail.css">
    <style>
        .pagination {
            margin: 15px 0
        }

        .pagination .page-item .page-link {
            padding: 10px 15px;
            font-size: 12px;
        }

        .alert {
            font-size: 14px
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

                    @if (session()->has('update-editor-successful'))
                        <div class="row alert alert-success fade show d-flex justify-content-between" role="alert">
                            {{ session()->get('update-editor-successful') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="row gap-2">
                        <div class="col-md col-12 p-0 userCard profile">
                            <div class="headline d-flex align-items-center gap-3">
                                <img src="/assets/pic.png" alt="">
                                <h6>Editor</h6>
                            </div>
                            <div class="col d-flex align-items-center justify-content-center py-md-4 py-4">
                                <div class="pic-profile">
                                    <img class="img-fluid" src="/assets/editor-bg.png" alt="">
                                </div>
                            </div>
                            <div class="col d-flex align-items-center justify-content-center pb-md-3 pb-3">
                                <form
                                    action="{{ route($editor->status == 1 ? 'deactivate-editor' : 'activate-editor', ['id_editors' => $editor->id_editors]) }}"
                                    method="POST" class="p-0">
                                    @csrf
                                    <button class="btn btn-deactivated d-flex align-items-center gap-2">
                                        <h6>{{ $editor->status == 1 ? 'Deactivated' : 'Activated' }}</h6>
                                    </button>
                                </form>

                            </div>
                            <div class="headline d-flex align-items-center gap-3" style="background-color: var(--green)">
                                <img src="/assets/completed-essay.png" alt="">
                                <h6>Completed Essay</h6>
                            </div>
                            <div class="col d-flex flex-column px-3 py-md-5 py-4 gap-2 countEssay text-center justify-content-center"
                                style="color: var(--green)">
                                <h4>{{ $essay_completed->count() }}</h4>
                                <h4>Completed Essay</h4>
                            </div>
                            <div class="headline d-flex align-items-center gap-3" style="background-color: var(--yellow)">
                                <img src="/assets/star.png" alt="">
                                <h6>Rating</h6>
                            </div>
                            <div
                                class="col d-flex flex-column px-3 py-md-5 py-4 gap-2 countEssay text-center aling-items-center justify-content-center gap-3">
                                <h4 style="color: var(--yellow)">{{ $average_rating }} / 5</h4>
                                <div class="col d-flex flex-row justify-content-center">
                                    @if ($average_rating == 0)
                                        <img class="rating" src="/assets/rating.png" alt="">
                                        <img class="rating" src="/assets/rating.png" alt="">
                                        <img class="rating" src="/assets/rating.png" alt="">
                                        <img class="rating" src="/assets/rating.png" alt="">
                                        <img class="rating" src="/assets/rating.png" alt="">
                                    @elseif ($average_rating > 0 && $average_rating <= 0.5)
                                        <img class="rating" src="/assets/rating-half.png" alt="">
                                        <img class="rating" src="/assets/rating.png" alt="">
                                        <img class="rating" src="/assets/rating.png" alt="">
                                        <img class="rating" src="/assets/rating.png" alt="">
                                        <img class="rating" src="/assets/rating.png" alt="">
                                    @elseif ($average_rating > 0.5 && $average_rating <= 1)
                                        <img class="rating" src="/assets/rating-fill.png" alt="">
                                        <img class="rating" src="/assets/rating.png" alt="">
                                        <img class="rating" src="/assets/rating.png" alt="">
                                        <img class="rating" src="/assets/rating.png" alt="">
                                        <img class="rating" src="/assets/rating.png" alt="">
                                    @elseif ($average_rating > 1 && $average_rating <= 1.5)
                                        <img class="rating" src="/assets/rating-fill.png" alt="">
                                        <img class="rating" src="/assets/rating-half.png" alt="">
                                        <img class="rating" src="/assets/rating.png" alt="">
                                        <img class="rating" src="/assets/rating.png" alt="">
                                        <img class="rating" src="/assets/rating.png" alt="">
                                    @elseif ($average_rating > 1.5 && $average_rating <= 2)
                                        <img class="rating" src="/assets/rating-fill.png" alt="">
                                        <img class="rating" src="/assets/rating-fill.png" alt="">
                                        <img class="rating" src="/assets/rating.png" alt="">
                                        <img class="rating" src="/assets/rating.png" alt="">
                                        <img class="rating" src="/assets/rating.png" alt="">
                                    @elseif ($average_rating > 2 && $average_rating <= 2.5)
                                        <img class="rating" src="/assets/rating-fill.png" alt="">
                                        <img class="rating" src="/assets/rating-fill.png" alt="">
                                        <img class="rating" src="/assets/rating-half.png" alt="">
                                        <img class="rating" src="/assets/rating.png" alt="">
                                        <img class="rating" src="/assets/rating.png" alt="">
                                    @elseif ($average_rating > 2.5 && $average_rating <= 3)
                                        <img class="rating" src="/assets/rating-fill.png" alt="">
                                        <img class="rating" src="/assets/rating-fill.png" alt="">
                                        <img class="rating" src="/assets/rating-fill.png" alt="">
                                        <img class="rating" src="/assets/rating.png" alt="">
                                        <img class="rating" src="/assets/rating.png" alt="">
                                    @elseif ($average_rating > 3 && $average_rating <= 3.5)
                                        <img class="rating" src="/assets/rating-fill.png" alt="">
                                        <img class="rating" src="/assets/rating-fill.png" alt="">
                                        <img class="rating" src="/assets/rating-fill.png" alt="">
                                        <img class="rating" src="/assets/rating-half.png" alt="">
                                        <img class="rating" src="/assets/rating.png" alt="">
                                    @elseif ($average_rating > 3.5 && $average_rating <= 4)
                                        <img class="rating" src="/assets/rating-fill.png" alt="">
                                        <img class="rating" src="/assets/rating-fill.png" alt="">
                                        <img class="rating" src="/assets/rating-fill.png" alt="">
                                        <img class="rating" src="/assets/rating-fill.png" alt="">
                                        <img class="rating" src="/assets/rating.png" alt="">
                                    @elseif ($average_rating > 4 && $average_rating <= 4.5)
                                        <img class="rating" src="/assets/rating-fill.png" alt="">
                                        <img class="rating" src="/assets/rating-fill.png" alt="">
                                        <img class="rating" src="/assets/rating-fill.png" alt="">
                                        <img class="rating" src="/assets/rating-fill.png" alt="">
                                        <img class="rating" src="/assets/rating-half.png" alt="">
                                    @elseif ($average_rating > 4.5 && $average_rating <= 5)
                                        <img class="rating" src="/assets/rating-fill.png" alt="">
                                        <img class="rating" src="/assets/rating-fill.png" alt="">
                                        <img class="rating" src="/assets/rating-fill.png" alt="">
                                        <img class="rating" src="/assets/rating-fill.png" alt="">
                                        <img class="rating" src="/assets/rating-fill.png" alt="">
                                    @endif
                                </div>
                                {{-- <h4>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star half"></span>
                <span class="fa fa-star"></span>
              </h4> --}}
                                @if ($average_rating == 0)
                                    <h4 class="d-block" style="color: var(--yellow)">-</h4>
                                @elseif ($average_rating >= 0.5 && $average_rating <= 0.9)
                                    <h4 class="d-block" style="color: var(--yellow)">Horrific</h4>
                                @elseif ($average_rating >= 1 && $average_rating <= 1.4)
                                    <h4 class="d-block" style="color: var(--yellow)">Awful</h4>
                                @elseif ($average_rating >= 1.5 && $average_rating <= 1.9)
                                    <h4 class="d-block" style="color: var(--yellow)">Very Bad</h4>
                                @elseif ($average_rating >= 2 && $average_rating <= 2.4)
                                    <h4 class="d-block" style="color: var(--yellow)">Bad</h4>
                                @elseif ($average_rating >= 2.5 && $average_rating <= 2.9)
                                    <h4 class="d-block" style="color: var(--yellow)">Unsatisfactory</h4>
                                @elseif ($average_rating >= 3 && $average_rating <= 3.4)
                                    <h4 class="d-block" style="color: var(--yellow)">Satisfactory</h4>
                                @elseif ($average_rating >= 3.5 && $average_rating <= 3.9)
                                    <h4 class="d-block" style="color: var(--yellow)">Good</h4>
                                @elseif ($average_rating >= 4 && $average_rating <= 4.4)
                                    <h4 class="d-block" style="color: var(--yellow)">Very Good</h4>
                                @elseif ($average_rating >= 4.5 && $average_rating <= 4.9)
                                    <h4 class="d-block" style="color: var(--yellow)">Excellent</h4>
                                @elseif ($average_rating == 5)
                                    <h4 class="d-block" style="color: var(--yellow)">Awesome</h4>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-8 col-12 p-0 userCard">
                            <div class="headline d-flex justify-content-between">
                                <div class="col-md-6 col-8 d-flex align-items-center gap-3">
                                    <img src="/assets/edit.png" alt="">
                                    <h6>View Editor</h6>
                                </div>
                                <div class="col-md-4 col-4 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                                    <a href="/admin/user/editor"><img src="/assets/back.png" alt=""></a>
                                </div>
                            </div>

                            <div class="row profile-editor px-md-3 py-md-4 px-3 py-4" style="overflow: auto !important">
                                <form action="{{ route('update-editor', ['id_editors' => $editor->id_editors]) }}"
                                    method="POST" class="p-0">
                                    @csrf
                                    <div class="col-12 d-flex mb-3">
                                        <div class="col-6">
                                            <h6 class="pb-2">First Name :</h6>
                                            <input type="text" class="form-control inputField py-2 px-3" disabled
                                                value="{{ $editor->first_name }}">
                                        </div>
                                        <div class="col-6">
                                            <h6 class="pb-2">Last Name :</h6>
                                            <input type="text" class="form-control inputField py-2 px-3" disabled
                                                value="{{ $editor->last_name }}">
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex mb-3">
                                        <div class="col-6">
                                            <h6 class="pb-2">Email :</h6>
                                            <input type="email" class="form-control inputField py-2 px-3" disabled
                                                value="{{ $editor->email }}">
                                        </div>
                                        <div class="col-6">
                                            <h6 class="pb-2">Phone :</h6>
                                            <input type="text" class="form-control inputField py-2 px-3" disabled
                                                value="{{ $editor->phone }}">
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex mb-3">
                                        <div class="col-6">
                                            <h6 class="pb-2">Graduated From :</h6>
                                            <input type="text" class="form-control inputField py-2 px-3" disabled
                                                value="{{ $editor->graduated_from }}">
                                        </div>
                                        <div class="col-6">
                                            <h6 class="pb-2">Major :</h6>
                                            <input type="text" class="form-control inputField py-2 px-3" disabled
                                                value="{{ $editor->major }}">
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex mb-3" style="overflow: auto !important">
                                        <div class="col">
                                            <h6 class="pb-2">Address :</h6>
                                            <textarea name="" class="textarea">{{ $editor->address }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex mb-5">
                                        <div class="col">
                                            <h6 class="pb-2">Position :</h6>
                                            <select class="select-beast" name="position">
                                                <option value="1" @if ($editor->position == 1) selected @endif>
                                                    Associate</option>
                                                <option value="2" @if ($editor->position == 2) selected @endif>
                                                    Senior</option>
                                                <option value="3" @if ($editor->position == 3) selected @endif>
                                                    Managing</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-center pt-3"
                                        style="border-top: 1px solid var(--light-grey)">
                                        <button class="btn btn-create d-flex align-items-center gap-2">
                                            <img src="/assets/update.png" alt="">
                                            <h6>Update Editor</h6>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-2">
                        <div class="col-md col-12 p-0 essayList">
                            <div class="headline d-flex justify-content-between">
                                <div class="col-md-6 col-7 d-flex align-items-center gap-3">
                                    <img src="/assets/ongoing-essay.png" alt="">
                                    <h6>Processed Essay Editing</h6>
                                </div>
                            </div>
                            <div class="container text-start px-3 py-2">
                                <table class="table table-bordered" id="listdetailessayongoing" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Student Name</th>
                                            <th>Program Name</th>
                                            <th>Essay Title</th>
                                            <th>Essay Deadline</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-2">
                        <div class="col-md col-12 p-0 essayList">
                            <div class="headline d-flex justify-content-between" style="background-color: var(--green)">
                                <div class="col-md-6 col-7 d-flex align-items-center gap-3">
                                    <img src="/assets/completed-essay.png" alt="">
                                    <h6>Completed Essay Editing</h6>
                                </div>
                            </div>
                            <div class="container text-start px-3 py-2">
                                <table class="table table-bordered" id="listdetailessaycompleted" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Student Name</th>
                                            <th>Program Name</th>
                                            <th>Essay Title</th>
                                            <th>Essay Deadline</th>
                                            <th>Status</th>
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
        // List Editor
        $(document).ready(function() {
            $('#listdetailessayongoing').DataTable({
                scrollX: true,
                responsive: true,
                processing: true,
                serverSide: true,
                "pageLength": 5,
                "lengthMenu": [5, 10, 25, 50],
                ajax: '{{ route('data-detail-essay-ongoing', $editor->id_editors) }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        class: 'text-center',
                    },
                    {
                        data: 'student_name',
                        name: 'student_name',
                        class: 'text-center'
                    },
                    {
                        data: 'program',
                        name: 'program',
                        class: 'text-center'
                    },
                    {
                        data: 'essay_title',
                        name: 'essay_title',
                        class: 'text-center'
                    },
                    {
                        data: 'essay_deadline',
                        name: 'essay_deadline',
                        class: 'text-center'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        class: 'text-center'
                    },
                ],
            });
        });

        $(document).ready(function() {
            $('#listdetailessaycompleted').DataTable({
                scrollX: true,
                responsive: true,
                processing: true,
                serverSide: true,
                "pageLength": 5,
                "lengthMenu": [5, 10, 25, 50],
                ajax: '{{ route('data-detail-essay-completed', $editor->id_editors) }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        class: 'text-center',
                    },
                    {
                        data: 'student_name',
                        name: 'student_name',
                        class: 'text-center'
                    },
                    {
                        data: 'program',
                        name: 'program',
                        class: 'text-center'
                    },
                    {
                        data: 'essay_title',
                        name: 'essay_title',
                        class: 'text-center'
                    },
                    {
                        data: 'essay_deadline',
                        name: 'essay_deadline',
                        class: 'text-center'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        class: 'text-center'
                    },
                ],
            });
        });
    </script>
    <script type="text/javascript">
        $("#form-ongoing-essay-searching").keypress(function(e) {
            if (e.keyCode === 13) {
                swal.showLoading();
                e.preventDefault();
                $("#form-ongoing-essay-searching").submit();
            }
        });
        $("#form-completed-essay-searching").keypress(function(e) {
            if (e.keyCode === 13) {
                swal.showLoading();
                e.preventDefault();
                $("#form-completed-essay-searching").submit();
            }
        });
    </script>
@stop
