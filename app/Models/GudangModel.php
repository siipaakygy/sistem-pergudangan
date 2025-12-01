<?php
namespace App\Models;
use CodeIgniter\Model;

class GudangModel extends Model
{
    protected $table = 'tb_gudang';
    protected $primaryKey = 'id_gudang';
    protected $allowedFields = ['kode_gudang', 'name_gudang', 'lokasi_gudang'];
    protected $useTimestamps = true;
}