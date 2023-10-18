<div class="headline d-flex align-items-center gap-3" style="background-color: var(--yellow)">
    <img src="/assets/file.png" alt="">
    <h6>Download Your File</h6>
</div>
<div class="col d-flex align-items-center justify-content-center py-md-4 py-4">
    <img class="img-word" src="/assets/logo-word.png" alt="">
</div>
<div class="col d-flex align-items-center justify-content-center pb-md-3 pb-3">
    @if ($essay_editor->managing_file)
        <a class="btn btn-download d-flex align-items-center gap-2"
            href={{ asset('uploaded_files/program/essay/revised/' . $essay_editor->managing_file) }}>
            <img src="/assets/download.png" alt="">
            <h6>Download</h6>
        </a>
    @else
        @if (str_contains($essay_editor->attached_of_editors, 'Revised'))
            <a class="btn btn-download d-flex align-items-center gap-2"
                href={{ asset('uploaded_files/program/essay/revised/' . $essay_editor->attached_of_editors) }}>
                <img src="/assets/download.png" alt="">
                <h6>Download</h6>
            </a>
        @else
            <a class="btn btn-download d-flex align-items-center gap-2"
                href={{ asset('uploaded_files/program/essay/editors/' . $essay_editor->attached_of_editors) }}>
                <img src="/assets/download.png" alt="">
                <h6>Download</h6>
            </a>
        @endif
    @endif
</div>
<div class="headline d-flex align-items-center gap-3">
    <img src="/assets/tags.png" alt="">
    <h6>Tags</h6>
</div>
<div class="col d-flex flex-column px-3 py-md-4 py-4 my-md-1 countEssay text-center justify-content-center"
    style="color: var(--black)">
    <div class="col d-flex flex-row flex-wrap gap-2 justify-content-center">
        @foreach ($tags as $tag)
            <div class="tags py-2 px-3 list-tags">
                <h6 style="font-size: 12px; font-weight: 500">#{{ $tag->tags->topic_name }}</h6>
            </div>
        @endforeach
    </div>
</div>