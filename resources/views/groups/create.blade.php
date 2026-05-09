@extends('layoutsGroup.groupdashboard')

@section('content')

<div class="row">

    <!-- HEADER -->
    <div class="card col-12" style="display:flex; justify-content:space-between; align-items:center;">
        <div>
            <h2 style="margin-bottom:5px;">Create Group</h2>
            <p style="color:#64748b; font-size:14px;">Add a new group and assign members</p>
        </div>
    </div>

    <!-- FORM CARD -->
    <div class="card col-12">

        <form method="POST" action="{{ route('groups.store') }}">

            @csrf

            <!-- GROUP INFO -->
            <div class="row">

                <div class="col-6">
                    <div class="form-group">
                        <label>Group Name</label>
                        <input type="text" name="name" placeholder="Enter group name">
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" name="description" placeholder="Short description">
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label>Monthly Contribution</label>
                        <input type="text" name="monthly_contribution" placeholder="Short description">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Penalty Amount</label>
                        <input type="text" name="penalty_amount" placeholder="Short description">
                    </div>
                </div>
            </div>

            <!-- MEMBERS SECTION -->
            <div style="margin-top:20px;">
                <h3 style="margin-bottom:10px;">Assign Members</h3>
                <p style="color:#64748b; font-size:13px; margin-bottom:15px;">
                    Enter share percentage for each member
                </p>

                <div style="max-height:300px; overflow-y:auto; border:1px solid #e2e8f0; border-radius:10px; padding:10px;">

                    @foreach($users as $user)
                    <div style="display:flex; justify-content:space-between; align-items:center; padding:10px; border-bottom:1px solid #f1f5f9;">

                        <div style="font-weight:500;">
                            <i class="fas fa-user" style="margin-right:8px; color:#0f766e;"></i>
                            {{ $user->name }}
                        </div>

                        <div style="width:120px;">
                            <input type="number"
                                   name="users[{{ $user->id }}]"
                                   placeholder="%"
                                   min="0"
                                   max="100">
                        </div>

                    </div>
                    @endforeach

                </div>
            </div>

            <!-- ACTION -->
            <div style="margin-top:20px; display:flex; justify-content:flex-end;">
                <button class="btn">
                    <i class="fas fa-save"></i> Save Group
                </button>
            </div>

        </form>

    </div>

</div>

@endsection