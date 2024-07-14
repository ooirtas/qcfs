@extends('layouts.app')

@section('title','Dashboard Admin')

@section('contents')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('Dashboard.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- Sales Card -->
      <div class="col-xxl-4 col-md-6">
        <div class="card info-card sales-card">
          <div class="card-body">
            <h5 class="card-title">Barang Layak <span>| Bulan ini</span></h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-success">
                <i class="bi bi-check-circle text-white"></i>
              </div>
              <div class="ps-3">
                <h6>{{ $data->sum('layak') }}</h6>
              </div>
            </div>
          </div>
        </div>
      </div><!-- End Sales Card -->

      <!-- Revenue Card -->
      <div class="col-xxl-4 col-md-6">
        <div class="card info-card revenue-card">
          <div class="card-body">
            <h5 class="card-title">Barang Repair <span>| Bulan ini</span></h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-warning">
                <i class="bi bi-tools text-white"></i>
              </div>
              <div class="ps-3">
                <h6>{{ $data->sum('repair') }}</h6>
              </div>
            </div>
          </div>
        </div>
      </div><!-- End Revenue Card -->

      <!-- Customers Card -->
      <div class="col-xxl-4 col-xl-12">
        <div class="card info-card customers-card">
          <div class="card-body">
            <h5 class="card-title">Barang Reject <span>| Bulan ini</span></h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-danger">
                <i class="bi bi-x-circle text-white"></i>
              </div>
              <div class="ps-3">
                <h6>{{ $data->sum('reject') }}</h6>
              </div>
            </div>
          </div>
        </div>
      </div><!-- End Customers Card -->

      <!-- Reports -->
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Reports <span>/Today</span></h5>
            <div id="reportsChart"></div>
          </div>
        </div>
      </div><!-- End Reports -->
    </div>
  </section>
</main><!-- End #main -->

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    const data = @json($data);

    new ApexCharts(document.querySelector("#reportsChart"), {
      series: [{
        name: 'Layak',
        data: data.map(item => item.layak),
      }, {
        name: 'Repair',
        data: data.map(item => item.repair)
      }, {
        name: 'Reject',
        data: data.map(item => item.reject)
      }],
      chart: {
        height: 350,
        type: 'area',
        toolbar: {
          show: false
        },
      },
      markers: {
        size: 4
      },
      colors: ['#2eca6a', '#FFDE59', '#E4080A'],
      fill: {
        type: "gradient",
        gradient: {
          shadeIntensity: 1,
          opacityFrom: 0.3,
          opacityTo: 0.4,
          stops: [0, 90, 100]
        }
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth',
        width: 2
      },
      xaxis: {
        type: 'datetime',
        categories: data.map(item => item.date)
      },
      tooltip: {
        x: {
          format: 'dd/MM/yy'
        },
      }
    }).render();
  });
</script>

@endsection
