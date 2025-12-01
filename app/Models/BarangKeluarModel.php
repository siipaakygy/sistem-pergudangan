<?php
namespace App\Models;

use CodeIgniter\Model;

class BarangKeluarModel extends Model
{
    protected $table      = 'tb_barang_keluar';
    protected $primaryKey = 'id_barang_keluar';
    protected $allowedFields = ['kode_keluar','tanggal_keluar','id_user','status_keluar','tanggal_approve'];
    protected $useTimestamps = true;

    public function getPendingCount()
    {
        return $this->where('status_keluar', 'pending')->countAllResults();
    }
}