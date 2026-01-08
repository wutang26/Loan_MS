@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">Districts</h1>

<div class="grid grid-cols-1 gap-6">

    <!-- Back Button -->
    <div>
        <a href="{{ route('settings.district') }}" class="text-blue-600 hover:underline">&larr; Back</a>
    </div>

    <!-- Form Card -->
    <div class="bg-white p-6 rounded-xl shadow-lg w-full mx-auto overflow-x-auto">

        <h2 class="text-2xl font-bold mb-6 text-center">Register New District</h2>

        <form method="POST" action="{{ route('settings.districts.storeDistrict') }}" class="space-y-6">
            @csrf

            <h3 class="text-lg font-semibold mb-3 border-b pb-1">Basic Information</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- District Name -->
                <div class="flex flex-col">
                    <label class="form-label">District Name</label>
                    <input type="text"
                           name="name"
                           class="form-input max-w-md"
                           placeholder="Enter district name"
                           required>
                </div>

                <!-- Region Selection (FIXED) -->
                <div class="flex flex-col">
                    <label class="form-label">Region</label>
                    <select name="region_id"
                            class="form-input max-w-md"
                            required>
                        <option value="">-- Select Region --</option>
                        @foreach ($regions as $region)
                            <option value="{{ $region->id }}">
                                {{ $region->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            <!-- BUTTON -->
            <div class="mt-10 text-center">
                <button type="submit"
                    class="bg-blue-600 text-white px-10 py-3 rounded-lg text-lg hover:bg-blue-700 transition">
                    Save District
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
