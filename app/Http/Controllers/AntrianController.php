<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Illuminate\Http\Request;

class AntrianController extends Controller
{
    public function guest()
    {
        return view('guest');
    }

    public function daftar(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
        ]);

        $nomorTerakhir = Antrian::max('nomor') ?? 0;
        $nomorBaru = $nomorTerakhir + 1;

        $antrian = Antrian::create([
            'nomor' => $nomorBaru,
            'nama' => $request->nama,
            'status' => 'menunggu',
        ]);

        return redirect()->route('guest.nomor', $antrian->id);
    }

    public function nomor($id)
    {
        $antrian = Antrian::findOrFail($id);

        return view('nomor', compact('antrian'));
    }

    public function admin()
{
    $menunggu = Antrian::where('status', 'menunggu')
        ->orderBy('nomor', 'asc')
        ->get();

    $terlambat = Antrian::where('status', 'terlambat')
        ->orderBy('nomor', 'asc')
        ->get();

    $dipanggil = Antrian::where('status', 'dipanggil')
        ->latest('called_at')
        ->first();

    return view('admin', compact('menunggu', 'terlambat', 'dipanggil'));
}

public function panggilBerikutnya()
{
    // Ambil antrian pertama yang masih menunggu
    $antrian = Antrian::where('status', 'menunggu')
        ->orderBy('nomor', 'asc')
        ->first();

    // Kalau tidak ada antrian menunggu
    if (!$antrian) {
        return redirect()->route('admin')->with('error', 'Tidak ada antrian yang menunggu.');
    }

    // Antrian yang sebelumnya dipanggil dianggap selesai
    Antrian::where('status', 'dipanggil')
        ->update([
            'status' => 'selesai',
        ]);

    // Update antrian baru menjadi dipanggil
    $antrian->update([
        'status' => 'dipanggil',
        'called_at' => now(),
    ]);

    return redirect()->route('admin')->with('success', 'Nomor antrian berhasil dipanggil.');
}

public function tandaiTerlambat($id)
{
    $antrian = Antrian::findOrFail($id);

    if ($antrian->status !== 'menunggu') {
        return redirect()->route('admin')->with('error', 'Antrian ini tidak bisa ditandai terlambat.');
    }

    $antrian->update([
        'status' => 'terlambat',
    ]);

    return redirect()->route('admin')->with('success', 'Antrian berhasil dimasukkan ke list terlambat.');
}

public function panggilTerlambat($id)
{
    $antrian = Antrian::findOrFail($id);

    if ($antrian->status !== 'terlambat') {
        return redirect()->route('admin')->with('error', 'Antrian ini bukan antrian terlambat.');
    }

    Antrian::where('status', 'dipanggil')
        ->update([
            'status' => 'selesai',
        ]);

    $antrian->update([
        'status' => 'dipanggil',
        'called_at' => now(),
    ]);

    return redirect()->route('admin')->with('success', 'Antrian terlambat berhasil dipanggil.');
}
}