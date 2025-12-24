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
                    <img width="100%" src="{{ (!empty($first_service->image)) ? url('upload/service/'.$first_service->image):url('upload/page-title.jpg') }}" alt="..." class="wow fadeIn" data-wow-delay="200ms">
                </div>
            </div>
        </div>
    </section>

    <!-- =============== START WORK PARMIT VISA ALL LIST ============== -->
    <section class="single_container">
        <div class="container">
            <div class="row g-xl-5 mt-n2-2">
                @foreach($services as $service)
                    <div class="col-md-6 col-lg-4 mt-2-2 wow fadeInUp " data-wow-delay="100ms">
                        <article class="card card-style-04 h-100 rounded-0 shadow-lg">
                            <div class="blog-img position-relative overflow-hidden">
                                <img src="{{ (!empty($service->image)) ? url('upload/service/'.$service->image):url('upload/no_image.jpg') }}" alt="...">
                                <div class="card-list">
                                    <a href="{{ route('single.service.page',$service->slug) }}">
                                        {{ $service->title ?? 'n/a'}}
                                    </a>
                                </div>
                            </div>
                            <div class="card-body p-1-9">
                                <h3 class="h4 mb-0">
                                    <a href="{{ route('single.service.page',$service->slug) }}">
                                        <?php $p_name_bn = strip_tags(html_entity_decode($service->description)); ?>
                                        {{ Str::limit($p_name_bn, $limit = 20, $end = '. . .') }}
                                    </a>
                                </h3>
                            </div>
                            <div class="d-flex fw-bold border-top px-1-9 py-3 border-color-light-black justify-content-between">
                                <a href="{{ route('single.service.page',$service->slug) }}">Read more</a>
                                <a href="{{ route('single.service.page',$service->slug) }}"><i class="ti-arrow-right"></i></a>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- =============== END WORK PARMIT VISA ALL LIST ================ -->
@endsection
