@extends('user.editor.utama.utama')
@section('css')
  <link rel="stylesheet" href="/css/admin/user-editor-detail.css">
  <style>
    .pagination { margin: 15px 0}
    .pagination .page-item .page-link { padding: 10px 15px; font-size: 12px; }
    .alert {font-size: 14px}
  </style>
@endsection
@section('content')
<div class="container-fluid" style="padding: 0">
  <div class="row flex-nowrap main" id="main">

    {{-- Sidenav --}}
    @include('user.editor.utama.menu')

    {{-- Content --}}
    <div class="col" style="overflow: auto !important">
      @include('user.editor.utama.head')
      <div class="container main-content m-0">

        @if(session()->has('update-editor-successful'))
        <div class="row alert alert-success fade show d-flex justify-content-between" role="alert">
          {{ session()->get('update-editor-successful') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="row gap-2">
          <div class="col-md col-12 p-0 userCard profile" style="cursor: default">
            <div class="headline d-flex align-items-center gap-3">
              <img src="/assets/pic.png" alt="">
              <h6>Editor</h6>
            </div>
            <div class="col d-flex align-items-center justify-content-center py-md-4 py-4">
              <div class="pic-profile">
                <img class="img-fluid" src="/assets/editor-bg.png" alt="">
              </div>
            </div>
            <div class="col d-flex align-items-center justify-content-center pb-md-3 pb-3">
              <form action="{{ route( $editor->status == 1 ? 'deactivate-editor' : 'activate-editor', ['id_editors' => $editor->id_editors]) }}" method="POST" class="p-0">
                @csrf
                <button class="btn btn-deactivated d-flex align-items-center gap-2">
                  <h6>{{ $editor->status == 1 ? 'Deactivated' : 'Activated' }}</h6>
                </button>
              </form>
              
            </div>
            <div class="headline d-flex align-items-center gap-3" style="background-color: var(--green)">
              <img src="/assets/completed-essay.png" alt="">
              <h6>Completed Essay</h6>
            </div>
            <div class="col d-flex flex-column px-3 py-md-5 py-4 gap-2 countEssay text-center justify-content-center" style="color: var(--green)">
              <h4>{{ $essay_completed->count() }}</h4>
              <h4>Completed Essay</h4>
            </div>
            <div class="headline d-flex align-items-center gap-3" style="background-color: var(--yellow)">
              <img src="/assets/star.png" alt="">
              <h6>Rating</h6>
            </div>
            <div class="col d-flex flex-column px-3 py-md-5 py-4 gap-2 countEssay text-center aling-items-center justify-content-center gap-3">
              <h4 style="color: var(--yellow)">{{ $average_rating }} / 5</h4>
              <div class="col d-flex flex-row justify-content-center">
                @if ($average_rating == 0)
                <img class="rating" src="/assets/rating.png" alt="">
                <img class="rating" src="/assets/rating.png" alt="">
                <img class="rating" src="/assets/rating.png" alt="">
                <img class="rating" src="/assets/rating.png" alt="">
                <img class="rating" src="/assets/rating.png" alt="">
                @elseif ($average_rating > 0 && $average_rating <= 0.5)
                <img class="rating" src="/assets/rating-half.png" alt="">
                <img class="rating" src="/assets/rating.png" alt="">
                <img class="rating" src="/assets/rating.png" alt="">
                <img class="rating" src="/assets/rating.png" alt="">
                <img class="rating" src="/assets/rating.png" alt="">
                @elseif ($average_rating > 0.5 && $average_rating <= 1)
                <img class="rating" src="/assets/rating-fill.png" alt="">
                <img class="rating" src="/assets/rating.png" alt="">
                <img class="rating" src="/assets/rating.png" alt="">
                <img class="rating" src="/assets/rating.png" alt="">
                <img class="rating" src="/assets/rating.png" alt="">
                @elseif ($average_rating > 1 && $average_rating <= 1.5)
                <img class="rating" src="/assets/rating-fill.png" alt="">
                <img class="rating" src="/assets/rating-half.png" alt="">
                <img class="rating" src="/assets/rating.png" alt="">
                <img class="rating" src="/assets/rating.png" alt="">
                <img class="rating" src="/assets/rating.png" alt="">
                @elseif ($average_rating > 1.5 && $average_rating <= 2)
                <img class="rating" src="/assets/rating-fill.png" alt="">
                <img class="rating" src="/assets/rating-fill.png" alt="">
                <img class="rating" src="/assets/rating.png" alt="">
                <img class="rating" src="/assets/rating.png" alt="">
                <img class="rating" src="/assets/rating.png" alt="">
                @elseif ($average_rating > 2 && $average_rating <= 2.5)
                <img class="rating" src="/assets/rating-fill.png" alt="">
                <img class="rating" src="/assets/rating-fill.png" alt="">
                <img class="rating" src="/assets/rating-half.png" alt="">
                <img class="rating" src="/assets/rating.png" alt="">
                <img class="rating" src="/assets/rating.png" alt="">
                @elseif ($average_rating > 2.5 && $average_rating <= 3)
                <img class="rating" src="/assets/rating-fill.png" alt="">
                <img class="rating" src="/assets/rating-fill.png" alt="">
                <img class="rating" src="/assets/rating-fill.png" alt="">
                <img class="rating" src="/assets/rating.png" alt="">
                <img class="rating" src="/assets/rating.png" alt="">
                @elseif ($average_rating > 3 && $average_rating <= 3.5)
                <img class="rating" src="/assets/rating-fill.png" alt="">
                <img class="rating" src="/assets/rating-fill.png" alt="">
                <img class="rating" src="/assets/rating-fill.png" alt="">
                <img class="rating" src="/assets/rating-half.png" alt="">
                <img class="rating" src="/assets/rating.png" alt="">
                @elseif ($average_rating > 3.5 && $average_rating <= 4)
                <img class="rating" src="/assets/rating-fill.png" alt="">
                <img class="rating" src="/assets/rating-fill.png" alt="">
                <img class="rating" src="/assets/rating-fill.png" alt="">
                <img class="rating" src="/assets/rating-fill.png" alt="">
                <img class="rating" src="/assets/rating.png" alt="">
                @elseif ($average_rating > 4 && $average_rating <= 4.5)
                <img class="rating" src="/assets/rating-fill.png" alt="">
                <img class="rating" src="/assets/rating-fill.png" alt="">
                <img class="rating" src="/assets/rating-fill.png" alt="">
                <img class="rating" src="/assets/rating-fill.png" alt="">
                <img class="rating" src="/assets/rating-half.png" alt="">
                @elseif ($average_rating > 4.5 && $average_rating <= 5)
                <img class="rating" src="/assets/rating-fill.png" alt="">
                <img class="rating" src="/assets/rating-fill.png" alt="">
                <img class="rating" src="/assets/rating-fill.png" alt="">
                <img class="rating" src="/assets/rating-fill.png" alt="">
                <img class="rating" src="/assets/rating-fill.png" alt="">
                @endif
              </div>

              @if ($average_rating == 0)
                <h4 class="d-block" style="color: var(--yellow)">-</h4>
              @elseif ($average_rating >= 0.5 && $average_rating <= 0.9)
                <h4 class="d-block" style="color: var(--yellow)">Horrific</h4>
              @elseif ($average_rating >= 1 && $average_rating <= 1.4)
                <h4 class="d-block" style="color: var(--yellow)">Awful</h4>
              @elseif ($average_rating >= 1.5 && $average_rating <= 1.9)
                <h4 class="d-block" style="color: var(--yellow)">Very Bad</h4>
              @elseif ($average_rating >= 2 && $average_rating <= 2.4)
                <h4 class="d-block" style="color: var(--yellow)">Bad</h4>
              @elseif ($average_rating >= 2.5 && $average_rating <= 2.9)
                <h4 class="d-block" style="color: var(--yellow)">Unsatisfactory</h4>
              @elseif ($average_rating >= 3 && $average_rating <= 3.4)
                <h4 class="d-block" style="color: var(--yellow)">Satisfactory</h4>
              @elseif ($average_rating >= 3.5 && $average_rating <= 3.9)
                <h4 class="d-block" style="color: var(--yellow)">Good</h4>
              @elseif ($average_rating >= 4 && $average_rating <= 4.4)
                <h4 class="d-block" style="color: var(--yellow)">Very Good</h4>
              @elseif ($average_rating >= 4.5 && $average_rating <= 4.9)
                <h4 class="d-block" style="color: var(--yellow)">Excellent</h4>
              @elseif ($average_rating == 5)
                <h4 class="d-block" style="color: var(--yellow)">Awesome</h4>
              @endif
            </div>
          </div>
          
          <div class="col-md-8 col-12 p-0 userCard" style="cursor: default">
            <div class="headline d-flex justify-content-between">
              <div class="col-md-6 col-8 d-flex align-items-center gap-3">
                <img src="/assets/edit.png" alt="">
                <h6>View Editor</h6>
              </div>
              <div class="col-md-4 col-4 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                <a href="/editor/list"><img src="/assets/back.png" alt=""></a>
              </div>
            </div>
            
            <div class="row profile-editor px-md-3 py-md-4 px-3 py-4" style="overflow: auto !important">
              <form action="{{ route('update-managing-editor', ['id_editors' => $editor->id_editors]) }}" method="POST" class="p-0">
                @csrf
                <div class="col-12 d-flex mb-3">
                  <div class="col-6">
                    <h6 class="pb-2">First Name :</h6>
                    <input type="text" class="form-control inputField py-2 px-3" disabled value="{{ $editor->first_name }}">
                  </div>
                  <div class="col-6">
                    <h6 class="pb-2">Last Name :</h6>
                    <input type="text" class="form-control inputField py-2 px-3" disabled value="{{ $editor->last_name }}">
                  </div>
                </div>
                <div class="col-12 d-flex mb-3">
                  <div class="col-6">
                    <h6 class="pb-2">Email :</h6>
                    <input type="email" class="form-control inputField py-2 px-3" disabled value="{{ $editor->email }}">
                  </div>
                  <div class="col-6">
                    <h6 class="pb-2">Phone :</h6>
                    <input type="text" class="form-control inputField py-2 px-3" disabled value="{{ $editor->phone }}">
                  </div>
                </div>
                <div class="col-12 d-flex mb-3">
                  <div class="col-6">
                    <h6 class="pb-2">Graduated From :</h6>
                    <input type="text" class="form-control inputField py-2 px-3" disabled value="{{ $editor->graduated_from }}">
                  </div>
                  <div class="col-6">
                    <h6 class="pb-2">Major :</h6>
                    <input type="text" class="form-control inputField py-2 px-3" disabled value="{{ $editor->major }}">
                  </div>
                </div>
                <div class="col-12 d-flex mb-3" style="overflow: auto !important">
                  <div class="col">
                    <h6 class="pb-2">Address :</h6>
                    <textarea name="" class="textarea">{{ $editor->address }}</textarea>
                  </div>
                </div>
                <div class="col-12 d-flex mb-5">
                  <div class="col">
                    <h6 class="pb-2">Position :</h6>
                    <select class="select-beast" name="position">
                      <option value="1" @if ($editor->position == 1)
                          selected
                      @endif>Associate</option>
                      <option value="2" @if ($editor->position == 2)
                        selected
                      @endif>Senior</option>
                      <option value="3" @if ($editor->position == 3)
                        selected
                      @endif>Managing</option>
                    </select>
                  </div>
                </div>
                <div class="col-12 d-flex justify-content-center pt-3" style="border-top: 1px solid var(--light-grey)">
                  <button class="btn btn-create d-flex align-items-center gap-2">
                    <img src="/assets/update.png" alt="">
                    <h6>Update Editor</h6>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="row pt-2">
          <div class="col-md col-12 p-0 essayList">
            <div class="headline d-flex justify-content-between">
              <div class="col-md-6 col-7 d-flex align-items-center gap-3">
                <img src="/assets/ongoing-essay.png" alt="">
                <h6>Processed Essay Editing</h6>
              </div>
              <div class="col-md-4 col-4 d-flex align-items-center justify-content-end">
                <div class="input-group">
                  <form id="form-ongoing-essay-searching" action="" method="GET" role="search" class="w-100">
                    <input type="search" class="form-control inputField py-2 px-3" name="keyword-ongoing" placeholder="Search">
                  </form>
                </div>
              </div>
            </div>
            <div class="container text-center" style="overflow-x: auto !important">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Student Name</th>
                    <th>Program Name</th>
                    <th>Essay Title</th>
                    <th>Essay Deadline</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = ($essay_ongoing->currentpage()-1)* $essay_ongoing->perpage() + 1;?>
                  @foreach ($essay_ongoing as $essays_ongoing)
                  <tr style="cursor: default">
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $essays_ongoing->client_by_id->first_name.' '.$essays_ongoing->client_by_id->last_name}}</td>
                    <td>{{ $essays_ongoing->program->program_name }}</td>
                    <td>{{ $essays_ongoing->essay_title }}</td>
                    <td>{{ date('D, d M Y', strtotime($essays_ongoing->essay_deadline)) }}</td>
                    <td style="color: var(--blue)">{{ $essays_ongoing->status->status_title }}</td>
                  </tr>
                  @endforeach
                  
                  @unless (count($essay_ongoing)) 
                  <tr style="cursor: default">
                    <td colspan="7">No data</td>
                  </tr>
                  @endunless
                </tbody>
              </table>
              {{-- Pagination --}}
              <div class="d-flex justify-content-center">
                {{ $essay_ongoing->links() }}
              </div>
            </div>
          </div>
        </div>
        <div class="row pt-2">
          <div class="col-md col-12 p-0 essayList">
            <div class="headline d-flex justify-content-between" style="background-color: var(--green)">
              <div class="col-md-6 col-7 d-flex align-items-center gap-3">
                <img src="/assets/completed-essay.png" alt="">
                <h6>Completed Essay Editing</h6>
              </div>
              <div class="col-md-4 col-4 d-flex align-items-center justify-content-end">
                <div class="input-group">
                  <form id="form-completed-essay-searching" action="" method="GET" role="search" class="w-100">
                    <input type="search" class="form-control inputField py-2 px-3" name="keyword-completed" placeholder="Search">
                  </form>
                </div>
              </div>
            </div>
            <div class="container text-center" style="overflow-x: auto !important">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Student Name</th>
                    <th>Program Name</th>
                    <th>Essay Title</th>
                    <th>Essay Deadline</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = ($essay_completed->currentpage()-1)* $essay_completed->perpage() + 1;?>
                  @foreach ($essay_completed as $essays_completed)
                  <tr style="cursor: default">
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $essays_completed->client_by_id->first_name.' '.$essays_completed->client_by_id->last_name}}</td>
                    <td>{{ $essays_completed->program->program_name }}</td>
                    <td>{{ $essays_completed->essay_title }}</td>
                    <td>{{ date('D, d M Y', strtotime($essays_completed->essay_deadline)) }}</td>
                    <td style="color: var(--green)">{{ $essays_completed->status->status_title }}</td>
                  </tr>
                  @endforeach
                  
                  @unless (count($essay_completed)) 
                  <tr style="cursor: default">
                    <td colspan="7">No data</td>
                  </tr>
                  @endunless
                </tbody>
              </table>
              {{-- Pagination --}}
              <div class="d-flex justify-content-center">
                {{ $essay_completed->links() }}
              </div>
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
  <script type="text/javascript">
    $("#form-ongoing-essay-searching").keypress(function(e) {
      if (e.keyCode === 13) {
        swal.showLoading();
        e.preventDefault();
        $("#form-ongoing-essay-searching").submit();
      }
    });
    $("#form-completed-essay-searching").keypress(function(e) {
      if (e.keyCode === 13) {
        swal.showLoading();
        e.preventDefault();
        $("#form-completed-essay-searching").submit();
      }
    });
  </script>
@stop