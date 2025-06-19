<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ session('dir', 'ltr') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('menu.about') }} - {{ trans('home.site_title') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mobile-nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth-button.css') }}">
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
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
                    <li><a href="{{ url('/services') }}"><i class="fas fa-concierge-bell"></i> {{ __('menu.services') }}</a></li>
                    <li><a href="{{ url('/about') }}" class="active"><i class="fas fa-info-circle"></i> {{ __('menu.about') }}</a></li>
                    <li><a href="{{ url('/reservation') }}"><i class="fas fa-envelope"></i> {{ __('menu.contact') }}</a></li>
                    <li><a href="{{ route('login') }}" class="mobile-auth-button"><i class="fas fa-sign-in-alt"></i> {{ __('menu.login') }}</a></li>
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
        <section class="hero-section">
            <div class="hero-content">
                <h1>{{ __('about.welcome') }}</h1>
                <p>{{ __('about.hero_description') }}</p>
            </div>
        </section>

        <section class="about-section">
            <div class="container">
                <div class="about-grid">
                    <div class="about-image">
                        <img src="{{ asset('../images/gallery/bora3.jpg') }}" alt="Fishing Experience">
                    </div>
                    <div class="about-content">
                        <h2>{{ __('about.our_story.title') }}</h2>
                        <p>{{ __('about.our_story.description') }}</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="values-section">
            <div class="container">
                <h2>{{ __('about.our_values.title') }}</h2>
                <div class="values-grid">
                    <div class="value-card">
                        <i class="fas fa-fish"></i>
                        <h3>{{ __('about.our_values.sustainable.title') }}</h3>
                        <p>{{ __('about.our_values.sustainable.description') }}</p>
                    </div>
                    <div class="value-card">
                        <i class="fas fa-heart"></i>
                        <h3>{{ __('about.our_values.passion.title') }}</h3>
                        <p>{{ __('about.our_values.passion.description') }}</p>
                    </div>
                    <div class="value-card">
                        <i class="fas fa-users"></i>
                        <h3>{{ __('about.our_values.community.title') }}</h3>
                        <p>{{ __('about.our_values.community.description') }}</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="team-section">
            <div class="container">
                <h2>{{ __('about.our_team.title') }}</h2>
                <div class="team-grid">
                    <div class="team-member">
                        <img src="{{ asset('images/gallery/captain.jpg') }}" alt="Captain">
                        <h3>{{ __('about.our_team.captain.name') }}</h3>
                        <p class="role">{{ __('about.our_team.captain.role') }}</p>
                        <p>{{ __('about.our_team.captain.description') }}</p>
                    </div>
                    <div class="team-member">
                        <img src="{{ asset('images/gallery/guide.jpg') }}" alt="Fishing Guide">
                        <h3>{{ __('about.our_team.guide.name') }}</h3>
                        <p class="role">{{ __('about.our_team.guide.role') }}</p>
                        <p>{{ __('about.our_team.guide.description') }}</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="cta-section">
            <div class="container">
                <h2>{{ __('about.join_us.title') }}</h2>
                <p>{{ __('about.join_us.description') }}</p>
                <a href="{{ url('/reservation') }}" class="cta-button">
                    <i class="fas fa-calendar-alt"></i> {{ __('about.join_us.cta_button') }}
                </a>
            </div>
        </section>
    </main>

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
                    <li><a href="{{ url('/about') }}"><i class="fas fa-info-circle"></i> {{ __('menu.about') }}</a></li>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle
            const mobileMenu = document.querySelector('.mobile-menu');
            const navLinks = document.querySelector('.nav-links');
            
            mobileMenu.addEventListener('click', function() {
                navLinks.classList.toggle('active');
                this.classList.toggle('active');
            });
        });
    </script>
</body>
</html>
