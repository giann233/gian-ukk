<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight animate-fade-in">
                <i class="bi bi-shop-plus-fill mr-3 text-blue-600 animate-pulse"></i>Permintaan Toko
            </h2>
            @if(auth()->user()->role === 'member')
                @php
                    $existingToko = \App\Models\Toko::where('id_user', auth()->id())->first();
                    $pendingRequest = \App\Models\TokoRequest::where('id_user', auth()->id())->where('status', 'pending')->first();
                @endphp
                @if(!$existingToko && !$pendingRequest)
                    <a href="{{ route('toko_requests.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-blue-200 shadow-md hover:shadow-xl hover:scale-105 transform">
                        <i class="bi bi-plus-circle-fill mr-2 transition-transform duration-300 hover:rotate-12"></i>Ajukan Toko Baru
                    </a>
                @endif
            @endif
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6 animate-slide-down">
                    <div class="flex items-center">
                        <i class="bi bi-check-circle-fill text-green-500 text-xl mr-3 animate-bounce"></i>
                        <span class="text-green-800 font-semibold">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6 animate-slide-down">
                    <div class="flex items-center">
                        <i class="bi bi-exclamation-triangle-fill text-red-500 text-xl mr-3 animate-pulse"></i>
                        <span class="text-red-800 font-semibold">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            <!-- Status Messages for Members -->
            @if(auth()->user()->role === 'member')
                @php
                    $existingToko = \App\Models\Toko::where('id_user', auth()->id())->first();
                    $pendingRequest = \App\Models\TokoRequest::where('id_user', auth()->id())->where('status', 'pending')->first();
                @endphp

                @if($existingToko)
                    <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-6 animate-fade-in-up">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <i class="bi bi-check-circle-fill text-green-500 text-2xl mr-4 animate-pulse"></i>
                                <div>
                                    <h3 class="text-lg font-bold text-green-800">Toko Anda Sudah Aktif!</h3>
                                    <p class="text-green-700">Selamat! Toko Anda telah disetujui admin dan siap digunakan untuk berjualan.</p>
                                </div>
                            </div>
                            <a href="{{ route('tokos.show', $existingToko->id) }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded-lg transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-green-200 shadow-md hover:shadow-xl hover:scale-105 transform">
                                <i class="bi bi-shop mr-2 transition-transform duration-300 hover:rotate-12"></i>Kelola Toko
                            </a>
                        </div>
                    </div>
                @elseif($pendingRequest)
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6 animate-fade-in-up">
                        <div class="flex items-center">
                            <i class="bi bi-clock-fill text-blue-500 text-2xl mr-4 animate-spin"></i>
                            <div>
                                <h3 class="text-lg font-bold text-blue-800">Permintaan Sedang Diproses Admin</h3>
                                <p class="text-blue-700">Permintaan toko Anda telah diterima dan sedang ditinjau oleh admin. Biasanya memakan waktu 1-3 hari kerja.</p>
                                <div class="mt-2">
                                    <small class="text-blue-600">
                                        <i class="bi bi-calendar-event mr-1"></i>Diajukan: {{ $pendingRequest->created_at->format('d M Y, H:i') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif

            <!-- Requests Table -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg border border-gray-100 animate-fade-in-up">
                <div class="bg-blue-600 p-6 text-white">
                    <h3 class="text-xl font-bold mb-2 animate-slide-in-left">
                        <i class="bi bi-list-check mr-2 animate-bounce"></i>Daftar Permintaan Toko
                    </h3>
                    <p class="opacity-90 mb-0 animate-slide-in-right">Kelola semua permintaan toko yang ada di sistem</p>
                </div>

                <div class="p-6">
                    @if($requests->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                            <i class="bi bi-shop mr-2"></i>Nama Toko
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                            <i class="bi bi-person mr-2"></i>Pemohon
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                            <i class="bi bi-info-circle mr-2"></i>Status
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                            <i class="bi bi-calendar mr-2"></i>Tanggal
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                            <i class="bi bi-gear mr-2"></i>Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($requests as $request)
                                        <tr class="hover:bg-gray-50 transition-all duration-300 hover:scale-[1.01] hover:shadow-md animate-fade-in-up" style="animation-delay: {{ $loop->index * 0.1 }}s">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                                            <i class="bi bi-shop text-white text-sm"></i>
                                                        </div>
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-bold text-gray-900">{{ $request->nama_toko }}</div>
                                                        <div class="text-sm text-gray-500">{{ Str::limit($request->deskripsi, 30) }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-semibold text-gray-900">{{ $request->user->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $request->user->email }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($request->status === 'pending')
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-yellow-400 to-orange-500 text-white">
                                                        <i class="bi bi-clock mr-1"></i>Menunggu
                                                    </span>
                                                @elseif($request->status === 'approved')
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-green-400 to-emerald-500 text-white">
                                                        <i class="bi bi-check-circle mr-1"></i>Disetujui
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-red-400 to-pink-500 text-white">
                                                        <i class="bi bi-x-circle mr-1"></i>Ditolak
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <div class="font-semibold">{{ $request->created_at->format('d M Y') }}</div>
                                                <div class="text-xs">{{ $request->created_at->format('H:i') }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                                <a href="{{ route('toko_requests.show', $request->id) }}" class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-blue-500 hover:bg-blue-600 text-white transition-all duration-300 hover:scale-110 hover:shadow-lg">
                                                    <i class="bi bi-eye mr-1 transition-transform duration-300 hover:rotate-12"></i>Lihat
                                                </a>

                                                @if(auth()->user()->role === 'admin' && $request->status === 'pending')
                                                    <form action="{{ route('toko_requests.approve', $request->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-green-500 hover:bg-green-600 text-white transition-all duration-300 hover:scale-110 hover:shadow-lg mr-1" onclick="return confirm('Apakah Anda yakin ingin menyetujui permintaan ini?')">
                                                            <i class="bi bi-check-circle mr-1 transition-transform duration-300 hover:rotate-12"></i>Setujui
                                                        </button>
                                                    </form>

                                                    <button type="button" class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-red-500 hover:bg-red-600 text-white transition-all duration-300 hover:scale-110 hover:shadow-lg" onclick="openRejectModal({{ $request->id }})">
                                                        <i class="bi bi-x-circle mr-1 transition-transform duration-300 hover:rotate-12"></i>Tolak
                                                    </button>
                                                @endif

                                                @if(auth()->user()->role === 'member' && $request->status === 'pending' && $request->id_user === auth()->id())
                                                    <form action="{{ route('toko_requests.destroy', $request->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-red-500 hover:bg-red-600 text-white transition-all duration-300 hover:scale-110 hover:shadow-lg" onclick="return confirm('Apakah Anda yakin ingin menghapus permintaan ini?')">
                                                            <i class="bi bi-trash mr-1 transition-transform duration-300 hover:rotate-12"></i>Hapus
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $requests->links() }}
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-12 animate-fade-in-up">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-400 rounded-full mb-4 animate-pulse">
                                <i class="bi bi-shop text-white text-2xl animate-bounce"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2 animate-slide-in-left">Belum Ada Permintaan Toko</h3>
                            <p class="text-gray-500 mb-6 animate-slide-in-right">Saat ini belum ada permintaan toko yang diajukan.</p>
                            @if(auth()->user()->role === 'member')
                                @php
                                    $existingToko = \App\Models\Toko::where('id_user', auth()->id())->first();
                                    $pendingRequest = \App\Models\TokoRequest::where('id_user', auth()->id())->where('status', 'pending')->first();
                                @endphp
                                @if(!$existingToko && !$pendingRequest)
                                    <a href="{{ route('toko_requests.create') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-blue-200 shadow-md hover:shadow-xl hover:scale-105 transform animate-fade-in">
                                        <i class="bi bi-plus-circle-fill mr-2 transition-transform duration-300 hover:rotate-12"></i>Ajukan Toko Baru
                                    </a>
                                @endif
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-lg bg-white">
            <div class="bg-red-500 p-4 text-white rounded-t-lg">
                <h3 class="text-lg font-bold">
                    <i class="bi bi-x-circle-fill mr-2"></i>Tolak Permintaan Toko
                </h3>
            </div>
            <form id="rejectForm" method="POST" class="p-6">
                @csrf
                <div class="mb-4">
                    <label for="admin_notes" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="bi bi-card-text mr-2 text-red-500"></i>Catatan Admin (Opsional)
                    </label>
                    <textarea name="admin_notes" id="admin_notes" rows="4" class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg shadow-sm focus:outline-none focus:ring-4 focus:ring-red-100 focus:border-red-500 transition-all duration-200 text-gray-900 placeholder-gray-400 resize-none" placeholder="Berikan alasan penolakan..."></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeRejectModal()" class="px-6 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold rounded-lg transition-all duration-200">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-2 bg-red-500 hover:bg-red-600 text-white font-bold rounded-lg transition-all duration-200 focus:outline-none focus:ring-4 focus:ring-red-200 shadow-md hover:shadow-lg">
                        <i class="bi bi-x-circle mr-2"></i>Tolak Permintaan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in { animation: fadeIn 0.6s ease-out; }
        .animate-fade-in-up { animation: fadeInUp 0.8s ease-out; }
        .animate-slide-in-left { animation: slideInLeft 0.8s ease-out; }
        .animate-slide-in-right { animation: slideInRight 0.8s ease-out; }
        .animate-slide-down { animation: slideDown 0.5s ease-out; }
    </style>

    <script>
        let currentRequestId = null;

        function openRejectModal(requestId) {
            currentRequestId = requestId;
            const modal = document.getElementById('rejectModal');
            modal.classList.remove('hidden');
            modal.style.animation = 'fadeIn 0.3s ease-out';
            document.getElementById('rejectForm').action = `/toko_requests/${requestId}/reject`;
        }

        function closeRejectModal() {
            const modal = document.getElementById('rejectModal');
            modal.style.animation = 'fadeOut 0.3s ease-out';
            setTimeout(() => {
                modal.classList.add('hidden');
                document.getElementById('admin_notes').value = '';
                currentRequestId = null;
            }, 300);
        }

        // Add loading animation on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Add stagger animation to table rows
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach((row, index) => {
                row.style.animationDelay = `${index * 0.1}s`;
            });

            // Add hover effects to buttons
            const buttons = document.querySelectorAll('button, a');
            buttons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.05)';
                });
                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
                });
            });
        });
    </script>
</x-app-layout>
