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

  <!---Define veriable for extra usage--->
        @php
            $i = 0;
        @endphp
        <!--- End Define veriable for extra usage--->

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
            <td class="border px-3 py-2">{{ $loan->id }}</td>
            <td class="border px-3 py-2">{{ $loan->user->name ?? 'N/A' }}</td>
            <td class="border px-3 py-2">{{ $loan->loan_amount }}</td>
            <td class="border px-3 py-2 capitalize">{{ $loan->application_status }}</td>
            <td class="border px-3 py-2">
                @auth
                @role('super-admin|admin')
                    @if($loan->application_status === 'pending')
                        <form action="{{ route('loans.approve', $loan->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="inline-flex items-center justify-center min-w-[70px] px-3 py-1 rounded-full text-sm font-semibold bg-blue-500 text-white hover:bg-blue-600 transition">
                                Approve
                            </button>
                        </form>

                        <form action="{{ route('loans.reject', $loan->id) }}" method="POST" class="inline ml-2">
                            @csrf
                            <button type="submit" class="inline-flex items-center justify-center min-w-[70px] px-3 py-1 rounded-full text-sm font-semibold bg-red-500 text-white hover:bg-red-600 transition">
                                Reject
                            </button>
                        </form>
                    @elseif($loan->status === 'approved')
                        <form action="{{ route('loans.disburse', $loan->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="inline-flex items-center justify-center min-w-[70px] px-3 py-1 rounded-full text-sm font-semibold bg-green-500 text-white hover:bg-green-600 transition">
                                Disburse
                            </button>
                        </form>
                    @else
                        <span class="text-gray-500">No Actions</span>
                    @endif
                @endrole
                @endauth
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
