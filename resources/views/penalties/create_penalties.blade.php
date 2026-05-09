@extends('layoutsGroup.groupdashboard')

@section('content')

<div style="
    max-width:800px;
    margin:auto;
    padding:30px;
">

    <div style="
        background:white;
        border-radius:24px;
        overflow:hidden;
        box-shadow:0 10px 30px rgba(0,0,0,.08);
    ">

        <!-- HEADER -->
        <div style="
            background:linear-gradient(135deg,#b91c1c,#dc2626);
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
                Manage group fines and penalty records
            </p>

        </div>

        <!-- BODY -->
        <div style="padding:35px;">

            <form method="POST"
                action="{{ route('penalties.store', $group->id) }}">

                @csrf

                <!-- MEMBER -->
                <div style="margin-bottom:20px;">

                    <label style="
                        display:block;
                        margin-bottom:8px;
                        font-weight:600;
                    ">
                        Select Member
                    </label>

                    <select name="member_id"
                        required
                        style="
                            width:100%;
                            padding:14px;
                            border-radius:14px;
                            border:1px solid #dbe2ea;
                            background:#f8fafc;
                        ">

                        <option value="">
                            -- Select Member --
                        </option>

                        @foreach($members as $member)

                            <option value="{{ $member->id }}">
                                {{ $member->first_name }}
                                {{ $member->last_name }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- AMOUNT -->
                <div style="margin-bottom:20px;">

                    <label style="
                        display:block;
                        margin-bottom:8px;
                        font-weight:600;
                    ">
                        Penalty Amount
                    </label>

                    <input type="number"
                        name="amount"
                        required
                        placeholder="Enter amount"
                        style="
                            width:100%;
                            padding:14px;
                            border-radius:14px;
                            border:1px solid #dbe2ea;
                            background:#f8fafc;
                        ">

                </div>

                <!-- REASON -->
                <div style="margin-bottom:20px;">

                    <label style="
                        display:block;
                        margin-bottom:8px;
                        font-weight:600;
                    ">
                        Reason
                    </label>

                    <textarea
                        name="reason"
                        required
                        rows="4"
                        placeholder="Why is this penalty issued?"
                        style="
                            width:100%;
                            padding:14px;
                            border-radius:14px;
                            border:1px solid #dbe2ea;
                            background:#f8fafc;
                        "></textarea>

                </div>

                <!-- STATUS -->
                <div style="margin-bottom:25px;">

                    <label style="
                        display:block;
                        margin-bottom:8px;
                        font-weight:600;
                    ">
                        Status
                    </label>

                    <select name="status"
                        style="
                            width:100%;
                            padding:14px;
                            border-radius:14px;
                            border:1px solid #dbe2ea;
                            background:#f8fafc;
                        ">

                        <option value="pending">
                            Pending
                        </option>

                        <option value="paid">
                            Paid
                        </option>

                        <option value="waived">
                            Waived
                        </option>

                    </select>

                </div>

                <!-- BUTTON -->
                <div style="text-align:center;">

                    <button type="submit"
                        style="
                            background:linear-gradient(135deg,#dc2626,#b91c1c);
                            color:white;
                            border:none;
                            padding:14px 28px;
                            border-radius:14px;
                            font-weight:600;
                            cursor:pointer;
                            font-size:15px;
                            box-shadow:0 8px 20px rgba(5, 109, 109, 0.25);
                        ">

                        Save Penalty

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection