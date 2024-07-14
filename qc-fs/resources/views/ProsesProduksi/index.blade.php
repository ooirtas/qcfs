@extends('layouts.app')

@section('title','Proses Produksi')

@section('contents')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Proses Produksi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('Dashboard.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Proses Produksi</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                        <a class="btn btn-primary btn-sm" href="{{ route('ProsesProduksi.create') }}">
                            <i class="bi bi-plus bold-icon"></i> Tambah Data
                        </a>
                        </h5>

                        <table class="table table-striped" id="myTable" style="font-size: 14px;">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center;">No</th>
                                    <th scope="col" style="text-align: center;">Nama Proses</th>
                                    <th scope="col" style="text-align: center;">Kode Produksi</th>
                                    <th scope="col" style="text-align: center;">Proses Ke</th>
                                    <th scope="col" style="text-align: center;">Tanggal</th>
                                    <th scope="col" style="text-align: center;">Jumlah</th>
                                    <th scope="col" style="text-align: center;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=1;
                                @endphp

                                @forelse($proses_produksis as $proses_produksi)
                                <tr>
                                    <td style="text-align: center;">{{ $i++ }}</td>
                                    <td style="text-align: justify;">KPS00{{ $proses_produksi->kode_proses }} - {{ $proses_produksi->nama_proses }}</td>
                                    <td style="text-align: center;">KPR00{{ $proses_produksi->kode_produksi }}</td>
                                    <td style="text-align: center;">{{ $proses_produksi->proses_ke }}</td>
                                    <td style="text-align: center;">
                                        {{ \Carbon\Carbon::parse($proses_produksi->tanggal_proses)->isoFormat('DD-MM-YYYY') }}
                                    </td>
                                    <td style="text-align: center;">{{ $proses_produksi->jumlah_barang }}</td>
                                    <td style="text-align: center;">
                                        @if($proses_produksi->status == 1)
                                            Sedang Berlangsung - 
                                            <a href="{{ route('selesaikan_proses', ['kode_proses' => $proses_produksi->kode_proses]) }}" class="ri-edit-box-line bold-icon" style="font-size: 18px;"></a>
                                        @elseif($proses_produksi->status == 2)
                                            Menunggu QC
                                        @elseif($proses_produksi->status == 3)
                                            Selesai
                                        @endif
                                    </td>

                                </tr>


                                @empty
                                <tr>
                                    <td>
                                        Data Tidak Ditemukan!
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>


@endsection