@extends('layouts.admin')

@section('content')
    {{-- <h1 class="text-2xl font-bold mb-4">Admin Dashboard</h1> --}}

    {{-- <div class="bg-white p-6 rounded shadow">
        You are logged in as <strong>{{ auth()->user()->usertype }}</strong>
    </div> --}}
    
      <br><br>
    <div class="bg-white p-10 rounded shadow">
        @include('statics.estimated_joined')
    </div>
@endsection
