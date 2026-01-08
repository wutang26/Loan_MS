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

        <h2 class="text-2xl font-bold mb-6 text-center">Edit District</h2>

        <form method="POST"
              action="{{ route('settings.districts.updateDistrict', $district->id) }}">
            @csrf
            @method('PUT')

            <h3 class="text-lg font-semibold mb-3 border-b pb-1">
                Basic Information
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- District Name -->
                <div class="flex flex-col">
                    <label class="form-label">District Name</label>
                    <input type="text"
                           name="name"
                           class="form-input max-w-md"
                           required
                           value="{{ old('name', $district->name) }}">
                </div>

                <!-- Region Selection (PRESELECTED) -->
                <div class="flex flex-col">
                    <label class="form-label">Region</label>
                    <select name="region_id"
                            class="form-input max-w-md"
                            required>
                        <option value="">-- Select Region --</option>

                        @foreach ($regions as $region)
                            <option value="{{ $region->id }}"
                                {{ old('region_id', $district->region_id) == $region->id ? 'selected' : '' }}>
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
                    Update District
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
