{{-- Modal Reject --}}
<div class="modal fade" id="reject" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 w-100">
            <div class="modal-header" style="background-color: var(--blue)">
                <div class="col d-flex gap-1 align-items-center">
                    <img src="/assets/danger.png" alt="">
                    <h6 class="modal-title ms-3">Reject</h6>
                </div>
                <div type="button" data-bs-dismiss="modal" aria-label="Close">
                    <img src="/assets/close.png" alt="" style="height: 26px">
                </div>
            </div>
            <div class="modal-body px-4 py-4">
                <form action="{{ route('reject-your-essay', ['id_essay' => $essay->id_essay_clients]) }}"
                    method="POST" class="p-0">
                    @csrf
                    <h6 style="font-size: 14px">Notes :</h6>
                    <textarea name="notes" class="textarea" style="overflow: auto !important"></textarea>
                    <div class="col d-flex align-items-center justify-content-center mt-3">
                        <button class="btn btn-download d-flex align-items-center justify-content-center gap-2"
                            style="background-color: var(--red)">
                            <img src="/assets/exit.png" alt="">
                            <h6 class="mb-0">Reject</h6>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>