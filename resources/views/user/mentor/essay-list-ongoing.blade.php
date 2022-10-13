@extends('user.mentor.utama.utama')
@section('css')
    <link rel="stylesheet" href="/css/mentor/user-mentor.css">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row flex-nowrap main">
            @include('user.mentor.utama.menu')

            {{-- Content --}}
            <div class="col">
                @include('user.mentor.utama.head')
                <div class="container main-content m-0">
                    {{-- Table Student --}}
                    <div class="row">
                        <div class="col-md col-12 p-0 studentList">
                            <div class="headline d-flex justify-content-between">
                                <div class="col-md-6 col-5 d-flex align-items-center gap-md-3 gap-2">
                                    <img src="/assets/mentor.png" alt="">
                                    <h6>Ongoing Essay List</h6>
                                </div>
                                <div class="col-md-4 col-6 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                                    <img src="/assets/reload.png" alt="">
                                    <div class="input-group">
                                        <form id="form-ongoing-essay-searching"
                                            action="{{ route('mentor-essay-list-ongoing') }}" method="GET" role="search"
                                            class="w-100">
                                            <input type="email" class="form-control inputField py-2 px-3" name="keyword"
                                                placeholder="Search">
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
                                            <th>Mentor Name</th>
                                            <th>Editor Name</th>
                                            <th>Essay Title</th>
                                            <th>Essay Deadline</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @if ($essays->links()->paginator->hasPages()) --}}

                                        <?php $i = ($essays->currentpage() - 1) * $essays->perpage() + 1; ?>
                                        @foreach ($essays as $essay)
                                            <tr
                                                onclick="window.location='/mentor/essay-list/ongoing/detail/{{ $essay->id_essay_clients }}'">
                                                <th scope="row">{{ $i++ }}</th>

                                                @if ($essay->client_by_id)
                                                    <td>{{ $essay->client_by_id->first_name . ' ' . $essay->client_by_id->last_name }}
                                                    </td>
                                                    <td>{{ $essay->client_by_id->mentors->first_name . ' ' . $essay->client_by_id->mentors->last_name }}
                                                    </td>
                                                @elseif ($essay->client_by_email)
                                                    <td>{{ $essay->client_by_email->first_name . ' ' . $essay->client_by_email->last_name }}
                                                    </td>
                                                    <td>{{ $essay->client_by_email->mentors->first_name . ' ' . $essay->client_by_email->mentors->last_name }}
                                                    </td>
                                                @endif

                                                <td><?php echo $essay->editor ? $essay->editor->first_name . ' ' . $essay->editor->last_name : '-'; ?></td>
                                                <td>{{ $essay->essay_title }}</td>
                                                <td>{{ date('D, d M Y', strtotime($essay->essay_deadline)) }}</td>
                                                <td style="color: var(--red)">{{ $essay->status->status_title }}</td>
                                                </td>
                                        @endforeach
                                        @unless(count($essays))
                                            <tr style="cursor: default">
                                                <td colspan="9">No data</td>
                                            </tr>
                                        @endunless
                                        {{-- @else
                                        <tr>
                                            <td colspan="7">No data</td>
                                        </tr>
                                        @endif --}}
                                    </tbody>
                                </table>
                                {{-- Pagination --}}
                                <div class="d-flex justify-content-center">
                                    {{ $essays->links() }}
                                </div>
                            </div>
                            </a>
                        </div>
                        {{-- End Table Student --}}
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
        </script>
    @stop
