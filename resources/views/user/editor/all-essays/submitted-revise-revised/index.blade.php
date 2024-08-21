<div class="col-12 d-flex flex-lg-row flex-column mb-3 gap-2">
    <div class="col">
        <div class="col mb-3">
            <h6 class="pb-2">Assign to Editor :</h6>
            <input type="text" class="form-control inputField py-2 px-3" disabled
                value="{{ $essay->essay_editors->editor->first_name . ' ' . $essay->essay_editors->editor->last_name }}"
                style="width: 97%">
        </div>
        <div class="col mb-3">
            <h6 class="pb-2">Editor Essay :</h6>
            <div class="col d-flex align-items-center justify-content-center pb-md-4 pt-md-2 pb-4 pt-2">
                <img class="img-word" src="/assets/logo-word.png" alt="">
            </div>
            <div class="col d-flex align-items-center justify-content-center pb-md-0 pb-3">
                @if ($essay->essay_editors->managing_file)
                    <a class="btn btn-download d-flex align-items-center gap-2"
                        href={{ asset('uploaded_files/program/essay/revised/' . $essay->essay_editors->managing_file) }}>
                        <img src="/assets/download.png" alt="">
                        <h6>Download</h6>
                    </a>
                @else
                    @if (str_contains($essay->essay_editors->attached_of_editors, 'Revised'))
                        <a class="btn btn-download d-flex align-items-center gap-2"
                            href={{ asset('uploaded_files/program/essay/revised/' . $essay->essay_editors->attached_of_editors) }}>
                            <img src="/assets/download.png" alt="">
                            <h6>Download</h6>
                        </a>
                    @else
                        <a class="btn btn-download d-flex align-items-center gap-2"
                            href={{ asset('uploaded_files/program/essay/editors/' . $essay->essay_editors->attached_of_editors) }}>
                            <img src="/assets/download.png" alt="">
                            <h6>Download</h6>
                        </a>
                    @endif
                @endif
            </div>
        </div>
        <div class="col p-0 mb-3">
            <h6 class="pb-2">Tags :</h6>
            <div class="col d-flex flex-wrap gap-1 list-tags pe-2">
                @foreach ($tags as $tag)
                    <div class="tags py-2 px-3">
                        <h6 style="font-size: 12px; font-weight: 500">
                            #{{ $tag->tags->topic_name }}</h6>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-lg-7 col">
        <div class="col">
            <h6 class="pb-2">Comments :</h6>
            <div class="chat-messages p-3 w-100 mb-2">
                @foreach ($essay_revise->reverse() as $revise)
                    @if ($revise->role == 'managing_editor')
                        <div class="chat-message-left pb-3">
                            <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3 mt-2">
                                <p><b>{{ $revise->managing_editor->first_name . ' ' . $revise->managing_editor->last_name }}</b>
                                </p>
                                <p class="mb-2" style="font-size: 12px">
                                    Managing Editor <br>
                                    <small class="text-muted small text-nowrap" style="font-size:10px;">
                                        {{ date('D, d M Y, H:i', strtotime($revise->created_at)) }}
                                    </small>
                                </p>
                                <p>{!! $revise->notes !!}</p>
                                @if ($revise->role == 'managing_editor' && $revise->file)
                                    <p style="margin-top: -4px">
                                        <a class="d-block mt-2"
                                            href="{{ asset('uploaded_files/program/essay/revise/' . $revise->file) }}"
                                            style="color: var(--blue)"><img src="/assets/download-blue.png"
                                                alt="" width="14" height="14" style="margin-right: 2px">
                                            Download Attachment</a>
                                    </p>
                                @endif
                            </div>
                        </div>
                    @elseif ($revise->role == 'editor')
                        <div class="chat-message-right pb-3">
                            <div class="flex-shrink-1 text-end bg-light rounded py-2 px-3 ml-3 mt-2">
                                <p><b>{{ $revise->editor->first_name . ' ' . $revise->editor->last_name }}</b>
                                </p>
                                <p class="mb-2" style="font-size: 12px">Editor
                                    <br>
                                    <small class="text-muted small text-nowrap" style="font-size:10px;">
                                        {{ date('D, d M Y, H:i', strtotime($revise->created_at)) }}
                                    </small>
                                </p>
                                <p>{!! $revise->notes !!}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <textarea name="notes" class="textarea" form="form-revise" style="overflow: auto !important"></textarea>
        </div>
        <div class="col mt-3 mb-2">
            <h6 class="pb-2">Add Attachments :</h6>
            <div class="h-100 p-0">
                <input class="form-control p-1 ps-2 inputField h-100" id="formFileSm" name="uploaded_revise_file"
                    form="form-revise" type="file" style="box-shadow: none">
            </div>
        </div>
        <div class="col-12 d-flex mb-2">
            <div class="col">
                <h6 class="pb-2" style="font-size: 10px; color: var(--red)">* Upload
                    your revise file with the .docx format.</h6>
            </div>
        </div>
        <div class="col d-flex align-items-center justify-content-center py-3">
            <form action="{{ route('revise-editor-essay', ['id_essay' => $essay->id_essay_clients]) }}"
                enctype="multipart/form-data" method="POST" class="p-0" id="form-revise">
                @csrf
                <button class="btn btn-download d-flex align-items-center gap-2" style="background-color: var(--red)">
                    <img src="/assets/danger.png" alt="">
                    <h6>Revise</h6>
                </button>
            </form>
        </div>
    </div>
</div>
<div class="col-12 d-flex flex-md-row flex-column justify-content-center py-3 gap-3"
    style="border-top: 1px solid var(--light-grey)">
    <div class="col">
        <div class="form-control d-flex align-items-center gap-2" style="padding: 6px 12px">
            <input class="form-check-input" type="checkbox" value="1" name="check_file" id="myCheck"
                onclick="checkUpload()" style="box-shadow: none">
            <label class="form-check-label" for="myCheck" style="font-size: 12px">
                Accept and upload your essay
            </label>
        </div>
    </div>
    <div class="col">
        <div class="d-none h-auto p-0" id="inputField">
            <input class="form-control ps-2 inputField h-100 w-100" id="uploadAcc" name="uploaded_acc_file"
                form="form-accept" type="file" style="box-shadow: none; padding: 6px 12px">
        </div>
    </div>
</div>
<div class="col-12 d-none" id="notesField">
    <div class="h-auto pb-3">
        <h6 class="pb-2">Notes :</h6>
        {{-- <input type="text" class="form-control inputField py-2 px-3" disabled value="{{ date('D, d M Y', strtotime($essay->essay_deadline)) }}"> --}}
        <textarea name="notes_managing" form="form-accept" class="textarea" id="" cols="30" rows="10"></textarea>
    </div>
</div>
<div class="col-12 d-flex justify-content-center pt-3" style="border-top: 1px solid var(--light-grey)">
    <form action="{{ route('verify-editor-essay', ['id_essay' => $essay->id_essay_clients]) }}"
        enctype="multipart/form-data" method="POST" id="form-accept" class="p-0">
        @csrf
        <button class="btn btn-create d-flex align-items-center gap-2" style="background-color: var(--green)">
            <img src="/assets/assign-list.png" alt="">
            @if ($essay->status_essay_clients == 6)
                <h6>Cancel, Accept</h6>
            @else
                <h6>Accept</h6>
            @endif
        </button>
    </form>
</div>
