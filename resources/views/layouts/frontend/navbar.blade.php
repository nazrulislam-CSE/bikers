 <header id="header-top" class="top-header">
     <div class="container">
         <div class="top-header__main wow slideInDown" data-wow-delay="0.7s" data-wow-duration="1.5s">
             <div class="row">
                 <div class="col-xs-4">
                     <div class="social social--top clearfix">
                         <a href="#" class="social__one square">
                             <span class="fa fa-twitter"></span>
                         </a>
                         <a href="#" class="social__one square">
                             <span class="fa fa-facebook"></span>
                         </a>
                         <a href="#" class="social__one square">
                             <span class="fa fa-google-plus"></span>
                         </a>
                         <a href="#" class="social__one square">
                             <span class="fa fa-pinterest"></span>
                         </a>
                         <a href="#" class="social__one square">
                             <span class="fa fa-instagram"></span>
                         </a>
                     </div>
                 </div>
                 <div class="col-xs-8">
                     <div class="header-contacts clearfix">
                         <div class="header-contacts__one">
                             <a href="contacts.html" class="header-contacts__phone square">
                                 <span class="fa fa-phone"></span>
                             </a>
                             <a href="contacts.html" class="header-contacts__link">01316017328</a>
                         </div>
                         <div class="header-contacts__one">
                             <a href="contacts.html" class="header-contacts__email square">
                                 <span class="fa fa-envelope"></span>
                             </a>
                             <a href="contacts.html" class="header-contacts__link">bbykersociety@gmail.com</a>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </header><!--top-header-->

 <nav class="top-nav">
     <div class="container">
         <div class="top-nav__main">
             <div class="row">
                 <div class="col-md-3 col-xs-12">
                     <a href="{{ route('frontend.home') }}" class="logo">
                         <span class="logo__moto">
                             <img src="{{ asset('frontend/images/svg/logo.svg') }}" alt="logo">
                         </span>
                         <h2 class="logo__title">
                             BIKER<span>Club</span>
                         </h2>
                     </a>
                 </div>
                 <div class="col-md-9 col-xs-12">
                     <div class="main-nav navbar-main-slide">
                         <a href="#" class="btn_header_search main-nav__search no-decoration">
                             <span class="fa fa-search"></span>
                         </a>
                         <div class="navbar-header">
                             <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav">
                                 <span class="sr-only">Toggle navigation</span>
                                 <span class="icon-bar"></span>
                                 <span class="icon-bar"></span>
                                 <span class="icon-bar"></span>
                             </button>
                         </div>
                         <ul class="collapse navbar-collapse navbar-nav-menu" id="nav">
                             <li class="dropdown">
                                 <a class="no-decoration dropdown-toggle" data-toggle="dropdown"
                                     href="home-main.html">Home <i class="fa fa-angle-down"></i></a>
                                 <span class="main-nav__separator"><span></span><span></span><span></span></span>
                                 <ul class="dropdown-menu">
                                     <li><a href="home-main.html">Home 1</a></li>
                                     <li class="dropdown submenu-item">
                                         <a href="#">Home 2 <i class="fa fa-angle-down"></i></a>
                                         <ul class="dropdown-menu">
                                             <li><a href="#">Home 2.1</a></li>
                                             <li><a href="#">Home 2.2</a></li>
                                             <li><a href="#">Home 2.3</a></li>
                                             <li><a href="#">Home 2.4</a></li>
                                         </ul>
                                     </li>
                                     <li><a href="home2.html">Home 3</a></li>
                                 </ul>
                             </li>
                             <li><a class="no-decoration" href="about.html">About us</a><span
                                     class="main-nav__separator"><span></span><span></span><span></span></span></li>
                             <li><a class="no-decoration" href="article.html">Services</a><span
                                     class="main-nav__separator"><span></span><span></span><span></span></span></li>
                             <li><a class="no-decoration" href="blog.html">Blog</a><span
                                     class="main-nav__separator"><span></span><span></span><span></span></span></li>
                             <li><a class="no-decoration" href="contacts.html">Contact</a><span
                                     class="main-nav__separator"><span></span><span></span><span></span></span></li>
                             <li><a class="no-decoration" href="shop.html">Shop</a></li>
                                @if(Auth::guard('admin')->check())
                                    {{-- Admin logged in --}}
                                    <li>
                                        <a class="no-decoration" href="{{ route('admin.admin.home') }}">
                                            Dashboard
                                        </a>
                                    </li>

                                @elseif(Auth::check())
                                    {{-- Normal user logged in --}}
                                    <li>
                                        <a class="no-decoration" href="{{ route('user.home') }}">
                                            Dashboard
                                        </a>
                                    </li>

                                @else
                                    {{-- Nobody logged in --}}
                                    <li><a class="no-decoration" href="{{ route('login') }}">Login</a></li>
                                    <li><a class="no-decoration" href="{{ route('register') }}">Register</a></li>
                                @endif
                         </ul>
                         <div class="search-form-modal transition">
                             <form class="navbar-form header_search_form">
                                 <i class="fa fa-times search-form_close"></i>
                                 <div class="form-group">
                                     <input type="text" class="form-control" placeholder="Search">
                                 </div>
                                 <button type="submit" class="btn btn_search customBgColor">Search</button>
                             </form>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </nav><!--top-nav-->
