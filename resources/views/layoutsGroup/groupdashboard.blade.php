<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Group Loan Admin</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

   <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* ===== ROOT FIX ===== */
html, body {
    height: 100%;              /*  important */
}

body {
    font-family: 'Poppins', sans-serif;
    background: #f1f5f9;

    display: flex;             /*  important */
}

/* ===== SIDEBAR ===== */
.sidebar {
    position: fixed;
    width: 250px;
    height: 100%;
    background: linear-gradient(180deg, #065f5b, #0f766e);
    color: #fff;
    padding: 20px;
}

.sidebar h2 {
    margin-bottom: 30px;
    font-size: 20px;
    letter-spacing: 1px;
}

.sidebar a {
    display: flex;
    align-items: center;
    padding: 12px 15px;
    border-radius: 10px;
    margin-bottom: 10px;
    color: #e0f2f1;
    text-decoration: none;
    transition: 0.3s;
}

.sidebar a i {
    margin-right: 12px;
    font-size: 14px;
}

.sidebar a:hover {
    background: rgba(255,255,255,0.15);
    transform: translateX(5px);
}

/* ===== MAIN ===== */
.main {
     margin-left: 250px;
    flex: 1;                   /*  fill remaining space */
    display: flex;
    flex-direction: column;
    min-height: 100vh;         /* ensures full screen */
}

/* ===== NAVBAR ===== */
.navbar {
    background: #fff;
    padding: 18px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 4px 20px rgba(0,0,0,0.05);
}

.navbar .title {
    font-weight: 600;
    font-size: 18px;
    color: #0f172a;
}

.navbar .user {
    font-size: 14px;
    color: #475569;
}

/* ===== CONTENT ===== */
.content {
    padding: 30px;
    flex: 1;                   /*  pushes footer down */
}

/* ===== GRID SYSTEM ===== */
.row {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}

.col-6 {
    flex: 0 0 48%;
}

.col-4 {
    flex: 0 0 31%;
}

.col-12 {
    width: 100%;
}

/* ===== CARD ===== */
.card {
    background: #ffffff;
    border-radius: 14px;
    padding: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.04);
    transition: 0.3s;
}

.card:hover {
    transform: translateY(-3px);
}

/* ===== CARD HEADER ===== */
.card h3 {
    margin-bottom: 15px;
    font-size: 16px;
    color: #0f172a;
}

/* ===== BUTTON ===== */
.btn {
    display: inline-block;
    background: #0f766e;
    color: white;
    padding: 10px 18px;
    border-radius: 10px;
    border: none;
    cursor: pointer;
    font-size: 14px;
    transition: 0.3s;
}

.btn:hover {
    background: #0d5c59;
}

/* ===== FORM ===== */
.form-group {
    margin-bottom: 15px;
}

label {
    font-size: 13px;
    color: #334155;
    margin-bottom: 5px;
    display: block;
}

input, select, textarea {
    width: 100%;
    padding: 10px 12px;
    border-radius: 10px;
    border: 1px solid #e2e8f0;
    background: #f8fafc;
    font-size: 14px;
    transition: 0.2s;
}

input:focus, select:focus, textarea:focus {
    border-color: #0f766e;
    outline: none;
    background: #fff;
}

/* ===== TABLE ===== */
.table {
    width: 100%;
    border-collapse: collapse;
}

.table th {
    text-align: left;
    font-size: 13px;
    color: #64748b;
    padding: 12px;
    background: #f8fafc;
}

.table td {
    padding: 12px;
    border-bottom: 1px solid #f1f5f9;
    font-size: 14px;
}

.table tr:hover {
    background: #f9fafb;
}

/* ===== FOOTER ===== */
.footer {
    background: #ffffff;
    text-align: center;
    padding: 14px;
    font-size: 13px;
    color: #94a3b8;
    border-top: 1px solid #e2e8f0;
}
</style>
</head>
<body>

<!-- ===== SIDEBAR ===== -->
<div class="sidebar">
    <h2>Group Loans</h2>

    <a href="/groups"><i class="fas fa-users"></i> Groups</a>
    <a href="{{route('welfareSupports.index')}}"> <i class="fas fa-handshake"></i> Welfare Support</a>
    <a href="/group-loans/create"><i class="fas fa-hand-holding-dollar"></i> Issue Loan</a>
    <a href="#"><i class="fas fa-credit-card"></i> Repayments</a>
    <a href="#"><i class="fas fa-chart-line"></i> Reports</a>
</div>

<!-- ===== MAIN AREA ===== -->
<div class="main">

    <!-- NAVBAR -->
    <div class="navbar">
        <div class="title">Group Loan System</div>
        <div class="user">
            <i class="fas fa-user-circle"></i> Admin
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">
        @yield('content')
    </div>

    <!-- FOOTER -->
    <div class="footer">
        © {{ date('Y') }} NAC Loan System — All rights reserved.
    </div>

</div>

</body>
</html>