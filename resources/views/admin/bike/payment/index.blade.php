@extends('layouts.admin.app', ['title' => $pageTitle])

@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="d-flex align-items-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style2">
                    <li class="breadcrumb-item">
                        <a href="#">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle }}</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex my-auto">
            <div class="d-flex">
                <!-- Report Icon -->
                <a href="{{ route('admin.bike.register.payment.report') }}" class="btn btn-warning me-2"
                    title="Generate Report">
                    <i class="fas fa-chart-bar"></i> Generate Report
                </a>
            </div>
        </div>
    </div>

    <div class="main-content-body">
        <!-- Statistics Cards -->
        <div class="row row-sm mb-4">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="mb-1">Total Payments</p>
                                <h3 class="mb-0">{{ $totalPayments }}</h3>
                            </div>
                            <div class="avatar bg-primary-transparent text-primary rounded-circle">
                                <i class="fas fa-money-bill-wave fs-20"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="mb-1">Pending Approval</p>
                                <h3 class="mb-0">{{ $pendingPayments }}</h3>
                            </div>
                            <div class="avatar bg-warning-transparent text-warning rounded-circle">
                                <i class="fas fa-clock fs-20"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="mb-1">Approved Payments</p>
                                <h3 class="mb-0">{{ $approvedPayments }}</h3>
                            </div>
                            <div class="avatar bg-success-transparent text-success rounded-circle">
                                <i class="fas fa-check-circle fs-20"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="mb-1">Total Revenue</p>
                                <h3 class="mb-0">৳{{ number_format($totalRevenue, 2) }}</h3>
                            </div>
                            <div class="avatar bg-info-transparent text-info rounded-circle">
                                <i class="fas fa-coins fs-20"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Card -->
        <div class="row row-sm mb-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.bike.register.payment') }}" method="GET">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="">All Status</option>
                                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>
                                                Active</option>
                                            <option value="blocked" {{ request('status') == 'blocked' ? 'selected' : '' }}>
                                                Blocked</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Approval Status</label>
                                        <select name="approval_status" class="form-control">
                                            <option value="">All Approval</option>
                                            <option value="pending"
                                                {{ request('approval_status') == 'pending' ? 'selected' : '' }}>Pending
                                            </option>
                                            <option value="approved"
                                                {{ request('approval_status') == 'approved' ? 'selected' : '' }}>Approved
                                            </option>
                                            <option value="rejected"
                                                {{ request('approval_status') == 'rejected' ? 'selected' : '' }}>Rejected
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Payment Method</label>
                                        <select name="payment_method" class="form-control">
                                            <option value="">All Methods</option>
                                            <option value="cash"
                                                {{ request('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                                            <option value="bank_transfer"
                                                {{ request('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank
                                                Transfer</option>
                                            <option value="mobile_banking"
                                                {{ request('payment_method') == 'mobile_banking' ? 'selected' : '' }}>
                                                Mobile Banking</option>
                                            <option value="card"
                                                {{ request('payment_method') == 'card' ? 'selected' : '' }}>Card</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Search</label>
                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control"
                                                placeholder="Search..." value="{{ request('search') }}">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fas fa-search"></i>
                                            </button>
                                            <a href="{{ route('admin.bike.register.payment') }}" class="btn btn-light">
                                                <i class="fas fa-redo"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payments Table -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                        <p class="card-title my-0">{{ $pageTitle }}
                            <span class="badge bg-danger side-badge"
                                style="font-size:17px;">{{ $payments->total() }}</span>
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-nowrap border-bottom">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>User</th>
                                        <th>Bike Reg. No</th>
                                        <th>Plan</th>
                                        <th>Amount</th>
                                        <th>Due Days/Amount</th>
                                        <th>Payment Method</th>
                                        <th>Next Due</th>
                                        <th>Status</th>
                                        <th>Approval</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($payments as $key => $payment)
                                        <tr>
                                            <td>{{ ($payments->currentPage() - 1) * $payments->perPage() + $loop->iteration }}
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="me-2">
                                                        <span class="avatar avatar-sm">
                                                            {{ substr($payment->user->name ?? 'NA', 0, 2) }}
                                                        </span>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">{{ $payment->user->name ?? 'N/A' }}</h6>
                                                        <small>{{ $payment->user->email ?? 'N/A' }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($payment->bike)
                                                    {{ $payment->bike->registration_no }}
                                                    <br>
                                                    <small class="text-muted">{{ $payment->bike->name }}</small>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                <span
                                                    class="badge bg-{{ $payment->plan == 'daily' ? 'info' : 'warning' }}">
                                                    {{ ucfirst($payment->plan) }}
                                                </span>
                                            </td>
                                            <td>
                                                <strong>৳{{ number_format($payment->fixed_amount, 2) }}</strong>
                                                <br>
                                                <small class="text-success">Total:
                                                    ৳{{ number_format($payment->total_paid, 2) }}</small>
                                            </td>
                                            <td>
                                                @if ($payment->due_days > 0)
                                                    <span class="badge bg-danger">{{ $payment->due_days }} days</span>
                                                    <br>
                                                    <small
                                                        class="text-danger">${{ number_format($payment->due_amount, 2) }}</small>
                                                @else
                                                    <span class="badge bg-success">No Due</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}
                                                @if ($payment->payment_slip)
                                                    <br>
                                                    <small>
                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#slipModal{{ $payment->id }}">
                                                            View Slip
                                                        </a>
                                                    </small>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($payment->next_due_date)
                                                    <span
                                                        class="badge bg-{{ $payment->next_due_date < now() ? 'danger' : 'success' }}">
                                                        {{ $payment->next_due_date->format('d M, Y') }}
                                                    </span>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                <span
                                                    class="badge bg-{{ $payment->status == 'active' ? 'success' : 'danger' }}">
                                                    {{ ucfirst($payment->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($payment->approval_status == 'approved')
                                                    <span class="badge bg-success">Approved</span>
                                                @elseif($payment->approval_status == 'pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                @elseif($payment->approval_status == 'rejected')
                                                    <span class="badge bg-danger">Rejected</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <!-- Approve Button (only for pending) -->
                                                    @if ($payment->approval_status == 'pending')
                                                        <button type="button" class="btn btn-success btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#approveModal{{ $payment->id }}"
                                                            title="Approve Payment">
                                                            <i class="fas fa-check"></i>
                                                        </button>

                                                        <!-- Reject Button -->
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#rejectModal{{ $payment->id }}"
                                                            title="Reject Payment">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    @endif

                                                    <!-- Block/Unblock Button -->
                                                    @if ($payment->status == 'active')
                                                        <button type="button" class="btn btn-warning btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#blockModal{{ $payment->id }}"
                                                            title="Block Payment">
                                                            <i class="fas fa-ban"></i>
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-info btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#unblockModal{{ $payment->id }}"
                                                            title="Unblock Payment">
                                                            <i class="fas fa-unlock"></i>
                                                        </button>
                                                    @endif

                                                    <!-- Delete Button -->
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $payment->id }}"
                                                        title="Delete Payment">
                                                        <i class="fas fa-trash"></i>
                                                    </button>

                                                    <!-- View Details Button -->
                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#detailsModal{{ $payment->id }}"
                                                        title="View Details">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="11" class="text-center">No payments found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if ($payments->hasPages())
                            <div class="mt-3">
                                {{ $payments->withQueryString()->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ========== MODALS FOR EACH PAYMENT ========== -->

    <!-- Approve Modal -->
    <div class="modal fade" id="approveModal{{ $payment->id }}" tabindex="-1"
        aria-labelledby="approveModalLabel{{ $payment->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="approveModalLabel{{ $payment->id }}">Approve Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.bike.register.payment.approve', $payment->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Are you sure you want to approve this payment?</p>
                        <div class="alert alert-info">
                            <h6>Payment Details:</h6>
                            <ul class="mb-0">
                                <li>User: {{ $payment->user->name ?? 'N/A' }}</li>
                                <li>Bike: {{ $payment->bike->registration_no ?? 'N/A' }}</li>
                                <li>Amount: ৳{{ number_format($payment->fixed_amount, 2) }}</li>
                                <li>Plan: {{ ucfirst($payment->plan) }}</li>
                                <li>Due Days: {{ $payment->due_days }}</li>
                                <li>Due Amount: ৳{{ number_format($payment->due_amount, 2) }}</li>
                            </ul>
                        </div>
                        <p class="text-success">
                            <i class="fas fa-info-circle"></i>
                            This will reduce due days by 1 and update the payment status.
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Approve Payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div class="modal fade" id="rejectModal{{ $payment->id }}" tabindex="-1"
        aria-labelledby="rejectModalLabel{{ $payment->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectModalLabel{{ $payment->id }}">Reject Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.bike.register.payment.reject', $payment->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Are you sure you want to reject this payment?</p>
                        <div class="form-group">
                            <label for="rejection_reason{{ $payment->id }}">Reason for Rejection <span
                                    class="text-danger">*</span></label>
                            <textarea name="rejection_reason" id="rejection_reason{{ $payment->id }}" class="form-control" rows="3"
                                required placeholder="Enter reason for rejection..."></textarea>
                        </div>
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                            This action cannot be undone. User will be notified about the rejection.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Reject Payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Block Modal -->
    <div class="modal fade" id="blockModal{{ $payment->id }}" tabindex="-1"
        aria-labelledby="blockModalLabel{{ $payment->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="blockModalLabel{{ $payment->id }}">Block Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.bike.register.payment.block', $payment->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Are you sure you want to block this payment?</p>
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                            Blocking will prevent further payments until unblocked.
                        </div>
                        <p><strong>Note:</strong> System may auto-block if due days exceed 10 days.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-warning">Block Payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Unblock Modal -->
    <div class="modal fade" id="unblockModal{{ $payment->id }}" tabindex="-1"
        aria-labelledby="unblockModalLabel{{ $payment->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="unblockModalLabel{{ $payment->id }}">Unblock Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.bike.register.payment.unblock', $payment->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Are you sure you want to unblock this payment?</p>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            User will be able to make payments again.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-info">Unblock Payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal{{ $payment->id }}" tabindex="-1"
        aria-labelledby="deleteModalLabel{{ $payment->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel{{ $payment->id }}">Delete Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.bike.register.payment.destroy', $payment->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <p>Are you sure you want to delete this payment?</p>
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle"></i>
                            <strong>Warning:</strong> This action cannot be undone. All payment data including payment slip
                            will be permanently deleted.
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h6>Payment Details:</h6>
                                <ul class="mb-0">
                                    <li>ID: #{{ str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}</li>
                                    <li>User: {{ $payment->user->name ?? 'N/A' }}</li>
                                    <li>Amount: ৳{{ number_format($payment->fixed_amount, 2) }}</li>
                                    <li>Plan: {{ ucfirst($payment->plan) }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete Payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Payment Slip Modal -->
    @if ($payment->payment_slip)
        <div class="modal fade" id="slipModal{{ $payment->id }}" tabindex="-1"
            aria-labelledby="slipModalLabel{{ $payment->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="slipModalLabel{{ $payment->id }}">Payment Slip</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        @if (pathinfo($payment->payment_slip, PATHINFO_EXTENSION) === 'pdf')
                            <embed src="{{ asset('storage/' . $payment->payment_slip) }}" type="application/pdf"
                                width="100%" height="500px">
                            <div class="mt-3">
                                <a href="{{ asset('storage/' . $payment->payment_slip) }}" download
                                    class="btn btn-primary">
                                    <i class="fas fa-download"></i> Download PDF
                                </a>
                            </div>
                        @else
                            <img src="{{ asset('storage/' . $payment->payment_slip) }}" class="img-fluid"
                                alt="Payment Slip">
                            <div class="mt-3">
                                <a href="{{ asset('storage/' . $payment->payment_slip) }}" download
                                    class="btn btn-primary">
                                    <i class="fas fa-download"></i> Download Image
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Details Modal -->
    <div class="modal fade" id="detailsModal{{ $payment->id }}" tabindex="-1"
        aria-labelledby="detailsModalLabel{{ $payment->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel{{ $payment->id }}">Payment Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="mb-3">Payment Information</h6>
                            <table class="table table-sm">
                                <tr>
                                    <th width="40%">Payment ID:</th>
                                    <td>#{{ str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}</td>
                                </tr>
                                <tr>
                                    <th>Plan:</th>
                                    <td>{{ ucfirst($payment->plan) }}</td>
                                </tr>
                                <tr>
                                    <th>Fixed Amount:</th>
                                    <td>৳{{ number_format($payment->fixed_amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Payment Method:</th>
                                    <td>{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</td>
                                </tr>
                                <tr>
                                    <th>Total Paid:</th>
                                    <td class="text-success">${{ number_format($payment->total_paid, 2) }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="mb-3">Status Information</h6>
                            <table class="table table-sm">
                                <tr>
                                    <th width="40%">Status:</th>
                                    <td>
                                        <span class="badge bg-{{ $payment->status == 'active' ? 'success' : 'danger' }}">
                                            {{ ucfirst($payment->status) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Approval Status:</th>
                                    <td>
                                        @if ($payment->approval_status == 'approved')
                                            <span class="badge bg-success">Approved</span>
                                        @elseif($payment->approval_status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($payment->approval_status == 'rejected')
                                            <span class="badge bg-danger">Rejected</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Due Days:</th>
                                    <td>{{ $payment->due_days }} days</td>
                                </tr>
                                <tr>
                                    <th>Due Amount:</th>
                                    <td class="text-danger">${{ number_format($payment->due_amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Next Due Date:</th>
                                    <td>
                                        @if ($payment->next_due_date)
                                            {{ $payment->next_due_date->format('d M, Y') }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="mb-3">User Information</h6>
                            <table class="table table-sm">
                                <tr>
                                    <th width="40%">Name:</th>
                                    <td>{{ $payment->user->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $payment->user->email ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Phone:</th>
                                    <td>{{ $payment->user->phone ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="mb-3">Bike Information</h6>
                            <table class="table table-sm">
                                <tr>
                                    <th width="40%">Registration No:</th>
                                    <td>{{ $payment->bike->registration_no ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Owner Name:</th>
                                    <td>{{ $payment->bike->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Phone:</th>
                                    <td>{{ $payment->bike->phone ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if ($payment->notes)
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <h6>Notes:</h6>
                                <div class="card">
                                    <div class="card-body">
                                        {{ $payment->notes }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <small class="text-muted">Created: {{ $payment->created_at->format('d M, Y h:i A') }}</small>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted">Updated: {{ $payment->updated_at->format('d M, Y h:i A') }}</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('admin')
    <script>
        $(document).ready(function() {
            // Auto focus on search input
            $('input[name="search"]').focus();

            // Initialize tooltips
            $('[title]').tooltip();
        });
    </script>
@endpush
