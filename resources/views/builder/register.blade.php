<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Builder Registration | Orbosisreality</title>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- FontAwesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<style>

:root{
    --primary:#2bb673;
    --primary-dark:#1f8c56;
    --text-dark:#1e293b;
}

/* ===== BODY BACKGROUND ===== */
body{
    margin:0;
    font-family:'Segoe UI',sans-serif;
    background: linear-gradient(rgba(0,0,0,0.65),rgba(0,0,0,0.65)),
    url('https://orbosisreality.com/public/uploads/website-images/login-logo-2026-01-15-07-25-02-8753.jpg');
    background-size:cover;
    background-position:center;
    background-attachment:fixed;
}

/* ===== HEADER ===== */
.navbar{
    background:rgba(255,255,255,0.95);
    backdrop-filter: blur(6px);
}

.navbar-brand{
    font-weight:700;
    color:var(--primary) !important;
    font-size:22px;
}

/* ===== REGISTRATION WRAPPER ===== */
.register-wrapper{
    padding:60px 15px;
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
}

/* ===== GLASS CARD ===== */
.register-card{
    background:rgba(255,255,255,0.95);
    border-radius:22px;
    padding:35px;
    width:100%;
    max-width:950px;
    box-shadow:0 20px 50px rgba(0,0,0,0.35);
    transition:0.3s;
}

.register-card:hover{
    transform:translateY(-6px);
}

/* ===== TITLE ===== */
.card-title{
    font-weight:700;
    color:var(--text-dark);
}

/* ===== INPUTS ===== */
.form-control,
.form-select{
    border-radius:12px;
    padding:12px;
}

.input-group-text{
    border-radius:12px 0 0 12px;
}

/* ===== BUTTON ===== */
.btn-primary{
    background:var(--primary);
    border:none;
    border-radius:50px;
    padding:12px 35px;
    font-weight:600;
}

.btn-primary:hover{
    background:var(--primary-dark);
}

/* ===== FOOTER ===== */
.footer{
    background:rgba(0,0,0,0.7);
    color:#fff;
    padding:15px;
    text-align:center;
    font-size:14px;
}

/* ===== RESPONSIVE ===== */
@media(max-width:768px){
    .register-card{
        padding:25px;
    }
}

</style>
</head>

<body>

<!-- ===== HEADER ===== -->
<nav class="navbar navbar-expand-lg px-4 py-3">
<div class="container">
    <a class="navbar-brand" href="#">
        <i class="fas fa-building me-2"></i> Orbosisreality Builder Portal
    </a>
    <div class="ms-auto">
        <a href="{{ route('builder.login') }}" class="btn btn-outline-success rounded-pill px-4">
            Login
        </a>
    </div>
</div>
</nav>

<!-- ===== REGISTRATION SECTION ===== -->
<div class="register-wrapper">

<div class="register-card">

<div class="text-center mb-4">
    <h3 class="card-title">Builder Registration</h3>
    <p class="text-muted">Create your builder account</p>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ route('builder.register') }}">
@csrf

<div class="row">

<div class="col-md-6 mb-3">
<label class="form-label fw-semibold">Full Name *</label>
<input type="text" name="name" class="form-control" required>
</div>

<div class="col-md-6 mb-3">
<label class="form-label fw-semibold">Email *</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="col-md-6 mb-3">
<label class="form-label fw-semibold">Company Name *</label>
<input type="text" name="company_name" class="form-control" required>
</div>

<div class="col-md-6 mb-3">
<label class="form-label fw-semibold">Phone *</label>
<input type="text" name="phone_number" class="form-control" required>
</div>

<div class="col-md-4 mb-3">
<label class="form-label fw-semibold">Country *</label>
<select name="country_id" id="country" class="form-select" required>
<option value="">Select</option>
@foreach($countries as $country)
<option value="{{ $country->id }}">{{ $country->name }}</option>
@endforeach
</select>
</div>

<div class="col-md-4 mb-3">
<label class="form-label fw-semibold">State *</label>
<select name="state_id" id="state" class="form-select" required>
<option value="">Select</option>
</select>
</div>

<div class="col-md-4 mb-3">
<label class="form-label fw-semibold">City *</label>
<select name="city_id" id="city" class="form-select" required>
<option value="">Select</option>
</select>
</div>

<div class="col-12 mb-3">
<label class="form-label fw-semibold">Address *</label>
<textarea name="address" class="form-control" rows="2" required></textarea>
</div>

<div class="col-md-6 mb-3">
<label class="form-label fw-semibold">Password *</label>
<div class="input-group">
<input type="password" name="password" id="password" class="form-control" required>
<button type="button" class="btn btn-outline-secondary toggle-password">
<i class="fas fa-eye"></i>
</button>
</div>
</div>

<div class="col-md-6 mb-3">
<label class="form-label fw-semibold">Confirm Password *</label>
<input type="password" name="password_confirmation" class="form-control" required>
</div>

<div class="col-12 text-center mt-3">
<button class="btn btn-primary">
<i class="fas fa-user-plus me-2"></i> Register Now
</button>
</div>

<div class="col-12 text-center mt-3">
Already have an account?
<a href="{{ route('builder.login') }}" class="fw-bold text-success">Login</a>
</div>

</div>
</form>

</div>
</div>

<!-- ===== FOOTER ===== -->
<div class="footer">
© {{ date('Y') }} Orbosis Global Pvt. Ltd. All Rights Reserved.
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$('#country').change(function(){
let id=$(this).val();
$.get('/get-states/'+id,function(data){
let options='<option value="">Select</option>';
data.forEach(function(state){
options+=`<option value="${state.id}">${state.name}</option>`;
});
$('#state').html(options);
});
});

$('#state').change(function(){
let id=$(this).val();
$.get('/get-cities/'+id,function(data){
let options='<option value="">Select</option>';
data.forEach(function(city){
options+=`<option value="${city.id}">${city.name}</option>`;
});
$('#city').html(options);
});
});

document.querySelector('.toggle-password').addEventListener('click',function(){
let input=document.getElementById('password');
let icon=this.querySelector('i');
if(input.type==='password'){
input.type='text';
icon.classList.replace('fa-eye','fa-eye-slash');
}else{
input.type='password';
icon.classList.replace('fa-eye-slash','fa-eye');
}
});
</script>

</body>
</html>