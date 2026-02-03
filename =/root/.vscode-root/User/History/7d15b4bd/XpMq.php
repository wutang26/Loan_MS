<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body class="bg-gray-100">

    <div class="flex min-h-screen">

        <!-- SIDEBAR -->
        <aside class="w-64 bg-gray-900 text-white">
            <div class="p-4 text-xl font-bold border-b border-gray-700">
                Loan Admin
            </div>

            <nav class="mt-4 space-y-1 text-sm">

                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>


                <a href="{{ route('admin.members.index') }}"
                    class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
                    <i class="bi bi-people"></i>
                    Members
                </a>


                {{-- <a href="#" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
                    <i class="bi bi-file-earmark-text"></i>
                    Loan Applications
                </a> --}}

                <!---- Loan Application---->
                <div class="dropdown">
                    <button
                        class="dropdown-toggle w-full flex items-center justify-between gap-3 px-4 py-2 hover:bg-gray-700">
                        <div class="flex items-center gap-3">
                            <i class="bi bi-file-earmark-text"></i>
                            Loan Application
                        </div>
                        <i class="bi bi-chevron-down text-xs"></i>
                    </button>

                    <div class="dropdown-menu hidden ml-8 mt-1 space-y-1 text-sm">
                        @can('apply loan')
                            <a href="{{ route('loans.show_loans') }}"
                                class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
                                <i class="bi bi-eye"></i>
                                Show Loans
                            </a>
                        @endcan

                        @can('apply loan')
                            @if (!auth()->user()->hasActiveLoan())
                                <a href="{{ route('loans.apply_loan') }}"
                                    class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
                                    <i class="bi bi-cash-stack"></i>
                                    Apply Loan
                                </a>
                            @endif
                        @endcan


                        {{-- @can('manage pdf')
                            <a href="#" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700"> <i
                                    class="bi bi-credit-card"></i> Repayments History </a>
                            @endcan @can('manage pdf')
                            <a href="#" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700"> <i
                                    class="bi bi-arrow-left-right">
                                </i> Disbursement History </a>
                        @endcan --}}

                    </div>
                </div>

                @role('super-admin')
                    <a href="{{ route('loans.approved_loans') }}"
                        class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
                        <i class="bi bi-check-circle"></i>
                        Loan Approvals
                    </a>
                @endrole

           @role('super-admin')
<div class="dropdown">
    <button class="dropdown-toggle w-full flex items-center justify-between gap-3 px-4 py-2 hover:bg-gray-700">
        <div class="flex items-center gap-3">
            <i class="bi bi-wallet2 text-green-400"></i>
            Loan Disbursement
        </div>
        <i class="bi bi-chevron-down text-xs"></i>
    </button>

    <div class="dropdown-menu hidden ml-8 mt-1 space-y-1 text-sm">

            {{-- Approved Loans --}}
            <a href="{{ route('loans.approved_loans') }}"
            class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
                <i class="bi bi-check-circle text-green-500"></i>
                Approved Loans
            </a>

            {{-- Disbursement Queue --}}
            <a href="#"
            class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
                <i class="bi bi-hourglass-split text-yellow-400"></i>
                Pending Disbursement
            </a>

            {{-- Disbursed History --}}
            <a href="{{ route('loans.disbursed') }}"
            class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
                <i class="bi bi-clock-history text-blue-400"></i>
                Disbursement History
            </a>

        </div>
    </div>
    @endrole


                <a href="#" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
                    <i class="bi bi-briefcase"></i>
                    Active Loans
                </a>

                <!---- Repayments ---->
              <div class="dropdown">
            @php
                $hasDisbursedLoan = auth()->user()->loans()
                    ->where('application_status', 'disbursed')
                    ->exists();

                $disbursedLoan = auth()->user()->loans()
                    ->where('application_status', 'disbursed')
                    ->first();
            @endphp

            <button
                class="dropdown-toggle w-full flex items-center justify-between gap-3 px-4 py-2 hover:bg-gray-700">
                <div class="flex items-center gap-3">
                    <i class="bi bi-credit-card"></i>
                    Repayments
                </div>
                <i class="bi bi-chevron-down text-xs"></i>
            </button>

    {{--SINGLE dropdown menu --}}
    <div class="dropdown-menu hidden ml-8 mt-1 space-y-1 text-sm">
    @if(isset($disbursedLoan) && $disbursedLoan)
        @can('apply loan')
            <a href="{{ route('loans.repayment_schedule', $disbursedLoan->id) }}"
                class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
                <i class="bi bi-calendar"></i>
                Repayment Schedule
            </a>

            <a href="{{ route('loans.repayments', $disbursedLoan->id) }}"
                class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
                <i class="bi bi-clock-history"></i>
                Repayment History
            </a>
        @endcan
    @else
        <span class="block px-4 py-2 text-gray-400">
            No Repayment Available
        </span>
    @endif
</div>


</body>
{{-- 
        Handle the dropdown menus --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.dropdown-toggle').forEach(button => {
            button.addEventListener('click', () => {
                const menu = button.nextElementSibling;
                menu.classList.toggle('hidden');
            });
        });
    });
</script>



</html>
