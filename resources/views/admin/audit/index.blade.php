@extends('layouts.admin')

@section('content')
<h2 class="text-xl font-bold mb-4">Audit Logs</h2>

<table class="w-full bg-white rounded shadow text-sm">
    <thead>
        <tr class="border-b">
            <th class="p-2">Performed By</th>
            <th class="p-2">Action</th>
            <th class="p-2">Description</th>
            <th class="p-2">Time</th>
        </tr>
    </thead>

    <tbody>
        @foreach($logs as $log)
        <tr class="border-b">
            <td class="p-2">{{ $log->user->name }}</td>
            <td class="p-2">{{ $log->action }}</td>
            <td class="p-2">{{ $log->description }}</td>
            <td class="p-2">{{ $log->created_at->diffForHumans() }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $logs->links() }}
</div>
@endsection
