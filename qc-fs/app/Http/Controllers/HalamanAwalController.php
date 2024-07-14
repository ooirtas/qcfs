<?php

namespace App\Http\Controllers;

use App\Models\Organisasi;
use App\Models\Pengurus;
use Illuminate\Http\Request;
use App\Http\Requests\DivisiStoreRequest;
use App\Http\Requests\DivisiUpdateRequest;
use Illuminate\Support\Facades\Session;

class HalamanAwalController extends Controller
{
    public function index()
    {
        $title = 'Penilaian Organisasi Mahasiswa';
        return view('HalamanAwal.halamanAwal');
    }

}