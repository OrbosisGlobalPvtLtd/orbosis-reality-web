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
        body {
            background: #f4f6fb;
            font-family: 'Segoe UI', sans-serif;
        }

        /* ================= HEADER ================= */
        .top-navbar {
            height: 65px;
            background: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            padding: 0 20px;
        }

        .brand-text {
            font-weight: 700;
            font-size: 18px;
            color: #4f46e5;
        }

        /* ================= LAYOUT ================= */
        .wrapper {
            display: flex;
            margin-top: 65px;
        }

        /* ================= SIDEBAR ================= */
        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: #ffffff;
            border-right: 1px solid #e5e7eb;
            padding: 20px 15px;
        }

        .sidebar .nav-link {
            color: #6b7280;
            font-size: 14px;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 8px;
            transition: 0.3s;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: #eef2ff;
            color: #4f46e5;
            font-weight: 600;
        }

        /* ================= MAIN CONTENT ================= */
        .main-content {
            flex: 1;
            padding: 30px;
        }

        /* ================= CARDS ================= */
        .dashboard-card {
            background: #ffffff;
            border-radius: 15px;
            padding: 30px 20px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.04);
            transition: 0.3s;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
        }

        .dashboard-card i {
            font-size: 28px;
            margin-bottom: 15px;
            color: #6366f1;
        }

        .dashboard-card h6 {
            font-weight: 600;
            margin-bottom: 10px;
            color: #374151;
        }

        .dashboard-card h2 {
            font-weight: 700;
            color: #111827;
        }

        /* ================= FOOTER ================= */
        .footer {
            background: #ffffff;
            padding: 15px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
            font-size: 14px;
        }

        @media(max-width:991px) {
            .sidebar {
                display: none;
            }
        }
    </style>
    <style>
        body {
            background: #f4f6fb;
            font-family: 'Segoe UI', sans-serif;
        }

        /* HEADER */
        .top-navbar {
            height: 65px;
            background: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: fixed;
            width: 100%;
            z-index: 1000;
            display: flex;
            align-items: center;
            padding: 0 20px;
        }

        .wrapper {
            display: flex;
            margin-top: 65px;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            background: #ffffff;
            min-height: 100vh;
            border-right: 1px solid #e5e7eb;
            padding: 20px 15px;
            transition: 0.3s;
        }

        .sidebar .nav-link {
            color: #6b7280;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: #eef2ff;
            color: #4f46e5;
            font-weight: 600;
        }

        /* MAIN */
        .main-content {
            flex: 1;
            padding: 30px;
        }

        /* CARD */
        .content-card {
            background: #fff;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        /* TABLE */
        .table thead {
            background: #f9fafb;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        /* MOBILE */
        @media(max-width:991px) {
            .sidebar {
                position: fixed;
                left: -260px;
                top: 65px;
                height: 100%;
                z-index: 2000;
            }

            .sidebar.show {
                left: 0;
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
                        <i class="fas fa-shopping-cart me-2"></i>My Booking 
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
        <!-- MAIN -->
        <div class="main-content">

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="d-flex justify-content-between mb-4">
                <h4 class="fw-bold">My Properties</h4>
                <a href="{{ route('builder.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i> Add Property
                </a>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table align-middle table-hover">

                            <thead class="table-light">
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Admin Approval</th>
                                    <th width="200">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($properties as $property)
                                    <tr>

                                        <td>
                                            @if ($property->thumbnail_image)
                                                <img src="{{ asset($property->thumbnail_image) }}" width="70"
                                                    class="rounded shadow-sm">
                                            @endif
                                        </td>

                                        <td><strong>{{ $property->title }}</strong></td>

                                        <td>₹ {{ number_format($property->price) }}</td>

                                        <!-- Enable / Disable -->
                                        <td>
                                            <form action="{{ route('builder.status', $property->id) }}" method="POST">
                                                @csrf
                                                <select name="status" onchange="this.form.submit()"
                                                    class="form-select form-select-sm
        {{ $property->status == 'enable' ? 'border-success text-success' : 'border-danger text-danger' }}">

                                                    <option value="enable"
                                                        {{ $property->status == 'enable' ? 'selected' : '' }}>
                                                        Enable
                                                    </option>

                                                    <option value="disable"
                                                        {{ $property->status == 'disable' ? 'selected' : '' }}>
                                                        Disable
                                                    </option>
                                                </select>
                                            </form>
                                        </td>

                                        <!-- Admin Approval -->
                                        <td>
                                            <form action="{{ route('builder.status', $property->id) }}" method="POST">
                                                @csrf
                                                <select name="approve_by_admin" onchange="this.form.submit()"
                                                    class="form-select form-select-sm
        {{ $property->approve_by_admin == 'approved' ? 'border-success text-success' : 'border-warning text-warning' }}">

                                                    <option value="pending"
                                                        {{ $property->approve_by_admin == 'pending' ? 'selected' : '' }}>
                                                        Pending
                                                    </option>

                                                    <option value="approved"
                                                        {{ $property->approve_by_admin == 'approved' ? 'selected' : '' }}>
                                                        Approved
                                                    </option>
                                                </select>
                                            </form>
                                        </td>

                                        <td> <a href="{{ route('builder.edit', $property->id) }}"
                                                class="btn btn-sm btn-warning"> <i class="fas fa-edit"></i> </a>
                                            <form action="{{ route('builder.delete', $property->id) }}" method="POST"
                                                class="d-inline"> @csrf @method('DELETE') <button type="submit"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this property?')">
                                                    <i class="fas fa-trash"></i> </button> </form>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">No Properties Found</td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $properties->links('pagination::bootstrap-5') }}
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebarMenu').classList.toggle('show');
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    </body>

</html>
