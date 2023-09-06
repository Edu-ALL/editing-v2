<div class="card">
    <div class="card-header">
        Essay Tracking
    </div>
    <div class="card-body">
        <table class="table table-hover table-striped mb-0" style="font-size: 11px;">
            @foreach ($tracking as $item)
                {{-- Canceled, Rejected, and Revise not display  --}}
                @if ($item->status != 4 && $item->status != 5 && $item->status != 6 )
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

        <div class="card bg-secondary mt-2" style="font-size: 12px;">
            <div class="card-body text-white py-2">
                @php
                    // Cek Selisih Hari
                    // Editors deadline 60% dari selisih
                    $deadline = Carbon::parse($essay->essay_deadline)
                        ->startOfDay()
                        ->diffInDays(Carbon::parse($essay->uploaded_at)->startOfDay());
                    
                    $editor_deadline = Carbon::parse($essay->uploaded_at)->addDays(round((60 / 100) * $deadline, 0));
                @endphp
                <ul class="list-group">
                    <li class="d-flex justify-content-between">
                        <div class="">
                            Editor's Deadline:
                        </div>
                        {{ $editor_deadline->format('M, dS Y') }}
                    </li>
                    <li class="d-flex justify-content-between">
                        <div class="">
                            Managing Editor's Deadline:
                        </div>
                        {{ Carbon::parse($essay->essay_deadline)->format('M, dS Y') }}
                    </li>
                </ul>
            </div>
        </div>

        <div class="row justify-content-center mt-3">
            @foreach ($tracking as $items)
                @if ($items->status == 3)
                    <div class="col-md-6 p-0 m-0">
                        <div class="card shadow">
                            <div class="card-body text-center">
                                @php
                                    $diffEditorDeadline = Carbon::parse($items->created_at)
                                        ->startOfDay()
                                        ->diffInDays(Carbon::parse($editor_deadline)->startOfDay());
                                @endphp

                                {{ $items->created_at > $editor_deadline ? '+ ' : '- ' }}
                                {{ $diffEditorDeadline . ' Days' }} <br>
                                <small style="font-size: 10px">From Editor's Deadline</small>
                            </div>
                        </div>
                    </div>
                @endif
                @if ($items->status == 7)
                    <div class="col-md-6 p-0 m-0">
                        <div class="card shadow">
                            <div class="card-body text-center">
                                @php
                                    $diffManagingDeadline = Carbon::parse($items->created_at)
                                        ->startOfDay()
                                        ->diffInDays(Carbon::parse($essay->essay_deadline)->startOfDay());
                                @endphp

                                {{ $items->created_at > $essay->essay_deadline ? '+ ' : '- ' }}
                                {{ $diffManagingDeadline . ' Days' }} <br>
                                <small style="font-size: 10px">From Managing's Deadline</small>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
