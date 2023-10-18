<div class="col-12 d-flex py-3 mt-4" style="border-top: 1px solid var(--light-grey)">
    <div class="col d-flex flex-row align-items-center justify-content-center gap-3">
        <form
            action="{{ route('accept-your-essay', ['id_essay' => $essay->id_essay_clients]) }}"
            method="POST" class="p-0">
            @csrf
            <button class="btn btn-download d-flex align-items-center gap-2"
                style="background-color: var(--green)">
                <img src="/assets/assign-list.png" alt="">
                <h6>Accept</h6>
            </button>
        </form>
        <button class="btn btn-download d-flex align-items-center gap-2" data-bs-toggle="modal"
            data-bs-target="#reject" style="background-color: var(--red)">
            <img src="/assets/exit.png" alt="">
            <h6>Reject</h6>
        </button>
    </div>
</div>