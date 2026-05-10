@extends('layoutsGroup.groupdashboard')

@section('content')

<style>
    /* Wrapper */
    .contribution-wrapper {
        padding: 30px;
        background: #f4f7fb;
        min-height: 100vh;
    }

    /* Card */
    .contribution-card {
        max-width: 700px;
        margin: auto;
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
        transition: transform 0.3s;
    }
    .contribution-card:hover {
        transform: translateY(-3px);
    }

    /* Header */
    .card-header-custom {
        background: linear-gradient(135deg, #065f5b, #0f766e);
        padding: 25px 30px;
        display: flex;
        align-items: center;
        gap: 20px;
        color: white;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .icon-box {
        width: 60px;
        height: 60px;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
    }

    .card-header-text h2 {
        margin: 0;
        font-size: 22px;
        font-weight: 700;
    }

    .card-header-text p {
        margin: 5px 0 0;
        font-size: 14px;
        opacity: 0.85;
    }

    /* Form section */
    .form-section {
        padding: 30px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        font-size: 14px;
        font-weight: 600;
        color: #334155;
        margin-bottom: 8px;
    }

    .form-control-custom {
        border: 1px solid #dbe2ea;
        border-radius: 12px;
        padding: 12px 14px;
        font-size: 15px;
        transition: all 0.3s;
        background: #f8fafc;
    }

    .form-control-custom:focus {
        outline: none;
        border-color: #2563eb;
        background: white;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
    }

    .full-width {
        grid-column: 1 / -1;
    }

    /* Button */
    .submit-btn {
        background: linear-gradient(135deg, #2563eb, #4f46e5);
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 15px;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 6px 15px rgba(37, 99, 235, 0.2);
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.25);
    }

    /* Alert */
    .alert-success-custom {
        background: #dcfce7;
        color: #166534;
        padding: 12px 16px;
        border-radius: 12px;
        margin-bottom: 20px;
        font-weight: 500;
    }

    /* Amount input with icon */
    .input-with-icon {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .input-with-icon span {
        font-size: 20px;
        color: #2563eb;
    }

    /* Error message */
    .error-box {
        background: #fee2e2;
        padding: 10px 15px;
        border-radius: 10px;
        margin-bottom: 20px;
    }
    .error-box ul {
        margin: 0;
        padding-left: 20px;
    }
</style>

{{-- Errors --}}
@if ($errors->any())
<div class="error-box">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="contribution-wrapper">
    <div class="contribution-card">

        {{-- HEADER --}}
        <div class="card-header-custom">
            <div class="icon-box">
                <i class="bi bi-cash-stack"></i>
            </div>
            <div class="card-header-text">
                <h2>Add Contribution</h2>
                <p>Manage monthly member contributions for <strong>{{ $group->name }}</strong></p>
            </div>
        </div>

        {{-- FORM --}}
        <div class="form-section">
            @if(session('success'))
            <div class="alert-success-custom">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('contributions.store', $group->id) }}">
                @csrf

                <div class="form-grid">

                    {{-- MEMBER --}}
                    <div class="form-group">
                        <label>Member</label>
                        <input type="text" class="form-control-custom" value="{{ $user->name }}" disabled>
                        <input type="hidden" name="member_id" value="{{ $user->id }}">
                    </div>

                    {{-- AMOUNT --}}
                    <div class="form-group">
                        <label>Contribution Amount</label>
                        <div class="input-with-icon">
                            <span>💰</span>
                            <input type="number" name="amount" class="form-control-custom" placeholder="Enter amount" required>
                        </div>
                    </div>

                    {{-- MONTH --}}
                    <div class="form-group">
                        <label>Month</label>
                        <select name="month" class="form-control-custom" required>
                            @foreach(['January','February','March','April','May','June','July','August','September','October','November','December'] as $month)
                            <option value="{{ $month }}">{{ $month }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- YEAR --}}
                    <div class="form-group">
                        <label>Year</label>
                        <input type="number" name="year" value="{{ date('Y') }}" class="form-control-custom" required>
                    </div>

                    {{-- STATUS --}}
                    <div class="form-group full-width">
                        <label>Contribution Status</label>
                        <select name="status" class="form-control-custom">
                            <option value="paid">Paid</option>
                            <option value="pending">Pending</option>
                            <option value="overdue">Overdue</option>
                        </select>
                    </div>

                </div>

                {{-- BUTTON --}}
                <div style="margin-top:25px; text-align:center;">
                    <button type="submit" class="submit-btn">
                        <i class="bi bi-check-circle-fill"></i>
                        Save Contribution
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection