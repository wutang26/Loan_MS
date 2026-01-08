@extends('layouts.admin')

@section('content')
<h2 class="text-xl font-bold mb-6">Roles & Permissions</h2>

@if(session('success'))
    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@foreach($roles as $role)
<div class="bg-white rounded shadow mb-6 p-4">
    
    <h3 class="text-lg font-semibold mb-3">
        Role: {{ ucfirst($role->name) }}
    </h3>

    <form method="POST"
          action="{{ route('admin.roles.permissions.update', $role->id) }}">
        @csrf

        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">

            @foreach($permissions as $permission)
                <label class="flex items-center gap-2">
                    <input type="checkbox"
                           name="permissions[]"
                           value="{{ $permission->name }}"
                           {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                    {{ $permission->name }}
                </label>
            @endforeach

        </div>

        <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">
            Save Permissions
        </button>
    </form>
</div>
@endforeach
@endsection
