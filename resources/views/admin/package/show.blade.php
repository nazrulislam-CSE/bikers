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
                <a href="{{ route('admin.package.index') }}" class="btn btn-danger me-2">
                    <i class="fas fa-list d-inline"></i> Package List
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <td>Title</td>
                        <td>{{ $package->title }}</td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td>{{ $package->country }}</td>
                    </tr>
                    <tr>
                        <td>People</td>
                        <td>{{ $package->people }}</td>
                    </tr>
                    <tr>
                        <td>Duration</td>
                        <td>{{ $package->duration }}</td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td class="font-weight-bolder">{{ number_format($package->price) }}</td>
                    </tr>
                    <tr>
                        <td>Rating</td>
                        <td>
                            @php
                                $rating = $package->rating; // Example: 4.3
                                $fullStars = floor($rating);
                                $halfStar = $rating - $fullStars >= 0.5 ? 1 : 0;
                                $emptyStars = 5 - ($fullStars + $halfStar);
                            @endphp

                            {{-- Show full stars --}}
                            @for ($i = 0; $i < $fullStars; $i++)
                                <i class="fas fa-star text-warning"></i>
                            @endfor

                            {{-- Show half star (if any) --}}
                            @if ($halfStar)
                                <i class="fas fa-star-half-alt text-warning"></i>
                            @endif

                            {{-- Show empty stars --}}
                            @for ($i = 0; $i < $emptyStars; $i++)
                                <i class="far fa-star text-warning"></i>
                            @endfor

                            {{-- Show numeric rating (optional) --}}
                            <span>({{ number_format($rating, 1) }})</span>
                        </td>
                    </tr>

                    <tr>
                        <td>Popular</td>
                        <td>
                            @if ($package->is_popular == 1)
                                <a href="#" class="badge bg-pill bg-success">Popular</a>
                            @else
                                <a href="#" class="badge bg-pill bg-danger">Normal</a>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>Status</td>
                        <td>
                            @if ($package->status == 1)
                                <span class="badge bg-pill bg-success">Active</span>
                            @else
                                <span class="badge bg-pill bg-success">Disable</span>
                            @endif

                        </td>
                    </tr>
                    <tr>
                        <td>Photo</td>
                        <td>
                            <img src="{{ !empty($package->image) ? url('upload/package/' . $package->image) : url('upload/no_image.jpg') }}"
                                width="80" alt="image" class="img-fluid">
                        </td>
                    </tr>
                    <tr>
                        <td>Country Flag</td>
                        <td>
                            <img src="{{ !empty($package->country_flag) ? url('upload/package/flag/' . $package->country_flag) : url('upload/no_image.jpg') }}"
                                width="80" alt="image" class="img-fluid">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
