{{-- <x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
        <div class="w-full sm:max-w-lg mt-6 px-8 py-6 bg-white shadow-2xl overflow-hidden sm:rounded-2xl border border-gray-100">
            <!-- Logo and Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full mb-4 shadow-lg">
                    <i class="bi bi-shop text-white text-2xl"></i>
                </div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-2">
                    Marketplace Sekolah
                </h1>
                <p class="text-gray-600 text-lg">Masuk ke Akun Anda</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-6" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-6" :errors="$errors" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-semibold text-gray-700">
                        <i class="bi bi-envelope-fill mr-2 text-blue-500"></i>Email
                    </label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 text-gray-900 placeholder-gray-400"
                           placeholder="Masukkan email Anda">
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-semibold text-gray-700">
                        <i class="bi bi-lock-fill mr-2 text-blue-500"></i>Password
                    </label>
                    <input id="password" type="password" name="password" required
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 text-gray-900 placeholder-gray-400"
                           placeholder="Masukkan password Anda">
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" type="checkbox" name="remember"
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="remember_me" class="ml-3 block text-sm text-gray-700 font-medium">
                            Ingat saya
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-blue-600 hover:text-blue-800 font-medium transition-colors duration-200" href="{{ route('password.request') }}">
                            Lupa password?
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold py-3 px-6 rounded-xl transition-all duration-200 focus:outline-none focus:ring-4 focus:ring-blue-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    <i class="bi bi-box-arrow-in-right mr-2"></i>Masuk
                </button>
            </form>

            <!-- Divider -->
            <div class="mt-8 mb-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-gray-500 font-medium">atau</span>
                    </div>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="text-center space-y-4">
                <div class="bg-gradient-to-r from-green-50 to-blue-50 rounded-xl p-4 border border-green-100">
                    <div class="flex items-center justify-center mb-2">
                        <i class="bi bi-info-circle-fill text-green-500 mr-2"></i>
                        <span class="text-sm font-semibold text-gray-700">Info Penting</span>
                    </div>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Marketplace tersedia untuk umum tanpa login. Login hanya diperlukan untuk member yang ingin mengelola toko dan menjual produk.
                    </p>
                </div>

                <div class="pt-2">
                    <p class="text-gray-600 mb-3">Belum punya akun?</p>
                    <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-blue-500 hover:from-green-600 hover:to-blue-600 text-white font-semibold rounded-xl transition-all duration-200 focus:outline-none focus:ring-4 focus:ring-green-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <i class="bi bi-person-plus-fill mr-2"></i>Daftar sebagai Member
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout> --}}
