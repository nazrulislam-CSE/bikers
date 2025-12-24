@extends('layouts.user.app', ['pageTitle' => $pageTitle])
@section('content')
    <div class="main-content-body">
        <form action="{{ route('user.account.store') }}" method="post">
            @csrf
            <!-- Col -->
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                    <p class="card-title my-0">{{ $pageTitle }}</p>
                    <div class="d-flex">
                        {{-- <a data-bs-target="#formSettingModal" data-bs-toggle="modal" class="btn btn-secondary text-white me-2">
                            <i class="fas fa-cog d-inline"></i>
                        </a> --}}
                        <a href="javascript:;" onclick="comingSoon();" class="btn btn-secondary me-2">
                            <i class="fas fa-list d-inline"></i> Account List
                        </a>
                        {{-- <a href="javascript:;" onclick="comingSoon();" class="btn btn-secondary me-2">
                            <i class="fas fa-layer-group d-inline"></i> Client Group
                        </a>
                        <a href="javascript:;" onclick="comingSoon();" class="d-flex align-items-center justify-content-center">
                            <img src="{{ asset('dashboard/img/youtube.png') }}" alt="">
                        </a> --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-xl-4 col-lg-6 col-md-6">
                            <label for="" class="form-label">{{ __('Account title') }}</label>
                            <div class="input-group">
                                <span class="input-group-text" title="Account title" id="basic-addon1"><i class="fas fa-heading" title="Account title"></i></span>
                                <input type="text" class="form-control" name="title" placeholder="Account title">
                            </div>
                        </div>
                        <div class="form-group col-xl-4 col-lg-6 col-md-6">
                            <label for="" class="form-label">{{ __('Initial Balance') }}</label>
                            <div class="input-group">
                                <span class="input-group-text" title="Initial Balance" id="basic-addon1"><i class="fas fa-dollar-sign" title="Name"></i></span>
                                <input type="text" class="form-control" name="initial_balance" placeholder="Initial Balance">
                            </div>
                        </div>
                        <div class="form-group col-xl-4 col-lg-6 col-md-6">
                            <label for="" class="form-label">{{ __('Contact Person') }}</label>
                            <div class="input-group">
                                <span class="input-group-text" title="Account Number" id="basic-addon1"><i class="fas fa-university" title="Contact Person"></i></span>
                                <input type="text" class="form-control" name="person" placeholder="Contact Person">
                            </div>
                        </div>
                        <div class="form-group col-xl-4 col-lg-6 col-md-6">
                            <label for="" class="form-label">{{ __('Phone') }}</label>
                            <div class="input-group">
                                <span class="input-group-text" title="Name" id="basic-addon1"><i class="fas fa-mobile" title="Name"></i></span>
                                <input type="number" min="0" class="form-control" name="phone" placeholder="Phone Number">
                            </div>
                        </div>

                        <div class="form-group col-xl-4 col-lg-6 col-md-6">
                            <label for="" class="form-label">{{ __('Account Description') }}</label>
                            <div class="input-group">
                                <span class="input-group-text" title="Account Description"><i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i></span>
                                <textarea name="description" class="form-control" id="" cols="5" rows="1" placeholder="Account description in short note"></textarea>
                            </div>
                        </div>
                        <div class="form-group col-xl-4 col-lg-6 col-md-6">
                            <label for="" class="form-label">{{ __('Status') }}</label>
                            <div class="input-group">
                                <span class="input-group-text" title="Name" id="basic-addon1"><i class="fas fa-user-tie" title="Name"></i></span>
                                <select name="status" class="form-control select2">
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mt-3">
                            <button type="submit" class="add-to-cart btn btn-success btn-block">Add Account</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Col -->
        </form>
    </div>
@endsection

@push('js_script')
    <script>
        $(document).ready(function() {
            $('.image').change(function(event) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $('.showImage').attr('src', event.target.result);
                }
                reader.readAsDataURL(event.target.files['0']);
            });
            // select2 form input
        });
    </script>
@endpush
