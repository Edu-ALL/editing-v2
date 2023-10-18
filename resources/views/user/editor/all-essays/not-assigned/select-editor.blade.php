{{-- Modal Info --}}
<div class="modal fade" id="info" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog d-flex align-items-center justify-content-center modal-dialog-centered">
        <div class="modal-content border-0 w-75">
            <div class="modal-header">
                <div class="col d-flex gap-1 align-items-center">
                    <img src="/assets/info.png" alt="">
                    <h6 class="modal-title ms-3">Please</h6>
                </div>
                <div type="button" data-bs-dismiss="modal" aria-label="Close">
                    <img src="/assets/close.png" alt="" style="height: 26px">
                </div>
            </div>
            <div class="modal-body text-center px-4 py-4 my-md-3">
                <p>Assign this essay to editor <span style="color: var(--red)">*</span></p>
            </div>
        </div>
    </div>
</div>

{{-- Modal Select Editor --}}
<div class="modal fade" id="selectEditor" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 80%; height: 100vh; margin: 0 auto !important">
        <div class="modal-content border-0">
            <div class="modal-header" style="border-bottom: 0px">
                <div class="col d-flex gap-1 align-items-center">
                    <img src="/assets/assign-list.png" alt="">
                    <h6 class="modal-title ms-3">Select Editor</h6>
                </div>
                <div type="button" data-bs-dismiss="modal" aria-label="Close">
                    <img src="/assets/close.png" alt="" style="height: 26px">
                </div>
            </div>
            <div class="modal-body p-0">
                <form action="{{ route('assign-editor', ['id_essay' => $essay->id_essay_clients]) }}" method="POST">
                    @csrf
                    <div class="col text-center p-0 m-0" style="max-height: 70vh; overflow-y: auto">
                        <div class="container text-start px-3 py-2">
                            <table class="table m-0" id="listeditor" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Editor Name</th>
                                        <th>Graduated From</th>
                                        <th>Due Tomorrow</th>
                                        <th>Due Within 3 Days</th>
                                        <th>Due Within 5 Days</th>
                                        <th>Completed Essay</th>
                                        <th>Assign</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="col d-flex align-items-center justify-content-end py-md-3 px-md-3 px-3 py-3 gap-2">
                        <button class="btn btn-download d-flex align-items-center justify-content-center gap-2"
                            data-bs-toggle="modal" data-bs-target="#selectEditor"
                            style="background-color: var(--yellow); color: var(--white)" type="submit">
                            <img src="/assets/assign-list.png" alt="">
                            <h6 class="my-auto">Select Editor</h6>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>