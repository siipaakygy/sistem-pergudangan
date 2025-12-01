<?php
namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\BarangMasukModel;
use App\Models\BarangKeluarModel;

class Home extends BaseController
{
    public function index()
    {
        $barangModel = new BarangModel();
        $masukModel  = new BarangMasukModel();
        $keluarModel = new BarangKeluarModel();

        $today = date('Y-m-d');

        $data = [
            'title'               => 'Dashboard',
            'total_barang'        => $barangModel->countAll(),
            'penerimaan_hari_ini' => $masukModel->where('DATE(tanggal_masuk)', $today)->countAllResults(),
            'menunggu_approval'   => $masukModel->where('status_masuk', 'pending')->countAllResults() 
                                    + $keluarModel->where('status_keluar', 'pending')->countAllResults(),
            'suratjalan_hari_ini' => $keluarModel->where('DATE(tanggal_keluar)', $today)->countAllResults(),
        ];

        return view('dashboard', $data);
    }
}