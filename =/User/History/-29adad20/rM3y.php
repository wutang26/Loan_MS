@extends('layouts.admin')

@section('content')
<h2 class="text-xl font-bold mb-4">Repayment Schedule</h2>

@foreach($users as $user)

    @foreach($user->loans as $loan)

        @php
            $totalBorrowed = $loan->repayments->sum('amount');
        @endphp

        {{-- Loan Header --}}
        <div class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded">
            <h2 class="font-semibold text-lg">
                Borrower: {{ $loan->user->name ?? 'N/A' }} | Loan ID: {{ $loan->id }}
            </h2>
            <p>
                <span class="font-semibold">Total Loan Amount:</span>
                {{ number_format($totalBorrowed, 2) }}
                |
                <span class="font-semibold">Outstanding:</span>
                {{ number_format($loan->outstanding_loan, 2) }}
            </p>
        </div>

        <div class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded">
            <span class="font-semibold">Total Loan Amount:</span>
            {{ number_format($totalBorrowed, 2) }}
        </div>

        <table class="w-full border text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-3 py-2">Installment</th>
                    <th class="border px-3 py-2">Due Date</th>
                    <th class="border px-3 py-2">Amount</th>
                    <th class="border px-3 py-2">Status</th>
                    <th class="border px-3 py-2">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($loan->repayments as $repayment)
                <tr>
                    <td class="border px-3 py-2">{{ $repayment->installment_no }}</td>
                    <td class="border px-3 py-2">{{ $repayment->due_date }}</td>
                    <td class="border px-3 py-2">{{ number_format($repayment->amount, 2) }}</td>

                    <td class="border px-3 py-2">
                        {{ ucfirst($repayment->status) }}
                    </td>

                    <td class="border px-3 py-2">
                        @if($repayment->status === 'pending')
                        <form method="POST" action="{{ route('repayments.pay', $repayment->id) }}">
                            @csrf
                            <button class="bg-green-500 text-white px-3 py-1 rounded">
                                Pay
                            </button>
                        </form>
                        @else
                            <span class="text-gray-500">Paid</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    @endforeach

@endforeach

{{-- Pagination --}}
<div class="mt-4">
    {{ $users->links() }}
</div>

@endsection
