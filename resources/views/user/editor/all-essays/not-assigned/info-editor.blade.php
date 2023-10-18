<div class="headline d-flex align-items-center gap-3">
    <img src="/assets/assign.png" alt="">
    <h6>Assignment</h6>
</div>
<div class="col d-flex flex-column align-items-center px-3 pt-4 gap-1 text-center justify-content-center"
    style="color: var(--black)">
    <p style="font-size: 12px; color: var(--blue)">Request Editor:</p>
    @if ($essay->id_editors)
        <h6 style="font-size: 15px">{{ $essay->editor->first_name.' '.$essay->editor->last_name }}</h6>
    @else
        -
    @endif
</div>
<div class="col d-flex align-items-center justify-content-center py-md-4 py-4">
    <button class="btn btn-download d-flex align-items-center gap-2" data-bs-toggle="modal"
        data-bs-target="#selectEditor"
        style="background-color: var(--yellow); color: var(--white)">
        <img src="/assets/assign-list.png" alt="">
        <h6>Select Editor</h6>
    </button>
</div>