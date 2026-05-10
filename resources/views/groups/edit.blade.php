@extends('layoutsGroup.groupdashboard')

@section('content')
<div class="card col-8" style="padding:30px; margin:auto; box-shadow:0 4px 12px rgba(0,0,0,0.05); border-radius:12px; background:#ffffff;">
    <h3 style="margin-bottom:25px; font-weight:600; color:#111827;">Edit Group</h3>

    <form action="{{ route('groups.update', $group->id) }}" method="POST" style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        @csrf
        @method('PUT')

        <!-- Group Name (full width) -->
        <div style="grid-column: span 2; display:flex; flex-direction:column;">
            <label style="margin-bottom:5px; font-weight:500; color:#374151;">Group Name</label>
            <input type="text" name="name" value="{{ $group->name }}" required
                   style="padding:10px 12px; border:1px solid #d1d5db; border-radius:8px; outline:none; font-size:14px; transition:0.2s;"
                   onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 2px rgba(59,130,246,0.2)';"
                   onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
        </div>

        <!-- Description (full width) -->
        <div style="grid-column: span 2; display:flex; flex-direction:column;">
            <label style="margin-bottom:5px; font-weight:500; color:#374151;">Description</label>
            <textarea name="description"
                      style="padding:10px 12px; border:1px solid #d1d5db; border-radius:8px; outline:none; font-size:14px; min-height:80px; transition:0.2s;"
                      onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 2px rgba(59,130,246,0.2)';"
                      onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">{{ $group->description }}</textarea>
        </div>

        <!-- Monthly Contribution -->
        <div style="display:flex; flex-direction:column;">
            <label style="margin-bottom:5px; font-weight:500; color:#374151;">Monthly Contribution</label>
            <input type="number" name="monthly_contribution" value="{{ $group->monthly_contribution }}" required
                   style="padding:10px 12px; border:1px solid #d1d5db; border-radius:8px; outline:none; font-size:14px; transition:0.2s;"
                   onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 2px rgba(59,130,246,0.2)';"
                   onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
        </div>

        <!-- Penalty Amount -->
        <div style="display:flex; flex-direction:column;">
            <label style="margin-bottom:5px; font-weight:500; color:#374151;">Penalty Amount</label>
            <input type="number" name="penalty_amount" value="{{ $group->penalty_amount }}" required
                   style="padding:10px 12px; border:1px solid #d1d5db; border-radius:8px; outline:none; font-size:14px; transition:0.2s;"
                   onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 2px rgba(59,130,246,0.2)';"
                   onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
        </div>

        <!-- Submit Button (full width) -->
        <div style="grid-column: span 2; display:flex; justify-content:flex-end;">
            <button type="submit"
                    style="background:#3b82f6; color:white; font-weight:500; padding:12px 20px; border:none; border-radius:8px; font-size:14px; cursor:pointer; transition:0.2s;"
                    onmouseover="this.style.background='#2563eb';"
                    onmouseout="this.style.background='#3b82f6';">
                Update Group
            </button>
        </div>
    </form>
</div>
@endsection