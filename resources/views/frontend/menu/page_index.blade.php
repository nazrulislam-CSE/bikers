@extends('layouts.frontend.app', [$pageTitle => 'Page Title'])
@section('content')
<style>
      .banner_image{
            padding-top: 0px !important;
        }
        .single_container{
            padding-top: 0px !important; 
        }
</style>
@php
$currentUrl = url()->current();

@endphp
<section class="page-content pt-5 pb-5">
    <div class="container">
        <h3>{{ $page->page_title ?? 'No content available' }}</h3>
        <p>{!! $page->page_description ?? 'No content available' !!}</p>
    </div>
</section>
@push('frontend-js')
   
@endpush
@endsection