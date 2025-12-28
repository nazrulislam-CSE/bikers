@extends('layouts.admin.app', [$pageTitle => 'Page Title'])

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.bike.register.index') }}">Bike Registrations</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle ?? 'Bike Details' }}</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex my-auto">
        <a href="{{ route('admin.bike.register.edit', $bike->id) }}" class="btn btn-primary me-2">
            <i class="fas fa-edit"></i> Edit
        </a>
        <a href="{{ route('admin.bike.register.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
</div>

<div class="main-content-body">
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <p class="card-title my-0">{{ $pageTitle ?? 'Bike Registration Details' }}</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- User Information -->
                        <div class="col-md-6 mb-4">
                            <h5 class="mb-3 border-bottom pb-2">User Information</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th width="40%">Name:</th>
                                    <td>{{ $bike->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $bike->email ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Mobile:</th>
                                    <td>{{ $bike->mobile }}</td>
                                </tr>
                                <tr>
                                    <th>User Photo:</th>
                                    <td>
                                        @if($bike->photo)
                                            <img src="{{ asset('storage/'.$bike->photo) }}" 
                                                 alt="User Photo" class="img-thumbnail" width="150">
                                        @else
                                            <span class="text-muted">No photo uploaded</span>
                                        @endif
                                    </td>
                                </tr>
                                @if($bike->user)
                                <tr>
                                    <th>User Account:</th>
                                    <td>
                                        <span class="badge bg-info">{{ $bike->user->name }}</span>
                                        <small class="d-block">{{ $bike->user->email }}</small>
                                    </td>
                                </tr>
                                @endif
                            </table>
                        </div>

                        <!-- Bike Information -->
                        <div class="col-md-6 mb-4">
                            <h5 class="mb-3 border-bottom pb-2">Bike Information</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th width="40%">Bike Name/Model:</th>
                                    <td>{{ $bike->bike_name }}</td>
                                </tr>
                                <tr>
                                    <th>Registration No:</th>
                                    <td>
                                        <span class="badge bg-primary">{{ $bike->registration_no }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Registration Date:</th>
                                    <td>{{ $bike->created_at->format('d M, Y h:i A') }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        <span class="badge 
                                            @if($bike->status == 'approved') bg-success
                                            @elseif($bike->status == 'pending') bg-warning
                                            @elseif($bike->status == 'rejected') bg-danger
                                            @endif">
                                            {{ ucfirst($bike->status) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Bike Photo:</th>
                                    <td>
                                        @if($bike->bike_photo)
                                            <img src="{{ asset('storage/'.$bike->bike_photo) }}" 
                                                 alt="Bike Photo" class="img-thumbnail" width="150">
                                        @else
                                            <span class="text-muted">No bike photo uploaded</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <!-- Payment Information -->
                        <div class="col-md-12 mb-4">
                            <h5 class="mb-3 border-bottom pb-2">Payment Information</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th width="25%">Registration Fee:</th>
                                    <td>৳ {{ number_format($bike->registration_fee ?? 0, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Payment Method:</th>
                                    <td>{{ ucfirst($bike->payment_method) }}</td>
                                </tr>
                                <tr>
                                    <th>Payment Status:</th>
                                    <td>
                                        @if($bike->registration_fee)
                                            <span class="badge bg-success">Paid</span>
                                        @else
                                            <span class="badge bg-warning">Unpaid</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Payment Slip:</th>
                                    <td>
                                        @if($bike->payment_slip)
                                            <a href="{{ asset('storage/'.$bike->payment_slip) }}" 
                                               target="_blank" class="btn btn-sm btn-info">
                                                <i class="fas fa-download"></i> Download Slip
                                            </a>
                                        @else
                                            <span class="text-muted">No payment slip uploaded</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <!-- Registration Timeline -->
                        <div class="col-md-12">
                            <h5 class="mb-3 border-bottom pb-2">Registration Timeline</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th width="25%">Created At:</th>
                                    <td>{{ $bike->created_at->format('d M, Y h:i A') }}</td>
                                </tr>
                                <tr>
                                    <th>Last Updated:</th>
                                    <td>{{ $bike->updated_at->format('d M, Y h:i A') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection