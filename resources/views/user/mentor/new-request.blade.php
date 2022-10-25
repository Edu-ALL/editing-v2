@extends('user.mentor.utama.utama')
@section('css')
    {{-- <link rel="stylesheet" href="/css/admin/essay-completed.css"> --}}
    {{-- <link rel="stylesheet" href="/css/mentor/user-editor-add.css"> --}}
    {{-- <link rel="stylesheet" href="/css/mentor/user-mentor.css"> --}}
    <link rel="stylesheet" href="/css/mentor/new-request.css">
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
@endsection
@section('content')
    <div class="container-fluid" style="padding: 0">
        <div class="row flex-nowrap main" id="main">
            @include('user.mentor.utama.menu')
            {{-- Content --}}
            <div class="col" style="overflow: auto !important">
                @include('user.mentor.utama.head')
                <div class="container main-content m-0">
                    <form action="{{ route('save-new-request') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            @if (session()->has('add-new-request-successful'))
                                <div class="alert alert-success fade show" role="alert">
                                    {{ session()->get('add-new-request-successful') }}
                                </div>
                            @endif

                            <div class="col-md col-12 p-0 studentList">
                                <div class="headline d-flex justify-content-between">
                                    <div class="col d-flex align-items-center gap-md-3 gap-2">
                                        <img src="/assets/new-request.png" alt="">
                                        <h6 style="color: var(--white); font-weight: 500">Add New Request</h6>
                                    </div>
                                </div>
                                <div class="row profile-editor flex-md-row flex-column px-md-5 py-md-4 px-3 py-4 gap-3">
                                    <div class="col new-request d-flex flex-column justify-content-center gap-3">
                                        <div class="col-12 d-flex">
                                            <div class="col-12">
                                                <h6 class="pb-2">Essay Title :</h6>
                                                <input type="text" value="Essay Editing"
                                                    class="form-control inputField" name="essay_title" disabled readonly style="width: 96.5%; font-size: 13px; padding: 0.375rem 0.75rem; border-radius: .25rem;">
                                            </div>
                                        </div>

                                        <div class="text-area">

                                            <div class="col-12">
                                                <h6 class="pb-2">Request (Editor) :</h6>
                                                <select class="select-normal" style="width: 96.5%;"
                                                    name="id_editors">
                                                    <option value=""></option>
                                                    @foreach ($request_editor->where('status', 1) as $editor)
                                                        @if ($editor->id_editors != '')
                                                            <option value="{{ $editor->id_editors }}">
                                                                {{ $editor->first_name.' '.$editor->last_name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>


                                        </div>
                                        <div class="text-area">
                                            <div class="col-12">
                                                <h6 class="pb-2">University Name :</h6>
                                                <select class="select-normal" style="width: 96.5%;" name="id_univ">
                                                    <option value=""></option>
                                                    @foreach ($university as $uni)
                                                        @if ($uni->id_univ != '')
                                                            <option value="{{ $uni->id_univ }}">
                                                                {{ $uni->university_name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col new-request d-flex flex-column justify-content-center gap-lg-3 gap-2">
                                        <div class="text-area">
                                            <div class="col-12">
                                                <h6 class="pb-2">Student Name :</h6>
                                                <select class="select-normal" style="width: 96.5%;"
                                                    name="id_clients">
                                                    <option value=""></option>
                                                    @foreach ($clients as $client)
                                                        @if ($client->id_clients != '')
                                                            <option value="{{ $client->id_clients }}">
                                                                {{ $client->first_name . ' ' . $client->last_name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="text-area">
                                            <div class="col-12">
                                                <h6 class="pb-2">Number of Words :</h6>
                                                <select class="select-normal" style="width: 96.5%;"
                                                    name="number_of_word">
                                                    <option value=""></option>
                                                    @foreach ($program as $word)
                                                        @if ($word->id_program != '')
                                                            <option value="{{ $word->id_program }}">
                                                                {{ $word->minimum_word . ' - ' . $word->maximum_word }}
                                                                Words
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="text-area">
                                            <div class="col-12">
                                                <h6 class="pb-2">Essay Type :</h6>
                                                <select class="select-normal" style="width: 96.5%;"
                                                    name="essay_title">
                                                    <option value=""></option>
                                                    <option value="Common App">Common App</option>
                                                    <option value="Coalition App">Coalition App</option>
                                                    <option value="UCAS">UCAS</option>
                                                    <option value="Personal Statement">Personal Statement</option>
                                                    <option value="Suplemental Essay">Suplemental Essay</option>
                                                    <option value="Digital Team Blog Post">Digital Team Blog Post</option>
                                                    <option value="Common App">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row student-addition px-md-5 px-3">
                                    {{-- Text Area --}}
                                    <div class="col-12 d-flex" style="overflow: auto !important">
                                        <div class="col">
                                            <h6 class="pb-2">Essay Prompt :</h6>
                                            <textarea name="essay_prompt" class="textarea" placeholder="Essay Prompt"></textarea>
                                        </div>
                                    </div>
                                    <div class="row pb-md-0 pb-4 mt-4 gap-3">
                                        <div class="col d-flex flex-column justify-content-center gap-lg-3 gap-2">
                                            <div class="text-area mb-3">
                                                <h6 class="pb-2">Essay Deadline :</h6>
                                                <div class="col">
                                                    <input type="date" name="essay_deadline"
                                                        class="form-control inputField py-2 px-2" placeholder="Search" min="<?= date("Y-m-d", strtotime("+1days")); ?>" style="width: 96.5%;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col d-flex flex-column justify-content-center gap-lg-3 gap-2">
                                            <div class="text-area mb-3">
                                                <h6 class="pb-2">Application Deadline :</h6>
                                                <div class="col">
                                                    <input type="date" name="application_deadline"
                                                        class="form-control inputField py-2 px-2" placeholder="Search" min="<?= date("Y-m-d", strtotime("+1days")); ?>" style="width: 96.5%;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- End Text Area --}}
                                </div>
                                <div class="row px-md-5 px-3 mb-4">
                                    <div class="col-md-6 new-request d-flex flex-column justify-content-center gap-lg-3 gap-2">
                                        <div class="text-area mb-3">
                                            <h6 class="pb-2">File :</h6>
                                            <div class="col">
                                                <input type="file" name="attached_of_clients"
                                                    class="form-control inputField py-1 px-2" placeholder="Search" style="width: 95%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-center p-4">
                                        <button class="btn btn-create d-flex align-items-center gap-2">
                                            <img src="/assets/upload.png" alt="">
                                            <h6>Upload Student Essay</h6>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                {{-- End Content --}}
            </div>
        </div>
    @endsection
    {{-- @section('js')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.tiny.cloud/1/h7t62ozvqkx2ifkeh051fsy3k9irz7axx1g2zitzpbaqfo8m/tinymce/5/tinymce.min.js"
            referrerpolicy="origin"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            tinymce.init({
                selector: '.textarea',
                width: 'auto',
                height: '300'
            });
        </script>
        <script>
            $(document).ready(function() {
                $('.select2').select2();
            });
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
    @endsection --}}
