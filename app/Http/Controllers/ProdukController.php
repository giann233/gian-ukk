<?php

namespace App\Http\Controllers;

use App\Models\GambarProduk;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // All authenticated users can view all products for browsing
        // Management features (edit/delete) are controlled by the view based on ownership
        $produks = Produk::with(['kategori', 'toko', 'gambarProduks'])->paginate(12);

        return view('produks.index', compact('produks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        if (auth()->user()->role === 'admin') {
            $tokos = Toko::all();
        } else {
            $tokos = Toko::where('id_user', Auth::id())->get();
            if ($tokos->isEmpty()) {
                return redirect()->route('tokos.create')->with('warning', 'Anda belum memiliki toko. Silakan buat toko terlebih dahulu sebelum menambah produk.');
            }
        }
        return view('produks.create', compact('kategoris', 'tokos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategori,id',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string|max:1000',
            'id_toko' => 'required|exists:toko,id',
            'gambar' => 'required|array|min:1|max:3',
            'gambar.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Ensure the selected store belongs to the authenticated user (unless admin)
        if (auth()->user()->role !== 'admin') {
            $toko = Toko::where('id', $request->id_toko)->where('id_user', Auth::id())->first();
            if (!$toko) {
                abort(403, 'Unauthorized. You can only create products for your own store.');
            }
        }

        $data = $request->all();
        $data['tanggal_upload'] = now();

        $produk = Produk::create($data);

        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $path = $file->store('produks', 'public');
                GambarProduk::create([
                    'id_produk' => $produk->id,
                    'nama_file' => $path,
                ]);
            }
        }

        return redirect()->route('produks.index', ['created' => '1'])->with('success', 'Produk berhasil dibuat dan langsung tersedia untuk siswa!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $produk = Produk::with(['kategori', 'toko', 'gambarProduks'])->findOrFail($id);

        // Anyone can view products for browsing/purchasing
        return view('produks.show', compact('produk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $produk = Produk::with(['kategori', 'toko', 'gambarProduks'])->findOrFail($id);

        // Member can only edit their own produk (unless admin)
        if (auth()->user()->role !== 'admin' && $produk->toko->id_user !== auth()->id()) {
            abort(403, 'Unauthorized. You can only edit your own produk.');
        }

        $kategoris = Kategori::all();
        if (auth()->user()->role === 'admin') {
            $tokos = Toko::all();
        } else {
            // Member can only see their own tokos
            $tokos = Toko::where('id_user', Auth::id())->get();
        }
        return view('produks.edit', compact('produk', 'kategoris', 'tokos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategori,id',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'id_toko' => 'required|exists:toko,id',
            'gambar.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $produk = Produk::findOrFail($id);

        // Member can only update their own produk (unless admin)
        if (auth()->user()->role !== 'admin' && $produk->toko->id_user !== auth()->id()) {
            abort(403, 'Unauthorized. You can only update your own produk.');
        }

        $data = $request->all();

        $produk->update($data);

        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $path = $file->store('produks', 'public');
                GambarProduk::create([
                    'id_produk' => $produk->id,
                    'nama_file' => $path,
                ]);
            }
        }

        return redirect()->route('produks.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produk = Produk::findOrFail($id);

        // Member can only delete their own produk (unless admin)
        if (auth()->user()->role !== 'admin' && $produk->toko->id_user !== auth()->id()) {
            abort(403, 'Unauthorized. You can only delete your own produk.');
        }

        $produk->delete();

        return redirect()->route('produks.index')->with('success', 'Produk berhasil dihapus.');
    }
     public function tambah()
    {
        $kategoris = Kategori::all();
        if (auth()->user()->role === 'member') {
            $tokos = Toko::all();
        } else {
            $tokos = Toko::where('id_user', Auth::id())->get();
            if ($tokos->isEmpty()) {
                return redirect()->route('tokos.create')->with('warning', 'Anda belum memiliki toko. Silakan buat toko terlebih dahulu sebelum menambah produk.');
            }
        }
        return view('produks.create', compact('kategoris', 'tokos'));
    }


}
