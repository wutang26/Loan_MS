@extends('layoutsGroup.groupdashboard')

@section('content')

<style>
    .contribution-wrapper{
        padding:30px;
        background:#f4f7fb;
        min-height:100vh;
    }

    .contribution-card{
        max-width:750px;
        margin:auto;
        background:white;
        border-radius:24px;
        overflow:hidden;
        box-shadow:0 10px 35px rgba(0,0,0,0.06);
    }

    .card-header-custom{
        background: linear-gradient(180deg, #065f5b, #0f766e);
        padding:35px;
        color:white;
    }

    .card-header-custom h2{
        margin:0;
        font-size:30px;
        font-weight:700;
    }

    .card-header-custom p{
        margin-top:8px;
        opacity:.9;
        font-size:15px;
    }

    .form-section{
        padding:35px;
    }

    .form-grid{
        display:grid;
        grid-template-columns:1fr 1fr;
        gap:20px;
    }

    @media(max-width:768px){
        .form-grid{
            grid-template-columns:1fr;
        }
    }

    .form-group{
        display:flex;
        flex-direction:column;
    }

    .form-group label{
        font-size:14px;
        font-weight:600;
        color:#334155;
        margin-bottom:8px;
    }

    .form-control-custom{
        border:1px solid #dbe2ea;
        border-radius:14px;
        padding:14px 16px;
        font-size:15px;
        transition:.3s;
        background:#f8fafc;
    }

    .form-control-custom:focus{
        outline:none;
        border-color:#2563eb;
        background:white;
        box-shadow:0 0 0 4px rgba(37,99,235,.1);
    }

    .full-width{
        grid-column:1 / -1;
    }

    .submit-btn{
        background:linear-gradient(135deg,#2563eb,#4f46e5);
        color:white;
        border:none;
        padding:14px 30px;
        border-radius:14px;
        font-weight:600;
        font-size:15px;
        cursor:pointer;
        transition:.3s;
        box-shadow:0 8px 20px rgba(37,99,235,.2);
    }

    .submit-btn:hover{
        transform:translateY(-2px);
    }

    .alert-success-custom{
        background:#dcfce7;
        color:#166534;
        padding:14px 18px;
        border-radius:14px;
        margin-bottom:25px;
        font-weight:500;
    }

    .icon-box{
        width:70px;
        height:70px;
        background:rgba(85, 5, 23, 0.15);
        border-radius:18px;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:30px;
        margin-bottom:18px;
    }
</style>
<!----Error handling----->
@if ($errors->any())
    <div style="background:#fee2e2; padding:10px; border-radius:10px; margin-bottom:15px;">
        <ul style="margin:0;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="contribution-wrapper">

    <div class="contribution-card">

        <!-- HEADER -->
        <div class="card-header-custom">

            <div class="icon-box">
                <i class="bi bi-cash-stack"></i>
            </div>

            <h2>Add Contribution</h2>

            <p>
                Manage monthly member contributions for 
                <strong>{{ $group->name }}</strong>
            </p>

        </div>

        <!-- BODY -->
        <div class="form-section">

            @if(session('success'))

                <div class="alert-success-custom">
                    {{ session('success') }}
                </div>

            @endif

            <form method="POST"
                  action="{{ route('contributions.store', $group->id) }}">

                @csrf

                <div class="form-grid">

                    <!-- MEMBER -->
                    <div class="form-group">

                        <label>Select Member</label>

                        <div class="form-group">

                            <label>Member</label>

                            <input type="text"
                                class="form-control-custom"
                                value="{{ $user->name }}"
                                disabled>

                            <!-- hidden field to submit actual member id -->
                            <input type="hidden" name="member_id" value="{{ $user->id }}">

                        </div>

                    </div>

                    <!-- AMOUNT -->
                    <div class="form-group">

                        <label>Contribution Amount</label>

                        <input type="number"
                               name="amount"
                               class="form-control-custom"
                               placeholder="Enter amount"
                               required>

                    </div>

                    <!-- MONTH -->
                    <div class="form-group">

                        <label>Month</label>

                        <select name="month"
                                class="form-control-custom"
                                required>

                            @foreach([
                                'January','February','March','April',
                                'May','June','July','August',
                                'September','October','November','December'
                            ] as $month)

                                <option value="{{ $month }}">
                                    {{ $month }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- YEAR -->
                    <div class="form-group">

                        <label>Year</label>

                        <input type="number"
                               name="year"
                               value="{{ date('Y') }}"
                               class="form-control-custom"
                               required>

                    </div>

                    <!-- STATUS -->
                    <div class="form-group full-width">

                        <label>Contribution Status</label>

                        <select name="status"
                                class="form-control-custom">

                            <option value="paid">
                                Paid
                            </option>

                            <option value="pending">
                                Pending
                            </option>

                            <option value="overdue">
                                Overdue
                            </option>

                        </select>

                    </div>

                </div>

                <!-- BUTTON -->
                <div style="margin-top:30px; text-align:center;">

                    <button type="submit"
                            class="submit-btn">

                        <i class="bi bi-check-circle-fill"></i>
                        Save Contribution

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection