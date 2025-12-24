@extends('layouts.admin.app', [$pageTitle => 'Notice Details'])

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle ?? 'Dashboard' }}</li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
            </ol>
        </nav>
    </div>
</div>

<div class="main-content-body">
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                    <p class="card-title my-0">{{ $notice->title }}</p>
                    <div class="d-flex">
                        <a href="{{ route('admin.notice.index') }}" class="btn btn-danger me-2">
                            <i class="fas fa-list d-inline"></i> Back to List
                        </a>
                        <a href="{{ route('admin.notice.edit', $notice->id) }}" class="btn btn-primary me-2">
                            <i class="fas fa-edit d-inline"></i> Edit
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        
                        {{-- Title --}}
                        <div class="col-md-12 mb-3">
                            <h4 class="text-dark">
                                <i class="fas fa-heading text-success"></i> {{ $notice->title }}
                            </h4>
                            <hr>
                        </div>

                        {{-- Date --}}
                        <div class="col-md-6 mb-3">
                            <strong><i class="fas fa-calendar-alt"></i> Date:</strong><br>
                            <span class="badge bg-info text-white mt-1">
                                {{ \Carbon\Carbon::parse($notice->date)->format('d M, Y') }}
                            </span>
                        </div>

                        {{-- Status --}}
                        <div class="col-md-6 mb-3">
                            <strong><i class="fas fa-toggle-on"></i> Status:</strong><br>
                            @if($notice->status == 1)
                                <span class="badge bg-success mt-1">Active</span>
                            @else
                                <span class="badge bg-danger mt-1">Inactive</span>
                            @endif
                        </div>

                        {{-- PDF File --}}
                        <div class="col-md-12 mb-3">
                            <strong><i class="fas fa-file-pdf"></i> Attached PDF:</strong><br>
                            @if($notice->file_url)
                                <a href="{{ asset('storage/'.$notice->file_url) }}" target="_blank" class="btn btn-outline-primary mt-2">
                                    <i class="fas fa-eye"></i> View PDF
                                </a>
                            @else
                                <p class="text-muted mt-2">No file uploaded.</p>
                            @endif
                        </div>

                        {{-- Description --}}
                        <div class="col-md-12 mt-3">
                            <strong><i class="fas fa-align-left"></i> Description:</strong><br>
                            <div class="border rounded p-3 mt-2 bg-light">
                                {!! $notice->description ? $notice->description : '<p class="text-muted">No description available.</p>' !!}
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card-footer text-end">
                    <small class="text-muted">
                        Created at: {{ $notice->created_at->format('d M, Y h:i A') }} |
                        Last updated: {{ $notice->updated_at->format('d M, Y h:i A') }}
                    </small>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
