<style>
    .table-essay table,
    .table-essay th,
    .table-essay td {
        border: 1px solid white;
        border-collapse: collapse;
    }

    .table-essay th,
    .table-essay td {
        background-color: #eaeaea;
    }
</style>
<table class="table-essay table-hover table-bordered" border="1">
    <thead>
        <tr class="text-center">
            <th align="center">No</th>
            <th align="center">Editor Name</th>
            <th align="center">Mentor Name</th>
            <th align="center">Essay Title</th>
            <th align="center">Essay Deadline</th>
            <th align="center">{{ $role == 'managing' ? 'Uploaded Date' : 'Assigned Date' }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($essays as $essay)
            <tr class="text-center">
                <td align="center">{{ $loop->index + 1 }}</td>
                <td>
                    {{ $essay->editor->first_name . ' ' . $essay->editor->last_name }}
                </td>
                <td>
                    {{ $essay->essay_clients->mentor->first_name . ' ' . $essay->essay_clients->mentor->last_name }}
                </td>
                <td>{{ $essay->essay_clients->essay_title }}</td>
                <td>
                    @if ($role == 'managing')
                        {{ date('D, d F Y', strtotime($essay->essay_clients->essay_deadline)) }}
                    @else
                        @php
                            $diffDeadline = Carbon::parse($essay->essay_clients->essay_deadline)
                                ->startOfDay()
                                ->diffInDays(Carbon::parse($essay->essay_clients->uploaded_at)->startOfDay());
                            $editors_deadline = Carbon::parse($essay->essay_clients->uploaded_at)->addDays(round((60 / 100) * $diffDeadline, 0));
                        @endphp
                        {{ date('D, d F Y', strtotime($editors_deadline)) }}
                    @endif
                </td>
                <td>{{ date('D, d F Y', strtotime($essay->uploaded_at)) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
