<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\GudangModel;
use App\Models\KategoriModel;

class BarangController extends BaseController
{
    protected $barangModel;
    protected $gudangModel;
    protected $kategoriModel;

    public function __construct()
    {
        $this->barangModel   = new BarangModel();
        $this->gudangModel   = new GudangModel();
        $this->kategoriModel = new KategoriModel();

        if (strtolower(session('level_user') ?? '') !== 'superadmin') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function index()
    {
        $data = [
            'title'     => 'Master Barang',
            'barangs'   => $this->barangModel
                ->select('tb_barang.*, tb_gudang.name_gudang, tb_kategori_barang.name_kategori_barang')
                ->join('tb_gudang', 'tb_gudang.id_gudang = tb_barang.id_gudang')
                ->join('tb_kategori_barang', 'tb_kategori_barang.id_kategori_barang = tb_barang.id_kategori_barang')
                ->findAll(),
            'gudangs'   => $this->gudangModel->findAll(),     // WAJIB!
            'kategoris' => $this->kategoriModel->findAll()   // WAJIB!
        ];

        return view('master/barang/index', $data);
    }

    public function store()
    {
        $rules = [
            'name_barang'        => 'required|min_length[3]',
            'id_gudang'          => 'required',
            'id_kategori_barang' => 'required',
            'satuan_barang'      => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $last = $this->barangModel->selectMax('id_barang')->first();
        $next = ($last['id_barang'] ?? 0) + 1;
        $kode = 'BR' . str_pad($next, 3, '0', STR_PAD_LEFT);

        $this->barangModel->insert([
            'kode_barang'        => $kode,
            'name_barang'        => $this->request->getPost('name_barang'),
            'id_gudang'          => $this->request->getPost('id_gudang'),
            'id_kategori_barang' => $this->request->getPost('id_kategori_barang'),
            'satuan_barang'      => $this->request->getPost('satuan_barang'),
            'stok_barang'        => 0
        ]);

        return redirect()->to('/master/barang')->with('success', "Barang $kode berhasil ditambahkan!");
    }

    public function update($id)
    {
        $rules = [
            'name_barang'        => 'required|min_length[3]',
            'id_gudang'          => 'required',
            'id_kategori_barang' => 'required',
            'satuan_barang'      => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->barangModel->update($id, [
            'name_barang'        => $this->request->getPost('name_barang'),
            'id_gudang'          => $this->request->getPost('id_gudang'),
            'id_kategori_barang' => $this->request->getPost('id_kategori_barang'),
            'satuan_barang'      => $this->request->getPost('satuan_barang')
        ]);

        return redirect()->to('/master/barang')->with('success', 'Barang berhasil diupdate!');
    }

    public function delete($id)
    {
        $this->barangModel->delete($id);
        return redirect()->to('/master/barang')->with('success', 'Barang berhasil dihapus!');
    }
}