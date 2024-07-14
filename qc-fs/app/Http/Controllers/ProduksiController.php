<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProduksiStoreRequest;
use App\Http\Requests\ProduksiUpdateRequest;
use App\Models\Barang;
use App\Models\Produksi;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Psy\Readline\Hoa\Console;

class ProduksiController extends Controller
{

    public function index()
    {
        $title = 'Menu Produksi';
        $produksi = Produksi::join('barangs', 'produksis.id_barang', '=', 'barangs.id_barang')
            ->select('produksis.*', 'barangs.nama_barang')
            ->where('produksis.status', '!=', 0)
            ->get();
        return view('Produksi.index', compact('title'), ['produksi' => $produksi]);
    }

    public function create()
    {
        $title = 'Form Produksi';
        $produksi = Barang::where('status', 1)->get();
        return view('Produksi.create', compact('title', 'produksi'));
    }
    

    public function store(ProduksiStoreRequest $request)
    {
        $validatedData = $request->validate([
            'nama_produksi' => 'required|string|max:100',
            'id_barang' => 'required',
            'jumlah_produksi' => 'required',
            'jumlah_proses' => 'required'
        ]);
    
        Produksi::create([
            'nama_produksi' => $validatedData['nama_produksi'],
            'id_barang' => $validatedData['id_barang'],
            'jumlah_produksi' => $validatedData['jumlah_produksi'],
            'jumlah_proses' => $validatedData['jumlah_proses'],
            'barang_diproses' => $validatedData['jumlah_produksi'],
            'status' => 1,
        ]);
    
        return redirect()->route('produksi.index')->with('success', 'Produksi berhasil ditambahkan!');
    }


    public function edit($id)
    {
        $title = 'Edit Produksi';
        $produksi = Produksi::findOrFail($id);
        return view('Produksi.edit', compact('title','produksi'));
    }

   
    public function update(ProduksiUpdateRequest $request, $id)
    {
        $produksi = Produksi::findOrFail($id);
        $param = $request->validated();

        if ($produksi->update($param)) {
            $produksi->save();

            return redirect(route('produksi.index'))->with('success', 'Berhasil Diperbaharui!');
        }
    }

    public function destroy($id)
    {
        $produksi = Produksi::where('kode_produksi', $id)->firstOrFail();

        if ($produksi->update(['status' => 0])) {
            return redirect(route('produksi.index'))->with('success', 'Berhasil Hapus Data!');
        } else {
            return redirect(route('produksi.index'))->with('error', 'Gagal Hapus Data!');
        }
    }
}
