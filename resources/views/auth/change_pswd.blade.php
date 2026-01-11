@extends('layouts.admin')

@section('content')
<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Change Password
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <!-- Success Message -->
                @if(session('status'))
                    <div class="mb-4 text-green-600 font-medium">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('PUT')

                    <!-- Current Password -->
                    <div class="mb-4">
                        <label for="current_password" class="block font-medium text-gray-700">Current Password</label>
                        <input id="current_password" type="password" name="current_password"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                               required autofocus>
                        @error('current_password')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- New Password -->
                    <div class="mb-4">
                        <label for="password" class="block font-medium text-gray-700">New Password</label>
                        <input id="password" type="password" name="password"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                               required>
                        @error('password')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="block font-medium text-gray-700">Confirm New Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                               required>
                    </div>

                    <div>
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Change Password
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

@endsection
