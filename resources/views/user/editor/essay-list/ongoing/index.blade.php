<div class="headline d-flex justify-content-between">
    <div class="col d-flex align-items-center gap-3">
        <img src="/assets/file.png" alt="">
        <h6>Upload Your File</h6>
    </div>
</div>
<form action="{{ route('upload-your-essay', ['id_essay' => $essay->id_essay_clients]) }}"
    class="p-0" id="form-essay" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="row field px-md-4 px-4 py-md-4 py-4" style="overflow: auto !important">
        <div class="col-12 d-flex flex-md-row flex-column mb-md-3 mb-2 gap-md-0 gap-3">
            <div class="col-md-6 col">
                <h6 class="pb-2">Upload Your File :</h6>
                <div class="col" id="chooseFile">
                    <div class="h-100 p-0">
                        <input class="form-control p-1 ps-2 inputField h-100" id="formFileSm"
                            name="uploaded_file" form="form-essay" type="file">
                    </div>
                    @error('uploaded_file')
                        <div class="alert text-danger" style="font-size: 10px">{{ $message }}
                        </div>
                    @enderror
                    <h6 class="pt-2" style="font-size: 10px; color: var(--red)">* Upload
                        your essay with the '.docx' format</h6>
                </div>
            </div>
            <div class="col-md-6 col">
                <h6 class="pb-2">Work Duration (Time spent on editing essay) :</h6>
                <div class="input-group">
                    <input type="number" name="work_duration" class="form-control py-2 px-3"
                        aria-describedby="basic-addon1">
                    <div class="input-group-prepend">
                        <span class="input-group-text py-2 px-2"
                            id="basic-addon1">Minutes</span>
                    </div>
                </div>
                @error('work_duration')
                    <div class="alert text-danger" style="font-size: 10px">{{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-12 d-flex mb-3">
            <div class="col">
                <h6 class="pb-2">Tags :</h6>
                <select class="select-state" name="tag[]" id="tag">
                    <option value=""></option>
                    @foreach ($tags as $tags)
                        <option value="{{ $tags->id_topic }}">{{ $tags->topic_name }}
                        </option>
                    @endforeach
                </select>
                @error('tag')
                    <div class="alert text-danger" style="font-size: 10px">{{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-12 d-flex mb-2" style="overflow: auto !important">
            <div class="col">
                <h6 class="pb-2">Descriptions :</h6>
                <textarea name="description" class="textarea" placeholder="Descriptions"></textarea>
                @error('description')
                    <div class="alert text-danger" style="font-size: 10px">{{ $message }}
                    </div>
                @enderror
            </div>
        </div>

    </div>
    <div class="col-12 d-flex py-3 mt-4" style="border-top: 1px solid var(--light-grey)">
        <div class="col d-flex flex-row align-items-center justify-content-center gap-3">
            <button class="btn btn-download d-flex align-items-center gap-2"
                style="background-color: var(--blue)">
                <img src="/assets/upload.png" alt="">
                <h6>Upload Your File</h6>
            </button>
        </div>
    </div>
</form>