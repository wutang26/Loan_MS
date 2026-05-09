@extends('layoutsGroup.groupdashboard')

@section('content')

<div class="row" style="gap:20px;">

    <!-- 🔵 GROUP HEADER CARD -->
    <div class="card col-12" style="padding:25px; border-radius:16px; background:linear-gradient(135deg,#0f172a,#1e293b); color:white;">
        
        <div style="display:flex; justify-content:space-between; align-items:center;">
            
            <div>
                <h2 style="margin:0; font-size:26px;">{{ $group->name }}</h2>
                <p style="margin-top:5px; color:#cbd5e1;">{{ $group->description }}</p>
            </div>

            <div style="text-align:right;">
                <div style="font-size:14px; color:#94a3b8;">Members</div>
                <div style="font-size:22px; font-weight:bold;">
                    {{ $group->users->count() }}
                </div>
            </div>

        </div>

    </div>


    <!-- 🟢 LOAN RULES CARD -->
    <div class="card col-12" style="padding:20px; border-radius:16px;">

        <h3 style="margin-bottom:15px;">📌 Group Status</h3>

        <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:15px;">

            <div style="background:#f1f5f9; padding:15px; border-radius:12px;">
                <small>Contributions</small>
                <h4 style="margin:5px 0;">{{ $group->interest_rate ?? 'Michango' }}</h4>
            </div>

            <div style="background:#f1f5f9; padding:15px; border-radius:12px;">
                <small>Penalties / Fines</small>
                <h4 style="margin:5px 0;">{{ $group->max_loan ?? 'Flexible' }}</h4>
            </div>

            <div style="background:#f1f5f9; padding:15px; border-radius:12px;">
                <small>Group Wallet</small>
                <h4 style="margin:5px 0;">{{ $group->repayment_period ?? 'Balance' }}</h4>
            </div>

        </div>

    </div>


    <!-- 🟣 LOAN REQUEST FORM -->
    <div class="card col-12" style="padding:25px; border-radius:18px; background:#fff; box-shadow:0 4px 12px rgba(0,0,0,0.05);">

    <!-- Header -->
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        
        <div>
            <h3 style="margin:0; font-size:22px; color:#1e293b;">
                💰 Monthly Contributions
            </h3>

            <p style="margin:5px 0 0; color:#64748b; font-size:14px;">
                Group members monthly contribution records
            </p>
        </div>

        <button style="
            background:#2563eb;
            color:white;
            border:none;
            padding:10px 18px;
            border-radius:10px;
            font-weight:600;
            cursor:pointer;
        ">
            + Add Contribution
        </button>

    </div>

    <!-- Table -->
    <div style="overflow-x:auto;">

        <table style="
            width:100%;
            border-collapse:collapse;
            overflow:hidden;
            border-radius:14px;
        ">

            <!-- Table Head -->
            <thead>

                <tr style="background:#f8fafc; text-align:left;">

                    <th style="padding:16px; color:#475569; font-size:14px;">
                        Member
                    </th>

                    <th style="padding:16px; color:#475569; font-size:14px;">
                        Amount
                    </th>

                    <th style="padding:16px; color:#475569; font-size:14px;">
                        Month
                    </th>

                    <th style="padding:16px; color:#475569; font-size:14px;">
                        Status
                    </th>

                </tr>

            </thead>

            <!-- Table Body -->
            <tbody>

                @forelse($contributions as $contribution)

                    <tr style="border-top:1px solid #eef2f7; transition:0.3s;">

                        <!-- Member -->
                        <td style="padding:16px;">

                            <div style="display:flex; align-items:center; gap:12px;">

                                <div style="
                                    width:40px;
                                    height:40px;
                                    border-radius:50%;
                                    background:#dbeafe;
                                    color:#2563eb;
                                    display:flex;
                                    align-items:center;
                                    justify-content:center;
                                    font-weight:700;
                                ">
                                    {{ strtoupper(substr($contribution->member->name ?? 'M',0,1)) }}
                                </div>

                                <div>
                                    <div style="font-weight:600; color:#1e293b;">
                                        {{ $contribution->member->name ?? 'Unknown Member' }}
                                    </div>

                                    <div style="font-size:13px; color:#64748b;">
                                        Member ID: #{{ $contribution->member_id }}
                                    </div>
                                </div>

                            </div>

                        </td>

                        <!-- Amount -->
                        <td style="padding:16px; font-weight:600; color:#16a34a;">
                            Tzs {{ number_format($contribution->amount, 2) }}
                        </td>

                        <!-- Month -->
                        <td style="padding:16px; color:#475569;">
                            {{ $contribution->month }}
                        </td>

                        <!-- Status -->
                        <td style="padding:16px;">

                            @if($contribution->status == 'paid')

                                <span style="
                                    background:#dcfce7;
                                    color:#16a34a;
                                    padding:6px 14px;
                                    border-radius:30px;
                                    font-size:12px;
                                    font-weight:600;
                                ">
                                    Paid
                                </span>

                            @else

                                <span style="
                                    background:#fee2e2;
                                    color:#dc2626;
                                    padding:6px 14px;
                                    border-radius:30px;
                                    font-size:12px;
                                    font-weight:600;
                                ">
                                    Pending
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4" style="
                            padding:30px;
                            text-align:center;
                            color:#94a3b8;
                            font-size:15px;
                        ">
                            No contributions found
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

</div>

@endsection