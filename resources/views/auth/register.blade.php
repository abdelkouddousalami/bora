<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bora Fish - Register</title>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mobile-nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth-button.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(45deg, #1a1a2e, #16213e, #1a1a2e);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
            position: relative;
            padding: 20px 0;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Background overlay and effects */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 20%, rgba(255, 215, 0, 0.05) 0%, transparent 40%),
                radial-gradient(circle at 80% 80%, rgba(255, 215, 0, 0.05) 0%, transparent 40%),
                url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffd700' fill-opacity='0.02'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            z-index: 0;
            pointer-events: none;
        }

        body::after {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, 
                rgba(255, 215, 0, 0.05) 0%,
                transparent 20%,
                transparent 80%,
                rgba(255, 215, 0, 0.05) 100%
            );
            z-index: 0;
            pointer-events: none;
        }

        /* Animated background particles */
        .background-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }        .particle {
            position: absolute;
            background: linear-gradient(45deg, #ffd700, #ffed4e);
            border-radius: 50%;
            opacity: 0.05;
            animation: float 6s ease-in-out infinite;
            box-shadow: 0 0 20px rgba(255, 215, 0, 0.2);
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0.1; }
            50% { transform: translateY(-20px) rotate(180deg); opacity: 0.3; }
        }        /* Register container */
        .register-container {
            background: rgba(0, 0, 0, 0.9);
            backdrop-filter: blur(20px);
            border: 2px solid rgba(255, 215, 0, 0.3);
            border-radius: 20px;
            padding: 50px;
            width: 100%;
            max-width: 1200px;
            box-shadow: 
                0 25px 50px rgba(0, 0, 0, 0.8),
                0 0 100px rgba(255, 215, 0, 0.1),
                inset 0 1px 0 rgba(255, 215, 0, 0.2);
            position: relative;
            z-index: 10;
            animation: slideIn 0.8s ease-out;
            margin: 20px 0;
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
        }

        .form-group input:focus + .input-highlight {
            opacity: 1;
            transform: scaleX(1);
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

        /* Password strength indicator */
        .password-strength {
            margin-top: 8px;
            height: 4px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 2px;
            overflow: hidden;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .password-strength.show {
            opacity: 1;
        }

        .strength-bar {
            height: 100%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .strength-weak { background: #ff4444; width: 33%; }
        .strength-medium { background: #ffaa00; width: 66%; }
        .strength-strong { background: #00ff00; width: 100%; }

        /* Password match indicator */
        .password-match {
            font-size: 0.8rem;
            margin-top: 5px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .password-match.show {
            opacity: 1;
        }

        .match-success {
            color: #00ff00;
        }

        .match-error {
            color: #ff4444;
        }

        /* Register button */
        .register-btn {
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

        .register-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(255, 215, 0, 0.4);
        }

        .register-btn:active {
            transform: translateY(-1px);
        }

        /* Terms and conditions */
        .terms-group {
            margin: 25px 0;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .terms-group input[type="checkbox"] {
            width: auto;
            margin: 0;
            transform: scale(1.2);
            flex-shrink: 0;
            margin-top: 2px;
        }

        .terms-group label {
            color: rgba(255, 215, 0, 0.8);
            font-size: 0.9rem;
            text-transform: none;
            letter-spacing: normal;
            line-height: 1.4;
        }

        .terms-group a {
            color: #ffd700;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
        }

        .terms-group a:hover {
            color: #ffed4e;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
        }

        .terms-group a::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 0;
            height: 1px;
            background: #ffd700;
            transition: width 0.3s ease;
        }

        .terms-group a:hover::after {
            width: 100%;
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

        /* Login link */
        .login-link {
            text-align: center;
            color: rgba(255, 215, 0, 0.8);
            font-size: 0.9rem;
        }

        .login-link a {
            color: #ffd700;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
        }

        .login-link a:hover {
            color: #ffed4e;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
        }

        .login-link a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 1px;
            background: #ffd700;
            transition: width 0.3s ease;
        }

        .login-link a:hover::after {
            width: 100%;
        }        /* Responsive design */
        @media (max-width: 480px) {
            .register-container {
                padding: 30px 15px;
                margin: 10px;
                width: calc(100% - 20px);
            }
            
            .logo h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    
    <div class="background-animation" id="particles"></div>
    
    <div class="register-container">
        <div class="logo">
            <h1>Bora Fish</h1>
            <p>Join Our Premium Community</p>
        </div>
          <form method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="Enter your full name" 
                    value="{{ old('name') }}" required autocomplete="name">
                <div class="input-highlight"></div>
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email address" 
                    value="{{ old('email') }}" required autocomplete="email">
                <div class="input-highlight"></div>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Create a strong password" required>
                <div class="input-highlight"></div>
                <div class="password-strength" id="passwordStrength">
                    <div class="strength-bar" id="strengthBar"></div>
                </div>
            </div>
              <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required>
                <div class="input-highlight"></div>
                <div class="password-match" id="passwordMatch"></div>
            </div>
              <div class="terms-group">
                <input type="checkbox" id="terms" name="terms" required {{ old('terms') ? 'checked' : '' }}>
                <label for="terms">
                    I agree to the <a href="#" id="termsLink">Terms of Service</a> and <a href="#" id="privacyLink">Privacy Policy</a>
                </label>
                @error('terms')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div id="formErrors" class="error-message" style="display: none; margin-bottom: 15px;"></div>
              <button type="submit" class="register-btn" id="registerButton">
                Create Account
            </button>
        </form>
        
        <div class="decorative-line"></div>
        
        <div class="login-link">
            <span>Already have an account? <a href="{{ route('login') }}" id="loginLink">Sign In</a></span>
        </div>
    </div>    <script>
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
        }

        // Password strength checker
        function checkPasswordStrength(password) {
            const strengthIndicator = document.getElementById('passwordStrength');
            const strengthBar = document.getElementById('strengthBar');
            
            if (password.length === 0) {
                strengthIndicator.classList.remove('show');
                return;
            }
            
            strengthIndicator.classList.add('show');
            
            let strength = 0;
            
            // Criteria checks
            if (password.length >= 8) strength++; // Length >= 8
            if (/[A-Z]/.test(password)) strength++; // Has uppercase
            if (/[a-z]/.test(password)) strength++; // Has lowercase
            if (/\d/.test(password)) strength++; // Has number
            if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) strength++; // Has special character
            
            // Update strength bar
            strengthBar.className = 'strength-bar';
            
            if (strength <= 2) {
                strengthBar.classList.add('strength-weak');
            } else if (strength <= 4) {
                strengthBar.classList.add('strength-medium');
            } else {
                strengthBar.classList.add('strength-strong');
            }

            return strength >= 3; // Return true if password is at least medium strength
        }

        // Password match checker
        function checkPasswordMatch(password, confirmPassword) {
            const matchIndicator = document.getElementById('passwordMatch');
            
            if (confirmPassword.length === 0) {
                matchIndicator.classList.remove('show');
                return false;
            }
            
            matchIndicator.classList.add('show');
            
            const matches = password === confirmPassword;
            matchIndicator.textContent = matches ? '✓ Passwords match' : '✗ Passwords do not match';
            matchIndicator.className = 'password-match show ' + (matches ? 'match-success' : 'match-error');
            
            return matches;
        }

        // Form validation        
        function validateForm() {
            const registerButton = document.getElementById('registerButton');
            // Always enable the button
            registerButton.disabled = false;
            // Always return true to allow form submission
            return true;
        }

        // Add event listeners to all form inputs
        document.querySelectorAll('#registerForm input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        // Form submission handler
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            // Allow form submission without validation
            const button = document.querySelector('.register-btn');
            button.textContent = 'Creating Account...';
            button.style.background = 'linear-gradient(135deg, #ffed4e, #ffd700)';
            // Submit the form
            return true;
        });

        // Initialize particles
        createParticles();
        // Initial form validation
        validateForm();
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