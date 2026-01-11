<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Members PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 15px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

<h2>Member List</h2>
   <!-- Back Button -->
        <div>
            <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline">&larr; Back</a>
        </div>

@if($members->count())
    <table>
        <thead>
            <tr>
                <th>S/N</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Date Joined</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        @foreach($members as $member)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $member->first_name }}</td>
                <td>{{ $member->middle_name ?? '-' }}</td>
                <td>{{ $member->last_name }}</td>
                <td>{{ $member->phone }}</td>
                <td>{{ $member->address }}</td>
                <td>{{ $member->created_at->format('d M Y') }}</td>
                <td>{{ $member->status }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <p>No members found.</p>
@endif

</body>
</html>
