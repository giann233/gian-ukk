<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Marketplace Sekolah</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow: hidden;
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            width: 500px;
            padding: 50px;
            text-align: center;
            animation: float 6s ease-in-out infinite;
            position: relative;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .logo {
            font-size: 48px;
            color: #667eea;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 28px;
            margin-bottom: 15px;
            color: #333;
            font-weight: 700;
        }

        .subtitle {
            font-size: 16px;
            color: #666;
            margin-bottom: 30px;
            line-height: 1.5;
        }

        .input-group {
            position: relative;
            margin-bottom: 25px;
            text-align: left;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        .input-group label i {
            margin-right: 8px;
            color: #667eea;
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
            border-color: #667eea;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .btn-group {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            flex: 1;
            padding: 15px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.3);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(102, 126, 234, 0.5);
        }

        .btn-secondary {
            background: #f8f9fa;
            color: #666;
            border: 2px solid #e1e5e9;
        }

        .btn-secondary:hover {
            background: #e9ecef;
            transform: translateY(-2px);
        }

        .back-link {
            position: absolute;
            top: 20px;
            left: 20px;
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .back-link:hover {
            background: rgba(102, 126, 234, 0.2);
            transform: scale(1.1);
        }

        .success-message {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 20px;
            text-align: left;
        }

        .error-message {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 20px;
            text-align: left;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .card {
                width: 95%;
                padding: 30px 20px;
            }
            h2 {
                font-size: 24px;
            }
            .btn-group {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <div class="card">
        <a href="{{ route('login.member') }}" class="back-link">
            <i class="fas fa-arrow-left"></i>
        </a>

        <div class="logo">
            <i class="fas fa-key"></i>
        </div>

        <h2>Lupa Password?</h2>

        <div class="subtitle">
            Jangan khawatir! Masukkan alamat email Anda dan kami akan mengirimkan link reset password untuk membuat password baru.
        </div>

        <!-- Laravel Session Status -->
        @if(session('status'))
            <div class="success-message">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('status') }}
            </div>
        @endif

        <!-- Laravel Validation Errors -->
        @if($errors->any())
            <div class="error-message">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                <ul class="mb-0 pl-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="input-group">
                <label for="email">
                    <i class="fas fa-envelope"></i>Alamat Email
                </label>
                <input type="email" id="email" name="email" placeholder="Masukkan email Anda" value="{{ old('email') }}" required autofocus />
            </div>

            <div class="btn-group">
                <a href="{{ route('login.member') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali ke Login
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane mr-2"></i>Kirim Link Reset
                </button>
            </div>
        </form>

        <div style="margin-top: 30px; font-size: 14px; color: #666;">
            <p>Belum punya akun? <a href="{{ route('register') }}" style="color: #667eea; text-decoration: none; font-weight: 600;">Daftar Member</a></p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
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

            const buttons = document.querySelectorAll('.btn');
            buttons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-3px) scale(1.05)';
                });
                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });
        });
    </script>
</body>
</html>
