@extends('user.mentor.utama.utama')
@section('css')
  {{-- <link rel="stylesheet" href="/css/admin/essay-completed-detail.css"> --}}
  <link rel="stylesheet" href="/css/admin/rate.css">
@endsection

@section('content')
<div class="container-fluid" style="padding: 0">
  <div class="row flex-nowrap main" id="main">

    {{-- Sidenav --}}
    @include('user.mentor.utama.menu')

    {{-- Content --}}
    <div class="col" style="overflow: auto !important">
      @include('user.mentor.utama.head')
      <div class="container main-content m-0">
        <div class="row gap-2">
          <div class="col-md col-12 p-0 userCard profile">
            <div class="headline d-flex align-items-center gap-3">
              <img src="/assets/status.png" alt="">
              <h6>Status</h6>
            </div>
            <div class="col d-flex flex-column align-items-center px-3 py-md-5 py-4 gap-3 text-center justify-content-center" style="color: var(--black)">
              <img class="img-status" src="/assets/status-complete.png" alt="">
              <h6>{{ $essay->status->status_title }}</h6>
            </div>
            <div class="headline d-flex align-items-center gap-3">
              <img src="/assets/file.png" alt="">
              <h6>Download Student Essay</h6>
            </div>
            <div class="col d-flex align-items-center justify-content-center py-md-4 py-4">
              <img class="img-word" src="/assets/logo-word.png" alt="">
            </div>
            <div class="col d-flex align-items-center justify-content-center pb-md-3 pb-3">
              <a class="btn btn-download d-flex align-items-center gap-2" href={{ asset('uploaded_files/program/essay/students/'.$essay->essay_clients->attached_of_clients) }}>
                <img src="/assets/download.png" alt="">
                <h6>Download</h6>
              </a>
            </div>
            <div class="headline d-flex align-items-center gap-3" style="background-color: var(--yellow)">
              <img src="/assets/file.png" alt="">
              <h6>Download Editor File</h6>
            </div>
            <div class="col d-flex align-items-center justify-content-center py-md-4 py-4">
              <img class="img-word" src="/assets/logo-word.png" alt="">
            </div>
            <div class="col d-flex align-items-center justify-content-center pb-md-3 pb-3">
              @if ($essay->managing_file)
                <a class="btn btn-download d-flex align-items-center gap-2" href={{ asset('uploaded_files/program/essay/revised/'.$essay->managing_file) }}>
                  <img src="/assets/download.png" alt="">
                  <h6>Download</h6>
                </a>
              @else
                @if (str_contains($essay->attached_of_editors, 'Revised'))
                  <a class="btn btn-download d-flex align-items-center gap-2" href={{ asset('uploaded_files/program/essay/revised/'.$essay->attached_of_editors) }}>
                    <img src="/assets/download.png" alt="">
                    <h6>Download</h6>
                  </a>
                @else
                  <a class="btn btn-download d-flex align-items-center gap-2" href={{ asset('uploaded_files/program/essay/editors/'.$essay->attached_of_editors) }}>
                    <img src="/assets/download.png" alt="">
                    <h6>Download</h6>
                  </a>
                @endif
              @endif
            </div>
            <div class="headline d-flex align-items-center gap-3">
              <img src="/assets/assign.png" alt="">
              <h6>Assignment</h6>
            </div>
            <div class="col d-flex flex-column px-3 py-md-4 py-4 my-md-1 countEssay text-center justify-content-center" style="color: var(--black)">
              <h6 style="font-size: 14px; font-weight: 400">{{ $essay->editor->first_name.' '.$essay->editor->last_name }}</h6>
            </div>
            <div class="headline d-flex align-items-center gap-3">
              <img src="/assets/tags.png" alt="">
              <h6>Tags</h6>
            </div>
            <div class="col d-flex flex-column px-3 py-md-4 py-4 my-md-1 countEssay text-center justify-content-center" style="color: var(--black)">
              <div class="col d-flex flex-row flex-wrap gap-2 justify-content-center">
                @foreach ($tags as $tag)
                <div class="tags py-2 px-3 list-tags">
                  <h6 style="font-size: 12px; font-weight: 400">#{{ $tag->tags->topic_name }}</h6>
                </div>
                @endforeach
              </div>
            </div>
            @if ($essay->notes_managing !== NULL)
            <div class="headline d-flex align-items-center gap-3">
              <img src="/assets/download.png" alt="">
              <h6>Notes</h6>
            </div>
            <div class="col d-flex flex-column px-3 py-md-4 py-4 my-md-1 countEssay text-center justify-content-center" style="color: var(--black)">
              <div class="col d-flex flex-row flex-wrap gap-2 justify-content-center" style="font-size:12px">
                @if (($essay->managing_file != "") || ($essay->managing_file != NULL) )
                  {!! $essay->notes_managing !!}
                @endif
              </div>
            </div>
            @endif
            @if ($essay->notes_editors !== NULL)
            <div class="headline d-flex align-items-center gap-3">
              <img src="/assets/download.png" alt="">
              <h6>Notes</h6>
            </div>
            <div class="col d-flex flex-column px-3 py-md-4 py-4 my-md-1 countEssay text-center justify-content-center" style="color: var(--black)">
              <div class="col d-flex flex-row flex-wrap gap-2 justify-content-center" style="font-size:12px">
                @if (($essay->attached_of_editors != "") || ($essay->attached_of_editors != NULL) )
                  {!! $essay->notes_editors !!}
                @endif
              </div>
            </div>
            @endif
          </div>
          
          <div class="col-md-8 col-12 p-0 userCard">
            <div class="headline d-flex justify-content-between">
              <div class="col-md-6 col-8 d-flex align-items-center gap-3">
                <img src="/assets/student.png" alt="">
                <h6>Student Detail</h6>
              </div>
              <div class="col-md-4 col-4 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                <a href="/mentor/essay-list/completed"><img src="/assets/back.png" alt=""></a>
              </div>
            </div>
            <div class="row profile-editor px-md-4 py-md-4 px-3 py-4 mb-2" style="overflow: auto !important">
              <div class="col-md student-desc d-flex flex-column justify-content-center gap-lg-3 gap-2 ps-lg-3 px-2 border-0">
                <div class="row d-flex align-items-center">
                  <div class="col-md-3 col-4">
                    <h6>Full Name</h6>
                  </div>
                  <div class="col-1 titik2"><p>:</p></div>
                  <div class="col-7">
                    <p>{{ $essay->essay_clients->client_by_id->first_name.' '.$essay->essay_clients->client_by_id->last_name }}</p>
                  </div>
                </div>
                <div class="row d-flex align-items-center">
                  <div class="col-md-3 col-4">
                    <h6>Email</h6>
                  </div>
                  <div class="col-1 titik2"><p>:</p></div>
                  <div class="col-7">
                    <p>{{ $essay->essay_clients->client_by_id->email }}</p>
                  </div>
                </div>
                <div class="row d-flex align-items-center">
                  <div class="col-md-3 col-4">
                    <h6>Address</h6>
                  </div>
                  <div class="col-1 titik2"><p>:</p></div>
                  <div class="col-7">
                    <p>{{ $essay->essay_clients->client_by_id->address }}</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="headline d-flex justify-content-between">
              <div class="col d-flex align-items-center gap-3">
                <img src="/assets/detail.png" alt="">
                <h6>Essay Detail</h6>
              </div>
            </div>
            <div class="row profile-editor px-md-3 py-md-4 px-3 py-4" style="overflow: auto !important">
              <form action="" class="p-0">
                <div class="col-12 d-flex mb-3">
                  <div class="col-6">
                    <h6 class="pb-2">University Name :</h6>
                    <input type="text" class="form-control inputField py-2 px-3" disabled value="{{ $essay->essay_clients->university->university_name }}">
                  </div>
                  <div class="col-6">
                    <h6 class="pb-2">Essay Title :</h6>
                    <input type="text" class="form-control inputField py-2 px-3" disabled value="{{ $essay->essay_clients->essay_title }}">
                  </div>
                </div>
                <div class="col-12 d-flex mb-4" style="overflow: auto !important">
                  <div class="col">
                    <h6 class="pb-2">Essay Prompt :</h6>
                    <textarea name="" class="textarea" style="overflow: auto !important">{{ $essay->essay_clients->essay_prompt }}</textarea>
                  </div>
                </div>
                <div class="col-12 d-flex flex-lg-row flex-column mb-3">
                  <div class="col-lg-6 col d-flex mb-3">
                    <div class="col-6">
                      <h6 class="pb-2">Essay Deadline :</h6>
                      <input type="text" class="form-control inputField py-2 px-3" disabled value="{{ date('D, d M Y', strtotime($essay->essay_clients->essay_deadline)) }}">
                    </div>
                    <div class="col-6">
                      <h6 class="pb-2">Application Deadline :</h6>
                      <input type="text" class="form-control inputField py-2 px-3" disabled value="{{ date('D, d M Y', strtotime($essay->essay_clients->application_deadline)) }}">
                    </div>
                  </div>
                  <div class="col-lg-6 col d-flex mb-3">
                    <div class="col-6">
                      <h6 class="pb-2">Editor Upload :</h6>
                      <input type="text" class="form-control inputField py-2 px-3" disabled value="{{ date('D, d M Y', strtotime($essay->uploaded_at)) }}">
                    </div>
                    <div class="col-6">
                      <h6 class="pb-2">Status Essay :</h6>
                      <input type="text" class="form-control inputField py-2 px-3" disabled value="{{ $status_essay }}">
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="col d-flex flex-row alert-complete py-3 px-4" id="alertComplete">
              <div class="col d-flex align-items-center gap-2">
                <img src="/assets/thumbsup.png" alt="">
                <h6><b>Thank you</b>, your essay has been completed</h6>
              </div>
              <img src="/assets/exit.png" alt="" onclick="closeAlert()" style="cursor: pointer">
            </div>
            <div class="{{ $feedback ? 'd-none' : 'd-block' }}">
              <div class="headline d-flex justify-content-between mt-1">
                <div class="col d-flex align-items-center gap-3">
                  <img src="/assets/feedback.png" alt="">
                  <h6>Feedback</h6>
                </div>
              </div>
              <form action="{{ route('add-feedback', ['id' => $essay->id_essay_clients]) }}"
                method="POST" class="p-0">
                @csrf
                <div class="col-12 d-flex px-3 py-3 feedback">
                  <div class="col d-flex flex-row align-items-center justify-content-center gap-3">
                    <div class="col d-flex flex-column gap-2">
                      <h6>Turn Around Time</h6>
                      <p>How long does it take for the editors to edit and then return the essays</p>
                    </div>
                    <div class="col-auto d-flex align-self-center rating">
                      <div class="star-widget d-flex flex-row-reverse gap-0">
                        <input type="radio" value="5" name="rating_1" id="rating_1-5">
                        <label for="rating_1-5" class="fas fa-star" onclick="rating_1('rating_1-5')"></label>
    
                        <input type="radio" value="4" name="rating_1" id="rating_1-4">
                        <label for="rating_1-4" class="fas fa-star" onclick="rating_1('rating_1-4')"></label>
    
                        <input type="radio" value="3" name="rating_1" id="rating_1-3">
                        <label for="rating_1-3" class="fas fa-star" onclick="rating_1('rating_1-3')"></label>
    
                        <input type="radio" value="2" name="rating_1" id="rating_1-2">
                        <label for="rating_1-2" class="fas fa-star" onclick="rating_1('rating_1-2')"></label>
    
                        <input type="radio" value="1" name="rating_1" id="rating_1-1">
                        <label for="rating_1-1" class="fas fa-star" onclick="rating_1('rating_1-1')"></label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 d-flex px-3 py-3 feedback" style="border-top: 1px solid var(--light-grey)">
                  <div class="col d-flex flex-row align-items-center justify-content-center gap-3">
                    <div class="col d-flex flex-column gap-2">
                      <h6>Specificity of feedback</h6>
                      <p>How helpful is the feedback</p>
                    </div>
                    <div class="col-auto d-flex align-self-center rating">
                      <div class="star-widget d-flex flex-row-reverse gap-0">
                        <input type="radio" value="5" name="rating_2" id="rating_2-5">
                        <label for="rating_2-5" class="fas fa-star" onclick="rating_2('rating_2-5')"></label>
    
                        <input type="radio" value="4" name="rating_2" id="rating_2-4">
                        <label for="rating_2-4" class="fas fa-star" onclick="rating_2('rating_2-4')"></label>
    
                        <input type="radio" value="3" name="rating_2" id="rating_2-3">
                        <label for="rating_2-3" class="fas fa-star" onclick="rating_2('rating_2-3')"></label>
    
                        <input type="radio" value="2" name="rating_2" id="rating_2-2">
                        <label for="rating_2-2" class="fas fa-star" onclick="rating_2('rating_2-2')"></label>
    
                        <input type="radio" value="1" name="rating_2" id="rating_2-1">
                        <label for="rating_2-1" class="fas fa-star" onclick="rating_2('rating_2-1')"></label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 d-flex px-3 py-3 feedback" style="border-top: 1px solid var(--light-grey)">
                  <div class="col d-flex flex-row align-items-center justify-content-center gap-3">
                    <div class="col d-flex flex-column gap-2">
                      <h6>Clarity of feedback</h6>
                    </div>
                    <div class="col-auto d-flex align-self-center rating">
                      <div class="star-widget d-flex flex-row-reverse gap-0">
                        <input type="radio" value="5" name="rating_3" id="rating_3-5">
                        <label for="rating_3-5" class="fas fa-star" onclick="rating_3('rating_3-5')"></label>
    
                        <input type="radio" value="4" name="rating_3" id="rating_3-4">
                        <label for="rating_3-4" class="fas fa-star" onclick="rating_3('rating_3-4')"></label>
    
                        <input type="radio" value="3" name="rating_3" id="rating_3-3">
                        <label for="rating_3-3" class="fas fa-star" onclick="rating_3('rating_3-3')"></label>
    
                        <input type="radio" value="2" name="rating_3" id="rating_3-2">
                        <label for="rating_3-2" class="fas fa-star" onclick="rating_3('rating_3-2')"></label>
    
                        <input type="radio" value="1" name="rating_3" id="rating_3-1">
                        <label for="rating_3-1" class="fas fa-star" onclick="rating_3('rating_3-1')"></label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 d-flex px-3 py-3 feedback" style="border-top: 1px solid var(--light-grey)">
                  <div class="col d-flex flex-row align-items-center justify-content-center gap-3">
                    <div class="col d-flex flex-column gap-2">
                      <h6>How encouraged do you feel from the feedback</h6>
                      <p>How the editor speaks with the client AKA customer service</p>
                    </div>
                    <div class="col-auto d-flex align-self-center rating">
                      <div class="star-widget d-flex flex-row-reverse gap-0">
                        <input type="radio" value="5" name="rating_4" id="rating_4-5">
                        <label for="rating_4-5" class="fas fa-star" onclick="rating_4('rating_4-5')"></label>
    
                        <input type="radio" value="4" name="rating_4" id="rating_4-4">
                        <label for="rating_4-4" class="fas fa-star" onclick="rating_4('rating_4-4')"></label>
    
                        <input type="radio" value="3" name="rating_4" id="rating_4-3">
                        <label for="rating_4-3" class="fas fa-star" onclick="rating_4('rating_4-3')"></label>
    
                        <input type="radio" value="2" name="rating_4" id="rating_4-2">
                        <label for="rating_4-2" class="fas fa-star" onclick="rating_4('rating_4-2')"></label>
    
                        <input type="radio" value="1" name="rating_4" id="rating_4-1">
                        <label for="rating_4-1" class="fas fa-star" onclick="rating_4('rating_4-1')"></label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 d-flex px-3 py-3 feedback" style="border-top: 1px solid var(--light-grey)">
                  <div class="col d-flex flex-row align-items-center justify-content-center gap-3">
                    <div class="col d-flex flex-column gap-2">
                      <h6>Do they help you grow as a writer/did you learn anything new</h6>
                    </div>
                    <div class="col-auto d-flex align-self-center rating">
                      <div class="star-widget d-flex flex-row-reverse gap-0">
                        <input type="radio" value="5" name="rating_5" id="rating_5-5">
                        <label for="rating_5-5" class="fas fa-star" onclick="rating_5('rating_5-5')"></label>
    
                        <input type="radio" value="4" name="rating_5" id="rating_5-4">
                        <label for="rating_5-4" class="fas fa-star" onclick="rating_5('rating_5-4')"></label>
    
                        <input type="radio" value="3" name="rating_5" id="rating_5-3">
                        <label for="rating_5-3" class="fas fa-star" onclick="rating_5('rating_5-3')"></label>
    
                        <input type="radio" value="2" name="rating_5" id="rating_5-2">
                        <label for="rating_5-2" class="fas fa-star" onclick="rating_5('rating_5-2')"></label>
    
                        <input type="radio" value="1" name="rating_5" id="rating_5-1">
                        <label for="rating_5-1" class="fas fa-star" onclick="rating_5('rating_5-1')"></label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 d-flex px-3 py-3 feedback" style="border-top: 1px solid var(--light-grey)">
                  <div class="col d-flex flex-row align-items-center justify-content-center gap-3">
                    <div class="col d-flex flex-column gap-2">
                      <h6>How likely would you recommend this editor to others?</h6>
                    </div>
                    <div class="col-auto d-flex align-self-center rating">
                      <div class="star-widget d-flex flex-row-reverse gap-0">
                        <input type="radio" value="5" name="rating_6" id="rating_6-5">
                        <label for="rating_6-5" class="fas fa-star" onclick="rating_6('rating_6-5')"></label>
    
                        <input type="radio" value="4" name="rating_6" id="rating_6-4">
                        <label for="rating_6-4" class="fas fa-star" onclick="rating_6('rating_6-4')"></label>
    
                        <input type="radio" value="3" name="rating_6" id="rating_6-3">
                        <label for="rating_6-3" class="fas fa-star" onclick="rating_6('rating_6-3')"></label>
    
                        <input type="radio" value="2" name="rating_6" id="rating_6-2">
                        <label for="rating_6-2" class="fas fa-star" onclick="rating_6('rating_6-2')"></label>
    
                        <input type="radio" value="1" name="rating_6" id="rating_6-1">
                        <label for="rating_6-1" class="fas fa-star" onclick="rating_6('rating_6-1')"></label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 d-flex px-3 py-3 feedback" style="border-top: 1px solid var(--light-grey)">
                  <div class="col-12 d-flex mb-1" style="overflow: auto !important">
                    <div class="col">
                      <h6 class="pb-2">Comment :</h6>
                      <textarea name="comment" class="textarea" style="overflow: auto !important"></textarea>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 d-flex justify-content-center pt-2 pb-4">
                  <button type="submit" class="btn btn-create d-flex align-items-center gap-2">
                      <img src="/assets/send.png" alt="">
                      <h6 style="font-size: 12px;font-weight: 400">Submit Your Feedback</h6>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
        
      </div>
    </div>
    {{-- End Content --}}
  </div>
</div>
@endsection
@section('js')
    <script>
      function rating_1(name){
        document.getElementById(name).checked = true;
      }
      function rating_2(name){
        document.getElementById(name).checked = true;
      }
      function rating_3(name){
        document.getElementById(name).checked = true;
      }
      function rating_4(name){
        document.getElementById(name).checked = true;
      }
      function rating_5(name){
        document.getElementById(name).checked = true;
      }
      function rating_6(name){
        document.getElementById(name).checked = true;
      }
    </script>
@endsection