@extends('layoutsGroup.groupdashboard')

@section('content')

<div class="container" style="padding:30px;">

    <!-- HEADER -->
    <div style="
        background: linear-gradient(135deg,#0f172a,#1e293b);
        color:white;
        padding:25px;
        border-radius:16px;
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:20px;
    ">

        <div>
            <h2 style="margin:0;">{{ $group->name }} Members</h2>
            <p style="margin:5px 0 0; color:#cbd5e1;">
                Active registered group members
            </p>
        </div>

        <div style="text-align:right;">
            <div style="font-size:14px; color:#94a3b8;">Total Members</div>
            <div style="font-size:24px; font-weight:bold;">
                {{ $members->count() }}
            </div>
        </div>

    </div>

    <!-- MEMBERS TABLE -->
    <div style="
        background:white;
        border-radius:16px;
        padding:20px;
        box-shadow:0 6px 20px rgba(0,0,0,0.05);
    ">

        <table style="width:100%; border-collapse:collapse;">

            <thead>
                <tr style="background:#f8fafc; text-align:left;">
                    <th style="padding:14px;">Member Name</th>
                    <th style="padding:14px;">Phone</th>
                    <th style="padding:14px;">Status</th>
                    <th style="padding:14px;">Joined</th>
                </tr>
            </thead>

            <tbody>

                @forelse($members as $member)

                    <tr style="border-top:1px solid #eef2f7;">

                        <!-- NAME -->
                        <td style="padding:14px; font-weight:600; color:#1e293b;">
                            {{ $member->first_name }} {{ $member->last_name }}
                        </td>

                        <!-- PHONE -->
                        <td style="padding:14px; color:#475569;">
                            {{ $member->phone }}
                        </td>

                        <!-- STATUS -->
                        <td style="padding:14px;">
                            @if($member->status == 'active')
                                <span style="
                                    background:#dcfce7;
                                    color:#16a34a;
                                    padding:6px 12px;
                                    border-radius:20px;
                                    font-size:12px;
                                    font-weight:600;
                                ">
                                    Active
                                </span>
                            @else
                                <span style="
                                    background:#fee2e2;
                                    color:#dc2626;
                                    padding:6px 12px;
                                    border-radius:20px;
                                    font-size:12px;
                                    font-weight:600;
                                ">
                                    Inactive
                                </span>
                            @endif
                        </td>

                        <!-- DATE -->
                        <td style="padding:14px; color:#64748b;">
                            {{ $member->created_at->format('d M Y') }}
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="4" style="padding:30px; text-align:center; color:#94a3b8;">
                            No members found in this group
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection