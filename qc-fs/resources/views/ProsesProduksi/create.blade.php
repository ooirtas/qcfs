@extends('layouts.app')

@section('title', 'Tambah Proses')

@section('contents')

<!-- Main -->
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Proses Produksi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('Dashboard.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Proses Produksi / Tambah Data</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <div class="alert-title">
                    <h4>Error!</h4>
                </div>
                Ada Beberapa Kesalahan dari Inputan Anda.
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <!-- Vertical Form -->
            <form class="row g-3" action="{{ route('ProsesProduksi.store') }}" method="post">
                @csrf

                <div class="col-12">
                    <label for="tanggal_proses" class="form-label form-label-sm" style="font-size: 14px;">Tanggal Proses</label>
                    <input type="text" class="form-control form-control-sm" id="tanggal_proses" name="tanggal_proses" readonly>
                </div>

                <div class="col-12">
                    <label for="kode_produksi" class="form-label form-label-sm" style="font-size: 14px;">Kode Produksi<span style="color: red;">*</span></label>
                    <select class="form-control form-control-sm" id="kode_produksi" name="kode_produksi" onchange="getLatestProsesKe();  getJumlahBarang();">
                        <option value="" selected disabled style="font-style: italic;">Pilih Data</option>
                        @foreach($produksis as $produksi)
                        <option value="{{ $produksi->kode_produksi }}">KPR00{{ $produksi->kode_produksi }} - {{ $produksi->nama_produksi }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12">
                    <label for="proses_ke" class="form-label form-label-sm" style="font-size: 14px;">Proses Ke- </label>
                    <input type="text" class="form-control form-control-sm" id="proses_ke" name="proses_ke" readonly>
                </div>

                <div class="col-12">
                    <label for="jumlah_barang" class="form-label form-label-sm" style="font-size: 14px;">Jumlah Barang</label>
                    <input type="text" class="form-control form-control-sm" id="jumlah_barang" name="jumlah_barang" readonly>
                </div>

                <div class="col-12">
                    <label for="nama_proses" class="form-label form-label-sm" style="font-size: 14px;">Nama Proses<span style="color: red;">*</span></label>
                    <input type="text" class="form-control form-control-sm" id="nama_proses" name="nama_proses">
                </div>

                <div class="col-12">
                    <input type="hidden" class="form-control form-control-sm" id="status" value="1" name="status">
                </div>
                <div class="text-end">
                    <a href="{{ route('ProsesProduksi.index') }}" class="btn btn-danger btn-sm">
                        <i class="bi bi-arrow-left-circle"></i> Kembali
                    </a>
                    <button type="reset" class="btn btn-warning btn-sm">
                        <i class="bi bi-x-circle"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-success btn-sm">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                </div>
            </form><!-- Vertical Form -->
        </div>
    </div>
</main>
<!-- End - Main -->

<script>

    document.addEventListener('DOMContentLoaded', function () {
        const tanggalProsesInput = document.getElementById('tanggal_proses');
        const now = new Date();
        const day = String(now.getDate()).padStart(2, '0');
        const month = String(now.getMonth() + 1).padStart(2, '0'); // Perhatikan penggunaan now.getMonth() + 1 untuk bulan
        const year = now.getFullYear();
        const formattedDate = `${day}-${month}-${year}`;
        tanggalProsesInput.value = formattedDate; // Menampilkan tanggal dengan format 07-08-2024

    });

    function getLatestProsesKe() {
        var kodeProduksi = document.getElementById('kode_produksi').value;
        fetch('/getLatestProsesKe/' + kodeProduksi)
            .then(response => response.json())
            .then(data => {
                document.getElementById('proses_ke').value = data.latest_proses_ke + 1;
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

function getJumlahBarang() {
    var kodeProduksi = document.getElementById('kode_produksi').value;
    fetch('/getJumlahBarang/' + kodeProduksi)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            document.getElementById('jumlah_barang').value = data.barang_diproses;
        })
        .catch(error => {
            console.error('Error:', error);
            // Handle error, for example:
            alert('Terjadi kesalahan saat mengambil data jumlah barang.');
        });
}

</script>

@endsection
