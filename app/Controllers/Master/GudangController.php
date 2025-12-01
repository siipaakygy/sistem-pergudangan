<?php
namespace App\Controllers\Master;
use App\Controllers\BaseController;
use App\Models\GudangModel;

class GudangController extends BaseController
{
    protected $gudangModel;

    public function __construct()
    {
        $this->gudangModel = new GudangModel();
        if (strtolower(session('level_user') ?? '') !== 'superadmin') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function index()
    {
        $data = [
            'title'   => 'Master Gudang',
            'gudangs' => $this->gudangModel->orderBy('id_gudang', 'DESC')->findAll()
        ];
        return view('master/gudang/index', $data);
    }

    public function store()
    {
        if (!$this->validate(['name_gudang' => 'required|min_length[3]'])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $kode = $this->generateKode('GD');
        $this->gudangModel->save([
            'kode_gudang'   => $kode,
            'name_gudang'   => $this->request->getPost('name_gudang'),
            'lokasi_gudang' => $this->request->getPost('lokasi_gudang')
        ]);

        return redirect()->to('/master/gudang')->with('success', "Gudang $kode berhasil ditambahkan!");
    }

    public function update($id)
    {
        if (!$this->validate(['name_gudang' => 'required|min_length[3]'])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->gudangModel->update($id, [
            'name_gudang'   => $this->request->getPost('name_gudang'),
            'lokasi_gudang' => $this->request->getPost('lokasi_gudang')
        ]);

        return redirect()->to('/master/gudang')->with('success', 'Gudang berhasil diupdate!');
    }

    public function delete($id)
    {
        $this->gudangModel->delete($id);
        return redirect()->to('/master/gudang')->with('success', 'Gudang berhasil dihapus!');
    }

    private function generateKode($prefix)
    {
        $last = $this->gudangModel->selectMax('id_gudang')->first();
        $next = ($last['id_gudang'] ?? 0) + 1;
        return $prefix . str_pad($next, 3, '0', STR_PAD_LEFT);
    }
}