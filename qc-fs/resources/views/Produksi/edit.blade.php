@extends('layouts.app')

@section('title','Edit Produksi')

@section('contents')

<!-- Main -->
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Data Produksi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('Dashboard.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Data Produksi / Perbarui Data</li>
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
            <form class="row g-3" action="{{ route('produksi.update', $produksi->kode_produksi) }}" method="post">
                @method('PUT')
                @csrf

                <div class="col-12">
                    <label for="kode_produksi" class="form-label form-label-sm" style="font-size: 14px;">Kode Produksi</label>
                    <input type="text" class="form-control form-control-sm" id="kode_produksi" name="kode_produksi"
                        value="KPR00{{ old('kode_produksi', $produksi->kode_produksi) }}"readonly>
                </div>

                <div class="col-12">
                    <label for="nama_produksi" class="form-label form-label-sm" style="font-size: 14px;">Nama Produksi<span style="color: red;">*</span></label>
                    <input type="text" class="form-control form-control-sm" id="nama_produksi" name="nama_produksi"
                        value="{{ old('nama_produksi', $produksi->nama_produksi) }}">
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
            </form><!-- Vertical Form -->
        </div>
</main>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<script>
        function validateNumber(input) {
      input.value = input.value.replace(/\D/g, '');
    }
  </script>

@endsection
