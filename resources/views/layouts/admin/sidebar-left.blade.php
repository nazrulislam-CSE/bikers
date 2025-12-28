<div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
<div class="sticky">
    <aside class="app-sidebar sidebar-scroll">
        <div class="main-sidebar-header active">
            <a class="desktop-logo logo-light active" href="{{ route('user.home') }}">
                <h3 class="text-uppercase font-weight-bolder text-center">{{ get_setting('site_name')->value ?? '' }}
                </h3>
            </a>
        </div>
        <div class="main-sidemenu">
            <div class="main-sidebar-loggedin">
                <div class="app-sidebar__user">
                    <div class="dropdown user-pro-body text-center">
                        <div class="user-pic">
                            <img src="{{ !empty(Auth::guard('admin')->user()->image) ? url('upload/admin_images/' . Auth::guard('admin')->user()->image) : url('dashboard/img/avatar5.png') }}"
                                alt="user-img" class="rounded-circle mCS_img_loaded">
                        </div>
                        <div class="user-info">
                            <h6 class=" mb-0 text-dark">{{ Auth::guard('admin')->user()->name }}</h6>
                            {{-- <span class="text-muted app-sidebar__user-name text-sm">{{ Auth::guard('admin')->user()->username }}</span> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="sidebar-navs">
                <ul class="nav  nav-pills-circle">
                    <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                        data-bs-original-title="Settings" aria-describedby="tooltip365540">
                        <a href="{{ route('admin.settings.index') }}" class="nav-link text-center m-2">
                            <i class="fe fe-settings"></i>
                        </a>
                    </li>
                    <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                        data-bs-original-title="Followers">
                        <a href="{{ route('admin.profile.view') }}" class="nav-link text-center m-2">
                            <i class="fe fe-user"></i>
                        </a>
                    </li>
                    <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                        data-bs-original-title="Logout">
                        <a class="nav-link text-center m-2" href="{{ route('admin.logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fe fe-power"></i>
                        </a>

                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
            <div class="slide-left disabled" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg>
            </div>
            <ul class="side-menu ">
                <li class="slide">
                    <a class="side-menu__item {{ Request::is('admin/dashboard') ? 'active' : '' }}"
                        href="{{ route('admin.admin.home') }}"><i class="side-menu__icon fas fa-th-large"></i><span
                            class="side-menu__label">Dashboard</span></a>
                </li>

                 <li class="slide {{ Request::is('admin/bike/register*') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="side-menu__icon fas fa-store-alt"></i>
                        <span class="side-menu__label">Bike Registration List</span>
                        <i class="angle fe fe-chevron-down hor-angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Bike Registration Lists</a></li>
                        <li><a class="slide-item {{ Request::is('admin/bike/register/index') ? 'active' : '' }}"
                                href="{{ route('admin.bike.register.index') }}">Bike Registration List</a></li>
                    </ul>
                </li>

                <li class="slide {{ Request::is('admin/sections*') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="side-menu__icon fas fa-store-alt"></i>
                        <span class="side-menu__label">Sections</span>
                        <i class="angle fe fe-chevron-down hor-angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Sections</a></li>
                        <li><a class="slide-item {{ Request::is('admin/sections/create') ? 'active' : '' }}"
                                href="{{ route('admin.section.create') }}">Section Add</a></li>
                        <li><a class="slide-item {{ Request::is('admin/sections/index') ? 'active' : '' }}"
                                href="{{ route('admin.section.index') }}">Section List</a></li>
                    </ul>
                </li>

                <li class="slide {{ Request::is('admin/slider*') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="side-menu__icon fas fa-store-alt"></i>
                        <span class="side-menu__label">Sliders</span>
                        <i class="angle fe fe-chevron-down hor-angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Slider</a></li>
                        <li><a class="slide-item {{ Request::is('admin/slider/create') ? 'active' : '' }}"
                                href="{{ route('admin.slider.create') }}">Slider Add</a></li>
                        <li><a class="slide-item {{ Request::is('admin/slider/index') ? 'active' : '' }}"
                                href="{{ route('admin.slider.index') }}">Slider List</a></li>
                    </ul>
                </li>

                <li class="slide {{ Request::is('admin/about*') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="side-menu__icon fas fa-store-alt"></i>
                        <span class="side-menu__label">About</span>
                        <i class="angle fe fe-chevron-down hor-angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">About</a></li>
                        <li><a class="slide-item {{ Request::is('admin/about/index') ? 'active' : '' }}"
                                href="{{ route('admin.about.index') }}">About List</a></li>
                    </ul>
                </li>

                <li class="slide {{ Request::is('admin/pages*') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="side-menu__icon fas fa-building"></i>
                        <span class="side-menu__label">Pages</span>
                        <i class="angle fe fe-chevron-down hor-angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Pages</a></li>
                        <li><a class="slide-item {{ Request::is('admin/pages/create') ? 'active' : '' }}"
                                href="{{ route('admin.page.create') }}">Pages Add</a></li>
                        <li><a class="slide-item {{ Request::is('admin/pages/index') ? 'active' : '' }}"
                                href="{{ route('admin.page.index') }}">Pages List</a></li>
                    </ul>
                </li>

                <li class="slide {{ Request::is('admin/menus*') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="side-menu__icon fas fa-vote-yea"></i>
                        <span class="side-menu__label">Menu Builder</span>
                        <i class="angle fe fe-chevron-down hor-angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Menu Builder</a></li>
                        <li><a class="slide-item {{ Request::is('admin/menuBuilder') ? 'active' : '' }}"
                                href="{{ route('admin.menuBuilder') }}">Mange Menu Builder</a></li>
                    </ul>
                </li>

                <li class="slide {{ Request::is('admin/teams*') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="side-menu__icon fas fa-users"></i>
                        <span class="side-menu__label">Teams</span>
                        <i class="angle fe fe-chevron-down hor-angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Teams</a></li>
                        <li><a class="slide-item {{ Request::is('admin/teams/create') ? 'active' : '' }}"
                                href="{{ route('admin.team.create') }}">Team Add</a></li>
                        <li><a class="slide-item {{ Request::is('admin/teams/list') ? 'active' : '' }}"
                                href="{{ route('admin.team.index') }}">Team List</a></li>
                    </ul>
                </li>

                <li class="slide {{ Request::is('admin/partner*') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="side-menu__icon fas fa-users"></i>
                        <span class="side-menu__label">Partners</span>
                        <i class="angle fe fe-chevron-down hor-angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Partners</a></li>
                        <li><a class="slide-item {{ Request::is('admin/partner/create') ? 'active' : '' }}"
                                href="{{ route('admin.partner.create') }}">Partner Add</a></li>
                        <li><a class="slide-item {{ Request::is('admin/partner/list') ? 'active' : '' }}"
                                href="{{ route('admin.partner.index') }}">Partner List</a></li>
                    </ul>
                </li>

            
                <li class="slide {{ Request::is('admin/testimonials*') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="side-menu__icon fas fa-users"></i>
                        <span class="side-menu__label">Testimonials</span>
                        <i class="angle fe fe-chevron-down hor-angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Testimonials</a></li>
                        <li><a class="slide-item {{ Request::is('admin/testimonials/create') ? 'active' : '' }}"
                                href="{{ route('admin.testimonial.create') }}">Testimonials Add</a></li>
                        <li><a class="slide-item {{ Request::is('admin/testimonials/index') ? 'active' : '' }}"
                                href="{{ route('admin.testimonial.index') }}">Testimonials List</a></li>
                    </ul>
                </li>


                <li class="slide {{ Request::is('admin/counters*') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="side-menu__icon fas fa-building"></i>
                        <span class="side-menu__label">Counters</span>
                        <i class="angle fe fe-chevron-down hor-angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Counters</a></li>
                        <li><a class="slide-item {{ Request::is('admin/counter/create') ? 'active' : '' }}"
                                href="{{ route('admin.counter.create') }}">Counter Add</a></li>
                        <li><a class="slide-item {{ Request::is('admin/counter/store') ? 'active' : '' }}"
                                href="{{ route('admin.counter.index') }}">Counter List</a></li>
                    </ul>
                </li>
                <li class="slide {{ Request::is('admin/service*') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="side-menu__icon fas fa fa-ambulance"></i>
                        <span class="side-menu__label">Services</span>
                        <i class="angle fe fe-chevron-down hor-angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Services</a></li>
                        <li><a class="slide-item {{ Request::is('admin/service/create') ? 'active' : '' }}"
                                href="{{ route('admin.service.create') }}">Service Add</a></li>
                        <li><a class="slide-item {{ Request::is('admin/service/store') ? 'active' : '' }}"
                                href="{{ route('admin.service.index') }}">Service List</a></li>
                    </ul>
                </li>

                <li class="slide {{ Request::is('admin/gallery*') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="side-menu__icon fas fa fa-ambulance"></i>
                        <span class="side-menu__label">Gallery</span>
                        <i class="angle fe fe-chevron-down hor-angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Gallery</a></li>
                        <li><a class="slide-item {{ Request::is('admin/gallery/create') ? 'active' : '' }}"
                                href="{{ route('admin.gallery.create') }}">Gallery Add</a></li>
                        <li><a class="slide-item {{ Request::is('admin/gallery/store') ? 'active' : '' }}"
                                href="{{ route('admin.gallery.index') }}">Gallery List</a></li>
                    </ul>
                </li>


                <li class="slide {{ Request::is('admin/settings*') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="side-menu__icon fas fa-cog"></i>
                        <span class="side-menu__label">Advance Settings</span>
                        <i class="angle fe fe-chevron-down hor-angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Advance Settings</a></li>
                        <li><a class="slide-item {{ Request::is('admin/settings/index') ? 'active' : '' }}"
                                href="{{ route('admin.settings.index') }}">Manage Setting</a></li>
                    </ul>
                </li>

            </ul>

            <div class="slide-right" id="slide-right">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg>
            </div>
        </div>
    </aside>
</div>
