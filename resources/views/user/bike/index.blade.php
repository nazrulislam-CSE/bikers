@extends('layouts.user.app', [$pageTitle => 'Page Title'])

@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="d-flex align-items-center">
            <nav aria-label="breadcrumb">

            </nav>
        </div>
        <div class="d-flex my-auto">
            <div class="d-flex">
                <a href="{{ route('user.bike.register.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Register New Bike
                </a>
            </div>
        </div>
    </div>

    <div class="main-content-body">
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="row row-sm mb-3">

                    {{-- Total Bikes --}}
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="card shadow-lg border-0 text-center">
                            <div class="card-body">
                                <div class="mb-2">
                                    <i class="fas fa-motorcycle fa-2x text-primary"></i>
                                </div>
                                <h6 class="text-muted">Total Bikes</h6>
                                <h3 class="text-primary fw-bold">{{ $total }}</h3>
                            </div>
                        </div>
                    </div>

                    {{-- Approved --}}
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="card shadow-lg border-0 text-center">
                            <div class="card-body">
                                <div class="mb-2">
                                    <i class="fas fa-check-circle fa-2x text-success"></i>
                                </div>
                                <h6 class="text-muted">Approved</h6>
                                <h3 class="text-success fw-bold">{{ $approved }}</h3>
                            </div>
                        </div>
                    </div>

                    {{-- Pending --}}
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="card shadow-lg border-0 text-center">
                            <div class="card-body">
                                <div class="mb-2">
                                    <i class="fas fa-clock fa-2x text-warning"></i>
                                </div>
                                <h6 class="text-muted">Pending</h6>
                                <h3 class="text-warning fw-bold">{{ $pending }}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                        <p class="card-title my-0">{{ $pageTitle ?? 'Page Title' }}
                            <span class="badge bg-danger side-badge"
                                style="font-size:17px;">{{ count($registrations) }}</span>
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="file-datatable"
                                class="border-top-0  table table-bordered text-nowrap key-buttons border-bottom">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">SL</th>
                                        <th class="border-bottom-0">Photo</th>
                                        <th class="border-bottom-0">Name</th>
                                        <th class="border-bottom-0">Phone</th>
                                        <th class="border-bottom-0">Bike Name</th>
                                        <th class="border-bottom-0">Registration No</th>
                                        <th class="border-bottom-0">Status</th>
                                        <th class="border-bottom-0">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($registrations as $key => $registration)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                @if ($registration->photo)
                                                    <img src="{{ asset('storage/' . $registration->photo) }}" alt="User Photo"
                                                        class="rounded-circle" width="50" height="50">
                                                @else
                                                    <img src="{{ asset('upload/avatar5.png') }}" alt="Default"
                                                        class="rounded-circle" width="50" height="50">
                                                @endif
                                            </td>
                                            <td>{{ $registration->name }}</td>
                                            <td>{{ $registration->mobile }}</td>
                                            <td>{{ $registration->bike_name }}</td>
                                            <td>{{ $registration->registration_no }}</td>
                                            <td>
                                                @if ($registration->status == 'pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                @elseif($registration->status == 'approved')
                                                    <span class="badge bg-success">Approved</span>
                                                @elseif($registration->status == 'rejected')
                                                    <span class="badge bg-danger">Rejected</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $registration->status }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('user.bike.register.show', $registration->id) }}"
                                                    class="btn btn-info btn-sm mr-2" title="View Details">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No bike registrations found.</td>
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
@endsection
