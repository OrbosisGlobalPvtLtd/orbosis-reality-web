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
<style>
body{
    background:#f4f6fb;
    font-family:'Segoe UI',sans-serif;
}

/* HEADER */
.top-navbar{
    height:65px;
    background:#fff;
    box-shadow:0 2px 10px rgba(0,0,0,0.05);
    position:fixed;
    width:100%;
    z-index:1000;
    display:flex;
    align-items:center;
    padding:0 20px;
}

.wrapper{
    display:flex;
    margin-top:65px;
}

/* SIDEBAR */
.sidebar{
    width:250px;
    background:#ffffff;
    min-height:100vh;
    border-right:1px solid #e5e7eb;
    padding:20px 15px;
    transition:0.3s;
}

.sidebar .nav-link{
    color:#6b7280;
    padding:12px 15px;
    border-radius:10px;
    margin-bottom:8px;
    font-size:14px;
}

.sidebar .nav-link:hover,
.sidebar .nav-link.active{
    background:#eef2ff;
    color:#4f46e5;
    font-weight:600;
}

/* MAIN */
.main-content{
    flex:1;
    padding:30px;
}

/* CARD */
.content-card{
    background:#fff;
    border-radius:15px;
    padding:25px;
    box-shadow:0 5px 15px rgba(0,0,0,0.05);
}

/* TABLE */
.table thead{
    background:#f9fafb;
}

.table td, .table th{
    vertical-align:middle;
}

/* MOBILE */
@media(max-width:991px){
    .sidebar{
        position:fixed;
        left:-260px;
        top:65px;
        height:100%;
        z-index:2000;
    }
    .sidebar.show{
        left:0;
    }
}
</style>

<!-- HEADER -->
<div class="top-navbar">
    <button class="btn btn-outline-primary d-lg-none me-3" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <h5 class="mb-0">
        <i class="fas fa-building me-2 text-primary"></i>
        Builder Panel
    </h5>

    <div class="ms-auto">
        Welcome, <strong>{{ auth()->user()->name ?? 'Builder' }}</strong>
    </div>
</div>

<div class="wrapper">

    <!-- SIDEBAR -->
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

<div class="container-fluid py-4">

<div class="card shadow-lg border-0 rounded-4">
<div class="card-header bg-warning text-dark">
<h5 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Property</h5>
</div>

<div class="card-body">

{{-- Validation Errors --}}
@if ($errors->any())
<div class="alert alert-danger">
<ul class="mb-0">
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

<form action="{{ route('builder.update',$property->id) }}"
      method="POST"
      enctype="multipart/form-data">
@csrf
@method('POST')

<div class="row g-4">

<div class="col-md-6">
<label>Title *</label>
<input type="text" name="title" class="form-control"
value="{{ old('title',$property->title) }}" required>
</div>

<div class="col-md-6">
<label>Slug *</label>
<input type="text" name="slug" class="form-control"
value="{{ old('slug',$property->slug) }}" required>
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

<div class="col-md-6">
<label>Purpose *</label>
<select name="purpose" class="form-select">
<option value="buy" {{ $property->purpose=='buy'?'selected':'' }}>Buy</option>
<option value="sale" {{ $property->purpose=='sale'?'selected':'' }}>Sale</option>
<option value="rent" {{ $property->purpose=='rent'?'selected':'' }}>Rent</option>
</select>
</div>

<div class="col-md-4">
<label>Price *</label>
<input type="number" name="price"
value="{{ old('price',$property->price) }}"
class="form-control">
</div>

<div class="col-md-4">
<label>Status</label>
<select name="status" class="form-select">
<option value="enable" {{ $property->status=='enable'?'selected':'' }}>Enable</option>
<option value="disable" {{ $property->status=='disable'?'selected':'' }}>Disable</option>
</select>
</div>

<div class="col-md-4">
<label>Total Area</label>
<input type="text" name="total_area"
value="{{ old('total_area',$property->total_area) }}"
class="form-control">
</div>

<div class="col-md-3">
<label>Bedrooms</label>
<input type="number" name="total_bedroom"
value="{{ old('total_bedroom',$property->total_bedroom) }}"
class="form-control">
</div>

<div class="col-md-3">
<label>Bathrooms</label>
<input type="number" name="total_bathroom"
value="{{ old('total_bathroom',$property->total_bathroom) }}"
class="form-control">
</div>

<div class="col-md-3">
<label>Garage</label>
<input type="number" name="total_garage"
value="{{ old('total_garage',$property->total_garage) }}"
class="form-control">
</div>

<div class="col-md-6">
<label>City *</label>
<select name="city_id" class="form-select">
@foreach($cities as $city)
<option value="{{ $city->id }}"
{{ $property->city_id == $city->id ? 'selected':'' }}>
{{ $city->name }}
</option>
@endforeach
</select>
</div>

<div class="col-md-6">
<label>Country *</label>
<select name="country_id" class="form-select">
@foreach($countries as $country)
<option value="{{ $country->id }}"
{{ $property->country_id == $country->id ? 'selected':'' }}>
{{ $country->name }}
</option>
@endforeach
</select>
</div>

<div class="col-12">
<label>Address</label>
<input type="text" name="address"
value="{{ old('address',$property->address) }}"
class="form-control">
</div>

<div class="col-12">
<label>Description</label>
<textarea name="description"
rows="4"
class="form-control">{{ old('description',$property->description) }}</textarea>
</div>

<div class="col-md-4">
<label>Featured</label>
<select name="is_featured" class="form-select">
<option value="disable" {{ $property->is_featured=='disable'?'selected':'' }}>No</option>
<option value="enable" {{ $property->is_featured=='enable'?'selected':'' }}>Yes</option>
</select>
</div>

<div class="col-md-4">
<label>Top Property</label>
<select name="is_top" class="form-select">
<option value="disable" {{ $property->is_top=='disable'?'selected':'' }}>No</option>
<option value="enable" {{ $property->is_top=='enable'?'selected':'' }}>Yes</option>
</select>
</div>

<div class="col-md-6">
<label>Thumbnail Image</label>
<input type="file" name="thumbnail_image" class="form-control">
</div>

<div class="col-md-6">
@if($property->thumbnail_image)
<img src="{{ asset($property->thumbnail_image) }}"
width="150"
class="mt-2 rounded shadow">
@endif
</div>

<div class="col-md-6">
<label>SEO Title</label>
<input type="text" name="seo_title"
value="{{ old('seo_title',$property->seo_title) }}"
class="form-control">
</div>

<div class="col-md-6">
<label>SEO Meta Description</label>
<input type="text" name="seo_meta_description"
value="{{ old('seo_meta_description',$property->seo_meta_description) }}"
class="form-control">
</div>

</div>

<div class="mt-4">
<button class="btn btn-warning w-100 py-2">
<i class="fas fa-save me-2"></i>Update Property
</button>
</div>

</form>
</div>
</div>
</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>