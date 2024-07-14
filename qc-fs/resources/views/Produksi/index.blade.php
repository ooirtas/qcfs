@extends('layouts.app')

@section('title','Menu Produksi')

@section('contents')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data Produksi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('Dashboard.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Data Produksi</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                        <a class="btn btn-primary btn-sm" href="{{ route('produksi.create') }}">
                            <i class="bi bi-plus bold-icon"></i> Tambah Data
                        </a>
                        </h5>

                        <table class="table table-striped" id="myTable" style="font-size: 14px;">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center;">No</th>
                                    <th scope="col" style="text-align: center;">Kode Produksi</th>
                                    <th scope="col" style="text-align: center;">Nama Produksi</th>
                                    <th scope="col" style="text-align: center;">Nama Barang</th>
                                    <th scope="col" style="text-align: center;">Jumlah Produksi</th>
                                    <th scope="col" style="text-align: center;">Tahapan</th>
                                    <th scope="col" style="text-align: center;">Status</th>
                                    <th scope="col" style="text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                $i=1;
                                @endphp

                                @forelse($produksi as $produksi)
                                <tr>
                                    <td style="text-align: center;">{{ $i++ }}</td>
                                    <td style="text-align: center;"> KPR00{{ $produksi->kode_produksi }}</td>
                                    <td style="text-align: center;">{{ $produksi->nama_produksi }}</td>
                                    <td style="text-align: center;">{{ $produksi->nama_barang }}</td>
                                    <td style="text-align: center;">{{ $produksi->jumlah_produksi }}</td>
                                    <td style="text-align: center;">{{ $produksi->jumlah_proses }}</td>
                                    <td style="text-align: center;">
                                        @if($produksi->status == 1)
                                            Menunggu Proses
                                        @elseif($produksi->status == 2)
                                            Dalam Proses
                                        @elseif($produksi->status == 3)
                                            Selesai
                                        @endif
                                    </td>
                                    <td style="text-align: center;">
                                        <a href="{{ route('produksi.edit', ['id' => $produksi->kode_produksi]) }}" class="btn btn-warning btn-sm"><i class="ri-edit-box-line"></i></a>
                                        <a class="btn btn-danger btn-sm delete-btn" data-id="{{ $produksi->kode_produksi }}"><i class="bi bi-trash"></i></a>
                                        <form id="delete-row-{{ $produksi->kode_produksi }}" action="{{ route('produksi.destroy', ['id' => $produksi->kode_produksi]) }}" method="POST">
                                            <input type="hidden" name="_method" value="DELETE">
                                            @csrf
                                        </form>
                                    </td>

                                </tr>
                                @empty
                                <tr>
                                    <td>
                                        No Record Found!
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteLinks = document.querySelectorAll('a.delete-btn');

        deleteLinks.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const produksiId = this.getAttribute('data-id');

                Swal.fire({
                    title: 'Yakin Hapus Data?',
                    text: 'Data tidak akan bisa dikembalikan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.getElementById(`delete-row-${produksiId}`);
                        form.submit();
                    }
                });
            });
        });
    });
</script>

<!-- ... (bagian lain dari kode HTML Anda) ... -->
@endsection
