@extends('layoutsGroup.groupdashboard')

@section('content')

<div style="max-width:800px; margin:auto; padding:30px;">

    <div style="
        background:white;
        border-radius:24px;
        overflow:hidden;
        box-shadow:0 10px 30px rgba(0,0,0,.08);
    ">

        <!-- HEADER -->
        <div style="
            background:linear-gradient(135deg,#065f5b,#0f766e); /* Sidebar color theme */
            padding:35px;
            color:white;
        ">

            <h2 style="
                margin:0;
                font-size:28px;
                font-weight:700;
            ">
                Penalties & Fines
            </h2>

            <p style="
                margin-top:8px;
                opacity:.9;
            ">
                Manage penalties and fines for <strong>{{ $group->name }}</strong>
            </p>

        </div>

        <!-- BODY -->
        <div style="padding:35px;">

            <!-- Success Message -->
            @if(session('success'))
                <div style="
                    background:#dcfce7; /* subtle green alert */
                    color:#166534;
                    padding:14px 18px;
                    border-radius:12px;
                    margin-bottom:25px;
                    font-weight:500;
                ">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Error Message -->
            @if(session('error'))
                <div style="
                    background:#fde68a; /* subtle yellow alert */
                    color:#78350f;
                    padding:14px 18px;
                    border-radius:12px;
                    margin-bottom:25px;
                    font-weight:500;
                ">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('penalties.store', $group->id) }}">
                @csrf

                <!-- MEMBER -->
                <div class="form-group" style="margin-bottom:20px;">
                    <label style="font-weight:600;">Member</label>
                    <select name="member_id" class="form-control-custom" required style="
                        width:100%;
                        padding:14px;
                        border-radius:12px;
                        border:1px solid #dbe2ea;
                        background:#f8fafc;
                    ">
                        <option value="">-- Select Member --</option>
                        @forelse($members as $member)
                            <option value="{{ $member->id }}">
                                {{ $member->first_name }} {{ $member->last_name }}
                            </option>
                        @empty
                            <option value="" disabled>No members available</option>
                        @endforelse
                    </select>
                </div>

                <!-- AMOUNT -->
                <div style="margin-bottom:20px;">
                    <label style="display:block; margin-bottom:8px; font-weight:600;">Penalty Amount</label>
                    <input type="number" name="amount" required placeholder="Enter amount" style="
                        width:100%;
                        padding:14px;
                        border-radius:12px;
                        border:1px solid #dbe2ea;
                        background:#f8fafc;
                    ">
                </div>

                <!-- REASON -->
                <div style="margin-bottom:20px;">
                    <label style="display:block; margin-bottom:8px; font-weight:600;">Reason</label>
                    <textarea name="reason" required rows="4" placeholder="Why is this penalty issued?" style="
                        width:100%;
                        padding:14px;
                        border-radius:12px;
                        border:1px solid #dbe2ea;
                        background:#f8fafc;
                    "></textarea>
                </div>

                <!-- STATUS -->
                <div style="margin-bottom:25px;">
                    <label style="display:block; margin-bottom:8px; font-weight:600;">Status</label>
                    <select name="status" style="
                        width:100%;
                        padding:14px;
                        border-radius:12px;
                        border:1px solid #dbe2ea;
                        background:#f8fafc;
                    ">
                        <option value="pending">Pending</option>
                        <option value="paid">Paid</option>
                        <option value="waived">Waived</option>
                    </select>
                </div>

                <!-- BUTTON -->
                <div style="text-align:center;">
                    <button type="submit" style="
                        background:linear-gradient(135deg,#065f5b,#0f766e); /* sidebar color */
                        color:white;
                        border:none;
                        padding:14px 28px;
                        border-radius:12px;
                        font-weight:600;
                        cursor:pointer;
                        font-size:15px;
                        box-shadow:0 8px 20px rgba(0,0,0,.15);
                        transition:transform .2s;
                    " onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                        Save Penalty
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

@endsection