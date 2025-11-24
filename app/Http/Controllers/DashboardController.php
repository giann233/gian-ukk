<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Toko;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Check if user is logged in and is admin
        if (auth()->check() && auth()->user()->role === 'admin') {
            // Admin dashboard - show all data for management
            $produks = Produk::with(['kategori', 'toko', 'gambarProduks'])->latest()->take(20)->get();
            $tokos = Toko::with('user')->latest()->take(10)->get();
            $totalUsers = \App\Models\User::count();
            $totalProduks = Produk::count();
            $totalTokos = Toko::count();

            return view('admin.dashboard', compact('produks', 'tokos', 'totalUsers', 'totalProduks', 'totalTokos'));
        }

        // Check if user is logged in as member
        if (auth()->check() && auth()->user()->role === 'member') {
            // Member dashboard - redirect to member-specific dashboard or show member options
            $kategoris = \App\Models\Kategori::with('produks')->get();
            $produks = Produk::with(['kategori', 'toko', 'gambarProduks'])->latest()->take(100)->get();
            $tokos = Toko::with('user')->latest()->take(8)->get();

            // Check if member has a store
            $userToko = auth()->user()->toko;
            $hasStore = $userToko ? true : false;

            return view('dashboard', compact('produks', 'tokos', 'kategoris', 'hasStore', 'userToko'));
        }

        // Default: Guest dashboard - show marketplace for browsing
        $kategoris = \App\Models\Kategori::with('produks')->get();
        $produks = Produk::with(['kategori', 'toko', 'gambarProduks'])->latest()->take(100)->get();
        $tokos = Toko::with('user')->latest()->take(8)->get();

        // Get popular products (randomized for now, can be improved with actual metrics later)
        $produkFavorit = Produk::with(['kategori', 'toko', 'gambarProduks'])
            ->inRandomOrder()
            ->take(12)
            ->get();

        return view('dashboard', compact('produks', 'tokos', 'kategoris', 'produkFavorit'));
    }

    public function admin()
    {
        // Admin dashboard - show all data for management
        $produks = Produk::with(['kategori', 'toko', 'gambarProduks'])->latest()->take(20)->get();
        $tokos = Toko::with('user')->latest()->take(10)->get();
        $totalUsers = \App\Models\User::count();
        $totalProduks = Produk::count();
        $totalTokos = Toko::count();

        return view('admin.dashboard', compact('produks', 'tokos', 'totalUsers', 'totalProduks', 'totalTokos'));
    }
}
