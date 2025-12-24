@extends('layouts.admin.app', [$pageTitle => 'Page Title'])

@section('content')
    <!-- Content Header (Page header) -->
    <div class="breadcrumb-header justify-content-between">
        <div class="d-flex align-items-center">
            {{-- <h4 class="content-title mb-2">Hi, welcome back!</h4> --}}
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle ?? 'Page Title' }}</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex my-auto">

        </div>
    </div>

    <!-- Main content -->
    <div class="card card-primary card-outline shadow-lg mb-4">
        <div class="card-header border-bottom d-flex justify-content-between align-items-center">
            <p class="card-title my-0">{{ $pageTitle ?? 'Page Title' }}</p>
            <div class="d-flex">
                <a href="{{ route('admin.destination.index') }}" class="btn btn-danger me-2">
                    <i class="fas fa-list d-inline"></i> Destination List
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <td>Title</td>
                        <td>{{ $destination->title }}</td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td>{{ $destination->country }}</td>
                    </tr>
                    <tr>
                        <td>Package Count</td>
                        <td>{{ $destination->package_count }}</td>
                    </tr>

                    <tr>
                        <td>Status</td>
                        <td>
                            @if ($destination->status == 1)
                                <span class="badge bg-pill bg-success">Active</span>
                            @else
                                <span class="badge bg-pill bg-success">Disable</span>
                            @endif

                        </td>
                    </tr>
                    <tr>
                        <td>Photo</td>
                        <td>
                            <img src="{{ !empty($destination->image) ? url('upload/destination/' . $destination->image) : url('upload/no_image.jpg') }}"
                                width="80" alt="image" class="img-fluid">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
