<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Clean Blog - Start Bootstrap Theme</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link rel="stylesheet" href="{{ asset('bootsrap/styles/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/styles.css') }}" />
        <style>
            svg{
                width: 20px;
            }
        </style>
    </head>
    <body>
        
        <!-- Navbar with Language Dropdown -->
        <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
            <div class="container px-4 px-lg-5">
                <!-- Logo Section -->
                <a class="navbar-brand" href="index.html">
                    <!-- Dynamically load the logo from the uploads folder -->
                    <img src="{{ asset('uploads/'.$setting->logo) }}" width="60px" alt="Blog Postt">
                </a>

                <!-- Toggle button for mobile view -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Collapsible content (navigation links and language dropdown) -->
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto py-4 py-lg-0">
                        <!-- Home link, translation key: 'messages.home' -->
                        <li class="nav-item">
                            <a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('home') }}">{{ __('messages.home') }}</a>
                        </li>
                        
                        <!-- About link, translation key: 'messages.about' -->
                        <li class="nav-item">
                            <a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('about') }}">{{ __('messages.about') }}</a>
                        </li>

                        <!-- Sample Post link, translation key: 'messages.sample_post' -->
                        <li class="nav-item">
                            <a class="nav-link px-lg-3 py-3 py-lg-4" href="post.html">{{ __('messages.sample_post') }}</a>
                        </li>

                        <!-- Contact link, translation key: 'messages.contact' -->
                        <li class="nav-item">
                            <a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('contact') }}">{{ __('messages.contact') }}</a>
                        </li>

                        <!-- Language dropdown menu -->
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle px-lg-3 py-3 py-lg-4" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <!-- The translation key for 'Language' in both languages -->
                                {{ __('messages.language') }}
                            </a>
                            
                            <!-- Dropdown options for English and Dari -->
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <!-- Language switch link for English -->
                                <li><a class="dropdown-item" href="{{ url('lang/en') }}">English</a></li>

                                <!-- Language switch link for Dari -->
                                <li><a class="dropdown-item" href="{{ url('lang/dr') }}">Dari</a></li>
                                {{-- <li><a class="dropdown-item" href="{{ route('locale',['locale'=>'dr'])) }}">Dari</a></li> --}}
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        
        @yield('content')

<!-- Footer-->
        <footer class="border-top">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <ul class="list-inline text-center">
                            @if($setting->twitter)
                            <li class="list-inline-item">
                                <a href="#!">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            @endif

                            @if($setting->facebook)
                            <li class="list-inline-item">
                                <a href="#!">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            @endif
                        </ul>
                        <div class="small text-center text-muted fst-italic">Copyright &copy; Your Website 2023</div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        {{-- <script src="{{ asset('bootsrap/scripts/bootstrap.bundle.min.js') }}"></script> --}}
        <!-- Core theme JS-->
        <script src="{{ asset('bootsrap/scripts/bootstrap.bundle.min.js') }}"></script>
        {{-- <script src="{{ asset('frontend/js/scripts.js') }}"></script> --}}
        
</body>
</html>
