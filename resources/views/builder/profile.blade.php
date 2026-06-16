<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Builder Profile</title>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- FontAwesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<style>
body {
    background-color: #f4f6f9;
    font-family: 'Segoe UI', sans-serif;
}

/* HEADER */
.top-navbar {
    height: 65px;
    background: #ffffff;
    box-shadow: 0 2px 12px rgba(0,0,0,0.05);
    position: sticky;
    top: 0;
    z-index: 999;
}
.brand-text {
    font-weight: 700;
    font-size: 18px;
    color: #0d6efd;
}

/* SIDEBAR */
.sidebar {
    width: 250px;
    background: #111827;
    min-height: 100vh;
    transition: 0.3s;
}
.sidebar .nav-link {
    color: #cbd5e1;
    padding: 12px 15px;
    border-radius: 8px;
    margin-bottom: 6px;
    transition: 0.2s;
    font-size: 14px;
}
.sidebar .nav-link:hover,
.sidebar .nav-link.active {
    background: #0d6efd;
    color: #fff;
}

/* MAIN CONTENT */
.main-content {
    padding: 30px;
}

/* CARD DESIGN */
.profile-card {
    border-radius: 18px;
}

/* SECTION TITLE */
.section-title {
    font-weight: 600;
    font-size: 16px;
    border-left: 4px solid #0d6efd;
    padding-left: 10px;
    margin-bottom: 15px;
}

/* LOGO */
.logo-wrapper {
    width: 120px;
    height: 120px;
}
.logo-wrapper img {
    width: 120px;
    height: 120px;
    object-fit: cover;
}

/* FOOTER */
.footer {
    background: #ffffff;
    padding: 18px;
    font-size: 14px;
    text-align: center;
    border-top: 1px solid #e5e7eb;
}

/* RESPONSIVE */
@media(max-width:991px){
    .sidebar {
        position: fixed;
        left: -260px;
        top: 0;
        height: 100%;
        z-index: 1000;
    }
    .sidebar.show {
        left: 0;
    }
}
</style>
</head>

<body>

<!-- HEADER -->
<nav class="navbar navbar-expand-lg top-navbar px-4">
    <button class="btn btn-outline-primary d-lg-none me-3" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <span class="brand-text">
        <i class="fas fa-building me-2"></i> Builder Panel
    </span>

    <div class="ms-auto">
        <a href="{{ route('builder.dashboard') }}" class="btn btn-outline-primary btn-sm">
            <i class="fas fa-arrow-left"></i> Dashboard
        </a>
    </div>
</nav>

<div class="d-flex">

    <!-- SIDEBAR -->
    <div class="sidebar p-3" id="sidebarMenu">
        <h5 class="text-white text-center mb-4">Navigation</h5>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('builder.dashboard') }}" class="nav-link">
                    <i class="fas fa-home me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('builder.profile') }}" class="nav-link active">
                    <i class="fas fa-user me-2"></i> Profile
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('builder.change-password') }}" class="nav-link">
                    <i class="fas fa-key me-2"></i> Change Password
                </a>
            </li>
        </ul>
    </div>

    <!-- MAIN CONTENT -->
    <div class="flex-grow-1 main-content">

        <div class="container-fluid">
            <div class="card shadow-lg border-0 profile-card">
                <div class="card-body p-4 p-lg-5">

                    <!-- Profile Header -->
                    <div class="text-center mb-4">
                        <div class="logo-wrapper mx-auto mb-3">
                            <img id="logoPreview"
                                 src="{{ asset($builder->company_logo) }}"
                                 class="rounded-circle shadow">
                        </div>

                        <h5 class="fw-semibold">{{ $builder->company_name }}</h5>

                        <span class="badge {{ $builder->status == 1 ? 'bg-success' : 'bg-warning text-dark' }}">
                            {{ $builder->status == 1 ? 'Verified Builder' : 'Pending Verification' }}
                        </span>
                    </div>

                    <hr>

                    <form action="{{ route('builder.profile-update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- PERSONAL INFO -->
                        <div class="section-title">Personal Information</div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name"
                                       class="form-control"
                                       value="{{ old('name', $user->name) }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone_number"
                                       class="form-control"
                                       value="{{ old('phone_number', $builder->phone_number) }}">
                            </div>
                        </div>

                        <!-- COMPANY INFO -->
                        <div class="section-title mt-4">Company Information</div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Company Name</label>
                                <input type="text" name="company_name"
                                       class="form-control"
                                       value="{{ old('company_name', $builder->company_name) }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Business Type</label>
                                <select name="business_type" class="form-select">
                                    <option value="residential">Residential</option>
                                    <option value="commercial">Commercial</option>
                                    <option value="land">Land</option>
                                </select>
                            </div>
                        </div>

                        <!-- ADDRESS -->
                        <div class="section-title mt-4">Address</div>
                        <textarea name="address" rows="2"
                                  class="form-control mb-3">{{ old('address', $builder->address) }}</textarea>

                        <!-- LOGO -->
                        <div class="section-title mt-4">Company Logo</div>
                        <input type="file" name="company_logo"
                               class="form-control mb-3"
                               accept="image/*"
                               onchange="previewLogo(event)">

                        <!-- BUTTON -->
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>
</div>

<!-- FOOTER -->
<div class="footer">
    © {{ date('Y') }} Builder Portal. All rights reserved.
</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.getElementById('sidebarToggle').addEventListener('click', function(){
    document.getElementById('sidebarMenu').classList.toggle('show');
});

function previewLogo(event) {
    const reader = new FileReader();
    reader.onload = function(){
        document.getElementById('logoPreview').src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>

</body>
</html>