<?php
namespace App\Models;

use CodeIgniter\Model;

class BarangKeluarDetailModel extends Model
{
    protected $table      = 'tb_barang_keluar_detail';
    protected $primaryKey = 'id_barang_keluar_detail';
    protected $allowedFields = ['id_barang_keluar','id_barang','qty_keluar'];

    public function getDetail($id_keluar)
    {
        return $this->select('tb_barang_keluar_detail.*, tb_barang.kode_barang, tb_barang.name_barang, tb_barang.stok_barang')
                    ->join('tb_barang', 'tb_barang.id_barang = tb_barang_keluar_detail.id_barang')
                    ->where('id_barang_keluar', $id_keluar)
                    ->findAll();
    }
}