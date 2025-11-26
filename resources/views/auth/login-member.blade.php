<x-guest-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Modern Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #FFFFFFFF;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow: hidden;
        }

        .card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            width: 400px;
            padding: 40px;
            text-align: center;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        h2 {
            font-size: 32px;
            margin-bottom: 30px;
            color: #333;
            font-weight: 700;
        }

        .social {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
            justify-content: center;
        }

        .social button {
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
            background: #E4E2E2FF;
            color: #666;
            font-size: 18px;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .social button:hover {
            background: #0f9b0f;
            color: white;
            transform: translateY(-3px) scale(1.1);
            box-shadow: 0 8px 20px rgba(15, 155, 15, 0.4);
        }

        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 15px 20px;
            border-radius: 12px;
            border: 2px solid #e1e5e9;
            background: #f8f9fa;
            font-size: 16px;
            transition: all 0.3s ease;
            outline: none;
        }

        input:focus {
            border-color: #0f9b0f;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(15, 155, 15, 0.1);
            transform: translateY(-2px);
        }

        .input-group .fa-eye, .input-group .fa-eye-slash {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #666;
            transition: color 0.3s ease;
        }

        .input-group .fa-eye:hover, .input-group .fa-eye-slash:hover {
            color: #0f9b0f;
        }

        .small {
            font-size: 14px;
            margin-bottom: 20px;
            color: #0f9b0f;
            text-decoration: none;
            transition: all 0.3s ease;
            display: block;
        }

        .small:hover {
            color: #0a7a0a;
            text-decoration: underline;
        }

        .btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #0f9b0f 0%, #00d2d3 100%);
            border: none;
            color: #fff;
            border-radius: 12px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(15, 155, 15, 0.3);
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(15, 155, 15, 0.5);
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            font-size: 14px;
            color: #666;
        }

        .checkbox-group input[type="checkbox"] {
            margin-right: 8px;
            accent-color: #0f9b0f;
        }

        .switch {
            margin-top: 25px;
            font-size: 14px;
            color: #666;
        }

        .switch a {
            color: #0f9b0f;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .switch a:hover {
            color: #0a7a0a;
        }

        /* Error Popup Styles */
        .error-popup {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            animation: fadeIn 0.3s ease;
        }

        .error-content {
            background: white;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            max-width: 400px;
            width: 90%;
            animation: slideIn 0.3s ease;
        }

        .error-content i {
            font-size: 48px;
            color: #e74c3c;
            margin-bottom: 15px;
        }

        .error-content p {
            margin-bottom: 20px;
            color: #333;
            font-size: 16px;
            line-height: 1.5;
        }

        .close-btn {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .close-btn:hover {
            background: #c0392b;
            transform: translateY(-2px);
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        /* Responsive */
        @media (max-width: 480px) {
            .card {
                width: 90%;
                padding: 30px 20px;
            }
            h2 {
                font-size: 28px;
            }
            .error-content {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="card">
        <h2>Sign In</h2>

        <!-- Laravel Session Status -->
        <x-auth-session-status class="mb-3" :status="session('status')" />

        <!-- Laravel Validation Errors -->
        <x-auth-validation-errors class="mb-3" :errors="$errors" />

        <!-- Login Error Popup -->
        @if(session('login_error'))
            <div id="error-popup" class="error-popup">
                <div class="error-content">
                    <i class="fas fa-exclamation-triangle"></i>
                    <p>{{ session('login_error') }}</p>
                    <button onclick="closeErrorPopup()" class="close-btn">OK</button>
                </div>
            </div>
        @endif

        <div class="social">
            <button><i class="fab fa-google"></i></button>
            <button><i class="fab fa-facebook-f"></i></button>
            <button><i class="fab fa-twitter"></i></button>
            <button><i class="fab fa-linkedin-in"></i></button>
        </div>

        <p style="font-size: 14px; color: #666; margin-bottom: 25px;">or use your email account</p>

        <!-- LOGIN FORM -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-group">
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required />
            </div>

            <div class="input-group">
                <input type="password" id="password" name="password" placeholder="Password" required />
                <i class="fas fa-eye" id="togglePassword"></i>
            </div>

            <div class="checkbox-group">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember">Remember Me</label>
            </div>

            <a href="{{ route('password.request') }}" class="small">Forgot Your Password?</a>

            <button type="submit" class="btn">SIGN IN</button>
        </form>

        <div class="switch">
            Don't have an account? <a href="{{ route('register') }}">Sign Up</a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.getElementById('togglePassword');
            const password = document.getElementById('password');

            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });

            // Enhanced hover effects
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'scale(1.02)';
                });
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'scale(1)';
                });
            });

            const buttons = document.querySelectorAll('button');
            buttons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-3px) scale(1.05)';
                });
                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });

            // Auto-show error popup if exists
            const errorPopup = document.getElementById('error-popup');
            if (errorPopup) {
                errorPopup.style.display = 'flex';
            }
        });

        function closeErrorPopup() {
            const errorPopup = document.getElementById('error-popup');
            if (errorPopup) {
                errorPopup.style.display = 'none';
            }
        }
    </script>
</body>
</html>
</x-guest-layout>
