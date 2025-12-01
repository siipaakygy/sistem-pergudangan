<?php
namespace App\Models;

use CodeIgniter\Model;

class BarangMasukDetailModel extends Model
{
    protected $table      = 'tb_barang_masuk_detail';
    protected $primaryKey = 'id_barang_masuk_detail';
    protected $allowedFields = ['id_barang_masuk', 'id_barang', 'qty_masuk'];

    public function getDetail($id_masuk)
    {
        return $this->select('tb_barang_masuk_detail.*, tb_barang.kode_barang, tb_barang.name_barang')
                    ->join('tb_barang', 'tb_barang.id_barang = tb_barang_masuk_detail.id_barang')
                    ->where('id_barang_masuk', $id_masuk)
                    ->findAll();
    }
}