@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">Edit Permission</h1>

<div class="grid grid-cols-1 gap-6">

    <!-- Back Button -->
    <div>
        <a href="{{ route('settings.roles.index') }}" class="text-blue-600 hover:underline">&larr; Back</a>
    </div>

    <!-- Form Card -->
    <div class="bg-white p-6 rounded-xl shadow-lg w-full mx-auto overflow-x-auto">

        <h2 class="text-2xl font-bold mb-6 text-center">Edit Role</h2>

        <form method="POST" action="{{ route('settings.roles.updateRole', $role->id) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <h3 class="text-lg font-semibold mb-3 border-b pb-1">Basic Information</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Module -->
                <div class="flex flex-col">
                    <label class="form-label">Module Name</label>
                    <select name="module" class="form-input max-w-md" required>
                        <option value="">-- Select Module --</option>
                        <option value="loan_officer" {{ old('module', $role->module) == 'loan_officer' ? 'selected' : '' }}>Loan Officer</option>
                        <option value="accountant" {{ old('module', $role->module) == 'accountant' ? 'selected' : '' }}>Accountant</option>
                        <option value="users" {{ old('module', $role->module) == 'users' ? 'selected' : '' }}>Users</option>
                        <option value="roles" {{ old('module', $role->module) == 'roles' ? 'selected' : '' }}>Roles</option>
                    </select>
                </div>

                <!-- Role Label -->
                <div class="flex flex-col">
                    <label class="form-label">Role Label</label>
                    <input type="text" name="lable" class="form-input max-w-md" required
                           value="{{ old('lable', $role->lable) }}">
                </div>

                <!-- Description -->
                <div class="flex flex-col md:col-span-2">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-input max-w-md" rows="4">{{ old('description', $role->description) }}</textarea>
                </div>

                 <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                              @foreach ($permissions as $module => $modulePermissions)

    <h3 class="font-semibold text-gray-700 mt-6">
        {{ ucfirst($module) }}
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
        @foreach ($modulePermissions as $permission)
            <label class="flex items-center space-x-2">
                <input
                    type="checkbox"
                    name="permissions[]"
                    value="{{ $permission->id }}"
                    {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}
                    class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                >
                <span class="text-sm text-gray-700">
                    {{ $permission->label ?? $permission->name }}
                </span>
            </label>
        @endforeach
    </div>

@endforeach

                            </div>

            
            </div>


            <h3 class="text-lg font-semibold mt-8 mb-3 border-b pb-1">Status</h3>

            <div class="flex flex-col">
                <label class="form-label">Status</label>
                <select name="is_active" class="form-input max-w-md" required>
                    <option value="1" {{ old('is_active', $role->is_active) == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('is_active', $role->is_active) == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <!-- BUTTON -->
            <div class="mt-10 text-center">
                <button type="submit"
                        class="bg-blue-600 text-white px-10 py-3 rounded-lg text-lg hover:bg-blue-700 transition">
                    Update Permission
                </button>
            </div>
        </form>

    </div>
</div>
@endsection
