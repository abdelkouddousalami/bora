<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ session('dir', 'ltr') }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ trans('home.site_title') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                    <img src="{{ asset('images/logo/logo-bb-removebg.png') }}" alt="FishPro Logo" class="logo-img">
                </div>
                <ul class="nav-links">
                    <li><a href="{{ url('/') }}" class="active"><i class="fas fa-home"></i> {{ __('menu.home') }}</a></li>
                    <li><a href="{{ url('/services') }}"><i class="fas fa-concierge-bell"></i> {{ __('menu.services') }}</a></li>
                    <li><a href="{{ url('/about') }}"><i class="fas fa-info-circle"></i> {{ __('menu.about') }}</a></li>
                    <li><a href="{{ url('/reservation') }}"><i class="fas fa-envelope"></i> {{ __('menu.contact') }}</a></li>
                    <li><a href="{{ route('login') }}" class="mobile-auth-button"><i class="fas fa-sign-in-alt"></i> {{ __('menu.login') }}</a></li>
                </ul>
                </ul>

                <div class="language-switcher">
                    <select id="languageSelect" onchange="window.location.href=this.value">
                        <option value="{{ route('language.switch', 'en') }}" {{ Session::get('locale') == 'en' ? 'selected' : '' }}>🇬🇧 English</option>
                        <option value="{{ route('language.switch', 'fr') }}" {{ Session::get('locale') == 'fr' ? 'selected' : '' }}>🇫🇷 Français</option>
                        <option value="{{ route('language.switch', 'ar') }}" {{ Session::get('locale') == 'ar' ? 'selected' : '' }}>🇸🇦 العربية</option>
                        <option value="{{ route('language.switch', 'es') }}" {{ Session::get('locale') == 'es' ? 'selected' : '' }}>🇪🇸 Español</option>
                    </select>
                </div>

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
        <section class="hero">
            <video class="hero-video" autoplay muted loop playsinline>
                <source src="{{ asset('images/banners/hero.mp4') }}" type="video/mp4">
            </video>
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <h1 class="fade-in">{{ __('home.hero_title') }}</h1>
                <h2 class="hero-subtitle fade-in-delay-1">{{ __('home.hero_subtitle') }}</h2>
                <p class="fade-in-delay-2">{{ __('home.hero_description') }}</p>
                <div class="hero-buttons fade-in-delay-2">
                    <a href="{{ url('/services') }}" class="cta-button primary">{{ __('home.explore_tours') }}</a>
                    <a href="{{ route('reservation') }}" class="cta-button secondary">{{ __('home.book_adventure') }}</a>
                </div>
            </div>
        </section>

        <section id="gallery" class="gallery">
            <h2>{{ __('home.gallery_title') }}</h2>
            <div class="gallery-grid">
                <div class="gallery-item">
                    <img src="{{ asset('images/gallery/bora1.jpg') }}" alt="{{ __('home.gallery.catch.alt') }}">
                    <div class="gallery-overlay">
                        <h3>{{ __('home.gallery.catch.title') }}</h3>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('images/gallery/bora3.jpg') }}" alt="{{ __('home.gallery.equipment.alt') }}">
                    <div class="gallery-overlay">
                        <h3>{{ __('home.gallery.equipment.title') }}</h3>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('images/gallery/bora4.jpg') }}" alt="{{ __('home.gallery.lake.alt') }}">
                    <div class="gallery-overlay">
                        <h3>{{ __('home.gallery.lake.title') }}</h3>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('images/gallery/bora5.jpg') }}" alt="{{ __('home.gallery.sunset.alt') }}">
                    <div class="gallery-overlay">
                        <h3>{{ __('home.gallery.sunset.title') }}</h3>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('images/gallery/bora6.jpg') }}" alt="{{ __('home.gallery.ice.alt') }}">
                    <div class="gallery-overlay">
                        <h3>{{ __('home.gallery.ice.title') }}</h3>
                    </div>
                </div>
            </div>
        </section>


        <section class="about-us">
            <div class="about-content">
                <div class="about-text">
                    <h2 class="fade-in">{{ __('home.about.title') }}</h2>
                    <h3 class="about-subtitle fade-in-delay-1">{{ __('home.about.subtitle') }}</h3>
                    <p class="fade-in-delay-2">{{ __('home.about.description') }}</p>
                </div>
                <div class="about-stats fade-in-delay-3">
                    <div class="stat-item">
                        <span class="stat-number">10+</span>
                        <span class="stat-label">{{ __('home.about.experience') }}</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">15</span>
                        <span class="stat-label">{{ __('home.about.locations') }}</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">2K+</span>
                        <span class="stat-label">{{ __('home.about.clients') }}</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">12</span>
                        <span class="stat-label">{{ __('home.about.boats') }}</span>
                    </div>
                </div>
            </div>
        </section>

        <footer class="site-footer">
            <div class="footer-content">
                <div class="footer-section">
                    <h4>Bora Fishing</h4>
                    <p>{{ __('home.footer.company_description') }}</p>
                </div>
                <div class="footer-section">
                    <h4>{{ __('home.footer.quick_links') }}</h4>
                    <ul>
                        <li><a href="{{ url('/') }}"><i class="fas fa-home"></i> {{ __('menu.home') }}</a></li>
                        <li><a href="{{ url('/services') }}"><i class="fas fa-concierge-bell"></i> {{ __('menu.services') }}</a></li>
                        <li><a href="#"><i class="fas fa-info-circle"></i> {{ __('menu.about') }}</a></li>
                        <li><a href="#"><i class="fas fa-envelope"></i> {{ __('menu.contact') }}</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>{{ __('home.footer.contact_us') }}</h4>
                    <p><i class="fas fa-envelope"></i> {{ __('home.footer.contact_email') }}</p>
                    <p><i class="fas fa-phone"></i> {{ __('home.footer.contact_phone') }}</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>{{ __('home.footer.copyright') }}</p>
            </div>
        </footer>
    </main>
    <!-- Fixed Contact Button -->
    <a href="#" class="fixed-contact-btn">
        <i class="fas fa-comment-dots"></i>
        <span>{{ __('home.footer.contact_us') }}</span>
    </a>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenu = document.querySelector('.mobile-menu');
            const navLinks = document.querySelector('.nav-links');

            mobileMenu.addEventListener('click', function() {
                navLinks.classList.toggle('active');
                this.classList.toggle('active');
            });
        });

        // Initialize AOS
        AOS.init({
            duration: 800,
            offset: 100,
            once: true
        });
    </script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
</body>

</html>