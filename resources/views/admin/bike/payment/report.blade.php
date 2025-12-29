@extends('layouts.admin.app', ['title' => 'Payment Report'])

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style2">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#">Bike Payments</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Payment Report</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex my-auto">
        <div class="d-flex">
            <button onclick="window.print()" class="btn btn-primary me-2">
                <i class="fas fa-print"></i> Print Report
            </button>
            <a href="{{ route('admin.bike.register.payment.report') }}" class="btn btn-light">
                Back to Form
            </a>
        </div>
    </div>
</div>

<div class="main-content-body">
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="card-title mb-0">Payment Report</h3>
                            <p class="mb-0 text-muted">
                                Period: {{ \Carbon\Carbon::parse($start_date)->format('d M, Y') }} - {{ \Carbon\Carbon::parse($end_date)->format('d M, Y') }}
                                | Type: {{ ucfirst($report_type) }} Payments
                            </p>
                        </div>
                        <div>
                            <p class="mb-0">Generated: {{ now()->format('d M, Y h:i A') }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Statistics -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body text-center">
                                    <h4 class="mb-0">{{ $payments->count() }}</h4>
                                    <p class="mb-0">Total Payments</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body text-center">
                                    @php
                                        $totalAmount = $payments->sum('total_paid');
                                    @endphp
                                    <h4 class="mb-0">৳{{ number_format($totalAmount, 2) }}</h4>
                                    <p class="mb-0">Total Revenue</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body text-center">
                                    @php
                                        $approvedCount = $payments->where('approval_status', 'approved')->count();
                                    @endphp
                                    <h4 class="mb-0">{{ $approvedCount }}</h4>
                                    <p class="mb-0">Approved</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body text-center">
                                    @php
                                        $pendingCount = $payments->where('approval_status', 'pending')->count();
                                    @endphp
                                    <h4 class="mb-0">{{ $pendingCount }}</h4>
                                    <p class="mb-0">Pending</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Report Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>SL</th>
                                    <th>Date</th>
                                    <th>User</th>
                                    <th>Bike</th>
                                    <th>Plan</th>
                                    <th>Amount</th>
                                    <th>Payment Method</th>
                                    <th>Status</th>
                                    <th>Approval</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payments as $key => $payment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $payment->created_at->format('d M, Y') }}</td>
                                    <td>{{ $payment->user->name }}</td>
                                    <td>{{ $payment->bike->registration_number ?? 'N/A' }}</td>
                                    <td>{{ ucfirst($payment->plan) }}</td>
                                    <td>৳{{ number_format($payment->fixed_amount, 2) }}</td>
                                    <td>{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $payment->status == 'active' ? 'success' : 'danger' }}">
                                            {{ ucfirst($payment->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($payment->approval_status == 'approved')
                                            <span class="badge bg-success">Approved</span>
                                        @elseif($payment->approval_status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($payment->approval_status == 'rejected')
                                            <span class="badge bg-danger">Rejected</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            @if($payments->isNotEmpty())
                            <tfoot>
                                <tr class="table-dark">
                                    <th colspan="5" class="text-end">Total:</th>
                                    <th>৳{{ number_format($payments->sum('fixed_amount'), 2) }}</th>
                                    <th colspan="3"></th>
                                </tr>
                            </tfoot>
                            @endif
                        </table>
                    </div>
                    
                    @if($payments->isEmpty())
                    <div class="text-center py-5">
                        <i class="fas fa-chart-bar fa-4x text-muted mb-3"></i>
                        <h4>No payments found for the selected criteria</h4>
                        <p class="text-muted">Try adjusting your search filters</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    @media print {
        .breadcrumb-header, .main-content-body .card-header .btn,
        .main-content-body .card-header .d-flex:last-child {
            display: none !important;
        }
        
        .card {
            border: none !important;
        }
        
        .card-body {
            padding: 0 !important;
        }
        
        .table th, .table td {
            border: 1px solid #dee2e6 !important;
        }
    }
</style>
@endpush