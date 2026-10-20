<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalPeriksaController extends Controller
{
    public function index()
    {
        $jadwals = JadwalPeriksa::where(
            'id_dokter',
            Auth::id()
        )->orderBy('hari')->get();

        return view('dokter.jadwal-periksa.index', compact('jadwals'));
    }

    public function create()
    {
        return view('dokter.jadwal-periksa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);

        JadwalPeriksa::create([
            'id_dokter' => Auth::id(),
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()->route('jadwal-periksa.index')
            ->with('message', 'Jadwal berhasil ditambahkan')
            ->with('type', 'success');
    }

    public function edit($id)
    {
        $jadwal = JadwalPeriksa::where(
            'id_dokter',
            Auth::id()
        )->findOrFail($id);

        return view('dokter.jadwal-periksa.edit', compact('jadwal'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);

        $jadwal = JadwalPeriksa::where(
            'id_dokter',
            Auth::id()
        )->findOrFail($id);

        $jadwal->update([
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()->route('jadwal-periksa.index')
            ->with('message', 'Jadwal berhasil diperbarui')
            ->with('type', 'success');
    }

    public function destroy($id)
    {
        $jadwal = JadwalPeriksa::where(
            'id_dokter',
            Auth::id()
        )->findOrFail($id);

        $jadwal->delete();

        return redirect()->route('jadwal-periksa.index')
            ->with('message', 'Jadwal berhasil dihapus')
            ->with('type', 'success');
    }
}