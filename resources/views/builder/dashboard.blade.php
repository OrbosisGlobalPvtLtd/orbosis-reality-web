<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Builder Dashboard</title>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- FontAwesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<style>

body{
    background:#f4f6fb;
    font-family: 'Segoe UI', sans-serif;
}

/* ================= HEADER ================= */
.top-navbar{
    height:65px;
    background:#ffffff;
    box-shadow:0 2px 10px rgba(0,0,0,0.05);
    position:fixed;
    top:0;
    left:0;
    right:0;
    z-index:1000;
    display:flex;
    align-items:center;
    padding:0 20px;
}

.brand-text{
    font-weight:700;
    font-size:18px;
    color:#4f46e5;
}

/* ================= LAYOUT ================= */
.wrapper{
    display:flex;
    margin-top:65px;
}

/* ================= SIDEBAR ================= */
.sidebar{
    width:250px;
    min-height:100vh;
    background:#ffffff;
    border-right:1px solid #e5e7eb;
    padding:20px 15px;
}

.sidebar .nav-link{
    color:#6b7280;
    font-size:14px;
    padding:12px 15px;
    border-radius:10px;
    margin-bottom:8px;
    transition:0.3s;
}

.sidebar .nav-link:hover,
.sidebar .nav-link.active{
    background:#eef2ff;
    color:#4f46e5;
    font-weight:600;
}

/* ================= MAIN CONTENT ================= */
.main-content{
    flex:1;
    padding:30px;
}

/* ================= CARDS ================= */
.dashboard-card{
    background:#ffffff;
    border-radius:15px;
    padding:30px 20px;
    text-align:center;
    box-shadow:0 5px 15px rgba(0,0,0,0.04);
    transition:0.3s;
}

.dashboard-card:hover{
    transform:translateY(-5px);
}

.dashboard-card i{
    font-size:28px;
    margin-bottom:15px;
    color:#6366f1;
}

.dashboard-card h6{
    font-weight:600;
    margin-bottom:10px;
    color:#374151;
}

.dashboard-card h2{
    font-weight:700;
    color:#111827;
}

/* ================= FOOTER ================= */
.footer{
    background:#ffffff;
    padding:15px;
    text-align:center;
    border-top:1px solid #e5e7eb;
    font-size:14px;
}

@media(max-width:991px){
    .sidebar{
        display:none;
    }
}

</style>
</head>

<body>

    

<!-- ================= HEADER ================= -->
<div class="top-navbar">
    <div class="brand-text">
        <i class="fas fa-building me-2"></i> Builder Panel
    </div>

    <div class="ms-auto">
        Welcome, <strong>Builder</strong>
    </div>
</div>
<nav class="navbar navbar-expand-lg top-navbar px-4">
    <button class="btn btn-outline-primary d-lg-none me-3" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <span class="brand-text">
        <i class="fas fa-building me-2"></i> Builder Panel
    </span>

    <div class="ms-auto d-flex align-items-center">

        <span class="me-3 fw-semibold">
            Welcome, {{ auth()->user()->name ?? 'Builder' }}
        </span>

        @isset($builder)
            <span class="badge {{ $builder->status == 1 ? 'bg-success' : 'bg-warning text-dark' }}">
                {{ $builder->status == 1 ? 'Verified' : 'Pending' }}
            </span>
        @endisset

        <!-- Profile Dropdown -->
        <div class="dropdown ms-3">
            <button class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fas fa-user-circle"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow">
                <li>
                    <a class="dropdown-item" href="{{ route('builder.profile') }}">
                        <i class="fas fa-user me-2"></i> Profile
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="">
                        <i class="fas fa-key me-2"></i> Change Password
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('builder.logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="wrapper">

    <!-- ================= SIDEBAR ================= -->
    <div class="sidebar">

        <ul class="nav flex-column">

            <li class="nav-item">
                <a href="{{ route('builder.dashboard') }}" class="nav-link active">
                    <i class="fas fa-home me-2"></i> Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('user.my-company') }}" class="nav-link">
                    <i class="fas fa-user me-2"></i> Company Profile
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('user.my-team') }}" class="nav-link">
                    <i class="fas fa-users me-2"></i> My Team
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('builder.my-properties') }}" class="nav-link">
                    <i class="fas fa-building me-2"></i> My Properties
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('builder.my-booking') }}" class="nav-link">
                    <i class="fas fa-shopping-cart me-2"></i> My Booking 
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('user.wishlist') }}" class="nav-link">
                    <i class="fas fa-heart me-2"></i> Wishlist
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('user.my-reviews') }}" class="nav-link">
                    <i class="fas fa-star me-2"></i> My Reviews
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('user.my-company') }}" class="nav-link">
                    <i class="fas fa-key me-2"></i> Change Password
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('user.my-company') }}" class="nav-link text-danger">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </a>
            </li>

        </ul>

    </div>


    <!-- ================= MAIN CONTENT ================= -->
    <div class="main-content">

        <h4 class="fw-bold mb-4">My Dashboard</h4>

        <div class="row g-4">

            <div class="col-md-4">
                <div class="dashboard-card">
                    <i class="fas fa-home"></i>
                    <h6>Publish Property</h6>
                    <h2>4</h2>
                </div>
            </div>

            <div class="col-md-4">
                <div class="dashboard-card">
                    <i class="fas fa-clock"></i>
                    <h6>Awaiting Property</h6>
                    <h2>0</h2>
                </div>
            </div>

            <div class="col-md-4">
                <div class="dashboard-card">
                    <i class="fas fa-times-circle"></i>
                    <h6>Reject Property</h6>
                    <h2>0</h2>
                </div>
            </div>

            <div class="col-md-4">
                <div class="dashboard-card">
                    <i class="fas fa-shopping-bag"></i>
                    <h6>My Order</h6>
                    <h2>8</h2>
                </div>
            </div>

            <div class="col-md-4">
                <div class="dashboard-card">
                    <i class="fas fa-heart"></i>
                    <h6>Wishlist</h6>
                    <h2>4</h2>
                </div>
            </div>

            <div class="col-md-4">
                <div class="dashboard-card">
                    <i class="fas fa-star"></i>
                    <h6>Total Review</h6>
                    <h2>1</h2>
                </div>
            </div>

        </div>

    </div>

</div>

<!-- ================= FOOTER ================= -->
<div class="footer">
    © 2026 Builder Dashboard. All Rights Reserved.
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>