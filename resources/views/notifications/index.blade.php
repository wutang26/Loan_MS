@extends('layouts.admin')

@section('content')

<style>

/* ===== PAGE ===== */
.notifications-wrapper{
    padding: 25px;
    background: #f4f7fb;
    min-height: 100vh;
}

/* ===== HEADER ===== */
.page-top{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:30px;
    flex-wrap:wrap;
    gap:15px;
}

.page-title{
    font-size:30px;
    font-weight:700;
    color:#0f172a;
}

.page-subtitle{
    color:#64748b;
    margin-top:5px;
    font-size:14px;
}

.top-actions{
    display:flex;
    gap:12px;
    flex-wrap:wrap;
}

.action-btn{
    border:none;
    padding:12px 18px;
    border-radius:12px;
    font-weight:600;
    cursor:pointer;
    transition:.3s;
    font-size:14px;
}

.read-all-btn{
    background:linear-gradient(135deg,#6d5dfc,#8b5cf6);
    color:white;
    box-shadow:0 6px 18px rgba(109,93,252,.25);
}

.read-all-btn:hover{
    transform:translateY(-2px);
}

.clear-btn{
    background:white;
    color:#ef4444;
    border:1px solid #fecaca;
}

.clear-btn:hover{
    background:#fee2e2;
}

/* ===== STATS ===== */
.notification-stats{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(230px,1fr));
    gap:20px;
    margin-bottom:30px;
}

.stats-card{
    background:white;
    border-radius:20px;
    padding:22px;
    box-shadow:0 5px 20px rgba(15,23,42,.05);
    display:flex;
    align-items:center;
    gap:18px;
    transition:.3s;
}

.stats-card:hover{
    transform:translateY(-4px);
}

.stats-icon{
    width:65px;
    height:65px;
    border-radius:18px;
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
    font-size:26px;
}

