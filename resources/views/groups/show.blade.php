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
                <div style="font-size:22px; font-weight:bold;">
                      <a href="{{ route('groups.available_members', $group->id) }}"
                        style="
                                /* background: linear-gradient(#5e0d0d); */
                                color:red;
                                padding:10px 16px;
                                border-radius:10px;
                                font-weight:600;
                                text-decoration:none;
                                display:inline-block;
                        ">
                          Available Members -  {{ $group->users->count() }}
                        </a>
                </div>
            </div>
                 <a href="{{ route('groups.register_member', $group->id) }}"
                        style="
                                background: linear-gradient(180deg, #065f5b, #0f766e);
                                color:white;
                                padding:10px 16px;
                                border-radius:10px;
                                font-weight:600;
                                text-decoration:none;
                                display:inline-block;
                        ">
                            + Register Group Members
                        </a>
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

                    <a href="{{ route('penalties.show_penalties', $group->id) }}"
            style="text-decoration:none; color:inherit;">

                <div style="
                    background:#f1f5f9;
                    padding:15px;
                    border-radius:12px;
                    transition:.3s;
                    cursor:pointer;
                "
                onmouseover="this.style.background='#e2e8f0'"
                onmouseout="this.style.background='#f1f5f9'">

                    <small>Penalties / Fines</small>

                    <h4 style="margin:5px 0; color:#dc2626;">
                        {{ $group->penalty_amount ?? 'Flexible' }}
                    </h4>

                </div>

            </a>
<a href="{{ route('groups.wallet', $group->id) }}" style="text-decoration:none; color:inherit;">
    <div style="background:#f1f5f9; padding:15px; border-radius:12px; transition:.3s; cursor:pointer;"
         onmouseover="this.style.background='#e2e8f0'"
         onmouseout="this.style.background='#f1f5f9'">
        <small>Group Wallet</small>
        <h4 style="margin:5px 0;">
            TZS {{ number_format($balance, 2) ?? '0.00' }}
        </h4>
    </div>
</a>

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

    <button
    style="
        background:#2563eb;
        color:white;
        border:none;
        padding:10px 18px;
        border-radius:10px;
        font-weight:600;
        cursor:pointer;
    "
    onclick="window.location='{{ route('contributions.addContribution', $group->id) }}'">

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
                                        {{ $contribution->member->first_name ?? 'Unknown Member' }}
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