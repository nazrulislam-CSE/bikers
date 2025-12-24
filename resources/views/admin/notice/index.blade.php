@extends('layouts.admin.app', [$pageTitle => 'Page Title'])

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
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                    <p class="card-title my-0">
                        {{ $pageTitle ?? 'Page Title' }}
                        <span class="badge bg-danger side-badge" style="font-size:17px;">{{ count($notices) }}</span>
                    </p>

                    <div class="d-flex">
                        <a href="{{ route('admin.notice.create')}}" class="btn btn-success me-2">
                            <i class="fas fa-plus d-inline"></i> Add New Notice
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>File</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($notices as $key => $notice)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>

                                        <td>
                                            <strong>{{ $notice->title }}</strong>
                                            <br>
                                            <small class="text-muted">Slug: {{ $notice->slug }}</small>
                                        </td>

                                        <td>{{ \Carbon\Carbon::parse($notice->date)->format('d M, Y') }}</td>

                                        <td>
                                            @if($notice->file_url)
                                                <a href="{{ asset('storage/' . $notice->file_url) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fa fa-file-pdf"></i> View PDF
                                                </a>
                                            @else
                                                <span class="text-muted">No File</span>
                                            @endif
                                        </td>

                                        <td>
                                            {{ Str::limit($notice->description, 50, '...') ?? 'N/A' }}
                                        </td>

                                        <td>
                                            @if($notice->status == 1)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ route('admin.notice.show', $notice->id) }}" class="btn btn-success btn-sm" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.notice.edit', $notice->id) }}" class="btn btn-primary btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('admin.notice.destroy',$notice->id)}}" class="btn btn-danger btn-sm" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Row -->
</div>
@endsection
