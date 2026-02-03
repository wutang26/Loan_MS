@extends('layouts.admin')

@section('content')
@php
    $i = 0;
@endphp



<h1 class="text-2xl font-bold mb-4">Disbursed Loans</h1>

<div class="bg-white shadow rounded-lg overflow-hidden">
    <table class="w-full border text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-3 py-2">S/N</th>
                <th class="border px-3 py-2">Member Name</th>
                <th class="border px-3 py-2">Amount</th>
                <th class="border px-3 py-2">Status</th>
                <th class="border px-3 py-2">Disbursed Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($loans as $index => $loan)
            <tr class="hover:bg-gray-50">
                <td class="border px-3 py-2">{{ $i++}}</td>
                <td class="border px-3 py-2">
                    {{ $loan->user->name ?? 'N/A' }}
                </td>
                <td class="border px-3 py-2">
                    {{ number_format($loan->amount, 2) }}
                </td>
                <td class="border px-3 py-2">
                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-semibold">
                        Disbursed
                    </span>
                </td>
                <td class="border px-3 py-2">
                    {{ $loan->updated_at->format('d M Y') }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-4 text-gray-500">
                    No disbursed loans found
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
