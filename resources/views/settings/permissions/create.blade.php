@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Dashboard</h1>

    <div class="grid grid-cols-1 gap-6">

        <!-- Back Button -->
        <div>
            <a href="{{ route('settings.permissions.index') }}" class="text-blue-600 hover:underline">&larr; Back</a>
        </div>

        <!-- Form Card -->
        <div class="bg-white p-6 rounded-xl shadow-lg w-full mx-auto overflow-x-auto">


                    @if ($errors->any())
                <div class="mb-4 rounded bg-red-100 p-4 text-red-700">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <h2 class="text-2xl font-bold mb-6 text-center">Register Permission</h2>

           <form method="POST" action="{{ route('settings.permissions.storePermission') }}" class="space-y-6">
    @csrf

    <h3 class="text-lg font-semibold mb-3 border-b pb-1">Basic Information</h3>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <!-- Module -->
    <div class="flex flex-col">
        <label class="form-label">Module Name</label>
        <select name="module" class="form-input max-w-md" required>
            <option value="">-- Select Permission Group --</option>
            <option value="loan_officer">Loan Officer</option>
            <option value="accountant">Accountant</option>
            <option value="users">Users</option>
            <option value="roles">Roles</option>
        </select>
    </div>

    <!-- Permission Label -->
    <div class="flex flex-col">
        <label class="form-label">Permission Label</label>
       <input
    type="text"
    name="permissions"
    placeholder="Approve loans, View loans, Delete loans" class="form-input max-w-md" required>
    </div>

    <!-- Description (LEFT) -->
    <div class="flex flex-col">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-input max-w-md" rows="4"></textarea>
    </div>

    <!-- Status -->
    <div class="flex flex-col">
        <label class="form-label">Status</label>
        <select name="is_active" class="form-input max-w-md" required>
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>
    </div>

</div>

    <div class="mt-10 text-center">
        <button type="submit"
            class="bg-blue-600 text-white px-10 py-3 rounded-lg text-lg hover:bg-blue-700 transition">
            Save Permission
        </button>
    </div>
</form>

        </div>
    </div>
@endsection
