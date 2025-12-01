<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table         = 'tb_kategori_barang';
    protected $primaryKey    = 'id_kategori_barang';
    
    // TAMBAHKAN kode_kategori_barang DI SINI!!!
    protected $allowedFields = ['kode_kategori_barang', 'name_kategori_barang'];
    
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}