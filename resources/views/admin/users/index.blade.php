@extends('layouts.admin')

@section('content')
<h2 class="text-xl font-bold mb-4">Assign Roles to Users</h2>

<table class="w-full bg-white rounded shadow">
    <thead>
        <tr class="border-b">
            <th class="p-2">User</th>
            <th class="p-2">Email</th>
            <th class="p-2">Role</th>
            <th class="p-2">Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($users as $user)
        <tr class="border-b">
            <td class="p-2">{{ $user->name }}</td>
            <td class="p-2">{{ $user->email }}</td>

            <td class="p-2">
                <form action="{{ route('admin.users.role', $user->id) }}" method="POST">
                    @csrf
                    <select name="role" class="border p-1 rounded">
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}"
                                {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
            </td>

            <td class="p-2">
                    <button class="bg-blue-600 text-white px-3 py-1 rounded">
                        Save
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
