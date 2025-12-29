@extends('layouts.user.app', ['title' => 'Make Payment'])

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
            
        </nav>
    </div>
</div>

<div class="main-content-body">
    <div class="row row-sm">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Payment Form</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.bike.register.payment.store') }}" method="POST" enctype="multipart/form-data" id="paymentForm">
                        @csrf
                        
                        @if(isset($payment_id))
                            <input type="hidden" name="payment_id" value="{{ $payment_id }}">
                        @endif

                        <div class="row">
                            <!-- Select Bike -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bike_registration_id">Select Bike <span class="text-danger">*</span></label>
                                    <select name="bike_registration_id" id="bike_registration_id" class="form-control select2 @error('bike_registration_id') is-invalid @enderror" required>
                                        <option value="">-- Select Bike --</option>
                                        @foreach($bikes as $bike)
                                            <option value="{{ $bike->id }}" 
                                                {{ old('bike_registration_id', $selected_bike_id ?? '') == $bike->id ? 'selected' : '' }}
                                                data-plan="{{ $bike->payment_plan ?? 'daily' }}"
                                                data-amount="{{ $bike->fixed_amount ?? '0' }}">
                                                {{ $bike->registration_no }} - {{ $bike->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('bike_registration_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Plan -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="plan">Payment Plan <span class="text-danger">*</span></label>
                                    <select name="plan" id="plan" class="form-control @error('plan') is-invalid @enderror" required>
                                        <option value="daily" {{ old('plan') == 'daily' ? 'selected' : '' }}>Daily</option>
                                        <option value="weekly" {{ old('plan') == 'weekly' ? 'selected' : '' }}>Weekly</option>
                                    </select>
                                    @error('plan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Fixed Amount -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fixed_amount">Fixed Amount <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">৳</span>
                                        <input type="number" name="fixed_amount" id="fixed_amount" 
                                               class="form-control @error('fixed_amount') is-invalid @enderror" 
                                               value="{{ old('fixed_amount') }}" 
                                               step="0.01" min="0" required placeholder="Enter Amount">
                                    </div>
                                    @error('fixed_amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Payment Method -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="payment_method">Payment Method <span class="text-danger">*</span></label>
                                    <select name="payment_method" id="payment_method" class="form-control @error('payment_method') is-invalid @enderror" required>
                                        <option value="">-- Select Method --</option>
                                        <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                                        <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                        <option value="mobile_banking" {{ old('payment_method') == 'mobile_banking' ? 'selected' : '' }}>Mobile Banking</option>
                                        <option value="card" {{ old('payment_method') == 'card' ? 'selected' : '' }}>Card</option>
                                    </select>
                                    @error('payment_method')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Payment Slip -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="payment_slip">Payment Slip (Optional)</label>
                                    <input type="file" name="payment_slip" id="payment_slip" 
                                           class="form-control @error('payment_slip') is-invalid @enderror" 
                                           accept=".jpg,.jpeg,.png,.pdf">
                                    <small class="text-muted">Upload receipt/slip (Image or PDF, max 2MB)</small>
                                    @error('payment_slip')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Preview Slip Image -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Slip Preview</label>
                                    <div id="paymentSlipPreview" class="border p-2 text-center" style="min-height: 100px;">
                                        <p class="text-muted">No slip uploaded</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Due Information (if paying for existing due) -->
                            @if(isset($due_payment) && $due_payment)
                            <div class="col-12">
                                <div class="alert alert-warning">
                                    <h5 class="alert-heading">Due Payment</h5>
                                    <p>You are paying for overdue amount. Please review details below:</p>
                                    <ul class="mb-0">
                                        <li>Due Days: <strong>{{ $due_payment->due_days }} days</strong></li>
                                        <li>Due Amount: <strong>${{ number_format($due_payment->due_amount, 2) }}</strong></li>
                                        <li>Last Paid: <strong>{{ $due_payment->last_paid_date ? $due_payment->last_paid_date->format('d M, Y') : 'Never' }}</strong></li>
                                    </ul>
                                </div>
                            </div>
                            @endif

                            <!-- Additional Notes -->
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="notes">Additional Notes (Optional)</label>
                                    <textarea name="notes" id="notes" class="form-control" rows="3">{{ old('notes') }}</textarea>
                                </div>
                            </div>

                            <!-- Terms & Conditions -->
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" name="terms" id="terms" required>
                                    <label class="form-check-label" for="terms">
                                        I agree to the terms and conditions
                                    </label>
                                    @error('terms')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="col-12 mt-4">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-paper-plane"></i> Submit Payment
                                    </button>
                                    <a href="{{ route('user.bike.register.payment') }}" class="btn btn-light">
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar Information -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Payment Instructions</h3>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <div class="list-group-item border-0">
                            <i class="fas fa-info-circle text-primary me-2"></i>
                            Select your bike from the dropdown
                        </div>
                        <div class="list-group-item border-0">
                            <i class="fas fa-info-circle text-primary me-2"></i>
                            Choose your preferred payment plan
                        </div>
                        <div class="list-group-item border-0">
                            <i class="fas fa-info-circle text-primary me-2"></i>
                            Enter the fixed payment amount
                        </div>
                        <div class="list-group-item border-0">
                            <i class="fas fa-info-circle text-primary me-2"></i>
                            Select payment method
                        </div>
                        <div class="list-group-item border-0">
                            <i class="fas fa-info-circle text-primary me-2"></i>
                            Upload payment slip (optional but recommended)
                        </div>
                    </div>

                    <hr>

                    <h5>Payment Methods:</h5>
                    <div class="row g-2">
                        <div class="col-6">
                            <div class="border rounded p-2 text-center">
                                <i class="fas fa-money-bill-wave fa-2x text-success"></i>
                                <p class="mb-0">Cash</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="border rounded p-2 text-center">
                                <i class="fas fa-university fa-2x text-primary"></i>
                                <p class="mb-0">Bank Transfer</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="border rounded p-2 text-center">
                                <i class="fas fa-mobile-alt fa-2x text-info"></i>
                                <p class="mb-0">Mobile Banking</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="border rounded p-2 text-center">
                                <i class="fas fa-credit-card fa-2x text-warning"></i>
                                <p class="mb-0">Card</p>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="alert alert-info">
                        <h6><i class="fas fa-exclamation-circle"></i> Important Notes:</h6>
                        <ul class="mb-0">
                            <li>Payments are subject to admin approval</li>
                            <li>Keep your payment slip for reference</li>
                            <li>Due payments may incur late fees</li>
                            <li>Contact support for any issues</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js_script')
<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.select2').select2({
            placeholder: '-- Select Bike --',
            allowClear: true
        });

        // Preview payment slip
        $('#payment_slip').on('change', function() {
            const file = this.files[0];
            const preview = $('#paymentSlipPreview');
            
            if (file) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    if (file.type.startsWith('image/')) {
                        preview.html(`<img src="${e.target.result}" class="img-fluid" style="max-height: 200px;">`);
                    } else if (file.type === 'application/pdf') {
                        preview.html(`
                            <div class="text-center">
                                <i class="fas fa-file-pdf fa-3x text-danger"></i>
                                <p class="mt-2 mb-0">${file.name}</p>
                            </div>
                        `);
                    } else {
                        preview.html(`<p class="text-muted">Preview not available for this file type</p>`);
                    }
                }
                
                reader.readAsDataURL(file);
            } else {
                preview.html('<p class="text-muted">No slip uploaded</p>');
            }
        });

        // Auto-fill plan and amount when bike is selected
        $('#bike_registration_id').on('change', function() {
            const selectedOption = $(this).find('option:selected');
            const plan = selectedOption.data('plan');
            const amount = selectedOption.data('amount');
            
            if (plan) {
                $('#plan').val(plan);
            }
            
            if (amount) {
                $('#fixed_amount').val(amount);
            }
        });

        // Form validation
        $('#paymentForm').validate({
            rules: {
                bike_registration_id: {
                    required: true
                },
                plan: {
                    required: true
                },
                fixed_amount: {
                    required: true,
                    number: true,
                    min: 0.01
                },
                payment_method: {
                    required: true
                },
                terms: {
                    required: true
                }
            },
            messages: {
                bike_registration_id: {
                    required: "Please select a bike"
                },
                plan: {
                    required: "Please select a payment plan"
                },
                fixed_amount: {
                    required: "Please enter the payment amount",
                    number: "Please enter a valid amount",
                    min: "Amount must be greater than 0"
                },
                payment_method: {
                    required: "Please select a payment method"
                },
                terms: {
                    required: "You must agree to the terms and conditions"
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>

@push('styles')
<style>
    .select2-container--default .select2-selection--single {
        height: 38px;
        border: 1px solid #d1d5db;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 36px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px;
    }
    #paymentSlipPreview {
        background-color: #f8f9fa;
        border-radius: 4px;
    }
</style>
@endpush