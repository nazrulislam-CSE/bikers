@extends('layouts.admin.app', [$pageTitle => 'Edit News & Event'])

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle ?? 'Edit News & Event' }}</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.news-events.index') }}">News & Events</a></li>
            </ol>
        </nav>
    </div>
</div>

<div class="main-content-body">
    <div class="row row-sm">
        <div class="card">
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <p class="card-title my-0">{{ $pageTitle ?? 'Edit News & Event' }}</p>
                <div class="d-flex">
                    <a href="{{ route('admin.news-events.index')}}" class="btn btn-danger me-2">
                        <i class="fas fa-list d-inline"></i> News & Event List
                    </a>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.news-events.update', $newsEvent->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        {{-- Title --}}
                        <div class="form-group col-xl-6 col-lg-6 col-md-6">
                            <label for="title">Title <span class="text-danger">*</span></label>
                            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                <input type="text" name="title" class="form-control" placeholder="Enter title" value="{{ old('title', $newsEvent->title) }}" required>
                            </div>
                        </div>

                        {{-- Organizer --}}
                        <div class="form-group col-xl-6 col-lg-6 col-md-6">
                            <label for="organizer">Organizer</label>
                            @error('organizer') <span class="text-danger">{{ $message }}</span> @enderror
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                                <input type="text" name="organizer" class="form-control" placeholder="Enter organizer name" value="{{ old('organizer', $newsEvent->organizer) }}">
                            </div>
                        </div>

                        {{-- Date --}}
                        <div class="form-group col-xl-6 col-lg-6 col-md-6 mt-3">
                            <label for="date">Date</label>
                            @error('date') <span class="text-danger">{{ $message }}</span> @enderror
                            <div class="input-group">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                <input type="date" name="date" class="form-control" value="{{ old('date', $newsEvent->date) }}">
                            </div>
                        </div>

                        {{-- Venue --}}
                        <div class="form-group col-xl-6 col-lg-6 col-md-6 mt-3">
                            <label for="venue">Venue</label>
                            @error('venue') <span class="text-danger">{{ $message }}</span> @enderror
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                <input type="text" name="venue" class="form-control" placeholder="Enter venue" value="{{ old('venue', $newsEvent->venue) }}">
                            </div>
                        </div>

                        {{-- Link --}}
                        <div class="form-group col-xl-6 col-lg-6 col-md-6 mt-3">
                            <label for="link">External Link (optional)</label>
                            @error('link') <span class="text-danger">{{ $message }}</span> @enderror
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-link"></i></span>
                                <input type="url" name="link" class="form-control" placeholder="Enter URL" value="{{ old('link', $newsEvent->link) }}">
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="form-group col-xl-6 col-lg-6 col-md-6 mt-3">
                            <label for="status">Status</label>
                            @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
                                <select name="status" class="form-control">
                                    <option value="">Select Status</option>
                                    <option value="1" {{ old('status', $newsEvent->status) == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status', $newsEvent->status) == 0 ? 'selected' : '' }}>Deactive</option>
                                </select>
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="form-group col-xl-12 col-lg-12 col-md-12 mt-3">
                            <label for="description">Description</label>
                            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                            <textarea id="description" name="description" class="form-control" rows="5">{{ old('description', $newsEvent->description) }}</textarea>
                        </div>

                        {{-- Submit Button --}}
                        <div class="col-xl-12 col-lg-12 col-md-12 mt-4 text-end">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Update News & Event
                            </button>
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
    /* ============== Summernote Added ============ */
    jQuery(function(e){
        'use strict';
        $(document).ready(function() {
            $('#description').summernote({
                placeholder: 'Please enter the event description...',
                height: 200
            });
        });
    });
    /* ============== Summernote Added ============ */
</script>
@endpush
