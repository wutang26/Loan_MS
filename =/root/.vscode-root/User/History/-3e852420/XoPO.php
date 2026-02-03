@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Approved Loans</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-gray-500">Total Approved Loans</h2>
        <p class="text-3xl font-bold">{{ $loans->count() }}</p>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-gray-500">Active Approved Loans</h2>
        <p class="text-3xl font-bold">
            {{ $loans->where('outstanding_loan', '>', 0)->count() }}
        </p>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-gray-500">Fully Paid Loans</h2>
        <p class="text-3xl font-bold">
            {{ $loans->where('outstanding_loan', 0)->count() }}
        </p>
    </div>

</div>


    <!---Message to show success--->
    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

  <div class="grid grid-cols-1 md:grid-cols-1 gap-6">

    <div class="bg-white p-4 rounded shadow overflow-x-auto">

        <!-- Link to create Loan -->

        <!-- @auth
            {{-- @role('super-admin|admin|user') --}}
            @can('apply loan')
                <a href="{{ route('loans.apply_loan') }}"
                    style="
                    background-color:#bbf7d0;
                    color:#000;
                    padding:10px 10px;
                    border-radius:20px;
                    font-size:17px;
                    text-decoration:none;
                    display:inline-block;
                    width:fit-content;
                    white-space:nowrap;">
                    Apply Loan
                </a>
                @endcan
            {{-- @endrole --}}
        @endauth -->

        <!---Define veriable for extra usage--->
        @php
            $i = 0;
        @endphp
        <!--- End Define veriable for extra usage--->

      
<table class="w-full border-collapse">
    <thead>
        <tr class="bg-gray-100">
            <th class="border px-3 py-2">ID</th>
            <th class="border px-3 py-2">User</th>
            <th class="border px-3 py-2">Amount</th>
            <th class="border px-3 py-2">Status</th>
            <th class="border px-3 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($loans as $loan)
        <tr>
            <td class="border px-3 py-2">{{ ++$i }}</td>
            <td class="border px-3 py-2">{{ $loan->user->name ?? 'N/A' }}</td>
            <td class="border px-3 py-2">{{ $loan->loan_amount }}</td>
            <td class="border px-3 py-2 capitalize">{{ $loan->application_status }}</td>
            <td class="border px-3 py-2">
               
            @role('super-admin')
            @if(isset($loan) && $loan->application_status === 'approved')
            <form method="POST" action="{{ route('loans.disburse', $loan->id) }}">
                @csrf
                <button type="submit"
                    class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
                     <i class="bi bi-wallet2 text-green-400"></i>
                    Disburse Loan
                </button>
            </form>
            @endif
            @endrole

            </td> 
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center py-4 text-gray-500">No loans found.</td>
        </tr>
        @endforelse
    </tbody>
</table>

    </div>
@endsection
