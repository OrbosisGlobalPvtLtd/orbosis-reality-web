@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Dashboard')}}</title>
@endsection
@section('admin-content')
<style>
    .stat-card-v2 {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.03);
        border: 1px solid #eef2f7;
        padding: 22px;
        display: flex;
        align-items: center;
        gap: 18px;
        transition: all 0.3s ease;
        margin-bottom: 24px;
    }
    .stat-card-v2:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.07);
    }
    .stat-icon-wrapper {
        width: 54px;
        height: 54px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }
    .stat-icon--purple { background: rgba(112, 101, 240, 0.12); color: #7065f0; }
    .stat-icon--green { background: rgba(16, 185, 129, 0.12); color: #10b981; }
    .stat-icon--orange { background: rgba(245, 158, 11, 0.12); color: #f59e0b; }
    .stat-icon--blue { background: rgba(59, 130, 246, 0.12); color: #3b82f6; }
    .stat-icon--red { background: rgba(239, 68, 68, 0.12); color: #ef4444; }

    .stat-info {
        flex-grow: 1;
    }
    .stat-info__label {
        font-size: 12px;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }
    .stat-info__value {
        font-size: 24px;
        font-weight: 800;
        color: #0f172a;
        margin: 0;
        line-height: 1.2;
    }
    .dashboard-section-header {
        font-size: 18px;
        font-weight: 700;
        color: #1e293b;
        margin-top: 15px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .custom-table-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.03);
        border: 1px solid #eef2f7;
        overflow: hidden;
        margin-bottom: 30px;
    }
    .custom-table-card__header {
        padding: 20px 24px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .custom-table-card__title {
        font-size: 16px;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
    }
</style>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{__('admin.Dashboard')}}</h1>
        </div>

        <div class="section-body">
            <!-- Key Performance Metrics -->
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="stat-card-v2">
                        <div class="stat-icon-wrapper stat-icon--green">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-info__label">{{__('admin.Total Earning')}}</div>
                            <div class="stat-info__value">{{ num_format($total_earning) }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-12">
                    <div class="stat-card-v2">
                        <div class="stat-icon-wrapper stat-icon--blue">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-info__label">{{__('admin.Total Property')}}</div>
                            <div class="stat-info__value">{{ $total_property }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-12">
                    <div class="stat-card-v2">
                        <div class="stat-icon-wrapper stat-icon--purple">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-info__label">{{__('admin.Total Orders')}}</div>
                            <div class="stat-info__value">{{ $total_total_order }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-12">
                    <div class="stat-card-v2">
                        <div class="stat-icon-wrapper stat-icon--orange">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-info__label">{{__('admin.Total Users')}}</div>
                            <div class="stat-info__value">{{ $total_users }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Property Breakdown Stats -->
            <h4 class="dashboard-section-header">
                <i class="fas fa-home text-primary"></i> Property Statistics
            </h4>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="stat-card-v2">
                        <div class="stat-icon-wrapper stat-icon--green">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-info__label">{{__('admin.Publish Property')}}</div>
                            <div class="stat-info__value">{{ $total_publish_property }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-12">
                    <div class="stat-card-v2">
                        <div class="stat-icon-wrapper stat-icon--purple">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-info__label">{{__('admin.Own Property')}}</div>
                            <div class="stat-info__value">{{ $total_own_property }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-12">
                    <div class="stat-card-v2">
                        <div class="stat-icon-wrapper stat-icon--orange">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-info__label">{{__('admin.Awaiting Approval')}}</div>
                            <div class="stat-info__value">{{ $awaiting_property }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-12">
                    <div class="stat-card-v2">
                        <div class="stat-icon-wrapper stat-icon--red">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-info__label">{{__('admin.Rejected Property')}}</div>
                            <div class="stat-info__value">{{ $reject_property }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Periodic Performance Overview -->
            <h4 class="dashboard-section-header">
                <i class="fas fa-chart-line text-success"></i> Revenue & Order Breakdown
            </h4>
            <div class="row">
                <!-- Today Summary -->
                <div class="col-lg-4 col-12">
                    <div class="card shadow-sm border-0 rounded-lg">
                        <div class="card-header bg-primary text-white font-weight-bold">
                            <i class="fas fa-calendar-day mr-2"></i> {{__('admin.Today')}}
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-shopping-bag text-primary mr-2"></i> Orders</span>
                                    <span class="badge badge-primary badge-pill font-weight-bold">{{ $today_total_order }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-money-bill-wave text-success mr-2"></i> Total Earning</span>
                                    <span class="font-weight-bold text-success">{{ num_format($today_total_earning) }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-users text-info mr-2"></i> New Users</span>
                                    <span class="badge badge-info badge-pill font-weight-bold">{{ $today_users }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Monthly Summary -->
                <div class="col-lg-4 col-12">
                    <div class="card shadow-sm border-0 rounded-lg">
                        <div class="card-header bg-success text-white font-weight-bold">
                            <i class="fas fa-calendar-alt mr-2"></i> {{__('admin.This Month')}}
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-shopping-bag text-success mr-2"></i> Orders</span>
                                    <span class="badge badge-success badge-pill font-weight-bold">{{ $monthly_total_order }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-money-bill-wave text-success mr-2"></i> Total Earning</span>
                                    <span class="font-weight-bold text-success">{{ num_format($monthly_total_earning) }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-users text-info mr-2"></i> New Users</span>
                                    <span class="badge badge-info badge-pill font-weight-bold">{{ $monthly_users }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Yearly Summary -->
                <div class="col-lg-4 col-12">
                    <div class="card shadow-sm border-0 rounded-lg">
                        <div class="card-header bg-purple text-white font-weight-bold" style="background-color: #6777ef;">
                            <i class="fas fa-calendar mr-2"></i> {{__('admin.This Year')}}
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-shopping-bag text-primary mr-2"></i> Orders</span>
                                    <span class="badge badge-primary badge-pill font-weight-bold">{{ $yearly_total_order }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-money-bill-wave text-success mr-2"></i> Total Earning</span>
                                    <span class="font-weight-bold text-success">{{ num_format($yearly_total_earning) }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-users text-info mr-2"></i> New Users</span>
                                    <span class="badge badge-info badge-pill font-weight-bold">{{ $yearly_users }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity Tables -->
            <div class="row mt-4">
                <!-- Recent Properties -->
                <div class="col-lg-6 col-12">
                    <div class="custom-table-card">
                        <div class="custom-table-card__header">
                            <h4 class="custom-table-card__title"><i class="fas fa-building text-primary mr-2"></i> Recent Properties</h4>
                            <a href="{{ route('admin.property.index') }}" class="btn btn-sm btn-primary">View All</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Price</th>
                                        <th>Purpose</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recent_properties as $prop)
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.property.edit', $prop->id) }}" class="font-weight-bold text-dark">
                                                {{ Str::limit($prop->title, 25) }}
                                            </a>
                                        </td>
                                        <td><span class="font-weight-bold text-success">{{ num_format($prop->price) }}</span></td>
                                        <td><span class="badge badge-secondary">{{ ucfirst($prop->purpose) }}</span></td>
                                        <td>
                                            @if($prop->approve_by_admin == 'approved')
                                                <span class="badge badge-success">Approved</span>
                                            @elseif($prop->approve_by_admin == 'pending')
                                                <span class="badge badge-warning">Pending</span>
                                            @else
                                                <span class="badge badge-danger">Rejected</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">No properties found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders -->
                <div class="col-lg-6 col-12">
                    <div class="custom-table-card">
                        <div class="custom-table-card__header">
                            <h4 class="custom-table-card__title"><i class="fas fa-shopping-cart text-success mr-2"></i> Recent Package Purchases</h4>
                            <a href="{{ route('admin.purchase-history') }}" class="btn btn-sm btn-success">View All</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Amount</th>
                                        <th>Payment</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recent_orders as $ord)
                                    <tr>
                                        <td><span class="font-weight-bold">#{{ $ord->order_id ?? $ord->id }}</span></td>
                                        <td><span class="font-weight-bold text-success">{{ num_format($ord->plan_price ?? 0) }}</span></td>
                                        <td>
                                            @if(($ord->payment_status ?? '') == 'success' || ($ord->payment_status ?? '') == 1)
                                                <span class="badge badge-success">Success</span>
                                            @else
                                                <span class="badge badge-warning">Pending</span>
                                            @endif
                                        </td>
                                        <td><span class="text-muted">{{ date('d M Y', strtotime($ord->created_at)) }}</span></td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">No purchases found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection
