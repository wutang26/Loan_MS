@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Dashboard</h1>

    <div class="grid grid-cols-1 gap-6">

        <!-- Back Button -->
        <div>
            <a href="{{ route('settings.roles.index') }}" class="text-blue-600 hover:underline">&larr; Back</a>
        </div>

        <!-- Form Card -->
        <div class="bg-white p-6 rounded-xl shadow-lg w-full mx-auto overflow-x-auto">

            <h2 class="text-2xl font-bold mb-6 text-center">Register Role</h2>

            <form method="POST" action="{{ route('settings.roles.storeRole') }}" class="space-y-6">
                @csrf

                <h3 class="text-lg font-semibold mb-3 border-b pb-1">Basic Information</h3>

               <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <!-- Role Name -->
    <div class="flex flex-col">
        <label class="form-label">Role Name</label>
        <input type="text" name="lable" class="form-input max-w-md" required>
    </div>

    <!-- Description -->
    <div class="flex flex-col">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-input max-w-md"></textarea>
    </div>

    <!-- Status -->
    <div class="flex flex-col">
        <label class="form-label">Status</label>
        <select name="is_active" class="form-input max-w-md" required>
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>
    </div>

    <!-- Permissions -->
    <div class="flex flex-col md:col-span-2">
        <!-- permissions stay SAME -->
    </div>

</div>



                    <!-- role (RIGHT) -->
                <div class="flex flex-col md:col-span-2">
                  <label class="form-label mb-2 font-bold">Permissions</label>

                <div class="space-y-6">
                    @foreach ($permissions as $module => $modulePermissions)

                        <!-- Permission Group Header -->
                        <div class="border rounded-lg p-4">
                            <h3 class="text-lg font-bold text-gray-700 mb-3">
                                {{ ucfirst($module) }}
                            </h3>

                            <!-- Permissions under the group -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                @foreach ($modulePermissions as $permission)
                                    <label class="flex items-center space-x-2">
                                        <input
                                            type="checkbox"
                                            name="permissions[]"
                                            value="{{ $permission->id }}"
                                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                        <span class="text-sm text-gray-700">
                                            {{ $permission->label ?? $permission->name }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                    @endforeach
                </div>

                </div>
                
               
                </div>

                <div class="mt-10 text-center">
                    <button type="submit"
                        class="bg-blue-600 text-white px-10 py-3 rounded-lg text-lg hover:bg-blue-700 transition">
                        Save Role
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection
