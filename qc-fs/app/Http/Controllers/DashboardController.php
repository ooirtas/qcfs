<?php

namespace App\Http\Controllers;
use App\Models\QualityControl;


class DashboardController extends Controller
{
    public function index()
    {
        $title = "Dashboard Admin";
        $data = QualityControl::selectRaw('
            DATE(tanggal_qc) as date,
            SUM(layak) as layak,
            SUM(repair) as repair,
            SUM(reject) as reject
        ')
        ->groupBy('date')
        ->orderBy('date', 'ASC')
        ->get();

        // Kirim data ke view
        return view('Dashboard.dashboard', compact('data','title'));
    }
    
}