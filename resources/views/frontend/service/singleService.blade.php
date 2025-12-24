@extends('layouts.frontend.app', [$pageTitle => 'Page Title'])
@section('content')
        <!-- =============== PAGE TITLE ============== -->
        <style>
            .banner_image{
                padding-top: 0px !important;
            }
            .single_container{
                padding-top: 0px !important; 
            }
        </style>
        <!-- =============== PAGE TITLE ============== -->
        <!-- Banner Section -->
        <section class="jumbotron text-center banner_image" aria-label="Banner Section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <img width="100%" src="{{ (!empty($singleService->image)) ? url('upload/service/'.$singleService->image):url('upload/page-title.jpg') }}" alt="..." class="wow fadeIn" data-wow-delay="200ms">
                    </div>
                </div>
            </div>
        </section>

        <!-- ================ SINGLE SERVICE DETAILS ================ -->
        <section class="single_container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mb-5 mb-lg-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <article class="card border-0 primary-shadow">
                                    <img src="{{ (!empty($singleService->image)) ? url('upload/service/'.$singleService->image):url('upload/') }}" alt="..." class="wow fadeIn" data-wow-delay="200ms">
                                    <div class="card-body p-1-6 p-sm-1-9">
                                        <div class="wow fadeIn" data-wow-delay="200ms">
                                            <h3 class="mb-3">{{ $singleService->title ?? 'n/a'}}</h3>
                                            <p>
                                                {!! $singleService->description ?? 'n/a' !!}
                                            </p>
                                            {{-- <p class="mb-2-3">
                                                {!! $singleVisa->documents ?? 'n/a' !!}
                                            </p> --}}
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 ps-xl-5">
                        <div class="sidebar">
                            <a href="{{ route('service.all') }}" class="btn-style1 small btn btn-danger" style="float: right;"><i class="fa fa-share"></i> View All</a>
                            <div class="widget bg-secondary mb-1-9 wow fadeInUp" data-wow-delay="350ms">
                                <div class="widget-content">
                                    <h5 class="mb-3 text-white">Recent Services</h5>
                                    @foreach($services as $service)
                                        <div class="d-flex mb-4">
                                            <div class="flex-shrink-0">
                                                <img width="80" src="{{ (!empty($service->image)) ? url('upload/service/'.$service->image):url('upload/') }}" alt="...">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h4 class="mb-2 h6"><a href="{{ route('single.service.page',$service->slug) }}" class="text-white text-white-hover-light">{{ $service->title ?? 'n/a' }}</a></h4>
                                                {{-- <span class="text-white opacity8 small">June 01 2022</span> --}}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="widget bg-secondary wow fadeInUp" data-wow-delay="800ms">
                                <div class="widget-content">
                                    <h5 class="mb-3 text-white">Follow Us</h5>
                                    <ul class="social-icon-style2 ps-0">
                                        <li class="me-1"><a target="_blank" href="{{ get_setting('facebook_url')->value ?? 'null' }}"><i class="fab fa-facebook-f"></i></a></li>
                                        <li class="me-1"><a target="_blank" href="{{ get_setting('twitter_url')->value ?? 'null' }}"><i class="fab fa-twitter"></i></a></li>
                                        <li class="me-1"><a target="_blank" href="{{ get_setting('instagram_url')->value ?? 'null' }}"><i class="fab fa-instagram"></i></a></li>
                                        <li class="me-0"><a target="_blank" href="{{ get_setting('linkedin_url')->value ?? 'null' }}"><i class="fab fa-linkedin-in"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
       
@endsection
