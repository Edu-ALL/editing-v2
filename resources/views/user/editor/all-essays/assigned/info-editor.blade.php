<div class="headline d-flex align-items-center gap-3">
    <img src="/assets/assign.png" alt="">
    <h6>Assignment</h6>
</div>
<div class="col d-flex flex-column px-3 pt-md-4 pt-4 pb-2 text-center justify-content-center"
    style="color: var(--black)">
    <h6 style="font-size: 14px; font-weight: 500">
        {{ $essay->essay_editors->editor->first_name . ' ' . $essay->essay_editors->editor->last_name }}
    </h6>
</div>
<div class="col d-flex align-items-center justify-content-center py-md-3 py-3">
    <form action="{{ route('cancel-editor', ['id_essay' => $essay->id_essay_clients]) }}"
        method="POST" class="p-0">
        @csrf
        <button class="btn btn-download d-flex align-items-center gap-2" data-bs-toggle="modal"
            data-bs-target="#selectEditor"
            style="background-color: var(--red); color: var(--white)">
            <img src="/assets/exit.png" alt="">
            <h6>Cancel</h6>
        </button>
    </form>
</div>