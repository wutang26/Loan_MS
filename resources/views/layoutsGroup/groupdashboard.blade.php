<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Group Loan Admin</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        html,
        body{
            height:100%;
        }

        body{
            font-family:'Poppins',sans-serif;
            background:#f1f5f9;
            display:flex;
        }

        /* ================= SIDEBAR ================= */

        .sidebar{
            position:fixed;
            top:0;
            left:0;
            width:260px;
            height:100vh;
            overflow-y:auto;
            background:linear-gradient(180deg,#065f5b,#0f766e);
            color:#fff;
            padding:20px;
        }

        .sidebar h2{
            margin-bottom:30px;
            font-size:22px;
            font-weight:600;
            letter-spacing:1px;
        }

        /* Sidebar Links */
        .sidebar a,
        .dropdown-btn{
            width:100%;
            display:flex;
            align-items:center;
            justify-content:space-between;
            padding:13px 15px;
            margin-bottom:10px;
            border:none;
            outline:none;
            border-radius:10px;
            background:none;
            color:#e0f2f1;
            text-decoration:none;
            font-size:14px;
            cursor:pointer;
            transition:0.3s;
        }

        .sidebar a:hover,
        .dropdown-btn:hover{
            background:rgba(255,255,255,0.15);
            transform:translateX(5px);
        }

        .menu-left{
            display:flex;
            align-items:center;
            gap:12px;
        }

        .sidebar i{
            font-size:14px;
        }

        /* ================= DROPDOWN ================= */

        .dropdown-container{
            display:none;
            margin-top:-5px;
            margin-bottom:10px;
            padding-left:15px;
        }

        .dropdown-container a{
            font-size:13px;
            padding:11px 15px;
            background:rgba(255,255,255,0.06);
            margin-bottom:8px;
        }

        .dropdown-container a:hover{
            background:rgba(255,255,255,0.15);
            transform:none;
        }

        .dropdown-btn.active{
            background:rgba(255,255,255,0.15);
        }

        .dropdown-btn .fa-caret-down{
            transition:0.3s;
        }

        .dropdown-btn.active .fa-caret-down{
            transform:rotate(180deg);
        }

        /* ================= MAIN ================= */

        .main{
            margin-left:260px;
            flex:1;
            min-height:100vh;
            display:flex;
            flex-direction:column;
        }

        /* ================= NAVBAR ================= */

        .navbar{
            background:#fff;
            padding:18px 30px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            box-shadow:0 4px 20px rgba(0,0,0,0.05);
        }

        .navbar .title{
            font-size:18px;
            font-weight:600;
            color:#0f172a;
        }

        .navbar .user{
            font-size:14px;
            color:#475569;
        }

        /* ================= CONTENT ================= */

        .content{
            flex:1;
            padding:30px;
        }

        /* ================= GRID ================= */

        .row{
            display:flex;
            flex-wrap:wrap;
            gap:20px;
        }

        .col-12{
            width:100%;
        }

        .col-6{
            flex:0 0 48%;
        }

        .col-4{
            flex:0 0 31%;
        }

        /* ================= CARD ================= */

        .card{
            background:#fff;
            border-radius:14px;
            padding:20px;
            box-shadow:0 10px 25px rgba(0,0,0,0.04);
            transition:0.3s;
        }

        .card:hover{
            transform:translateY(-3px);
        }

        .card h3{
            margin-bottom:15px;
            color:#0f172a;
            font-size:16px;
        }

        /* ================= BUTTON ================= */

        .btn{
            display:inline-block;
            padding:10px 18px;
            border:none;
            border-radius:10px;
            background:#0f766e;
            color:#fff;
            font-size:14px;
            cursor:pointer;
            transition:0.3s;
        }

        .btn:hover{
            background:#0d5c59;
        }

        /* ================= FORM ================= */

        .form-group{
            margin-bottom:15px;
        }

        label{
            display:block;
            margin-bottom:5px;
            font-size:13px;
            color:#334155;
        }

        input,
        select,
        textarea{
            width:100%;
            padding:10px 12px;
            border-radius:10px;
            border:1px solid #e2e8f0;
            background:#f8fafc;
            font-size:14px;
            transition:0.2s;
        }

        input:focus,
        select:focus,
        textarea:focus{
            outline:none;
            border-color:#0f766e;
            background:#fff;
        }

        /* ================= TABLE ================= */

        .table{
            width:100%;
            border-collapse:collapse;
        }

        .table th{
            padding:12px;
            text-align:left;
            font-size:13px;
            color:#64748b;
            background:#f8fafc;
        }

        .table td{
            padding:12px;
            border-bottom:1px solid #f1f5f9;
            font-size:14px;
        }

        .table tr:hover{
            background:#f9fafb;
        }

        /* ================= FOOTER ================= */

        .footer{
            background:#fff;
            text-align:center;
            padding:14px;
            font-size:13px;
            color:#94a3b8;
            border-top:1px solid #e2e8f0;
        }

        /* ================= RESPONSIVE ================= */

        @media(max-width:768px){

            .sidebar{
                width:100%;
                height:auto;
                position:relative;
            }

            .main{
                margin-left:0;
            }

            .row{
                flex-direction:column;
            }

            .col-6,
            .col-4{
                flex:0 0 100%;
            }
        }

    </style>
</head>

<body>

<!-- ================= SIDEBAR ================= -->

<div class="sidebar">

    <h2>Group Loans</h2>

    <a href="/groups">
        <span class="menu-left">
            <i class="fas fa-users"></i>
            Groups
        </span>
    </a>

    <a href="{{ route('welfareSupports.index') }}">
        <span class="menu-left">
            <i class="fas fa-handshake"></i>
            Welfare Support
        </span>
    </a>

    <a href="/group-loans/create">
        <span class="menu-left">
            <i class="fas fa-hand-holding-dollar"></i>
            Issue Loan
        </span>
    </a>

    <!-- REPAYMENTS DROPDOWN -->

    <button class="dropdown-btn">

        <span class="menu-left">
            <i class="fas fa-credit-card"></i>
            Repayments
        </span>

        <i class="fas fa-caret-down"></i>

    </button>

    <div class="dropdown-container">
         <a href="/repayments/create">
            Repayment Schedule
        </a>
        <a href="/repayments/create">
            Add Repayment
        </a>

        <a href="/repayments">
            Repayments History
        </a>

    </div>

    <!-- REPORTS DROPDOWN -->

    <button class="dropdown-btn">

        <span class="menu-left">
            <i class="fas fa-chart-line"></i>
            Reports
        </span>

        <i class="fas fa-caret-down"></i>

    </button>

    <div class="dropdown-container">

        <a href="/reports/loans">
            Penalte and Fines
        </a>

        <a href="/reports/repayments">
            Wasioweka Akiba
        </a>

        <a href="/reports/groups">
            Walio Toa Mchango Unao Endelea (Fetch a selected mchango on Process Mf.Harusi Ya Jelly)
        </a>

    </div>

</div>

<!-- ================= MAIN ================= -->

<div class="main">

    <!-- NAVBAR -->

    <div class="navbar">

        <div class="title">
            Group Loan System
        </div>

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

<!-- ================= DROPDOWN SCRIPT ================= -->

<script>

    const dropdowns = document.querySelectorAll(".dropdown-btn");

    dropdowns.forEach(button => {

        button.addEventListener("click", function () {

            this.classList.toggle("active");

            const dropdownContent = this.nextElementSibling;

            if (dropdownContent.style.display === "block") {

                dropdownContent.style.display = "none";

            } else {

                dropdownContent.style.display = "block";

            }

        });

    });

</script>

</body>
</html>