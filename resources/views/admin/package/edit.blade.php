@extends('layouts.admin.app', [$pageTitle => 'Page Title'])
@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="d-flex align-items-center">
        {{-- <h4 class="content-title mb-2">Hi, welcome back!</h4> --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle ?? 'Dashboard' }}</li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
            </ol>
        </nav>
    </div>
    <div class="d-flex my-auto">

    </div>
</div>

    <div class="main-content-body">
        <div class="row row-sm">
            
    <div class="card">
        <div class="card-header border-bottom d-flex justify-content-between align-items-center">
            <p class="card-title my-0">{{ $pageTitle ?? 'Page Title'}}</p>
            <div class="d-flex">
                <a href="{{ route('admin.package.index')}}" class="btn btn-danger me-2">
                    <i class="fas fa-list d-inline"></i> Package List
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.package.update',$package->id)}}" method="post" enctype="multipart/form-data">
                @csrf
              <div class="row">
                    <div class="col-md-6 col-sm-12 mt-3">
                        <label for="title" class="form-label">Title <span class="text-danger"></span></label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ $package->title }}" required>
                    </div>
                    <div class="col-md-6 col-sm-12 mt-3">
                        <label for="country" class="form-label">Country <span class="text-danger"></span></label>
                        <input type="text" name="country" id="country" class="form-control" value="{{ $package->country }}" required>
                    </div>
                    <div class="col-md-6 col-sm-12 mt-3">
                        <label for="people" class="form-label">People <span class="text-danger"></span></label>
                        <input type="text" name="people" id="people" class="form-control" value="{{ $package->people }}" required>
                    </div>
                    <div class="col-md-6 col-sm-12 mt-3">
                        <label for="duration" class="form-label">Duration <span class="text-danger"></span></label>
                        <input type="text" name="duration" id="duration" class="form-control" value="{{ $package->duration }}" required>
                    </div>
                    <div class="col-md-6 col-sm-12 mt-3">
                        <label for="price" class="form-label">Price <span class="text-danger"></span></label>
                        <input type="number" name="price" id="price" class="form-control" value="{{ $package->price }}" required>
                    </div>
                    <div class="col-md-6 col-sm-12 mt-3">
                        <label for="rating" class="form-label">Rating (Max 5)</label>
                        <input type="number" step="0.1" name="rating" id="rating" class="form-control" value="{{ $package->rating }}">
                    </div>
                    <div class="col-md-6 col-sm-12 mt-3">
                        <label for="is_popular" class="form-label">Is Popular <span class="text-danger"></span></label>
                        <select name="is_popular" id="is_popular" class="form-control" required>
                            <option value="1" {{ $package->is_popular == 1 ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ $package->is_popular == 0 ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                    <div class="col-md-6 col-sm-12 mt-3">
                        <label for="status" class="form-label">Status <span class="text-danger"></span></label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="1" {{ $package->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $package->status == 0 ? 'selected' : '' }}>Disable</option>
                        </select>
                    </div>
                    <div class="col-md-6 col-sm-12 mt-3">
                        <label for="image" class="form-label">Package Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                        <img src="{{ !empty($package->image) ? url('upload/package/' . $package->image) : url('upload/no_image.jpg') }}" 
                            alt="image" id="showImage" class="img-fluid mt-2" width="80">
                    </div>
                    <div class="col-md-6 col-sm-12 mt-3">
                        <label for="image1" class="form-label">Country Flag</label>
                        <input type="file" name="country_flag" id="image1" class="form-control">
                        <img src="{{ !empty($package->country_flag) ? url('upload/package/flag/' . $package->country_flag) : url('upload/no_image.jpg') }}" 
                            alt="image" id="showImage1" class="img-fluid mt-2" width="80">
                    </div>
                    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mt-3">
                        <button type="submit" class="add-to-cart btn btn-success btn-block"><i class="fas fa-paper-plane"></i> Update Package</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
        </div>
    </div>
@endsection
@push('admin')
	<script>
        /* ============== Team Photo ============ */
        $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
            $('#image1').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage1').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
        /* ============== Summernote Added ============ */
        jQuery(function(e){
            'use strict';
            $(document).ready(function() {
                $('#description').summernote({
                    placeholder: 'Please some content here'
                });
            });
        });
        /* ============== Summernote Added ============ */
    </script>
@endpush
