<?php
namespace App\Controllers\Transaksi;

use App\Controllers\BaseController;
use App\Models\BarangKeluarModel;
use App\Models\BarangKeluarDetailModel;
use App\Models\BarangModel;

class SuratJalanController extends BaseController
{
    protected $keluarModel;
    protected $detailModel;
    protected $barangModel;

    public function __construct()
    {
        $this->keluarModel = new BarangKeluarModel();
        $this->detailModel = new BarangKeluarDetailModel();
        $this->barangModel = new BarangModel();
    }

    public function index()
    {
        $data = [
            'title'   => 'Barang Keluar / Surat Jalan',
            'keluar'  => $this->keluarModel->orderBy('id_barang_keluar','DESC')->findAll(),
            'pending' => $this->keluarModel->getPendingCount()
        ];
        return view('transaksi/suratjalan/index', $data);
    }

    public function create()
    {
        $last = $this->keluarModel->selectMax('id_barang_keluar')->first();
        $next = ($last ? $last['id_barang_keluar'] : 0) + 1;
        $kode = 'BK-' . date('Ym') . '-' . str_pad($next, 3, '0', STR_PAD_LEFT);

        $data = [
            'title'   => 'Tambah Surat Jalan',
            'kode'    => $kode,
            // FIX: TAMPILKAN SEMUA BARANG (biar gak kosong)
            'barangs' => $this->barangModel->findAll()
        ];
        return view('transaksi/suratjalan/create', $data);
    }

    public function store()
    {
        $items = $this->request->getPost('items');
        if (empty($items) || !is_array($items)) {
            return redirect()->back()->with('error', 'Pilih minimal 1 barang!');
        }

        // FIX: PAKAI id_user SAJA (karena created_by belum ada di tabel)
        $id_keluar = $this->keluarModel->insert([
            'kode_keluar'    => $this->request->getPost('kode_keluar'),
            'tanggal_keluar' => $this->request->getPost('tanggal_keluar'),
            'id_user'        => session('id_user'),
            'status_keluar'  => 'pending'
            // HAPUS created_by kalau tabel belum ada kolomnya
        ]);

        foreach ($items as $item) {
            if (!empty($item['id_barang']) && !empty($item['qty'])) {
                $barang = $this->barangModel->find($item['id_barang']);
                if (!$barang) continue;

                if ($item['qty'] > $barang['stok_barang']) {
                    return redirect()->back()->with('error', "Stok {$barang['name_barang']} tidak cukup! (Tersedia: {$barang['stok_barang']})");
                }

                $this->detailModel->insert([
                    'id_barang_keluar' => $id_keluar,
                    'id_barang'        => $item['id_barang'],
                    'qty_keluar'       => $item['qty']
                ]);
            }
        }

        return redirect()->to('transaksi/surat-jalan')->with('success', 'Surat jalan berhasil dibuat! Menunggu approval.');
    }

    public function approve($id)
    {
        if (session('level_user') !== 'supervisor') {
            return redirect()->back()->with('error', 'Hanya Supervisor yang boleh approve!');
        }

        $this->keluarModel->update($id, [
            'status_keluar'   => 'approved',
            'tanggal_approve' => date('Y-m-d')
        ]);

        $details = $this->detailModel->where('id_barang_keluar', $id)->findAll();
        foreach ($details as $d) {
            $this->barangModel->set('stok_barang', "stok_barang - {$d['qty_keluar']}", false)
                               ->where('id_barang', $d['id_barang'])
                               ->update();
        }

        return redirect()->back()->with('success', 'Surat jalan telah di-APPROVE! Stok berkurang.');
    }
}