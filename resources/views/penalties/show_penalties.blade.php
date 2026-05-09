@extends('layoutsGroup.groupdashboard')

@section('content')

<div style="
    padding:30px;
    background:#f8fafc;
    min-height:100vh;
">

    <!-- TOP HEADER -->
    <div style="
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:25px;
        flex-wrap:wrap;
        gap:15px;
    ">

        <div>

            <h2 style="
                margin:0;
                font-size:30px;
                font-weight:700;
                color:#0f172a;
            ">
                Penalties & Fines
            </h2>

            <p style="
                margin-top:6px;
                color:#64748b;
                font-size:15px;
            ">
                Manage and track group penalties professionally
            </p>

        </div>

        <!-- ADD PENALTY BUTTON -->
        <a href="{{ route('penalties.create_penalties', $group->id) }}"
           style="
                background:linear-gradient(135deg,#065f46,#0f766e);
                color:white;
                text-decoration:none;
                padding:13px 22px;
                border-radius:14px;
                font-weight:600;
                box-shadow:0 8px 20px rgba(15,118,110,.2);
                transition:.3s;
           ">

            + Add New Penalty

        </a>

    </div>

    <!-- SUMMARY CARDS -->
    <div style="
        display:grid;
        grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
        gap:20px;
        margin-bottom:30px;
    ">

        <!-- TOTAL -->
        <div style="
            background:white;
            padding:22px;
            border-radius:18px;
            box-shadow:0 4px 15px rgba(0,0,0,.05);
        ">

            <small style="color:#64748b;">Total Penalties</small>

            <h2 style="
                margin:10px 0 0;
                color:#dc2626;
            ">
                {{ $penalties->count() }}
            </h2>

        </div>

        <!-- PENDING -->
        <div style="
            background:white;
            padding:22px;
            border-radius:18px;
            box-shadow:0 4px 15px rgba(0,0,0,.05);
        ">

            <small style="color:#64748b;">Pending Payments</small>

            <h2 style="
                margin:10px 0 0;
                color:#f59e0b;
            ">
                {{ $penalties->where('status','pending')->count() }}
            </h2>

        </div>

        <!-- PAID -->
        <div style="
            background:white;
            padding:22px;
            border-radius:18px;
            box-shadow:0 4px 15px rgba(0,0,0,.05);
        ">

            <small style="color:#64748b;">Paid Penalties</small>

            <h2 style="
                margin:10px 0 0;
                color:#16a34a;
            ">
                {{ $penalties->where('status','paid')->count() }}
            </h2>

        </div>

    </div>

    <!-- TABLE CARD -->
    <div style="
        background:white;
        border-radius:24px;
        overflow:hidden;
        box-shadow:0 10px 30px rgba(0,0,0,.05);
    ">

        <!-- TABLE HEADER -->
        <div style="
            padding:25px 30px;
            border-bottom:1px solid #e2e8f0;
        ">

            <h3 style="
                margin:0;
                color:#0f172a;
            ">
                Penalty Records
            </h3>

        </div>

        <!-- TABLE -->
        <div style="overflow-x:auto;">

            <table style="
                width:100%;
                border-collapse:collapse;
            ">

                <thead>

                    <tr style="
                        background:#f8fafc;
                        text-align:left;
                    ">

                        <th style="padding:18px;">Member</th>

                        <th style="padding:18px;">Amount</th>

                        <th style="padding:18px;">Reason</th>

                        <th style="padding:18px;">Status</th>

                        <th style="padding:18px;">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($penalties as $penalty)

                        <tr style="
                            border-top:1px solid #f1f5f9;
                        ">

                            <!-- MEMBER -->
                            <td style="padding:18px;">

                                <div style="
                                    display:flex;
                                    align-items:center;
                                    gap:12px;
                                ">

                                    <div style="
                                        width:45px;
                                        height:45px;
                                        border-radius:50%;
                                        background:#fee2e2;
                                        color:#dc2626;
                                        display:flex;
                                        align-items:center;
                                        justify-content:center;
                                        font-weight:700;
                                    ">

                                        {{ strtoupper(substr($penalty->member->first_name ?? 'M',0,1)) }}

                                    </div>

                                    <div>

                                        <div style="
                                            font-weight:600;
                                            color:#0f172a;
                                        ">

                                            {{ $penalty->member->first_name ?? '' }}
                                            {{ $penalty->member->last_name ?? '' }}

                                        </div>

                                        <small style="
                                            color:#64748b;
                                        ">
                                            Member ID:
                                            #{{ $penalty->member_id }}
                                        </small>

                                    </div>

                                </div>

                            </td>

                            <!-- AMOUNT -->
                            <td style="
                                padding:18px;
                                font-weight:700;
                                color:#dc2626;
                            ">

                                TZS {{ number_format($penalty->amount,2) }}

                            </td>

                            <!-- REASON -->
                            <td style="
                                padding:18px;
                                color:#475569;
                            ">

                                {{ $penalty->reason }}

                            </td>

                            <!-- STATUS -->
                            <td style="padding:18px;">

                                @if($penalty->status == 'paid')

                                    <span style="
                                        background:#dcfce7;
                                        color:#16a34a;
                                        padding:7px 14px;
                                        border-radius:30px;
                                        font-size:12px;
                                        font-weight:600;
                                    ">
                                        Paid
                                    </span>

                                @elseif($penalty->status == 'pending')

                                    <span style="
                                        background:#fef3c7;
                                        color:#d97706;
                                        padding:7px 14px;
                                        border-radius:30px;
                                        font-size:12px;
                                        font-weight:600;
                                    ">
                                        Pending
                                    </span>

                                @else

                                    <span style="
                                        background:#e2e8f0;
                                        color:#475569;
                                        padding:7px 14px;
                                        border-radius:30px;
                                        font-size:12px;
                                        font-weight:600;
                                    ">
                                        Waived /Forgiven
                                    </span>

                                @endif

                            </td>

                            <!-- ACTION -->
                            <td style="padding:18px;">

                                @if($penalty->status == 'pending')

                                    <form method="POST"
                                          action="{{ route('penalties.pay', $penalty->id) }}">

                                        @csrf
                                        @method('PUT')

                                        <button type="submit"
                                            style="
                                                background:#16a34a;
                                                color:white;
                                                border:none;
                                                padding:10px 16px;
                                                border-radius:10px;
                                                cursor:pointer;
                                                font-weight:600;
                                            ">

                                            Pay Now

                                        </button>

                                    </form>

                                @else

                                    <span style="
                                        color:#16a34a;
                                        font-weight:600;
                                    ">
                                        Completed
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5"
                                style="
                                    padding:40px;
                                    text-align:center;
                                    color:#94a3b8;
                                ">

                                No penalties available

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection