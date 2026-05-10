@extends('layoutsGroup.groupdashboard')

@section('content')
<style>
    /* Grid Layout for the form */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }

    /* Full width for fields that should span both columns */
    .full-width {
        grid-column: 1 / -1;
    }

    /* Form elements styling */
    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 5px;
        color: #333;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #007BFF;
        box-shadow: 0 0 4px rgba(0, 123, 255, 0.4);
    }

    /* Submit button styling */
    .btn-submit {
        background-color: #007BFF;
        color: white;
        font-weight: 600;
        padding: 10px 15px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-submit:hover {
        background-color: #0056b3;
    }

    /* Error box styling */
    .error-box {
        background-color: #f8d7da;
        color: #842029;
        border: 1px solid #f5c2c7;
        padding: 15px;
        border-radius: 6px;
        margin-bottom: 20px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="container" style="max-width: 900px; margin: auto; padding: 20px; background: #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.1); border-radius: 10px;">
    <h2 style="font-size: 28px; font-weight: bold; margin-bottom: 20px; color: #333;">Welfare Support & Loan Management</h2>

    {{-- Error Messages --}}
    @if ($errors->any())
        <div class="error-box">
            <ul style="margin:0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form --}}
    <form action="{{ route('welfareSupports.store') }}" method="POST">
        @csrf

        <div class="form-grid">

            {{-- Providing Group --}}
            <div class="form-group">
                <label for="group_id">Providing Group</label>
                <select name="group_id" id="group_id">
                    <option value="">Select Group</option>
                    @foreach($groups as $group)
                        <option value="{{ $group->id }}" {{ old('group_id') == $group->id ? 'selected' : '' }}>
                            {{ $group->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Recipient --}}
            <div class="form-group">
                <label for="user_id">Recipient</label>
                <select name="user_id" id="user_id">
                    <option value="">Select Individual</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Event Type --}}
            <div class="form-group">
                <label for="event_type_id">Event Type</label>
                <select name="event_type_id" id="event_type_id">
                    <option value="">Select Event Type</option>
                    @foreach($eventTypes as $type)
                        <option value="{{ $type->id }}" {{ old('event_type_id') == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Mode --}}
            <div class="form-group">
                <label for="mode">Mode</label>
                <select name="mode" id="mode" onchange="toggleRepayment()">
                    <option value="">Select Mode</option>
                    <option value="support" {{ old('mode') == 'support' ? 'selected' : '' }}>Support (No Repayment)</option>
                    <option value="loan" {{ old('mode') == 'loan' ? 'selected' : '' }}>Loan (Repayment Required)</option>
                </select>
            </div>

            {{-- Amount --}}
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" name="amount" id="amount" step="0.01" value="{{ old('amount') }}">
            </div>

            {{-- Repayment Amount --}}
            <div class="form-group" id="repaymentDiv" style="display:none;">
                <label for="repayment_amount">Repayment Amount</label>
                <input type="number" name="repayment_amount" id="repayment_amount" step="0.01" value="{{ old('repayment_amount') }}">
            </div>

            {{-- Description (full width) --}}
            <div class="form-group full-width">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="4">{{ old('description') }}</textarea>
            </div>

        </div>

        {{-- Submit Button --}}
        <div class="form-group full-width">
            <button type="submit" class="btn-submit">Submit</button>
        </div>
    </form>
</div>

<script>
    function toggleRepayment() {
        const mode = document.getElementById('mode').value;
        const repaymentDiv = document.getElementById('repaymentDiv');
        repaymentDiv.style.display = (mode === 'loan') ? 'block' : 'none';
    }

    window.onload = toggleRepayment;
</script>
@endsection