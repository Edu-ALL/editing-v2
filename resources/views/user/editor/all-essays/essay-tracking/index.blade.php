<div class="card">
    <div class="card-header p-3 d-flex justify-content-between align-items-center bg-secondary text-white">
        Essay Tracking
        <i class="fa-solid fa-clock-rotate-left"></i>
    </div>
    <div class="card-body p-3">
        <table class="table table-hover table-striped mb-0" style="font-size: 11px;">
            @foreach ($tracking as $item)
                {{-- Canceled, Rejected, and Revise not display  --}}
                @if ($item->status != 4 && $item->status != 5 && $item->status != 6)
                    <tr class="my-1">
                        <td class="text-start" style="padding: 5px !important;">
                            {{ $item->status == 2 ? 'Accepted' : $item->check_status->status_title }}
                        </td>
                        <td class="text-end" style="padding: 5px !important;">
                            <i class="fa fa-calendar text-secondary me-2"></i>
                            {{ date('M, dS Y', strtotime($item->created_at)) }}
                        </td>
                    </tr>
                @endif
            @endforeach
        </table>

        <div class="card bg-light mt-2 border-0 shadow" style="font-size: 12px;">
            <div class="card-body p-2 text-center">
                @php
                    // Cek Selisih Hari
                    // Editors deadline 60% dari selisih
                    $deadline = Carbon::parse($essay->essay_deadline)
                        ->startOfDay()
                        ->diffInDays(Carbon::parse($essay->uploaded_at)->startOfDay());
                    
                    $editor_deadline = Carbon::parse($essay->uploaded_at)->addDays(round((60 / 100) * $deadline, 0));
                @endphp

                Editor's Deadline:
                <p class="text-dark" style="font-size: 15px">
                    {{ $editor_deadline->format('M, dS Y') }}
                </p>
            </div>
        </div>

        <div class="row justify-content-center align-items-stretch mt-3">
            @foreach ($tracking as $items)
                @if ($items->status == 3)
                    <div class="col-md-6 p-0 m-0 pe-md-2">
                        <div class="card shadow h-100">
                            <div class="card-body p-2 text-center d-flex align-items-center">
                                @php
                                    $diffEditorDeadline = Carbon::parse($items->created_at)
                                        ->startOfDay()
                                        ->diffInDays(Carbon::parse($editor_deadline)->startOfDay());
                                @endphp
                                <div class="">
                                    <p class="m-0 p-0 mb-2" style="font-size: 11px">
                                        The Editor has submitted this essay
                                        @if ($diffEditorDeadline != 0)
                                            <h5>
                                                {{ $diffEditorDeadline . ' Days' }}
                                            </h5>
                                            <p class="m-0 p-0 mt-2" style="font-size: 11px">
                                                <strong
                                                    class="{{ $items->created_at > $editor_deadline ? 'text-danger' : 'text-success' }}">
                                                    {{ $items->created_at > $editor_deadline ? 'after ' : 'before ' }}
                                                </strong>
                                                Editor's deadline
                                            </p>
                                        @else
                                            according to the essay deadline
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
