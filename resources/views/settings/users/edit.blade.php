@extends('layouts.admin')

@section('content')

<!------Hii inanisaidia ku debug  errors on submiting---->

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul >
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif

            <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
    <div class="grid grid-cols-1 gap-6">

        <!-- Back Button -->
        <div>
            <a href="{{ route('settings.users.index') }}" class="text-blue-600 hover:underline">&larr; Back</a>
        </div>

        <!-- Form Card -->
        <div class="bg-white p-6 rounded-xl shadow-lg w-full mx-auto overflow-x-auto">

            <h2 class="text-2xl font-bold mb-6 text-center">Edit User</h2>

            <form method="POST" action="{{ route('settings.users.updateUser', $user->id) }}" class="space-y-6">
                @csrf
                @method('PUT') <!-- important for update -->

                <!-- SECTION: BASIC INFO -->
                <h3 class="text-lg font-semibold mb-3 border-b pb-1">Basic Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div class="flex flex-col">
                        <label class="form-label">User Name</label>
                        <input type="text" name="name" class="form-input max-w-md" required
                               value="{{ old('name', $user->name) }}">
                    </div>

                    <!-- User Type -->
                    <div class="flex flex-col">
                        <label class="form-label">User Type (Role)</label>
                        <input type="text" name="usertype" class="form-input max-w-md" required
                               value="{{ old('usertype', $user->usertype) }}">
                    </div>
                </div>

                <!-- Email and Status (same row) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <!-- Email -->
                    <div class="flex flex-col">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-input max-w-md" required
                               value="{{ old('email', $user->email) }}">
                    </div>

                    <!-- Status -->
                    <div class="flex flex-col">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-input max-w-md" required>
                            <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="pending" {{ $user->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                </div>

                <!-- Password fields (optional, only fill if changing password) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <div class="flex flex-col">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-input max-w-md"
                               placeholder="Leave blank to keep current password">
                    </div>

                    <div class="flex flex-col">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-input max-w-md"
                               placeholder="Leave blank to keep current password">
                    </div>
                </div>

                <!-- BUTTON -->
                <div class="mt-10 text-center">
                    <button type="submit"
                        class="bg-blue-600 text-white px-10 py-3 rounded-lg text-lg hover:bg-blue-700 transition">
                        Update User
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
