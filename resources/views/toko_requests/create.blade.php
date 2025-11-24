<x-app-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Modern Store Request</title>
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
            width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            padding: 40px;
            text-align: center;
            animation: float 6s ease-in-out infinite;
            position: relative;
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

        .step-guide {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
            text-align: left;
        }

        .step-guide h4 {
            margin-bottom: 15px;
            font-weight: 600;
        }

        .step {
            margin-bottom: 10px;
            font-size: 14px;
            opacity: 0.9;
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

        input, textarea {
            width: 100%;
            padding: 15px 20px;
            border-radius: 12px;
            border: 2px solid #e1e5e9;
            background: #f8f9fa;
            font-size: 16px;
            transition: all 0.3s ease;
            outline: none;
            resize: vertical;
        }

        input:focus, textarea:focus {
            border-color: #667eea;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .help-text {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
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

        .back-btn {
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
        }

        .back-btn:hover {
            background: rgba(102, 126, 234, 0.2);
            transform: scale(1.1);
        }

        /* Responsive */
        @media (max-width: 640px) {
            .card {
                width: 95%;
                padding: 30px 20px;
            }
            h2 {
                font-size: 28px;
            }
            .btn-group {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <div class="card">
        <button class="back-btn" onclick="window.location.href='{{ route('toko_requests.index') }}'">
            <i class="fas fa-arrow-left"></i>
        </button>

        <h2>🏪 Ajukan Toko Baru</h2>

        <!-- Laravel Session Status -->
        <x-auth-session-status class="mb-3" :status="session('status')" />

        <!-- Laravel Validation Errors -->
        <x-auth-validation-errors class="mb-3" :errors="$errors" />

        <div class="step-guide">
            <h4><i class="fas fa-road mr-2"></i>Proses Pembuatan Toko</h4>
            <div class="step"><strong>1.</strong> Isi formulir dengan data lengkap</div>
            <div class="step"><strong>2.</strong> Kirim permintaan ke admin</div>
            <div class="step"><strong>3.</strong> Admin tinjau dalam 1-3 hari</div>
            <div class="step"><strong>4.</strong> Toko dibuat otomatis & siap jualan! 🎉</div>
        </div>

        <!-- FORM -->
        <form method="POST" action="{{ route('toko_requests.store') }}">
            @csrf

            <div class="input-group">
                <label for="nama_toko">
                    <i class="fas fa-store"></i>Nama Toko <span style="color: #e74c3c;">*</span>
                </label>
                <input type="text" id="nama_toko" name="nama_toko" placeholder="Masukkan nama toko unik" value="{{ old('nama_toko') }}" required />
                <div class="help-text">Nama akan ditampilkan di marketplace</div>
                <x-input-error :messages="$errors->get('nama_toko')" class="mt-2 text-red-600 font-semibold" />
            </div>

            <div class="input-group">
                <label for="deskripsi">
                    <i class="fas fa-file-alt"></i>Deskripsi Toko
                </label>
                <textarea id="deskripsi" name="deskripsi" rows="3" placeholder="Jelaskan toko Anda...">{{ old('deskripsi') }}</textarea>
                <div class="help-text">Bantu pelanggan mengenal toko Anda</div>
                <x-input-error :messages="$errors->get('deskripsi')" class="mt-2 text-red-600 font-semibold" />
            </div>

            <div class="input-group">
                <label for="kontak_toko">
                    <i class="fas fa-phone"></i>Kontak Toko <span style="color: #e74c3c;">*</span>
                </label>
                <input type="text" id="kontak_toko" name="kontak_toko" placeholder="Nomor WhatsApp/telepon" value="{{ old('kontak_toko') }}" required />
                <div class="help-text">Untuk komunikasi dengan pelanggan</div>
                <x-input-error :messages="$errors->get('kontak_toko')" class="mt-2 text-red-600 font-semibold" />
            </div>

            <div class="input-group">
                <label for="alamat">
                    <i class="fas fa-map-marker-alt"></i>Alamat Toko
                </label>
                <textarea id="alamat" name="alamat" rows="2" placeholder="Alamat lengkap toko">{{ old('alamat') }}</textarea>
                <div class="help-text">Bantu pelanggan menemukan lokasi</div>
                <x-input-error :messages="$errors->get('alamat')" class="mt-2 text-red-600 font-semibold" />
            </div>

            <div class="btn-group">
                <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('toko_requests.index') }}'">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane mr-2"></i>🚀 Kirim Permintaan
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Enhanced hover effects
            const inputs = document.querySelectorAll('input, textarea');
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
</x-app-layout>
