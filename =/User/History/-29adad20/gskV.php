@extends('layouts.admin')

@section('content')
<h2 class="text-xl font-bold mb-4">Repayment Schedule</h2>
{{-- Get the total Loan Borrowed  --}}
@foreach($repayments as $repayment)

    @php
        $totalBorrowed = $repayments->sum('amount');
    @endphp

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
        @foreach($repayments as $repayment)
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

{{-- Pagination --}}
<div class="mt-4">
    {{ $repayments->links() }}
</div>

@endsection
