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
            <a href="{{ route('groups.create') }}" style="text-decoration:none" class="btn">
                <i class="fas fa-plus"></i> Create Group
            </a>

            <a href="{{ route('admin.members.index') }}" class="btn" style="background:#334155; text-decoration:none">
                <i class="fas fa-users"></i> Members
            </a>
        </div>
    </div>

            <!-- TABLE CARD -->
            <div class="card col-12">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
            <h3>All Groups</h3>

            <!-- Search Form -->
            <form method="GET" action="{{ route('groups.index') }}" style="display:flex; gap:8px; align-items:center;">
                <input type="text"
                    name="search"
                    placeholder="Search groups..."
                    value="{{ request('search') }}"
                    style="
                        padding:8px 12px;
                        border-radius:8px;
                        border:1px solid #dbe2ea;
                        outline:none;
                        font-size:14px;
                    ">

                <button type="submit"
                        style="
                            padding:8px 14px;
                            background:#3b82f6;
                            color:white;
                            border:none;
                            border-radius:8px;
                            font-weight:600;
                            cursor:pointer;
                        ">
                    Search
                </button>
            </form>
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

                    <td style="text-align:right; display:flex; gap:5px; justify-content:flex-end;">
                    <!-- View -->
                    <a href="{{ route('groups.show', $group->id) }}" class="btn" style="padding:6px 10px; font-size:12px; text-decoration:none">
                        View
                    </a>

                    <!-- Edit -->
                    <a href="{{ route('groups.edit', $group->id) }}" class="btn" style="background:#3b82f6; padding:6px 10px; font-size:12px; text-decoration:none">
                        Edit
                    </a>

                    <!-- Delete -->
                    <form action="{{ route('groups.destroy', $group->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn" style="background:#e11d48; padding:6px 10px; font-size:12px; text-decoration:none"
                                onclick="return confirm('Are you sure you want to delete this group?');">
                            Delete
                        </button>
                    </form>
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