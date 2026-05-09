@extends('layoutsGroup.groupdashboard')

@section('content')

<style>
    .page-wrapper{
        padding:30px;
        background:#f4f7fb;
        min-height:100vh;
    }

    .card-box{
        max-width:1000px;
        margin:auto;
        background:white;
        border-radius:20px;
        box-shadow:0 10px 30px rgba(0,0,0,0.06);
        overflow:hidden;
    }

    .header{
        padding:25px;
        background: linear-gradient(180deg, #065f5b, #0f766e);
        color:white;
    }

    .header h2{
        margin:0;
        font-size:24px;
    }

    .header p{
        margin-top:5px;
        opacity:.9;
    }

    .body{
        padding:25px;
    }

    .search-box{
        width:100%;
        padding:12px 15px;
        border:1px solid #e5e7eb;
        border-radius:12px;
        margin-bottom:20px;
        outline:none;
    }

    .member-grid{
        display:grid;
        grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
        gap:15px;
        margin-top:15px;
    }

    .member-card{
        border:1px solid #e5e7eb;
        border-radius:14px;
        padding:15px;
        display:flex;
        align-items:center;
        justify-content:space-between;
        transition:.2s;
        cursor:pointer;
        background:#fff;
    }

    .member-card:hover{
        transform:translateY(-2px);
        border-color:#2563eb;
        box-shadow:0 5px 15px rgba(37,99,235,0.1);
    }

    .member-info{
        display:flex;
        flex-direction:column;
    }

    .member-name{
        font-weight:600;
        color:#1f2937;
    }

    .member-phone{
        font-size:12px;
        color:#6b7280;
    }

    .checkbox{
        width:18px;
        height:18px;
        accent-color:#2563eb;
    }

    .footer{
        margin-top:25px;
        display:flex;
        justify-content:space-between;
        align-items:center;
    }

    .btn{
        background:#2563eb;
        color:white;
        border:none;
        padding:12px 18px;
        border-radius:10px;
        font-weight:600;
        cursor:pointer;
    }

    .btn:hover{
        background:#1d4ed8;
    }

    .select-all{
        font-size:14px;
        color:#2563eb;
        cursor:pointer;
        font-weight:600;
    }
</style>

<div class="page-wrapper">

    <div class="card-box">

        <!-- HEADER -->
        <div class="header">
            <h2>Register Members</h2>
            <p>Add members to <strong>{{ $group->name }}</strong></p>
        </div>

        <!-- BODY -->
        <div class="body">

            <form method="POST" action="{{ route('groups.attach_member', $group->id) }}">
                @csrf

                <!-- SEARCH -->
                <input type="text" id="searchInput" class="search-box" placeholder="Search members...">

                <!-- SELECT ALL -->
                <div style="display:flex; justify-content:space-between; margin-bottom:10px;">
                    <span class="select-all" onclick="toggleAll()">Select / Unselect All</span>
                </div>

                <!-- MEMBERS -->
                <div class="member-grid" id="memberGrid">

                    @foreach($members as $member)

                        <label class="member-card">

                            <div class="member-info">
                                <div class="member-name">
                                    {{ $member->first_name }} {{ $member->last_name }}
                                </div>
                                <div class="member-phone">
                                    {{ $member->phone }}
                                </div>
                            </div>

                            <input type="checkbox"
                                   class="checkbox member-checkbox"
                                   name="member_ids[]"
                                   value="{{ $member->id }}">

                        </label>

                    @endforeach

                </div>

                <!-- FOOTER -->
                <div class="footer">

                    <span style="color:#6b7280;font-size:14px;">
                        {{ count($members) }} available members
                    </span>

                    <button type="submit" class="btn">
                        Save Members
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<!-- SCRIPT -->
<script>
    // Search filter
    document.getElementById('searchInput').addEventListener('keyup', function () {
        let value = this.value.toLowerCase();
        let cards = document.querySelectorAll('.member-card');

        cards.forEach(card => {
            let text = card.innerText.toLowerCase();
            card.style.display = text.includes(value) ? 'flex' : 'none';
        });
    });

    // Select all toggle
    function toggleAll() {
        let checkboxes = document.querySelectorAll('.member-checkbox');
        let allChecked = Array.from(checkboxes).every(cb => cb.checked);

        checkboxes.forEach(cb => cb.checked = !allChecked);
    }
</script>

@endsection