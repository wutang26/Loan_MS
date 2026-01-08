@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">Edit Permission</h1>

<div class="grid grid-cols-1 gap-6">

    <!-- Back Button -->
    <div>
        <a href="{{ route('settings.permissions.index') }}" class="text-blue-600 hover:underline">&larr; Back</a>
    </div>

    <!-- Form Card -->
    <div class="bg-white p-6 rounded-xl shadow-lg w-full mx-auto overflow-x-auto">

        <h2 class="text-2xl font-bold mb-6 text-center">Edit Permission</h2>

        <form method="POST" action="{{ route('settings.permissions.updatePermission', $permission->id) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <h3 class="text-lg font-semibold mb-3 border-b pb-1">Basic Information</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Module -->
                <div class="flex flex-col">
                    <label class="form-label">Module Name</label>
                    <select name="module" class="form-input max-w-md" required>
                        <option value="">-- Select Module --</option>
                        <option value="loan_officer" {{ old('module', $permission->module) == 'loan_officer' ? 'selected' : '' }}>Loan Officer</option>
                        <option value="accountant" {{ old('module', $permission->module) == 'accountant' ? 'selected' : '' }}>Accountant</option>
                        <option value="users" {{ old('module', $permission->module) == 'users' ? 'selected' : '' }}>Users</option>
                        <option value="roles" {{ old('module', $permission->module) == 'roles' ? 'selected' : '' }}>Roles</option>
                    </select>
                </div>

                <!-- Permission Label -->
                <div class="flex flex-col">
                    <label class="form-label">Permission Label</label>
                    <input type="text" name="lable" class="form-input max-w-md" required
                           value="{{ old('lable', $permission->lable) }}">
                </div>

                <!-- Description -->
                <div class="flex flex-col md:col-span-2">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-input max-w-md" rows="4">{{ old('description', $permission->description) }}</textarea>
                </div>

            </div>

            <h3 class="text-lg font-semibold mt-8 mb-3 border-b pb-1">Status</h3>

            <div class="flex flex-col">
                <label class="form-label">Status</label>
                <select name="is_active" class="form-input max-w-md" required>
                    <option value="1" {{ old('is_active', $permission->is_active) == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('is_active', $permission->is_active) == 0 ? 'selected' : '' }}>Inactive</option>
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
