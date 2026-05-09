@extends('layoutsGroup.groupdashboard')

@section('content')

<div class="row" style="gap:20px;">

    <!-- 🔵 GROUP HEADER CARD -->
    <div class="card col-12" style="padding:25px; border-radius:16px; background:linear-gradient(135deg,#0f172a,#1e293b); color:white;">
        <div style="display:flex; justify-content:space-between; align-items:center;">
            <div>
                <h2 style="margin:0; font-size:26px;">{{ $group->name }}</h2>
                <p style="margin-top:5px; color:#cbd5e1;">{{ $group->description }}</p>
                <small>Group ID: #{{ $group->id }}</small>
            </div>

            <div style="text-align:right;">
                <div style="font-size:22px; font-weight:bold;">
                    <a href="{{ route('groups.available_members', $group->id) }}"
                       style="color:red; padding:10px 16px; border-radius:10px; font-weight:600; text-decoration:none;">
                        Available Members - {{ $group->users->count() }}
                    </a>
                </div>
            </div>

            <a href="{{ route('groups.register_member', $group->id) }}"
               style="background: linear-gradient(180deg, #065f5b, #0f766e); color:white; padding:10px 16px; border-radius:10px; font-weight:600; text-decoration:none;">
                + Register Group Members
            </a>
        </div>
    </div>

    <!-- 🟢 WALLET SUMMARY STATS -->
    <div class="card col-12" style="padding:20px; border-radius:16px;">
        <h3 style="margin-bottom:15px;">💼 Wallet Summary</h3>
        <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(180px,1fr)); gap:15px;">

            <div style="background:#f1f5f9; padding:15px; border-radius:12px;">
                <small>Current Balance</small>
                <h4 style="margin:5px 0; color:#065f46; font-weight:700;">TZS {{ number_format($balance, 2) }}</h4>
            </div>

            <div style="background:#f1f5f9; padding:15px; border-radius:12px;">
                <small>Total Distribution</small>
                <h4 style="margin:5px 0; color:#2563eb; font-weight:700;">
                    TZS {{ number_format($totalDistribution ?? 0, 2) }}
                </h4>
            </div>

            <div style="background:#f1f5f9; padding:15px; border-radius:12px;">
                <small>Total Loans Out</small>
                <h4 style="margin:5px 0; color:#f59e0b; font-weight:700;">
                    TZS {{ number_format($totalLoans ?? 0, 2) }}
                </h4>
            </div>

            <div style="background:#f1f5f9; padding:15px; border-radius:12px;">
                <small>Total Welfare Given</small>
                <h4 style="margin:5px 0; color:#8b5cf6; font-weight:700;">
                    TZS {{ number_format($totalWelfare ?? 0, 2) }}
                </h4>
            </div>

        </div>
    </div>

    <!-- 🟢 WALLET TRANSACTIONS CARD -->
    <div class="card col-12" style="padding:25px; border-radius:16px; background:#f1f5f9;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:25px;">
            <h3 style="margin:0;">💰 Wallet Transactions</h3>
            <button onclick="window.location='{{ route('wallets.create_transaction', $group->id) }}'"
                    style="background:#2563eb; color:white; border:none; padding:10px 18px; border-radius:10px; font-weight:600; cursor:pointer;">
                + Add Transaction
            </button>
        </div>

        <div style="overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse; border-radius:14px; background:white;">
                <thead style="background:#f8fafc;">
                    <tr>
                        <th style="padding:16px; color:#475569;">Date</th>
                        <th style="padding:16px; color:#475569;">Member / Source</th>
                        <th style="padding:16px; color:#475569;">Type</th>
                        <th style="padding:16px; color:#475569;">Amount (TZS)</th>
                        <th style="padding:16px; color:#475569;">Description</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $transaction)
                        <tr style="border-top:1px solid #eef2f7;">
                            <td style="padding:16px;">{{ $transaction->created_at->format('d M Y') }}</td>
                            <td style="padding:16px;">{{ $transaction->member?->first_name ?? 'System' }}</td>
                            <td style="padding:16px;">
                                <span style="padding:6px 14px; border-radius:30px; font-size:12px; font-weight:600; color:white; background:{{ $transaction->type == 'credit' ? '#16a34a' : '#dc2626' }};">
                                    {{ ucfirst($transaction->type) }}
                                </span>
                            </td>
                            <td style="padding:16px; font-weight:600; color:{{ $transaction->type == 'credit' ? '#16a34a' : '#dc2626' }};">
                                {{ number_format($transaction->amount, 2) }}
                            </td>
                            <td style="padding:16px;">{{ $transaction->description ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="padding:30px; text-align:center; color:#94a3b8;">No transactions found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection