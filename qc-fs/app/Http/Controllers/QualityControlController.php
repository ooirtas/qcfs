<?php

namespace App\Http\Controllers;
use App\Models\QualityControl;
use App\Models\ProsesProduksi;
use App\Models\Produksi; 
use App\Models\Barang;
use App\Http\Requests\QCStoreRequest;
use Illuminate\Http\Request;

class QualityControlController extends Controller
{
    public function index()
    {
        $title = 'Menu Quality Control';
        $qualityControls = QualityControl::with('prosesProduksi')->get();
        return view('qualityControls.index', compact('title'), ['qualityControls' => $qualityControls]);
    }

    public function create()
    {
        $title = 'Tambah Quality Control';
        $today = date('Y-m-d');
        $prosesProduksis = ProsesProduksi::where('status', 2)->get();
        return view('qualityControls.create', compact('title', 'today', 'prosesProduksis'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_proses' => 'required|exists:proses_produksis,kode_proses',
            'layak' => 'required|integer|min:0',
            'reject' => 'required|integer|min:0',
            'repair' => 'required|integer|min:0',
            'deskripsi_repair' => 'nullable|string',
        ]);

        $prosesProduksi = ProsesProduksi::where('kode_proses', $validatedData['kode_proses'])->first();

        if (!$prosesProduksi) {
            return redirect(route('qualityControls.create'))->with('error', 'Proses Produksi tidak ditemukan.');
        }

        $totalQC = intval($validatedData['layak']) + intval($validatedData['repair']) + intval($validatedData['reject']);

        if ($totalQC !== intval($prosesProduksi->jumlah_barang)) {
            return redirect(route('qualityControls.create'))
                    ->withInput()
                    ->with('error', 'Total layak, repair, dan reject harus sama dengan jumlah barang. Total yang dimasukan baru ' . $totalQC );
        }
        

        $qc = QualityControl::create([
            'tanggal_qc' => date('Y-m-d'),
            'kode_proses' => $validatedData['kode_proses'],
            'layak' => $validatedData['layak'],
            'reject' => $validatedData['reject'],
            'repair' => $validatedData['repair'],
            'deskripsi_repair' => $validatedData['deskripsi_repair'],
            'diperiksa' => 'Tim QC',
        ]);

        $prosesProduksi->status = 3;
        $prosesProduksi->save();
        Produksi::where('kode_produksi', $prosesProduksi->kode_produksi)->update(['status' => 1, 'barang_diproses' => $validatedData['layak']]);

        $produksi = Produksi::where('kode_produksi', $prosesProduksi->kode_produksi)->first();
        if ($produksi) {
            if ($produksi->jumlah_proses === $prosesProduksi->proses_ke) {
                $barang = Barang::find($produksi->id_barang);
                if ($barang) {
                    $barang->stock += $validatedData['layak'];
                    $barang->save();
                }
                $produksi->status = 3;
                $produksi->save();
            }
        }
        
        return redirect(route('qualityControls.index'))->with('success', 'Berhasil Ditambahkan!');
    }

}
