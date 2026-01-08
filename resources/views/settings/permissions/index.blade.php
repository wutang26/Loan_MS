@extends('layouts.admin')

@section('content')

<!---A counter for table id's---->
@php
    $i = 0;
@endphp

<h1 class="text-2xl font-bold mb-4">Permissions Summary</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-gray-500">Total Permission</h2>
            <p class="text-3xl font-bold"></p>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-gray-500">Active Permission</h2>
            <p class="text-3xl font-bold"></p>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-gray-500">Total Permission</h2>
            <p class="text-3xl font-bold"></p>
        </div>

    </div>

<!---Message to show success--->
@if(session('success'))
    <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif


<br><br>

 
<div class="grid grid-cols-1 md:grid-cols-1 gap-6>

        <div g-white p-4 rounded shadow overflow-x-auto">

        <!-- Link to create Permission -->
         @auth
            @role('super-admin|admin')
                <a href="{{ route('settings.permissions.create') }}"
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
                    Register Permission
                </a>
            @endrole
        @endauth

        <table class="w-full border border-gray-300 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-3 py-2 text-left">Id</th>
                    <th class="border px-3 py-2 text-left">Permission Name</th>
                    <th class="border px-3 py-2 text-left">Module</th>
                    <th class="border px-3 py-2 text-left">Description</th>
                    <th class="border px-3 py-2 text-left">Created Date</th>
                    <th class="border px-3 py-2 text-left"">Status</th>
                
                 @auth
                            @role('super-admin|admin')
                    <th class="border px-3 py-2 text-left">Actions</th>
                 @endrole
            @endauth
                </tr>
            </thead>

            <tbody>
                @foreach ($permissions as $permission)
                    <tr class="bg-white hover:bg-gray-100">
                       <td class="border px-3 py-2">{{ ++$i }}</td>
                        <td class="border px-3 py-2">{{ $permission->name }}</td>
                        <td class="border px-3 py-2">{{ $permission->module }}</td>
                        <td class="border px-3 py-2">{{ $permission->description }}</td>
                        <td class="border px-3 py-2">{{ $permission->created_at->format('d M Y, h:i A') }}</td>
                        <td class="border px-3 py-2">
                        <span
                        class="inline-flex items-center justify-center min-w-[90px] px-3 py-1 rounded-full
                             text-sm font-semibold text-center
                             {{ $permission->status === 'active'
                              ? 'bg-green-100 text-green-700'
                              : ($permission->status === 'pending'
                              ? 'bg-yellow-100 text-yellow-700'
                              : 'bg-red-100 text-red-700') }}">
                                {{ ucfirst($permission->status) }}
                            </span>

                        </td>

                          
                        @auth
                            @role('super-admin|admin')
                        <td class="border px-3 py-2">
                            <a href="{{ route('settings.permissions.edit', $permission->id) }}"
                                class="inline-flex items-center justify-center
                                min-w-[70px] px-3 py-1
                                rounded-full text-sm font-semibold
                                bg-blue-500 text-white
                                hover:bg-blue-600 transition">
                                Edit
                            </a>

               <br><br>
                               <!-- Delete Button -->
        <form action="{{ route('settings.permissions.deletePermission', $permission->id) }}"
              method="POST"
              onsubmit="return confirm('Are you sure you want to delete this permission?');">
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
</div>
@endsection
