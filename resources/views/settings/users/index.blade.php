@extends('layouts.admin')

@section('content')

<!---Message to show success--->
@if(session('success'))
    <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<h1 class="text-2xl font-bold mb-4">Dashboard</h1>


<!-- Summary Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-gray-500">Total users</h2>
        <p class="text-3xl font-bold">{{ $users->count() }}</p>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-gray-500">Active Loans</h2>
        <p class="text-3xl font-bold">{{ $users->count() }}</p>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-gray-500">Total Disbursed</h2>
        <p class="text-3xl font-bold">{{ $users->count() }}</p>
    </div>
</div>

<!-- Users Section -->
<div class="grid grid-cols-1 gap-6">
    <div class="bg-white p-4 rounded shadow overflow-x-auto">

        <!-- Register Button -->
         @auth
            @role('super-admin|admin')
        <a href="{{ route('settings.users.create') }}"
           class="inline-block mb-4 px-4 py-2 rounded-full
                  bg-green-200 text-black text-sm font-semibold">
            Register User
        </a>
    @endrole
  @endauth

        @php $i = 0; @endphp

        <!-- Users Table -->
        <table class="w-full border border-gray-300 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-3 py-2 text-left">Id</th>
                    <th class="border px-3 py-2 text-left">User Name</th>
                    <th class="border px-3 py-2 text-left">Email</th>
                    <th class="border px-3 py-2 text-left">User Type (Role)</th>
                    <th class="border px-3 py-2 text-left">Date Joined</th>
                    <th class="border px-3 py-2 text-left">Status</th>

                    @auth
                            @role('super-admin|admin')
                    <th class="border px-3 py-2 text-left">Actions</th>
                    @endrole
                @endauth

                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                <tr class="bg-white hover:bg-gray-100">
                    <td class="border px-3 py-2">{{ ++$i }}</td>
                    <td class="border px-3 py-2">{{ $user->name }}</td>
                    <td class="border px-3 py-2">{{ $user->email }}</td>

                  <td class="border px-3 py-2 space-x-1">
                        @foreach($user->roles as $role)
                            <span class="inline-block bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs">
                                {{ $role->name }}
                            </span>
                        @endforeach
                    </td>

                    <td class="border px-3 py-2">
                        {{ $user->created_at->format('d M Y') }}
                    </td>

                    <!-- Status -->
                    <td class="border px-3 py-2">
                        <span class="inline-flex items-center justify-center
                                     min-w-[90px] px-3 py-1 rounded-full
                                     text-sm font-semibold
                            {{ $user->status === 'active'
                                ? 'bg-green-100 text-green-700'
                                : ($user->status === 'pending'
                                    ? 'bg-yellow-100 text-yellow-700'
                                    : 'bg-red-100 text-red-700') }}">
                            {{ ucfirst($user->status) }}
                        </span>
                    </td>

                    <!-- Actions -->
                          
                        @auth
                            @role('super-admin|admin')
                    <td class="border px-3 py-2 space-y-2">
                        <a href="{{ route('settings.users.editUser', $user->id) }}"
                           class="inline-flex items-center justify-center
                                  min-w-[70px] px-3 py-1 rounded-full
                                  text-sm font-semibold
                                  bg-blue-500 text-white hover:bg-blue-600">
                            Edit
                        </a>

                        <form action="{{ route('settings.users.deleteUser', $user->id) }}"
                              method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this user?');">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="inline-flex items-center justify-center
                                       min-w-[70px] px-3 py-1 rounded-full
                                       text-sm font-semibold
                                       bg-red-500 text-white hover:bg-red-600">
                                Delete
                            </button>
                        </form>
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
