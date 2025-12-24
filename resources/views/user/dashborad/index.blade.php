@extends('layouts.user.app', ['pageTitle' => $pageTitle])
@section('content')
    <div class="main-content-body">
        <div class="row row-sm">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <a href="javascript:;" class="text-dark">
                            <div class="card overflow-hidden project-card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="my-auto">
                                            <svg enable-background="new 0 0 469.682 469.682" version="1.1" class="me-4 ht-60 wd-60 my-auto primary" viewBox="0 0 469.68 469.68" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                                <path d="m120.41 298.32h87.771c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449h-87.771c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449z" />
                                                <path d="m291.77 319.22h-171.36c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449h171.36c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449z" />
                                                <path d="m291.77 361.01h-171.36c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449h171.36c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449z" />
                                                <path d="m420.29 387.14v-344.82c0-22.987-16.196-42.318-39.183-42.318h-224.65c-22.988 0-44.408 19.331-44.408 42.318v20.376h-18.286c-22.988 0-44.408 17.763-44.408 40.751v345.34c0.68 6.37 4.644 11.919 10.449 14.629 6.009 2.654 13.026 1.416 17.763-3.135l31.869-28.735 38.139 33.959c2.845 2.639 6.569 4.128 10.449 4.18 3.861-0.144 7.554-1.621 10.449-4.18l37.616-33.959 37.616 33.959c5.95 5.322 14.948 5.322 20.898 0l38.139-33.959 31.347 28.735c3.795 4.671 10.374 5.987 15.673 3.135 5.191-2.98 8.232-8.656 7.837-14.629v-74.188l6.269-4.702 31.869 28.735c2.947 2.811 6.901 4.318 10.971 4.18 1.806 0.163 3.62-0.2 5.224-1.045 5.493-2.735 8.793-8.511 8.361-14.629zm-83.591 50.155-24.555-24.033c-5.533-5.656-14.56-5.887-20.376-0.522l-38.139 33.959-37.094-33.959c-6.108-4.89-14.79-4.89-20.898 0l-37.616 33.959-38.139-33.959c-6.589-5.4-16.134-5.178-22.465 0.522l-27.167 24.033v-333.84c0-11.494 12.016-19.853 23.51-19.853h224.65c11.494 0 18.286 8.359 18.286 19.853v333.84zm62.693-61.649-26.122-24.033c-4.18-4.18-5.224-5.224-15.673-3.657v-244.51c1.157-21.321-15.19-39.542-36.51-40.699-0.89-0.048-1.782-0.066-2.673-0.052h-185.47v-20.376c0-11.494 12.016-21.42 23.51-21.42h224.65c11.494 0 18.286 9.927 18.286 21.42v333.32z" />
                                                <path d="m232.21 104.49h-57.47c-11.542 0-20.898 9.356-20.898 20.898v104.49c0 11.542 9.356 20.898 20.898 20.898h57.469c11.542 0 20.898-9.356 20.898-20.898v-104.49c1e-3 -11.542-9.356-20.898-20.897-20.898zm0 123.3h-57.47v-13.584h57.469v13.584zm0-34.482h-57.47v-67.918h57.469v67.918z" />
                                            </svg>
                                        </div>
                                        <div class="project-content d-grid align-items-center">
                                            <strong>Test</strong>
                                            <ul>
                                                <li>
                                                    <strong class="d-inline-flex mb-0" style="font-size: 15px !important;">Total:</strong>
                                                    <span><strong style="font-size: 15px !important;">৳</strong></span>
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
            <div class="col-lg-4">
                <div class="card mg-b-20 bg_card">
                    <div class="card-body">
                        <h4 class="card-title mg-b-10 text-center">Profile Information</h4>
                        <div class="ps-0">
                            <div class="main-profile-overview">
                                <div class="row justify-content-center">
                                    <div class="col-auto">
                                        <div class="main-img-user profile-user">
                                            <img alt="" src="{{ (!empty( Auth::user()->image)) ? url('upload/user_images/'.Auth::user()->image):url('upload/default.png') }}">
                                            <a class="" href="JavaScript:void(0);"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mg-b-20">
                                    <table class="table table-hover table-bordered mb-0 text-md-nowrap text-lg-nowrap text-xl-nowrap  ">
                                        
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="project-names">
                                                        <p class="d-inline-block font-weight-semibold mb-0">Company Name</p>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="font-weight-bolder">{{ Auth::user()->name ?? 'n/a'}}</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="project-names">
                                                        <p class="d-inline-block font-weight-semibold mb-0">Email</p>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="font-weight-bolder">{{ Auth::user()->email ?? 'n/a'}}</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="project-names">
                                                        <p class="d-inline-block font-weight-semibold mb-0">Mobile Number</p>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="font-weight-bolder">{{ Auth::user()->phone ?? 'n/a'}}</div>
                                                </td>
                                            </tr>
                                            {{-- <tr>
                                                <td>
                                                    <div class="project-names">
                                                        <p class="d-inline-block font-weight-semibold mb-0">Established Year</p>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="font-weight-bolder">{{ Auth::user()->established_year ?? 'n/a'}}</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="project-names">
                                                        <p class="d-inline-block font-weight-semibold mb-0">Nid Number</p>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="font-weight-bolder">{{ Auth::user()->nid_number ?? 'n/a'}}</div>
                                                </td>
                                            </tr> --}}
                                        </tbody>
                                    </table>
                                </div>
                                <label class="main-content-label tx-13 mg-b-20 text-light">Social</label>
                                <div class="main-profile-social-list">
                                    <div class="media">
                                        <div class="media-icon bg-primary-transparent text-success">
                                            <i class="icon ion-logo-whatsapp"></i>
                                        </div>
                                        <div class="media-body">
                                            <span>Whatsapp</span> <a href="">https://www.whatsapp.com/</a>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="media-icon bg-primary-transparent text-primary">
                                            <i class="icon ion-logo-facebook"></i>
                                        </div>
                                        <div class="media-body">
                                            <span>Facebook</span> <a href="">https://www.facebook.com/</a>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="media-icon bg-success-transparent text-success">
                                            <i class="icon ion-logo-twitter"></i>
                                        </div>
                                        <div class="media-body">
                                            <span>Twitter</span> <a href="">twitter.com/spruko.me</a>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="media-icon bg-info-transparent text-info">
                                            <i class="icon ion-logo-linkedin"></i>
                                        </div>
                                        <div class="media-body">
                                            <span>Linkedin</span> <a href="">linkedin.com/in/spruko</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
