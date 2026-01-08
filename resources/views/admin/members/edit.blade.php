@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Dashboard</h1>

    <div class="grid grid-cols-1 gap-6">

        <!-- Back Button -->
        <div>
            <a href="{{ route('admin.members.index') }}" class="text-blue-600 hover:underline">&larr; Back</a>
        </div>

        <!-- Form Card -->
        <div class="bg-white p-6 rounded-xl shadow-lg w-full mx-auto overflow-x-auto">

            <h2 class="text-2xl font-bold mb-6 text-center">Edit Member</h2>

            <form method="POST" action="{{ route('admin.members.update', $member->id) }}" class="space-y-6">
                @csrf
                @method('PUT') <!-- important for update -->

                <!-- SECTION: BASIC INFO -->
                <h3 class="text-lg font-semibold mb-3 border-b pb-1">Basic Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex flex-col">
                        <label class="form-label">Member Reg. No.</label>
                        <input type="text" name="member_number" class="form-input max-w-md" required
                               value="{{ old('member_number', $member->member_number) }}">
                    </div>

                    <div class="flex flex-col">
                        <label class="form-label">Date Joined</label>
                        <input type="date" name="date_joined" class="form-input max-w-md" required
                               value="{{ old('date_joined', $member->date_joined) }}">
                    </div>

                    <div class="flex flex-col">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-input max-w-md" required
                               value="{{ old('first_name', $member->first_name) }}">
                    </div>

                    <div class="flex flex-col">
                        <label class="form-label">Middle Name</label>
                        <input type="text" name="middle_name" class="form-input max-w-md"
                               value="{{ old('middle_name', $member->middle_name) }}">
                    </div>

                    <div class="flex flex-col">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-input max-w-md" required
                               value="{{ old('last_name', $member->last_name) }}">
                    </div>

                    <div class="flex flex-col">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-input max-w-md" required
                               value="{{ old('phone', $member->phone) }}">
                    </div>
                </div>

                <!-- SECTION: LOCATION -->
                <h3 class="text-lg font-semibold mt-8 mb-3 border-b pb-1">Location</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex flex-col">
                        <label class="form-label">Region</label>
                        <select name="region_id" class="form-input max-w-md" required>
                            @foreach ($regions as $region)
                                <option value="{{ $region->id }}"
                                    {{ $member->region_id == $region->id ? 'selected' : '' }}>
                                    {{ $region->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-col">
                        <label class="form-label">District</label>
                        <select name="district_id" class="form-input max-w-md" required>
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}"
                                    {{ $member->district_id == $district->id ? 'selected' : '' }}>
                                    {{ $district->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Home Address + Status -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <div class="flex flex-col">
                        <label class="form-label">Home Address</label>
                        <input type="text" name="address" class="form-input max-w-md" required
                               value="{{ old('address', $member->address) }}">
                    </div>

                    <div class="flex flex-col">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-input max-w-md" required>
                            <option value="active" {{ $member->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $member->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                             <option value="pending" {{ $member->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    
                        </select>
                    </div>
                </div>

                <!-- BUTTON -->
                <div class="mt-10 text-center">
                    <button type="submit"
                        class="bg-blue-600 text-white px-10 py-3 rounded-lg text-lg hover:bg-blue-700 transition">
                        Update Member
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
