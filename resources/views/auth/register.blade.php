@extends('layouts.user.auth')
@section('content')
    <div class="col-md-10 px-0 shadow d-flex border-radius-20 border border-white overflow-hidden bg-white">
        <div class="wd-md-50p login d-none d-md-flex page-signin-style p-0 text-white border-radius-20 overflow-hidden">
            <div class="my-auto authentication-pages">
                <img src="{{ asset(get_setting('site_company_logo')->value ?? 'dashboard/img/template.png') }}"
                    class="w-100 h-100" alt="logo">
            </div>
        </div>
        <div class="p-lg-5 p-3 wd-md-70p row justify-content-center align-items-center box-color">
            <div>
                <div class="main-signin-header">
                    <a href="{{ route('frontend.home') }}">
                        <div class="d-flex justify-content-center align-items-center flex-column">
                            <img width="200"
                                src="{{ asset(get_setting('site_logo')->value ?? '/frontend/images/svg/logo.svg') }}"
                                class="mb-4" alt="logo">
                            <h3 class="text-center animate-charcter">Welcome To
                                {{ get_setting('site_name')->value ?? 'null' }}</h3>
                        </div>
                    </a>

                    <h4 class="text-center">{{ __('Please sign up to continue') }}</h4>
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            {{-- Name --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bolder">Full Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" required placeholder="Enter your name">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Username --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bolder">Username</label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                        name="username" value="{{ old('username') }}" required
                                        placeholder="Choose username">
                                    @error('username')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bolder">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required placeholder="Enter email">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Phone --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bolder">Phone</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                        name="phone" value="{{ old('phone') }}" required
                                        placeholder="Enter phone number">
                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Password --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" required placeholder="Choose strong password">
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Confirm Password --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation" required
                                        placeholder="Re-type password">
                                </div>
                            </div>

                        </div>

                        <button class="btn btn-primary btn-block">{{ __('Sign In') }}</button>
                    </form>
                </div>
                <div class="main-signin-footer mt-3 mg-t-5">
                    <p class="font-weight-bolder">{{ __('Already have an account?') }} <a
                            class="font-weight-bolder"
                            href="{{ route('login') }}">{{ __('Signin to account!') }}</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#userType').change(function() {
                var userType = $(this).val();

                // Hide all fields initially
                $('.agentFields, .userFields').hide();

                // Show fields based on the selected type
                if (userType === '2') {
                    $('.agentFields').show();
                } else if (userType === '1') {
                    $('.userFields').show();
                }
            });
        });
    </script>
@endsection
