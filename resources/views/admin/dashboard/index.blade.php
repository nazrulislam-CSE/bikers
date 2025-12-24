@extends('layouts.admin.app', ['pageTitle' => 'Dashboard'])

@section('content')
    <div class="breadcrumb-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <h4 class="content-title mb-2">{{ $pageTitle ?? '' }}</h4>
        </div>
        <div class="d-flex my-auto">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.admin.home') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ $pageTitle ?? '' }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="main-content-body">
        <div class="row row-sm">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <a href="javascript:;" class="text-dark" onclick="comingSoon();">
                    <div class="card overflow-hidden project-card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="my-auto">
                                    <img src="{{ asset('dashboard/img/icons/total-sales.png') }}" alt=""
                                        class="me-5 ht-70 wd-70 my-auto border shadow-sm rounded-lg p-2 bg-light">
                                </div>
                                <div class="project-content d-grid align-items-center">
                                    <h4>{{ __('Total Slider') }}</h4>
                                    <ul>
                                        <li>
                                            <strong class="d-inline-flex mb-0"
                                                style="font-size: 15px !important;">Total:</strong>
                                            <span><strong style="font-size: 15px !important;">0</strong></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <a href="javascript:;" class="text-dark" onclick="comingSoon();">
                    <div class="card overflow-hidden project-card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="my-auto">
                                    <img src="{{ asset('dashboard/img/icons/due.png') }}" alt=""
                                        class="me-5 ht-70 wd-70 my-auto border shadow-sm rounded-lg p-2 bg-light">
                                </div>
                                <div class="project-content d-grid align-items-center">
                                    <h4>{{ __('Total Teams') }}</h4>
                                    <ul>
                                        <li>
                                            <strong class="d-inline-flex mb-0"
                                                style="font-size: 15px !important;">Total:</strong>
                                            <span><strong style="font-size: 15px !important;">0</strong></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <a href="javascript:;" class="text-dark" onclick="comingSoon();">
                    <div class="card overflow-hidden project-card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="my-auto">
                                    <img src="{{ asset('dashboard/img/icons/calendar.png') }}" alt=""
                                        class="me-5 ht-70 wd-70 my-auto border shadow-sm rounded-lg p-2 bg-light">
                                </div>
                                <div class="project-content d-grid align-items-center">
                                    <h4>{{ __('Total Blog') }}</h4>
                                    <ul>
                                        <li>
                                            <strong class="d-inline-flex mb-0"
                                                style="font-size: 15px !important;">Total:</strong>
                                            <span><strong style="font-size: 15px !important;">0</strong></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <a href="javascript:;" class="text-dark" onclick="comingSoon();">
                    <div class="card overflow-hidden project-card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="my-auto">
                                    <img src="{{ asset('dashboard/img/icons/calendar.png') }}" alt=""
                                        class="me-5 ht-70 wd-70 my-auto border shadow-sm rounded-lg p-2 bg-light">
                                </div>
                                <div class="project-content d-grid align-items-center">
                                    <h4>{{ __('Total Testimonials') }}</h4>
                                    <ul>
                                        <li>
                                            <strong class="d-inline-flex mb-0"
                                                style="font-size: 15px !important;">Total:</strong>
                                            <span><strong style="font-size: 15px !important;">0</strong></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <a href="javascript:;" class="text-dark" onclick="comingSoon();">
                    <div class="card  overflow-hidden project-card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="my-auto">
                                    <img src="{{ asset('dashboard/img/icons/deposit.png') }}" alt=""
                                        class="me-5 ht-70 wd-70 my-auto border shadow-sm rounded-lg p-2 bg-light">
                                </div>
                                <div class="project-content d-grid align-items-center">
                                    <h4>{{ __('Total Page') }}</h4>
                                    <ul>
                                        <li>
                                            <strong class="d-inline-flex mb-0"
                                                style="font-size: 15px !important;">Total:</strong>
                                            <span><strong
                                                    style="font-size: 15px !important;">{{ count($pages ?? '0') }}</strong></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <a href="javascript:;" class="text-dark">
                    <div class="card overflow-hidden project-card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="my-auto">
                                    <img src="{{ asset('dashboard/img/icons/calendar.png') }}" alt=""
                                        class="me-5 ht-70 wd-70 my-auto border shadow-sm rounded-lg p-2 bg-light">
                                </div>
                                <div class="project-content d-grid align-items-center">
                                    <h4>{{ __('Total Menu Builder') }}</h4>
                                    <ul>
                                        <li>
                                            <strong class="d-inline-flex mb-0"
                                                style="font-size: 15px !important;">Total:</strong>
                                            <span><strong
                                                    style="font-size: 15px !important;">{{ count($menuitems ?? '0') }}</strong></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <a href="javascript:;" class="text-dark">
                    <div class="card overflow-hidden project-card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="my-auto">
                                    <img src="{{ asset('dashboard/img/icons/due.png') }}" alt=""
                                        class="me-5 ht-70 wd-70 my-auto border shadow-sm rounded-lg p-2 bg-light">
                                </div>
                                <div class="project-content d-grid align-items-center">
                                    <h4>{{ __('Total Menus') }}</h4>
                                    <ul>
                                        <li>
                                            <strong class="d-inline-flex mb-0"
                                                style="font-size: 15px !important;">Total:</strong>
                                            <span><strong
                                                    style="font-size: 15px !important;">{{ count($menus ?? '0') }}</strong></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <a href="javascript:;" class="text-dark">
                    <div class="card  overflow-hidden project-card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="my-auto">
                                    <img src="{{ asset('dashboard/img/icons/deposit.png') }}" alt=""
                                        class="me-5 ht-70 wd-70 my-auto border shadow-sm rounded-lg p-2 bg-light">
                                </div>
                                <div class="project-content d-grid align-items-center">
                                    <h4>{{ __('Total Sections') }}</h4>
                                    <ul>
                                        <li>
                                            <strong class="d-inline-flex mb-0"
                                                style="font-size: 15px !important;">Total:</strong>
                                            <span><strong
                                                    style="font-size: 15px !important;">{{ count($sections ?? '0') }}</strong></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <a href="javascript:;" class="text-dark">
                    <div class="card overflow-hidden project-card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="my-auto">
                                    <img src="{{ asset('dashboard/img/icons/calendar.png') }}" alt=""
                                        class="me-5 ht-70 wd-70 my-auto border shadow-sm rounded-lg p-2 bg-light">
                                </div>
                                <div class="project-content d-grid align-items-center">
                                    <h4>{{ __('Total Testimonials') }}</h4>
                                    <ul>
                                        <li>
                                            <strong class="d-inline-flex mb-0"
                                                style="font-size: 15px !important;">Total:</strong>
                                            <span><strong
                                                    style="font-size: 15px !important;">{{ count($testimonials ?? '0') }}</strong></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <a href="javascript:;" class="text-dark">
                    <div class="card overflow-hidden project-card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="my-auto">
                                    <img src="{{ asset('dashboard/img/icons/calendar.png') }}" alt=""
                                        class="me-5 ht-70 wd-70 my-auto border shadow-sm rounded-lg p-2 bg-light">
                                </div>
                                <div class="project-content d-grid align-items-center">
                                    <h4>{{ __('Total Settings') }}</h4>
                                    <ul>
                                        <li>
                                            <strong class="d-inline-flex mb-0"
                                                style="font-size: 15px !important;">Total:</strong>
                                            <span><strong
                                                    style="font-size: 15px !important;">{{ count($settings ?? '0') }}</strong></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <a href="javascript:;" class="text-dark">
                    <div class="card overflow-hidden project-card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="my-auto">
                                    <img src="{{ asset('dashboard/img/icons/calendar.png') }}" alt=""
                                        class="me-5 ht-70 wd-70 my-auto border shadow-sm rounded-lg p-2 bg-light">
                                </div>
                                <div class="project-content d-grid align-items-center">
                                    <h4>{{ __('Total Slider') }}</h4>
                                    <ul>
                                        <li>
                                            <strong class="d-inline-flex mb-0"
                                                style="font-size: 15px !important;">Total:</strong>
                                            <span><strong
                                                    style="font-size: 15px !important;">{{ count($sliders ?? '0') }}</strong></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <a href="javascript:;" class="text-dark">
                    <div class="card overflow-hidden project-card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="my-auto">
                                    <img src="{{ asset('dashboard/img/icons/calendar.png') }}" alt=""
                                        class="me-5 ht-70 wd-70 my-auto border shadow-sm rounded-lg p-2 bg-light">
                                </div>
                                <div class="project-content d-grid align-items-center">
                                    <h4>{{ __('Total About') }}</h4>
                                    <ul>
                                        <li>
                                            <strong class="d-inline-flex mb-0"
                                                style="font-size: 15px !important;">Total:</strong>
                                            <span><strong
                                                    style="font-size: 15px !important;">{{ count($abouts ?? '0') }}</strong></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
