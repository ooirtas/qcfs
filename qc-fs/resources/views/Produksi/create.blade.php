@extends('layouts.app')

@section('title','Tambah Produksi')

@section('contents')

<!-- Main -->
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Data Produksi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('Dashboard.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Data Produksi / Tambah Data</li>
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

        <form class="row g-3" action="{{ route('produksi.store') }}" method="post">
          @csrf
          

        <div class="col-12">
            <label for="id_barang" class="form-label form-label-sm" style="font-size: 14px;">Nama Barang<span style="color: red;">*</span></label>
            <select class="form-control form-control-sm" id="id_barang" name="id_barang" >
                <option value="" selected disabled style="font-style: italic;">Pilih Data</option>
                @foreach($produksi as $produksi)
                <option value="{{ $produksi->id_barang }}">KBR00{{ $produksi->id_barang }} - {{ $produksi->nama_barang }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12">
            <label for="nama_produksi" class="form-label form-label-sm" style="font-size: 14px;">Nama Produksi<span style="color: red;">*</span></label>
            <input type="text" class="form-control form-control-sm" id="nama_produksi" name="nama_produksi">
          </div>

          <div class="col-12">
            <label for="jumlah_produksi" class="form-label form-label-sm" style="font-size: 14px;">Jumlah Produksi<span style="color: red;">*</span></label>
            <input type="number" class="form-control form-control-sm" id="jumlah_produksi" name="jumlah_produksi" min="1">
          </div>

          <div class="col-12">
            <label for="jumlah_proses" class="form-label form-label-sm" style="font-size: 14px;">Jumlah Proses<span style="color: red;">*</span></label>
            <input type="number" class="form-control form-control-sm" id="jumlah_proses" name="jumlah_proses" min="1">
          </div>

          <div class="col-12">
            <input type="hidden" class="form-control" id="status" value="1" name="status">
          </div>
          <div class="text-end">
                    <a href="{{ route('produksi.index') }}" class="btn btn-danger btn-sm">
                        <i class="bi bi-arrow-left-circle"></i> Kembali
                    </a>
                    <button type="reset" class="btn btn-warning btn-sm">
                        <i class="bi bi-x-circle"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-success btn-sm">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                </div>
        </form>
      </div>
  </main>
@endsection
