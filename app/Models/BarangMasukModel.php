<?php
namespace App\Models;

use CodeIgniter\Model;

class BarangMasukModel extends Model
{
    protected $table      = 'tb_barang_masuk';
    protected $primaryKey = 'id_barang_masuk';

    protected $allowedFields = [
        'kode_masuk', 'tanggal_masuk', 'id_user', 'status_masuk', 
        'tanggal_approve', 'created_by'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Hitung berapa yang pending untuk badge merah
    public function getPendingCount()
    {
        return $this->where('status_masuk', 'pending')->countAllResults();
    }

    // Ambil semua + nama user pembuat
    public function getWithUser()
    {
        return $this->select('tb_barang_masuk.*, u1.name_user as pembuat, u2.name_user as approver')
                    ->join('tb_user u1', 'u1.id_user = tb_barang_masuk.id_user', 'left')
                    ->join('tb_user u2', 'u2.id_user = tb_barang_masuk.created_by', 'left')
                    ->findAll();
    }
}