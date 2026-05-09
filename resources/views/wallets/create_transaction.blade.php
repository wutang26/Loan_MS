@extends('layoutsGroup.groupdashboard')

@section('content')
<div class="card col-12" style="padding:30px; border-radius:16px; background:#f8fafc; box-shadow:0 6px 15px rgba(0,0,0,0.05);">

    <!-- Header -->
    <div style="margin-bottom:25px;">
        <h2 style="font-size:24px; font-weight:700; color:#1e293b; margin-bottom:5px;">💼 Add Wallet Transaction</h2>
        <p style="color:#64748b;">Group: <strong>{{ $group->name }}</strong></p>
    </div>

    <!-- Form -->
    <form action="{{ route('wallets.store_transaction', $group->id) }}" method="POST" style="display:grid; gap:20px;">
        @csrf

        <!-- Row 1: Amount + Type -->
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
            <!-- Amount -->
            <div style="display:flex; flex-direction:column;">
                <label style="margin-bottom:6px; font-weight:600; color:#334155;">Amount (TZS)</label>
                <input type="number" name="amount" required
                       style="padding:12px 15px; border:1px solid #cbd5e1; border-radius:10px; font-size:14px; outline:none; transition:0.2s;"
                       onfocus="this.style.borderColor='#2563eb'; this.style.boxShadow='0 0 0 2px rgba(37,99,235,0.2)'"
                       onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none'"
                       placeholder="Enter amount">
            </div>

            <!-- Type -->
            <div style="display:flex; flex-direction:column;">
                <label style="margin-bottom:6px; font-weight:600; color:#334155;">Type</label>
                <select name="type" required
                        style="padding:12px 15px; border:1px solid #cbd5e1; border-radius:10px; font-size:14px; outline:none; transition:0.2s;"
                        onfocus="this.style.borderColor='#2563eb'; this.style.boxShadow='0 0 0 2px rgba(37,99,235,0.2)'"
                        onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none'">
                    <option value="credit">Credit (Deposit)</option>
                    <option value="debit">Debit (Deduction)</option>
                </select>
            </div>
        </div>

        <!-- Row 2: Member + Description -->
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
            <!-- Member -->
            <div style="display:flex; flex-direction:column;">
                <label style="margin-bottom:6px; font-weight:600; color:#334155;">Member (Optional)</label>
                <select name="member_id"
                        style="padding:12px 15px; border:1px solid #cbd5e1; border-radius:10px; font-size:14px; outline:none; transition:0.2s;"
                        onfocus="this.style.borderColor='#2563eb'; this.style.boxShadow='0 0 0 2px rgba(37,99,235,0.2)'"
                        onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none'">
                    <option value="">System / None</option>
                    @foreach($members as $member)
                        <option value="{{ $member->id }}">{{ $member->first_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Description -->
            <div style="display:flex; flex-direction:column;">
                <label style="margin-bottom:6px; font-weight:600; color:#334155;">Description</label>
                <input type="text" name="description" placeholder="Optional"
                       style="padding:12px 15px; border:1px solid #cbd5e1; border-radius:10px; font-size:14px; outline:none; transition:0.2s;"
                       onfocus="this.style.borderColor='#2563eb'; this.style.boxShadow='0 0 0 2px rgba(37,99,235,0.2)'"
                       onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none'">
            </div>
        </div>

        <!-- Submit Button -->
        <div style="display:flex; justify-content:flex-end;">
            <button type="submit"
                    style="padding:12px 25px; background:#2563eb; color:white; border:none; border-radius:10px; font-weight:600; font-size:16px; cursor:pointer; transition:0.3s;"
                    onmouseover="this.style.background='#1e40af'"
                    onmouseout="this.style.background='#2563eb'">
                + Add Transaction
            </button>
        </div>
    </form>
</div>
@endsection