<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'tb_barang';
    protected $primaryKey = 'id_barang';
    protected $allowedFields = ['kode_barang', 'name_barang', 'id_gudang', 'id_kategori_barang', 'stok_barang', 'satuan_barang'];
    protected $useTimestamps = true;

    // TAMBAHKAN METHOD INI DI BAWAH!
    public function getBarangWithRelations()
    {
        return $this->select('tb_barang.*, tb_gudang.name_gudang, tb_kategori_barang.name_kategori_barang')
                    ->join('tb_gudang', 'tb_gudang.id_gudang = tb_barang.id_gudang', 'left')
                    ->join('tb_kategori_barang', 'tb_kategori_barang.id_kategori_barang = tb_barang.id_kategori_barang', 'left')
                    ->orderBy('tb_barang.id_barang', 'DESC')
                    ->findAll();
    }
}