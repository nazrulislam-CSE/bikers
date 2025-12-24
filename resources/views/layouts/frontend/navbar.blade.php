@php
    $menuitems = App\Models\Menuitem::with(['subMenus.childMenus'])
        ->whereNull('parent_id')
        ->whereHas('get_menu', function ($query) {
            $query->where('location', 'main_header');
        })
        ->orderby('position', 'asc')
        ->get();
    $currentUrl = request()->url();
@endphp
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('frontend.home') }}">
                <img src="{{ asset(get_setting('site_logo')->value ?? 'frontend/img/logo/logo.jpg') }}"
                    alt="Cox’s Bazar Baitush Sharaf Hospital" style="height: 50px; width: auto; margin-right: 10px" />
                <span class="fw-bold text-dark hospital-name">{{ get_setting('business_name')->value ?? '' }}</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item me-3">
                        <button class="header-button">Cataract Surgery Packages</button>
                    </li>
                    <li class="nav-item me-3">
                        <div class="social-icons">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="search-icon" href="#"><i class="fas fa-search"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light main-navbar sticky-top">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav">
                    @foreach ($menuitems as $menuitem)
                        @php
                            $hasSubMenu = count($menuitem->subMenus) > 0;
                            $hasChildMenu = $menuitem->subMenus->contains(function ($sub) {
                                return count($sub->childMenus) > 0;
                            });

                            $menuUrl =
                                $menuitem->url == 'home-page'
                                    ? route('frontend.home')
                                    : route('menu.page', $menuitem->url);
                            $isActive = $currentUrl == $menuUrl ? 'active' : '';
                        @endphp

                        <li class="nav-item {{ $hasSubMenu ? 'dropdown' : '' }} {{ $isActive }}">
                            <a class="nav-link {{ $hasSubMenu ? 'dropdown-toggle' : '' }}" href="{{ $menuUrl }}"
                                {{ $hasSubMenu ? 'data-bs-toggle=dropdown' : '' }}>
                                {{ $menuitem->title ?? '' }}
                                @if ($hasSubMenu)
                                    <i class="fas fa-chevron-down ms-1"></i>
                                @endif
                            </a>

                            @if ($hasSubMenu)
                                <ul class="dropdown-menu">
                                    @foreach ($menuitem->subMenus as $subMenu)
                                        @php
                                            $subHasChild = count($subMenu->childMenus) > 0;
                                            $subUrl = route('menu.page', $subMenu->url);
                                            $subActive = $currentUrl == $subUrl ? 'active' : '';
                                        @endphp

                                        <li class="{{ $subHasChild ? 'dropdown-submenu' : '' }} {{ $subActive }}">
                                            <a class="dropdown-item {{ $subHasChild ? 'dropdown-toggle' : '' }}"
                                                href="{{ $subUrl }}"
                                                {{ $subHasChild ? 'data-bs-toggle=dropdown' : '' }}>
                                                {{ $subMenu->title ?? '' }}
                                                @if ($subHasChild)
                                                    <i class="fas fa-chevron-right ms-1"></i>
                                                @endif
                                            </a>

                                            @if ($subHasChild)
                                                <ul class="dropdown-menu">
                                                    @foreach ($subMenu->childMenus as $child)
                                                        @php
                                                            $childUrl = route('menu.page', $child->url);
                                                            $childActive = $currentUrl == $childUrl ? 'active' : '';
                                                        @endphp
                                                        <li class="{{ $childActive }}">
                                                            <a class="dropdown-item" href="{{ $childUrl }}">
                                                                {{ $child->title ?? '' }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>
</header>

<!-- Marquee Section -->
<section class="marquee-section">
    <div class="container">
        <div class="marquee-container">
            <div class="marquee-content">
                @php
                    $breakingNews = get_setting('breaking_news')->value ?? '';
                @endphp

                @if($breakingNews)
                    <i class="fas fa-bullhorn me-2"></i> {{ $breakingNews }}
                    &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                @endif
            </div>
        </div>
    </div>
</section>
