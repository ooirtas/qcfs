<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BarangStoreRequest;
use App\Http\Requests\BarangUpdateRequest;
use App\Models\Barang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Psy\Readline\Hoa\Console;

class BarangController extends Controller
{

    public function index()
    {
        $title = 'Menu Barang';
        $barang = Barang::all()->where('status','=','1');
        return view('barangs.index', compact('title'), ['barangs' => $barang]);
    }

    public function create()
    {
        $title = 'Form Barang';
        $lastBarang = Barang::latest('id_barang')->first();
        $nextKode = ($lastBarang) ? $lastBarang->id_barang + 1 : 1;
    
        return view('barangs.create', compact('title', 'nextKode'));
    }
    

    public function store(BarangStoreRequest $request)
    {
        $validatedData = $request->validate([
            'nama_barang' => 'required|string|max:255',
        ]);
    
        Barang::create([
            'nama_barang' => $validatedData['nama_barang'],
            'stock' => 0,
            'status' => 1,
        ]);
    
        return redirect()->route('barangs.index')->with('success', 'Barang berhasil ditambahkan!');
    }


    public function edit($id)
    {
        $title = 'Edit Barang';
        $barang = Barang::findOrFail($id);
        return view('barangs.edit', compact('title','barang'));
    }

   
    public function update(BarangUpdateRequest $request, $id)
    {
        $barang = Barang::findOrFail($id);
        $param = $request->validated();

        if ($barang->update($param)) {
            $barang->save();

            return redirect(route('barangs.index'))->with('success', 'Berhasil Diperbaharui!');
        }
    }

    public function destroy($id)
    {
        $barang = Barang::where('id_barang', $id)->firstOrFail();

        if ($barang->update(['status' => 0])) {
            return redirect(route('barangs.index'))->with('success', 'Berhasil Hapus Data!');
        } else {
            return redirect(route('barangs.index'))->with('error', 'Gagal Hapus Data!');
        }
    }
}
