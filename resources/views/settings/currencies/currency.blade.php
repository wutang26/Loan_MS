@extends('layouts.admin')

@section('content')

<!---Message to show success--->
@if(session('success'))
    <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<h1 class="text-2xl font-bold mb-4">Districts Summary</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-gray-500">Total Districts</h2>
            <p class="text-3xl font-bold">{{ $currencies->count() }}</p>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-gray-500">Active Districts</h2>
            <p class="text-3xl font-bold">{{ $currencies->count() }}</p>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-gray-500">Total Disbursed</h2>
            <p class="text-3xl font-bold">{{ $currencies->count() }}</p>
        </div>

    </div>


<br><br>

<div class="grid grid-cols-1 gap-6">

    <div class="bg-white p-4 rounded shadow overflow-x-auto">

         @auth
            @role('super-admin|admin')
        <!-- Link to create Currency -->
        <a href="{{ route('settings.currencies.create_currency') }}"
           class="bg-green-200 text-black px-4 py-2 rounded-full inline-block mb-4">
            Register Currency
        </a>
         @endrole
    @endauth
  


        <table class="w-full border border-gray-300 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-3 py-2 text-left">Id</th>
                    <th class="border px-3 py-2 text-left">Currency Name</th>
                     @auth
                            @role('super-admin|admin')
                    <th class="border px-3 py-2 text-left">Actions</th>
                    @endrole
                @endauth
                
                </tr>
            </thead>

            <tbody>
                @foreach ($currencies as $currency)
                    <tr class="bg-white hover:bg-gray-100">
                        <td class="border px-3 py-2">{{ $currency->id }}</td>
                        <td class="border px-3 py-2">{{ $currency->name }}</td>


                              
                        @auth
                            @role('super-admin|admin')
                        <td class="border px-3 py-2">
                            <div class="flex gap-2">
                            
                                <a href="{{ route('settings.currencies.edit_currency', $currency->id) }}"
                                   class="px-3 py-1 rounded-full bg-blue-500 text-white text-sm">
                                    Edit
                                </a>

                                <form action="{{ route('settings.currencies.deleteCurrency', $currency->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="px-3 py-1 rounded-full bg-red-500 text-white text-sm">
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
