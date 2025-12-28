@extends('layouts.admin.app', [$pageTitle => 'Page Title'])

@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="d-flex align-items-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle ?? 'Bike Registration List' }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="main-content-body">
        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                        <p class="card-title my-0">{{ $pageTitle ?? 'Bike Registration List' }}
                            <span class="badge bg-danger side-badge"
                                style="font-size:17px;">{{ count($registrations) }}</span>
                        </p>
                        <div class="d-flex">
                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-primary dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Filter by Status
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('admin.bike.register.index') }}">All</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                            href="{{ route('admin.bike.register.index', ['status' => 'pending']) }}">Pending</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                            href="{{ route('admin.bike.register.index', ['status' => 'approved']) }}">Approved</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                            href="{{ route('admin.bike.register.index', ['status' => 'rejected']) }}">Rejected</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>User</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Bike Name</th>
                                        <th>Reg. No</th>
                                        <th>Payment Method</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($registrations as $key => $registration)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                @if ($registration->user)
                                                    <div class="d-flex align-items-center">
                                                        @if ($registration->user->photo)
                                                            <img src="{{ asset('storage/' . $registration->user->photo) }}"
                                                                alt="User" class="rounded-circle" width="40"
                                                                height="40">
                                                        @else
                                                            <img src="{{ asset('assets/images/default-user.png') }}"
                                                                alt="Default" class="rounded-circle" width="40"
                                                                height="40">
                                                        @endif
                                                        <div class="ms-2">
                                                            <h6 class="mb-0">{{ $registration->user->name }}</h6>
                                                            <small>{{ $registration->user->email }}</small>
                                                        </div>
                                                    </div>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>{{ $registration->name }}</td>
                                            <td>{{ $registration->mobile }}</td>
                                            <td>{{ $registration->bike_name }}</td>
                                            <td>
                                                <span class="badge bg-info">{{ $registration->registration_no }}</span>
                                            </td>
                                            <td>{{ ucfirst($registration->payment_method) }}</td>
                                            <td>৳ {{ number_format($registration->registration_fee ?? 0, 2) }}</td>
                                            <td>
                                                <a href="{{ route('admin.bike.register.status', $registration->id) }}"
                                                    class="badge rounded-pill 
{{ $registration->status == 'approved' ? 'bg-success' : ($registration->status == 'rejected' ? 'bg-danger' : 'bg-warning') }}"
                                                    style="font-size:15px;cursor:pointer">
                                                    {{ strtoupper($registration->status) }}
                                                </a>
                                            </td>

                                            <td>{{ $registration->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('admin.bike.register.show', $registration->id) }}"
                                                        class="btn btn-info btn-sm" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.bike.register.edit', $registration->id) }}"
                                                        class="btn btn-primary btn-sm" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('admin.bike.register.delete', $registration->id) }}"
                                                        class="btn btn-danger btn-sm" title="Delete Data" id="delete"><i
                                                            class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="11" class="text-center">No bike registrations found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->
    </div>

@endsection

@push('admin')
@endpush
