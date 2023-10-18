<div class="headline d-flex justify-content-between">
    <div class="col d-flex align-items-center gap-3">
        <img src="/assets/file.png" alt="">
        <h6>Download Your File</h6>
    </div>
</div>
<div class="row field px-md-3 py-md-4 px-3 py-4" style="overflow: auto !important">
    <form action="" class="p-0">
        <div class="col-12 d-flex flex-md-row flex-column gap-4 mb-3">
            <div class="col-md-4 col px-2">
                <div class="col mb-3">
                    <h6 class="pb-2">Your Essay :</h6>
                    <div
                        class="col d-flex align-items-center justify-content-center py-md-4 py-4">
                        <img class="img-word" src="/assets/logo-word.png" alt="">
                    </div>
                    <div
                        class="col d-flex align-items-center justify-content-center pb-md-3 pb-3">
                        @if ($essay->status_essay_clients == 8)
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
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="col pb-3" style="border-bottom: 1px solid var(--light-grey)">
                    <h6 class="pb-3">Tags :</h6>
                    <div class="col d-flex flex-wrap gap-1 list-tags pe-2">
                        @foreach ($tags as $tag)
                            <div class="tags py-2 px-3">
                                <h6 style="font-size: 12px; font-weight: 500">
                                    #{{ $tag->tags->topic_name }}</h6>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col d-flex flex-row alert-complete py-3 px-4 mt-3"
                    id="alertComplete"
                    style="border-radius: 10px; background-color: var(--yellow)">
                    <div class="col d-flex align-items-center gap-2">
                        <img src="/assets/danger.png" alt="">
                        <h6>Your Essay has being Reviewed</h6>
                    </div>
                    <img src="/assets/exit.png" alt="" onclick="closeAlert()"
                        style="cursor: pointer">
                </div>
            </div>
        </div>
    </form>
</div>