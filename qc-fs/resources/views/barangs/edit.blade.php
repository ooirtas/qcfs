@extends('layouts.app')

@section('title','Edit Barang')

@section('contents')

<!-- Main -->
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Data Barang</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('Dashboard.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Data Barang / PerbaruiData</li>
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
            <form class="row g-3" action="{{ route('barangs.update', $barang->id_barang) }}" method="post">
                @method('PUT')
                @csrf

                <div class="col-12">
                    <label for="nama_barang" class="form-label form-label-sm" style="font-size: 14px;">Kode Barang</label>
                    <input type="text" class="form-control form-control-sm" id="id_barang" name="id_barang"
                        value="KBR00{{ old('id_barang', $barang->id_barang) }}"readonly>
                </div>

                <div class="col-12">
                    <label for="nama_barang" class="form-label form-label-sm" style="font-size: 14px;">Nama Barang<span style="color: red;">*</span></label>
                    <input type="text" class="form-control form-control-sm" id="nama_barang" name="nama_barang"
                        value="{{ old('nama_barang', $barang->nama_barang) }}">
                </div>

                <div class="text-end">
                    <a href="{{ route('barangs.index') }}" class="btn btn-danger btn-sm">
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
<!-- End - Main -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<script>
        function validateNumber(input) {
      input.value = input.value.replace(/\D/g, ''); // Remove non-numeric characters
    }
  </script>

@endsection
