@extends('layouts.user.app', [$pageTitle => 'Page Title'])

@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="d-flex align-items-center">
            <nav aria-label="breadcrumb">

            </nav>
        </div>
        <div class="d-flex my-auto">
            <div class="d-flex">
                <a href="{{ route('user.bike.register.payment.now') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Make Payment
                </a>
            </div>
        </div>
    </div>

    <div class="main-content-body">
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                        <p class="card-title my-0">{{ $pageTitle ?? 'Bike Payments' }}
                            <span class="badge bg-danger side-badge" style="font-size:17px;">{{ count($payments) }}</span>
                        </p>
                    </div>
                    <div class="row mb-3 p-3">
                        <div class="col-md-4">
                            <div class="card bg-success shadow text-white p-2">
                                <h6>Total Paid</h6>
                                <h4>৳{{ number_format($totalPaid,2) }}</h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-danger shadow text-white p-2">
                                <h6>Total Due</h6>
                                <h4>৳{{ number_format($totalDue,2) }}</h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-warning shadow text-dark p-2">
                                <h6>Today's Due</h6>
                                <h4>৳{{ number_format($todayDue,2) }}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="file-datatable"
                                class="border-top-0  table table-bordered text-nowrap key-buttons border-bottom">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">SL</th>
                                        <th class="border-bottom-0">Bike Reg. No</th>
                                        <th class="border-bottom-0">Plan</th>
                                        <th class="border-bottom-0">Fixed Amount</th>
                                        <th class="border-bottom-0">Payment Method</th>
                                        <th class="border-bottom-0">Last Paid Date</th>
                                        <th class="border-bottom-0">Next Due Date</th>
                                        <th class="border-bottom-0">Due Days</th>
                                        <th class="border-bottom-0">Due Amount</th>
                                        <th class="border-bottom-0">Total Paid</th>
                                        <th class="border-bottom-0">Status</th>
                                        <th class="border-bottom-0">Approval</th>
                                        <th class="border-bottom-0">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($payments as $key => $payment)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if ($payment->bike)
                                                    {{ $payment->bike->registration_no ?? 'N/A' }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-{{ $payment->plan == 'daily' ? 'info' : 'warning' }}">
                                                    {{ ucfirst($payment->plan) }}
                                                </span>
                                            </td>
                                            <td>৳{{ number_format($payment->fixed_amount, 2) }}</td>
                                            <td>{{ ucfirst($payment->payment_method) }}</td>
                                            <td>
                                                @if ($payment->last_paid_date)
                                                    {{ $payment->last_paid_date->format('d M, Y') }}
                                                @else
                                                    Never
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
                                                <span class="badge bg-{{ $payment->due_days > 0 ? 'danger' : 'success' }}">
                                                    {{ $payment->due_days }} days
                                                </span>
                                            </td>
                                            <td>৳{{ number_format($payment->due_amount, 2) }}</td>
                                            <td>৳{{ number_format($payment->total_paid, 2) }}</td>
                                            <td>
                                                <span
                                                    class="badge bg-{{ $payment->status == 'active' ? 'success' : ($payment->status == 'blocked' ? 'danger' : 'warning') }}">
                                                    {{ ucfirst($payment->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($payment->approval_status == 'approved')
                                                    <span class="badge bg-success">Approved</span>
                                                @elseif($payment->approval_status == 'pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                @else
                                                    <span
                                                        class="badge bg-secondary">{{ ucfirst($payment->approval_status) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    @if ($payment->payment_slip)
                                                        <a href="{{ asset('storage/' . $payment->payment_slip) }}"
                                                            target="_blank" class="btn btn-info btn-sm"
                                                            title="View Payment Slip">
                                                            <i class="fas fa-receipt"></i>
                                                        </a>
                                                    @endif


                                                    @if ($payment->due_amount > 0 && $payment->status != 'blocked')
                                                        <a href="{{ route('user.bike.register.payment.now', ['payment_id' => $payment->id]) }}"
                                                            class="btn btn-success btn-sm" title="Pay Due Amount">
                                                            <i class="fas fa-dollar-sign"></i>
                                                        </a>
                                                    @endif

                                                    <!-- Modal trigger button -->
                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#paymentModal{{ $payment->id }}"
                                                        title="View Details">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="13" class="text-center">No payments found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Details Modal for each payment -->
    <div class="modal fade" id="paymentModal{{ $payment->id }}" tabindex="-1"
        aria-labelledby="paymentModalLabel{{ $payment->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel{{ $payment->id }}">
                        Payment Details - {{ $payment->bike->registration_no ?? 'N/A' }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">Payment Information</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm">
                                        <tr>
                                            <th width="40%">Plan:</th>
                                            <td>
                                                <span
                                                    class="badge bg-{{ $payment->plan == 'daily' ? 'info' : 'warning' }}">
                                                    {{ ucfirst($payment->plan) }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Fixed Amount:</th>
                                            <td>৳{{ number_format($payment->fixed_amount, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Payment Method:</th>
                                            <td>{{ ucfirst($payment->payment_method) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total Paid:</th>
                                            <td class="text-success">{{ number_format($payment->total_paid, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status:</th>
                                            <td>
                                                <span
                                                    class="badge bg-{{ $payment->status == 'active' ? 'success' : ($payment->status == 'blocked' ? 'danger' : 'warning') }}">
                                                    {{ ucfirst($payment->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">Due Information</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm">
                                        <tr>
                                            <th width="40%">Due Days:</th>
                                            <td>
                                                <span class="badge bg-{{ $payment->due_days > 0 ? 'danger' : 'success' }}">
                                                    {{ $payment->due_days }} days
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Due Amount:</th>
                                            <td class="text-danger">৳{{ number_format($payment->due_amount, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Last Paid Date:</th>
                                            <td>
                                                @if ($payment->last_paid_date)
                                                    {{ $payment->last_paid_date->format('d M, Y') }}
                                                @else
                                                    Never
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Next Due Date:</th>
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
                                        </tr>
                                        <tr>
                                            <th>Approval Status:</th>
                                            <td>
                                                @if ($payment->approval_status == 'approved')
                                                    <span class="badge bg-success">Approved</span>
                                                @elseif($payment->approval_status == 'pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                @else
                                                    <span
                                                        class="badge bg-secondary">{{ ucfirst($payment->approval_status) }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($payment->bike)
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">Bike Information</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm">
                                    <tr>
                                        <th width="30%">Registration No:</th>
                                        <td>{{ $payment->bike->registration_number ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Owner Name:</th>
                                        <td>{{ $payment->bike->owner_name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone:</th>
                                        <td>{{ $payment->bike->phone ?? 'N/A' }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    @endif

                    @if ($payment->payment_slip)
                        <div class="card">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">Payment Slip</h6>
                            </div>
                            <div class="card-body text-center">
                                <img src="{{ asset('storage/' . $payment->payment_slip) }}" alt="Payment Slip"
                                    class="img-fluid rounded" style="max-height: 300px;">
                                <div class="mt-2">
                                    <a href="{{ asset('storage/' . $payment->payment_slip) }}" target="_blank"
                                        class="btn btn-sm btn-primary">
                                        <i class="fas fa-download"></i> Download
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    @if ($payment->due_amount > 0 && $payment->status != 'blocked')
                        <a href="{{ route('user.bike.register.payment.now', ['payment_id' => $payment->id]) }}"
                            class="btn btn-success">
                            <i class="fas fa-dollar-sign"></i> Pay Now
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
