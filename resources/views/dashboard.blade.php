<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Marketplace Sekolah - Belanja Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        html, body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #ffffff;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            width: 100%;
            max-width: 100vw;
            box-sizing: border-box;
        }

        *, *::before, *::after {
            box-sizing: inherit;
        }

        /* Ultra Modern Hero Section */
        .hero-section {
            position: relative;
            min-height: 90vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 20%, #f093fb 40%, #ffecd2 60%, #fcb69f 80%, #ff9a9e 100%);
            overflow: hidden;
            display: flex;
            align-items: center;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.4) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.4) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(120, 219, 255, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 60% 10%, rgba(255, 255, 255, 0.2) 0%, transparent 50%);
            animation: heroGlow 10s ease-in-out infinite alternate;
        }

        @keyframes heroGlow {
            0% { opacity: 0.6; transform: scale(1) rotate(0deg); }
            50% { opacity: 0.9; transform: scale(1.02) rotate(1deg); }
            100% { opacity: 0.6; transform: scale(1) rotate(0deg); }
        }

        .hero-bg {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(2px);
        }

        .hero-bg::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 70%);
            animation: float 25s ease-in-out infinite;
        }

        .hero-bg::after {
            content: '';
            position: absolute;
            top: 20%;
            right: 10%;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            border-radius: 50%;
            animation: pulse 8s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translate(-50%, -50%) rotate(0deg) scale(1); }
            33% { transform: translate(-50%, -50%) rotate(120deg) scale(1.1); }
            66% { transform: translate(-50%, -50%) rotate(240deg) scale(0.9); }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.3; }
            50% { transform: scale(1.2); opacity: 0.6; }
        }

        .gradient-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(102, 126, 234, 0.15) 0%, rgba(118, 75, 162, 0.15) 50%, rgba(240, 147, 251, 0.15) 100%);
        }

        /* Floating geometric shapes */
        .floating-shapes {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: shapeFloat 15s ease-in-out infinite;
        }

        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 60px;
            height: 60px;
            top: 60%;
            right: 15%;
            animation-delay: 3s;
        }

        .shape:nth-child(3) {
            width: 100px;
            height: 100px;
            bottom: 20%;
            left: 20%;
            animation-delay: 6s;
        }

        .shape:nth-child(4) {
            width: 40px;
            height: 40px;
            top: 30%;
            right: 30%;
            animation-delay: 9s;
        }

        @keyframes shapeFloat {
            0%, 100% {
                transform: translateY(0px) rotate(0deg) scale(1);
                opacity: 0.1;
            }
            25% {
                transform: translateY(-20px) rotate(90deg) scale(1.1);
                opacity: 0.2;
            }
            50% {
                transform: translateY(-40px) rotate(180deg) scale(0.9);
                opacity: 0.15;
            }
            75% {
                transform: translateY(-20px) rotate(270deg) scale(1.05);
                opacity: 0.25;
            }
        }

        .hero-content {
            position: relative;
            z-index: 2;
            padding: 3rem 0;
        }

        .hero-title {
            font-size: 4.5rem;
            font-weight: 900;
            margin-bottom: 1.5rem;
            line-height: 1.05;
            text-shadow: 0 6px 25px rgba(0,0,0,0.4);
            animation: slideInLeft 1.2s ease-out;
            background: linear-gradient(45deg, #ffffff 0%, #f0f8ff 30%, #e6f3ff 50%, #ffffff 70%, #f8f9ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
        }

        .hero-title::before {
            content: '';
            position: absolute;
            top: -10px;
            left: -10px;
            right: -10px;
            bottom: -10px;
            background: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(102,126,234,0.1), rgba(240,147,251,0.1));
            border-radius: 20px;
            z-index: -1;
            animation: titleGlow 3s ease-in-out infinite alternate;
        }

        @keyframes titleGlow {
            0% { opacity: 0.3; transform: scale(1); }
            100% { opacity: 0.6; transform: scale(1.02); }
        }

        @keyframes slideInLeft {
            from { transform: translateX(-50px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        .hero-description {
            font-size: 1.8rem;
            margin-bottom: 3rem;
            opacity: 0.98;
            max-width: 900px;
            line-height: 1.8;
            animation: slideInLeft 1.2s ease-out 0.3s both;
            color: rgba(255, 255, 255, 0.95);
            text-shadow: 0 4px 20px rgba(0,0,0,0.4);
            font-weight: 400;
            letter-spacing: 0.5px;
        }

        .search-section {
            margin-bottom: 2.5rem;
        }

        .search-container {
            max-width: 650px;
            margin: 0 auto;
        }

        .search-input-wrapper {
            position: relative;
            background: rgba(255, 255, 255, 0.22);
            backdrop-filter: blur(30px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50px;
            overflow: hidden;
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.2), inset 0 1px 0 rgba(255, 255, 255, 0.1);
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .search-input-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.6s;
        }

        .search-input-wrapper:hover::before {
            left: 100%;
        }

        .search-input-wrapper:focus-within {
            background: rgba(255, 255, 255, 0.32);
            border-color: rgba(255, 255, 255, 0.6);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25), inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 0 30px rgba(102, 126, 234, 0.3);
            transform: translateY(-5px) scale(1.03);
        }

        .search-input-wrapper:focus-within::before {
            left: 100%;
        }

        .search-icon {
            position: absolute;
            left: 1.8rem;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.2rem;
        }

        .search-input {
            width: 100%;
            border: none;
            background: transparent;
            padding: 1.2rem 1.8rem 1.2rem 4rem;
            font-size: 1.15rem;
            color: white;
            outline: none;
            font-weight: 500;
            border-radius: 50px;
        }

        .search-input::placeholder {
            color: rgba(255, 255, 255, 0.75);
            font-weight: 400;
        }

        .search-btn {
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            border: none;
            background: linear-gradient(135deg, #ff6b6b, #ffd93d);
            color: white;
            padding: 0 2rem;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            border-radius: 0 50px 50px 0;
        }

        .search-btn:hover {
            background: linear-gradient(135deg, #ff5252, #ffc107);
            transform: scale(1.08);
            box-shadow: 0 6px 20px rgba(255, 107, 107, 0.4);
        }

        .hero-actions {
            display: flex;
            justify-content: center;
            animation: slideInLeft 1s ease-out 0.4s both;
        }

        .action-buttons-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            max-width: 800px;
            width: 100%;
        }

        .action-btn-large {
            display: flex !important;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem 1.5rem !important;
            min-height: 140px;
            border-radius: 20px !important;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.2) !important;
        }

        .action-btn-large:hover {
            transform: translateY(-8px) scale(1.05) !important;
            box-shadow: 0 20px 40px rgba(102, 126, 234, 0.3) !important;
        }

        .action-btn-large .btn-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: inherit;
            transition: transform 0.3s ease;
        }

        .action-btn-large:hover .btn-icon {
            transform: scale(1.2) rotate(5deg);
        }

        .action-btn-large .btn-text {
            text-align: center;
        }

        .action-btn-large .btn-title {
            display: block;
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
            color: inherit;
        }

        .action-btn-large .btn-subtitle {
            display: block;
            font-size: 0.9rem;
            opacity: 0.8;
            color: inherit;
        }

        .action-btn-large.btn-primary-modern {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            border-color: rgba(102, 126, 234, 0.5) !important;
        }

        .action-btn-large.btn-outline-modern {
            background: rgba(255, 255, 255, 0.1) !important;
            border-color: rgba(255, 255, 255, 0.3) !important;
            color: white !important;
        }

        .action-btn-large.btn-outline-modern:hover {
            background: rgba(255, 255, 255, 0.2) !important;
            border-color: rgba(255, 255, 255, 0.6) !important;
            color: white !important;
        }

        .btn-primary-modern {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 30px;
            padding: 1rem 2rem;
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            transition: all 0.4s ease;
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
            font-weight: 600;
            font-size: 1.05rem;
        }

        .btn-primary-modern:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 12px 30px rgba(102, 126, 234, 0.5);
            color: white;
            text-decoration: none;
        }

        .btn-outline-modern {
            background: rgba(255, 255, 255, 0.18);
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: 30px;
            padding: 1.2rem 2.5rem;
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            backdrop-filter: blur(20px);
            font-weight: 700;
            font-size: 1.1rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(255, 255, 255, 0.1);
        }

        .btn-outline-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
            transition: left 0.7s;
        }

        .btn-outline-modern:hover::before {
            left: 100%;
        }

        .btn-outline-modern:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.8);
            transform: translateY(-5px) scale(1.08);
            color: white;
            text-decoration: none;
            box-shadow: 0 12px 35px rgba(255, 255, 255, 0.3);
        }

        .btn-outline-modern:active {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 8px 25px rgba(255, 255, 255, 0.25);
        }

        .stats-container {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            animation: slideInRight 1s ease-out 0.6s both;
        }

        @keyframes slideInRight {
            from { transform: translateX(50px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 20px;
            padding: 2rem 1.5rem;
            text-align: center;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            transition: left 0.5s;
        }

        .stat-card:hover::before {
            left: 100%;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 900;
            color: white;
            margin-bottom: 0.5rem;
            display: block;
            text-shadow: 0 2px 10px rgba(0,0,0,0.3);
            background: linear-gradient(45deg, #ffffff, #e0e7ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-label {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Enhanced Responsive Design */
        @media (max-width: 768px) {
            .hero-section {
                min-height: 80vh;
                padding: 2rem 0;
            }

            .hero-title {
                font-size: 2.8rem;
                margin-bottom: 1rem;
            }

            .hero-description {
                font-size: 1.2rem;
                margin-bottom: 2rem;
            }

            .search-container {
                max-width: 100%;
            }

            .hero-actions {
                flex-direction: column;
                align-items: stretch;
                gap: 1rem;
            }

            .btn-primary-modern, .btn-outline-modern {
                justify-content: center;
                padding: 0.8rem 1.5rem;
                font-size: 1rem;
            }

            .section-title h2 {
                font-size: 2.2rem;
            }

            .section-title p {
                font-size: 1rem;
            }

            .cta-section {
                padding: 3rem 0;
                margin: 3rem 0;
                border-radius: 15px;
            }

            .cta-section .col-lg-8, .cta-section .col-lg-4 {
                text-align: center !important;
                margin-bottom: 2rem;
            }

            .cta-section .col-lg-4 {
                margin-bottom: 0;
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 2.4rem;
            }

            .hero-description {
                font-size: 1.1rem;
            }

            .section-title h2 {
                font-size: 2rem;
            }
        }

        /* Loading Animation */
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .pulse-animation {
            animation: pulse 2s infinite;
        }

        /* Floating Animation */
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .floating-animation {
            animation: floating 3s ease-in-out infinite;
        }

        /* Bounce In Animation */
        @keyframes bounceIn {
            0% { transform: scale(0.3); opacity: 0; }
            50% { transform: scale(1.05); }
            70% { transform: scale(0.9); }
            100% { transform: scale(1); opacity: 1; }
        }

        .bounce-in {
            animation: bounceIn 1s ease-out;
        }

        /* Enhanced Cards and Components */
        .category-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            cursor: pointer;
            border-radius: 16px;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.05), transparent);
            transition: left 0.6s;
        }

        .category-card:hover::before {
            left: 100%;
        }

        .category-card:hover {
            transform: translateY(-8px) scale(1.02) rotate(1deg);
            box-shadow: 0 16px 40px rgba(102, 126, 234, 0.15);
            border-color: #667eea;
        }

        .product-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border-radius: 16px;
            overflow: hidden;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
            position: relative;
        }

        .product-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .product-card:hover::after {
            transform: scaleX(1);
        }

        .product-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 16px 40px rgba(102, 126, 234, 0.15);
            border-color: #667eea;
        }

        .store-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border-radius: 16px;
            overflow: hidden;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
            position: relative;
        }

        .store-card:hover {
            transform: translateY(-8px) scale(1.02) rotate(1deg);
            box-shadow: 0 16px 40px rgba(102, 126, 234, 0.15);
            border-color: #667eea;
        }

        .section-title {
            position: relative;
            margin-bottom: 3rem;
        }

        .section-title h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2c3e50;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 5px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 3px;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }
    </style>
