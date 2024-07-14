@extends('layouts.app')

@section('title','Menu Barang')

@section('contents')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data Barang</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('Dashboard.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Data Barang</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                        <a class="btn btn-primary btn-sm" href="{{ route('barangs.create') }}">
                            <i class="bi bi-plus bold-icon"></i> Tambah Data
                        </a>
                        </h5>

                        <table class="table table-striped" id="myTable" style="font-size: 14px;">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center;">No</th>
                                    <th scope="col" style="text-align: center;">Kode Barang</th>
                                    <th scope="col" style="text-align: center;">Nama Barang</th>
                                    <th scope="col" style="text-align: center;">Stock Barang</th>
                                    <th scope="col" style="text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                $i=1;
                                @endphp

                                @forelse($barangs as $barang)
                                <tr>
                                    <td style="text-align: center;">{{ $i++ }}</td>
                                    <td style="text-align: center;"> KBR00{{ $barang->id_barang }}</td>
                                    <td style="text-align: center;">{{ $barang->nama_barang }}</td>
                                    <td style="text-align: center;">{{ $barang->stock }}</td>
                                    <td style="text-align: center;">
                                        <a href="{{ route('barangs.edit', ['id' => $barang->id_barang]) }}" class="btn btn-warning btn-sm"><i class="ri-edit-box-line"></i></a>
                                        <a class="btn btn-danger btn-sm delete-btn" data-id="{{ $barang->id_barang }}"><i class="bi bi-trash"></i></a>
                                        <form id="delete-row-{{ $barang->id_barang }}" action="{{ route('barangs.destroy', ['id' => $barang->id_barang]) }}" method="POST">
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
                const barangId = this.getAttribute('data-id');

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
                        const form = document.getElementById(`delete-row-${barangId}`);
                        form.submit();
                    }
                });
            });
        });
    });
</script>

<!-- ... (bagian lain dari kode HTML Anda) ... -->
@endsection
