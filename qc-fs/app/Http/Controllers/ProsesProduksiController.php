<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProsesProduksi;
use App\Models\Produksi; 


class ProsesProduksiController extends Controller
{
    public function index()
    {
        $title = 'Proses Produksi';
        $proses_produksi = ProsesProduksi::all();

        return view('ProsesProduksi.index', compact('title'), ['proses_produksis' => $proses_produksi]);
    }

    public function selesaikan_proses($kode_proses)
    {
        $proses_produksi = ProsesProduksi::where('kode_proses', $kode_proses)->first();
    
        if (!$proses_produksi) {
            return redirect()->route('ProsesProduksi.index')->with('error', 'Data tidak ditemukan');
        }
    
        $proses_produksi->update(['status' => 2]);
    
        return redirect()->route('ProsesProduksi.index')->with('success', 'Proses berhasil diselesaikan');
    }
    
    
    public function create()
    {
        $produksis = Produksi::where('status', 1)->get();
        $title = 'Form Proses';
    
        return view('ProsesProduksi.create', compact('title', 'produksis'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_proses' => 'required|string|max:255',
            'kode_produksi' => 'required|string',
            'proses_ke' => 'required|integer',
            'jumlah_barang' => 'required|integer',
        ]);
    
        // Simpan data proses produksi
        ProsesProduksi::create([
            'tanggal_proses' => date('Y-m-d'),
            'nama_proses' => $validatedData['nama_proses'],
            'kode_produksi' => $validatedData['kode_produksi'],
            'proses_ke' => $validatedData['proses_ke'],
            'jumlah_barang' => $validatedData['jumlah_barang'],
            'status' => 1,
        ]);
    
        $produksi = Produksi::find($validatedData['kode_produksi']);
        if ($produksi) {
            $produksi->status = 2;
            $produksi->save();
        }
    
        return redirect()->route('ProsesProduksi.index')->with('success', 'Data proses produksi berhasil ditambahkan!');
    }
    

    public function getLatestProsesKe($kode_produksi)
    {
        $latestProsesKe = ProsesProduksi::where('kode_produksi', $kode_produksi)
                                        ->max('proses_ke');
    
        return response()->json(['latest_proses_ke' => $latestProsesKe]);
    }

    public function getJumlahBarang($kode_produksi)
    {
        $jumlahBarang = Produksi::where('kode_produksi', $kode_produksi)->value('barang_diproses');
    
        return response()->json(['barang_diproses' => $jumlahBarang]);
    }
    

    
}