</head>
<body class="bg-light">
    @include('layouts.navbar')

    <!-- Enhanced Hero Section -->
    <section class="hero-section">
        <div class="hero-bg">
            <div class="gradient-overlay"></div>
        </div>

        <div class="container-fluid">
            <div class="row min-vh-75 align-items-center justify-content-center">
                <div class="col-lg-10 col-xl-8 text-center text-white">
                    <div class="hero-content">
                        <!-- Enhanced Title -->
                        <h1 class="hero-title">
                            Marketplace
                            <span class="gradient-text">Sekolah</span>
                        </h1>


                        <!-- Enhanced Search -->
                        <div class="search-section">
                            <div class="search-container">
                                <form action="{{ route('produks.index') }}" method="GET" class="search-form">
                                    <div class="search-input-wrapper">
                                        <i class="bi bi-search search-icon"></i>
                                        <input type="text"
                                               name="search"
                                               class="search-input"
                                               placeholder="Cari produk, kategori, atau toko..."
                                               value="{{ request('search') }}"
                                               autocomplete="off">
                                        <button class="search-btn" type="submit">
                                            <i class="bi bi-search me-2"></i>
                                            <span>Cari</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Enhanced Action Buttons -->
                        <div class="hero-actions d-flex justify-content-center">
                            <div class="action-buttons-grid">
                                <button class="btn btn-primary-modern action-btn-large" onclick="scrollToSection('produk')">
                                    <div class="btn-icon">
                                        <i class="bi bi-shop"></i>
                                    </div>
                                    <div class="btn-text">
                                        <span class="btn-title">Jelajahi Produk</span>
                                        <span class="btn-subtitle">Temukan produk terbaik</span>
                                    </div>
                                </button>
                                <button class="btn btn-outline-modern action-btn-large" onclick="scrollToSection('kategori')">
                                    <div class="btn-icon">
                                        <i class="bi bi-grid"></i>
                                    </div>
                                    <div class="btn-text">
                                        <span class="btn-title">Kategori</span>
                                        <span class="btn-subtitle">Jelajahi kategori</span>
                                    </div>
                                </button>
                                <button class="btn btn-outline-modern action-btn-large" onclick="scrollToSection('toko')">
                                    <div class="btn-icon">
                                        <i class="bi bi-building"></i>
                                    </div>
                                    <div class="btn-text">
                                        <span class="btn-title">Toko</span>
                                        <span class="btn-subtitle">Kunjungi toko</span>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Scroll Indicator -->
    <div class="scroll-indicator">
        <a href="#kategori" class="scroll-link" data-target="kategori"></a>
        <a href="#produk" class="scroll-link" data-target="produk"></a>
        <a href="#toko" class="scroll-link" data-target="toko"></a>
    </div>

    <div class="container py-5">
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Categories -->
        <section id="kategori" class="mb-5 animated-element">
            <div class="text-center section-title">
                <h2 class="fw-bold gradient-text">Kategori Produk</h2>
                <p class="text-muted fs-5">Temukan produk berdasarkan kategori kebutuhan sekolah</p>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach($kategoris as $kategori)
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <a href="#produk" class="text-decoration-none category-link" data-category="{{ $kategori->id }}" data-category-name="{{ $kategori->nama_kategori }}">
                        <div class="card category-card text-center h-100 position-relative overflow-hidden">
                            <div class="card-body py-4 d-flex flex-column align-items-center justify-content-center">
                                <div class="icon-wrapper mb-3 position-relative">
                                    @switch($kategori->nama_kategori)
                                        @case('Makanan')
                                            <i class="bi bi-egg-fried text-info fs-3"></i>
                                            @break
                                        @case('Minuman')
                                            <i class="bi bi-cup-straw text-info fs-3"></i>
                                            @break
                                        @case('Alat Tulis')
                                            <i class="bi bi-pencil text-primary fs-3"></i>
                                            @break
                                        @case('Buku')
                                            <i class="bi bi-book text-success fs-3"></i>
                                            @break
                                        @case('Tas Sekolah')
                                            <i class="bi bi-bag text-warning fs-3"></i>
                                            @break
                                        @case('Pakaian')
                                            <i class="bi bi-shirt text-secondary fs-3"></i>
                                            @break
                                        @case('Alat Olahraga')
                                            <i class="bi bi-bicycle text-danger fs-3"></i>
                                            @break
                                        @case('Elektronik')
                                            <i class="bi bi-phone text-danger fs-3"></i>
                                            @break
                                        @default
                                            <i class="bi bi-grid text-secondary fs-3"></i>
                                    @endswitch
                                    <div class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary" style="font-size: 0.7rem;">
                                        {{ $kategori->produks->count() }}
                                    </div>
                                </div>
                                <h6 class="card-title fw-bold text-dark mb-2">{{ $kategori->nama_kategori }}</h6>
                                <small class="text-muted">{{ $kategori->produks->count() }} produk tersedia</small>
                            </div>
                            <!-- Hover overlay -->
                            <div class="position-absolute top-0 start-0 w-100 h-100 bg-gradient-primary opacity-0 d-flex align-items-center justify-content-center transition-all" style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.9), rgba(118, 75, 162, 0.9));">
                                <div class="text-white text-center">
                                    <i class="bi bi-eye-fill fs-2 mb-2"></i>
                                    <p class="mb-0 small">Klik untuk melihat</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Produk Unggulan -->
        <section id="produk-favorit" class="mb-5 animated-element">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="section-title">
                    <h2 class="fw-bold mb-1 gradient-text">
                        Produk Unggulan
                    </h2>
                    <p class="text-muted mb-0 fs-5">Produk terpopuler dan berkualitas tinggi</p>
                </div>
                <div class="d-flex gap-2">
                                    <a href="{{ route('produks.index') }}" class="btn btn-outline-primary btn-lg px-4 cta-btn shadow-sm" style="border-radius: 25px;">
                                        <i class="bi bi-arrow-right-circle me-2"></i>Lihat Semua
                                    </a>
                </div>
            </div>

            <!-- Horizontal Scroll Container -->
            <div class="horizontal-scroll-container position-relative" style="background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%); border-radius: 20px; padding: 30px; box-shadow: 0 8px 32px rgba(0,0,0,0.1); overflow: hidden;">
                <div class="horizontal-scroll-wrapper d-flex gap-4 pb-3" id="featuredScroll" style="overflow-x: auto; scrollbar-width: none; -ms-overflow-style: none; scroll-behavior: smooth;">
                    <style>
                        #featuredScroll::-webkit-scrollbar {
                            display: none;
                        }
                        .product-card-horizontal {
                            transition: all 0.3s ease;
                            border-radius: 15px;
                            overflow: hidden;
                            background: white;
                            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
                            border: 1px solid rgba(255,255,255,0.8);
                            flex-shrink: 0;
                            width: 280px;
                        }
                        .product-card-horizontal:hover {
                            transform: translateY(-5px) scale(1.02);
                            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
                        }
                        .horizontal-scroll-container::before {
                            content: '';
                            position: absolute;
                            top: 0;
                            left: 0;
                            right: 0;
                            height: 4px;
                            background: linear-gradient(90deg, #667eea, #764ba2, #667eea);
                            background-size: 200% 100%;
                            animation: gradientShift 3s ease-in-out infinite;
                            z-index: 1;
                        }
                        @keyframes gradientShift {
                            0%, 100% { background-position: 0% 50%; }
                            50% { background-position: 100% 50%; }
                        }
                    </style>
                    @foreach($produkFavorit ?? $produks->take(12) as $produk)
                    <div class="product-card-horizontal">
                        <div class="position-relative overflow-hidden">
                            @if($produk->gambarProduks->isNotEmpty())
                                <img src="{{ asset('storage/' . $produk->gambarProduks->first()->nama_file) }}" class="card-img-top product-image" alt="{{ $produk->nama_produk }}" style="height: 160px; object-fit: cover;">
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center product-image" style="height: 160px;">
                                    <i class="bi bi-image text-muted fs-3"></i>
                                </div>
                            @endif
                            <span class="badge bg-primary position-absolute top-0 end-0 m-2">{{ $produk->kategori->nama_kategori }}</span>
                            <div class="product-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center opacity-0" style="background: rgba(102, 126, 234, 0.9); transition: opacity 0.3s ease;">
                                <button class="btn btn-light btn-sm quick-view-btn" data-product-id="{{ $produk->id }}">
                                    <i class="bi bi-eye me-1"></i>Lihat Detail
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <h6 class="card-title fw-bold mb-2" style="font-size: 0.9rem; line-height: 1.3;">{{ Str::limit($produk->nama_produk, 25) }}</h6>
                            <p class="card-text text-muted small mb-2" style="font-size: 0.8rem;">{{ $produk->toko->nama_toko }}</p>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="fw-bold text-primary" style="font-size: 0.95rem;">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                                <div class="rating d-flex align-items-center">
                                    <div class="stars me-1">
                                        <i class="bi bi-star-fill text-warning" style="font-size: 0.7rem;"></i>
                                        <i class="bi bi-star-fill text-warning" style="font-size: 0.7rem;"></i>
                                        <i class="bi bi-star-fill text-warning" style="font-size: 0.7rem;"></i>
                                        <i class="bi bi-star-fill text-warning" style="font-size: 0.7rem;"></i>
                                        <i class="bi bi-star-half text-warning" style="font-size: 0.7rem;"></i>
                                    </div>
                                    <small class="text-muted" style="font-size: 0.75rem;">4.5</small>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-sm w-100 btn-add-to-cart" data-produk-id="{{ $produk->id }}" data-produk-name="{{ $produk->nama_produk }}" style="font-size: 0.85rem;">
                                <i class="bi bi-cart-plus me-1"></i>Keranjang
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Featured Products -->
        <section id="produk" class="mb-5 animated-element">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="section-title">
                    <h2 class="fw-bold mb-1 gradient-text">Produk Terbaru</h2>
                    <p class="text-muted mb-0 fs-5">Produk terbaru dari marketplace sekolah</p>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-secondary btn-lg px-4 cta-btn shadow-sm" onclick="showAllProducts()" style="border-radius: 25px;">
                        <i class="bi bi-grid me-2"></i>Semua
                    </button>
                    <a href="{{ route('produks.index') }}" class="btn btn-outline-primary btn-lg px-4 cta-btn shadow-sm" style="border-radius: 25px;">
                        <i class="bi bi-arrow-right-circle me-2"></i>Lihat Semua
                    </a>
                </div>
            </div>

            <!-- Featured Product Banner -->
            @if($produks->count() > 0)
            <div class="featured-product-card mb-5 position-relative overflow-hidden" style="border-radius: 25px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); box-shadow: 0 20px 60px rgba(102, 126, 234, 0.4); min-height: 400px;">
                <div class="container-fluid h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-lg-6 text-white p-5">
                            <div class="featured-content">
                                <!-- Featured Badge -->
                                <div class="d-flex align-items-center mb-4">
                                    <span class="badge-featured me-3">
                                        <i class="fas fa-star me-2"></i>FEATURED PRODUCT
                                    </span>
                                    <span class="category-badge">
                                        {{ $produks->first()->kategori->nama_kategori }}
                                    </span>
                                </div>

                                <!-- Product Title -->
                                <h1 class="product-title-featured mb-3">
                                    {{ $produks->first()->nama_produk }}
                                </h1>

                                <!-- Product Description -->
                                <p class="product-description-featured mb-4">
                                    {{ Str::limit($produks->first()->deskripsi ?? 'Produk berkualitas tinggi untuk kebutuhan sekolah Anda', 120) }}
                                </p>

                                <!-- Store Info -->
                                <div class="store-info-featured mb-4">
                                    <div class="d-flex align-items-center">
                                        <div class="store-icon me-3">
                                            <i class="fas fa-store"></i>
                                        </div>
                                        <div>
                                            <h5 class="store-name mb-0">{{ $produks->first()->toko->nama_toko }}</h5>
                                        </div>
                                    </div>
                                </div>

                                <!-- Price and Actions -->
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="price-section-featured">
                                        <h2 class="price-featured mb-2">
                                            Rp {{ number_format($produks->first()->harga, 0, ',', '.') }}
                                        </h2>
                                    </div>
                                    <div class="action-buttons-featured">
                                        <a href="{{ route('produks.show', $produks->first()->id) }}" class="btn btn-outline-light btn-lg me-3">
                                            <i class="fas fa-eye me-2"></i>Lihat Detail
                                        </a>
                                        <button class="btn btn-warning btn-lg btn-buy-featured" data-product-id="{{ $produks->first()->id }}">
                                            <i class="fas fa-shopping-cart me-2"></i>Beli Sekarang
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 p-5 text-center">
                            <div class="featured-image-container">
                                @if($produks->first()->gambarProduks->isNotEmpty())
                                    <img src="{{ asset('storage/' . $produks->first()->gambarProduks->first()->nama_file) }}"
                                         alt="{{ $produks->first()->nama_produk }}"
                                         class="featured-product-image">
                                    <div class="premium-badge">
                                        <i class="fas fa-crown"></i>
                                        <span>Premium</span>
                                    </div>
                                @else
                                    <div class="featured-product-image-placeholder">
                                        <i class="fas fa-image"></i>
                                        <p>Gambar tidak tersedia</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Background Pattern -->
                <div class="featured-bg-pattern">
                    <div class="pattern-circle circle-1"></div>
                    <div class="pattern-circle circle-2"></div>
                    <div class="pattern-circle circle-3"></div>
                </div>
            </div>

            <style>
                .featured-product-card {
                    position: relative;
                    overflow: hidden;
                }

                .badge-featured {
                    background: linear-gradient(45deg, #ffd700, #ffed4e);
                    color: #000;
                    padding: 12px 20px;
                    border-radius: 25px;
                    font-weight: 700;
                    font-size: 0.9rem;
                    text-transform: uppercase;
                    letter-spacing: 1px;
                    box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
                    display: inline-flex;
                    align-items: center;
                }

                .category-badge {
                    background: rgba(255, 255, 255, 0.2);
                    color: white;
                    padding: 8px 16px;
                    border-radius: 20px;
                    font-weight: 600;
                    backdrop-filter: blur(10px);
                    border: 1px solid rgba(255, 255, 255, 0.3);
                }

                .product-title-featured {
                    font-size: 3.5rem;
                    font-weight: 900;
                    line-height: 1.1;
                    margin-bottom: 1rem;
                    text-shadow: 0 4px 20px rgba(0,0,0,0.3);
                    background: linear-gradient(45deg, #ffffff 0%, #f0f8ff 50%, #ffffff 100%);
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                    background-clip: text;
                }

                .product-description-featured {
                    font-size: 1.2rem;
                    line-height: 1.6;
                    opacity: 0.95;
                    max-width: 500px;
                }

                .store-info-featured .store-icon {
                    width: 50px;
                    height: 50px;
                    background: rgba(255, 255, 255, 0.2);
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    backdrop-filter: blur(10px);
                    border: 2px solid rgba(255, 255, 255, 0.3);
                }

                .store-name {
                    font-size: 1.1rem;
                    font-weight: 700;
                    color: white;
                }

                .price-featured {
                    font-size: 2.5rem;
                    font-weight: 900;
                    color: #ffd700;
                    text-shadow: 0 2px 10px rgba(255, 215, 0, 0.5);
                    margin: 0;
                }

                .action-buttons-featured .btn {
                    border-radius: 25px;
                    font-weight: 600;
                    padding: 12px 24px;
                    transition: all 0.3s ease;
                }

                .btn-buy-featured {
                    background: linear-gradient(45deg, #ff6b35, #f7931e);
                    border: none;
                    box-shadow: 0 6px 20px rgba(255, 107, 53, 0.4);
                }

                .btn-buy-featured:hover {
                    transform: translateY(-3px);
                    box-shadow: 0 12px 30px rgba(255, 107, 53, 0.6);
                }

                .featured-product-image {
                    width: 100%;
                    max-width: 350px;
                    height: 350px;
                    object-fit: cover;
                    border-radius: 20px;
                    box-shadow: 0 20px 40px rgba(0,0,0,0.3);
                    transition: transform 0.3s ease;
                }

                .featured-product-image:hover {
                    transform: scale(1.05) rotate(2deg);
                }

                .featured-product-image-placeholder {
                    width: 100%;
                    max-width: 350px;
                    height: 350px;
                    background: rgba(255, 255, 255, 0.1);
                    border-radius: 20px;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    backdrop-filter: blur(10px);
                    border: 2px dashed rgba(255, 255, 255, 0.3);
                    color: rgba(255, 255, 255, 0.7);
                }

                .featured-product-image-placeholder i {
                    font-size: 4rem;
                    margin-bottom: 1rem;
                }

                .premium-badge {
                    position: absolute;
                    top: -10px;
                    right: -10px;
                    background: linear-gradient(45deg, #ffd700, #ffed4e);
                    color: #000;
                    padding: 8px 16px;
                    border-radius: 20px;
                    font-weight: 700;
                    font-size: 0.8rem;
                    text-transform: uppercase;
                    box-shadow: 0 4px 15px rgba(255, 215, 0, 0.4);
                    display: flex;
                    align-items: center;
                    gap: 5px;
                }

                .featured-bg-pattern {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    pointer-events: none;
                    overflow: hidden;
                }

                .pattern-circle {
                    position: absolute;
                    border-radius: 50%;
                    background: rgba(255, 255, 255, 0.05);
                    animation: floatPattern 8s ease-in-out infinite;
                }

                .circle-1 {
                    width: 200px;
                    height: 200px;
                    top: 10%;
                    right: 10%;
                    animation-delay: 0s;
                }

                .circle-2 {
                    width: 150px;
                    height: 150px;
                    bottom: 20%;
                    left: 15%;
                    animation-delay: 2s;
                }

                .circle-3 {
                    width: 100px;
                    height: 100px;
                    top: 60%;
                    right: 20%;
                    animation-delay: 4s;
                }

                @keyframes floatPattern {
                    0%, 100% { transform: translateY(0px) scale(1); opacity: 0.3; }
                    50% { transform: translateY(-20px) scale(1.1); opacity: 0.6; }
                }

                @media (max-width: 768px) {
                    .product-title-featured {
                        font-size: 2.5rem;
                    }

                    .price-featured {
                        font-size: 2rem;
                    }

                    .featured-product-image {
                        max-width: 250px;
                        height: 250px;
                    }

                    .action-buttons-featured {
                        flex-direction: column;
                        gap: 10px;
                    }

                    .action-buttons-featured .btn {
                        width: 100%;
                    }
                }
            </style>
            @endif
            <div class="row g-4">
                @foreach($produks->skip(1) as $produk)
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                    <div class="card product-card h-100">
                        <div class="position-relative overflow-hidden">
                            @if($produk->gambarProduks->isNotEmpty())
                                <img src="{{ asset('storage/' . $produk->gambarProduks->first()->nama_file) }}" class="card-img-top product-image" alt="{{ $produk->nama_produk }}" style="height: 180px; object-fit: cover;">
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center product-image" style="height: 180px;">
                                    <i class="bi bi-image text-muted fs-2"></i>
                                </div>
                            @endif
                            <span class="badge bg-primary position-absolute top-0 end-0 m-2">{{ $produk->kategori->nama_kategori }}</span>
                            <div class="product-overlay">
                                <button class="btn btn-light btn-sm quick-view-btn" data-product-id="{{ $produk->id }}">
                                    <i class="bi bi-eye"></i> Lihat Detail
                                </button>
                            </div>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="card-title fw-bold mb-1 flex-grow-1">{{ Str::limit($produk->nama_produk, 30) }}</h6>
                                <button class="btn btn-link p-0 text-decoration-none favorite-btn" data-product-id="{{ $produk->id }}" style="color: #dc3545;">
                                    <i class="bi bi-heart fs-5"></i>
                                </button>
                            </div>
                            <p class="card-text text-muted small mb-2">{{ $produk->toko->nama_toko }}</p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="fw-bold text-primary fs-5">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                                    <div class="rating d-flex align-items-center">
                                        <div class="stars me-1">
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-half text-warning"></i>
                                        </div>
                                        <small class="text-muted ms-1">4.5</small>
                                    </div>
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('produks.show', $produk->id) }}" class="btn btn-outline-primary btn-sm flex-fill">
                                        <i class="bi bi-eye me-1"></i>Lihat
                                    </a>
                                    <button class="btn btn-primary btn-sm flex-fill btn-add-to-cart" data-produk-id="{{ $produk->id }}" data-produk-name="{{ $produk->nama_produk }}">
                                        <i class="bi bi-cart-plus me-1"></i>Keranjang
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Featured Stores -->
        <section id="toko" class="mb-5 animated-element">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="section-title">
                    <h2 class="fw-bold mb-1">
                        <i class="fas fa-store me-3 text-success"></i>Toko Terkenal<i class="fas fa-store ms-3 text-success"></i>
                    </h2>
                    <p class="text-muted mb-0 fs-5">Jelajahi toko-toko terbaik di marketplace sekolah</p>
                </div>
                <a href="{{ route('tokos.index') }}" class="btn btn-outline-success btn-lg px-4 cta-btn">
                    <i class="bi bi-arrow-right-circle me-2"></i>Lihat Semua
                </a>
            </div>
            <div class="row g-4">
                @foreach($tokos as $toko)
                <div class="col-lg-4 col-md-6">
                    <div class="card store-card h-100">
                        <div class="position-relative overflow-hidden">
                            @if($toko->gambar)
                                <img src="{{ asset('storage/' . $toko->gambar) }}" class="card-img-top store-image" alt="{{ $toko->nama_toko }}" style="height: 150px; object-fit: cover; transition: transform 0.3s ease;">
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center store-image" style="height: 150px;">
                                    <i class="bi bi-shop text-muted fs-1"></i>
                                </div>
                            @endif
                            <div class="store-overlay">
                                <div class="d-flex gap-2">
                                    <button class="btn btn-light btn-sm" title="Kunjungi Toko">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-light btn-sm" title="Hubungi">
                                        <i class="bi bi-chat"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title fw-bold mb-2">{{ $toko->nama_toko }}</h6>
                            <p class="card-text text-muted small mb-2">
                                <i class="bi bi-person me-1"></i>Oleh: {{ $toko->user->name }}
                            </p>
                            <p class="card-text text-muted small mb-3">{{ Str::limit($toko->deskripsi, 80) }}</p>
                            <div class="mt-auto d-flex gap-2">
                                <a href="{{ route('tokos.show', $toko->id) }}" class="btn btn-success flex-fill">
                                    <i class="bi bi-shop me-1"></i>Kunjungi
                                </a>
                                <button class="btn btn-outline-success btn-sm" title="Favorit">
                                    <i class="bi bi-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Enhanced Call to Action -->
        <section class="cta-section text-white">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h3 class="fw-bold mb-3">Ingin Jual Produk Anda?</h3>
                        <p class="mb-0 opacity-90 fs-5">Bergabunglah dengan marketplace sekolah dan mulai jual produk Anda hari ini!</p>
                    </div>
                    <div class="col-lg-4 text-end">
                        @auth
                            @if(auth()->user()->role === 'member')
                                @if(isset($hasStore) && $hasStore)
                                    <div class="d-flex gap-3 flex-wrap justify-content-end">
                                        <a href="{{ route('tokos.show', $userToko->id) }}" class="btn btn-light btn-lg px-4 cta-btn">
                                            <i class="bi bi-shop me-2"></i>Kelola Toko
                                        </a>
                                        <a href="{{ route('produks.create') }}" class="btn btn-success btn-lg px-4 cta-btn">
                                            <i class="bi bi-plus-circle me-2"></i>Tambah Produk
                                        </a>
                                    </div>
                                @else
                                    <a href="{{ route('toko_requests.create') }}" class="btn btn-light btn-lg px-4 cta-btn">
                                        <i class="bi bi-shop me-2"></i>Ajukan Toko
                                    </a>
                                @endif
                            @elseif(auth()->user()->role === 'admin')
                                <a href="{{ route('tokos.create') }}" class="btn btn-light btn-lg px-4 cta-btn">
                                    <i class="bi bi-shop me-2"></i>Buat Toko
                                </a>
                            @endif
                        @else
                            <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4 cta-btn">
                                <i class="bi bi-person-plus me-2"></i>Daftar Member
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-3">Marketplace Sekolah</h5>
                    <p class="opacity-75">Platform jual beli antar siswa dan guru untuk memfasilitasi kebutuhan sekolah.</p>
                    <div class="d-flex gap-2">
                        <i class="bi bi-facebook fs-4"></i>
                        <i class="bi bi-instagram fs-4"></i>
                        <i class="bi bi-twitter fs-4"></i>
                    </div>
                </div>
                <div class="col-lg-2">
                    <h6 class="fw-bold mb-3">Kategori</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">Alat Tulis</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">Buku</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">Tas Sekolah</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">Makanan</a></li>
                    </ul>
                </div>
                <div class="col-lg-2">
                    <h6 class="fw-bold mb-3">Bantuan</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">Cara Belanja</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">Cara Jual</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">Kontak Kami</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h6 class="fw-bold mb-3">Download App</h6>
                    <p class="opacity-75 small mb-3">Dapatkan pengalaman belanja yang lebih baik dengan aplikasi mobile kami</p>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-light btn-sm">App Store</button>
                        <button class="btn btn-outline-light btn-sm">Google Play</button>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center">
                <p class="mb-0 opacity-75">&copy; 2024 Marketplace Sekolah. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scrolling for navigation
        document.querySelectorAll('.scroll-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                const offsetTop = target.offsetTop - 80;

                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });

                // Update active scroll indicator
                document.querySelectorAll('.scroll-link').forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Update scroll indicator on scroll
        window.addEventListener('scroll', function() {
            const sections = ['kategori', 'produk', 'toko'];
            let current = '';

            sections.forEach(section => {
                const element = document.getElementById(section);
                const rect = element.getBoundingClientRect();

                if (rect.top <= 100 && rect.bottom >= 100) {
                    current = section;
                }
            });

            document.querySelectorAll('.scroll-link').forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('data-target') === current) {
                    link.classList.add('active');
                }
            });
        });

        // Category filtering animation
        document.querySelectorAll('.category-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();

                // Remove active class from all categories
                document.querySelectorAll('.category-card').forEach(card => {
                    card.classList.remove('active');
                });

                // Add active class to clicked category
                this.querySelector('.category-card').classList.add('active');

                // Add click animation
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);

                // Get category data
                const categoryId = this.getAttribute('data-category');
                const categoryName = this.getAttribute('data-category-name');

                // Update section title
                const sectionTitle = document.querySelector('#produk .section-title h2');
                if (sectionTitle) {
                    sectionTitle.innerHTML = `Produk ${categoryName}`;
                }

                // Filter products by category
                const productCards = document.querySelectorAll('.product-card');
                let visibleCount = 0;

                productCards.forEach(card => {
                    const cardCategory = card.querySelector('.badge')?.textContent?.trim();
                    if (cardCategory === categoryName) {
                        card.style.display = 'block';
                        card.classList.add('fade-in');
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                        card.classList.remove('fade-in');
                    }
                });

                // Show message if no products found
                let noProductsMsg = document.getElementById('no-products-message');
                if (visibleCount === 0) {
                    if (!noProductsMsg) {
                        const productsSection = document.getElementById('produk');
                        const productGrid = productsSection.querySelector('.row.g-1');
                        noProductsMsg = document.createElement('div');
                        noProductsMsg.id = 'no-products-message';
                        noProductsMsg.className = 'text-center py-5';
                        noProductsMsg.innerHTML = `
                            <div class="empty-state">
                                <i class="bi bi-search text-muted fs-1 mb-3"></i>
                                <h5 class="text-muted">Tidak ada produk dalam kategori ini</h5>
                                <p class="text-muted">Coba pilih kategori lain atau lihat semua produk</p>
                                <button class="btn btn-primary" onclick="showAllProducts()">Lihat Semua Produk</button>
                            </div>
                        `;
                        productGrid.appendChild(noProductsMsg);
                    }
                    noProductsMsg.style.display = 'block';
                } else {
                    if (noProductsMsg) {
                        noProductsMsg.style.display = 'none';
                    }
                }

                // Smooth scroll to products section
                const productsSection = document.getElementById('produk');
                const offsetTop = productsSection.offsetTop - 80;
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            });
        });

        // Function to show all products
        function showAllProducts() {
            // Remove active class from all categories
            document.querySelectorAll('.category-card').forEach(card => {
                card.classList.remove('active');
            });

            // Reset section title
            const sectionTitle = document.querySelector('#produk .section-title h2');
            if (sectionTitle) {
                sectionTitle.innerHTML = 'Produk Terbaru';
            }

            // Show all products
            const productCards = document.querySelectorAll('.product-card');
            productCards.forEach(card => {
                card.style.display = 'block';
                card.classList.add('fade-in');
            });

            // Hide no products message
            const noProductsMsg = document.getElementById('no-products-message');
            if (noProductsMsg) {
                noProductsMsg.style.display = 'none';
            }
        }

        // Product card interactions
        document.querySelectorAll('.quick-view-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                // Here you would typically open a modal or navigate to product detail
                console.log('Quick view for product:', productId);
            });
        });

        // Add to cart functionality
        document.querySelectorAll('.btn-add-to-cart').forEach(btn => {
            btn.addEventListener('click', function() {
                const productId = this.getAttribute('data-produk-id');
                const productName = this.getAttribute('data-produk-name');

                // Add loading animation
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="bi bi-cart-plus me-2"></i>Menambahkan...';
                this.disabled = true;

                // Add to cart via AJAX
                fetch('/keranjang', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    },
                    body: JSON.stringify({
                        id_produk: productId,
                        quantity: 1
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update cart count
                        const cartCountElement = document.getElementById('cart-count');
                        if (cartCountElement) {
                            cartCountElement.textContent = data.cart_count;
                        }

                        // Show success message
                        this.innerHTML = '<i class="bi bi-check-circle me-2"></i>Ditambahkan!';
                        this.classList.remove('btn-primary');
                        this.classList.add('btn-success');

                        setTimeout(() => {
                            this.innerHTML = originalText;
                            this.classList.remove('btn-success');
                            this.classList.add('btn-primary');
                            this.disabled = false;
                        }, 2000);
                    } else {
                        alert(data.message || 'Gagal menambahkan ke keranjang');
                        this.innerHTML = originalText;
                        this.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menambahkan ke keranjang');
                    this.innerHTML = originalText;
                    this.disabled = false;
                });
            });
        });

        // Quick scroll to section function
        function scrollToSection(sectionId) {
            const section = document.getElementById(sectionId);
            if (section) {
                const offsetTop = section.offsetTop - 80;
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
        }

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe cards for animation
        document.querySelectorAll('.category-card, .product-card, .store-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
            observer.observe(card);
        });
    </script>
</body>
</html>
