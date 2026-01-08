@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Dashboard</h1>

    <div class="grid grid-cols-1 gap-6">

        <!-- Back Button -->
        <div>
            <a href="{{ route('settings.users.index') }}" class="text-blue-600 hover:underline">&larr; Back</a>
        </div>

        <!-- Form Card -->
        <div class="bg-white p-6 rounded-xl shadow-lg w-full mx-auto overflow-x-auto">

            <h2 class="text-2xl font-bold mb-6 text-center">Register New Member</h2>

            <form method="POST" action="{{ route('settings.users.storeUser') }}" class="space-y-6">
                @csrf

                <!-- SECTION: BASIC INFO -->
                <h3 class="text-lg font-semibold mb-3 border-b pb-1">Basic Information</h3>
                <!-- ROW 1 -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- User Name (LEFT) -->
                    <div class="flex flex-col">
                        <label class="form-label">User Name</label>
                        <input type="text" name="name" class="form-input max-w-md" required>
                    </div>

                        <!-- Date Joined (RIGHT) -->
                        <div class="flex flex-col">
                            <label class="form-label">Date Joined</label>
                            <input type="date" name="date_joined" class="form-input max-w-md" required>
                        </div>
                    </div>

                                                             <!-- ROW 2 -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <!-- Email (LEFT) -->
                    <div class="flex flex-col">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-input max-w-md" required>
                    </div>

                    <!-- Status (RIGHT, SAME LINE AS EMAIL) -->
                    <div class="flex flex-col">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-input max-w-md" required>
                            <option value="">Select Status</option>
                            <option value="active">Active</option>
                            <option value="pending">Pending</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>

                <!-- ROW 3 : PASSWORD -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <!-- Password -->
                    <div class="flex flex-col">
                        <label class="form-label">Password</label>
                        <input
                            type="password"
                            name="password"
                            class="form-input max-w-md"
                            required
                            minlength="8"
                            placeholder="Enter password">
                    </div>

                    <!-- Confirm Password -->
                    <div class="flex flex-col">
                        <label class="form-label">Confirm Password</label>
                        <input
                            type="password"
                            name="password_confirmation"
                            class="form-input max-w-md"
                            required
                            minlength="8"
                            placeholder="Confirm password">
                    </div>
                </div>

                <!-- ROW 4 : Role Selection -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
    <div class="flex flex-col">
        <label class="form-label">Role</label>
        <select name="role" class="form-input max-w-md" required>
            <option value="">Select Role</option>
            @foreach($roles as $role)
                <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
            @endforeach
        </select>
    </div>
</div>


                <!-- BUTTON -->
                <div class="mt-10 text-center">
                    <button type="submit"
                        class="bg-blue-600 text-white px-10 py-3 rounded-lg text-lg hover:bg-blue-700 transition">
                        Save User
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
