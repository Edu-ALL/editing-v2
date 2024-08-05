<div class="headline d-flex justify-content-between mt-1">
    <div class="col d-flex align-items-center gap-3">
        <img src="/assets/feedback.png" alt="">
        <h6>Feedback</h6>
    </div>
</div>
<div class="col-12 d-flex px-3 py-3 feedback">
    <div class="col d-flex flex-row align-items-center justify-content-center gap-3">
        <div class="col d-flex flex-column gap-2">
            <h6>Turn Around Time</h6>
            <p>How long does it take for the editors to edit and then return the essays</p>
        </div>
        <div class="col-auto d-flex align-self-center">
            @if ($feedback != null)
                <span
                    class="fa fa-star {{ $feedback->option1 >= 1 ? 'checked' : '' }}"></span>
                <span
                    class="fa fa-star {{ $feedback->option1 >= 2 ? 'checked' : '' }}"></span>
                <span
                    class="fa fa-star {{ $feedback->option1 >= 3 ? 'checked' : '' }}"></span>
                <span
                    class="fa fa-star {{ $feedback->option1 >= 4 ? 'checked' : '' }}"></span>
                <span
                    class="fa fa-star {{ $feedback->option1 >= 5 ? 'checked' : '' }}"></span>
            @else
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
            @endif
        </div>
    </div>
</div>
<div class="col-12 d-flex px-3 py-3 feedback" style="border-top: 1px solid var(--light-grey)">
    <div class="col d-flex flex-row align-items-center justify-content-center gap-3">
        <div class="col d-flex flex-column gap-2">
            <h6>Specificity of feedback</h6>
            <p>How helpful is the feedback</p>
        </div>
        <div class="col-auto d-flex align-self-center">
            @if ($feedback != null)
                <span
                    class="fa fa-star {{ $feedback->option2 >= 1 ? 'checked' : '' }}"></span>
                <span
                    class="fa fa-star {{ $feedback->option2 >= 2 ? 'checked' : '' }}"></span>
                <span
                    class="fa fa-star {{ $feedback->option2 >= 3 ? 'checked' : '' }}"></span>
                <span
                    class="fa fa-star {{ $feedback->option2 >= 4 ? 'checked' : '' }}"></span>
                <span
                    class="fa fa-star {{ $feedback->option2 == 5 ? 'checked' : '' }}"></span>
            @else
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
            @endif
        </div>
    </div>
</div>
<div class="col-12 d-flex px-3 py-3 feedback" style="border-top: 1px solid var(--light-grey)">
    <div class="col d-flex flex-row align-items-center justify-content-center gap-3">
        <div class="col d-flex flex-column gap-2">
            <h6>Clarity of feedback</h6>
        </div>
        <div class="col-auto d-flex align-self-center">
            @if ($feedback != null)
                <span
                    class="fa fa-star {{ $feedback->option3 >= 1 ? 'checked' : '' }}"></span>
                <span
                    class="fa fa-star {{ $feedback->option3 >= 2 ? 'checked' : '' }}"></span>
                <span
                    class="fa fa-star {{ $feedback->option3 >= 3 ? 'checked' : '' }}"></span>
                <span
                    class="fa fa-star {{ $feedback->option3 >= 4 ? 'checked' : '' }}"></span>
                <span
                    class="fa fa-star {{ $feedback->option3 == 5 ? 'checked' : '' }}"></span>
            @else
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
            @endif
        </div>
    </div>
</div>
<div class="col-12 d-flex px-3 py-3 feedback" style="border-top: 1px solid var(--light-grey)">
    <div class="col d-flex flex-row align-items-center justify-content-center gap-3">
        <div class="col d-flex flex-column gap-2">
            <h6>How encouraged do you feel from the feedback</h6>
            <p>How the editor speaks with the client AKA customer service</p>
        </div>
        <div class="col-auto d-flex align-self-center">
            @if ($feedback != null)
                <span
                    class="fa fa-star {{ $feedback->option4 >= 1 ? 'checked' : '' }}"></span>
                <span
                    class="fa fa-star {{ $feedback->option4 >= 2 ? 'checked' : '' }}"></span>
                <span
                    class="fa fa-star {{ $feedback->option4 >= 3 ? 'checked' : '' }}"></span>
                <span
                    class="fa fa-star {{ $feedback->option4 >= 4 ? 'checked' : '' }}"></span>
                <span
                    class="fa fa-star {{ $feedback->option4 == 5 ? 'checked' : '' }}"></span>
            @else
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
            @endif
        </div>
    </div>
</div>
<div class="col-12 d-flex px-3 py-3 feedback" style="border-top: 1px solid var(--light-grey)">
    <div class="col d-flex flex-row align-items-center justify-content-center gap-3">
        <div class="col d-flex flex-column gap-2">
            <h6>Do they help you grow as a writer/did you learn anything new</h6>
        </div>
        <div class="col-auto d-flex align-self-center">
            @if ($feedback != null)
                <span
                    class="fa fa-star {{ $feedback->option5 >= 1 ? 'checked' : '' }}"></span>
                <span
                    class="fa fa-star {{ $feedback->option5 >= 2 ? 'checked' : '' }}"></span>
                <span
                    class="fa fa-star {{ $feedback->option5 >= 3 ? 'checked' : '' }}"></span>
                <span
                    class="fa fa-star {{ $feedback->option5 >= 4 ? 'checked' : '' }}"></span>
                <span
                    class="fa fa-star {{ $feedback->option5 == 5 ? 'checked' : '' }}"></span>
            @else
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
            @endif
        </div>
    </div>
</div>
<div class="col-12 d-flex px-3 py-3 feedback" style="border-top: 1px solid var(--light-grey)">
    <div class="col d-flex flex-row align-items-center justify-content-center gap-3">
        <div class="col d-flex flex-column gap-2">
            <h6>How likely would you recommend this editor to others?</h6>
        </div>
        <div class="col-auto d-flex align-self-center">
            @if ($feedback != null)
                <span
                    class="fa fa-star {{ $feedback->option1 >= 1 ? 'checked' : '' }}"></span>
                <span
                    class="fa fa-star {{ $feedback->option1 >= 2 ? 'checked' : '' }}"></span>
                <span
                    class="fa fa-star {{ $feedback->option1 >= 3 ? 'checked' : '' }}"></span>
                <span
                    class="fa fa-star {{ $feedback->option1 >= 4 ? 'checked' : '' }}"></span>
                <span
                    class="fa fa-star {{ $feedback->option1 == 5 ? 'checked' : '' }}"></span>
            @else
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
            @endif
        </div>
    </div>
</div>
<div class="col-12 d-flex px-3 py-3 feedback" style="border-top: 1px solid var(--light-grey)">
    <div class="col-12 d-flex mb-2" style="overflow: auto !important">
        <div class="col">
            <h6 class="pb-2">Comment :</h6>
            {{-- <textarea name="" class="textarea" style="overflow: auto !important"></textarea> --}}
            <textarea name="" class="textarea" style="overflow: auto !important">
            @if ($feedback != null)
                {{ $essay_editor->essay_clients->feedback->add_comments ? $essay_editor->essay_clients->feedback->add_comments : '-' }}
            @endif
            </textarea>
        </div>
    </div>
</div>