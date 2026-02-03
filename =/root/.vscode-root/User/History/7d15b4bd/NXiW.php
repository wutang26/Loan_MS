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
        <a href="{{ route('loans.disbursement.queue') }}"
           class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
            <i class="bi bi-hourglass-split text-yellow-400"></i>
            Pending Disbursement
        </a>

        {{-- Disbursed History --}}
        <a href="{{ route('loans.disbursement.history') }}"
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

        @if ($hasDisbursedLoan)

            <a href="{{ route('loans.repayments', $disbursedLoan->id) }}"
                class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
                <i class="bi bi-calendar"></i>
                Repayment Schedule
            </a>

            <a href="{{ route('loans.repayments', $disbursedLoan->id) }}"
                class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
                <i class="bi bi-clock-history"></i>
                Repayment History
            </a>

                @else
                    <span class="block px-4 py-2 text-gray-400">
                        No Repayment Available
                    </span>
                @endif

            </div>
        </div>


                <!-- REPORTS DROPDOWN -->
                <div class="dropdown">
                    <button
                        class="dropdown-toggle w-full flex items-center justify-between gap-3 px-4 py-2 hover:bg-gray-700">
                        <div class="flex items-center gap-3">
                            <i class="bi bi-bar-chart"></i>
                            Reports
                        </div>
                        <i class="bi bi-chevron-down text-xs"></i>
                    </button>

                    <div class="dropdown-menu hidden ml-8 mt-1 space-y-1 text-sm">
                        @can('manage pdf')
                            <a href="{{ route('pdf.preview') }}"
                                class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
                                <i class="bi bi-people"></i>
                                Members Preview Report
                            </a>
                        @endcan

                        @can('manage pdf')
                            <a href="{{ route('pdf.download') }}"
                                class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
                                <i class="bi bi-cash-stack"></i>
                                Print Loans Report
                            </a>
                        @endcan

                        @can('manage pdf')
                            <a href="#" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700"> <i
                                    class="bi bi-credit-card"></i> Repayments Report </a>
                            @endcan @can('manage pdf')
                            <a href="#" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700"> <i
                                    class="bi bi-arrow-left-right">
                                </i> Disbursement Report </a>
                        @endcan

                    </div>
                </div>


                <hr class="my-2 border-gray-700">

                <!-- SETTINGS DROPDOWN -->
                <!-- SETTINGS DROPDOWN -->
                <div class="dropdown">
                    <button
                        class="dropdown-toggle w-full flex items-center justify-between gap-3 px-4 py-2 hover:bg-gray-700">
                        <div class="flex items-center gap-3">
                            <i class="bi bi-gear"></i>
                            Settings
                        </div>
                        <i class="bi bi-chevron-down text-xs"></i>
                    </button>

                    <div class="dropdown-menu hidden ml-8 mt-1 space-y-1 text-sm">
                        @can('manage users')
                            <a href="{{ route('settings.users.index') }}"
                                class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
                                <i class="bi bi-person-badge"></i>
                                Users
                            </a>
                        @endcan

                        @can('manage roles')
                            <a href="{{ route('settings.roles.index') }}"
                                class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
                                <i class="bi bi-shield-lock"></i>
                                Roles & Permissions
                            </a>
                        @endcan

                        @role('super-admin')
                            <a href="{{ route('admin.audit.index') }}"
                                class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
                                <i class="bi bi-clock-history"></i>
                                Audit Logs
                            </a>
                        @endrole

                        @can('manage permissions')
                            <a href="{{ route('settings.permissions.index') }}"
                                class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
                                <i class="bi bi-shield-lock"></i>
                                Permissions
                            </a>
                        @endcan

                        <a href="{{ route('settings.regions.region') }}"
                            class="block px-4 py-2 hover:bg-gray-700 rounded">
                            <i class="bi bi-globe"></i> Regions
                        </a>

                        <a href="{{ route('settings.district') }}" class="block px-4 py-2 hover:bg-gray-700 rounded">
                            <i class="bi bi-geo"></i> Districts
                        </a>

                        <a href="{{ route('settings.currency') }}" class="block px-4 py-2 hover:bg-gray-700 rounded">
                            <i class="bi bi-coin"></i> Currencies
                        </a>
                    </div>
                </div>



            </nav>
        </aside>


        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col">

            <!-- NAVBAR -->
            <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
                <div>
                    Welcome, <strong>{{ auth()->user()->name }}</strong>
                </div>

                <!-- LOGOUT -->
                {{-- <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-red-600 hover:underline"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        Logout
                    </button>
                </form> --}}

                <div class="relative inline-block text-left">
                    <!-- User Button -->
                    <button type="button" class="flex items-center space-x-2 focus:outline-none"
                        id="user-menu-button">
                        <img class="h-8 w-8 rounded-full" src="{{ Auth::user()->profile_photo_url }}"
                            alt="User Profile">
                        <span class="font-medium text-gray-700">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden"
                        id="user-menu-dropdown">
                        <div class="py-1">
                            <!-- Profile -->
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                                Profile
                            </a>

                            <!-- Change Password -->
                            <a href="{{ route('password.change') }}"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                                Change Password
                            </a>


                            <!-- Logout -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100 hover:text-red-700">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <script>
                    const userButton = document.getElementById('user-menu-button');
                    const dropdown = document.getElementById('user-menu-dropdown');

                    userButton.addEventListener('click', () => {
                        dropdown.classList.toggle('hidden');
                    });

                    document.addEventListener('click', (e) => {
                        if (!userButton.contains(e.target) && !dropdown.contains(e.target)) {
                            dropdown.classList.add('hidden');
                        }
                    });
                </script>

            </header>

            <!-- PAGE CONTENT -->
            <main class="p-6">
                @yield('content')
            </main>

        </div>
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
