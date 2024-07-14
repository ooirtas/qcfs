@extends('layouts.app')

@section('title','Tambah Quality Control')

@section('contents')

<!-- Main -->
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Quality Control</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('Dashboard.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Quality Control / Tambah Data</li>
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
        <form class="row g-3" action="{{ route('qualityControls.store') }}" method="post">
          @csrf
          
          <div class="col-12">
              <label for="tanggal_qc" class="form-label form-label-sm" style="font-size: 14px;">Tanggal<span style="color: red;">*</span></label>
              <input type="date" class="form-control form-control-sm" id="tanggal_qc" name="tanggal_qc" value="{{ $today }}">
          </div>



          <div class="col-12">
              <label for="kode_proses" class="form-label form-label-sm" style="font-size: 14px;">Nama Proses<span style="color: red;">*</span></label>
              <select class="form-control form-control-sm" id="kode_proses" name="kode_proses">
                  <option value="" selected disabled style="font-style: italic;">Pilih Data</option>
                  @foreach($prosesProduksis as $produksi)
                      <option value="{{ $produksi->kode_proses }}" data-jumlah_barang="{{ $produksi->jumlah_barang }}">
                          KPR00{{ $produksi->kode_produksi }} - {{ $produksi->nama_proses }}
                      </option>
                  @endforeach
              </select>
          </div>

          <div class="col-12">
              <label for="jumlah_barang" class="form-label form-label-sm" style="font-size: 14px;">Jumlah Barang</label>
              <input type="text" class="form-control form-control-sm" id="jumlah_barang" name="jumlah_barang" readonly>
          </div>


          <div class="col-12">
            <input type="hidden" class="form-control" id="diperiksa" value="QC" name="diperiksa">
          </div>

          <div class="col-12">
            <div class="row">
            <div class="col-4">
                <label for="layak" class="form-label" style="font-size: 14px;">Layak</label>
                <input type="text" class="form-control form-control-sm" id="layak" name="layak" value="{{ old('layak', '0') }}">
            </div>
            <div class="col-4">
                <label for="reject" class="form-label" style="font-size: 14px;">Reject</label>
                <input type="text" class="form-control form-control-sm" id="reject" name="reject" value="{{ old('reject', '0') }}">
            </div>
            <div class="col-4">
                <label for="repair" class="form-label" style="font-size: 14px;">Repair</label>
                <input type="text" class="form-control form-control-sm" id="repair" name="repair" value="{{ old('repair', '0') }}" oninput="validateNumber(this); toggleRepairDescription();">
            </div>

          </div>
          <div class="col-12" id="repair-description-container" style="display:none;">
            <label for="deskripsi_repair" class="form-label" style="font-size: 14px;">Deskripsi Repair <span style="color: red;">*</span></label>
            <input type="text" class="form-control form-control-sm" id="deskripsi_repair" name="deskripsi_repair" value="{{ old('deskripsi_repair') }}">
          </div>

          </br>
          <div class="text-end">
                    <a href="{{ route('qualityControls.index') }}" class="btn btn-danger btn-sm">
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
    function validateNumber(input) {
      input.value = input.value.replace(/\D/g, '');
    }

    function toggleRepairDescription() {
      var repairInput = document.getElementById('repair');
      var repairDescriptionContainer = document.getElementById('repair-description-container');
      if (repairInput.value > 0) {
        repairDescriptionContainer.style.display = 'block';
      } else {
        repairDescriptionContainer.style.display = 'none';
      }
    }

    function resetForm() {
    document.getElementById('repair-description-container').style.display = 'none';
    document.getElementById('layak').value = '0';
    document.getElementById('repair').value = '0'; 
    document.getElementById('reject').value = '0'; 

    document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('layak').value = '0';
      document.getElementById('repair').value = '0';
      document.getElementById('reject').value = '0';
    });
  }

  document.addEventListener('DOMContentLoaded', function () {
        const kodeProsesSelect = document.getElementById('kode_proses');
        const jumlahBarangInput = document.getElementById('jumlah_barang');

        kodeProsesSelect.addEventListener('change', function () {
            const selectedOption = kodeProsesSelect.options[kodeProsesSelect.selectedIndex];
            const jumlahBarang = selectedOption.getAttribute('data-jumlah_barang');
            
            jumlahBarangInput.value = jumlahBarang;
        });
    });
  </script>
  @endsection