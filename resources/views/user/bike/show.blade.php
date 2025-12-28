@extends('layouts.user.app', [$pageTitle => 'Page Title'])

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
          
        </nav>
    </div>
    <div class="d-flex my-auto">
        <a href="{{ route('user.bike.register.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
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
                                    <td>{{ $registration->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $registration->email ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Mobile:</th>
                                    <td>{{ $registration->mobile }}</td>
                                </tr>
                                <tr>
                                    <th>User Photo:</th>
                                    <td>
                                        @if($registration->photo)
                                            <img src="{{ asset('storage/'.$registration->photo) }}" 
                                                 alt="User Photo" class="img-thumbnail" width="150">
                                        @else
                                            <span class="text-muted">No photo uploaded</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <!-- Bike Information -->
                        <div class="col-md-6 mb-4">
                            <h5 class="mb-3 border-bottom pb-2">Bike Information</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th width="40%">Bike Name/Model:</th>
                                    <td>{{ $registration->bike_name }}</td>
                                </tr>
                                <tr>
                                    <th>Registration No:</th>
                                    <td>{{ $registration->registration_no }}</td>
                                </tr>
                                <tr>
                                    <th>Registration Date:</th>
                                    <td>{{ $registration->created_at->format('d M, Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Bike Photo:</th>
                                    <td>
                                        @if($registration->bike_photo)
                                            <img src="{{ asset('storage/'.$registration->bike_photo) }}" 
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
                                    <td>৳ {{ number_format($registration->registration_fee ?? 0, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Payment Method:</th>
                                    <td>{{ ucfirst($registration->payment_method) }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        @if($registration->status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($registration->status == 'approved')
                                            <span class="badge bg-success">Approved</span>
                                        @elseif($registration->status == 'rejected')
                                            <span class="badge bg-danger">Rejected</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $registration->status }}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Payment Slip:</th>
                                    <td>
                                        @if($registration->payment_slip)
                                            <a href="{{ asset('storage/'.$registration->payment_slip) }}" 
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
                                    <td>{{ $registration->created_at->format('d M, Y h:i A') }}</td>
                                </tr>
                                <tr>
                                    <th>Last Updated:</th>
                                    <td>{{ $registration->updated_at->format('d M, Y h:i A') }}</td>
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