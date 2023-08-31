@extends('user.per-editor.utama.utama')
@section('css')
    <style>
        .alert {font-size: 14px; margin: 0 -12px 16px -12px}
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row flex-nowrap main" id="main">

            {{-- Sidenav --}}
            @include('user.per-editor.utama.menu')

            {{-- Content --}}
            <div class="col">
                @include('user.per-editor.utama.head')
                <div class="container main-content m-0">
                    @if (session()->has('login-successful'))
                    <div class="row alert alert-success fade show d-flex justify-content-between" role="alert">
                        {{ session()->get('login-successful') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <div class="row">
                        @if($assigned->count()>0)
                        <div class="col-12">
                            <div class="alert alert-danger d-flex justify-content-between align-items-center" role="alert"
                                style="font-size: 14px;">
                                <label>
                                    There {{ $assigned->count() == 1 ? 'is' : 'are' }}
                                    <strong>{{ $assigned->count() }}</strong> essay that you need to confirm.
                                </label>
                                <div class="dropstart">
                                    <button class="btn bg-danger btn-sm dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-info-circle"></i>
                                    </button>
                                    <div class="dropdown-menu overflow-auto p-3 pb-0"
                                        style="width: 550px; max-height:400px; font-size:13px;">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>No</th>
                                                    <th>Editor Name</th>
                                                    <th>Mentor Name</th>
                                                    <th>Essay Title</th>
                                                    <th>Essay Deadline</th>
                                                    <th>Uploaded Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($assigned as $item)
                                                    <tr class="text-center" onclick="window.open('{{url('editors/essay-list/ongoing/detail/').'/'.$item->id_essay_clients}}');">
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>
                                                            {{ $item->editor->first_name . ' ' . $item->editor->last_name }}
                                                        </td>
                                                        <td>
                                                            {{ $item->essay_clients->mentor->first_name . ' ' . $item->essay_clients->mentor->last_name }}
                                                        </td>
                                                        <td>{{ $item->essay_clients->essay_title }}</td>
                                                        <td>{{ date('D, d F Y', strtotime($item->essay_clients->essay_deadline)) }}</td>
                                                        <td>{{ date('D, d F Y', strtotime($item->uploaded_at)) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="col-md col-12 p-0 userCard">
                            <div class="headline d-flex align-items-center justify-content-center py-md-4 py-3 gap-3">
                                <img src="/assets/essay-list.png" alt="">
                                <h6 style="font-weight: 700; font-size: 16px">YOUR ESSAYS</h6>
                            </div>
                            <div class="row gap-2 m-3">
                                <div class="col-lg d-flex flex-column gap-2 p-0">
                                    <a class="col-md col-12 p-0 userCard" href="/editors/essay-list">
                                        <div class="headline d-flex align-items-center px-4 py-md-4 py-3 gap-3"
                                            style="background-color: var(--red)">
                                            <img src="/assets/warning.png" alt="">
                                            <h6>Due Tomorrow</h6>
                                        </div>
                                        <div class="col d-flex flex-column px-3 py-2 my-4 countEssay text-center justify-content-center"
                                            style="color: var(--red)">
                                            <h4>{{ $duetomorrow->count() }}</h4>
                                            <h4>Essay</h4>
                                        </div>
                                        <hr>
                                        <div class="detailCard ps-3 py-1 my-2">
                                            <h6>See the list of Essay Due Tomorrow</h6>
                                        </div>
                                    </a>
                                    <div class="row gap-2">
                                        <a class="col-md col-12 p-0 userCard" href="/editors/essay-list">
                                            <div class="headline d-flex align-items-center px-4 py-md-4 py-3 gap-3"
                                                style="background-color: var(--yellow)">
                                                <img src="/assets/warning.png" alt="">
                                                <h6>Due Within 3 Days</h6>
                                            </div>
                                            <div class="col d-flex flex-column px-3 py-2 my-4 countEssay text-center justify-content-center"
                                                style="color: var(--yellow)">
                                                <h4>{{ $duethree->count() }}</h4>
                                                <h4>Essay</h4>
                                            </div>
                                            <hr>
                                            <div class="detailCard ps-3 py-1 my-2">
                                                <h6>See the list of Essay Due Within 3 Days</h6>
                                            </div>
                                        </a>
                                        <a class="col-md col-12 p-0 userCard" href="/editors/essay-list">
                                            <div class="headline d-flex align-items-center px-4 py-md-4 py-3 gap-3">
                                                <img src="/assets/warning.png" alt="">
                                                <h6>Due Within 5 Days</h6>
                                            </div>
                                            <div
                                                class="col d-flex flex-column px-3 py-2 my-4 countEssay text-center justify-content-center">
                                                <h4>{{ $duefive->count() }}</h4>
                                                <h4>Essay</h4>
                                            </div>
                                            <hr>
                                            <div class="detailCard ps-3 py-1 my-2">
                                                <h6>See the list of Essay Due Within 5 Days</h6>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg col-12 p-0 userCard" href="/admin/essay-list/completed">
                                    <div class="headline d-flex align-items-center px-4 py-md-4 py-3 gap-3">
                                        <img src="/assets/detail.png" alt="">
                                        <h6>Essays</h6>
                                    </div>
                                    <canvas class="mt-4 mb-1" id="doughnut-chart" style="width:100%"></canvas>
                                    <div class="text-center mt-4 mb-lg-0 mb-4">
                                        <h6 class="mb-4" style="font-size: 12px; color: var(--black)">
                                            {{ date('D, d M Y') }} | Total Essay : {{ $ongoing_essay + $completed_essay }}
                                            Essay</h6>
                                    </div>
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
    <script>
        new Chart(document.getElementById("doughnut-chart"), {
            type: 'doughnut',
            data: {
                labels: ["Ongoing", "Completed"],
                datasets: [{
                    backgroundColor: ["#2785DD", "#44DE37"],
                    data: [{{ $ongoing_essay }}, {{ $completed_essay }}]
                }]
            }
        });
    </script>
@endsection
