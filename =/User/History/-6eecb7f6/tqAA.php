@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">Active Loans</h1>

@php
$total = $loans->sum('amount');
@endphp

<div class="mb-4 p-3 bg-blue-50 border rounded">
    Total Active Loans: {{ $loans->loan_amount->count() }}
</div>


<div class="bg-white shadow rounded-lg overflow-hidden">
    <table class="w-full border text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-3 py-2">User</th>
                <th class="border px-3 py-2">Amount</th>
                <th class="border px-3 py-2">Interest</th>
                <th class="border px-3 py-2">Tenure</th>
                <th class="border px-3 py-2">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($loans as $loan)
            <tr class="hover:bg-gray-50">
                <td class="border px-3 py-2">{{ $loan->user->name }}</td>
                {{-- <td class="border px-3 py-2">{{ number_format($loan->amount, 2) }}</td> --}}
                 <td class="border px-3 py-2">{{ $loan->loan_amount}}</td>
                <td class="border px-3 py-2">{{ $loan->interest_rate }}%</td>
                <td class="border px-3 py-2">{{ $loan->tenure_months }} months</td>
                <td class="border px-3 py-2">
                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-semibold">
                        Active
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-4 text-gray-500">
                    No active loans found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
