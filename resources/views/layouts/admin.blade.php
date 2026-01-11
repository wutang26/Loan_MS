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


                <a href="#" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
                    <i class="bi bi-file-earmark-text"></i>
                    Loan Applications
                </a>

                <a href="#" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
                    <i class="bi bi-check-circle"></i>
                    Loan Approvals
                </a>

                <a href="#" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
                    <i class="bi bi-cash-stack"></i>
                    Loan Disbursement
                </a>

                <a href="#" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
                    <i class="bi bi-briefcase"></i>
                    Active Loans
                </a>

                <a href="#" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
                    <i class="bi bi-credit-card"></i>
                    Repayments
                </a>

                <!-- REPORTS DROPDOWN -->
                <div x-data="{ open: false }">
                    <button @click="open = !open"
                        class="w-full flex items-center justify-between gap-3 px-4 py-2 hover:bg-gray-700">
                        <div class="flex items-center gap-3">
                            <i class="bi bi-bar-chart"></i>
                            Reports
                        </div>
                        <i class="bi bi-chevron-down text-xs"></i>
                    </button>

                    <div x-show="open" x-transition class="ml-8 mt-1 space-y-1 text-sm">
                       
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
                        <a href="#"
                            class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
                            <i class="bi bi-credit-card"></i>
                            Repayments Report
                        </a>
                     @endcan

                    @can('manage pdf')
                        <a href="#"
                            class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
                            <i class="bi bi-arrow-left-right"></i>
                            Disbursement Report
                        </a>
                        @endcan

                    </div>
                </div>


                <hr class="my-2 border-gray-700">


                <!-- SETTINGS DROPDOWN -->
                <div x-data="{ open: false }">
                    <button @click="open = !open"
                        class="w-full flex items-center justify-between gap-3 px-4 py-2 hover:bg-gray-700">
                        <div class="flex items-center gap-3">
                            <i class="bi bi-gear"></i>
                            Settings
                        </div>
                        <i class="bi bi-chevron-down text-xs"></i>
                    </button>

                    <div x-show="open" class="ml-8 mt-1 space-y-1 text-sm">

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

                        @can('manage roles')
                            <a href="{{ route('settings.roles.index') }}"
                                class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
                                <i class="bi bi-shield-lock"></i>
                                Roles
                            </a>
                        @endcan

                        <a href="{{ route('settings.regions.region') }}"
                            class="block px-4 py-2 hover:bg-gray-700 rounded">
                            🌍 Regions
                        </a>

                        <a href="{{ route('settings.district') }}" class="block px-4 py-2 hover:bg-gray-700 rounded">
                            🏙 Districts
                        </a>

                        <a href="{{ route('settings.currency') }}" class="block px-4 py-2 hover:bg-gray-700 rounded">
                            💱 Currencies
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
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-red-600 hover:underline"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        Logout
                    </button>
                </form>
            </header>

            <!-- PAGE CONTENT -->
            <main class="p-6">
                @yield('content')
            </main>

        </div>
    </div>

</body>

</html>
