@if (isset($essay->essay_editors->notes_editors) && $essay->essay_editors->notes_editors != null)
    <div class="headline d-flex align-items-center gap-3">
        <img src="/assets/file.png" alt="">
        <h6>Notes</h6>
    </div>
    <div class="col d-flex flex-column px-3 py-md-4 py-4 my-md-1 countEssay text-center justify-content-center"
        style="color: var(--black)">
        <div class="col d-flex flex-row flex-wrap gap-2 justify-content-center"
            style="font-size:12px">
            {!! $essay->essay_editors->notes_editors !!}
        </div>
    </div>
@endif
@if (isset($essay->essay_editors->managing_file) && $essay->essay_editors->managing_file != '')
    <div class="headline d-flex align-items-center gap-3">
        <img src="/assets/file.png" alt="">
        <h6>Notes From Managing</h6>
    </div>
    <div class="col d-flex flex-column px-3 py-md-4 py-4 my-md-1 countEssay text-center justify-content-center"
        style="color: var(--black)">
        <div class="col d-flex flex-row flex-wrap gap-2 justify-content-center"
        style="font-size:12px">
            {!! $essay->essay_editors->notes_managing !!}
        </div>
    </div>
@endif