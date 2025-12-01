<?php
namespace App\Controllers\Transaksi;

use App\Controllers\BaseController;
use App\Models\BarangMasukModel;
use App\Models\BarangMasukDetailModel;
use App\Models\BarangModel;

class PenerimaanController extends BaseController
{
    protected $masukModel;
    protected $detailModel;
    protected $barangModel;

    public function __construct()
    {
        $this->masukModel  = new BarangMasukModel();
        $this->detailModel = new BarangMasukDetailModel();
        $this->barangModel = new BarangModel();
    }

    public function index()
    {
        $data = [
            'title'       => 'Barang Masuk',
            'masuk'       => $this->masukModel->orderBy('id_barang_masuk', 'DESC')->findAll(),
            'pending'     => $this->masukModel->getPendingCount()
        ];
        return view('transaksi/penerimaan/index', $data);
    }

    public function create()
    {
        $last = $this->masukModel->selectMax('id_barang_masuk')->first();
        $next = ($last ? $last['id_barang_masuk'] : 0) + 1;
        $kode = 'BM-' . date('Ym') . '-' . str_pad($next, 3, '0', STR_PAD_LEFT);

        $data = [
            'title'   => 'Tambah Barang Masuk',
            'kode'    => $kode,
            'barangs' => $this->barangModel->findAll()
        ];
        return view('transaksi/penerimaan/create', $data);
    }

    public function store()
    {
        $items = $this->request->getPost('items'); // array dari JS
        if (empty($items)) return redirect()->back()->with('error', 'Pilih minimal 1 barang!');

        $id_masuk = $this->masukModel->insert([
            'kode_masuk'     => $this->request->getPost('kode_masuk'),
            'tanggal_masuk'  => $this->request->getPost('tanggal_masuk'),
            'id_user'        => session('id_user'),
            'status_masuk'   => 'pending',
            'created_by'     => session('id_user')
        ]);

        foreach ($items as $item) {
            if ($item['id_barang'] && $item['qty'] > 0) {
                $this->detailModel->insert([
                    'id_barang_masuk' => $id_masuk,
                    'id_barang'       => $item['id_barang'],
                    'qty_masuk'       => $item['qty']
                ]);
            }
        }

        return redirect('transaksi/penerimaan')->with('success', 'Barang masuk berhasil dibuat. Menunggu approval supervisor.');
    }

    public function detail($id)
    {
        $data = [
            'title'   => 'Detail Barang Masuk',
            'header'  => $this->masukModel->find($id),
            'detail'  => $this->detailModel->getDetail($id)
        ];
        return view('transaksi/penerimaan/detail', $data);
    }

    public function approve($id)
    {
        if (session('level_user') !== 'supervisor') {
            return redirect()->back()->with('error', 'Hanya Supervisor yang bisa approve!');
        }

        $this->masukModel->update($id, [
            'status_masuk'    => 'approved',
            'tanggal_approve' => date('Y-m-d'),
            'created_by'      => session('id_user') // approver
        ]);

        // Tambah stok
        $details = $this->detailModel->where('id_barang_masuk', $id)->findAll();
        foreach ($details as $d) {
            $this->barangModel->set('stok_barang', "stok_barang + {$d['qty_masuk']}", false)
                               ->where('id_barang', $d['id_barang'])
                               ->update();
        }

        return redirect()->back()->with('success', 'Transaksi telah di-APPROVE. Stok bertambah!');
    }
}