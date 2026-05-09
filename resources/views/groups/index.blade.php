@extends('layoutsGroup.groupdashboard')

@section('content')

<div class="row">

    <!-- HEADER CARD -->
    <div class="card col-12" style="display:flex; justify-content:space-between; align-items:center;">
        <div>
            <h2 style="margin-bottom:5px;">Groups</h2>
            <p style="color:#64748b; font-size:14px;">Manage all loan groups and members</p>
        </div>

        <div style="display:flex; gap:10px;">
            <a href="{{ route('groups.create') }}" class="btn">
                <i class="fas fa-plus"></i> Create Group
            </a>

            <a href="{{ route('admin.members.index') }}" class="btn" style="background:#334155;">
                <i class="fas fa-users"></i> Members
            </a>
        </div>
    </div>

    <!-- TABLE CARD -->
    <div class="card col-12">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
            <h3>All Groups</h3>

            <!-- Optional search -->
            <input type="text" placeholder="Search groups..."
                   style="max-width:250px;">
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Group Name</th>
                    <th>Description</th>
                     <th>Monthly Contribution</th>
                    <th>Pelnaty Amount</th>
                    <th style="text-align:right;">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($groups as $index => $group)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td style="font-weight:500;">{{ $group->name }}</td>
                    <td style="color:#64748b;">{{ $group->description }}</td>
                    <td style="font-weight:500;">{{ $group->monthly_contribution }}</td>
                    <td style="color:#64748b;">{{ $group->penalty_amount }}</td>

                    <td style="text-align:right;">
                        <a href="{{ route('groups.show', $group->id) }}" class="btn" style="padding:6px 10px; font-size:12px;">
                            View
                        </a>

                        <a href="#" class="btn" style="background:#e11d48; padding:6px 10px; font-size:12px;">
                            Delete
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align:center; padding:20px; color:#94a3b8;">
                        No groups found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection