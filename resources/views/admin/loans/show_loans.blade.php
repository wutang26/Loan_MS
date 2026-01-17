@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Loans Summary</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-gray-500">Total Loans</h2>
            <p class="text-3xl font-bold">{{ $loans->count() }}</p>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-gray-500">Active Loans</h2>
            <p class="text-3xl font-bold">{{ $loans->count() }}</p>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-gray-500">Disbursed Loans</h2>
            <p class="text-3xl font-bold">{{ $loans->count() }}</p>
        </div>

    </div>

    <!---Message to show success--->
    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-1 gap-6>

        <div g-white p-4 rounded shadow overflow-x-auto">

        <!-- Link to create Loan -->

        @auth
            @role('super-admin|admin')
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
            @endrole
        @endauth

        <!---Define veriable for extra usage--->
        @php
            $i = 0;
        @endphp
        <!--- End Define veriable for extra usage--->
        <table class="w-full border border-gray-300 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-3 py-2 text-left">Id</th>
                    <th class="border px-3 py-2 text-left">Applicant</th>
                    <th class="border px-3 py-2 text-left">Amount</th>
                    <th class="border px-3 py-2 text-left">Total Repayment</th>
                    <th class="border px-3 py-2 text-left">Outstanding Loan</th>
                    <th class="border px-3 py-2 text-left">Status</th>

                    @auth
                        @role('super-admin|admin')
                            <th class="border px-3 py-2 text-left">Actions</th>
                        @endrole
                    @endauth
                </tr>
            </thead>

            <tbody>
                @foreach ($loans as $loan)
                    <tr class="bg-white hover:bg-gray-100">
                        <td class="border px-3 py-2">{{ ++$i }}</td>

                        {{-- User Name --}}
                        <td class="border px-3 py-2">
                            {{ $loan->user->name ?? 'N/A' }}
                        </td>

                        <td class="border px-3 py-2">
                            {{ number_format($loan->loan_amount, 2) }}
                        </td>

                        <td class="border px-3 py-2">
                            {{ number_format($loan->total_repayment, 2) }}
                        </td>

                        <td class="border px-3 py-2">
                            {{ number_format($loan->outstanding_loan, 2) }}
                        </td>

                        <td class="border px-3 py-2">
                            <span
                                class="inline-flex items-center justify-center min-w-[90px] px-3 py-1 rounded-full
                        text-sm font-semibold text-center
                        {{ $loan->application_status === 'approved'
                            ? 'bg-green-100 text-green-700'
                            : ($loan->application_status === 'pending'
                                ? 'bg-yellow-100 text-yellow-700'
                                : 'bg-red-100 text-red-700') }}">
                                {{ ucfirst($loan->application_status) }}
                            </span>
                        </td>

                        @auth
                            @role('super-admin|admin')
                                <td class="border px-3 py-2">
                                    {{-- route('admin.loans.approve', $loan->id) --}}
                                    <a href="#"
                                        class="inline-flex items-center justify-center
                                min-w-[70px] px-3 py-1
                                rounded-full text-sm font-semibold
                                bg-blue-500 text-white
                                hover:bg-blue-600 transition">
                                        Approve
                                    </a>
                                        {{-- {{ route('admin.loans.reject', $loan->id) }} --}}
                                    <a href="#"
                                        class="inline-flex items-center justify-center
                                min-w-[70px] px-3 py-1
                                rounded-full text-sm font-semibold
                                bg-red-500 text-white
                                hover:bg-red-600 transition ml-2">
                                        Reject
                                    </a>
                                </td>
                            @endrole
                        @endauth
                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>



    </div>
@endsection
