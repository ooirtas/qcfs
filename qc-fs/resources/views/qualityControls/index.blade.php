@extends('layouts.app')

@section('title','Menu Quality Control')

@section('contents')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Quality Control</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('Dashboard.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Quality Control</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                        <a class="btn btn-primary btn-sm" href="{{ route('qualityControls.create')  }}">
                            <i class="bi bi-plus bold-icon"></i> Tambah Data
                        </a>
                        </h5>                       
                        <!-- Table with stripped rows -->
                        <table class="table table-striped" id="myTable" style="font-size: 14px;">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center;">No</th>
                                    <th scope="col" style="text-align: center;">Nama Proses</th>
                                    <th scope="col" style="text-align: center;">Kode Produksi</th>
                                    <th scope="col" style="text-align: center;">Tanggal</th>
                                    <th scope="col" style="text-align: center;">Layak</th>
                                    <th scope="col" style="text-align: center;">Repair</th>
                                    <th scope="col" style="text-align: center;">Reject</th>
                                    <th scope="col" style="text-align: center;">Jumlah</th>
                                    <th scope="col" style="text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                $i=1;
                                @endphp

                                @forelse($qualityControls as $qualityControl)
                                <tr>
                                    <td style="text-align: center;">{{ $i++ }}</td>
                                    <td style="text-align: justify;">Proses Ke {{ $qualityControl->prosesProduksi->proses_ke ?? 'N/A' }} - {{ $qualityControl->prosesProduksi->nama_proses ?? 'N/A' }}</td>
                                    <td style="text-align: center;">KPR00{{ $qualityControl->prosesProduksi->kode_produksi ?? 'N/A' }}</td>
                                    <td style="text-align: center;">
                                        {{ \Carbon\Carbon::parse($qualityControl->tanggal_qc)->isoFormat('DD-MM-YYYY') }}
                                    </td>
                                    <td style="text-align: center;">{{ $qualityControl->layak }}</td>
                                    <td style="text-align: center;">{{ $qualityControl->repair }}</td>
                                    <td style="text-align: center;">{{ $qualityControl->reject }}</td>
                                    <td style="text-align: center;">{{ $qualityControl->layak + $qualityControl->repair + $qualityControl->reject }}</td>
                                    <td style="text-align: center;">
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#qcModal{{ $qualityControl->id_qc }}">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>

                                </tr>
                                <div class="modal fade" id="qcModal{{ $qualityControl->id_qc }}" tabindex="-1" role="dialog" aria-labelledby="qcModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="qcModalLabel">Detail Quality Control</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Nama Proses:</strong> {{ $qualityControl->kode_proses }}</p>
                                                <p><strong>Tanggal:</strong> {{ $qualityControl->tanggal_qc }}</p>
                                                <p><strong>Diperiksa:</strong> {{ $qualityControl->diperiksa }}</p>
                                                <p><strong>Layak:</strong> {{ $qualityControl->layak }}</p>
                                                <p><strong>Repair:</strong> {{ $qualityControl->repair }}</p>
                                                <p><strong>Deskripsi Repair:</strong>{{ $qualityControl->deskripsi_repair }}</p>
                                                <p><strong>Reject:</strong> {{ $qualityControl->reject }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                const qcId = this.getAttribute('data-id');

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
                        const form = document.getElementById(delete-row-${qcId});
                        form.submit();
                    }
                });
            });
        });
    });
</script>

<!-- ... (bagian lain dari kode HTML Anda) ... -->
@endsection