@extends('layouts.admin')

@section('content')

<!-- ===== PAGE STYLE ===== -->
<style>
/* ===== MAIN ===== */
.dashboard-wrapper{
    padding: 25px;
    background: #f5f7fb;
    min-height: 100vh;
}

/* ===== HEADER ===== */
.page-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}

.page-title{
    font-size:28px;
    font-weight:700;
    color:#1e293b;
}

.create-btn{
    background: linear-gradient(135deg,#6d5dfc,#7c4dff);
    color:white;
    border:none;
    padding:12px 22px;
    border-radius:12px;
    font-weight:600;
    cursor:pointer;
    box-shadow:0 6px 15px rgba(124,77,255,.2);
    transition:.3s;
}

.create-btn:hover{
    transform:translateY(-2px);
}

/* ===== CARDS ===== */
.stats-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(230px,1fr));
    gap:20px;
    margin-bottom:25px;
}

.stat-card{
    background:white;
    border-radius:18px;
    padding:20px;
    display:flex;
    align-items:center;
    gap:18px;
    box-shadow:0 3px 10px rgba(0,0,0,.05);
    transition:.3s;
}

.stat-card:hover{
    transform:translateY(-3px);
}

.stat-icon{
    width:60px;
    height:60px;
    border-radius:16px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:24px;
    color:white;
}

