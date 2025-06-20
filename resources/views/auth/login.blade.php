<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ session('dir', 'ltr') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bora Fish - Login</title>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mobile-nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth-button.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #000000 0%, #1a1a1a 50%, #000000 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* Animated background particles */
        .background-animation {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .particle {
            position: absolute;
            background: linear-gradient(45deg, #ffd700, #ffed4e);
            border-radius: 50%;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0.1; }
            50% { transform: translateY(-20px) rotate(180deg); opacity: 0.3; }
        }

        /* Login container */        .login-container {
            background: rgba(0, 0, 0, 0.9);
            backdrop-filter: blur(20px);
            border: 2px solid rgba(255, 215, 0, 0.3);
            border-radius: 20px;
            padding: 50px;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            box-shadow: 
                0 25px 50px rgba(0, 0, 0, 0.8),
                0 0 100px rgba(255, 215, 0, 0.1),
                inset 0 1px 0 rgba(255, 215, 0, 0.2);
            position: relative;
            z-index: 10;
            animation: slideIn 0.8s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(50px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Logo/Title */
        .logo {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo h1 {
            background: linear-gradient(135deg, #ffd700 0%, #ffed4e 50%, #ffd700 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-size: 2.5rem;
            font-weight: bold;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 10px;
            animation: glow 2s ease-in-out infinite alternate;
        }

        @keyframes glow {
            from { filter: drop-shadow(0 0 10px rgba(255, 215, 0, 0.3)); }
            to { filter: drop-shadow(0 0 20px rgba(255, 215, 0, 0.6)); }
        }

        .logo p {
            color: rgba(255, 215, 0, 0.8);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Form styling */
        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            display: block;
            color: #ffd700;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .form-group input {
            width: 100%;
            padding: 15px 20px;
            background: rgba(255, 215, 0, 0.05);
            border: 2px solid rgba(255, 215, 0, 0.2);
            border-radius: 10px;
            color: #fff;
            font-size: 1rem;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-group input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .form-group input:focus {
            border-color: #ffd700;
            background: rgba(255, 215, 0, 0.1);
            box-shadow: 0 0 20px rgba(255, 215, 0, 0.2);
            transform: translateY(-2px);
        }        .form-group input:focus + .input-highlight {
            opacity: 1;
            transform: scaleX(1);
        }

        .error-message {
            color: #ff4444;
            font-size: 0.85rem;
            margin-top: 8px;
            padding: 8px 12px;
            background: rgba(255, 68, 68, 0.1);
            border-radius: 6px;
            border-left: 3px solid #ff4444;
        }

        .input-highlight {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #ffd700, transparent);
            opacity: 0;
            transform: scaleX(0);
            transition: all 0.3s ease;
        }

        /* Login button */
        .login-btn {
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, #ffd700 0%, #ffed4e 50%, #ffd700 100%);
            color: #000;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            margin-top: 10px;
        }

        .login-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(255, 215, 0, 0.4);
        }

        .login-btn:active {
            transform: translateY(-1px);
        }

        .login-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .login-btn:hover::before {
            left: 100%;
        }

        /* Additional options */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 25px 0;
            color: rgba(255, 215, 0, 0.8);
            font-size: 0.9rem;
        }

        .form-options a {
            color: #ffd700;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
        }

        .form-options a:hover {
            color: #ffed4e;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
        }

        .form-options a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 1px;
            background: #ffd700;
            transition: width 0.3s ease;
        }

        .form-options a:hover::after {
            width: 100%;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
        }

        .checkbox-group input[type="checkbox"] {
            width: auto;
            margin-right: 8px;
            transform: scale(1.2);
        }

        /* Decorative elements */
        .decorative-line {
            height: 1px;
            background: linear-gradient(90deg, transparent, #ffd700, transparent);
            margin: 30px 0;
            position: relative;
        }

        .decorative-line::before {
            content: '◆';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #000;
            color: #ffd700;
            padding: 0 15px;
            font-size: 1.2rem;
        }

        /* Responsive design */
        @media (max-width: 480px) {
            .login-container {
                padding: 30px 25px;
                margin: 20px;
            }
            
            .logo h1 {
                font-size: 2rem;
            }
        }

        /* Updated registration link styles */
        .register-link {
            color: #ffd700 !important;
            text-decoration: none !important;
            font-weight: bold;
            transition: all 0.3s ease;
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 4px;
            display: inline-block;
        }

        .register-link:hover {
            color: #ffed4e !important;
            text-decoration: underline !important;
            background: rgba(255, 215, 0, 0.1);
        }

        .register-section {
            margin-top: 20px;
            padding: 10px;
            border-radius: 4px;
        }

        .register-section span {
            color: #fff;
            font-size: 0.95rem;
        }
    </style>
</head>
<body>
    
    <div class="background-animation" id="particles"></div>
    
    <div class="login-container">
        <div class="logo">
            <h1>Bora Fish</h1>
            <p>Premium Seafood Portal</p>
        </div>
        
          <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required autofocus>
                <div class="input-highlight"></div>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
                <div class="input-highlight"></div>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>            <div class="form-options">
                <div class="checkbox-group">
                    <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">Remember me</label>
                </div>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" id="forgotPassword">Forgot Password?</a>
                @endif
            </div>
            
            <button type="submit" class="login-btn">
                Sign In
            </button>
        </form>
        
        <div class="decorative-line"></div>
        <div class="form-options register-section" style="justify-content: center;">
            <span>Don't have an account? <a href="{{ route('register') }}" class="register-link" id="registerLink">Create one</a></span>
        </div>
    </div>

    <script>
        // Create floating particles
        function createParticles() {
            const container = document.getElementById('particles');
            const particleCount = 50;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                
                const size = Math.random() * 4 + 2;
                particle.style.width = size + 'px';
                particle.style.height = size + 'px';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 6 + 's';
                particle.style.animationDuration = (Math.random() * 4 + 4) + 's';
                
                container.appendChild(particle);
            }
        }        // Form submission handler
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const button = document.querySelector('.login-btn');
            const originalText = button.textContent;
            
            button.textContent = 'Signing In...';
            button.style.background = 'linear-gradient(135deg, #ffed4e, #ffd700)';
            
            // Let the form submit naturally - no preventDefault()
        });

        // Input focus effects
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        // Link hover effects
        document.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                const ripple = document.createElement('span');
                ripple.style.position = 'absolute';
                ripple.style.width = '20px';
                ripple.style.height = '20px';
                ripple.style.background = 'rgba(255, 215, 0, 0.6)';
                ripple.style.borderRadius = '50%';
                ripple.style.transform = 'scale(0)';
                ripple.style.animation = 'ripple 0.6s linear';
                ripple.style.left = '50%';
                ripple.style.top = '50%';
                ripple.style.marginLeft = '-10px';
                ripple.style.marginTop = '-10px';
                
                this.style.position = 'relative';
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Add ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);

        // Initialize particles
        createParticles();

        // Add smooth scrolling for mobile
        if (window.innerWidth <= 480) {
            document.body.style.overflow = 'auto';
        }
    </script>
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