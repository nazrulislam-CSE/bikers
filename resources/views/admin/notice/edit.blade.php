@extends('layouts.admin.app', [$pageTitle => 'Edit Notice'])

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
                    <p class="card-title my-0">{{ $pageTitle ?? 'Edit Notice' }}</p>
                    <div class="d-flex">
                        <a href="{{ route('admin.notice.index') }}" class="btn btn-danger me-2">
                            <i class="fas fa-list d-inline"></i> Notice List
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.notice.update', $notice->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            {{-- Title --}}
                            <div class="form-group col-xl-12 col-lg-6 col-md-6">
                                <label for="title">Title:</label>
                                @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                    <input type="text" name="title" class="form-control"
                                           value="{{ old('title', $notice->title) }}" required>
                                </div>
                            </div>

                            {{-- Date --}}
                            <div class="form-group col-xl-6 col-lg-6 col-md-6 mt-3">
                                <label for="date">Date:</label>
                                @error('date') <span class="text-danger">{{ $message }}</span> @enderror
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    <input type="date" name="date" class="form-control"
                                           value="{{ old('date', $notice->date) }}" required>
                                </div>
                            </div>

                            {{-- PDF File Upload --}}
                            <div class="form-group col-xl-6 col-lg-6 col-md-6 mt-3">
                                <label for="file_url">Replace PDF File (Optional):</label>
                                @error('file_url') <span class="text-danger">{{ $message }}</span> @enderror
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                                    <input type="file" name="file_url" class="form-control" accept="application/pdf">
                                </div>
                                <small class="text-muted">Leave empty to keep the current file.</small>

                                @if($notice->file_url)
                                    <div class="mt-2">
                                        <p>Current File:
                                            <a href="{{ asset('storage/'.$notice->file_url) }}" target="_blank" class="text-primary">
                                                <i class="fas fa-file-pdf"></i> View PDF
                                            </a>
                                        </p>
                                    </div>
                                @endif
                            </div>

                            {{-- Description --}}
                            <div class="form-group col-xl-12 col-lg-12 col-md-12 mt-3">
                                <label for="description">Description:</label>
                                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                                <textarea id="description" name="description" class="form-control" rows="5">
                                    {{ old('description', $notice->description) }}
                                </textarea>
                            </div>

                            {{-- Status --}}
                            <div class="form-group col-xl-6 col-lg-6 col-md-6 mt-3">
                                <label for="status">Status:</label>
                                @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
                                    <select name="status" class="form-control" required>
                                        <option value="1" {{ old('status', $notice->status) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status', $notice->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Submit Button --}}
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-4">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-save"></i> Update Notice
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('admin')
<script>
    // Summernote initialization
    jQuery(function(e){
        'use strict';
        $(document).ready(function() {
            $('#description').summernote({
                placeholder: 'Edit notice details...',
                height: 200,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['fontsize', 'color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });
        });
    });
</script>
@endpush
