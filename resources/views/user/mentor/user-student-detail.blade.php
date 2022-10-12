@extends('user.mentor.utama.utama')
@section('css')
    <link rel="stylesheet" href="/css/mentor/user-student-detail.css">
    <link rel="stylesheet" href="/css/mentor/user-editor-add.css">
    <link rel="stylesheet" href="/css/mentor/user-mentor.css">
@endsection
@section('content')
    <div class="container-fluid" style="padding: 0">
        <div class="row flex-nowrap main">
            @include('user.mentor.utama.menu')
            {{-- Content --}}
            <div class="col" style="overflow: auto !important">
                @include('user.mentor.utama.head')
                <div class="container main-content m-0">
                    {{-- Detail Student --}}
                    <div class="row">
                        <div class="col-md col-12 p-0 studentList">
                            <div class="headline d-flex justify-content-between">
                                <div class="col-md-6 col-5 d-flex align-items-center gap-md-3 gap-2">
                                    <img src="/assets/student.png" alt="">
                                    <h6>Students</h6>
                                </div>
                                <div class="col-md-4 col-6 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                                    <a href="/mentor/user/student"><img src="/assets/back.png" alt=""></a>
                                </div>
                            </div>
                            <div class="row student-info pb-md-0 pb-4">
                                <div class="col-md-4 d-flex align-items-center justify-content-center py-md-0 py-4">
                                    <div class="pic-profile">
                                        <img class="img-fluid" src="/assets/student-bg.png" alt="">
                                    </div>
                                </div>
                                <div
                                    class="col-md-8 student-desc d-flex flex-column justify-content-center gap-lg-3 gap-2 ps-md-5 px-4">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-md-3 col-4">
                                            <h6>Full Name</h6>
                                        </div>
                                        <div class="col-1 titik2">
                                            <p>:</p>
                                        </div>
                                        <div class="col-7">
                                            <p>{{ $client->first_name . ' ' . $client->last_name }}</p>
                                        </div>
                                    </div>
                                    <div class="row d-flex align-items-center">
                                        <div class="col-md-3 col-4">
                                            <h6>Phone Number</h6>
                                        </div>
                                        <div class="col-1 titik2">
                                            <p>:</p>
                                        </div>
                                        <div class="col-7">
                                            <p>{{ $client->phone }}</p>
                                        </div>
                                    </div>
                                    <div class="row d-flex align-items-center">
                                        <div class="col-md-3 col-4">
                                            <h6>Email</h6>
                                        </div>
                                        <div class="col-1 titik2">
                                            <p>:</p>
                                        </div>
                                        <div class="col-7">
                                            <p>{{ $client->email }}</p>
                                        </div>
                                    </div>
                                    <div class="row d-flex align-items-center">
                                        <div class="col-md-3 col-4">
                                            <h6>Address</h6>
                                        </div>
                                        <div class="col-1 titik2">
                                            <p>:</p>
                                        </div>
                                        <div class="col-7">
                                            <p>{{ $client->address }}</p>
                                        </div>
                                    </div>
                                    <div class="row d-flex align-items-center">
                                        <div class="col-md-3 col-4">
                                            <h6>Mentor Name</h6>
                                        </div>
                                        <div class="col-1 titik2">
                                            <p>:</p>
                                        </div>
                                        <div class="col-7">
                                            <p>{{ $client->mentors->first_name . ' ' . $client->mentors->last_name }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row student-addition p-md-5 p-3">
                                <form action="{{ route('update-student', ['id' => $client->id_clients]) }}" method="POST">
                                    @csrf
                                    {{-- Text Area --}}
                                    <div class="text-area p-md-1 mb-3">
                                        <h6 class="pb-3">Personal Brand Statement :</h6>
                                        <textarea name="personal_brand" class="textarea" placeholder="Presonal Brand Statement"> {{ $client->personal_brand }}</textarea>
                                    </div>
                                    <div class="text-area p-md-1 mb-3">
                                        <h6 class="pb-3">Academic Goals & Interest :</h6>
                                        <textarea name="interests" class="textarea" placeholder="Academic Goals & Interest"> {{ $client->interests }}</textarea>
                                    </div>
                                    <div class="text-area p-md-1 mb-3">
                                        <h6 class="pb-3">Life Philosophy (Values) & Personalities :</h6>
                                        <textarea name="personalities" class="textarea" placeholder="Life Philosophy (Values) & Personalities"> {{ $client->personalities }}</textarea>
                                    </div>
                                    <div class="col-md-12 d-flex justify-content-center p-4">
                                        <button class="btn btn-create d-flex align-items-center gap-2">
                                            <img src="/assets/reload.png" alt="">
                                            <h6>Update Student Data</h6>
                                        </button>
                                    </div>
                                </form>
                                {{-- End Text Area --}}
                                {{-- Attachment --}}
                                <div
                                    class="col-lg-2 col-3 mb-lg-4 mb-3 attachment d-flex align-items-center justify-content-center">
                                    <h6 class="text-center">Attachment</h6>
                                </div>

                                <div
                                    class="row d-flex flex-lg-row flex-column attachment-status gap-lg-0 gap-2 ps-lg-0 ps-2 mb-3">
                                    {{-- <div class="text-area p-md-1 mb-3">
                                        <h6 class="pb-3">File :</h6>
                                        <div class="col-lg-3">
                                            <input type="file" name="attached_of_clients"
                                                class="form-control inputField py-1 px-2" placeholder="Search">
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-4 me-2">
                                        <h6>Activities Resume<span class="px-2">:</span>
                                            @if (empty($client->resume))
                                                <span style="color: var(--red)">Not Available</span>
                                                <br>
                                                <input type="file" name="attached_of_clients"
                                                    class="form-control inputField py-1 px-2" placeholder="Search">
                                            @else
                                                <div class="col-lg-3">
                                                    <input type="file" name="attached_of_clients"
                                                        class="form-control inputField py-1 px-2" placeholder="Search"
                                                        value="{{ $client->resume }}">
                                                </div>
                                            @endif
                                        </h6>
                                    </div>
                                    <div class="col-lg">
                                        <h6>Questionnaire<span class="px-2">:</span><span style="color: var(--red)">Not
                                                Available</span></h6>
                                    </div>
                                    <div class="col-lg">
                                        <h6>Others<span class="px-2">:</span><span style="color: var(--red)">Not
                                                Available</span></h6>
                                    </div>
                                </div>

                                {{-- End Attachment --}}
                            </div>

                        </div>
                        {{-- End Detail Student --}}
                    </div>
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
