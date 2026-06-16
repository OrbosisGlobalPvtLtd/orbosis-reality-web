<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Builder Login | Orbosisreality </title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- FontAwesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<style>

:root{
    --primary:#2bb673;
    --primary-dark:#1f8c56;
    --light-bg:#f8f9fa;
    --text-dark:#1e293b;
}

/* ================= BODY BACKGROUND ================= */
body{
    margin:0;
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(rgba(0,0,0,0.55),rgba(0,0,0,0.55)),
    url('https://orbosisreality.com/public/frontend/img/WhatsApp Image 2026-03-20 at 3.39.20 PM (3).jpeg');
    background-size:cover;
    background-position:center;
    background-attachment:fixed;
    color:#fff;
}

/* ================= HEADER ================= */
.main-header{
    background:rgba(255,255,255,0.95);
    backdrop-filter: blur(6px);
}

.navbar-brand{
    font-weight:700;
    color:var(--primary) !important;
    font-size:22px;
}

/* ================= LOGIN CARD ================= */
.login-wrapper{
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:40px 15px;
}

.login-card{
    background:rgba(255,255,255,0.95);
    border-radius:20px;
    padding:35px;
    width:100%;
    max-width:420px;
    box-shadow:0 15px 40px rgba(0,0,0,0.25);
    transition:0.3s;
}

.login-card:hover{
    transform:translateY(-5px);
}

.login-title{
    font-weight:700;
    color:var(--text-dark);
}

.login-subtitle{
    color:#6c757d;
    font-size:14px;
}

/* ================= INPUT STYLE ================= */
.form-control{
    border-radius:12px;
    padding:12px;
}

.input-group-text{
    border-radius:12px 0 0 12px;
}

.btn-primary{
    background:var(--primary);
    border:none;
    border-radius:50px;
    padding:12px;
    font-weight:600;
}

.btn-primary:hover{
    background:var(--primary-dark);
}

/* ================= FOOTER ================= */
.main-footer{
    background:rgba(0,0,0,0.6);
    padding:15px 0;
    text-align:center;
    font-size:14px;
    color:#fff;
}

/* ================= RESPONSIVE ================= */
@media(max-width:768px){
    .login-card{
        padding:25px;
    }
}

</style>
</head>

<body>

<!-- ================= HEADER ================= -->
<nav class="navbar navbar-expand-lg main-header py-3">
<div class="container">
    <a class="navbar-brand" href="#">
        <i class="fas fa-building me-2"></i> Orbosisreality Builder Portal
    </a>
    <div class="ms-auto">
        <a href="{{ route('builder.register') }}" class="btn btn-outline-success rounded-pill px-4">
            Register
        </a>
    </div>
</div>
</nav>

<!-- ================= LOGIN SECTION ================= -->
<div class="login-wrapper">

<div class="login-card">

    <div class="text-center mb-4">
        <h3 class="login-title">Builder Login</h3>
        <p class="login-subtitle">Access your dashboard</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('builder.login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-3">
            <label class="form-label fw-semibold text-dark">Email</label>
            <div class="input-group">
                <span class="input-group-text bg-light">
                    <i class="fas fa-envelope text-secondary"></i>
                </span>
                <input type="email" name="email" class="form-control" required>
            </div>
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label class="form-label fw-semibold text-dark">Password</label>
            <div class="input-group">
                <span class="input-group-text bg-light">
                    <i class="fas fa-lock text-secondary"></i>
                </span>
                <input type="password" name="password" id="password" class="form-control" required>
                <span class="input-group-text bg-light" onclick="togglePassword()" style="cursor:pointer;">
                    <i class="fas fa-eye" id="toggleIcon"></i>
                </span>
            </div>
        </div>

        <!-- Remember + Forgot -->
        <div class="d-flex justify-content-between mb-3">
            <div>
                <input type="checkbox" name="remember"> <small class="text-dark">Remember me</small>
            </div>
            <a href="#" class="text-decoration-none small">Forgot password?</a>
        </div>

        <!-- Login Button -->
        <div class="d-grid mb-3">
            <button class="btn btn-primary">
                <i class="fas fa-sign-in-alt me-2"></i> Login
            </button>
        </div>

        <!-- Register -->
        <div class="text-center">
            <small class="text-dark">
                Don’t have an account?
                <a href="{{ route('builder.register') }}" class="fw-bold text-success">
                    Register
                </a>
            </small>
        </div>

    </form>

</div>
</div>

<!-- ================= FOOTER ================= -->
<footer class="main-footer">
    © {{ date('Y') }} Orbosisreality Global Pvt. Ltd. All Rights Reserved.
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
function togglePassword(){
    const password = document.getElementById("password");
    const icon = document.getElementById("toggleIcon");

    if(password.type === "password"){
        password.type = "text";
        icon.classList.replace("fa-eye","fa-eye-slash");
    }else{
        password.type = "password";
        icon.classList.replace("fa-eye-slash","fa-eye");
    }
}
</script>

</body>
</html>