<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Obat;

class ObatController extends Controller
{
    public function index()
    {
        $obats = Obat::all();
        return view('admin.obat.index', compact('obats'));
    }

    public function create()
    {
        return view('admin.obat.create');
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:35',
            'harga' => 'required|integer|min:0',
        ]);

        Obat::create([
            'nama_obat' => $request->nama_obat,
            'kemasan' => $request->kemasan,
            'harga' => $request->harga
        ]);

        return redirect()->route('obat.index')
            ->with('success', 'Obat berhasil ditambahkan')
            ->with('type', 'success');
    }


    public function edit(string $id)
    {
        $obats = Obat::findOrFail($id);
        return view('admin.obat.edit', compact('obats'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_obat' => 'required|string',
            'kemasan' => 'nullable|string',
            'harga' => 'required|integer',
        ]);

        $obat = Obat::findOrFail($id);

        $obat->update([
            'nama_obat' => $request->nama_obat,
            'kemasan' => $request->kemasan,
            'harga' => $request->harga,
        ]);

        return redirect()->route('obat.index')
            ->with('success', 'Data Obat berhasil diperbarui')
            ->with('type', 'success');
    }

    public function destroy(string $id)
    {
        $obats = Obat::findOrFail($id);
        $obats->delete();
        return redirect()->route('obat.index')->with('success', 'Obat Berhasil di hapus !');
    }
}
