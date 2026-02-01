@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Members Summary</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-gray-500">Total Members</h2>
            <p class="text-3xl font-bold">{{ $members->count() }}</p>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-gray-500">Active Loans</h2>
            <p class="text-3xl font-bold">{{ $members->count() }}</p>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-gray-500">Total Disbursed</h2>
            <p class="text-3xl font-bold">{{ $members->count() }}</p>
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

   @auth
@role('super-admin|admin')
<div style="display:flex; align-items:center; justify-content:space-between;">

    <!-- Register Member (left) -->
    <a href="{{ route('members.create') }}"
       style="
            background-color:#bbf7d0;
            color:#000;
            padding:10px 14px;
            border-radius:20px;
            font-size:17px;
            text-decoration:none;
            white-space:nowrap;">
        Register Member
    </a>

    <!-- Register Group (right) -->
    <a href="{{ route('members.create') }}"
       style="
            background-color:#bbf7d0;
            color:#000;
            padding:10px 14px;
            border-radius:20px;
            font-size:17px;
            text-decoration:none;
            white-space:nowrap;">
        Register Group
    </a>

</div>
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
                    <th class="border px-3 py-2 text-left">Member Reg Number</th>
                    <th class="border px-3 py-2 text-left">First Name</th>
                    <th class="border px-3 py-2 text-left">Middle Name</th>
                    <th class="border px-3 py-2 text-left">Last Name</th>
                    <th class="border px-3 py-2 text-left">Phone Number</th>
                    <th class="border px-3 py-2 text-left">Home Address</th>
                    <th class="border px-3 py-2 text-left">Region</th>
                    <th class="border px-3 py-2 text-left">District</th>
                    <th class="border px-3 py-2 text-left">Date Joined</th>
                    <th class="border px-3 py-2 text-left"">Status</th>

                       @auth
                            @role('super-admin|admin')
                        <th class="border px-3 py-2 text-left">Actions</th>
                    @endrole
                @endauth
                
                </tr>
            </thead>

            <tbody>
                @foreach ($members as $member)
                    <tr class="bg-white hover:bg-gray-100">
                        <td class="border px-3 py-2">{{ ++$i }}</td>
                        <td class="border px-3 py-2">{{ $member->member_number }}</td>
                        <td class="border px-3 py-2">{{ $member->first_name }}</td>
                        <td class="border px-3 py-2">{{ $member->middle_name }}</td>
                        <td class="border px-3 py-2">{{ $member->last_name }}</td>
                        <td class="border px-3 py-2">{{ $member->phone }}</td>
                        <td class="border px-3 py-2">{{ $member->address }}</td>
                        <td class="border px-3 py-2">{{ $member->region->name }}</td>
                        <td class="border px-3 py-2">{{ $member->district->name }}</td>
                        <td class="border px-3 py-2">{{ $member->date_joined }}</td>
                        <td class="border px-3 py-2">
                            <span
                                class="inline-flex items-center justify-center min-w-[90px] px-3 py-1 rounded-full
                             text-sm font-semibold text-center
                             {{ $member->status === 'active'
                                 ? 'bg-green-100 text-green-700'
                                 : ($member->status === 'pending'
                                     ? 'bg-yellow-100 text-yellow-700'
                                     : 'bg-red-100 text-red-700') }}">
                                {{ ucfirst($member->status) }}
                            </span>

                        </td>

                        @auth
                            @role('super-admin|admin')
                                <td class="border px-3 py-2">
                                    <a href="{{ route('admin.members.edit', $member->id) }}"
                                        class="inline-flex items-center justify-center
              min-w-[70px] px-3 py-1
              rounded-full text-sm font-semibold
              bg-blue-500 text-white
              hover:bg-blue-600 transition">
                                        Edit
                                    </a>

                                    <br><br>
                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.members.deleteMember', $member->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this member?');">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="inline-flex items-center justify-center
                       px-3 py-1 min-w-[70px]
                       rounded-full text-sm font-semibold
                       bg-red-500 text-white
                       hover:bg-red-600 transition">
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
