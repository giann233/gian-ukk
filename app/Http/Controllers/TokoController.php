<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TokoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // All authenticated users can view all stores for browsing
        // Management features (edit/delete) are controlled by the view based on ownership
        $tokos = Toko::with('user')->paginate(10);

        return view('tokos.index', compact('tokos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = \App\Models\User::where('role', 'member')->get();
        return view('tokos.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kontak_toko' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
        ]);

        $data = $request->all();

        if (auth()->user()->role === 'admin') {
            // Admin can create toko for any member
            $request->validate([
                'id_user' => 'required|exists:users,id',
            ]);
            $user = \App\Models\User::findOrFail($data['id_user']);
            if ($user->role !== 'member') {
                return redirect()->back()->withErrors(['id_user' => 'Hanya bisa membuat toko untuk member.']);
            }
        } else {
            // Member creates their own toko
            $data['id_user'] = auth()->id();
        }

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('tokos', 'public');
        }

        Toko::create($data);

        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.tokos.index')->with('success', 'Toko berhasil dibuat untuk member.');
        } else {
            return redirect()->route('tokos.my')->with('success', 'Toko berhasil dibuat.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $toko = Toko::with(['user', 'produks.kategori', 'produks.gambarProduks'])->findOrFail($id);

        // Members can view all stores for browsing
        return view('tokos.show', compact('toko'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $toko = Toko::with('user')->findOrFail($id);

        // Member can only edit their own toko (unless admin)
        if (auth()->user()->role !== 'admin' && $toko->id_user !== auth()->id()) {
            abort(403, 'Unauthorized. You can only edit your own toko.');
        }

        return view('tokos.edit', compact('toko'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kontak_toko' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
        ]);

        $toko = Toko::findOrFail($id);

        // Member can only update their own toko (unless admin)
        if (auth()->user()->role !== 'admin' && $toko->id_user !== auth()->id()) {
            abort(403, 'Unauthorized. You can only update your own toko.');
        }

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('tokos', 'public');
        }

        $toko->update($data);

        return redirect()->route('admin.tokos.index')->with('success', 'Toko berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $toko = Toko::findOrFail($id);

        // Member can only delete their own toko (unless admin)
        if (auth()->user()->role !== 'admin' && $toko->id_user !== auth()->id()) {
            abort(403, 'Unauthorized. You can only delete your own toko.');
        }

        $toko->delete();

        return redirect()->route('tokos.index')->with('success', 'Toko berhasil dihapus.');
    }
}
