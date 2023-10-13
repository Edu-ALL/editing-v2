<div class="headline d-flex align-items-center gap-3">
    <h6>Managing Feedback</h6>
</div>
<div class="col d-flex flex-column px-3 py-md-4 py-4 my-md-1 countEssay text-center justify-content-center">
    <strong class="mb-3">
        How would you rate the editor's revision of the mentee's essay?
    </strong>
    <div class="px-3" style="font-size: 12px; text-align:justify;">
        <form action="{{ url('/editor/all-essays/completed/detail/' . $essay_editor->essay_clients->id_essay_clients) }}"
            method="POST">
            @csrf
            <input type="hidden" name="essay_editor" id="" value="{{ $essay_editor->id_essay_editors }}">
            <input type="hidden" name="managing_editor" id=""
                value="{{ Auth::guard('web-editor')->user()->id_editors }}">

            <div class="form-check mb-1 text-dark">
                <input class="form-check-input mt-1" type="radio" name="feedback" value="0" id="feedback1"
                    {{ $managing_feedback && $managing_feedback->feedback == 0 ? 'checked' : '' }}
                    {{ $managing_feedback ? 'disabled' : '' }}>
                <label class="form-check-label cursor-pointer" for="feedback1">
                    Unacceptable
                    <small class="text-info d-block">
                        (rejected by the Managing Editor; comments will derail or halt the
                        mentee's essay progress)
                    </small>
                </label>
            </div>
            <div class="form-check mb-1 text-dark">
                <input class="form-check-input mt-1" type="radio" name="feedback" value="1" id="feedback2"
                    {{ $managing_feedback && $managing_feedback->feedback == 1 ? 'checked' : '' }}
                    {{ $managing_feedback ? 'disabled' : '' }}>
                <label class="form-check-label cursor-pointer" for="feedback2">
                    Lacking
                    <small class="text-info d-block">
                        (rejected by the Managing Editor, requiring substantial revisions;
                        comments are unhelpful)
                    </small>
                </label>
            </div>
            <div class="form-check mb-1 text-dark">
                <input class="form-check-input mt-1" type="radio" name="feedback" value="2" id="feedback3"
                    {{ $managing_feedback && $managing_feedback->feedback == 2 ? 'checked' : '' }}
                    {{ $managing_feedback ? 'disabled' : '' }}>
                <label class="form-check-label cursor-pointer" for="feedback3">
                    Acceptable
                    <small class="text-info d-block">
                        (accepted by the Managing Editor, with 1-3 minor revisions; some
                        comments are insightful)
                    </small>
                </label>
            </div>
            <div class="form-check mb-1 text-dark">
                <input class="form-check-input mt-1" type="radio" name="feedback" value="3" id="feedback4"
                    {{ $managing_feedback && $managing_feedback->feedback == 3 ? 'checked' : '' }}
                    {{ $managing_feedback ? 'disabled' : '' }}>
                <label class="form-check-label cursor-pointer" for="feedback4">
                    Beyond expectation
                    <small class="text-info d-block">
                        (accepted by the Managing Editor with no revision; comments are
                        consistently insightful)
                    </small>
                </label>
            </div>
            @if (!isset($managing_feedback))
                <div class="text-center">
                    <button class="btn btn-sm btn-primary mt-3 py-1" type="submit">Save</button>
                </div>
            @endif
        </form>
    </div>
</div>