.icon-purple{
    background:linear-gradient(135deg,#6d5dfc,#8b5cf6);
}

.icon-green{
    background:linear-gradient(135deg,#22c55e,#16a34a);
}

.icon-red{
    background:linear-gradient(135deg,#ef4444,#dc2626);
}

.icon-blue{
    background:linear-gradient(135deg,#3b82f6,#2563eb);
}

.stats-content h2{
    margin:0;
    font-size:28px;
    color:#111827;
}

.stats-content p{
    margin:4px 0 0;
    color:#64748b;
    font-size:14px;
}

/* ===== NOTIFICATION LIST ===== */
.notifications-grid{
    display:grid;
    gap:22px;
}

.notification-card{
    background:white;
    border-radius:22px;
    padding:24px;
    box-shadow:0 5px 25px rgba(15,23,42,.05);
    transition:.3s;
    position:relative;
    overflow:hidden;
}

.notification-card:hover{
    transform:translateY(-4px);
}

.notification-card.unread{
    border-left:6px solid #6d5dfc;
}

.notification-card::before{
    content:'';
    position:absolute;
    top:0;
    right:0;
    width:120px;
    height:120px;
    background:linear-gradient(to bottom right,rgba(109,93,252,.08),transparent);
    border-radius:50%;
    transform:translate(40px,-40px);
}

/* ===== CARD TOP ===== */
.notification-top{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap:15px;
    flex-wrap:wrap;
}

.notification-left{
    display:flex;
    gap:18px;
    align-items:flex-start;
}

/* ===== ICON ===== */
.notification-icon{
    width:60px;
    height:60px;
    border-radius:18px;
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
    font-size:24px;
    flex-shrink:0;
}

.success-bg{
    background:linear-gradient(135deg,#22c55e,#16a34a);
}

.warning-bg{
    background:linear-gradient(135deg,#f59e0b,#d97706);
}

.danger-bg{
    background:linear-gradient(135deg,#ef4444,#dc2626);
}

.info-bg{
    background:linear-gradient(135deg,#3b82f6,#2563eb);
}

/* ===== TEXT ===== */
.notification-title{
    font-size:20px;
    font-weight:700;
    color:#0f172a;
}

.notification-message{
    margin-top:8px;
    color:#475569;
    line-height:1.8;
    font-size:15px;
}

.notification-meta{
    display:flex;
    align-items:center;
    gap:15px;
    margin-top:12px;
    flex-wrap:wrap;
}

.notification-time{
    font-size:13px;
    color:#94a3b8;
}

/* ===== BADGES ===== */
.badge{
    padding:7px 14px;
    border-radius:30px;
    font-size:12px;
    font-weight:700;
    display:inline-flex;
    align-items:center;
    gap:6px;
}

.badge-success{
    background:#dcfce7;
    color:#15803d;
}

.badge-warning{
    background:#fef3c7;
    color:#b45309;
}

.badge-danger{
    background:#fee2e2;
    color:#dc2626;
}

.badge-info{
    background:#dbeafe;
    color:#2563eb;
}

/* ===== ACTIONS ===== */
.notification-actions{
    display:flex;
    gap:12px;
    margin-top:22px;
    flex-wrap:wrap;
}

.btn-action{
    border:none;
    border-radius:12px;
    padding:11px 18px;
    font-weight:600;
    cursor:pointer;
    transition:.3s;
    font-size:14px;
}

.btn-read{
    background:#6d5dfc;
    color:white;
    box-shadow:0 5px 15px rgba(109,93,252,.2);
}

.btn-read:hover{
    transform:translateY(-2px);
}

.btn-delete{
    background:#fff1f2;
    color:#dc2626;
}

.btn-delete:hover{
    background:#fee2e2;
}

/* ===== EMPTY ===== */
.empty-box{
    background:white;
    border-radius:24px;
    padding:60px 20px;
    text-align:center;
    box-shadow:0 5px 20px rgba(0,0,0,.04);
}

.empty-box i{
    font-size:70px;
    color:#cbd5e1;
}

.empty-box h3{
    margin-top:20px;
    color:#334155;
}

.empty-box p{
    color:#94a3b8;
}

/* ===== PAGINATION ===== */
.pagination-wrapper{
    margin-top:30px;
}

/* ===== MOBILE ===== */
@media(max-width:768px){

    .notification-top{
        flex-direction:column;
    }

    .notification-left{
        flex-direction:column;
    }

    .stats-content h2{
        font-size:22px;
    }

    .page-title{
        font-size:24px;
    }

}

</style>

<div class="notifications-wrapper">

    <!-- ===== HEADER ===== -->
    <div class="page-top">

        <div>
            <div class="page-title">
                Loan Notifications
            </div>

            <div class="page-subtitle">
                Manage loan alerts, repayments, approvals and overdue activities
            </div>
        </div>

        <div class="top-actions">

            <button class="action-btn read-all-btn">
                <i class="bi bi-check2-all"></i>
                Mark All as Read
            </button>

            <button class="action-btn clear-btn">
                <i class="bi bi-trash3"></i>
                Clear Notifications
            </button>

        </div>

    </div>

    <!-- ===== STATS ===== -->
    <div class="notification-stats">

        <div class="stats-card">
            <div class="stats-icon icon-purple">
                <i class="bi bi-bell-fill"></i>
            </div>

            <div class="stats-content">
                <h2>{{ $notifications->count() }}</h2>
                <p>Total Notifications</p>
            </div>
        </div>

        <div class="stats-card">
            <div class="stats-icon icon-green">
                <i class="bi bi-check-circle-fill"></i>
            </div>

            <div class="stats-content">
                <h2>{{ $notifications->where('is_read', true)->count() }}</h2>
                <p>Read Notifications</p>
            </div>
        </div>

        <div class="stats-card">
            <div class="stats-icon icon-red">
                <i class="bi bi-exclamation-triangle-fill"></i>
            </div>

            <div class="stats-content">
                <h2>{{ $notifications->where('type', 'danger')->count() }}</h2>
                <p>Critical Alerts</p>
            </div>
        </div>

        <div class="stats-card">
            <div class="stats-icon icon-blue">
                <i class="bi bi-clock-history"></i>
            </div>

            <div class="stats-content">
                <h2>{{ $notifications->where('is_read', false)->count() }}</h2>
                <p>Unread Notifications</p>
            </div>
        </div>

    </div>

    <!-- ===== NOTIFICATIONS ===== -->
    <div class="notifications-grid">

        @forelse($notifications as $notification)

            <div class="notification-card {{ !$notification->is_read ? 'unread' : '' }}">

                <div class="notification-top">

                    <div class="notification-left">

                        <!-- ICON -->
                        <div class="notification-icon
                            @if($notification->type == 'success') success-bg
                            @elseif($notification->type == 'warning') warning-bg
                            @elseif($notification->type == 'danger') danger-bg
                            @else info-bg
                            @endif
                        ">

                            @if($notification->type == 'success')
                                <i class="bi bi-check-circle-fill"></i>

                            @elseif($notification->type == 'warning')
                                <i class="bi bi-exclamation-circle-fill"></i>

                            @elseif($notification->type == 'danger')
                                <i class="bi bi-x-octagon-fill"></i>

                            @else
                                <i class="bi bi-info-circle-fill"></i>
                            @endif

                        </div>

                        <!-- CONTENT -->
                        <div>

                            <div class="notification-title">
                                {{ $notification->title }}
                            </div>

                            <div class="notification-message">
                                {{ $notification->message }}
                            </div>

                            <div class="notification-meta">

                                <div class="notification-time">
                                    <i class="bi bi-clock"></i>
                                    {{ $notification->created_at->diffForHumans() }}
                                </div>

                                <div class="badge
                                    @if($notification->type == 'success') badge-success
                                    @elseif($notification->type == 'warning') badge-warning
                                    @elseif($notification->type == 'danger') badge-danger
                                    @else badge-info
                                    @endif
                                ">
                                    {{ ucfirst($notification->type) }}
                                </div>

                                @if(!$notification->is_read)
                                    <div class="badge badge-info">
                                        New
                                    </div>
                                @endif

                            </div>

                        </div>

                    </div>

                </div>

                <!-- ACTIONS -->
                <div class="notification-actions">

                    @if(!$notification->is_read)

                    <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                        @csrf

                        <button type="submit" class="btn-action btn-read">
                            <i class="bi bi-check2"></i>
                            Mark as Read
                        </button>
                    </form>

                    @endif

                    <form action="{{ route('notifications.delete', $notification->id) }}" method="POST">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn-action btn-delete">
                            <i class="bi bi-trash-fill"></i>
                            Delete
                        </button>

                    </form>

                </div>

            </div>

        @empty

            <div class="empty-box">

                <i class="bi bi-bell-slash"></i>

                <h3>No Notifications Found</h3>

                <p>
                    You currently have no loan alerts or notifications.
                </p>

            </div>

        @endforelse

    </div>

    <!-- ===== PAGINATION ===== -->
    <div class="pagination-wrapper">
        {{ $notifications->links() }}
    </div>

</div>

@endsection