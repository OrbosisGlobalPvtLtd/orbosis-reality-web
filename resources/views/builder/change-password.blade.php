<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Builder Panel - Change Password</title>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- FontAwesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<style>
body {
    background-color: #f4f6f9;
    font-family: 'Segoe UI', sans-serif;
}

/* ================= HEADER ================= */
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

/* ================= SIDEBAR ================= */
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
    font-size: 14px;
}

.sidebar .nav-link:hover,
.sidebar .nav-link.active {
    background: #0d6efd;
    color: #fff;
}

/* ================= MAIN CONTENT ================= */
.main-content {
    padding: 30px;
}

/* ================= CARD ================= */
.card {
    border-radius: 18px;
}

.form-control {
    border-radius: 10px;
}

.btn {
    border-radius: 8px;
}

/* ================= PASSWORD STRENGTH ================= */
.password-strength {
    height: 6px;
    background: #e9ecef;
    border-radius: 5px;
    overflow: hidden;
}

#strengthBar {
    height: 100%;
    width: 0%;
    transition: 0.3s;
}

/* ================= FOOTER ================= */
.footer {
    background: #ffffff;
    padding: 18px;
    font-size: 14px;
    text-align: center;
    border-top: 1px solid #e5e7eb;
}

/* ================= RESPONSIVE ================= */
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

<!-- ================= HEADER ================= -->
<nav class="top-navbar d-flex align-items-center px-3">
    <button class="btn btn-outline-secondary d-lg-none me-3" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>
    <span class="brand-text">Builder Panel</span>
</nav>

<div class="d-flex">

    <!-- ================= SIDEBAR ================= -->
    <div class="sidebar p-3" id="sidebarMenu">
        <h6 class="text-white mb-4">Navigation</h6>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('builder.dashboard') }}" class="nav-link">
                    <i class="fas fa-home me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('builder.profile') }}" class="nav-link">
                    <i class="fas fa-user me-2"></i> Profile
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('builder.change-password') }}" class="nav-link active">
                    <i class="fas fa-lock me-2"></i> Change Password
                </a>
            </li>
        </ul>
    </div>

    <!-- ================= CONTENT ================= -->
    <div class="flex-fill main-content">

        <!-- Page Header -->
        <div class="row mb-4 align-items-center">
            <div class="col-md-8">
                <h2 class="fw-bold">
                    <i class="fas fa-lock text-primary"></i> Change Password
                </h2>
                <p class="text-muted">Update your account password securely</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('builder.dashboard') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-5 col-lg-6 col-md-8 mx-auto">

                <div class="card shadow-lg border-0">
                    <div class="card-body p-4">

                        <form action="{{ route('builder.update-password') }}" method="POST">
                            @csrf

                            <!-- Current Password -->
                            <div class="mb-3">
                                <label class="form-label">Current Password</label>
                                <div class="input-group">
                                    <input type="password" name="current_password" id="current_password" class="form-control" required>
                                    <button type="button" class="btn btn-outline-secondary toggle-password" data-target="current_password">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- New Password -->
                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <div class="input-group">
                                    <input type="password" name="new_password" id="new_password" class="form-control" required>
                                    <button type="button" class="btn btn-outline-secondary toggle-password" data-target="new_password">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>

                                <div class="password-strength mt-2">
                                    <div id="strengthBar"></div>
                                </div>
                                <small id="strengthText" class="text-muted"></small>
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                <div class="input-group">
                                    <input type="password" name="new_password_confirmation" id="confirm_password" class="form-control" required>
                                    <button type="button" class="btn btn-outline-secondary toggle-password" data-target="confirm_password">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-check-circle"></i> Update Password
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<!-- ================= FOOTER ================= -->
<div class="footer">
    © {{ date('Y') }} Builder Portal. All rights reserved.
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Sidebar Toggle
document.getElementById('sidebarToggle').addEventListener('click', function(){
    document.getElementById('sidebarMenu').classList.toggle('show');
});

// Toggle Password Visibility
document.querySelectorAll('.toggle-password').forEach(button => {
    button.addEventListener('click', function() {
        const target = document.getElementById(this.dataset.target);
        const icon = this.querySelector('i');

        if (target.type === "password") {
            target.type = "text";
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            target.type = "password";
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    });
});

// Password Strength
const passwordInput = document.getElementById('new_password');
const strengthBar = document.getElementById('strengthBar');
const strengthText = document.getElementById('strengthText');

passwordInput.addEventListener('keyup', function() {
    let strength = 0;
    const val = this.value;

    if (val.length >= 8) strength++;
    if (/[A-Z]/.test(val)) strength++;
    if (/[0-9]/.test(val)) strength++;
    if (/[^A-Za-z0-9]/.test(val)) strength++;

    let width = (strength / 4) * 100;
    strengthBar.style.width = width + "%";

    if (strength <= 1) {
        strengthBar.style.background = "#dc3545";
        strengthText.textContent = "Weak Password";
    } else if (strength == 2) {
        strengthBar.style.background = "#ffc107";
        strengthText.textContent = "Medium Password";
    } else {
        strengthBar.style.background = "#28a745";
        strengthText.textContent = "Strong Password";
    }
});
</script>

</body>
</html>