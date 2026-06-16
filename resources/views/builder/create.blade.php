<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Builder Panel</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<style>
body{background:#f4f6fb;font-family:'Segoe UI',sans-serif;}
.top-navbar{height:65px;background:#fff;box-shadow:0 2px 10px rgba(0,0,0,0.05);position:fixed;width:100%;z-index:1000;display:flex;align-items:center;padding:0 20px;}
.wrapper{display:flex;margin-top:65px;}
.sidebar{width:250px;background:#111827;min-height:100vh;padding:20px;}
.sidebar a{color:#cbd5e1;padding:10px;display:block;border-radius:6px;margin-bottom:5px;text-decoration:none;}
.sidebar a:hover{background:#4f46e5;color:#fff;}
.main-content{flex:1;padding:30px;}
.footer{text-align:center;padding:15px;background:#fff;border-top:1px solid #eee;}
@media(max-width:991px){.sidebar{display:none;}}
</style>
</head>

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
                    <a class="dropdown-item" href="{{ route('builder.change-password') }}">
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
                    <i class="fas fa-shopping-cart me-2"></i>   My Booking 
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
    

<div class="container-fluid py-4">

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
<ul class="mb-0">
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

<div class="card shadow-lg border-0 rounded-4">
<div class="card-header bg-primary text-white rounded-top-4">
<h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Add Property</h5>
</div>

<div class="card-body">

<form action="{{ route('builder.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="row g-4">

<!-- Basic Info -->
<div class="col-md-6">
<label class="form-label">Title *</label>
<input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
</div>

<div class="col-md-6">
<label class="form-label">Slug *</label>
<input type="text" name="slug" class="form-control" value="{{ old('slug') }}" required>
</div>

<div class="col-md-6 mb-3">
<label>Property Type *</label>
<select name="property_type_id" class="form-control">
<option value="">Select</option>
<option value="recidensial">Recidensial</option>
<option value="commercial">Commercial</option>
<option value="land">Land</option>
</select>
</div>

<div class="col-md-4">
<label class="form-label">Purpose *</label>
<select name="purpose" class="form-select" required>
<option value="">Select</option>
<option value="buy">Buy</option>
<option value="sale">Sale</option>
<option value="rent">Rent</option>
</select>
</div>

<div class="col-md-4">
<label class="form-label">Price *</label>
<input type="number" name="price" class="form-control" required>
</div>

<div class="col-12">
<label class="form-label">Description *</label>
<textarea name="description" rows="4" class="form-control" required>{{ old('description') }}</textarea>
</div>



<!-- Property Details -->
<div class="col-md-3">
<label>Total Area</label>
<input type="text" name="total_area" class="form-control">
</div>

<div class="col-md-3">
<label>Bedrooms</label>
<input type="number" name="total_bedroom" class="form-control">
</div>

<div class="col-md-3">
<label>Bathrooms</label>
<input type="number" name="total_bathroom" class="form-control">
</div>

<div class="col-md-3">
<label>Garage</label>
<input type="number" name="total_garage" class="form-control">
</div>

<!-- Location -->
<div class="col-md-6">
<label>City *</label>
<select name="city_id" class="form-select" required>
<option value="">Select</option>
@foreach($cities as $city)
<option value="{{ $city->id }}">{{ $city->name }}</option>
@endforeach
</select>
</div>

<div class="col-md-6">
<label>Country *</label>
<select name="country_id" class="form-select" required>
<option value="">Select</option>
@foreach($countries as $country)
<option value="{{ $country->id }}">{{ $country->name }}</option>
@endforeach
</select>
</div>

<div class="col-md-6">
<label>Latitude</label>
<input type="text" name="lat" class="form-control">
</div>

<div class="col-md-6">
<label>Longitude</label>
<input type="text" name="lon" class="form-control">
</div>

<div class="col-12">
<label>Address</label>
<input type="text" name="address" class="form-control">
</div>

<div class="col-12">
                                            <div class="form-group">
                                                <label for="address_description">{{ __('admin.Address Details') }} <span
                                                        class="text-danger">*</span></label>
                                                <textarea name="address_description" class="form-control text-area-5" id="" cols="30" rows="10">{{ old('address_description') }}</textarea>
                                            </div>
                                        </div>

<!-- Media -->
<div class="col-md-6">
<label>Thumbnail Image *</label>
<input type="file" name="thumbnail_image" class="form-control" required>
</div>

<!-- Status -->
<div class="col-md-4">
<label>Status</label>
<select name="status" class="form-select">
<option value="enable">Enable</option>
<option value="disable">Disable</option>
</select>
</div>

<div class="col-md-4">
<label>Featured</label>
<select name="is_featured" class="form-select">
<option value="disable">No</option>
<option value="enable">Yes</option>
</select>
</div>

<div class="col-md-4">
<label>Top Property</label>
<select name="is_top" class="form-select">
<option value="disable">No</option>
<option value="enable">Yes</option>
</select>
</div>

<!-- SEO -->
<div class="col-md-6">
<label>SEO Title</label>
<input type="text" name="seo_title" class="form-control">
</div>

<div class="col-md-6">
<label>SEO Meta Description</label>
<input type="text" name="seo_meta_description" class="form-control">
</div>

</div>

<div class="mt-4">
<button class="btn btn-success w-100 py-2">
<i class="fas fa-save me-2"></i>Save Property
</button>
</div>

</form>
</div>
</div>

<!-- ================= FOOTER ================= -->
<div class="footer">
    © 2026 Builder Dashboard. All Rights Reserved.
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>