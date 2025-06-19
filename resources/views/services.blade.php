<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ session('dir', 'ltr') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('home.services.title') }} - {{ trans('home.site_title') }}</title>    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mobile-nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth-button.css') }}">
</head>
<body>
    <header>
        <nav>
            <div class="nav-content">
                <div class="logo">
                    <img src="{{ asset('images/logo/logo-bb-removebg.png') }}" alt="Bora Fishing Logo" class="logo-img">
                </div>
                <ul class="nav-links">
                    <li><a href="{{ url('/') }}"><i class="fas fa-home"></i> {{ __('menu.home') }}</a></li>
                    <li><a href="{{ url('/services') }}" class="active"><i class="fas fa-concierge-bell"></i> {{ __('menu.services') }}</a></li>
                    <li><a href="{{ url('/about') }}"><i class="fas fa-info-circle"></i> {{ __('menu.about') }}</a></li>
                    <li><a href="{{ url('/reservation') }}"><i class="fas fa-envelope"></i> {{ __('menu.contact') }}</a></li>
                    <li><a href="{{ route('login') }}" class="mobile-auth-button"><i class="fas fa-sign-in-alt"></i> {{ __('menu.login') }}</a></li>
                </ul>
                
                <div class="language-switcher">
                    <select id="languageSelect" onchange="window.location.href=this.value">
                        <option value="{{ route('language.switch', 'en') }}" {{ Session::get('locale') == 'en' ? 'selected' : '' }}>🇬🇧 English</option>
                        <option value="{{ route('language.switch', 'fr') }}" {{ Session::get('locale') == 'fr' ? 'selected' : '' }}>🇫🇷 Français</option>
                        <option value="{{ route('language.switch', 'ar') }}" {{ Session::get('locale') == 'ar' ? 'selected' : '' }}>🇸🇦 العربية</option>
                        <option value="{{ route('language.switch', 'es') }}" {{ Session::get('locale') == 'es' ? 'selected' : '' }}>🇪🇸 Español</option>
                    </select>                </div>

                <a href="{{ route('login') }}" class="auth-button">
                    <i class="fas fa-sign-in-alt"></i> {{ __('menu.login') }}
                </a>
                
                <button class="mobile-menu" aria-label="Menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </nav>
    </header>

    <main>
        <!-- Hero Section for Services -->
        <section class="hero services-hero">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <h1 class="fade-in">{{ __('home.services.title') }}</h1>
                <p class="fade-in-delay-1">{{ __('home.hero_description') }}</p>
            </div>
        </section>

        <!-- Services Section -->
        <section id="services" class="services">
            <div class="services-container">
                <!-- Fishing Tours -->
                <div class="service-category fade-in">
                    <h3><i class="fas fa-fish"></i> {{ __('home.services.fishing_tours.title') }}</h3>
                    <div class="services-grid">
                        <!-- Half Day Fishing -->
                        <div class="service-card" data-aos="fade-up">
                            <img src="{{ asset('images/gallery/bora1.jpg') }}" alt="Half Day Fishing">
                            <div class="service-content">
                                <h4>{{ __('home.services.fishing_tours.half_day.title') }}</h4>
                                <p>{{ __('home.services.fishing_tours.half_day.description') }}</p>
                                <ul class="service-details">
                                    <li><i class="fas fa-clock"></i> {{ __('home.services.fishing_tours.half_day.duration') }}</li>
                                    <li><i class="fas fa-users"></i> {{ __('home.services.fishing_tours.half_day.capacity') }}</li>
                                    <li><i class="fas fa-tag"></i> {{ __('home.services.fishing_tours.half_day.price') }}</li>
                                </ul>
                                <a href="{{ route('reservation') }}" class="book-button">{{ __('home.book_adventure') }}</a>
                            </div>
                        </div>

                        <!-- Family Fishing -->
                        <div class="service-card" data-aos="fade-up" data-aos-delay="100">
                            <img src="{{ asset('images/gallery/bora4.jpg') }}" alt="Family Fishing">
                            <div class="service-content">
                                <h4>{{ __('home.services.fishing_tours.family.title') }}</h4>
                                <p>{{ __('home.services.fishing_tours.family.description') }}</p>
                                <ul class="service-details">
                                    <li><i class="fas fa-clock"></i> {{ __('home.services.fishing_tours.family.duration') }}</li>
                                    <li><i class="fas fa-users"></i> {{ __('home.services.fishing_tours.family.capacity') }}</li>
                                    <li><i class="fas fa-tag"></i> {{ __('home.services.fishing_tours.family.price') }}</li>
                                </ul>
                                <a href="{{ route('reservation') }}" class="book-button">{{ __('home.book_adventure') }}</a>
                            </div>
                        </div>

                        <!-- Sport Fishing -->
                        <div class="service-card" data-aos="fade-up" data-aos-delay="200">
                            <img src="{{ asset('images/gallery/bora5.jpg') }}" alt="Sport Fishing">
                            <div class="service-content">
                                <h4>{{ __('home.services.fishing_tours.sport.title') }}</h4>
                                <ul class="feature-list">
                                    @foreach(__('home.services.fishing_tours.sport.features') as $feature)
                                        <li><i class="fas fa-check"></i> {{ $feature }}</li>
                                    @endforeach
                                </ul>
                                <a href="{{ route('reservation') }}" class="book-button">{{ __('home.book_adventure') }}</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Excursions -->
                <div class="service-category fade-in-delay-1">
                    <h3><i class="fas fa-umbrella-beach"></i> {{ __('home.services.excursions.title') }}</h3>
                    <div class="services-grid">
                        <!-- Private Tour -->
                        <div class="service-card" data-aos="fade-up" data-aos-delay="300">
                            <img src="{{ asset('images/gallery/bora3.jpg') }}" alt="Private Tour">
                            <div class="service-content">
                                <h4>{{ __('home.services.excursions.private_tour.title') }}</h4>
                                <ul class="feature-list">
                                    @foreach(__('home.services.excursions.private_tour.features') as $feature)
                                        <li><i class="fas fa-check"></i> {{ $feature }}</li>
                                    @endforeach
                                </ul>
                                <a href="{{ route('reservation') }}" class="book-button">{{ __('home.book_adventure') }}</a>
                            </div>
                        </div>

                        <!-- Island Transfers -->
                        <div class="service-card" data-aos="fade-up" data-aos-delay="400">
                            <img src="{{ asset('images/gallery/bora6.jpg') }}" alt="Island Transfers">
                            <div class="service-content">
                                <h4>{{ __('home.services.excursions.transfers.title') }}</h4>
                                <p>{{ __('home.services.excursions.transfers.description') }}</p>
                                <ul class="feature-list">
                                    @foreach(__('home.services.excursions.transfers.features') as $feature)
                                        <li><i class="fas fa-check"></i> {{ $feature }}</li>
                                    @endforeach
                                </ul>
                                <a href="{{ route('reservation') }}" class="book-button">{{ __('home.book_adventure') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- Fixed Contact Button -->
    <a href="#" class="fixed-contact-btn">
        <i class="fas fa-comment-dots"></i>
        <span>{{ __('home.footer.contact_us') }}</span>
    </a>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle
            const mobileMenu = document.querySelector('.mobile-menu');
            const navLinks = document.querySelector('.nav-links');
            
            mobileMenu.addEventListener('click', function() {
                navLinks.classList.toggle('active');
                this.classList.toggle('active');
            });

            // Initialize AOS
            AOS.init({
                duration: 800,
                offset: 100,
                once: true
            });
        });
    </script>
</body>
</html>
