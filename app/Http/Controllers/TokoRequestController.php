<?php

namespace App\Http\Controllers;

use App\Models\TokoRequest;
use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TokoRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Admin can view all requests, members can only view their own requests
        if (auth()->user()->role === 'admin') {
            $requests = TokoRequest::with('user')->paginate(10);
        } else {
            $requests = TokoRequest::with('user')->where('id_user', Auth::id())->paginate(10);
        }
        return view('toko_requests.index', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Check if member already has a toko or pending request
        $existingToko = Toko::where('id_user', Auth::id())->first();
        $pendingRequest = TokoRequest::where('id_user', Auth::id())
            ->where('status', 'pending')
            ->first();

        if ($existingToko) {
            return redirect()->route('toko_requests.index')->with('error', 'Anda sudah memiliki toko.');
        }

        if ($pendingRequest) {
            return redirect()->route('toko_requests.index')->with('error', 'Anda sudah memiliki permintaan toko yang sedang diproses.');
        }

        return view('toko_requests.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kontak_toko' => 'required|string|max:255',
            'alamat' => 'nullable|string',
        ]);

        // Check if member already has a toko or pending request
        $existingToko = Toko::where('id_user', Auth::id())->first();
        $pendingRequest = TokoRequest::where('id_user', Auth::id())
            ->where('status', 'pending')
            ->first();

        if ($existingToko) {
            return redirect()->back()->withErrors(['error' => 'Anda sudah memiliki toko.']);
        }

        if ($pendingRequest) {
            return redirect()->back()->withErrors(['error' => 'Anda sudah memiliki permintaan toko yang sedang diproses.']);
        }

        TokoRequest::create([
            'nama_toko' => $request->nama_toko,
            'deskripsi' => $request->deskripsi,
            'kontak_toko' => $request->kontak_toko,
            'alamat' => $request->alamat,
            'id_user' => Auth::id(),
        ]);

        return redirect()->route('toko_requests.index')->with('success', 'Permintaan toko berhasil dikirim. Tunggu konfirmasi dari admin.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tokoRequest = TokoRequest::with('user')->findOrFail($id);

        // Members can view their own requests, admin can view all
        if (auth()->user()->role === 'member' && $tokoRequest->id_user !== auth()->id()) {
            abort(403, 'Unauthorized.');
        }

        return view('toko_requests.show', compact('tokoRequest'));
    }

    /**
     * Approve a toko request (Admin only)
     */
    public function approve(string $id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Only admin can approve requests.');
        }

        $tokoRequest = TokoRequest::findOrFail($id);

        if ($tokoRequest->status !== 'pending') {
            return redirect()->back()->withErrors(['error' => 'Request sudah diproses.']);
        }

        // Create the toko
        Toko::create([
            'nama_toko' => $tokoRequest->nama_toko,
            'deskripsi' => $tokoRequest->deskripsi,
            'kontak_toko' => $tokoRequest->kontak_toko,
            'alamat' => $tokoRequest->alamat,
            'id_user' => $tokoRequest->id_user,
        ]);

        // Update request status
        $tokoRequest->update(['status' => 'approved']);

        return redirect()->route('toko_requests.index')->with('success', 'Permintaan toko berhasil disetujui dan toko telah dibuat.');
    }

    /**
     * Reject a toko request (Admin only)
     */
    public function reject(Request $request, string $id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Only admin can reject requests.');
        }

        $request->validate([
            'admin_notes' => 'nullable|string',
        ]);

        $tokoRequest = TokoRequest::findOrFail($id);

        if ($tokoRequest->status !== 'pending') {
            return redirect()->back()->withErrors(['error' => 'Request sudah diproses.']);
        }

        $tokoRequest->update([
            'status' => 'rejected',
            'admin_notes' => $request->admin_notes,
        ]);

        return redirect()->route('toko_requests.index')->with('success', 'Permintaan toko berhasil ditolak.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tokoRequest = TokoRequest::findOrFail($id);

        // Members can delete their own pending requests, admin can delete any
        if (auth()->user()->role === 'member' && ($tokoRequest->id_user !== auth()->id() || $tokoRequest->status !== 'pending')) {
            abort(403, 'Unauthorized.');
        }

        $tokoRequest->delete();

        return redirect()->route('toko_requests.index')->with('success', 'Permintaan toko berhasil dihapus.');
    }
}
