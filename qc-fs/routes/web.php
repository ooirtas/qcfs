<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HalamanAwalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ProduksiController;
use App\Http\Controllers\ProsesProduksiController;
use App\Http\Controllers\QualityControlController;

Route::get('/', [HalamanAwalController::class, 'index'])->name('/');

//Routes Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('Dashboard.dashboard');

//Routes Barang
Route::get('/barangs',[BarangController::class,'index'])->name('barangs.index');
Route::get('/barangs/create',[BarangController::class,'create'])->name('barangs.create');
Route::post('/barangs',[BarangController::class,'store'])->name('barangs.store');
Route::get('/barangs/{id}/edit',[BarangController::class,'edit'])->name('barangs.edit');
Route::put('/barangs/{id}',[BarangController::class,'update'])->name('barangs.update');
Route::delete('/barangs/{id}',[BarangController::class,'destroy'])->name('barangs.destroy');

//Route Proses Produksi
Route::get('/ProsesProduksi',[ProsesProduksiController::class,'index'])->name('ProsesProduksi.index');
Route::get('/selesaikan_proses/{kode_proses}', [ProsesProduksiController::class, 'selesaikan_proses'])->name('selesaikan_proses');
Route::get('/ProsesProduksi/create',[ProsesProduksiController::class,'create'])->name('ProsesProduksi.create');
Route::get('/getLatestProsesKe/{kode_produksi}', [ProsesProduksiController::class, 'getLatestProsesKe']);
Route::get('/getJumlahBarang/{kode_produksi}', [ProsesProduksiController::class, 'getJumlahBarang']);
Route::post('/ProsesProduksi',[ProsesProduksiController::class,'store'])->name('ProsesProduksi.store');

//Quality Control
Route::get('/qualityControls',[QualityControlController::class,'index'])->name('qualityControls.index');
Route::get('/qualityControls/create',[QualityControlController::class,'create'])->name('qualityControls.create');
Route::post('/qualityControls',[QualityControlController::class,'store'])->name('qualityControls.store');
Route::get('/qualityControls/{id}/edit',[QualityControlController::class,'edit'])->name('qualityControls.edit');
Route::put('/qualityControls/{id}',[QualityControlController::class,'update'])->name('qualityControls.update');
Route::delete('/qualityControls/{id}',[QualityControlController::class,'destroy'])->name('qualityControls.destroy');

//Routes Produksi
Route::get('/produksi',[ProduksiController::class,'index'])->name('produksi.index');
Route::get('/produksi/create',[ProduksiController::class,'create'])->name('produksi.create');
Route::post('/produksi',[ProduksiController::class,'store'])->name('produksi.store');
Route::get('/produksi/{id}/edit',[ProduksiController::class,'edit'])->name('produksi.edit');
Route::put('/produksi/{id}',[ProduksiController::class,'update'])->name('produksi.update');
Route::delete('/produksi/{id}',[ProduksiController::class,'destroy'])->name('produksi.destroy');
