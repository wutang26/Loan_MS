@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Districts Summary</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-gray-500">Total Districts</h2>
             <p class="text-3xl font-bold">{{ $districts->count() }}</p>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-gray-500">Active Districts</h2>
            <p class="text-3xl font-bold">{{ $districts->count() }}</p>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-gray-500">Total Disbursed</h2>
            <p class="text-3xl font-bold">{{ $districts->count() }}</p>
        </div>

    </div>

    <br><br>
    @php
       $i = 0;
    @endphp

<!---Message to show success--->
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

    <div class="grid grid-cols-1 md:grid-cols-1 gap-6>

        <div g-white p-4 rounded shadow overflow-x-auto">

        <!-- Link to create Member -->
         @auth
            @role('super-admin|admin')
        <a href="{{ route('settings.districts.create_district') }}"
            style="
      background-color:#bbf7d0;
      color:#000;
      padding:10px 10px;
      border-radius:20px;
      font-size:17px;
      text-decoration:none;
      display:inline-block;
      width:fit-content;
      white-space:nowrap;">
            Register Districts
        </a>
      @endrole
    @endauth

        <table class="w-full border border-gray-300 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-3 py-2 text-left">Id</th>
                    <th class="border px-3 py-2 text-left">District Name</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($districts as $district)
                    <tr class="bg-white hover:bg-gray-100">
                        <td class="border px-3 py-2">{{ ++$i }}</td>
                        <td class="border px-3 py-2">{{ $district->name }}</td>

                          
                        @auth
                            @role('super-admin|admin')
                        <td class="border px-3 py-2">
                            <div class="flex items-center gap-2">

                                <!-- Edit Button -->
                                <a href="{{ route('settings.districts.edit_district', $district->id) }}"
                                    class="inline-flex items-center justify-center
                          px-3 py-1 min-w-[70px]
                           rounded-full text-sm font-semibold
                          bg-blue-500 text-white
                          hover:bg-blue-600 transition">
                                    Edit
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('settings.districts.deleteDistrict', $district->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this district?');">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="inline-flex items-center justify-center
                                        px-3 py-1 min-w-[70px]
                                         rounded-full text-sm font-semibold
                                         bg-red-500 text-white
                                         hover:bg-red-600 transition">
                                        Delete
                                    </button>
                                </form>

                            </div>
                        </td>
                        @endrole
                    @endauth

                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    </div>
@endsection
