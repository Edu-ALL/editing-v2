<div class="col d-flex flex-row alert-complete py-3 px-4" id="alertComplete">
    <div class="col d-flex align-items-center gap-2">
        <img src="/assets/thumbsup.png" alt="">
        <h6><b>Congratulations</b>, {{ $essay_editor->essay_clients->status->status_desc }}</h6>
    </div>
    <img src="/assets/exit.png" alt="" onclick="closeAlert()"
        style="cursor: pointer">
</div>