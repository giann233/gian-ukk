<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Permintaan Toko - Marketplace Sekolah</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: #f8f9fa;
            color: #333;
            padding: 30px;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            text-align: center;
            border: 1px solid #e2e8f0;
        }

        .header h1 {
            font-size: 32px;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .header p {
            opacity: 0.9;
            font-size: 16px;
        }

        .back-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            background: #ffffff;
            color: #333;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            width: 40px;
            height: 40px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .back-btn:hover {
            background: #f8f9fa;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(0,0,0,0.15);
        }

        .card h3 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
            font-weight: 700;
            display: flex;
            align-items: center;
        }

        .card h3 i {
            margin-right: 10px;
            color: #667eea;
        }

        .info-item {
            margin-bottom: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            border-left: 3px solid #667eea;
        }

        .info-label {
            font-weight: 600;
            color: #333;
            font-size: 14px;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
        }

        .info-label i {
            margin-right: 8px;
            color: #667eea;
        }

        .info-value {
            color: #555;
            font-size: 16px;
            line-height: 1.4;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
        }

        .status-pending {
            background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
            color: white;
        }

        .status-approved {
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            color: white;
        }

        .status-rejected {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border: 1px solid #e2e8f0;
        }

        .btn {
            padding: 12px 24px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .btn i {
            margin-right: 8px;
        }

        .btn-secondary {
            background: #ffffff;
            color: #333;
        }

        .btn-secondary:hover {
            background: #f8f9fa;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }

        .btn-success {
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            color: white;
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(39, 174, 96, 0.3);
        }

        .btn-danger {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(231, 76, 60, 0.3);
        }

        .admin-actions {
            display: flex;
            gap: 15px;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            backdrop-filter: blur(5px);
        }

        .modal-content {
            background: white;
            margin: 10% auto;
            padding: 0;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.15);
            animation: modalSlideIn 0.3s ease-out;
            border: 1px solid #e2e8f0;
        }

        @keyframes modalSlideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            background: #f8f9fa;
            color: #333;
            padding: 20px;
            border-radius: 12px 12px 0 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .modal-header h3 {
            margin: 0;
            font-size: 20px;
            font-weight: 600;
        }

        .modal-body {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e1e5e9;
            border-radius: 8px;
            font-size: 14px;
            resize: vertical;
            min-height: 80px;
        }

        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .modal-footer {
            padding: 20px 30px 30px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn-cancel {
            background: #ffffff;
            color: #333;
            padding: 10px 20px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .btn-cancel:hover {
            background: #f8f9fa;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .content-grid {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
                gap: 15px;
            }

            .admin-actions {
                flex-direction: column;
                width: 100%;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header" style="position: relative;">
            <button class="back-btn" onclick="window.location.href='{{ route('toko_requests.index') }}'">
                <i class="fas fa-arrow-left"></i>
            </button>
            <h1><i class="fas fa-store mr-3"></i>Detail Permintaan Toko</h1>
            <p>Lihat informasi lengkap permintaan toko ini</p>
        </div>

        <div class="content-grid">
            <!-- Store Information -->
            <div class="card">
                <h3><i class="fas fa-shop"></i>Informasi Toko</h3>

                <div class="info-item">
                    <div class="info-label">
                        <i class="fas fa-tag"></i>Nama Toko
                    </div>
                    <div class="info-value">{{ $tokoRequest->nama_toko }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <i class="fas fa-file-alt"></i>Deskripsi
                    </div>
                    <div class="info-value">{{ $tokoRequest->deskripsi ?: 'Tidak ada deskripsi' }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <i class="fas fa-phone"></i>Kontak Toko
                    </div>
                    <div class="info-value">{{ $tokoRequest->kontak_toko }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <i class="fas fa-map-marker-alt"></i>Alamat
                    </div>
                    <div class="info-value">{{ $tokoRequest->alamat ?: 'Tidak ada alamat' }}</div>
                </div>
            </div>

            <!-- Request Information -->
            <div class="card">
                <h3><i class="fas fa-clipboard-list"></i>Informasi Permintaan</h3>

                <div class="info-item">
                    <div class="info-label">
                        <i class="fas fa-user"></i>Pemohon
                    </div>
                    <div class="info-value">{{ $tokoRequest->user->name }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <i class="fas fa-envelope"></i>Email Pemohon
                    </div>
                    <div class="info-value">{{ $tokoRequest->user->email }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <i class="fas fa-info-circle"></i>Status
                    </div>
                    <div class="info-value">
                        @if($tokoRequest->status === 'pending')
                            <span class="status-badge status-pending">
                                <i class="fas fa-clock mr-2"></i>Menunggu Konfirmasi
                            </span>
                        @elseif($tokoRequest->status === 'approved')
                            <span class="status-badge status-approved">
                                <i class="fas fa-check-circle mr-2"></i>Disetujui
                            </span>
                        @else
                            <span class="status-badge status-rejected">
                                <i class="fas fa-times-circle mr-2"></i>Ditolak
                            </span>
                        @endif
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <i class="fas fa-calendar-alt"></i>Tanggal Pengajuan
                    </div>
                    <div class="info-value">{{ $tokoRequest->created_at->format('d F Y, H:i') }}</div>
                </div>

                @if($tokoRequest->status === 'rejected' && $tokoRequest->admin_notes)
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-comment-alt"></i>Catatan Admin
                        </div>
                        <div class="info-value">{{ $tokoRequest->admin_notes }}</div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="{{ route('toko_requests.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>Kembali ke Daftar
            </a>

            @if(auth()->user()->role === 'admin' && $tokoRequest->status === 'pending')
                <div class="admin-actions">
                    <form action="{{ route('toko_requests.approve', $tokoRequest->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="btn btn-success" onclick="return confirm('Apakah Anda yakin ingin menyetujui permintaan ini?')">
                            <i class="fas fa-check"></i>Setujui Permintaan
                        </button>
                    </form>

                    <button type="button" class="btn btn-danger" onclick="openRejectModal()">
                        <i class="fas fa-times"></i>Tolak Permintaan
                    </button>
                </div>
            @endif
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-times-circle mr-2"></i>Tolak Permintaan Toko</h3>
            </div>
            <form action="{{ route('toko_requests.reject', $tokoRequest->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="admin_notes">
                            <i class="fas fa-comment-alt mr-2"></i>Catatan Admin (Opsional)
                        </label>
                        <textarea name="admin_notes" id="admin_notes" placeholder="Berikan alasan penolakan..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeRejectModal()">Batal</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-times"></i>Tolak Permintaan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openRejectModal() {
            document.getElementById('rejectModal').style.display = 'block';
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').style.display = 'none';
            document.getElementById('admin_notes').value = '';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('rejectModal');
            if (event.target == modal) {
                closeRejectModal();
            }
        }
    </script>
</body>
</html>
