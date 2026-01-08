<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Students PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; }
    </style>
</head>
<body>

<h2>Students List</h2>

@if($students->count())
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
        @foreach($students as $student)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <p>No students found.</p>
@endif

</body>
</html>
