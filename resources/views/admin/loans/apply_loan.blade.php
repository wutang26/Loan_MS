@extends('layouts.admin')

@section('content')

    <h1 class="text-2xl font-bold mb-4">Dashboard</h1>

    <div class="grid grid-cols-1 gap-6">

        <!-- Back Button -->
        <div>
            <a href="{{ route('loans.show_loans') }}" class="text-blue-600 hover:underline">&larr; Back</a>
        </div>

        <!-- Form Card -->
        <div class="bg-white p-6 rounded-xl shadow-lg w-full mx-auto overflow-x-auto">

            <h2 class="text-2xl font-bold mb-6 text-center">Loan Details</h2>

        <form method="POST" action="{{ route('loans.store') }}" class="space-y-6">
    @csrf

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Loan Details --}}
    {{-- <h3 class="text-lg font-semibold border-b pb-1">Loan Details</h3> --}}

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- LEFT COLUMN --}}
        <div class="flex flex-col">
            <label class="form-label">Loan Amount</label>
            <input
                type="number"
                name="loan_amount"
                value="{{ old('loan_amount') }}"
                class="form-input"
                min="1000"
                step="0.01"
                required>
        </div>

        {{-- RIGHT COLUMN --}}
        <div class="flex flex-col">
            <label class="form-label">Loan Period (Months)</label>
            <select name="loan_period_months" class="form-input" required>
                <option value="">Select period</option>
                @for ($i = 1; $i <= 60; $i++)
                    <option value="{{ $i }}" {{ old('loan_period_months') == $i ? 'selected' : '' }}>
                        {{ $i }} Months
                    </option>
                @endfor
            </select>
        </div>
    </div>

    {{-- Purpose (Full Width) --}}
    <div class="flex flex-col">
        <label class="form-label">Purpose of Loan</label>
        <textarea
            name="purpose"
            rows="3"
            class="form-input"
            placeholder="E.g. Business expansion, school fees...">{{ old('purpose') }}</textarea>
    </div>

    {{-- Info Box --}}
    <div class="bg-blue-50 text-blue-700 p-4 rounded">
        <p class="text-sm">
            <strong>Note:</strong> Interest rate, repayment amount, and loan status
            will be calculated automatically after submission.
        </p>
    </div>

    {{-- Submit --}}
    <div class="text-center pt-6">
        <button
            type="submit"
            class="bg-blue-600 text-white px-10 py-3 rounded-lg text-lg hover:bg-blue-700 transition">
            Submit Loan Application
        </button>
    </div>
</form>

        </div>
    </div>
@endsection
