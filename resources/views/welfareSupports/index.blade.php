@extends('layoutsGroup.groupdashboard')

@section('content')
<div class="container">
    <h3 class="mb-4">Welfare Support & Loan Management</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('welfareSupports.create') }}" class="btn btn-primary mb-3" style="text-decoration:none">Add New Welfare Support</a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Providing Group</th>
                    <th>Recipient</th>
                    <th>Event Type</th>
                    <th>Mode</th>
                    <th>Amount</th>
                    <th>Repayment Amount</th>
                    <th>Description</th>
                    <th>Approved By</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($supports as $support)
                    <tr>
                        <td>{{ $loop->iteration + ($supports->currentPage() - 1) * $supports->perPage() }}</td>
                        <td>{{ $support->group->name ?? 'N/A' }}</td>
                        <td>{{ $support->user->name ?? 'N/A' }}</td>
                        <td>{{ $support->eventType->name ?? 'N/A' }}</td>
                        <td>{{ ucfirst($support->mode) }}</td>
                        <td>{{ number_format($support->amount, 2) }}</td>
                        <td>{{ $support->repayment_amount ? number_format($support->repayment_amount, 2) : '-' }}</td>
                        <td>{{ $support->description ?? '-' }}</td>
                        <td>{{ $support->approvedBy->name ?? 'N/A' }}</td>
                        <td>{{ $support->created_at->format('d-m-Y H:i') }}</td>
                        <td>
                            <a href="{{ route('welfareSupports.edit', $support->id) }}" class="btn btn-sm btn-warning" style="text-decoration:none">Edit</a>
                            <form action="{{ route('welfareSupports.destroy', $support->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this record?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center">No welfare supports found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $supports->links() }} {{-- Pagination links --}}
    </div>
</div>
@endsection