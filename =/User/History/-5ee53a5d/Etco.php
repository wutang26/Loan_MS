@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">Repayment History Schedules</h1>

@forelse($loans as $loan)
    @php
        $totalBorrowed = $loan->repayments->sum('amount');
    @endphp

    {{-- Loan Header --}}
    <div class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded">
        <h2 class="font-semibold text-lg">
            Borrower: {{ $loan->user->name ?? 'N/A' }} | Loan ID: {{ $loan->id }}
        </h2>
        <p>
            <span class="font-semibold">Total Loan Amount:</span> {{ number_format($totalBorrowed, 2) }}
            | <span class="font-semibold">Outstanding:</span> {{ number_format($loan->outstanding_loan, 2) }}
        </p>
    </div>

    {{-- Repayment Table --}}
    <div class="bg-white shadow rounded-lg overflow-hidden mb-8">
        <table class="w-full border text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-3 py-2">S/N</th>
                    <th class="border px-3 py-2">Due Date</th>
                    <th class="border px-3 py-2">Amount</th>
                    <th class="border px-3 py-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loan->repayments as $repayment)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-3 py-2">{{ $repayment->installment_no }}</td>
                        <td class="border px-3 py-2">{{ \Carbon\Carbon::parse($repayment->due_date)->format('d M Y') }}</td>
                        <td class="border px-3 py-2">{{ number_format($repayment->amount, 2) }}</td>
                        <td class="border px-3 py-2">
                            @if($repayment->status === 'paid')
                                <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-semibold">Paid</span>
                            @else
                                <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs font-semibold">Pending</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-gray-500">
                            No repayment schedule created yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@empty
    <p class="text-center text-gray-500 mt-8">No disbursed loans available.</p>
@endforelse

{{-- Pagination --}}
<div class="mt-4">
    {{ $loans->links() }}
</div>

@endsection
