<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ session('dir', 'ltr') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('home.reservation.title') }} - {{ trans('home.site_title') }}</title>    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                    <li><a href="{{ url('/services') }}"><i class="fas fa-concierge-bell"></i> {{ __('menu.services') }}</a></li>
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
        <section class="reservation-section">
            <div class="reservation-container">
                <h1 class="section-title">{{ __('home.reservation.title') }}</h1>
                  @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-circle"></i>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('reservation.store') }}" method="POST" class="reservation-form">
                    @csrf                    <div class="form-group">
                        <label for="name"><i class="fas fa-user"></i> {{ __('home.reservation.name') }}</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="John Doe">
                    </div>

                    <div class="form-group">
                        <label for="email"><i class="fas fa-envelope"></i> {{ __('home.reservation.email') }}</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="john@example.com">
                    </div>

                    <div class="form-group">
                        <label for="phone"><i class="fas fa-phone"></i> {{ __('home.reservation.phone') }}</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required placeholder="+1 234 567 8900">
                    </div>

                    <div class="form-group">
                        <label for="tour_type"><i class="fas fa-ship"></i> {{ __('home.reservation.tour_type') }}</label>
                        <select id="tour_type" name="tour_type" required>
                            <option value="">{{ __('home.reservation.select_tour') }}</option>
                            <option value="half_day" {{ old('tour_type') == 'half_day' ? 'selected' : '' }}>{{ __('home.services.fishing_tours.half_day.title') }}</option>
                            <option value="family" {{ old('tour_type') == 'family' ? 'selected' : '' }}>{{ __('home.services.fishing_tours.family.title') }}</option>
                            <option value="sport" {{ old('tour_type') == 'sport' ? 'selected' : '' }}>{{ __('home.services.fishing_tours.sport.title') }}</option>
                            <option value="private_tour" {{ old('tour_type') == 'private_tour' ? 'selected' : '' }}>{{ __('home.services.excursions.private_tour.title') }}</option>
                            <option value="transfers" {{ old('tour_type') == 'transfers' ? 'selected' : '' }}>{{ __('home.services.excursions.transfers.title') }}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="date"><i class="fas fa-calendar"></i> {{ __('home.reservation.date') }}</label>
                        <input type="date" id="date" name="date" value="{{ old('date') }}" required min="{{ date('Y-m-d') }}">
                    </div>

                    <div class="form-group">
                        <label for="guests"><i class="fas fa-users"></i> {{ __('home.reservation.guests') }}</label>
                        <input type="number" id="guests" name="guests" value="{{ old('guests') }}" required min="1" max="6" placeholder="1-6 guests">
                    </div>

                    <div class="form-group full-width">
                        <label for="message"><i class="fas fa-comment"></i> {{ __('home.reservation.message') }}</label>
                        <textarea id="message" name="message" rows="4" placeholder="Tell us about any special requirements or questions">{{ old('message') }}</textarea>
                    </div>

                    <button type="submit" class="submit-btn">
                        <i class="fas fa-paper-plane"></i> {{ __('home.reservation.submit') }}
                    </button>
                </form>
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
