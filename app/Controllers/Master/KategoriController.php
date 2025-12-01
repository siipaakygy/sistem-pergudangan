<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\KategoriModel;

class KategoriController extends BaseController
{
    protected $kategoriModel;

    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();

        if (strtolower(session('level_user') ?? '') !== 'superadmin') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function index()
    {
        $data = [
            'title'     => 'Master Kategori',
            'kategoris' => $this->kategoriModel->findAll() // WAJIB ADA!
        ];
        return view('master/kategori/index', $data);
    }

    public function store()
    {
        if (!$this->validate(['name_kategori_barang' => 'required|min_length[3]'])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $last = $this->kategoriModel->selectMax('id_kategori_barang')->first();
        $next = ($last['id_kategori_barang'] ?? 0) + 1;
        $kode = 'KT' . str_pad($next, 3, '0', STR_PAD_LEFT);

        $this->kategoriModel->insert([
            'kode_kategori_barang' => $kode,
            'name_kategori_barang' => $this->request->getPost('name_kategori_barang')
        ]);

        return redirect()->to('/master/kategori')->with('success', "Kategori $kode berhasil ditambahkan!");
    }

    public function update($id)
    {
        if (!$this->validate(['name_kategori_barang' => 'required|min_length[3]'])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->kategoriModel->update($id, [
            'name_kategori_barang' => $this->request->getPost('name_kategori_barang')
        ]);

        return redirect()->to('/master/kategori')->with('success', 'Kategori berhasil diupdate!');
    }

    public function delete($id)
    {
        $this->kategoriModel->delete($id);
        return redirect()->to('/master/kategori')->with('success', 'Kategori berhasil dihapus!');
    }
}