@extends('user.mentor.utama.utama')
@section('css')
    {{-- <link rel="stylesheet" href="/css/admin/essay-completed.css"> --}}
    <link rel="stylesheet" href="/css/mentor/user-editor-add.css">
    <link rel="stylesheet" href="/css/mentor/user-mentor.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="container-fluid" style="padding: 0">
        <div class="row flex-nowrap main">
            @include('user.mentor.utama.menu')
            {{-- Content --}}
            <div class="col" style="overflow: auto !important">
                @include('user.mentor.utama.head')
                <div class="container main-content m-0">
                    <form action="#">
                        {{-- Detail Student --}}
                        <div class="row">
                            <div class="col-md col-12 p-0 studentList">
                                <div class="headline d-flex justify-content-between">
                                    <div class="col-md-6 col-5 d-flex align-items-center gap-md-3 gap-2">
                                        <img src="/assets/student.png" alt="">
                                        <h6>New Request Essay</h6>
                                    </div>
                                    <div
                                        class="col-md-4 col-6 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                                        <a href="/admin/user/student"><img src="/assets/back.png" alt=""></a>
                                    </div>
                                </div>
                                <div class="row profile-editor px-md-3 py-md-4 px-3 py-4" style="overflow: auto !important">
                                    <div
                                        class="col-md-6 new-request d-flex flex-column justify-content-center gap-lg-3 gap-2 ps-md-5 px-4">
                                        <div class="col-12 d-flex mb-3">
                                            <div class="col-12">
                                                <h6 class="pb-2">Essay Title :</h6>
                                                <input type="text" value="Essay Editing"
                                                    class="form-control inputField py-2 px-3" name="essay_title" disabled
                                                    readonly>
                                            </div>
                                        </div>

                                        <div class="text-area p-md-1 mb-3">

                                            <div class="col-12">
                                                <h6 class="pb-2">Request (Editor) :</h6>
                                                <select class="form-control select2" style="width: 96.5%;"
                                                    name="id_editors">
                                                    <option value=""></option>
                                                    @foreach ($request_editor as $editor)
                                                        @if ($editor->id_editors != '')
                                                            <option value="{{ $editor->id_editors }}">
                                                                {{ $editor->first_name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>


                                        </div>
                                        <div class="text-area p-md-1 mb-3">
                                            <div class="col-12">
                                                <h6 class="pb-2">University Name :</h6>
                                                <select class="form-control select2" style="width: 96.5%;" name="id_univ">
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
                                    <div
                                        class="col-md-6 new-request d-flex flex-column justify-content-center gap-lg-3 gap-2 ps-md-5 px-4">
                                        <div class="text-area p-md-1 mb-3">
                                            <div class="col-12">
                                                <h6 class="pb-2">Student Name :</h6>
                                                <select class="form-control select2" style="width: 96.5%;"
                                                    name="id_clients">
                                                    <option value=""></option>
                                                    @foreach ($client as $user)
                                                        @if ($user->id_clients != '')
                                                            <option value="{{ $user->id_clients }}">
                                                                {{ $user->client_by_id->first_name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="text-area p-md-1 mb-3">
                                            <div class="col-12">
                                                <h6 class="pb-2">Number of Words :</h6>
                                                <select class="form-control select2" style="width: 96.5%;"
                                                    name="number_of_words">
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
                                        <div class="text-area p-md-1 mb-3">
                                            <div class="col-12">
                                                <h6 class="pb-2">Essay Type :</h6>
                                                <select class="form-control select2" style="width: 96.5%;"
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

                                <div class="row student-addition p-md-5 p-3">
                                    {{-- Text Area --}}
                                    <div class="col-12 d-flex mb-3" style="overflow: auto !important">
                                        <div class="col">
                                            <h6 class="pb-2">Essay Prompt :</h6>
                                            <textarea name="essays_prompt" class="textarea" placeholder="Essay Prompt"></textarea>
                                        </div>
                                    </div>
                                    <div class="row pb-md-0 pb-4 mt-4">
                                        <div
                                            class="col-md-6 new-request d-flex flex-column justify-content-center gap-lg-3 gap-2">
                                            <div class="text-area p-md-1 mb-3">
                                                <h6 class="pb-3">Essay Deadline :</h6>
                                                <div class="col-7">
                                                    <input type="date" name="essay_deadline"
                                                        class="form-control inputField py-1 px-2" placeholder="Search">
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="col-md-6 new-request d-flex flex-column justify-content-center gap-lg-3 gap-2 ps-md-5 px-4">
                                            <div class="text-area p-md-1 mb-3">
                                                <h6 class="pb-3">Application Deadline :</h6>
                                                <div class="col-7">
                                                    <input type="date" name="application_deadline"
                                                        class="form-control inputField py-1 px-2" placeholder="Search">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- End Text Area --}}
                                </div>
                                <div class="row px-md-5 mb-4">
                                    <div class="row pb-md-0 pb-4">
                                        <div
                                            class="col-md-6 new-request d-flex flex-column justify-content-center gap-lg-3 gap-2">
                                            <div class="text-area p-md-1 mb-3">
                                                <h6 class="pb-3">File :</h6>
                                                <div class="col-7">
                                                    <input type="file" name="essay_deadline"
                                                        class="form-control inputField py-1 px-2" placeholder="Search">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 d-flex justify-content-center p-4">
                                            <button class="btn btn-create d-flex align-items-center gap-2">
                                                <img src="/assets/reload.png" alt="">
                                                <h6>Update Editor</h6>
                                            </button>
                                        </div>
                                    </div>
                                    {{-- End Text Area --}}
                                </div>
                                {{-- <div class="col-12 d-flex justify-content-center pt-3">
                                    <button class="btn btn-create d-flex align-items-center gap-2">
                                        <img src="/assets/reload.png" alt="">
                                        <h6>Update Editor</h6>
                                    </button>
                                </div> --}}
                            </div>
                            {{-- End Detail Student --}}
                        </div>
                    </form>
                </div>
                {{-- End Content --}}
            </div>
        </div>
    @endsection
    @section('js')
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
    @endsection