.bg-purple{
    background:linear-gradient(135deg,#7b61ff,#6d5dfc);
}

.bg-green{
    background:linear-gradient(135deg,#3ac47d,#2ecc71);
}

.bg-orange{
    background:linear-gradient(135deg,#ffb547,#ff9800);
}

.bg-blue{
    background:linear-gradient(135deg,#4a90ff,#2979ff);
}

.stat-content h2{
    margin:0;
    font-size:28px;
    color:#111827;
}

.stat-content p{
    margin:4px 0;
    color:#64748b;
    font-size:14px;
}

.stat-content span{
    font-size:13px;
    font-weight:600;
}

/* ===== CONTENT GRID ===== */
.content-grid{
    display:grid;
    grid-template-columns:2fr 1fr;
    gap:25px;
    margin-top:20px;
}

@media(max-width:1100px){
    .content-grid{
        grid-template-columns:1fr;
    }
}

/* ===== CARDS ===== */
.card-box{
    background:white;
    border-radius:18px;
    padding:22px;
    box-shadow:0 3px 12px rgba(0,0,0,.05);
}

.card-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.card-title{
    font-size:20px;
    font-weight:700;
    color:#1e293b;
}

/* ===== TABLE ===== */
.table-responsive{
    overflow-x:auto;
}

.loan-table{
    width:100%;
    border-collapse:collapse;
}

.loan-table th{
    background:#f8fafc;
    padding:14px;
    font-size:14px;
    color:#64748b;
    text-align:left;
}

.loan-table td{
    padding:15px 14px;
    border-top:1px solid #eef2f7;
    color:#334155;
    font-size:14px;
}

.status{
    padding:6px 12px;
    border-radius:30px;
    font-size:12px;
    font-weight:600;
}

.status-success{
    background:#dcfce7;
    color:#16a34a;
}

.status-danger{
    background:#fee2e2;
    color:#dc2626;
}

/* ===== CHART ===== */
#loanChart{
    height:380px;
}

/* ===== PIE ===== */
#statusChart{
    height:320px;
}

/* ===== FLOW ===== */
.flow-section{
    margin-top:30px;
}

.flow-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
    margin-top:20px;
}

.flow-card{
    background:white;
    border-radius:18px;
    padding:25px;
    border:2px solid #ede9fe;
    transition:.3s;
}

.flow-card:hover{
    transform:translateY(-4px);
}

.flow-card h4{
    margin-top:0;
    font-size:20px;
    color:#6d5dfc;
}

.flow-card ul{
    padding-left:18px;
    color:#475569;
    line-height:2;
}

.flow-icon{
    font-size:35px;
    margin-bottom:15px;
}

/* ===== VIEW BUTTON ===== */
.view-btn{
    padding:8px 16px;
    border-radius:10px;
    background:#f3f4f6;
    text-decoration:none;
    color:#6d5dfc;
    font-weight:600;
}
</style>

<div class="dashboard-wrapper">

    <!-- ===== HEADER ===== -->
    <div class="page-header">
        <div class="page-title">
            Group Loan Management
        </div>

        <button class="create-btn">
            + Create New Group
        </button>
    </div>

    <!-- ===== STATS ===== -->
    <div class="stats-grid">

        <div class="stat-card">
            <div class="stat-icon bg-purple">
                <i class="bi bi-people-fill"></i>
            </div>

            <div class="stat-content">
                <p>Total Groups</p>
                <h2>{{ $totalGroups ?? 32 }}</h2>
                <span style="color:green;">+12% from last month</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon bg-green">
                <i class="bi bi-cash-stack"></i>
            </div>

            <div class="stat-content">
                <p>Active Group Loans</p>
                <h2>{{ $activeLoans ?? 18 }}</h2>
                <span style="color:green;">+8% from last month</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon bg-orange">
                <i class="bi bi-wallet2"></i>
            </div>

            <div class="stat-content">
                <p>Total Disbursed</p>
                <h2>${{ number_format($disbursed ?? 245000) }}</h2>
                <span style="color:green;">+15% from last month</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon bg-blue">
                <i class="bi bi-bar-chart-fill"></i>
            </div>

            <div class="stat-content">
                <p>Total Outstanding</p>
                <h2>${{ number_format($outstanding ?? 87500) }}</h2>
                <span style="color:red;">-5% from last month</span>
            </div>
        </div>

    </div>

    <!-- ===== CONTENT ===== -->
    <div class="content-grid">

        <!-- ===== LEFT ===== -->
        <div class="card-box">

            <div class="card-header">
                <div class="card-title">
                    Loan Analytics
                </div>

                <a href="#" class="view-btn">
                    View All
                </a>
            </div>

            <div id="loanChart"></div>

            <div class="table-responsive mt-4">

                <table class="loan-table">

                    <thead>
                        <tr>
                            <th>Group Name</th>
                            <th>Loan Amount</th>
                            <th>Members</th>
                            <th>Status</th>
                            <th>Outstanding</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <td>Women Empowerment</td>
                            <td>$25,000</td>
                            <td>8</td>
                            <td>
                                <span class="status status-success">
                                    Ongoing
                                </span>
                            </td>
                            <td>$12,500</td>
                        </tr>

                        <tr>
                            <td>Unity Group</td>
                            <td>$15,000</td>
                            <td>6</td>
                            <td>
                                <span class="status status-success">
                                    Ongoing
                                </span>
                            </td>
                            <td>$7,200</td>
                        </tr>

                        <tr>
                            <td>Trust Circle</td>
                            <td>$12,000</td>
                            <td>5</td>
                            <td>
                                <span class="status status-danger">
                                    Overdue
                                </span>
                            </td>
                            <td>$8,300</td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

        <!-- ===== RIGHT ===== -->
        <div class="card-box">

            <div class="card-header">
                <div class="card-title">
                    Loan Status Overview
                </div>
            </div>

            <div id="statusChart"></div>

        </div>

    </div>

    <!-- ===== FLOW SECTION ===== -->
    <div class="flow-section card-box">

        <div class="card-title">
            Group Loan - Logical Flow
        </div>

        <div class="flow-grid">

            <div class="flow-card">
                <div class="flow-icon text-primary">
                    <i class="bi bi-people-fill"></i>
                </div>

                <h4>1. Create Group</h4>

                <ul>
                    <li>Add Group Name</li>
                    <li>Add Description</li>
                    <li>Create Group</li>
                </ul>
            </div>

            <div class="flow-card">
                <div class="flow-icon text-warning">
                    <i class="bi bi-person-plus-fill"></i>
                </div>

                <h4>2. Add Members</h4>

                <ul>
                    <li>Search & Add Members</li>
                    <li>Set Share Percentage</li>
                    <li>Save Members</li>
                </ul>
            </div>

            <div class="flow-card">
                <div class="flow-icon text-success">
                    <i class="bi bi-cash-coin"></i>
                </div>

                <h4>3. Issue Loan</h4>

                <ul>
                    <li>Enter Loan Amount</li>
                    <li>Set Interest</li>
                    <li>Disburse Loan</li>
                </ul>
            </div>

            <div class="flow-card">
                <div class="flow-icon text-info">
                    <i class="bi bi-credit-card-2-front-fill"></i>
                </div>

                <h4>4. Repayments</h4>

                <ul>
                    <li>Record Payments</li>
                    <li>Payment History</li>
                    <li>Outstanding Balance</li>
                </ul>
            </div>

        </div>

    </div>

</div>

<!-- ===== HIGHCHARTS ===== -->
<script src="https://code.highcharts.com/highcharts.js"></script>

<!-- ===== LOAN COLUMN CHART ===== -->
<script>
Highcharts.chart('loanChart', {

    chart: {
        type: 'column',
        borderRadius: 20
    },

    title: {
        text: 'Monthly Loan Performance'
    },

    subtitle: {
        text: 'Group Loan Statistics'
    },

    xAxis: {
        categories: [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun'
        ],
        crosshair: true
    },

    yAxis: {
        min: 0,
        title: {
            text: 'Amount ($)'
        }
    },

    tooltip: {
        shared: true
    },

    plotOptions: {
        column: {
            borderRadius: 8,
            pointPadding: 0.2,
            borderWidth: 0
        }
    },

    series: [{
        name: 'Disbursed',
        data: [5000, 7000, 12000, 15000, 18000, 25000]

    }, {
        name: 'Repayments',
        data: [3000, 5000, 8000, 12000, 14000, 19000]

    }, {
        name: 'Outstanding',
        data: [2000, 2000, 4000, 3000, 4000, 6000]

    }]
});
</script>

<!-- ===== PIE CHART ===== -->
<script>
Highcharts.chart('statusChart', {

    chart: {
        type: 'pie'
    },

    title: {
        text: 'Loan Status'
    },

    tooltip: {
        pointFormat: '<b>{point.percentage:.1f}%</b>'
    },

    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },

    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            borderRadius: 8,
            dataLabels: {
                enabled: true,
                format: '{point.name}: {point.percentage:.1f} %'
            }
        }
    },

    series: [{
        name: 'Loans',
        colorByPoint: true,
        data: [
            {
                name: 'Fully Paid',
                y: 25
            },
            {
                name: 'Ongoing',
                y: 56
            },
            {
                name: 'Overdue',
                y: 19
            }
        ]
    }]
});
</script>

@endsection