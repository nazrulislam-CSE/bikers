@extends('layouts.admin.app', [$pageTitle => 'Page Title'])

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.bike.register.index') }}">Bike Registrations</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle ?? 'Edit Registration' }}</li>
            </ol>
        </nav>
    </div>
</div>

<div class="main-content-body">
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <p class="card-title my-0">{{ $pageTitle ?? 'Edit Bike Registration' }}</p>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.bike.register.update', $bike->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- User Information -->
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h5 class="mb-3 border-bottom pb-2">User Information</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" 
                                           value="{{ old('name', $bike->name) }}" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="{{ old('email', $bike->email) }}">
                                </div>
                            </div>
                            
                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="mobile">Mobile Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="mobile" name="mobile" 
                                           value="{{ old('mobile', $bike->mobile) }}" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="password">Password (Leave blank to keep current)</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                            </div>
                            
                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="photo">Update User Photo</label>
                                    <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                                    @if($bike->photo)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/'.$bike->photo) }}" 
                                                 alt="Current Photo" width="100" class="img-thumbnail">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Bike Information -->
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h5 class="mb-3 border-bottom pb-2">Bike Information</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bike_name">Bike Name/Model <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="bike_name" name="bike_name" 
                                           value="{{ old('bike_name', $bike->bike_name) }}" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="registration_no">Registration Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="registration_no" name="registration_no" 
                                           value="{{ old('registration_no', $bike->registration_no) }}" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="bike_photo">Update Bike Photo</label>
                                    <input type="file" class="form-control" id="bike_photo" name="bike_photo" accept="image/*">
                                    @if($bike->bike_photo)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/'.$bike->bike_photo) }}" 
                                                 alt="Current Bike Photo" width="100" class="img-thumbnail">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Payment Information -->
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h5 class="mb-3 border-bottom pb-2">Payment Information</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="registration_fee">Registration Fee (৳)</label>
                                    <input type="number" class="form-control" id="registration_fee" name="registration_fee" 
                                           value="{{ old('registration_fee', $bike->registration_fee) }}" step="0.01">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="payment_method">Payment Method <span class="text-danger">*</span></label>
                                    <select class="form-control" id="payment_method" name="payment_method" required>
                                        <option value="cash" {{ old('payment_method', $bike->payment_method) == 'cash' ? 'selected' : '' }}>Cash</option>
                                        <option value="bkash" {{ old('payment_method', $bike->payment_method) == 'bkash' ? 'selected' : '' }}>bKash</option>
                                        <option value="nagad" {{ old('payment_method', $bike->payment_method) == 'nagad' ? 'selected' : '' }}>Nagad</option>
                                        <option value="rocket" {{ old('payment_method', $bike->payment_method) == 'rocket' ? 'selected' : '' }}>Rocket</option>
                                        <option value="bank" {{ old('payment_method', $bike->payment_method) == 'bank' ? 'selected' : '' }}>Bank Transfer</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="payment_slip">Update Payment Slip</label>
                                    <input type="file" class="form-control" id="payment_slip" name="payment_slip" accept="image/*,.pdf">
                                    @if($bike->payment_slip)
                                        <div class="mt-2">
                                            <a href="{{ asset('storage/'.$bike->payment_slip) }}" 
                                               target="_blank" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> View Current Slip
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="status">Registration Status <span class="text-danger">*</span></label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="pending" {{ old('status', $bike->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="approved" {{ old('status', $bike->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="rejected" {{ old('status', $bike->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Update Registration
                                </button>
                                <a href="{{ route('admin.bike.register.show', $bike->id) }}" class="btn btn-info">
                                    <i class="fas fa-eye"></i> View Details
                                </a>
                                <a href="{{ route('admin.bike.register.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Back to List
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