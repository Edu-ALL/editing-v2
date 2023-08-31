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
        @foreach ($essays as $essay)
            <tr class="text-center">
                <td>{{ $loop->index + 1 }}</td>
                <td>
                    {{ $essay->editor->first_name.' '.$essay->editor->last_name }}
                </td>
                <td>
                    {{ $essay->essay_clients->mentor->first_name . ' ' . $essay->essay_clients->mentor->last_name }}
                </td>
                <td>{{ $essay->essay_clients->essay_title }}</td>
                <td>{{ date('D, d F Y', strtotime($essay->essay_clients->essay_deadline)) }}</td>
                <td>{{ date('D, d F Y', strtotime($essay->uploaded_at)) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>