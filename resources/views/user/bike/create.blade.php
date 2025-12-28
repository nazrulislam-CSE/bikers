@extends('layouts.user.app', [$pageTitle => 'Page Title'])

@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="d-flex align-items-center">
            <nav aria-label="breadcrumb">

            </nav>
        </div>
    </div>

    <div class="main-content-body">
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <p class="card-title my-0">{{ $pageTitle ?? 'Register New Bike' }}</p>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.bike.register.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- User Information (Auto-filled from auth) -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Full Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ Auth::user()->name }}" readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ Auth::user()->email }}" readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Mobile Number <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="mobile" name="mobile"
                                            value="{{ Auth::user()->phone ?? '' }}" required>
                                        @error('mobile')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="bike_name">Bike Name/Model <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="bike_name" name="bike_name"
                                            value="{{ old('bike_name') }}" placeholder="Enter Bike Name" required>
                                        @error('bike_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="registration_no">Registration Number <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="registration_no"
                                            name="registration_no" value="{{ old('registration_no') }}"
                                            placeholder="Enter Registration Number" required>
                                        @error('registration_no')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="registration_fee">Registration Fee (৳)</label>
                                        <input type="number" class="form-control" id="registration_fee"
                                            name="registration_fee" value="{{ old('registration_fee', '500') }}"
                                            placeholder="Enter Registration Fee" step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="payment_method">Payment Method <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="payment_method" name="payment_method" required>
                                            <option value="">Select Payment Method</option>
                                            <option value="cash">Cash</option>
                                            <option value="bkash">bKash</option>
                                            <option value="nagad">Nagad</option>
                                            <option value="rocket">Rocket</option>
                                            <option value="bank">Bank Transfer</option>
                                        </select>
                                        @error('payment_method')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="payment_slip">Payment Slip/Receipt</label>
                                        <input type="file" class="form-control" id="payment_slip" name="payment_slip"
                                            accept="image/*">
                                        <small class="text-muted">Upload payment receipt if paid online (Optional)</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="bike_photo">Bike Photo</label>
                                        <input type="file" class="form-control" id="bike_photo" name="bike_photo"
                                            accept="image/*">
                                        <small class="text-muted">Upload clear photo of your bike (Optional)</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="photo">Your Photo</label>
                                        <input type="file" class="form-control" id="photo" name="photo"
                                            accept="image/*">
                                        <small class="text-muted">Upload your recent passport size photo (Optional)</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-2">
                                        <i class="fas fa-save"></i> Register Bike
                                    </button>

                                    <a href="{{ route('user.bike.register.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Cancel
                                    </a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
