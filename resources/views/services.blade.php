<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ session('dir', 'ltr') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('home.services.title') }} - {{ trans('home.site_title') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mobile-nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth-button.css') }}">
    <link rel="stylesheet" href="{{ asset('css/services.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tours.css') }}">
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
    </header>    <main>
        <div class="services-page">
            <!-- Hero Section -->
            <div class="services-hero" data-aos="fade">
                <div class="hero-content">                    <h1>{{ __('services.title') }}</h1>
                    <p>{{ __('services.subtitle') }}</p>
                    @if($isAdmin)
                        <a href="{{ route('admin.services.create') }}" class="btn btn-gold">
                            <i class="fas fa-plus"></i> Add New Service
                        </a>
                    @endif
                </div>
            </div>            <!-- Categories Section -->
            <div class="services-container">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <!-- Fishing Tours Section -->
                <section class="service-category" data-aos="fade-up">
                    <h2><i class="fas fa-fish"></i> {{ __('services.categories.fishing') }}</h2>
                    @if($isAdmin)
                        <div class="admin-controls mb-4">
                            <a href="{{ route('admin.tours.create') }}" class="btn-gold">
                                <i class="fas fa-plus"></i> {{ __('dashboard.add_new_tour') }}
                            </a>
                        </div>
                    @endif
                    <div class="services-grid">
                        @forelse($fishingTours as $tour)
                            <div class="service-card">
                                <div class="service-image" style="background-image: url('{{ $tour->image ? asset('storage/' . $tour->image) : asset('images/services/default-fishing.jpg') }}')"></div>
                                <div class="service-content">
                                    <h3>{{ $tour->name }}</h3>
                                    <p>{{ $tour->description }}</p>
                                    <ul class="features-list">
                                        @if($tour->duration)
                                            <li><i class="far fa-clock"></i> {{ $tour->duration }}</li>
                                        @endif
                                        @if($tour->capacity)
                                            <li><i class="fas fa-users"></i> {{ $tour->capacity }}</li>
                                        @endif
                                        @if($tour->features && is_array($tour->features))
                                            @foreach($tour->features as $feature)
                                                <li><i class="fas fa-check"></i> {{ $feature }}</li>
                                            @endforeach
                                        @endif
                                    </ul>
                                    <div class="service-footer">
                                        <div class="service-price">
                                            {{ number_format($tour->price, 2) }} € 
                                            @if($tour->price_type === 'per_person')
                                                <small>/ {{ __('services.per_person') }}</small>
                                            @endif
                                        </div>
                                        <a href="{{ route('reservation') }}" class="btn-reserve">
                                            <i class="fas fa-calendar-check"></i>
                                            {{ __('services.reserve') }}
                                        </a>
                                        @if($isAdmin)
                                            <div class="admin-controls">
                                                <a href="{{ route('admin.tours.edit', $tour->id) }}" class="btn btn-sm btn-primary" title="{{ __('dashboard.edit_tour') }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.tours.destroy', $tour->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="{{ __('dashboard.delete_tour') }}"
                                                            onclick="return confirm('{{ __('dashboard.confirm_delete') }}')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="no-tours-message">
                                <i class="fas fa-fish"></i>
                                <p>{{ __('services.no_tours_available') }}</p>
                                @if($isAdmin)
                                    <a href="{{ route('admin.tours.create') }}" class="btn-gold">
                                        <i class="fas fa-plus"></i> {{ __('dashboard.add_first_tour') }}
                                    </a>
                                @endif
                            </div>
                        @endforelse
                    </div>
                </section>

                <!-- Excursions Section -->
                <section class="service-category" data-aos="fade-up">
                    <h2><i class="fas fa-compass"></i> {{ __('services.categories.excursions') }}</h2>
                    @if($isAdmin)
                        <div class="admin-controls mb-4">
                            <a href="{{ route('admin.tours.create', ['category' => 'excursion']) }}" class="btn-gold">
                                <i class="fas fa-plus"></i> {{ __('dashboard.add_new_excursion') }}
                            </a>
                        </div>
                    @endif
                    <div class="services-grid">
                        @forelse($excursions as $tour)
                            <div class="service-card">
                                <div class="service-image" style="background-image: url('{{ $tour->image ? asset('storage/' . $tour->image) : asset('images/services/default-excursion.jpg') }}')"></div>
                                <div class="service-content">
                                    <h3>{{ $tour->name }}</h3>
                                    <p>{{ $tour->description }}</p>
                                    <ul class="features-list">
                                        @if($tour->duration)
                                            <li><i class="far fa-clock"></i> {{ $tour->duration }}</li>
                                        @endif
                                        @if($tour->capacity)
                                            <li><i class="fas fa-users"></i> {{ $tour->capacity }}</li>
                                        @endif
                                        @if($tour->features && is_array($tour->features))
                                            @foreach($tour->features as $feature)
                                                <li><i class="fas fa-check"></i> {{ $feature }}</li>
                                            @endforeach
                                        @endif
                                    </ul>
                                    <div class="service-footer">
                                        <div class="service-price">
                                            {{ number_format($tour->price, 2) }} € 
                                            @if($tour->price_type === 'per_person')
                                                <small>/ {{ __('services.per_person') }}</small>
                                            @endif
                                        </div>
                                        <a href="{{ route('reservation') }}" class="btn-reserve">
                                            <i class="fas fa-calendar-check"></i>
                                            {{ __('services.reserve') }}
                                        </a>
                                        @if($isAdmin)
                                            <div class="admin-controls">
                                                <a href="{{ route('admin.tours.edit', $tour->id) }}" class="btn btn-sm btn-primary" title="{{ __('dashboard.edit_tour') }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.tours.destroy', $tour->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="{{ __('dashboard.delete_tour') }}"
                                                            onclick="return confirm('{{ __('dashboard.confirm_delete') }}')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="no-tours-message">
                                <i class="fas fa-compass"></i>
                                <p>{{ __('services.no_excursions_available') }}</p>
                                @if($isAdmin)
                                    <a href="{{ route('admin.tours.create', ['category' => 'excursion']) }}" class="btn-gold">
                                        <i class="fas fa-plus"></i> {{ __('dashboard.add_first_excursion') }}
                                    </a>
                                @endif
                            </div>
                        @endforelse
                    </div>
                </section>
            </div>
        </div>

        <!-- Fixed Contact Button -->
        <a href="#" class="fixed-contact-btn">
            <i class="fas fa-comment-dots"></i>
            <span>{{ __('home.footer.contact_us') }}</span>
        </a>
    </main>

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
    </script>    <style>
        .services-page {
            min-height: 100vh;
            background: linear-gradient(to bottom, #1a1a1a, #000);
            color: #fff;
        }

        .services-hero {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/images/banners/services-hero.jpg');
            background-size: cover;
            background-position: center;
            height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            margin-bottom: 50px;
        }

        .hero-content {
            max-width: 800px;
            padding: 20px;
        }

        .hero-content h1 {
            font-size: 4em;
            margin-bottom: 20px;
            color: #ffd700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .hero-content p {
            font-size: 1.5em;
            color: #fff;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .services-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .service-category {
            margin-bottom: 60px;
        }

        .service-category h2 {
            color: #ffd700;
            font-size: 2.5em;
            margin-bottom: 30px;
            text-align: center;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .service-category h2 i {
            margin-right: 15px;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            padding: 20px 0;
        }

        .service-card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            overflow: hidden;
            position: relative;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(255, 215, 0, 0.1);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .service-image {
            height: 250px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .service-content {
            padding: 25px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .service-content h3 {
            color: #ffd700;
            margin-bottom: 15px;
            font-size: 1.8em;
        }

        .features-list {
            list-style: none;
            padding: 0;
            margin: 0 0 20px 0;
            flex-grow: 1;
        }

        .features-list li {
            margin-bottom: 10px;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .features-list li i {
            color: #ffd700;
            width: 20px;
        }

        .service-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 215, 0, 0.1);
        }

        .service-price {
            font-size: 1.8em;
            color: #ffd700;
            font-weight: bold;
            text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.1);
        }

        .btn-reserve {
            background-color: #ffd700;
            color: #000;
            padding: 12px 25px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9em;
        }

        .btn-reserve:hover {
            background-color: #fff;
            color: #000;
            transform: translateY(-2px);
        }

        /* Admin Controls */
        .admin-controls {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            gap: 10px;
            z-index: 10;
        }

        .btn-admin {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #fff;
        }

        .btn-admin.edit {
            background-color: #ffd700;
        }

        .btn-admin.delete {
            background-color: #dc3545;
        }

        .btn-admin:hover {
            transform: scale(1.1);
        }

        .status-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: #dc3545;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.8em;
        }

        .btn-gold {
            background-color: #ffd700;
            color: #000;
            padding: 15px 30px;
            border-radius: 30px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-weight: bold;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 20px;
        }

        .btn-gold:hover {
            background-color: #fff;
            color: #000;
            transform: translateY(-2px);
        }

        .no-services {
            grid-column: 1 / -1;
            text-align: center;
            padding: 50px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            color: #fff;
        }

        .no-services i {
            font-size: 3em;
            color: #ffd700;
            margin-bottom: 20px;
        }

        .alert {
            background: rgba(40, 167, 69, 0.2);
            border: 1px solid #28a745;
            color: #28a745;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.5em;
            }
            
            .hero-content p {
                font-size: 1.2em;
            }
            
            .service-category h2 {
                font-size: 2em;
            }
            
            .services-grid {
                grid-template-columns: 1fr;
            }
            
            .service-card {
                margin: 0 10px;
            }
            
            .service-footer {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
        }
    </style>
</body>
</html>
